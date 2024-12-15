import tkinter as tk
from tkinter import scrolledtext
import socket
import threading
import ipaddress
import psutil
import subprocess

# Function to get the local network of the host
def get_local_network():
    for interface, addrs in psutil.net_if_addrs().items():
        for addr in addrs:
            if addr.family == socket.AF_INET and addr.address != "127.0.0.1":
                ip = addr.address
                subnet = addr.netmask
                if ip and subnet:
                    network = ipaddress.IPv4Network(f"{ip}/{subnet}", strict=False)
                    return str(network)
    return None

# Function to ping a host and get response time
def ping_host(ip):
    try:
        response = subprocess.run(
            ["ping", "-c", "1", "-W", "1", str(ip)], stdout=subprocess.PIPE, stderr=subprocess.PIPE
        )
        if response.returncode == 0:
            return "Reachable"
        else:
            return "Unreachable"
    except Exception as e:
        return f"Error: {e}"

# Function to gather MAC address
def get_mac_address(ip):
    try:
        pid = subprocess.Popen(["arp", "-n", str(ip)], stdout=subprocess.PIPE, stderr=subprocess.PIPE)
        output, _ = pid.communicate()
        for line in output.decode().split("\n"):
            if ip in line:
                return line.split()[2]
    except Exception:
        pass
    return "Unknown"

# Function to gather host information
def gather_host_info(ip):
    info = {
        "IP": str(ip),
        "Hostname": "Unknown",
        "Open Ports": [],
        "Ping": "Unknown",
        "MAC Address": "Unknown"
    }

    # Attempt to resolve hostname
    try:
        info["Hostname"] = socket.gethostbyaddr(str(ip))[0]
    except socket.herror:
        info["Hostname"] = "Unknown"

    # Check if host is reachable
    info["Ping"] = ping_host(ip)

    # Get MAC address
    info["MAC Address"] = get_mac_address(ip)

    # Scan for open ports (basic range)
    for port in range(20, 1025):
        try:
            with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
                s.settimeout(0.5)
                if s.connect_ex((str(ip), port)) == 0:
                    info["Open Ports"].append(port)
        except Exception:
            pass

    return info

# Function to scan a single IP address
def scan_ip(ip, text_widget):
    info = gather_host_info(ip)
    text_widget.insert(tk.END, f"Host: {info['IP']}\n")
    text_widget.insert(tk.END, f"  Hostname: {info['Hostname']}\n")
    text_widget.insert(tk.END, f"  Ping: {info['Ping']}\n")
    text_widget.insert(tk.END, f"  MAC Address: {info['MAC Address']}\n")
    if info["Open Ports"]:
        text_widget.insert(tk.END, f"  Open Ports: {', '.join(map(str, info['Open Ports']))}\n")
    else:
        text_widget.insert(tk.END, "  Open Ports: None\n")
    text_widget.insert(tk.END, "\n")

# Function to scan a range of IP addresses
def scan_network(network, text_widget):
    try:
        net = ipaddress.ip_network(network, strict=False)
        text_widget.insert(tk.END, f"Scanning network: {network}\n")
        for ip in net.hosts():
            scan_ip(ip, text_widget)
    except ValueError as e:
        text_widget.insert(tk.END, f"Invalid network: {network}. Error: {e}\n")

# Function to handle scan button click
def start_scan():
    network = entry.get()
    if not network:
        network = get_local_network()
        if not network:
            text_widget.insert(tk.END, "Unable to determine local network. Please enter manually.\n")
            return
    text_widget.delete(1.0, tk.END)
    threading.Thread(target=scan_network, args=(network, text_widget)).start()

# Create GUI
root = tk.Tk()
root.title("Network Scanner")

# Entry for network address
frame = tk.Frame(root)
frame.pack(pady=10)

label = tk.Label(frame, text="Enter Network (e.g., 192.168.1.0/24):")
label.pack(side=tk.LEFT, padx=5)

entry = tk.Entry(frame, width=30)
entry.pack(side=tk.LEFT, padx=5)

button = tk.Button(frame, text="Scan", command=start_scan)
button.pack(side=tk.LEFT, padx=5)

# Text area to display results
text_widget = scrolledtext.ScrolledText(root, width=50, height=20)
text_widget.pack(pady=10)

# Pre-fill entry with local network
local_network = get_local_network()
if local_network:
    entry.insert(0, local_network)

# Run the application
root.mainloop()

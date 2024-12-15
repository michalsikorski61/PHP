import platform
import socket
import psutil
import uuid
import json

def get_network_info():
    """Zbiera informacje o środowisku sieciowym hosta."""

    info = {}

    # Informacje o systemie
    info["system"] = platform.system()
    info["release"] = platform.release()
    info["version"] = platform.version()
    info["machine"] = platform.machine()
    info["processor"] = platform.processor()

    # Nazwa hosta i adres IP
    info["hostname"] = socket.gethostname()
    try: #Obsługa sytuacji gdy nie można pobrać adresu IP
      info["ip_address"] = socket.gethostbyname(info["hostname"])
    except socket.gaierror:
      info["ip_address"] = "Nie można ustalić adresu IP"


    # Interfejsy sieciowe i ich adresy
    interfaces = psutil.net_if_addrs()
    info["interfaces"] = {}
    for interface_name, interface_addresses in interfaces.items():
        info["interfaces"][interface_name] = []
        for address in interface_addresses:
            if str(address.family) == 'AddressFamily.AF_INET':
                info["interfaces"][interface_name].append({
                    "address": address.address,
                    "netmask": address.netmask,
                    "broadcast": address.broadcast
                })
            elif str(address.family) == 'AddressFamily.AF_INET6':
                info["interfaces"][interface_name].append({
                    "address": address.address,
                    "netmask": address.netmask
                    # pomijamy broadcast dla IPv6, bo nie występuje
                })
            elif str(address.family) == 'AddressFamily.AF_LINK':  # Dodajemy adres MAC
                 info["interfaces"][interface_name].append({
                    "address": address.address,
                    "netmask": address.netmask
                    # pomijamy broadcast dla adresów MAC
                })

    # Adres MAC
    try:
        info["mac_address"] = ':'.join(['{:02x}'.format((uuid.getnode() >> elements) & 0xff)
        for elements in range(5,-1,-1)])
    except:
        info["mac_address"] = "Nie można ustalić adresu MAC"


    # Informacje o statystykach interfejsów (wysłane/odebrane bajty, pakiety itp.)
    net_io = psutil.net_io_counters(pernic=True)
    info["net_io"] = {}
    for nic, stats in net_io.items():
        info["net_io"][nic] = {
            "bytes_sent": stats.bytes_sent,
            "bytes_recv": stats.bytes_recv,
            "packets_sent": stats.packets_sent,
            "packets_recv": stats.packets_recv,
            "errin": stats.errin,
            "errout": stats.errout,
            "dropin": stats.dropin,
            "dropout": stats.dropout
        }

    return info

if __name__ == "__main__":
    network_info = get_network_info()
    print(json.dumps(network_info, indent=4))
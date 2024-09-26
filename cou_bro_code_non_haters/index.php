<?php
// Include the database connection file
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Form to insert a new user -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="user">Insert user:</label>
        <input type="text" name="username" id="username">
        <input type="submit" name="usrinsert" value="insert">
    </form>

    <!-- Form to show all data -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" name="showall" value="Show all data">
    </form>
</body>
</html>
<?php
// Query to show a specific user
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Check if the query returned any results
if (mysqli_num_rows($result) > 0) {
    // Fetch and display the user data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "User: {$row['user']}. Registered at: {$row['reg_date']} <br/>";
    }
} else {
    echo "No user found";
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the insert user form was submitted and the username is not empty
    if (isset($_POST['usrinsert']) && !empty($_POST['username'])) {
        $username_to_insert = $_POST['username'];
        $query = "INSERT INTO users (user, reg_date) VALUES ('$username_to_insert', NOW())";
        
        // Execute the insert query and check for success
        if (mysqli_query($conn, $query)) {
            echo "User inserted";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } elseif (empty($_POST['username'])) {
        echo "Please enter user";
    }

    // Check if the show all data form was submitted
    if (isset($_POST['showall'])) {
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);
        
        // Check if the query returned any results
        if (mysqli_num_rows($result) > 0) {
            // Fetch and display all user data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "User: {$row['user']}. Registered at: {$row['reg_date']} <br/>";
            }
        } else {
            echo "No user found";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
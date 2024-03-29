<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "admin";
    $password = "Admin@123";
    $database = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare data for insertion (sanitize if needed)
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    // SQL to add user
    $sql = "INSERT INTO users (username, email, address) VALUES ('$username', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        #echo "User '$username' added successfully";
        header("Location: index.html");
    exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

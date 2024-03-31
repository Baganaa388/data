<?php

// Establish MySQL connection
$host = "localhost";
$username = "admin";
$password = "Admin@123";
$database = "test";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

// Return products as JSON
header('Content-Type: application/json');
echo json_encode($products);
?>

<?php
$servername="localhost";
$username="admin";
$password= "Admin@123";
$dbname= "test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(mysqli_connect_errno())
{
   echo "Failed to connect!";
   exit();
}
?>
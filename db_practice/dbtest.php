<?php
//$servername = "localhost";
$servername = "192.168.1.89";
$username = "brian";
$password = "brian";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "You are now connected to MySQL Server successfully";
?>

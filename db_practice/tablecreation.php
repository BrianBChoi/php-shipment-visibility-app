<?php
  $servername = "localhost";
  $username = "brian";
  $password = "brian";
  $dbname = "brianDB";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // sql to create table
  $sql = "CREATE TABLE brianiscool (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    oldcoolness VARCHAR(30) NOT NULL,
    newcoolness VARCHAR(30) NOT NULL,
    goofiness VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

  if ($conn->query($sql) === TRUE) {
    echo "Table brianiscool created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

  $conn->close();
?>

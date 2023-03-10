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

  //delete a record
  $sql = "DELETE FROM brianiscool WHERE id=1";
  
  if ($conn->query($sql) === TRUE) {
    echo "The record deleted successfully";
  } else {
    echo "Error - deleting record: " . $conn->error;
  }

  $conn->close();
?>

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

  $sql = "UPDATE brianiscool SET newcoolness='Successful-Software-Slinger-at-Silicon-Valley' WHERE id=1";

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }

  $conn->close();
?>

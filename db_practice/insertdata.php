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

  $sql = "INSERT INTO brianiscool (oldcoolness, newcoolness, goofiness)
  VALUES ('bookworm', 'Surfer-on-the-rise', 'beefup')";

  if ($conn->query($sql) === TRUE) {
    echo "New record is added to the table successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>

<?php
  // Title: admin.php
  // Author: Brian Choi
  // Updated: 1/27/2022
  // Version: 1.0.0
  // Purpose: Called by admin-unlock.js with ajax to unlock user

  include("dbconnect.php");

  $username = $_POST['username'];
  $locked = !$_POST['locked'];
  $sql = "UPDATE briandb.user_logins SET locked='$locked' WHERE username='$username'";
  $result = mysqli_query($db,$sql);
 ?>

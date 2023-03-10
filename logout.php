<?php
  session_start();
  unset($_SESSION["username"]);
  unset($_SESSION["password"]);

  echo "<div align='center'>Your session is successfully ended and this page will be automatically refreshed to protect your privacy</div>";
  header('Refresh: 3; URL = login.php');
 ?>

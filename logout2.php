<?php
  session_start();

  // Session unset will delete cookies
  if(session_destroy()) {
    header("Location: login.php");
  }
 ?>

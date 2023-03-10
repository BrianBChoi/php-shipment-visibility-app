<!--
Title: main.php
Author: Brian Choi
Updated: 1/27/2022
Version: 1.0.0
Purpose: Landing page after logging in.
-->

<?php
// Provides connector for mariadb database that holds login info
require("dbconnect.php");
// Provides functions for use during session control
require("session.php");
?>

<?php
// Check if user is logged in
Session::give_access("user", $db);

// Check session is active before redirecting to admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  /**
   * Might be better if a message pops up when a normal user clicks on the button instead of being redirected to the login page.
   */
  if (Session::session_active($db)) {
    header("Location: admin.php");
  }
}

// Check session is active
if (Session::session_active($db)) {
  echo "Your session is active!";
}
?>

<html>

<head>
  <meta name="viewport" content="width=device-width initial-scale=1">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/cr-1.5.5/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>

  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="main.css">
</head>

<body>

  <!-- Navbar with link to admin page -->
  <?php include("navbar.html") ?>

  <div class="main-table">
    <div class="table-box">
      <div class="table-title"><b>Main Table</b></div>
      <div class="date-search-form">
        <label>ETD FROM</label>
          <span class="padding-10"></span>
          <input type="date" id="start-date"/>
          <span class="padding-10"></span>
        <label>TO</label>
          <span class="padding-10"></span>
          <input type="date" id="end-date"/>
          <span class="padding-10"></span>
        <button id="date-search-button">Search Dates</button>
      </div>
      <div class="table">
        <!-- Table tags display and nowrap are from DataTables library. Cosmetic changes. -->
        <table id="main-table" class="display nowrap">
          <thead>
            <tr>
              <th></th>
              <th>BL NO.</th>
              <th>CNTR NO.</th>
              <th>POL</th>
              <th>ETD</th>
              <th>POD</th>
              <th>ETA</th>
              <th>VESSEL</th>
              <th>VOYAGE</th>
              <th>BL LAST UPDATED</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/cr-1.5.5/datatables.min.js"></script>
  <script type="text/javascript" src="main-table-default.js"></script>
  <script type="text/javascript" src="main-table-etd-search.js"></script>
  <!-- For export functions -->
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


</body>

</html>

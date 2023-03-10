<?php
  // Title: admin.php
  // Author: Brian Choi
  // Updated: 1/27/2022
  // Version: 1.0.0
  // Purpose: Admin page for user management.

  require("dbconnect.php");
  require("session.php");

  Session::give_access("admin", $db);

  if($_SERVER["REQUEST_METHOD"] == "POST" && Session::session_active($db)) {
    Session::update_session_timeout($db, $_POST['user'], $_POST['time']);
  }
  ?>

<?php
  function openConnection() {
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

    return $conn;
  }
 ?>

 <html>
  <head>
    <meta name="viewport" content="width=device-width initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/cr-1.5.5/datatables.min.css"/>

    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="admin.css">
  </head>
  <body>

    <?php include("navbar.html") ?>

    <div class="admin-table">
      <div class="table-box">
        <div class="table-title"><b>List of Accounts</b></div>
        <div class="table">
          <table id="admin-table" class="display nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>PASSWORD</th>
                <th>EMAIL</th>
                <th>SESSION TIMEOUT</th>
                <th>NEW SESSION TIMEOUT</th>
                <th>LOCK/UNLOCK</th>
              </tr>
            </thead>
            <?php
            $conn = openConnection();
            $sql = "SELECT * FROM user_logins";
            $result = $conn->query($sql);
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
              echo "<tr id=".$row["user_id"].">";
              echo "<td>".$row["user_id"]."</td>";
              echo "<td class='row-data'>".$row["username"]."</td>";
              echo "<td>".$row["password"]."</td>";
              echo "<td>".$row["email"]."</td>";
              echo "<td>".(int)($row["session_timeout"]/60)." min</td>";
              echo "<td>
                      <form action='' method='post'>
                        <input type='number' name='time'/>
                        <input type='hidden' name='user' value='".$row["username"]."'/>
                        <input type='submit' value='Submit'/>
                      </form>
                    </td>";
              $image="media/unlocked-25px.png";
              if($row["locked"]) {
                $image="media/locked-25px.png";
              }
              echo "<td>
                      <input type='image' src='".$image."' onclick='changeLockStatus()'/>
                      <input class='row-data' type='hidden' name='locked' value='".$row["locked"]."'/>
                    </td>";
              echo "</tr>";
            }
            echo "</tbody>";
            $conn->close();
             ?>
          </table>
        </div>

      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/cr-1.5.5/datatables.min.js"></script>
    <script type="text/javascript" src="admin-table.js"></script>
    <script type="text/javascript" src="admin-unlock.js"></script>
  </body>
 </html>

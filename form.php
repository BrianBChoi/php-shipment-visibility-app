<html>

  <head>
    <title>Binex IT - PHP Form Practice</title>
  </head>

  <body>

    <?php

      $name = $email = $dept = $ticket = $time = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $time = test_input($_POST["time"]);
        $ticket = test_input($_POST["ticket"]);
        $dept = test_input($_POST["dept"]);
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data); // To prevent SQL injection and cross-site scripting
        $data = htmlspecialchars($data);
        return $data;
      }

    ?>

    <h2>Binex IT - PHP Form Practice</h2>

    <form method = "post" action = "/sam/form.php">
      <table>
        <tr>
          <td>Name:</td>
          <td><input type = "text" name = "name"></td>
        </tr>

        <tr>
          <td>E-mail:</td>
          <td><input type = "text" name = "email"></td>
        </tr>

        <tr>
          <td>Time:</td>
          <td><input type = "text" name = "time"></td>
        </tr>

        <tr>
          <td>Ticket details:</td>
          <td><textarea name = "ticket" rows = "5" cols = "23"></textarea></td>
        </tr>

        <tr>
          <td>Dept:</td>
          <td>
            <input type = "radio" name = "dept" value = "imp">Imp
            <input type = "radio" name = "dept" value = "exp">Exp
            <input type = "radio" name = "dept" value = "exp">CSR

          </td>
        </tr>

        <tr>
          <td>
            <input type = "submit" name = "submit" value = "Submit">
          </td>
        </tr>
      </table>
    </form>

    <?php
      echo "<h2>The details are as :</h2>";
      echo $name;
      echo "<br>";

      echo $email;
      echo "<br>";

      echo $time;
      echo "<br>";

      echo $ticket;
      echo "<br>";

      echo $dept;
    ?>

  </body>
</html>

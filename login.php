<!--
Title: login.php
Author: Brian Choi
Updated: 1/27/2022
Version: 1.0.0
Purpose: Login page.
-->

<?php
  include("dbconnect.php");
  include("session.php");

  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);

    // Query db for login credentials
    $sql = "SELECT username, locked FROM briandb.user_logins WHERE username='$myusername' and password='$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    // Admit to main page if the query finds a match. If no match, refresh.
    $count = mysqli_num_rows($result);
    if($count == 1) {
      $locked = $row["locked"];

      if($locked == 0) {
        $sql = "UPDATE briandb.user_logins SET failed_login_count=0 WHERE username='$myusername'";
        $result = mysqli_query($db, $sql);
        $_SESSION['login_user'] = $myusername;
        $_SESSION['logged_time'] = time();
        header("location: main.php");

      } else {
        echo "
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script>alert('Your account has been locked! Please contact your system administrator.');</script>
        ";
      }

    } else {

      $sql = "SELECT username, locked, failed_login_count FROM briandb.user_logins WHERE username='$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);
      if($count == 1) {
        $locked = $row["locked"];

        if(!$locked) {
          $failed_login_count = $row["failed_login_count"] + 1;
          $sql = "UPDATE briandb.user_logins SET failed_login_count='$failed_login_count' WHERE username='$myusername'";
          $result = mysqli_query($db, $sql);

          if($failed_login_count == 3) {
            $locked = 1;
            $sql = "UPDATE briandb.user_logins SET locked='$locked' WHERE username='$myusername'";
            $result = mysqli_query($db, $sql);
          }
        }
      }

      // Page shows nothing and reloads the login page
    }
  }

  // Returns the IP address of the client. To-do: move to separate class file.
  function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
?>

<!-- Script for changing the time displayed in the login form -->
<script>
  var now = new Date(<?php echo time() * 1000 ?>);
  function startInterval(){
    setInterval('updateTime();', 1000);
  }
  startInterval();//start it right away
  function updateTime(){
    var nowMS = now.getTime();
    nowMS += 1000;
    now.setTime(nowMS);
    var clock = document.getElementById('liveclock');
    if(clock){
      clock.innerHTML = now.toTimeString();//adjust to suit
    }
  }
</script>

<html>

	<head>

    <!-- Zooms in for mobile views -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>DAS VISIBILITY</title>

		<style type = "text/css">

      video.fullscreen {
        position: fixed;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
      }

      .container {
        display: grid;
      }

      .content {
        z-index: 1;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-70%);
      }

			body {
				font-family: Arial, Helvetica, sans-serif;
				font-size:16px;
			}

			label {
		     font-weight:bold;
		     width:100px;
		     font-size:14px;
		   }

			.title {
				font-size: 27px;
				color: #27313f;
        text-shadow: 2px 2px 3px #ffecd1;
				text-align: center;
			}

			.box {
				border:#666666 solid 1px;
			}

			.footer {
				position: fixed;
				left: 0;
				bottom: 0;
				width: 100%;
				background-color: #27313f;
				color: #c5cfd9;
				text-align: center;
				font-size:12px;
			}

		</style>

	</head>

	<body>

    <section class="container">
      <video class="fullscreen" src="media/login.mp4" playsinline autoplay muted loop>
      </video>

      <!-- DAS VISIBILITY label and form -->
      <div class="content">
        <div class="title"><h2>DAS VISIBILITY</h2></div>

    		<div align = "center">
    			<!-- Box for form -->
          <div style = "width:300px; border: solid 1px #313e50; background: rgba(255, 255, 255, 0.85)">

    				<!-- Box for form title -->
    				<div style = "background-color:#313e50; color:#FFFFFF; padding:5px;"><b>Binex IT PHP Login</b></div>

            <!-- Live clock -->
            <div id="liveclock" style="padding-top:30px">Binex IT PHP Training - Liveclock Test</div>

            <!-- Show IP Address -->
            <div style="padding-top:30px"><<?php echo getUserIpAddr() . ">"; ?></div>

    				<!-- Form -->
            <div style = "margin:30px">
              <form action = "" method = "post">
                <label>Username :</label><input type = "text" name = "username" class = "box"/><br /><br/>
                <label>Password :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <input type = "submit" value = " Submit "/><br/>
              </form>
              <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
            </div>

          </div>
        </div>
      </div>
    </section>


	</body>

<div class="footer"><p>Binexline Corp. 2021 All rights reserved.</p></div>

</html>

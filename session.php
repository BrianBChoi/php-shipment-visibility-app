<?php
class Session {


  public static function querydb($db, $sql) {

    $result = mysqli_query($db, $sql);
    return mysqli_fetch_array($result,MYSQLI_ASSOC);
  }


  public static function give_access($user_type, $db) {

    self::reset_session_timeout($db);

    $username = $_SESSION['login_user'];
    $sql = "SELECT username FROM briandb.user_logins WHERE username = '$username'";
    if($user_type == "admin") {
      $sql .= " AND user_type = 'admin'";
    }
    $row = self::querydb($db, $sql);

    $_SESSION['login_user'] = $row['username'];

    if(!isset($_SESSION['login_user']) || !self::session_active($db)) {
      header("location:login.php");
      die();
    }
  }


  public static function session_active($db) {

      $timeout = self::get_session_timeout($db);

      if ((time() - $_SESSION['logged_time']) > $timeout) {
        session_destroy();
        header("Location: login.php");
      } else {
        return true;
      }
  }


  public static function get_session_timeout($db) {

    $username = $_SESSION['login_user'];
    $sql = "SELECT session_timeout FROM briandb.user_logins WHERE username = '$username'";
    $row = self::querydb($db, $sql);
    return $row['session_timeout'];
  }


  public static function update_session_timeout($db, $username, $timeout) {

    $timeout *= 60;
    $sql = "UPDATE briandb.user_logins SET session_timeout='$timeout' WHERE username='$username'";
    $result = mysqli_query($db, $sql);
  }


  public static function reset_session_timeout($db) {

    session_start();
    $timeout = self::get_session_timeout($db);
    // unset cookie created from session_start?
    setcookie(session_name(), session_id(), time()+$timeout);
    $_SESSION['logged_time'] = time();
  }

}
?>

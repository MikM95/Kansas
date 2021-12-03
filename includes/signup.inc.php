<?php

if (isset($_POST["submit"])) {


    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $compname = $_POST["compname"];

    require_once 'dbconnect.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($username, $pwd, $pwdrepeat, $compname) !== false) {
      header("location: ../signup.php?error=emptyinput");
      exit();
    }
    if (invalidUid($uid) !== false) {
      header("location: ../signup.php?error=invaliduid");
      exit();
    }
    if (pwdMatch($pwd, $pwdrepeat) !== false) {
      header("location: ../signup.php?error=passwordsmismatch");
      exit();
    }
    if (uidExists($mysqli, $username) !== false) {
      header("location: ../signup.php?error=usernametaken");
      exit();
    }

    createUser($mysqli, $username, $pwd, $compname);


}
else {
  header("location: ../signup.php");
  exit();
}

<?php
require_once 'dbconnect.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {
    $pants = $_POST["pants"];
    $jackets = $_POST["jackets"];
    $shirts = $_POST["shirts"];
    $companyname = $_POST["compname"];
    $companyid = companyidfetch($mysqli, $companyname);

    for ($i=0; (int)$pants > $i; $i++) {
      insert_returned_item($mysqli, $companyid, 1);
    }
    for ($i=0; (int)$jackets > $i; $i++) {
      insert_returned_item($mysqli, $companyid, 2);
    }
    for ($i=0; (int)$shirts > $i; $i++) {
      insert_returned_item($mysqli, $companyid, 3);
    }

    if (emptyInputSignup($pants, $jackets, $shirts, $companyname) !== false) {
       header("location: ../data-upload.php?error=emptyinput");
      exit();
    }



}
else {
  header("location: ../signup.php");
  exit();
}

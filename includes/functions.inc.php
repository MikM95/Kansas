<?php
function performQuery($sql) {
      global $mysqli;
      $result = mysqli_query($mysqli, $sql);

      if($result) {
        // echo "Query success <br>";
        return $result;
        }
      else {
        echo "Der gik noget galt";
        return null;
        }
    }

function emptyInputSignup($username, $pwd, $pwdrepeat, $compname) {
      $result;
      if (empty($username) || empty($pwd) || empty($pwdrepeat) || empty($compname)) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

function invalidUid($username) {
      $result;
      //preg_match er en søge algoritme der tjekker om det inde i de firkantede paranteser er true. linje 32 tjekker om der er brugt noget der ikke passer inden for a-z OG A-Z OG 0-9, pga ! før preg_match tjekker den om det IKKE er rigtigt om de tegn er der aka. den tjekker om der er fejl i brugernavnet i tilfælde af de vil bruge accenter etc.
      if (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

function pwdMatch($pwd, $pwdrepeat) {
      $result;
      if ($pwd !== $pwdrepeat) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

function uidExists($mysqli, $username) {
      $sql = "SELECT * FROM user WHERE username = ?;";
      $stmt = mysqli_stmt_init($mysqli);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
      }

      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);

      $resultdata = mysqli_stmt_get_result($stmt);
        //tjekker om der er data i assoc ($resultdata) OG assigner det til $row på samme tid
      if ($row = mysqli_fetch_assoc($resultdata)) {
        return $row;
      }
      else {
        $result = false;
        return $result;
      }

      mysqli_stmt_close($stmt);
    }

function createUser($mysqli, $username, $pwd, $compname) {
      $sql = "INSERT INTO user (username, password, company_name) VALUES (?, ?, ?);";
      $stmt = mysqli_stmt_init($mysqli);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
      }

      $hashedpassword = password_hash($pwd, PASSWORD_DEFAULT);

      mysqli_stmt_bind_param($stmt, "sss", $username, $hashedpassword, $compname);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      header("location: ../signup.php?error=none");
      exit();
    }

function emptyInputLogin($username, $pwd) {
      $result;
      if (empty($username) || empty($pwd)) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

function loginUser($mysqli, $username, $pwd) {
      $uidExists = uidExists($mysqli, $username, $username);

      if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
      }

      $pwdHashed = $uidExists["password"];
      $checkPwd = password_verify($pwd, $pwdHashed);

      if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
      }
      else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["id"];
        $_SESSION["useruid"] = $uidExists["username"];
        header("location: ../index.php");
        exit();
      }
    }

/* updatetotaldata virker ikke grundet tid, forsøg på løsning startet.
function updatetotaldata($mysqli)
{
// $dbsavedper = performQuery( "SELECT co2_saved_per, water_saved_per, user_id, item_id FROM returned_item INNER JOIN item");
$dbsavedper = performQuery( "SELECT SUM(co2_saved_per * ) as total FROM table WHERE user_id = 7");
if ($dbsavedper->num_rows > 0)
{
  // output data of each row
  while($savedper = mysqli_fetch_assoc($dbsavedper))
  {
    echo $savedper["co2_saved_per"];
    echo $savedper["water_saved_per"];
  }
}   else
    {
      echo "0 results";
    }
}
*/

function displaytotaldata($mysqli, $userid){
    // Shows total water + co2 for logged in user based on userid
    $dbtotaldata = performQuery( "SELECT co2_saved_total, water_saved_total FROM user_data WHERE user_id = $userid");

    if ($dbtotaldata->num_rows > 0)
    {
      // output data of each row
      while($profile = mysqli_fetch_assoc($dbtotaldata))
      {
        echo nl2br("Total mængde Co2 sparet: " . $profile["co2_saved_total"]. " Kg" . "\n \n Water saved total: " . $profile["water_saved_total"] . " L \n \n");
      }
    }   else
        {
          echo "0 results";
        }
}

function displaytotalreturned($mysqli, $userid) {
  //Show total items returned
  $dbtotalreturned = performQuery( "SELECT * FROM returned_item WHERE user_id = $userid");

  if ($dbtotalreturned->num_rows > 0) {

      $totalreturned = mysqli_num_rows ($dbtotalreturned);

      echo "Total antal tøj afleveret: " . $totalreturned . " Stk.";

  } else {
    echo "0 results";
  }
}

function displaycompname($mysqli) {

  $resultSet = $mysqli->query( "SELECT company_name FROM user");

  while ($rows = $resultSet->fetch_assoc())
  {
      $compname = $rows['company_name'];
      echo "<option value='$compname'>$compname</option>";
  }
}

function insert_returned_item($mysqli, $user_id, $item_id) {
  $sql = "INSERT INTO returned_item (user_id, item_id) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($mysqli);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $user_id, $item_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../data-upload.php?error=none");

}

function companyidfetch($mysqli, $companyname) {
  $dbcompanyid = performQuery( "SELECT id FROM user WHERE company_name = '".$companyname."'");
  if ($dbcompanyid->num_rows > 0) {

    while($companyid = mysqli_fetch_assoc($dbcompanyid))
    {
      $compid = $companyid["id"];
    }
      return $compid;

  } else {
    echo "0 results";
  }
}

<?php
include('includes/functions.inc.php');
include('includes/dbconnect.inc.php');
include('templates/header.php');
$userid = $_SESSION["userid"];
?>

<div class="profile">
  <h2>Overblik over bæredygtighedstallene</h2>
    <ul class="displaytotaldata">
      <li><?php
        displaytotaldata($mysqli, $userid);
      ?>
      </li>
      <li><?php
        displaytotalreturned($mysqli, $userid);
      ?>
      </li>
    </ul>
</div>




<?php
include('templates/footer.php')
?>

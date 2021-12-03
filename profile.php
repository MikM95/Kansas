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
    <div class="msg">
      <?php echo nl2br("*Total antal tøj returneret virker og vil opdatere efter en ny upload til firmaet der passer til profilen der er logget ind \n(bruger 'test' hører til tv2 og bruger 'mik' hører til Lego)*") ?>
    </div>
</div>




<?php
include('templates/footer.php')
?>

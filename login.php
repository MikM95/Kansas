<?php
include 'templates/header.php';
 ?>
<div id="frm">
  <section class="signup-form">
    <h2>Log In</h2>
    <div class="signup-form-form">
      <form action="includes/login.inc.php" method="post">
        <input type="text" name="uid" placeholder="Brugernavn/Email">
        <input type="password" name="pwd" placeholder="Password">
        <br>
        <input type="checkbox" name="Remember me">Husk mig</input>
        <br>
        <button type="submit" name="submit">Log ind</button>
      </form>
      <div class="msg">
      <?php echo nl2br("\nFor testning er der oprettet 2 brugere med \nUsername: test \nPassword: test \nOg \n Username:mik \n Password:da\n \n Der kan oprettes nye brugere, men grundet problemer med at opdatere total_saved så vil 'profil' være tomme på nye kontoer"); ?>
      </div>
    </div>
    <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo "<p> Udylf alle felter</p>";
        }
        else if ($_GET["error"] == "wronglogin") {
          echo "<p> Invalid login information</p>";
        }
      }
     ?>
  </section>
</div>
 <?php
 include 'templates/footer.php';
  ?>

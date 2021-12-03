<?php
include('includes/functions.inc.php');
include('includes/dbconnect.inc.php');
include('templates/header.php');
?>
    <div id="frm" class="">
      <section class="">
      <form action="includes/upload.inc.php" method="post" class="data_input">
        <select type="text" name ="compname">
        <?php displaycompname($mysqli) ?>
        </select>
          <br>
        <input type="number" name="pants" placeholder="Antal bukser">
          <br>
        <input type="number" name="jackets" placeholder="Antal jakker">
          <br>
        <input type="number" name="shirts" placeholder="Antal t-shirts">
          <br>
        <button type="submit" target="_blank" name="submit">Upload</button>
      </form>
    <?php
      if (isset($_GET["error"]))
      {
        if ($_GET["error"] == "emptyinput")
        {
          echo "<p> Udfyld alle felter!</p>";
        }
        else if ($_GET["error"] == "none")
        {
          echo "<p> Data uploaded!</p>";
        }
      }
?>

</section>
</div>
<?php
include('templates/footer.php')
?>

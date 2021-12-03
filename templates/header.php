<?php
	session_start();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kansas Workwear</title>
		<link rel="stylesheet" href="css/upload-data.css">
    <link rel="stylesheet" href="css/nav.css">
		<link rel="stylesheet" href="css/profile.css">
		<Body background="img/kansas.png"> </body>
	</head>
	<body>
      <ul class="navigation">
				<?php
					if (isset($_SESSION["useruid"])) {
						echo "<li> <a href='profile.php'>Profil</a> </li>";
		        echo "<li> <a href='includes/logout.inc.php'>Log ud</a> </li>";
						echo "<li> <a href='data-upload.php'>Upload data</a> </li>";
					}
					else {
						echo "<li> <a href='signup.php'>Sign up</a> </li>";
		        echo "<li> <a href='login.php'>Log ind</a> </li>";
					}
				 ?>
      </ul>

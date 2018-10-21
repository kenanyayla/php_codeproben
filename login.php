<?php
session_start();
$verhalten = 0;
$message = "";

require 'database.php';

if (!isset($_SESSION[ 'username' ])) {
	$verhalten = 0;
} else {
	$verhalten = 3;
}

if ( $_GET[ 'page' ] == "login" ) {
	
	$user = $_POST[ "username" ];
	$pass = $_POST[ "password" ];
	
	if(!empty($user) && !empty($pass)) {
	
	if(isset($user) && isset($pass)) {

	
	if (($user == "user1" and $pass == "geheim") or ($user == "user2" and $pass == "geheim")) {
		$_SESSION[ "username" ] = $user;
		$verhalten = 1;
		$message = "Erfolgreich angemeldet!";

	} else {
		$verhalten = 2;
		$message = "Nutzername oder Passwort stimmt nicht überein!";
	}
		
	} else {
		if(!isset($_SESSION[ 'username' ])) {
		$verhalten = 0;
	} else {
		$verhalten = 3;
	}
	}
		
	} else {
		$message = "Nutzername oder Passwort darf nicht leer sein!";
	}
}

?>
<!doctype html>
<html>

<head>
	<?php
	if ( $verhalten == 1 ) {
		?>
	<meta http-equiv="refresh" content="3; URL=übersicht.php">
	<?php
	}
	?>
	<?php
	if ( $verhalten == 3 ) {
		?>
	<meta http-equiv="refresh" content="0; URL=übersicht.php">
	<?php
	}
	?>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<title>Generator - VypeMC.net</title>
</head>
<body>
	<div align="center">

		<form method="post" action="login.php?page=login">

			<a href="http://vypemc.net"><img src="img/background.jpg" alt="Logo_here" class="round"></a>
			<br> </br>

			<?php if(!empty($message)): ?>
			<p class="text2">
				<?= $message ?>
			</p>
			<br>
			<?php endif; ?>
			<a class="icons" id="space"> <i class="fa fa-user" aria-hidden="true"></i></a>
			<input type="text" name="username" placeholder="Username">
			<br>
			<a class="icons"><i class="fa fa-key" aria-hidden="true"></i></a>
			<input type="password" name="password" placeholder="*********">

			<br> <br>
			<br>
			<center> <input type="submit" value="Login" class="button">
			</center>
		</form>
	</div>
</body>

</html>
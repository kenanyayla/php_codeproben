<?php
//MYSQL
require 'database.php';

//POST
$name = $_POST["name"];
$challenge = $_POST["challenge"];
$bestrafung = $_POST["bestrafung"];

//Others
$complete = 0;
$message = "empty";
$ip = $_SERVER['REMOTE_ADDR'];
$form = $_GET['post'];

//DATE
$time = time();

$name = trim($name); $challenge = trim($challenge); $bestrafung = trim($bestrafung);

if($form == "send") {

	if(empty($name) or empty($challenge) or empty($bestrafung)) {
		$message = "Alle Felder müssen ausgefühlt sein!";
	} else {
		
		$complete = 1;
		$message = "Vielen dank $name! Deine Challenge wurde erfolgreich übermittelt.";
		
		$statement = $conn->prepare("INSERT INTO koqsg (name, ip, challenge, bestrafung, uhrzeit) VALUES (?, ?, ?, ?, ?)");
		$statement->execute(array($name, $ip, $challenge, $bestrafung , date("d/m/Y @ g:i:sA", $time)));
	}
	
}

function reset() {
	$complete = 0;
	$message = "empty";
	$name = "";
	$challenge = "";
	$bestrafung = "";
}
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<title>King of QSG - Ideen</title>
</head>

<body>
	<div align="center">
		<form method="post" action="index.php?post=send#message">
			<img src="img/background.jpg" class="round">
			<br> </br>
			<?php if($complete !== 1 and $message != "empty"): ?>
			<meta http-equiv="refresh" content="8; URL=index.php#message">
			<div id="message" class="overlay">
				<div class="popup">
					<h2>Es ist ein Fehler aufgetreten:</h2>
					<a class="close" href="index.php">&times;</a>
					<div class="content">
					<h4 style="color: #A20002">
						<?php $message?>
					</h4>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if($complete === 1 and $message != "empty"): ?>
			<meta http-equiv="refresh" content="8; URL=index.php#message">
			<div id="message" class="overlay">
				<div class="popup">
					<h2>Erfolgreich:</h2>
					<a class="close" href="index.php">&times;</a>
					<div class="content">
					<h4 style="color: #A20002">
						<?php $message?>
						<?php foo() ?>
						</h4>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			
			<input type="text" name="name" placeholder="Name" maxlength="16">
			<textarea type="text" name="challenge" placeholder="Challenge" maxlength="500"></textarea>
			<textarea type="text" name="bestrafung" placeholder="Bestrafung" maxlength="500"></textarea>
			<br></br>
			<center> <input type="submit" value="Einsenden" class="einsenden"> </center>


		</form>
	</div>
</body>

</html>
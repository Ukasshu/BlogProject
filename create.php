<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" title="Dzienny"/>
	<link rel="stylesheet" type="text/css" href="style2.css" title="Nocny" disabled/>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'/>
	<title>Zakładanie bloga</title>
</head>
<body>
	<div id="header">
		<?php
			include("blogheader.php");
		?>
	</div>
	<div id="content">
		<h2>Tworzenie nowego bloga</h2>
		<form action="nowy.php" method="post">
			Login:<br/>
			<input type="text" name="login" size="40" placeholder="Login"><br/>
			Hasło:<br/>
			<input type="password" name="password" size="40" placeholder="Hasło"><br/>
			Tytuł bloga:<br/>
			<input type="text" name="title" size="40" placeholder="Tytuł"><br/>
			Opis bloga:<br/>
			<textarea name="description" rows="5" cols="40" placeholder="Opis"></textarea><br/>
			<input type="submit"> <input type="reset">
			<br/><br/>
		</form>
	</div>
	<div id="footer">
		<?php
			include("chat.php");
		?>
	</div>
</body>
</html>
<script type="text/javascript" src="styles.js"></script>
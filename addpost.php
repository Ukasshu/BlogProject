<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" title="Dzienny"/>
	<link rel="stylesheet" type="text/css" href="style2.css" title="Nocny" disabled/>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'/>
	<title><?php 
		if(isset($_GET['nazwa']) && is_dir($_GET['nazwa'])){
			echo $_GET['nazwa'];
		}
		else{
			echo "Błąd!";
		}
	?>
	</title>
</head>
<body>
	<div id="header">
		<?php
			include("blogheader.php");
		?>
	</div>
	<div id="content">
		<?php
			include('addpostcontent.php');
		?>
	</div>
	<div id="footer">
	<?php
		include("chat.php");
	?>		
	</div>
</body>
</html>
<script type="text/javascript" src="styles.js"></script>
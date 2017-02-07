<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" title="Dzienny"/>
	<link rel="stylesheet" type="text/css" href="style2.css" title="Nocny" disabled/>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'/>
	<title>
		<?php
			if(isset($_GET['nazwa']) && is_dir($_GET['nazwa'])){
				echo $_GET['nazwa']." - Blog";
			}else{
				echo "Błąd - Niepoprawny adres bloga";
			}
		?>
	</title>
</head>
<body>
	<div id="header">
		<?php
			include 'blogheader.php';
		?>
	</div>
	<div id="content">
		<?php 
			if(!isset($_GET['nazwa']) && !is_dir($_GET['nazwa']) && !isset($_GET['post']) && !file_exists($_GET['nazwa'].'/'.$_GET['post'])){
				echo "<h2>Błąd!</h2>";
				echo "<p>Chyba zabłądziłeś</p>";
			}
			elseif (isset($_POST['comment']) && empty($_POST['comment'])) {
				echo "<h2>Błąd!</h2>";
				echo "<p>Próbowałeś dodać pusty komentarz!</p>";	
			}
			elseif(isset($_POST['username']) && empty($_POST['username'])){
				echo "<h2>Błąd!</h2>";
				echo "<p>Weźże się przedstaw człowieku! xD</p>";
			}elseif(!isset($_POST['type']) || !isset($_POST['comment']) || !isset($_POST['username'])){
				echo "<h2>Błąd!</h2>";
				echo "<p>Chyba zabłądziłeś</p>";
			}
			else{
				$sem = fopen($_GET['nazwa'].'/komsemafor', 'w+');
				if(flock($sem, LOCK_EX)){
					//SEKCJA KRYTYCZNA////////////
					if(!is_dir($_GET['nazwa'].'/'.$_GET['post'].'.k')){
						mkdir($_GET['nazwa'].'/'.$_GET['post'].'.k');
					}
					$filenumber = 0;
					while(file_exists($_GET['nazwa'].'/'.$_GET['post'].'.k/'.strval($filenumber))){
						$filenumber++;
					}
					$handle = fopen($_GET['nazwa'].'/'.$_GET['post'].'.k/'.strval($filenumber), "w");
					fwrite($handle, $_POST['type']."\r\n");
					fwrite($handle, date('Y-m-d H:i:s')."\r\n");
					fwrite($handle, $_POST['username']."\r\n");
					fwrite($handle, $_POST['comment']);
					fclose($handle);
					echo "<h2>Sukces</h2>";
					echo "<p>Pomyślnie dodano komentarz</p>";
					/////////////////////
					flock($sem, LOCK_UN);
					fclose($sem);
				}
				else{
					echo "<h2>Błąd</h2>";
					echo "<p>Nastąpił nieoczekiwany błąd podczas dodawania komentarza</p>";
				}
			}
			echo "<p><a href='".$_SERVER['HTTP_REFERER']."'>POWRÓT...</a></p>"
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
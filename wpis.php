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
			if(isset($_GET['nazwa']) && is_dir($_GET['nazwa'])) {

				if(isset($_GET['post']) && file_exists($_GET['nazwa'].'/'.$_GET['post'])){
					echo "<h2>".substr($_GET['post'], 0, 4).'-'.substr($_GET['post'], 4, 2).'-'.substr($_GET['post'], 6, 2).' '.substr($_GET['post'], 8, 2).':'.substr($_GET['post'], 10, 2).':'.substr($_GET['post'], 12, 2)."</h2>";
					echo "<div id='post'>";
					$post = file($_GET['nazwa'].'/'.$_GET['post']);
					foreach ($post as $line) {
						echo "<p>".$line."</p>";
					}
					$files = scandir($_GET['nazwa']);
					$i = 1;
					foreach (glob($_GET['nazwa']."/".$_GET['post']."[1-3]*") as $name) {
						echo "<p><a href='".$name."'>Załącznik ".strval($i)."</a></p>";
						$i++;
					}
					echo "</div>";
					echo "<div id=comments>";
					echo "<h3>Komentarze</h3>";
					echo "<form method='post' action='koment.php?nazwa=".urlencode($_GET['nazwa'])."&post=".urlencode($_GET['post'])."'>
							<b>Dodaj nowy komentarz</b><br/>
							<textarea name='comment' rows='5' cols='40' placeholder='Komentarz'></textarea></br>
							<input type='text' name='username' placeholder='Nazwa komentującego'>
							<select name='type'>
								<option value='Neutralny'>Neutralny</option>
								<option value='Pozytywny'>Pozytywny</option>
								<option value='Negatywny'>Negatywny</option>
							</select><br/>
							<input type='submit'>
							<input type='reset'>
						</form>
					";
					if(is_dir($_GET['nazwa'].'/'.$_GET['post'].'.k')){
						$comments = scandir($_GET['nazwa'].'/'.$_GET['post'].'.k');
						foreach ($comments as $comment) {
							if ($comment != '.' && $comment != '..') {
								$to_print = file($_GET['nazwa'].'/'.$_GET['post'].'.k/'.$comment);
								echo "<div id='com'>",
									 "<p><b>".$to_print[0]."     ".$to_print[1]."</b></p>",
								 	"<p>Nazwa użytkownika:".$to_print[2]."</p>";
								for ($j=3; $j <sizeof($to_print) ; $j++) { 
								echo "<p>".$to_print[$j]."</p>";
								}
							}
							
						}
					}
					echo "</div>";
				}
				else{
					echo "<h2>Błąd!</h2>";
					echo "<p>Próbujesz wyświetlić zawartość nieistniejącego posta!</p>";
				}

			}
			else{
				echo "<h2>Błąd!</h2>";
				echo "<p>Próbujesz wyświetlić zawartość nieistniejącego bloga!</p>";
			}
		?>
	</div>
	<div id="footer">
		<?php
			include("chat.php");
		?>
	</div>
	<script type="text/javascript" src="styles.js"></script>
</body>
</html>

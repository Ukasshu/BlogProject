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
			include("header.php");
		?>
	</div>
	<div id="content">
		<?php
			if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['title']) && isset($_POST['description'])){
				$files = scandir('.');
				$flaga = true;
				foreach($files as $file){
					if(is_dir($file) && $file!='.' && $file!='..'){
						$info = file($file.'/info');
						if($info[0]==$_POST['login']."\n") {
								$flaga = false;
								break;
							}
					}
				}
			if($flaga==true){
				$sem = fopen('blogsemafor', 'r+');
				if(flock($sem, LOCK_EX)){
					//SEKCJA KRYTYCZNA////////////////////
					if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['title']) && !empty($_POST['description'])){
							if (file_exists($_POST['title'])) {
								echo "<h2>Błąd zakładania bloga</h2>", "<p>Blog o tej nazwie już istnieje</p>";
							}else{
								mkdir($_POST['title']);
								$info_file = fopen($_POST['title']."/info", "w");
								fwrite($info_file, $_POST['login']."\n");
								fwrite($info_file, md5($_POST['password'])."\n");
								fwrite($info_file, $_POST['description']);
								fclose($info_file);
								echo "<h2>Sukces</h2>",'<p>Twój blog został utworzony.<br/>Możesz znaleźć go <a href="blog.php?nazwa='.urlencode($_POST['title']).'">TUTAJ</a></p>';
							}
					}else{
						echo "<h2>Błąd zakładania bloga</h2>", "<p>Uzupełnij wszystkie brakujące dane</p>";
					}
					////////////////////////////
					flock($sem, LOCK_UN);
					fclose($sem);
				}
				else{
					echo "<h2>Błąd</h2>";
					echo "Wystąpił nieoczekiwany błąd podczas tworzenia bloga";
				}
			}else{
									echo "<h2>Błąd</h2>";
					echo "Użytkownik o tej nazwie już istnieje";
				
			}
			}else{
				echo "Brak dostępu!","<p>Something went wrong.</p>";
			}
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
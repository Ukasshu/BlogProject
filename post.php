<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" title="Dzienny"/>
	<link rel="stylesheet" type="text/css" href="style2.css" title="Nocny" disabled/>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'/>
	<title>Dodawanie posta</title>
</head>
<body>
	<div id="header">
		<?php
			include("blogheader.php");
		?>
	</div>
	<div id="content">
		<?php
			if(isset($_POST['login']) && isset($_POST['password']) &&  isset($_POST['body']) && isset($_POST['date']) && isset($_POST['time'])){
				if(!empty($_POST['login']) && !empty($_POST['password']) &&  !empty($_POST['body']) && !empty($_POST['date']) && !empty($_POST['time'])){
					$file = "";
					$files = scandir('.');
					foreach($files as $file){
						if(is_dir($file) && $file!='.' && $file!='..'){
							$info = file($file.'/info');
							if($info[0] == $_POST['login']."\n" && $info[1]==md5($_POST['password'])."\n"){
								break;
							}
						}
					}
					if($info[0]==$_POST['login']."\n" && $info[1]==md5($_POST['password'])."\n"){
						$newfilename = substr($_POST['date'], 0, 4).substr($_POST['date'], 5, 2).substr($_POST['date'], 8, 2).substr($_POST['time'], 0, 2).substr($_POST['time'], 3, 2).date('s');
						$id = 0;
						$tmp = $newfilename.'00';
						$sem = fopen($file.'/postsemafor', 'w+');
						if(flock($sem, LOCK_EX)){
							//SEKCJA KRYTYZCNA///////
							while(file_exists($file.'/'.$tmp)){
								$id++;
								if($id<10){
									$tmp = $newfilename.'0'.strval($id);
								}
								else{
									$tmp = $newfilename.strval($id);
								}
							}
							$newfilename = $file.'/'.$tmp;
							unset($tmp);
							unset($id);
							$handle = fopen($newfilename, 'w');
							fwrite($handle, $_POST['body']);
							fclose($handle);
							$ct=1;
							for ($i=1; $i <=3 ; $i++) { 
								if($_FILES['userfile'.$i]['error'] == 0){
									$info = pathinfo($_FILES['userfile'.$i]['name']);
									$ext = $info['extension'];
									$newname = $newfilename.strval($ct).'.'.$ext;
									move_uploaded_file($_FILES['userfile'.$i]['tmp_name'], $newname);
									$ct++;
								}
							}
							echo "<h2>Sukces!</h2>";
							echo "<p>Twój post został dodany!</p>";
							//////////////////
							flock($sem, LOCK_UN);
							fclose($sem);
						}
						else{
							echo "<h2>Błąd!!</h2>";
							echo "<p>Nastąpił nieoczekiwany błąd</p>";
						}
					}else{
						echo "<h2>Błąd!!!</h2>";
						echo "<p>Niepoprawne dane logowania</p>";
					
}				}
			}	
			else{
				echo "<h2>Błąd!</h2>","<p>Chyba zabłądziłeś xD</p>";
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
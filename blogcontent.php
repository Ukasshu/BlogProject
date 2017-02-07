<?php
	if(isset($_GET['nazwa']) && is_dir($_GET['nazwa'])){
		echo "<h2>Posty na tym blogu</h2>";
		$i = 0;
		foreach (scandir($_GET['nazwa']) as $file) {
			if($file!='info' && !is_dir($file) && strlen($file)==16){
				$i++;
				echo "<h3>".substr($file, 0, 4).'-'.substr($file, 4, 2).'-'.substr($file, 6, 2).' '.substr($file, 8, 2).':'.substr($file, 10, 2).':'.substr($file, 12, 2)."</h3>";
				$arr = file($_GET['nazwa'].'/'.$file);
				echo "<p>".$arr[0]."</p>",
					 "<a href='wpis.php?nazwa=".urlencode($_GET['nazwa'])."&post=".$file."''>Czytaj dalej...</a>";
			}
		}
		if($i == 0){
				echo "<p>Brak postów na tym blogu</p>";
			}
	}
	elseif (!isset($_GET['nazwa'])) {
		echo "<h2>Założone blogi</h2>";
			$files = scandir('.');
			$i=0;
			foreach ($files as $file) {
				if(is_dir($file) && $file!='.' && $file!='..'){
					echo "<a href='blog.php?nazwa=".urlencode($file)."'>".$file."</a><br/>";
					$i++;
				}
			}
			if($i==0){
				echo "<p>Brak</p><p><a href='create.php'>Bądź pierwszy</a></p>";
			}
			echo "<br/>";
	}
	else{
		echo "<p>Blog o takim adresie nie istnieje.</p>";
	}
?>
<?php
	if(isset($_GET['nazwa']) && is_dir($_GET['nazwa'])){
		echo "<h1>".$_GET['nazwa']."</h1>";
		$info = file($_GET['nazwa']."/info");
		for ($i=2; $i < sizeof($info); $i++) { 
			echo "<p>".$info[$i]."</p>";
		}

		echo '<div id="menu">
				<ul>
					<li><a href="blog.php?nazwa='.urlencode($_GET['nazwa']).'"><div>Strona główna</div></a></li>
					<li><a href="addpost.php"><div>Dodaj post</div></a></li>
					<li><a href="blog.php"><div>Wszystkie blogi</div></a></li>
				</ul>
			  </div>';
	}
	else {
		echo '<h1>Załóż swojego bloga</h1>
		<div id="menu">
			<ul>
				<li><a href="blog.php"><div>Wszystkie blogi</div></a></li>
				<li><a href="create.php"><div>Załóż bloga</div></a></li>
			</ul>
		</div>';
	}
?>

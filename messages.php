<?php
	$filename = "chat.txt";
		$file = file($filename);
		echo implode("\n", $file);
?>
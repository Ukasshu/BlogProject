<?php

	$filename = "chat.txt";
	$lines = count(file($fileName));
	$filedata = file_get_contents($filename);
	$file = fopen($filename, "w+");
	$msg = $_GET["nickname"].": ".$_GET["message"]."\n";

	fwrite($file, $msg);
	fwrite($file, $filedata);
	fclose($file);
	if ($lines > 20) { 
		$file = file($fileName);
		unset($file[$lines]);
		file_put_contents($fileName, $file);
	}

?>
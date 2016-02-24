<?php
	$username = $_GET["id"];
	$path = "./db/$username";

	if (is_dir($path)) {
		$files = glob($path . '/*');
		foreach ($files as $file) {
			unlink($file);
		}
		rmdir($path);
	}
	header("Location:http://robert.vkhk.ee/~kert.sindi/leht/kirjed.php");
	die();
?>
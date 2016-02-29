<?php
	require "db-api.php";
	
	kustuta($_GET["id"]);

	header("Location:http://robert.vkhk.ee/~kert.sindi/leht/kirjed.php");
	die();
?>
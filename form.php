<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	require "db-api.php";
	$ankeet = array(
		"uname" => $_POST['uname'],
		"fname" => $_POST['fname'],
		"lname" => $_POST['lname'],
		"email" => $_POST['email'],
		"vanus" => $_POST['vanus'],
		"tel" => $_POST['usrtel'],
		"markused" => $_POST['markused'],
		"pilt" => $_FILES['img']['tmp_name']);

	if (isset($_GET["id"])) {
		$ankeet["id"] = $_GET["id"];
		$ankeet["aeg"] = $_POST['aeg'];
		muutmine($ankeet);
	}
	else {
		loomine($ankeet);
	}
	
	header("Location:http://robert.vkhk.ee/~kert.sindi/leht/kirjed.php");
	die();	
?>
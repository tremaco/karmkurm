<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	$uname=$_POST['uname'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$tel=$_POST['usrtel'];
	$vanus=$_POST['vanus'];
	$markused=$_POST['markused'];
	$file=$_FILES['img']['tmp_name'];

	$kodurada = "./db";
	$dirmassiiv = glob($kodurada. "/*", GLOB_ONLYDIR);
	if (count($dirmassiiv) != 0) {
	   $praemax = "";
	   foreach ($dirmassiiv as $dir){
		  if ( basename($dir) > $praemax){
			 $praemax = basename($dir);
		  } 
	   }
	   
	   if (isset($_GET["id"])) {
		  $id = $_GET["id"];
	   }
	   else {
		  $id = $praemax + 1;
	   }
	} 
	else{
	   $id = 0;
	} 

	$dir = 'db/'.$id;
	if ( !file_exists($dir) ){
		$vana = umask(0);
		mkdir ($dir, 0777, true);
		umask($vana);
	}

	$kasutajainfo = fopen($dir.'/ankeet.json','w');
	$ankeet[] = array(
		"id" => $id,
		"uname" => $uname,
		"fname" => $fname,
		"lname" => $lname,
		"email" => $email,
		"vanus" => $vanus,
		"tel" => $tel,
		"markused" => $markused); 

	move_uploaded_file($file, $dir.'/pilt.jpg');
	fwrite($kasutajainfo, json_encode($ankeet));
	fclose($kasutajainfo);

	header("Location:http://robert.vkhk.ee/~kert.sindi/leht/kirjed.php");
	die();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Üksikvaade</title>
</head>
<body>
	<?php
		$username = $_GET["id"];
		$path = "./db/$username";
		$imgPath = "$path/pilt.jpg";
		$dataPath = "$path/ankeet.json";
		$json = file_get_contents($dataPath);
		$userData = json_decode($json, true);
		$userData = $userData[0];
		$userData["aeg"] = strftime("%d/%m/%Y %H:%M", $userData["aeg"]);
		//print_r($userData);
		print '<img src="' . $imgPath . '" height="100" width="100">'. "<br>";
		print "Kasutajanimi : ". $userData["uname"]. "<br>";
		print "Eesnimi : ". $userData["fname"]. "<br>";
		print "Perekonnanimi : ". $userData["lname"]. "<br>";
		print "Vanus : ". $userData["vanus"]. "<br>";
		print "e-mail : ". $userData["email"]. "<br>";
		print "Telefoninumber : ". $userData["tel"]. "<br>";
		print "Märkused : ". $userData["markused"]. "<br>";
		print "Loomisaeg : ". $userData["aeg"];
	?>
</body>
</html>
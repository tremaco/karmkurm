<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Üksikvaade</title>
</head>
<body>
	<?php
		require "db-api.php";
		$id = $_GET["id"];
		$kasutajainfo = profiilikuva($id);
		
		print '<img src="' . "./db/$id/pilt.jpg" . '" height="100" width="100">'. "<br>";
		print "Kasutajanimi : ". $kasutajainfo["uname"]. "<br>";
		print "Eesnimi : ". $kasutajainfo["fname"]. "<br>";
		print "Perekonnanimi : ". $kasutajainfo["lname"]. "<br>";
		print "Vanus : ". $kasutajainfo["vanus"]. "<br>";
		print "e-mail : ". $kasutajainfo["email"]. "<br>";
		print "Telefoninumber : ". $kasutajainfo["tel"]. "<br>";
		print "Märkused : ". $kasutajainfo["markused"]. "<br>";
		print "Loomisaeg : ". $kasutajainfo["aeg"];
	?>
</body>
</html>
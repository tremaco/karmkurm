<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Muutmine</title>
</head>
<body>
	<?php		
		require "db-api.php";
		$id = $_GET["id"];
		$kasutajainfo = profiilikuva($id);
	?>

	<form action="form.php?id=<?php print $kasutajainfo["id"]; ?>" method="post" enctype="multipart/form-data">
		Kasutajanimi: <input type="text" name="uname" value="<?php print $kasutajainfo["uname"]; ?>" required><br>
		Eesnimi: <input type="text" name="fname"  value="<?php print $kasutajainfo["fname"]; ?>" required><br>
		Perenimi: <input type="text" name="lname"  value="<?php print $kasutajainfo["lname"]; ?>"required><br>
		Vanus: <input value="Täiskasvanu" type="radio" name="vanus" <?php print ($kasutajainfo["vanus"] == "Täiskasvanu" ? "checked" : ""); ?> required>Täiskasvanu
			   <input value="Alaealine" type="radio" name="vanus" <?php print ($kasutajainfo["vanus"] == "Alaealine" ? "checked" : ""); ?> required>Alaealine<br>
		E-mail: <input type="email" name="email" value="<?php print $kasutajainfo["email"]; ?>"required><br>
		Telefon: <input type="text" name="usrtel" value="<?php print $kasutajainfo["tel"]; ?>"required><br>
		Loomisaeg: <?php print $kasutajainfo["aeg"]; ?><br>
		Lisa pilt:<br>
		<img src="<?php print "./db/$id/pilt.jpg"; ?>" height="100" width="100"><br>
		<input type="file" name="img" accept="image/*"><br>
		<textarea rows="3" name="markused" placeholder="Märkused" required><?php print $kasutajainfo["markused"]; ?></textarea><br>
		<input type="hidden" name="aeg" value="<?php print $kasutajainfo["aeg"]; ?>">
		<input type="submit" value="Salvesta">
	</form>
</body>
</html>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Muutmine</title>
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
	?>

	<form action="form.php?id=<?php print $userData["id"]; ?>" method="post" enctype="multipart/form-data">
		Kasutajanimi: <input type="text" name="uname" value="<?php print $userData["uname"]; ?>" required><br>
		Eesnimi: <input type="text" name="fname"  value="<?php print $userData["fname"]; ?>" required><br>
		Perenimi: <input type="text" name="lname"  value="<?php print $userData["lname"]; ?>"required><br>
		Vanus: <input value="Täiskasvanu" type="radio" name="vanus" <?php print ($userData["vanus"] == "Täiskasvanu" ? "checked" : ""); ?> required>Täiskasvanu
			   <input value="Alaealine" type="radio" name="vanus" <?php print ($userData["vanus"] == "Alaealine" ? "checked" : ""); ?> required>Alaealine<br>
		E-mail: <input type="email" name="email" value="<?php print $userData["email"]; ?>"required><br>
		Telefon: <input type="text" name="usrtel" value="<?php print $userData["tel"]; ?>"required><br>
		Lisa pilt:<br>
		<img src="<?php print $imgPath; ?>" height="100" width="100"><br>
		<input type="file" name="img" accept="image/*" id="img"><br>
		<textarea rows="3" name="markused" placeholder="Märkused" required><?php print $userData["markused"]; ?></textarea><br>
		<input type="submit" value="Salvesta">
	</form>
</body>
</html>
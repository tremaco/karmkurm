<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kirjed</title>
</head>
<body>
	<?php
	$kogutoodang = '<table>';
	foreach (glob("./db/*",GLOB_ONLYDIR) as $dirPath) {
	  $imgPath = "$dirPath/pilt.jpg";
	  $dataPath = "$dirPath/ankeet.json";
	  $json = file_get_contents($dataPath);
	  $userData = json_decode($json, true);
	  $userData = $userData[0];
		
	  $kogutoodang .= '
		<tr>
		  <td>' . $userData["id"] . '</td>
		  <td>
			<a href="' . $imgPath . '">
			  <img src="' . $imgPath . '" height="30" width="30">
			</a>
		  </td>
		  <td>' . $userData["lname"] . '</td>
		  <td>
			<a href="yksikkirje.php?id=' . 
			$userData["id"] . '">Vaade</a>
			<a href="muuda.php?id=' . 
			$userData["id"] . '">Muuda</a>
			<a href="kustuta.php?id=' . 
			$userData["id"] . '">Kustuta</a>
		  </td>
		</tr>';
	}
	$kogutoodang .= '</table>';
	print $kogutoodang;
	?>
</body>
</html>
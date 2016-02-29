<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kirjed</title>
</head>
<body>
	<?php
	require "db-api.php";
	$kasutajad = koonduslaager();
	
	$kogutoodang = '<table>';
	foreach ($kasutajad as $kasutaja) {
	  $kogutoodang .= '
		<tr>
		  <td>' . $kasutaja["id"] . '</td>
		  <td>
			<img src="db/' . $kasutaja["id"] . '/pilt.jpg" height="30" width="30">
		  </td>
		  <td>' . $kasutaja["lname"] . '</td>
		  <td>
			<a href="yksikkirje.php?id=' . 
			$kasutaja["id"] . '">Vaade</a>
			<a href="muuda.php?id=' . 
			$kasutaja["id"] . '">Muuda</a>
			<a href="kustuta.php?id=' . 
			$kasutaja["id"] . '">Kustuta</a>
		  </td>
		</tr>';
	}
	$kogutoodang .= '</table>';
	print $kogutoodang;
	?>
</body>
</html>
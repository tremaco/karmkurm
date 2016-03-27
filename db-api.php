<?php
date_default_timezone_set("Europe/Tallinn");
function salvesta_API($item) {
	$ans1 = $item["ans1"];
	$ans2 = $item["ans2"];
	$ans3 = $item["ans3"];
	$ans4 = $item["ans4"];
	$ans5 = $item["ans5"];
	$id = file_get_contents("id.txt");
	$aeg = strftime("%d.%m.%Y %X");
	$data = json_decode(file_get_contents("andmed.json"), true);
	$data[] = array(
		"id" => $id,
		"ans1" => $ans1,
		"ans2" => $ans2,
		"ans3" => $ans3,
		"ans4" => $ans4,
		"ans5" => $ans5,
		"aeg" => $aeg,);
	file_put_contents("andmed.json", json_encode($data, JSON_PRETTY_PRINT));
	$id = $id+1;
	file_put_contents("id.txt", $id);
	return true;
}
function vaata_API($key) {
	$item = json_decode(file_get_contents("andmed.json"), true);
	$item = $item[$key];    
	return $item; 
}
function muuda_API($item) {
	$id = $item["id"];
	$ans1 = $item["ans1"];
	$ans2 = $item["ans2"];
	$ans3 = $item["ans3"];
	$ans4 = $item["ans4"];
	$ans5 = $item["ans5"];
	$id = intval($id);
	$aeg = strftime("%d.%m.%Y %X");
	$data = json_decode(file_get_contents("andmed.json"), true);
	$data[$id] = array(
		"id" => $id,
		"ans1" => $ans1,
		"ans2" => $ans2,
		"ans3" => $ans3,
		"ans4" => $ans4,
		"ans5" => $ans5,
		"aeg" => $aeg,);
	file_put_contents("andmed.json", json_encode($data, JSON_PRETTY_PRINT));
	return true;
}
function kustuta_API($id) {
	$item = json_decode(file_get_contents("andmed.json"), true);
	$id = $id["id"];
	$item[$id] = [];
	file_put_contents("andmed.json", json_encode($item, JSON_PRETTY_PRINT));
	return true;
}
function list_API() {
	$items = json_decode(file_get_contents("andmed.json"), true);
	return $items;	
}
function loomine($kasutajainfo) {
		$username = $kasutajainfo["uname"];
		$fname = $kasutajainfo["fname"];
		$lname = $kasutajainfo["lname"];
		$email = $kasutajainfo["email"];
		$tel = $kasutajainfo["tel"];
		$vanus = $kasutajainfo["vanus"];
		$markused = $kasutajainfo["markused"];
		$file = $kasutajainfo["pilt"];
		
		$kodurada = "./db";
		$kaustad = glob($kodurada . "/*", GLOB_ONLYDIR);
		if (count($kaustad) != 0) {        
			$praemax = "";
			foreach ($kaustad as $kaust) {
				if (basename($kaust) > $praemax)
				{
				$praemax = basename($kaust);
				}
			}
			$id = $praemax + 1;
		}
		else {
			$id = 0;
		}
		$kaust = 'db/'.$id;
		if ( !file_exists($kaust) ){
			$vana = umask(0);
			mkdir ($kaust, 0777, true);
			umask($vana);
		}
		$aeg = time();
		$kasutajainfo = fopen($kaust.'/ankeet.json','w');
		$ankeet[] = array(
		"id" => $id,
		"uname" => $username,
		"fname" => $fname,
		"lname" => $lname,
		"email" => $email,
		"vanus" => $vanus,
		"tel" => $tel,
		"markused" => $markused,
		"aeg" => $aeg);
		move_uploaded_file($file, $kaust.'/pilt.jpg');
		fwrite($kasutajainfo, json_encode($ankeet));
		fclose($kasutajainfo);
	}
	
function muutmine($kasutajainfo) {
		$id = $kasutajainfo["id"];
		$username = $kasutajainfo["uname"];
		$fname = $kasutajainfo["fname"];
		$lname = $kasutajainfo["lname"];
		$email = $kasutajainfo["email"];
		$tel = $kasutajainfo["tel"];
		$vanus = $kasutajainfo["vanus"];
		$markused = $kasutajainfo["markused"];
		$aeg = strtotime(str_replace('/', '-', $kasutajainfo["aeg"]));
		$file = $kasutajainfo["pilt"];
		$kodurada = "./db/$id";
		$kasutajainfo = fopen($kodurada.'/ankeet.json','w');
		$ankeet[] = array(
			"id" => $id,
			"uname" => $username,
			"fname" => $fname,
			"lname" => $lname,
			"email" => $email,
			"vanus" => $vanus,
			"tel" => $tel,
			"markused" => $markused,
			"aeg" => $aeg);
		move_uploaded_file($file, $kodurada.'/pilt.jpg');
		fwrite($kasutajainfo, json_encode($ankeet));
		fclose($kasutajainfo);
	}
    
 function profiilikuva($id) {
    $dataPath = "./db/$id/ankeet.json";
    $json = file_get_contents($dataPath);
    $kasutajainfo = json_decode($json, true);
	$kasutajainfo = $kasutajainfo[0];
    $kasutajainfo["aeg"] = strftime("%d/%m/%Y %H:%M", $kasutajainfo["aeg"]);
    return $kasutajainfo;
  }
  
 function koonduslaager() {
    $kasutajad = [];
    $i = 0;
    
    foreach (glob('./db/*', GLOB_ONLYDIR) as $db) {
		$id = filter_var($db, FILTER_SANITIZE_NUMBER_INT);
		$kasutajad[$i] = profiilikuva($id);
		$i++;
    }
    return $kasutajad;
  }
 function kustuta($id) {
    $kodurada = "./db/$id";
    if (is_dir($kodurada)) {
      $files = glob($kodurada . "/*");
      foreach ($files as $file) {
        unlink($file);
      }
      rmdir($kodurada);
    }
  }
?>
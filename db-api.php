<?php
	date_default_timezone_set('Europe/Tallinn');
	
	ini_set('display_errors',1);
	error_reporting(E_ALL); 
	
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
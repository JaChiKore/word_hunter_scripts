<?php
	$params = parse_ini_file("../../config.ini");
	$conn = mysqli_connect($params['hostname'],$params['username'],$params['password'],$params['db_name']);

	if (mysqli_connect_errno($conn)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$filename = $_REQUEST['filename'];
	$trans = $_REQUEST['trans'];
	$user = $_REQUEST['user'];
	$level = $_REQUEST['level'];
	$startDate = $_REQUEST['startDate'];
	$endDate = $_REQUEST['endDate'];
	$scoreInici = $_REQUEST['scoreInici'];
	$scoreFinal = $_REQUEST['scoreFinal'];

	$result = mysqli_query($conn, "INSERT INTO match_game_transcription (filename, transcripcio, username, nivell, inici, final, score_inici, score_final) VALUES ('".$filename."', '".$trans."', '".$user."', '".$level."', STR_TO_DATE('".$startDate."','%Y%m%d %H%i%s'), STR_TO_DATE('".$endDate."','%Y%m%d %H%i%s'), '".$scoreInici."', '".$scoreFinal."');");

	if ($result != False) {
		print('True');
	} else {
		print('False');	
	}
	
	mysqli_close();
?>

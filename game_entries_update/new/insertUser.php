<?php
	$params = parse_ini_file("./config.ini");
	$conn = mysqli_connect($params['hostname'],$params['username'],$params['password'],$params['db_name']);

	if (mysqli_connect_errno($conn)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	$result = mysqli_query($conn, "SELECT id_user FROM user WHERE username = '".$username."';");
	
	while ($row = mysqli_fetch_assoc($result)) {
		$output[] = $row[id_user];
	}

	$count = count($output);

	if ($count == 0) {
		$password = sha1($password);
		mysqli_query($conn, "INSERT INTO user(username, password) VALUES ('".$username."', '".$password."')");
		$result = mysqli_query($conn, "SELECT LAST_INSERT_ID();");
		$row = mysqli_fetch_object($result);
		mysqli_query($conn, "INSERT INTO user_task(username, password, id_user, id_task, max_score, level) VALUES ('$username', '$password', '$row->id_user', 1, 0, 1)");
		mysqli_query($conn, "INSERT INTO user_task(username, password, id_user, id_task, max_score, level) VALUES ('$username', '$password', '$row->id_user', 2, 0, 1)");
		print('true');
	} else {
		print('false');
	}

	mysqli_close();
?>

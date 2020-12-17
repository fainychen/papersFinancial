<?php
	//$dbhost = '127.0.0.1';
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '1234';
	$dbname = 'papers';

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	mysqli_query($conn, "SET NAMES utf8");
	
	$sql_max_server_setting = "SELECT * FROM server_setting where id = '1'";
	$result_max_server_setting = mysqli_query($conn, $sql_max_server_setting);
	$row_max_server_setting=mysqli_fetch_row($result_max_server_setting);
	
	$sender_name = $row_max_server_setting[1] ;
	$sender_email = $row_max_server_setting[2] ;
	$server = $row_max_server_setting[3] ;
	$server_name = $row_max_server_setting[4] ;
	$server_password = $row_max_server_setting[5] ;
		
	function check($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}	
?>
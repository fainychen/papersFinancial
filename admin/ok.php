<?php

	include("Setting.php");
	
  include("SQLconnect.php");
/*
    if($_GET["action"]=="ok")
    {
        echo "I'm OK!";
    }
    else
    {
        echo "I'm not OK!";
    }
	*/
	
	//$submission_no = $_POST['submission_no']; 
	
	
	
	$privateKey = "1111111111111111";
	$iv 	= "1111111111111111";
	
	if(!empty($_FILES["fud1"]["tmp_name"])){
		$target_dir = "upload/";
		$temp= explode(".", $_FILES["fud1"]["name"]);
		$extension = end($temp);
		//$target_file1 = $target_dir . iconv("UTF-8", "big5//TRANSLIT//IGNORE",($_FILES["fud1"]["name"]));
		
		$filename1 = '' . '_1';
		//$filename1 = $submission_no . '_1';
		$encrypted1 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename1, MCRYPT_MODE_CBC, $iv);
		$target_file1 = $target_dir  . safe_b64encode($encrypted1).'.'.$extension;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fud1"]["tmp_name"]);
				if($check !== false) {
						$uploadOk = 1;
				} else {
						$uploadOk = 0;
				}
		}
		if (file_exists($target_file1)) {
				$uploadOk = 0;
				if (move_uploaded_file($_FILES["fud1"]["tmp_name"], $target_file1)) {
				} else {
				}
		} else {
				if (move_uploaded_file($_FILES["fud1"]["tmp_name"], $target_file1)) {
				} else {
				}
		}
		$fud1 = 'admin/'.$target_file1; 
	} else {
		$fud1 = ''; 
	}
	
?>
<?
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-Type:text/html;charset=UTF-8");
	session_start();
//=========================================================
//		     		CTRRA All Constant
//=========================================================
//=========== Define DataBase =============================
//=========== CTRRA =======================================
	define("ctrra_db_server", "localhost");
	define("ctrra_db_name", "rainbow");
	define("ctrra_db_user_id", "root"); // DB 帳號
	define("ctrra_db_user_password", "1234");  // DB 密碼
//=========== Define Session Redirect =====================
//=========== Define Web Constant =========================
//=========== Define Web Message ==========================
?>
<?php
  date_default_timezone_set('Asia/Taipei');
		$dbhost = ctrra_db_server;
		$db = ctrra_db_name;
		$dbuser = ctrra_db_user_id;
		$dbpass = ctrra_db_user_password;
	// ---------------------------------------------------------------
	function get_conn() {
		global $dbhost, $db, $dbuser, $dbpass;
		return get_connection($dbhost, $db, $dbuser, $dbpass);
	}
	// ---------------------------------------------------------------
	function get_connection($host, $db, $dbuser, $dbpass) {
		$conn = mysql_pconnect($host, $dbuser, $dbpass) or die("Couldn't connect to \"$host\" !!!");
		if ($conn > 0) {  // always return +ve if succeeded
			mysql_query("SET NAMES utf8", $conn);
			mysql_query("SET character_set_client = utf8", $conn);
			mysql_query("SET character_set_results = utf8", $conn);
			mysql_query("SET character_set_connection = utf8", $conn);
			mysql_select_db($db, $conn);
			return $conn;
		} else
			return -1;
	}
	// ---------------------------------------------------------------
	function get_rs($link, $sql) {
		$rs = mysql_query($sql, $link) or die(mysql_error());
		if ($rs)
			return $rs;
		else
			return -1;
	}
	// ---------------------------------------------------------------
	function utf8_query($link, $sql) {
		$utf8_sql = $sql;
    $rs = mysql_query($utf8_sql, $link);
		if ($rs)
			return $rs;
		else
			return false;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="梅問題,教學網,photoshop教學,flex教學,javascript教學,css教學,網頁教學,架站教學,wordperss教學,jQuery教學">
<meta content="all" name="minwt.com" />
<meta name="author" content="梅干扣肉" />

<title>>梅問題‧教學網-範例整合【取得CKedit傳來的值】</title>
</head>

<body>
<?php 
$conn = get_conn();
		$sql = "insert into essay set
				Essay_topic='test'
				, Essay_date='0000-00-00'
				, Essay_author='test'
				, Essay_content='$editor1'
				, LastModifiedDate='0000-00-00'";
		$rs = get_rs($conn, $sql);
		//echo stripslashes($_POST['editor1']); 
		?>
</body>
</html>
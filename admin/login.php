<?php
include("Setting.php");
include("SQLconnect.php");
if(!empty($_GET['lang'])){
	setcookie("lang", $_GET['lang']);
	echo "<script language='javascript'> location='login.php';</script>"; 	
}
	if(!empty($_GET['action'])){
	if($_GET['action']=="save"){
		$id = $_POST['id']; 
		$pwd = $_POST['pwd'];
		$role = $_POST['role']; 
		if ($role =='0') {
			$usr_result = mysqli_query($conn,"select * from author where id='$id' and pwd='$pwd'");
			$usr_rows=mysqli_fetch_row($usr_result);
			if ($usr_rows) {
				$privateKey = "1111111111111111";
				$iv 	= "1111111111111111";
				$data 	= '0';
				$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data, MCRYPT_MODE_CBC, $iv);
				
				ob_start();
				setcookie("id", $usr_rows[0]);
				setcookie("name", $usr_rows[2]);
				setcookie("role", $encrypted);
				echo "<script language='javascript'> location='submission.php';</script>"; 	
			} else {
				echo "<script language='javascript'> location='login.php';</script>"; 	
			}

		} else if ($role =='1') {
			$usr_result = mysqli_query($conn,"select * from reviewer where id='$id' and user_no='$pwd'");
			$usr_rows=mysqli_fetch_row($usr_result);
			if ($usr_rows) {
				$privateKey = "1111111111111111";
				$iv 	= "1111111111111111";
				$data 	= '1';
				$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data, MCRYPT_MODE_CBC, $iv);
				
				ob_start();
				setcookie("id", $usr_rows[0]);
				setcookie("name", $usr_rows[2]);
				setcookie("role", $encrypted);
				setcookie("topic", $usr_rows[5]);
				echo "<script language='javascript'> location='a01_review.php';</script>"; 	
			} else {
				echo "<script language='javascript'> location='login.php';</script>"; 	
			}

		} else {
			$privateKey = "1111111111111111";
			$iv 	= "1111111111111111";
			$data 	= '3';
			$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data, MCRYPT_MODE_CBC, $iv);
			
			$usr_result = mysqli_query($conn,"select * from admin where id='$id' and pwd='$pwd' and role='$role'");
			$usr_rows=mysqli_fetch_row($usr_result);
			if ($usr_rows) {
				ob_start();
				setcookie("id", $usr_rows[0]);
				setcookie("name", $usr_rows[1]);
				setcookie("role", $encrypted);
				echo "<script language='javascript'> location='reviewer.php';</script>"; 	
			} else {
				echo "<script language='javascript'> location='login.php';</script>"; 	
			}
		}
	}}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	$sql = "SELECT * FROM news;";
	$result = mysqli_query($conn, $sql);	
	$sql_max = "SELECT MAX(no) as max FROM news;";
	$result_max = mysqli_query($conn, $sql_max);
	$row_max=mysqli_fetch_row($result_max);
?>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/jpg" href="images/logo.jpg">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CERPS</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/index.css">

</head>
<body style="font-family:微軟正黑體,Helvetica, Arial,LiHei Pro, sans-serif;">
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#" >CERPS</a> 
	</div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<span class="navbar-brand pull-right" style="margin-top:-5px; display: none">
			<div class="dropdown">
			  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?= translate("切換語言") ?>
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu">
				<li><a href="/papers/admin/login.php?lang=zh-TW"><?= translate("中文") ?></a></li>
				<li><a href="/papers/admin/login.php?lang=en_US"><?= translate("English") ?></a></li>
			  </ul>
			</div>
		</span>
		
		<span class="navbar-brand pull-right" style="font-size: 14px;cursor:hand"><a style="color: white; text-decoration:none;" href="/papers/admin/login.php?lang=en_US">English</a></span>
		<span class="navbar-brand pull-right" style="font-size: 14px; color: white;" >&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class="navbar-brand pull-right" style="font-size: 14px;cursor:hand"><a style="color: white; text-decoration:none;" href="/papers/admin/login.php?lang=zh-TW">繁體中文</a></span>
		<span class="navbar-brand pull-right" style="font-size: 14px; color: white;" >&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<span class="navbar-brand pull-right"  data-toggle="modal" data-target="#exampleModal" style="font-size: 14px;cursor:help"><?= translate("查看版本訊息") ?></span>
		
	</div>        
  </div>
</nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 page-header">
        <h2><?= translate("登入管理後台") ?></h2><p style='color: red'>
		<?= translate("建議使用 Chrome, Microsoft Edge 瀏覽; 若瀏覽器未能跳轉至註冊頁面, ") ?>
		<a href="http://140.115.161.231/papers/admin/mb_add.php"><?= translate("作者註冊請點我") ?></a></p>
      </div>
    </div>
    <form action="?action=save" method="post" enctype="multipart/form-data" name="main_form">
    <button type="submit" name="action" class="btn btn-default"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> <?= translate("登入") ?></button>
    <a style="text-decoration : none; color: black" href="./mb_add.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> <?= translate("作者註冊") ?></a></button>
		<br/>
    <br/>
    <table class="table table-hover">
        <tbody>
          <tr>
            <td class="text-center"><?= translate("帳號") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="id" name="id" placeholder="<?= translate("帳號") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("密碼") ?></td>
            <td class="text-center"><input type="password" class="form-control" id="pwd" name="pwd" placeholder="<?= translate("密碼") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("身分別") ?></td>
            <td>
				<select class="selectpicker" name="role" id="role">
					<option value="0"><?= translate("作者") ?></option>
					<option value="1"><?= translate("審查委員") ?></option>
					<option value="3"><?= translate("大會工作人員") ?></option>
					<option value="4"><?= translate("系統管理員") ?></option>
				</select>
			</td>
          </tr>
        </tbody>
     </table>
  </form>
  </div>
<br/>
<br/>
<br/>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © CERPS. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">v1.0.2</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <?= translate("＊ 新功能登場囉！作者於論文投稿時，可自行進行推薦期刊志願序的偏好設定<br/>
		＊ 感謝您使用本論文投稿系統，我們已修復了一些小問題並改善系統安全性及穩定度") ?>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>
</html>
<script>
	function gohome(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='reviewer.php';
	}
</script>


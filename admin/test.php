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
<body style="font-family:�L�n������,Helvetica, Arial,LiHei Pro, sans-serif;">
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
			  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?= translate("�����y��") ?>
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu">
				<li><a href="/papers/admin/login.php?lang=zh-TW"><?= translate("����") ?></a></li>
				<li><a href="/papers/admin/login.php?lang=en_US"><?= translate("English") ?></a></li>
			  </ul>
			</div>
		</span>
		
		<span class="navbar-brand pull-right" style="font-size: 14px;cursor:hand"><a style="color: white; text-decoration:none;" href="/papers/admin/login.php?lang=en_US">English</a></span>
		<span class="navbar-brand pull-right" style="font-size: 14px; color: white;" >&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class="navbar-brand pull-right" style="font-size: 14px;cursor:hand"><a style="color: white; text-decoration:none;" href="/papers/admin/login.php?lang=zh-TW">�c�餤��</a></span>
		<span class="navbar-brand pull-right" style="font-size: 14px; color: white;" >&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<span class="navbar-brand pull-right"  data-toggle="modal" data-target="#exampleModal" style="font-size: 14px;cursor:help"><?= translate("�d�ݪ����T��") ?></span>
		
	</div>        
  </div>
</nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 page-header">
        <h2><?= translate("�n�J�޲z��x") ?></h2><p style='color: red'>
		<?= translate("��ĳ�ϥ� Chrome, Microsoft Edge �s��; �Y�s�����������ܵ��U����, ") ?>
		<a href="http://140.115.197.31:8080/papers/admin/mb_add.php"><?= translate("�@�̵��U���I��") ?></a></p>
      </div>
    </div>
    <form action="?action=save" method="post" enctype="multipart/form-data" name="main_form">
    <button type="submit" name="action" class="btn btn-default"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> <?= translate("�n�J") ?></button>
    <a style="text-decoration : none; color: black" href="./mb_add.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> <?= translate("�@�̵��U") ?></a></button>
		<br/>
    <br/>
    <table class="table table-hover">
        <tbody>
          <tr>
            <td class="text-center"><?= translate("�b��") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="id" name="id" placeholder="<?= translate("�b��") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("�K�X") ?></td>
            <td class="text-center"><input type="password" class="form-control" id="pwd" name="pwd" placeholder="<?= translate("�K�X") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("�����O") ?></td>
            <td>
				<select class="selectpicker" name="role" id="role">
					<option value="0"><?= translate("�@��") ?></option>
					<option value="1"><?= translate("�f�d�e��") ?></option>
					<option value="3"><?= translate("�j�|�u�@�H��") ?></option>
					<option value="4"><?= translate("�t�κ޲z��") ?></option>
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
        <p>Copyright c CERPS. All rights reserved.</p>
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
	  <?= translate("�� �s�\��n���o�I�@�̩�פ��Z�ɡA�i�ۦ�i����˴��Z���@�Ǫ����n�]�w<br/>
		�� �P�±z�ϥΥ��פ��Z�t�ΡA�ڭ̤w�״_�F�@�Ǥp���D�çﵽ�t�Φw���ʤ�í�w��") ?>
        
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
		answer = confirm("<?= translate('�z�T�w��󦹦����ʶܡH') ?>");
		if (answer)
		location.href='reviewer.php';
	}
</script>


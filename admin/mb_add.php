<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
  include("SQLconnect.php");
  $sql = "SELECT * FROM author;";
  $result = mysqli_query($conn, $sql);
	
	$sql_max = "SELECT MAX(author_no) as max FROM author;";
  $result_max = mysqli_query($conn, $sql_max);
	$row_max=mysqli_fetch_row($result_max);
?>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/jpg" href="images/logo.jpg">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>2021 TFA conference submission system</title>

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/index.css">
</head>
<body style="font-family:微軟正黑體,Helvetica, Arial,LiHei Pro, sans-serif;">
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#" >2021 TFA conference submission system</a> </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
		<li><a href="./login.php"><?= translate("回登入頁面") ?></a> </li>
     </ul>
    </div>
  </div>
</nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 page-header">
        <h2><?= translate("作者註冊") ?></h2>
      </div>
    </div>
    <form action="?action=save" method="post" enctype="multipart/form-data" name="main_form">
    <button type="submit" name="action" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> <?= translate("送出") ?></button>
    <br/>
    <br/>
    <table class="table table-hover">
        <tbody>
          <tr style="display: none">
            <td class="text-center"><?= translate("流水號") ?></td>
            <td class="text-center"><input value="<?php echo $row_max[0] + 1; ?>" type="text" class="form-control" id="author_no" name="author_no" placeholder="<?= translate("流水號") ?>"></td>
          </tr>
          <tr>
            <td class="text-center">*<?= translate("帳號 (E-mail)") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="id" name="id" placeholder="<?= translate("請輸入您的電子郵件 (登入帳號)") ?>"></td>
          </tr>
					<tr>
            <td class="text-center">*<?= translate("姓名") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="name" name="name" placeholder="<?= translate("姓名") ?>"></td>
          </tr>
					<tr>
            <td class="text-center">*<?= translate("單位") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="institute" name="institute" placeholder="<?= translate("單位") ?>"></td>
          </tr>
           <tr>
            <td class="text-center">*<?= translate("職稱") ?></td>
            <td>
				<select class="selectpicker" name="title" id="title" >
					<option value="Prof.">Prof.</option>
					<option value="Dr.">Dr.</option>
					<option value="Mr.">Mr.</option>
					<option value="Ms.">Ms.</option>
					<option value="Other">Other</option>
				</select>
				<input style="display:none" type="text" class="form-control" id="titleOther" name="titleOther" placeholder="<?= translate("職稱") ?>">
			</td>
          </tr>
		  <tr>
            <td class="text-center">*<?= translate("手機號碼") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="tel" name="tel" placeholder="<?= translate("手機號碼") ?>"></td>
          </tr>
			<tr>
            <td class="text-center">*<?= translate("輸入密碼") ?></td>
            <td class="text-center"><input required type="password" minlength="6"  class="form-control" id="pwd" name="pwd" placeholder="<?= translate("建立密碼 ( 6 - 12 characters )") ?>"></td>
          </tr>
           <tr>
            <td class="text-center">*<?= translate("再次輸入密碼") ?></td>
            <td class="text-center"><input required type="password" minlength="6" class="form-control" id="pwd2" name="pwd2" placeholder="<?= translate("再次輸入密碼") ?>"></td>
          </tr>
          <tr style="display: none">
            <td class="text-center"><?= translate("傳真") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="fax" name="fax" placeholder="<?= translate("傳真") ?>"></td>
          </tr>
          <tr style="display: none">
            <td class="text-center"><?= translate("地址") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="address" name="address" placeholder="<?= translate("地址") ?>"></td>
          </tr>
          
          <tr style="display: none">
            <td class="text-center"><?= translate("註冊時間") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="registration_time" name="registration_time" placeholder="<?= translate("註冊時間") ?>"></td>
          </tr>
           <tr style="display: none">
            <td class="text-center">memo1</td>
            <td class="text-center"><input type="text" class="form-control" id="memo1" name="memo1" placeholder="memo1"></td>
          </tr>
           <tr style="display: none">
            <td class="text-center">memo2</td>
            <td class="text-center"><input type="text" class="form-control" id="memo2" name="memo2" placeholder="memo2"></td>
          </tr>
           <tr style="display: none">
            <td class="text-center">memo3</td>
            <td class="text-center"><input type="text" class="form-control" id="memo3" name="memo3" placeholder="memo3"></td>
          </tr>
        </tbody>
     </table>
		 <p style=" right: 70px; position:absolute; font-size: 80%;">*<?= translate("為必填欄位") ?></p>
  </form>
  </div>
<br/>
<br/>
<br/>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © 2021 TFA conference submission system. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>
</html>
<?php
   ("./common/calendar.js");
?>
<?php
if(!empty($_GET['action'])){
if($_GET['action']=="save"){
	$author_no = check($_POST['author_no']); 
	$id = check($_POST['id']); 
	$name=check($_POST['name']);
	$institute = check($_POST['institute']); 
	$title = check($_POST['title']); 
	$titleOther = check($_POST['titleOther']); 
	$tel = check($_POST['tel']); 
	$fax = check($_POST['fax']); 
	$address = check($_POST['address']); 
	$pwd = check($_POST['pwd']); 
	$pwd2 = check($_POST['pwd2']); 
	$registration_time = check($_POST['registration_time']); 
	$memo1 = check($_POST['memo1']); 
	$memo2 = check($_POST['memo2']); 
	$memo3 = check($_POST['memo3']); 
	
	if ($title=='Other'){
		$title = $titleOther; 
	}
	$memo3 = $_POST['memo3']; 
	
	$author_no = mysqli_real_escape_string($conn, $author_no);
	$id = mysqli_real_escape_string($conn, $id);
	$name = mysqli_real_escape_string($conn, $name);
	$institute = mysqli_real_escape_string($conn, $institute);
	$title = mysqli_real_escape_string($conn, $title);
	$tel = mysqli_real_escape_string($conn, $tel);
	$fax = mysqli_real_escape_string($conn, $fax);
	$address = mysqli_real_escape_string($conn, $address);
	$pwd = mysqli_real_escape_string($conn, $pwd);
	$registration_time = mysqli_real_escape_string($conn, $registration_time);
	$memo1 = mysqli_real_escape_string($conn, $memo1);
	$memo2 = mysqli_real_escape_string($conn, $memo2);
	$memo3 = mysqli_real_escape_string($conn, $memo3);

	if ($pwd !== $pwd2) {
		echo "<script language='javascript'> alert('密碼不一致');</script>";
	} else {
		mysqli_query($conn,"insert into author set
				 author_no='$author_no'
				, id='$id'
				, name='$name'
				, institute='$institute'
				, title='$title'
				, tel='$tel'
				, fax='$fax'
				, address='$address'
				, pwd='$pwd'
				, registration_time='$registration_time'
				, memo1='$memo1'
				, memo2='$memo2'
				, memo3='$memo3'
				");
		echo "<script language='javascript'> location='login.php';</script>"; 	
	}
}}
?>
<script>
	$('select[name="title"]').val('titleOther');
	$("#title").click(function() {
		alert(1);
		$("#titleOther").hide();
	});
	function showTitleOther(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='mb_list.php';
	}
	function gohome(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='mb_list.php';
	}
</script>


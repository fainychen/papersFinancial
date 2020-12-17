<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
  include("SQLconnect.php");
  $sql = "SELECT * FROM author;";
  $result = mysqli_query($conn, $sql);

	if(!empty($_GET['action']) && !empty($_GET['hideID'])){
		if($_GET['action']=="delete"){
			$ID = $_GET['hideID'];
			$sql_delete = "delete FROM author where author_no = '$ID'";
			mysqli_query($conn, $sql_delete);
			echo "<script language='javascript'>location.href='mb_list.php';</script>";
		} else if($_GET['action']=="modify"){
			//$ID = $_GET['hideID'];
			
			$mID = $_GET['hideID'];
			$privateKey = "1111111111111111";//1234567812345678
			$iv 	= "1111111111111111";
			$encryptedData = base64_decode($_GET['hideID']);
			$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
			$ID = $decrypted;
			//echo $ID;
			
			$sql_max = "SELECT * FROM author where author_no = '$ID'";
			$result_max = mysqli_query($conn, $sql_max);
			$row_max=mysqli_fetch_row($result_max);
		}
	}
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
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#" >CERPS</a> </div>
			
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php if ($_COOKIE["role"] == $rEncrypted0 ) { ?>
		  <ul class="nav navbar-nav">
     	 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("功能選單") ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="submission.php"><?= translate("論文投稿") ?></a> </li>
            <li><a href="mb_list.php"><?= translate("資料維護") ?></a> </li>  
          </ul>
        </li>
      </ul> 
		<?php } else if ($_COOKIE["role"] == $rEncrypted1 ) { ?> 
			<ul class="nav navbar-nav">
				 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("功能選單") ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="a01_chief_decide.php"><?= translate("論文審查及下載") ?></a> </li>
					</ul>
				</li>
			</ul> 
		<?php } else { ?> 
      <ul class="nav navbar-nav">
     	 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("投稿管理") ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="reviewer.php"><?= translate("建立審查委員名單") ?></a> </li>
            <li><a href="a01_chief_decide.php"><?= translate("論文審查及下載") ?></a> </li>
            <li><a href="pro_decide.php"><?= translate("審查結果寄發") ?></a> </li>
          </ul>
        </li>
      </ul>  
      <ul class="nav navbar-nav">
     	 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("一般管理") ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="submission.php"><?= translate("論文修改") ?>&nbsp;<?= translate("(模擬作者)") ?></a> </li>
            <li><a href="mb_list.php"><?= translate("作者管理") ?></a> </li>  
          </ul>
        </li>
      </ul>   
      <ul class="nav navbar-nav">
     	 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("參數設定") ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="R005.php"><?= translate("系統參數設定") ?></a> </li>  
            <li><a href="R006.php"><?= translate("通知信設定") ?></a> </li>
            <li><a href="admin.php"><?= translate("總編輯帳號設定") ?></a> </li>
            <li><a href="ref_topic.php"><?= translate("論文類別維護") ?></a> </li>
            <li><a href="ref_paper.php"><?= translate("論文主題維護") ?></a> </li>
            <li><a href="recommended_journal.php"><?= translate("推薦期刊維護") ?></a> </li>
          </ul>
        </li>
      </ul>   
      <ul class="nav navbar-nav">
     	 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("統計與查詢") ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="sysEmaillog.php"><?= translate("郵件備份") ?></a> </li>  
          </ul>
        </li>
      </ul>
			<?php } ?> 
      <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("您好,") ?> <?= $_COOKIE["name"] ?>!<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./login.php"><?= translate("登出") ?></a> </li>
          </ul>
        </li>
     </ul>
    </div>
  </div>
</nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 page-header">
        <h2><?= translate("編輯作者") ?></h2>
      </div>
    </div>
    <form action="mb_list_edit2.php?hideID=<?=$_GET['hideID']; ?>"  method="post" enctype="multipart/form-data" name="main_form">
    <a class="btn btn-default glyphicon glyphicon-arrow-left" onclick="gohome()"></a>
    <button class="btn btn-default glyphicon glyphicon-floppy-save" type="submit" name="action" ></button>
    <br/>
    <br/>
    <table class="table table-hover">
    
        <tbody>
        <tr style="display: none">
            <td class="text-center"><?= translate("流水號") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="author_no" name="author_no" value="<?php echo $row_max[0] ; ?>" placeholder="<?= translate("流水號") ?>"></td>
          </tr>
          <tr>
            <td class="text-center">*<?= translate("帳號") ?></td>
            <td class="text-center"><input  required type="text" class="form-control" id="id" name="id" value="<?php echo $row_max[1] ; ?>" placeholder="<?= translate("帳號") ?>"></td>
          </tr>
          <tr>
            <td class="text-center">*<?= translate("姓名") ?></td>
            <td class="text-center"><input  required type="text" class="form-control" id="name" name="name" value="<?php echo $row_max[2] ; ?>" placeholder="<?= translate("姓名") ?>"></td>
          </tr>
          <tr>
            <td class="text-center">*<?= translate("單位") ?></td>
            <td class="text-center"><input  required type="text" class="form-control" id="institute" name="institute" value="<?php echo $row_max[3] ; ?>" placeholder="<?= translate("單位") ?>"></td>
          </tr>
           <tr>
            <td class="text-center">*<?= translate("職稱") ?></td>
            <td class="text-center"><input  required type="text" class="form-control" id="title" name="title" value="<?php echo $row_max[4] ; ?>" placeholder="<?= translate("職稱") ?>"></td>
          </tr>
          <tr>
            <td class="text-center">*<?= translate("手機號碼") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="tel" name="tel" value="<?php echo $row_max[5] ; ?>" placeholder="<?= translate("手機號碼") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("傳真") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="fax" name="fax" value="<?php echo $row_max[6] ; ?>" placeholder="<?= translate("傳真") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("地址") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="address" name="address" value="<?php echo $row_max[7] ; ?>" placeholder="<?= translate("地址") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("密碼") ?></td>
            <td class="text-center"><input type="password" class="form-control" id="pwd" name="pwd" value="<?php echo $row_max[8] ; ?>" placeholder="<?= translate("密碼") ?>"></td>
          </tr>
           
          <tr>
            <td class="text-center"><?= translate("註冊時間") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="registration_time" name="registration_time" value="<?php echo $row_max[9] ; ?>" placeholder="<?= translate("註冊時間") ?>"></td>
          </tr>
           <tr>
            <td class="text-center">memo1</td>
            <td class="text-center"><input type="text" class="form-control" id="memo1" name="memo1" value="<?php echo $row_max[10] ; ?>" placeholder="memo1"></td>
          </tr>
           <tr>
            <td class="text-center">memo2</td>
            <td class="text-center"><input type="text" class="form-control" id="memo2" name="memo2" value="<?php echo $row_max[11] ; ?>" placeholder="memo2"></td>
          </tr>
           <tr>
            <td class="text-center">memo3</td>
            <td class="text-center"><input type="text" class="form-control" id="memo3" name="memo3" value="<?php echo $row_max[12] ; ?>" placeholder="memo3"></td>
          </tr>
        </tbody>
     </table>
  </form>
  </div>
<br/><br/><br/>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © CERPS. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.js"></script>
</body>
</html>

<?php
   ("./common/calendar.js");
    include_once "./CKEdit/ckeditor/ckeditor.php";
	$CKEditor = new CKEditor();
	$CKEditor->basePath = './CKEdit/ckeditor/';
	//$CKEditor->startupPath = '../CKEdit/ckfinder/';
	$CKEditor->replace("full_content");
?>
<script>
	function gohome(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='mb_list.php';
	}
</script>
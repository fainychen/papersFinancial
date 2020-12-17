<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
  include("SQLconnect.php");
  $sql = "SELECT * FROM email_template;";
  $result = mysqli_query($conn, $sql);
	$sql_max = "SELECT MAX(id) as max FROM email_template;";
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
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#" >2021 TFA conference submission system</a> </div>
			
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
        <h2><?= translate("新增通知信設定") ?></h2>
      </div>
    </div>
    <form action="?action=save" method="post" enctype="multipart/form-data" name="main_form">
    <a class="btn btn-default glyphicon glyphicon-arrow-left" onclick="gohome()"></a>
    <button class="btn btn-default glyphicon glyphicon-floppy-save" type="submit" name="action" ></button>
    <br/>
    <br/>
    <table class="table table-hover">
        <tbody>
          <tr style="display: none">
            <td class="text-center"><?= translate("編號") ?></td>
            <td class="text-center"><input  value="<?php echo $row_max[0] + 1; ?>"  type="text" class="form-control" id="id" name="id" placeholder="<?= translate("編號") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("說明") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="description" name="description" placeholder="<?= translate("說明") ?>"></td>
          </tr>
			<tr>
            <td class="text-center"><?= translate("主旨") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="title" name="title" placeholder="<?= translate("主旨") ?>"></td>
          </tr>
			<tr>
            <td class="text-center"><?= translate("內容") ?></td>
<td class="text-center">
            	<textarea cols="140" rows="36" id="content" name="content" ></textarea>
            </td>   	
			</tr>
			<tr>
            <td class="text-center"><?= translate("備註") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="note" name="note" placeholder="<?= translate("備註") ?>"></td>
          </tr>
					<tr>
            <td class="text-center"><?= translate("說明") ?></td>
            <td>
							<?= translate("你可以使用下列標籤 (包含中括號) 放置在信件內容的任何位置，系統將幫您自動置換掉標籤所對應的資訊。
							<br/>
							請注意，在郵件內容中使用標籤時，大小寫必須完全一致，否則系統無法協助轉換。
							<br/><br/>
							[Paper]	論文內容 ( 包含流水號、論文編號、論文類別、論文主題、論文題目、作者、單位 )<br/>
							[CAuthor]	通訊作者姓名<br/>
							[Author]	作者姓名<br/>
							[Reviewer]	審查委員姓名<br/>
							[Reviewer_ID]	審查帳號<br/>
							[Reviewer_Password]	審查密碼<br/>
							[Chief_Decide]	論文審查結論") ?><br/>
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
        <p>Copyright © 2021 TFA conference submission system. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
 

<script src="js/jquery-1.11.3.min.js"></script> 
<!----> 
<script src="js/bootstrap.js"></script>
</body>
</html>
<?php
  ("./common/calendar.js");
  include_once "./CKEdit/ckeditor/ckeditor.php";
	$CKEditor = new CKEditor();
	$CKEditor->basePath = './CKEdit/ckeditor/';
	//$CKEditor->startupPath = '../CKEdit/ckfinder/';
	$CKEditor->replace("content");
?>
<?php
if(!empty($_GET['action'])){
if($_GET['action']=="save"){
	$id = $_POST['id']; 
  $description = $_POST['description']; 
	$title = $_POST['title']; 
  $content = $_POST['content']; 
	$note = $_POST['note']; 
	mysqli_query($conn,"insert into email_template set 
      id='$id'
      , description='$description'
      , title='$title'
      , content='$content'
      , note='$note'
			");
	echo "<script language='javascript'> location='R006.php';</script>"; 	
}}
?>
<script>
	function saveitem1(a){
	}
	function edititem(a){
	}
	function gohome(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='R006.php';
	}
</script>


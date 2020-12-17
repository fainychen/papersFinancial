<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
    include("SQLconnect.php");
	if ($_COOKIE["role"] == $rEncrypted1 ) {
		$a = $_COOKIE["id"];
		$sql = "SELECT * FROM submission where (a_reviewer_no = $a or b_reviewer_no = $a) and enable is null";
	} else {
		$sql = "SELECT * FROM submission where enable is null;";
	}
    $result = mysqli_query($conn, $sql);
		
	if(!empty($_GET['action']) && !empty($_GET['hideID'])){
		$ID = $_GET['hideID'];
		$mID=$ID;
		if($mID==999){
			$mID=0;
		}
		if($_GET['action']=="delete"){
			$sql = "SELECT * FROM submission where paper_status= $mID and enable is null;"; 
			$result = mysqli_query($conn, $sql);
		} 
	} else {
		$ID = "";
	}
	$sql_paper_status0 = "SELECT * FROM submission where paper_status= 0 and enable is null;";
	$result_paper_status0 = mysqli_query($conn, $sql_paper_status0);
	$i0 = 0;
	while($row1 = @mysqli_fetch_object($result_paper_status0)) {
		$i0 = $i0 +1;
	}
	
	$sql_paper_status1 = "SELECT * FROM submission where paper_status= 1 and enable is null;";
	$result_paper_status1 = mysqli_query($conn, $sql_paper_status1);
	$i1 = 0;
	while($row1 = @mysqli_fetch_object($result_paper_status1)) {
		$i1 = $i1 +1;
	}
	
	$sql_paper_status2 = "SELECT * FROM submission where paper_status= 2 and enable is null;";
	$result_paper_status2 = mysqli_query($conn, $sql_paper_status2);
	$i2 = 0;
	while($row1 = @mysqli_fetch_object($result_paper_status2)) {
		$i2 = $i2 +1;
	}
	
	$sql_paper_status3 = "SELECT * FROM submission where paper_status= 3 and enable is null;";
	$result_paper_status3 = mysqli_query($conn, $sql_paper_status3);
	$i3 = 0;
	while($row1 = @mysqli_fetch_object($result_paper_status3)) {
		$i3 = $i3 +1;
	}
	
	$sql_paper_status4 = "SELECT * FROM submission where paper_status= 4 and enable is null;";
	$result_paper_status4 = mysqli_query($conn, $sql_paper_status4);
	$i4 = 0;
	while($row1 = @mysqli_fetch_object($result_paper_status4)) {
		$i4 = $i4 +1;
	}
	
	$sql_paper_status5 = "SELECT * FROM submission where paper_status= 5 and enable is null;";
	$result_paper_status5 = mysqli_query($conn, $sql_paper_status5);
	$i5 = 0;
	while($row1 = @mysqli_fetch_object($result_paper_status5)) {
		$i5 = $i5 +1;
	}
	
	$sql_paper_status6 = "SELECT * FROM submission where paper_status= 6 and enable is null;";
	$result_paper_status6 = mysqli_query($conn, $sql_paper_status6);
	$i6 = 0;
	while($row1 = @mysqli_fetch_object($result_paper_status6)) {
		$i6 = $i6 +1;
	}
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
        <h2><?= translate("論文審查及下載") ?></h2>
      </div>
    </div>
		 <form action="?action=save" method="post" enctype="multipart/form-data" name="main_form">
		<?php if ($_COOKIE["role"] !== $rEncrypted1 ) { ?>
    <a class="glyphicon glyphicon-plus btn btn-default" onclick="additem()" style="display: none"></a>
    <?php } ?>
		<select class="selectpicker" name="selectpicker" id="selectpicker" >
			<option value="" <?php if ($ID == '') echo ' selected="selected"'; ?>><?= translate("請選擇") ?></option>
			<option value="999" <?php if ($ID == '999') echo ' selected="selected"'; ?>><?= translate("作者暫存論文") ?> (<?php echo $i0; ?>)</option>
			<option value="1" <?php if ($ID == '1') echo ' selected="selected"'; ?>><?= translate("作者上傳完論文") ?> (<?php echo $i1; ?>)</option>
			<option value="2" <?php if ($ID == '2') echo ' selected="selected"'; ?>><?= translate("審稿進行中") ?> (<?php echo $i2; ?>)</option>
			<option value="3" <?php if ($ID == '3') echo ' selected="selected"'; ?>><?= translate("審稿結束，等待編輯決定") ?> (<?php echo $i3; ?>)</option>
			<option value="4" <?php if ($ID == '4') echo ' selected="selected"'; ?>><?= translate("接受") ?> (<?php echo $i4; ?>)</option>
			<option value="5" <?php if ($ID == '5') echo ' selected="selected"'; ?>><?= translate("拒絕") ?> (<?php echo $i5; ?>)</option>
			<option value="6" <?php if ($ID == '6') echo ' selected="selected"'; ?>><?= translate("接受並推薦到期刊") ?> (<?php echo $i6; ?>)</option>
		</select>
		<button class="btn btn-default glyphicon glyphicon-search" type="submit" name="action"></button>
  </form><br/>
    <br/>
    <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center" ><?= translate("審查主題") ?></th>
            <th class="text-center"><?= translate("論文題目") ?></th>
            <th class="text-center"><?= translate("論文匿名全文版本") ?></th>
            <th class="text-center"><?= translate("論文具名全文版本") ?></th>
            <th class="text-center"><?= translate("著作權讓與書") ?></th>
            <th class="text-center"><?= translate("投稿時間") ?></th>
            <th class="text-center"><?= translate("目前狀態") ?></th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <?php
		  	while($row = @mysqli_fetch_object($result)) {			
		  ?>
          <tr>
            <td class="text-center"><?=$row->paper3; ?></td>
            <td class="text-center"><?=$row->topic; ?></td>
            <td class="text-center"><?php if ($row->fud1 !='') { ?><a id="attachment" name="attachment" value="<?php echo $row->fud1 ; ?>" href="../<?php echo $row->fud1 ; ?>" ><button class="glyphicon glyphicon-download-alt btn btn-default"></button></a><?php } ?></td>
            <td class="text-center"><?php if ($row->fud2 !='') { ?><a id="attachment" name="attachment" value="<?php echo $row->fud2 ; ?>" href="../<?php echo $row->fud2 ; ?>" ><button class="glyphicon glyphicon-download-alt btn btn-default"></button></a><?php } ?></td>
            <td class="text-center"><?php if ($row->fud3 !='') { ?><a id="attachment" name="attachment" value="<?php echo $row->fud3 ; ?>" href="../<?php echo $row->fud3 ; ?>" ><button class="glyphicon glyphicon-download-alt btn btn-default"></button></a><?php } ?></td>
            <td class="text-center"><?=$row->upload_time; ?></td>
            <td class="text-center">
				<?php
					if ($row->paper_status=='0'){
						echo translate("作者暫存論文") ;
					} else if ($row->paper_status=='2'){
						echo translate("審稿進行中");
					} else if ($row->paper_status=='3'){
						echo translate("審稿結束，等待編輯決定");
					} else if ($row->paper_status=='4'){
						echo translate("接受");
					} else if ($row->paper_status=='5'){
						echo translate("拒絕");
					} else if ($row->paper_status=='6'){
						echo translate("接受並推薦到期刊");
					} else {
						echo translate("作者上傳完論文");
					}
				?>
			</td>
            <td class="text-center">
                <button class="glyphicon glyphicon-pencil btn btn-default" onclick="self.location.href='a01_chief_decide_edit.php?action=modify&hideID=<?=$row->submission_no; ?>'"></button>
				<?php if ($_COOKIE["role"] !== $rEncrypted1 ) { ?>
					<button class="btn btn-default glyphicon glyphicon-trash" onclick="deleteitem('<?=$row->submission_no; ?>')"></button>
				<?php } ?>
		        </td>
          </tr>            
          <?php
            }
          ?>
        </tbody>
     </table> 
  </div>
<br/><br/><br/>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>
</html>
<?php
	if(!empty($_GET['action'])){
	if($_GET['action']=="save"){
		$selectpicker = $_POST['selectpicker']; 
		$result = mysqli_query($conn, $sql);
		echo "<script language='javascript'> location='a01_chief_decide.php?action=delete&hideID='+$selectpicker+'';</script>"; 	
	}}
?>
<script>
	function additem(a){
		location.href='a01_chief_decide_add.php';
	}
	function deleteitem(a){
		answer = confirm("<?= translate('您確定要刪除此筆資料嗎？') ?>"	);
		if (answer) {
			location.href='a01_chief_decide_edit.php?action=delete&hideID='+a+'';
		}
	}
</script>
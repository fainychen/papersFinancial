<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include("SQLconnect.php");
	$sql = "SELECT * FROM submission;";
	$result = mysqli_query($conn, $sql);
	
	if ($_COOKIE["role"] == $rEncrypted0 ) {
		$sql1 = "SELECT * FROM author where author_no = '" . $_COOKIE["id"]."'";
		$result1 = mysqli_query($conn, $sql1);
	} else {
		$sql1 = "SELECT * FROM author;";
		$result1 = mysqli_query($conn, $sql1);
	}
	if ($_COOKIE["role"] == $rEncrypted0 ) {
		$sql_ref_paper = "SELECT * FROM ref_paper where length(id) < 3;";
	} else {
		$sql_ref_paper = "SELECT * FROM ref_paper where length(id) < 3;";
	}
	$result_ref_paper1 = mysqli_query($conn, $sql_ref_paper);
	$result_ref_paper2 = mysqli_query($conn, $sql_ref_paper);

	if(!empty($_GET['action']) && !empty($_GET['hideID'])){
		$mID = $_GET['hideID'];
		$privateKey = "1111111111111111";//1234567812345678
		$iv 	= "1111111111111111";
		$encryptedData = base64_decode($_GET['hideID']);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
		$ID = trim($decrypted);
		if($_GET['action']=="delete"){
			//$sql_delete = "delete FROM submission where submission_no = '$mID'";
			//$result_delete = mysqli_query($conn, $sql_delete);
			mysqli_query($conn,"update submission set enable='0' where submission_no='$mID'");
			echo "<script language='javascript'>location.href='submission.php';</script>";
		} else if($_GET['action']=="modify"){
			$sql_max = "SELECT * FROM submission where submission_no = '$ID'";
			$result_max = mysqli_query($conn, $sql_max);
			$row_max=mysqli_fetch_row($result_max);
		}
	}
	
	if ($row_max[43]== '-') {
		$sql_recommended_journal = "SELECT * FROM recommended_journal ;";
	} else {
		$sql_recommended_journal = "SELECT * FROM recommended_journal where id in($row_max[43]) order by field(id, $row_max[43] ) ;";
	}
    $result_recommended_journal = mysqli_query($conn, $sql_recommended_journal);
	
	
	$result_recommended_journal_rows = mysqli_query($conn, $sql_recommended_journal);;
?>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/jpg" href="images/logo.jpg">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>2021 TFA conference submission system</title>
<?php
	//处理特殊字符
	function safe_b64encode($string) {
		$data = base64_encode($string);
		$data = str_replace(array('+','/','='),array('-','_',''),$data);
		return $data;
	}
	//解析特殊字符
	function safe_b64decode($string) {
		$mydata = str_replace(array('-','_'),array('+','/'),$string);
		$mod4 = strlen($mydata) % 4;
		if ($mod4) {
		  $mydata .= substr('====', $mod4);
		}
		return base64_decode($mydata);
	}
	error_reporting(0);
	$privateKey = "1111111111111111";
	$iv 		= "1111111111111111";
	$target_dir = "upload/".$_COOKIE["id"]."/";
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0700);
	}

	$filename1 = $ID . '_1';
	$encrypted1 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename1, MCRYPT_MODE_CBC, $iv);
	$target_file1 = safe_b64encode($encrypted1);
	
	$filename2 = $ID . '_2';
	$encrypted2 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename2, MCRYPT_MODE_CBC, $iv);
	$target_file2 = safe_b64encode($encrypted2);
	
	$filename3 = $ID . '_3';
	$encrypted3 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename3, MCRYPT_MODE_CBC, $iv);
	$target_file3 = safe_b64encode($encrypted3);
?>
 <script type="text/javascript">
	
    function sub1() {
      var obj = new XMLHttpRequest();
      obj.onreadystatechange = function() {
        if (obj.status == 200 && obj.readyState == 4) {
          document.getElementById('con1').innerHTML = obj.responseText;
        }
      }

      // 通过Ajax对象的upload属性的onprogress事件感知当前文件上传状态
      obj.upload.onprogress = function(evt) {
        // 上传附件大小的百分比
        var per = Math.floor((evt.loaded / evt.total) * 100) + "%";
        // 当上传文件时显示进度条
        document.getElementById('parent1').style.display = 'block';
        // 通过上传百分比设置进度条样式的宽度
        document.getElementById('son1').style.width = per;
        // 在进度条上显示上传的进度值
        document.getElementById('son1').innerHTML = per;
      }


      // 通过FormData收集零散的文件上传信息
      var fm = document.getElementById('userfile1').files[0];
	  var ext = (fm.name).split('.')[1];
      var fd = new FormData();
      fd.append('userfile1', fm);
      fd.append('mPath', '<?php echo $_COOKIE["id"]; ?>');
      fd.append('mName', '<?php echo $target_file1; ?>'+'.'+ext);
      obj.open("post", "upload1.php");
      obj.send(fd);
    }
	
	function sub2() {
      var obj = new XMLHttpRequest();
      obj.onreadystatechange = function() {
        if (obj.status == 200 && obj.readyState == 4) {
          document.getElementById('con2').innerHTML = obj.responseText;
        }
      }

      // 通过Ajax对象的upload属性的onprogress事件感知当前文件上传状态
      obj.upload.onprogress = function(evt) {
        // 上传附件大小的百分比
        var per = Math.floor((evt.loaded / evt.total) * 100) + "%";
        // 当上传文件时显示进度条
        document.getElementById('parent2').style.display = 'block';
        // 通过上传百分比设置进度条样式的宽度
        document.getElementById('son2').style.width = per;
        // 在进度条上显示上传的进度值
        document.getElementById('son2').innerHTML = per;
      }

      // 通过FormData收集零散的文件上传信息
      var fm = document.getElementById('userfile2').files[0];
	  var ext = (fm.name).split('.')[1];
      var fd = new FormData();
      fd.append('userfile2', fm);
      fd.append('mPath', '<?php echo $_COOKIE["id"]; ?>');
      fd.append('mName', '<?php echo $target_file2; ?>'+'.'+ext);
      obj.open("post", "upload2.php");
      obj.send(fd);
    }
	
	function sub3() {
      var obj = new XMLHttpRequest();
      obj.onreadystatechange = function() {
        if (obj.status == 200 && obj.readyState == 4) {
          document.getElementById('con3').innerHTML = obj.responseText;
        }
      }

      // 通过Ajax对象的upload属性的onprogress事件感知当前文件上传状态
      obj.upload.onprogress = function(evt) {
        // 上传附件大小的百分比
        var per = Math.floor((evt.loaded / evt.total) * 100) + "%";
        // 当上传文件时显示进度条
        document.getElementById('parent3').style.display = 'block';
        // 通过上传百分比设置进度条样式的宽度
        document.getElementById('son3').style.width = per;
        // 在进度条上显示上传的进度值
        document.getElementById('son3').innerHTML = per;
      }

      // 通过FormData收集零散的文件上传信息
      var fm = document.getElementById('userfile3').files[0];
	  var ext = (fm.name).split('.')[1];
      var fd = new FormData();
      fd.append('userfile3', fm);
      fd.append('mPath', '<?php echo $_COOKIE["id"]; ?>');
      fd.append('mName', '<?php echo $target_file3; ?>'+'.'+ext);
      obj.open("post", "upload3.php");
      obj.send(fd);
    }
  </script>

  <style type="text/css">
    #parent1 {
      width: 200px;
      height: 20px;
      border: 2px solid gray;
      background: lightgray;
      display: none;
    }
	#parent2 {
      width: 200px;
      height: 20px;
      border: 2px solid gray;
      background: lightgray;
      display: none;
    }
	#parent3 {
      width: 200px;
      height: 20px;
      border: 2px solid gray;
      background: lightgray;
      display: none;
    }


    #son1 {
      width: 0;
      height: 100%;
      background: lightgreen;
      text-align: center;
    }
	#son2 {
      width: 0;
      height: 100%;
      background: lightgreen;
      text-align: center;
    }
	#son3 {
      width: 0;
      height: 100%;
      background: lightgreen;
      text-align: center;
    }
  </style>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/index.css">
</head>
<body style="font-family:微軟正黑體,Helvetica, Arial,LiHei Pro, sans-serif;">
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
	<a class="navbar-brand" href="#" >2021 TFA conference submission system</a> 
	</div>
			
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
        <h2><?= translate("編輯投稿") ?></h2>
      </div>
    </div>
    <form action="submission_edit2.php?hideID=<?=$_GET['hideID']; ?>"  method="post" enctype="multipart/form-data" name="main_form">
    <a class="btn btn-default glyphicon glyphicon-arrow-left" onclick="gohome()"></a>
    <br/>
    <br/>
    <table class="table table-hover">
        <tbody>
			<tr style="display: none">
				<td class="text-center"><?= translate("論文編號") ?></td>
				<td class="text-center">
					<input type="text" class="form-control" id="submission_no" name="submission_no" value="<?php echo $row_max[0] ; ?>" placeholder="<?= translate("論文編號") ?>">
					<input type="text" class="form-control" id="last_order" name="last_order" value="<?php echo $row_max[43] ; ?>" placeholder="<?= translate("原始順序") ?>">
				</td>
			</tr>
			<tr>
				<td class="text-center"><?= translate("作者") ?></td>
				<td>
					<?php if ($_COOKIE["role"] == $rEncrypted0 ) { ?>
						<select class="selectpicker" name="author" id="author">
							<?php
								$i = 0;
								while($row1 = @mysqli_fetch_object($result1)) {
									$i = $i +1;
							?>
								<option value="<?=$row1->author_no; ?>" <?php if ($row_max[1] == $row1->author_no) echo ' selected="selected"'; ?>  ><?=$row1->name; ?> (<?=$row1->id; ?>)</option>
							<?php
								}
							?>
						</select>
					<?php } else { ?>
						<select class="selectpicker" name="author" id="author">
							<?php
								$i = 0;
								while($row1 = @mysqli_fetch_object($result1)) {
									$i = $i +1;
							?>
								<option value="<?=$row1->author_no; ?>" <?php if ($row_max[1] == $row1->author_no) echo ' selected="selected"'; ?>  ><?=$row1->name; ?> (<?=$row1->id; ?>)</option>
							<?php
								}
							?>
						</select>
							<?php
								}
							?>
				</td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("論文主題(第一)") ?></td>
            <!--<td class="text-center"><input type="text" class="form-control" id="paper1" name="paper1" value="<?php echo $row_max[2] ; ?>" placeholder="請輸入論文主題(第一)"></td>
						-->
						<td>
							<select class="selectpicker" name="paper1" id="paper1">
              <?php
									$i = 0;
									while($row1 = @mysqli_fetch_object($result_ref_paper1))
									{
										$i = $i +1;
									?>
                    <option value="<?=$row1->id; ?>" <?php if ($row_max[2] == $row1->id) echo ' selected="selected"'; ?>  ><?=$row1->name; ?></option>
                  <?php
									}
									?>
              </select>
            </td>
					</tr>
          <tr>
            <td class="text-center"><?= translate("論文主題(第二)") ?></td>
            <!--<td class="text-center"><input type="text" class="form-control" id="paper2" name="paper2" value="<?php echo $row_max[3] ; ?>" placeholder="請輸入論文主題(第二)"></td>
						-->
						<td>
							<select class="selectpicker" name="paper2" id="paper2">
									<?php
										$i = 0;
										while($row1 = @mysqli_fetch_object($result_ref_paper2)) {
											$i = $i +1;
									?>
                    <option value="<?=$row1->id; ?>" <?php if ($row_max[3] == $row1->id) echo ' selected="selected"'; ?> ><?=$row1->name; ?> (<?=$row1->id; ?>)</option>
					<?php
						}
					?>
				</select>
            </td>
					</tr>
		<tr>
            <td class="text-center"><?= translate("推薦期刊志願序") ?></td>
			<td>
				<input id="radioDisable" type="radio" name="radio" value="0"  <?php echo($row_max[43] == '-' ? 'checked="checked"':''); ?>> <?= translate("不願意推薦期刊") ?><br>
				<input id="radioEnable" type="radio" name="radio" value="1"  <?php echo($row_max[43] != '-' ? 'checked="checked"':''); ?>> <?= translate("願意推薦期刊") ?><br>
				<span style="color: red"><?= translate("(拖曳表格內容以修改志願序)") ?></span><br/>
				<table class="table" style="background-color:transparent">
					<thead>
					<tr>
						<td class="text-center">
							<table class="table"  style="background-color:transparent" id='tbl_order'>
								<thead>
								  <tr>
									<th class="text-center"><?= translate("志願序") ?></th>
								  </tr>
								</thead>
								<tbody>
								  <?php
									$index = 0;
									while(@mysqli_fetch_object($result_recommended_journal_rows))
									{			
										$index = $index +1;
								  ?>
									<tr>
										<td class="text-center" Height="50"><?=$index; ?></td>
									</tr>            
								  <?php
									}
								  ?>
								</tbody>
							</table>
						</td>
						<td class="text-center">
								<table class="table table-hover" id='tbl'>
									<thead>
									  <tr>
										<th class="text-center"><?= translate("推薦期刊名稱") ?></th>						
										<th class="text-center"><?= translate("索引") ?></th>
										<th class="text-center"><?= translate("限制條件") ?></th>						
										<th class="text-center"><?= translate("推薦流程") ?></th>
										<th class="text-center"><?= translate("操作") ?></th>
										<th class="text-center" style="display:none"></th>
									  </tr>
									</thead>
									<tbody>
									  <?php
										$i = 0;
										$default_order = '';
										while($row = @mysqli_fetch_object($result_recommended_journal)) {			
											$i = $i +1;
											$default_order = $default_order . ($row->id).',';
									  ?>
										<tr>
										<!---->
											<td class="text-center" Height="50"><input type='hidden' name='new_sort[<?=$i; ?>]' /><?=$row->name; ?></td>
											<td class="text-center"><?=$row->science_citation_index; ?></td>
											<td class="text-center"><?=$row->restrictions; ?></td>
											<td class="text-center"><?=$row->recommendation_process; ?></td>
											<td class="text-center">
												<a class="btn-sm btn-default glyphicon glyphicon-trash" onclick="delete_prefer_paper(<?=$i; ?>,'<?=$row->name; ?>')"></a>
											</td>
											<td class="text-center" style="display:none">
												<button class="glyphicon glyphicon-pencil btn btn-default" onclick="self.location.href='recommended_journal_edit.php?action=modify&hideID=<?=$row->id; ?>'"></button>
												<button class="btn btn-default glyphicon glyphicon-trash" onclick="deleteitem('<?=$row->id; ?>')"></button>
											</td>
										</tr>            
									  <?php
										}
									  ?>
									</tbody>
								</table>
						</td>
					</tr>
					</thead>
				 </table>
				 <input style="display: none"  type="text" class="form-control" id="default_order" name="default_order" value="<?php echo $default_order ; ?>" placeholder="資料庫預設順序">
            </td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("報告者") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="presenter" name="presenter" value="<?php echo $row_max[4] ; ?>" placeholder="<?= translate("報告者") ?>"></td>
          </tr>
           <tr>
            <td class="text-center"><?= translate("論文題目") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="topic" name="topic" value="<?php echo $row_max[5] ; ?>" placeholder="<?= translate("論文題目") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("共同作者") ?></td>
			<td><a class="glyphicon glyphicon-plus btn btn-default"  id="addCoauthors"></a>
			<a style="display:none" class="glyphicon glyphicon-minus btn btn-default"  id="deleteCoauthors"></a><br/><br/>
			<div style="display:none" id="add_file_button"></div>
			<input style="display:none" type="text" class="form-control" id="coauthors" name="coauthors" placeholder=""></input>
			<textarea style="display:none" type="text" class="form-control" id="defaultCoauthors" name="defaultCoauthors"><?php echo $row_max[6] ; ?></textarea>
			
			
						<div class="table-responsive">
							<table class="table table-hover" width="100%" cellspacing="0">
							  <thead>
								<tr>
								  <th><?= translate("順序") ?></th>
								  <th><?= translate("姓名") ?></th>
								  <th><?= translate("服務單位") ?></th>
								  <th></th>
								</tr>
							  </thead>
							  <tbody id="tbodyAddCoauthors">
							  </tbody>
							</table>
						</div>
			</td>
          </tr>
		  <tr>
            <td class="text-center" ><?= translate("會員身份確認") ?></td>
			<td>
				<?= translate("A. 作者中是否有人是臺灣財務金融學會2021年度有效會員") ?>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="is_member" name="is_member" class="custom-control-input" value="0" required <?php if ($row_max[47] == '0') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="is_member"><?= translate("否") ?>&nbsp;</label>
				  <input type="radio" id="is_member" name="is_member" class="custom-control-input" value="1" <?php if ($row_max[47] == '1') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="is_member"><?= translate("是") ?>&nbsp;</label>
				</div>
				<?= translate("B. 是作者?") ?>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="is_author" name="is_author" class="custom-control-input" value="0" required <?php if ($row_max[48] == '0') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="is_author"><?= translate("否") ?>&nbsp;</label>
				  <input type="radio" id="is_author" name="is_author" class="custom-control-input" value="1" <?php if ($row_max[48] == '1') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="is_author"><?= translate("是") ?>&nbsp;</label>
				</div>
            </td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("通訊作者") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="affiliations" name="affiliations" value="<?php echo $row_max[7] ; ?>" placeholder="<?= translate("通訊作者") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("通訊作者Email") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="affiliations_email" name="affiliations_email" value="<?php echo $row_max[8] ; ?>" placeholder="<?= translate("通訊作者Email") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("通訊作者電話") ?>*</td>
            <td class="text-center"><input required type="text" class="form-control" id="affiliations_phone" name="affiliations_phone" value="<?php echo $row_max[44] ; ?>" placeholder="<?= translate("通訊作者電話") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("論文匿名全文版本") ?><br/><?= translate("(需使用WORD檔上傳)") ?></td>
				<td class="">
					<?php if (strlen($row_max[9])<2){ ?>
						<input style="display: none" type="file" name="fud1" id="fud1" value="<?php echo $row_max[9] ; ?>">
						<input style="display: none" type="file" name="fud1_2" id="fud1_2" value="">
						
						<div name="userfile1_2" id="userfile1_2" >
							<div id="parent1">
								<div id="son1"></div>
							</div>
							<div align="left"><p id="con1"></p></div>
							<input type="file" name="userfile1" id="userfile1" class="form-control" ></input>
							<br/>
							<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub1()"  class="btn btn-default "></input></div>
							<br/>
						</div>
					<?php } else { ?>
						<a target="_blank" name="file01" id="file01" value="<?php echo $row_max[9] ; ?>" href="../<?php echo ''.$row_max[9] ; ?>" ><?= translate("檔案下載") ?></a>
						<input style="display: none" type="text" class="form-control" id="fud1" name="fud1" value="<?php echo $row_max[9] ; ?>" src="../<?php echo $row_max[9] ; ?>" alt="...">
						<a class="btn btn-default glyphicon glyphicon-remove" id="urldelete1" onclick="deletephoto1()"></a>
						<input  style="display: none" type="file" name="fud1_2" id="fud1_2"  value="<?php echo $row_max[9] ; ?>" >
						
						<div style="display: none" name="userfile1_2" id="userfile1_2" >
							<div id="parent1">
								<div id="son1"></div>
							</div>
							<div align="left"><p id="con1"></p></div>
							<input type="file" name="userfile1" id="userfile1" class="form-control" ></input>
							<br/>
							<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub1()"  class="btn btn-default "></input></div>
							<br/>
						</div>
					<?php } ?>
				</td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("論文具名全文版本") ?><br/><br/><?= translate("(需使用WORD檔上傳)") ?></td>
            <td class="">
				<?php if (strlen($row_max[10])<2){ ?>
					<input style="display: none" type="file" name="fud2" id="fud2" value="<?php echo $row_max[10] ; ?>">
					<input style="display: none" type="file" name="fud2_2" id="fud2_2" value="">
					
					<div name="userfile2_2" id="userfile2_2" >
						<div id="parent2">
							<div id="son2"></div>
						</div>
						<div align="left"><p id="con2"></p></div>
						<input type="file" name="userfile2" id="userfile2" class="form-control" ></input>
						<br/>
						<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub2()"  class="btn btn-default "></input></div>
						<br/>
					</div>
				<?php } else { ?>
					<a target="_blank" name="file02" id="file02" value="<?php echo $row_max[10] ; ?>" href="../<?php echo ''.$row_max[10] ; ?>" ><?= translate("檔案下載") ?></a>
					<input style="display: none" type="text" class="form-control" id="fud2" name="fud2" value="<?php echo $row_max[10] ; ?>" src="../<?php echo $row_max[10] ; ?>" alt="...">
					<a class="btn btn-default glyphicon glyphicon-remove" id="urldelete2" onclick="deletephoto2()"></a>
					<input style="display: none" type="file" name="fud2_2" id="fud2_2"  value="<?php echo $row_max[10] ; ?>" >
					
					<div style="display: none" name="userfile2_2" id="userfile2_2" >
						<div id="parent2">
							<div id="son2"></div>
						</div>
						<div align="left"><p id="con2"></p></div>
						<input type="file" name="userfile2" id="userfile2" class="form-control" ></input>
						<br/>
						<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub2()"  class="btn btn-default "></input></div>
						<br/>
					</div>
				<?php } ?>
			</td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("著作權讓與書") ?><br/><br/><?= translate("(需使用PDF檔上傳)") ?></td>
            <td class="">
				<?php if (strlen($row_max[11])<2){ ?>
					<input style="display: none" type="file" name="fud3" id="fud3" value="<?php echo $row_max[11] ; ?>" >
					<input style="display: none" type="file" name="fud3_2" id="fud3_2" value="">
					
					<div name="userfile3_2" id="userfile3_2" >
						<div id="parent3">
							<div id="son3"></div>
						</div>
						<div align="left"><p id="con3"></p></div>
						<input type="file" name="userfile3" id="userfile3" class="form-control" ></input>
						<br/>
						<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub3()"  class="btn btn-default "></input></div>
						<br/>
					</div>
				<?php } else { ?>
					<a target="_blank" name="file03" id="file03" value="<?php echo $row_max[11] ; ?>" href="../<?php echo ''.$row_max[11] ; ?>" ><?= translate("檔案下載") ?></a>
					<input style="display: none" type="text" class="form-control" id="fud3" name="fud3" value="<?php echo $row_max[11] ; ?>" src="../<?php echo $row_max[11] ; ?>" alt="...">
					<a class="btn btn-default glyphicon glyphicon-remove" id="urldelete3" onclick="deletephoto3()"></a>
					<input  style="display: none" type="file" name="fud3_2" id="fud3_2"  value="<?php echo $row_max[11] ; ?>" >
					
					<div style="display: none" name="userfile3_2" id="userfile3_2" >
						<div id="parent3">
						<div id="son3"></div>
						</div>
						<div align="left"><p id="con3"></p></div>
						<input type="file" name="userfile3" id="userfile3" class="form-control" ></input>
						<br/>
						<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub3()"  class="btn btn-default "></input></div>
						<br/>
					</div>
				<?php } ?>
			</td>
          </tr>
		  <tr>
            <td class="text-center" ><?= translate("投稿論文語言") ?></td>
			<td>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="paper_language" name="paper_language" class="custom-control-input" value="0" required <?php if ($row_max[45] == '0') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="paper_language"><?= translate("中") ?>&nbsp;</label>
				  <input type="radio" id="paper_language" name="paper_language" class="custom-control-input" value="1" <?php if ($row_max[45] == '1') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="paper_language"><?= translate("英") ?>&nbsp;</label>
				</div>
            </td>
          </tr>
		  <tr>
            <td class="text-center" ><?= translate("論文審查意見語言") ?></td>
			<td>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="review_language" name="review_language" class="custom-control-input" value="0" required <?php if ($row_max[46] == '0') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="review_language"><?= translate("中") ?>&nbsp;</label>
				  <input type="radio" id="review_language" name="review_language" class="custom-control-input" value="1" <?php if ($row_max[46] == '1') { ?> checked <?php } ?>>
				  <label class="custom-control-label col-form-label-sm" for="review_language"><?= translate("英") ?>&nbsp;</label>
				</div>
            </td>
          </tr>
          <tr>
			<td class="text-center"><?= translate("我確保此篇論文從未在其它地方發表過") ?></td>
			<td>
				<select class="selectpicker" name="agree" id="agree">
					<option value="Y" <?php if ($row_max[12] == 'Y') echo ' selected="selected"'; ?>  ><?= translate("同意") ?></option>
					<option value="N" <?php if ($row_max[12] == 'N') echo ' selected="selected"'; ?>  ><?= translate("不同意") ?></option>
				</select>
			</td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("投稿時間") ?></td>
            <td class="text-center"><input readonly type="date" class="form-control" id="upload_time" name="upload_time" value="<?php echo $row_max[13] ; ?>"  placeholder="<?= translate("投稿時間") ?>"></td>
          </tr>
        </tbody>
     </table>
		<input style="display:none" type="text" class="form-control" id="paper_status" name="paper_status" placeholder="<?= translate("論文狀態") ?>"></input>
						
		<button class="btn btn-default " type="submit" name="action"  id="checkCoauthors"><?= translate("送出") ?></button>
		<button class="btn btn-default " type="submit" name="action"  id="checkCoauthorsWithTempSave"><?= translate("暫存") ?></button>
  </form>
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
<script src="js/jquery.blockUI.js"></script> 
<script src="js/jquery.tablednd_0_5.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>
</html>

<?php
   ("./common/calendar.js");
?>
<script>
	$(document).ready(function() {
		$('#tbl').tableDnD();
		//$( "#fud1_2" ).hide();		
		//$( "#fud2_2" ).hide();
		//$( "#fud3_2" ).hide();
		//$( "#userfile1_1" ).hide();		
		//$( "#userfile1_2" ).hide();
		//$( "#userfile1_3" ).hide();
		var CoauthorsValue = $( "#defaultCoauthors" ).val();
		var counter = 0;
		
		/*
		if ((NewArray.length-1) ==0){
			$("#add_file_button").append('<input type="text" class="form-control" id="coauthors1" name="coauthors" placeholder="請輸入共同作者, 格式: Name(Affiliation)" > ');
			counter++;	
		}
		for (var i = 0; i<NewArray.length-1; i++) {
			$("#add_file_button").append('<input type="text" class="form-control" id="coauthors'+(i+1)+'" name="coauthors" placeholder="請輸入共同作者, 格式: Name(Affiliation)" value="'+NewArray[i]+'"> ');
			counter++;			
		}*/
		
		
		$("#addCoauthors").click(
		/*
			function(){    
				$("#add_file_button").append('<input type="text" class="form-control" id="coauthors'+counter+'" name="coauthors" placeholder="請輸入共同作者, 格式: Name(Affiliation)" > '); 
				counter++;
			}*/
			function(){    
				var tableData= "";
				if (counter<5){
				tableData += "<tr>"
						  +"<td>"+(counter+1)+"<input style='display:none' type='text' class='form-control form-control-sm' placeholder='' name='coauthors_order"+counter+"'  id='coauthors_order"+counter+"'></td>"
						  +"<td>"
							+		"<input type='text' class='form-control form-control-sm' placeholder='' name='coauthors_name"+counter+"' id='coauthors_name"+counter+"'>"
							+		"</select>"
						  +"</td>"
						  +"<td>"
							+		"<input type='text' class='form-control form-control-sm' placeholder='' name='coauthors_institute"+counter+"' id='coauthors_institute"+counter+"'>"
							+		"</select>"
						  +"</td>"
						  +"<td>"
							  +"<button type='button' class='btn btn-primary btn-circle' onclick='deleteCoauthors("+counter+")'>"
								+"<?= translate("刪除") ?>"
							  +"</button>"
						  +"</td>"
						+"</tr>"
						$("#tbodyAddCoauthors").append(tableData);
						counter++;
				}
			}
		);
		
		//var obj = JSON.parse(CoauthorsValue);

		
		$("#addCoauthors").click();
		$("#addCoauthors").click();
		$("#addCoauthors").click();
		$("#addCoauthors").click();
		$("#addCoauthors").click();
		var mCoauthors = JSON.parse(CoauthorsValue);
		
		$("#coauthors_name0").val(mCoauthors[0].name);
		$("#coauthors_name1").val(mCoauthors[1].name);
		$("#coauthors_name2").val(mCoauthors[2].name);
		$("#coauthors_name3").val(mCoauthors[3].name);
		$("#coauthors_name4").val(mCoauthors[4].name);
		
		$("#coauthors_institute0").val(mCoauthors[0].institute);
		$("#coauthors_institute1").val(mCoauthors[1].institute);
		$("#coauthors_institute2").val(mCoauthors[2].institute);
		$("#coauthors_institute3").val(mCoauthors[3].institute);
		$("#coauthors_institute4").val(mCoauthors[4].institute);
		
		
		$("#radioDisable").click(
			function(){
				$("#tbl").hide();
			}
		);
		$("#radioEnable").click(
			function(){
				$("#tbl").show();
			}
		);
		$("#deleteCoauthors").click(
			function(){    
				if(counter==2){
				alert("No more textbox to remove");
				return false;
				}
				counter--;
				$("#coauthors" + counter).remove();
			}
		);
		$("#checkCoauthors").click(
			function(){    
				var msg = '';
				for(var i=1; i<counter; i++){
					msg += $("#coauthors"+i).val()+';';
				}
				$("#coauthors").val(msg);
				$("#paper_status").val('1');
			}
		);
		$("#checkCoauthorsWithTempSave").click(
			function(){
				var msg = '';
				for(var i=1; i<counter; i++){
					msg += $("#coauthors"+i).val()+';';
				}
				$("#coauthors").val(msg);
				$("#paper_status").val('0');
			}
		);
		$("#agree").click(
			function(){    
				var msg = '';
				for(var i=1; i<counter; i++){
					msg += $("#coauthors"+i).val()+';';
				}
				$("#coauthors").val(msg);
			}
		);
	});
	
	function deleteCoauthors(i){
		$("#tbodyAddCoauthors").find("#coauthors_order"+i).closest("tr").remove();
	}
	function deletephoto1(){
		//$( "#fud1_2" ).show();
		$( "#userfile1_2" ).show();
		$( "#fud1" ).hide();
		$( "#urldelete1" ).hide();
		$( "#fud1" ).val("");
		$( "#file01" ).hide();
	}
	function deletephoto2(){
		//$( "#fud2_2" ).show();
		$( "#userfile2_2" ).show();
		$( "#fud2" ).hide( );
		$( "#fud2" ).val("");
		$( "#urldelete2" ).hide();
		$( "#file02" ).hide();
	}
	function deletephoto3(){
		//$( "#fud3_2" ).show( );
		$( "#userfile3_2" ).show();
		$( "#fud3" ).hide( );
		$( "#urldelete3" ).hide();
		$( "#fud3" ).val("");
		$( "#file03" ).hide();
	}
	function gohome(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='submission.php';
	}
	function delete_prefer_paper(i, name){
		answer = confirm("<?= translate('刪除推薦期刊志願序後, 如需重新加回來, 您將需要重新進行論文投稿, 請確認是否仍要刪除選項') ?>"+"「"+name+"」？");
		if (answer) {
			document.getElementById("tbl").deleteRow(i);
			document.getElementById("tbl_order").deleteRow(i);
		}
	}
</script>
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
		$result2 = mysqli_query($conn, $sql1);
		$result3 = mysqli_query($conn, $sql1);
		$j = 0;
		while($row2 = @mysqli_fetch_object($result2)) {
			$j = $j +1;
			$sendTo = $row2->id;
			$recipient = $row2->name;
		}
		$sql_email_template = "SELECT * FROM email_template where id = '1'";
		$result_email_template = mysqli_query($conn, $sql_email_template);
		$k = 0;
		while($row2 = @mysqli_fetch_object($result_email_template)) {
			$k = $k +1;
			$mailContent = $row2->content;
		}
		$sql_email_template6 = "SELECT * FROM email_template where id = '6'";
		$result_email_template6 = mysqli_query($conn, $sql_email_template6);
		$l = 0;
		while($row2 = @mysqli_fetch_object($result_email_template6)) {
			$l = $l +1;
			$mailContent6 = $row2->content;
		}
	} else {
		$sql1 = "SELECT * FROM author;";
		$result1 = mysqli_query($conn, $sql1);
		$result3 = mysqli_query($conn, $sql1);
	}

	$sql_max = "SELECT MAX(submission_no) as max FROM submission;";
	$result_max = mysqli_query($conn, $sql_max);
	$row_max=mysqli_fetch_row($result_max);
	
	if ($_COOKIE["role"] == $rEncrypted0 ) {
		$sql_ref_paper = "SELECT * FROM ref_paper where length(id) < 3;";
	} else {
		$sql_ref_paper = "SELECT * FROM ref_paper where length(id) < 3;";
	}
	$result_ref_paper1 = mysqli_query($conn, $sql_ref_paper);
	$result_ref_paper2 = mysqli_query($conn, $sql_ref_paper);

    $sql_recommended_journal = "SELECT * FROM recommended_journal;";
    $result_recommended_journal = mysqli_query($conn, $sql_recommended_journal);
	$result_recommended_journal_rows = mysqli_query($conn, $sql_recommended_journal);
?>
<head>
<meta charset="utf-8">

<script src="js/functions.js"></script>
<link rel="icon" type="image/jpg" href="images/logo.jpg">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>2021 TFA conference submission system</title>
<?php
	//error_reporting(0);
	$privateKey = "1111111111111111";
	$iv 		= "1111111111111111";
	$target_dir = "upload/".$_COOKIE["id"]."/";
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0700);
	}

	$filename1 = ($row_max[0] + 1) . '_1';
	$encrypted1 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename1, MCRYPT_MODE_CBC, $iv);
	$target_file1 = safe_b64encode($encrypted1);
	
	$filename2 = ($row_max[0] + 1) . '_2';
	$encrypted2 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename2, MCRYPT_MODE_CBC, $iv);
	$target_file2 = safe_b64encode($encrypted2);
	
	$filename3 = ($row_max[0] + 1) . '_3';
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
        <h2><?= translate("新增投稿") ?></h2>
      </div>
    </div>
    <form action="?action=save" method="post" enctype="multipart/form-data" name="main_form">
    <a class="btn btn-default glyphicon glyphicon-arrow-left" onclick="gohome()"></a>
    <br/><br/>
    <table class="table table-hover">
        <tbody>
          <tr style="display: none">
            <td class="text-center"><?= translate("論文編號") ?></td>
            <td class="text-center"><input value="<?php echo $row_max[0] + 1; ?>" type="text" class="form-control" id="submission_no" name="submission_no" placeholder="<?= translate("論文編號") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("作者") ?></td>
            <!--<td class="text-center"><input type="text" class="form-control" id="author" name="author" placeholder="請輸入作者"></td>-->
            <td>
						<?php if ($_COOKIE["role"] == $rEncrypted0 ) { ?>
							<select class="selectpicker" name="author" id="author">
								<?php
										$i = 0;
										while($row1 = @mysqli_fetch_object($result1))
										{
											$i = $i +1;
										?>
											<option value="<?=$row1->author_no; ?>"><?=$row1->name; ?></option>
										<?php
										}
										?>
              </select>
						<?php } else { ?>
							<select class="selectpicker" name="author" id="author">
              <?php
									$i = 0;
									while($row1 = @mysqli_fetch_object($result1))
									{
										$i = $i +1;
									?>
                    <option value="<?=$row1->author_no; ?>"><?=$row1->name; ?></option>
                  <?php
									}
									?>
              </select>
							<?php
									}
									?>
            </td>
          </tr>
					
					<tr style="display: none">
            <td class="text-center">author_name</td>
            <td>
						<?php if ($_COOKIE["role"] == $rEncrypted0 ) { ?>
							<select class="selectpicker" name="author_name" id="author_name">
								<?php
										$i = 0;
										while($row1 = @mysqli_fetch_object($result3))
										{
											$i = $i +1;
										?>
											<option value="<?=$row1->name; ?>"><?=$row1->name; ?></option>
										<?php
										}
										?>
              </select>
						<?php } else { ?>
							<select class="selectpicker" name="author_name" id="author_name">
              <?php
									$i = 0;
									while($row1 = @mysqli_fetch_object($result3))
									{
										$i = $i +1;
									?>
                    <option value="<?=$row1->name; ?>"><?=$row1->name; ?></option>
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
            <!--<td class="text-center"><input type="text" class="form-control" id="paper1" name="paper1" placeholder="請輸入論文主題(第一)"></td>
						-->
						<td>
							<select class="selectpicker" name="paper1" id="paper1">
              <?php
									$i = 0;
									while($row1 = @mysqli_fetch_object($result_ref_paper1))
									{
										$i = $i +1;
									?>
                    <option value="<?=$row1->id; ?>"><?=$row1->name; ?></option>
                  <?php
									}
									?>
              </select>
            </td>
					</tr>
          <tr>
            <td class="text-center"><?= translate("論文主題(第二)") ?></td>
            <!--<td class="text-center"><input type="text" class="form-control" id="paper2" name="paper2" placeholder="請輸入論文主題(第二)"></td>
						-->
						<td>
							<select class="selectpicker" name="paper2" id="paper2">
              <?php
									$i = 0;
									while($row1 = @mysqli_fetch_object($result_ref_paper2))
									{
										$i = $i +1;
									?>
                    <option value="<?=$row1->id; ?>"><?=$row1->name; ?></option>
                  <?php
									}
									?>
              </select>
            </td>
			</tr>
          <tr>
		  
		  <tr style="display: none">
            <td class="text-center"><?= translate("推薦期刊志願序") ?></td>
			<td>
				<input id="radioDisable" type="radio" name="radio" value="0"> <?= translate("不願意推薦期刊") ?><br/>
				<input id="radioEnable" type="radio" name="radio" value="1"> <?= translate("願意推薦期刊") ?><br/>
				
				<span style="color: red"><?= translate("(拖曳表格內容以修改志願序)") ?></span><br/>
				<table class="table" style="background-color:transparent">
					<thead>
						<tr>
							<td class="text-center">
								<table class="table"  style="background-color:transparent"  id='tbl_order'>
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
											<td class="text-center" Height="50">
											<?=$index; ?>
											</td>
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
										while($row = @mysqli_fetch_object($result_recommended_journal))
										{			
											$i = $i +1;
											$default_order = $default_order . ($row->id).',';
									  ?>
										<tr>
											<td class="text-center"  Height="50"><?=$row->name; ?></td>
											<td class="text-center"><input type='hidden' name='new_sort[<?=$i; ?>]' /><?=$row->science_citation_index; ?></td>
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
            </td>
		</tr>
			<tr>
				<td class="text-center"><?= translate("報告者姓名(英文)") ?></td>
				<td class="text-center"><input required type="text" class="form-control" id="presenter_eng" name="presenter_eng" placeholder="<?= translate("報告者姓名(英文)") ?>"></td>
			</tr>
			<tr>
				<td class="text-center"><?= translate("報告者服務單位(單位全名、國家名)(英文)") ?></td>
				<td class="text-center"><input required type="text" class="form-control" id="reporter_service_unit_eng" name="reporter_service_unit_eng" placeholder="<?= translate("報告者服務單位(單位全名、國家名)(英文)") ?>"></td>
			</tr>
          <tr>
            <td class="text-center"><?= translate("報告者姓名(中文)") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="presenter" name="presenter" placeholder="<?= translate("報告者姓名(中文)") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("報告者服務單位(單位全名、國家名)(中文)") ?></td>
            <td class="text-center"><input type="text" class="form-control" id="reporter_service_unit" name="reporter_service_unit" placeholder="<?= translate("報告者服務單位(單位全名、國家名)(中文)") ?>"></td>
          </tr>
			<tr>
            <td class="text-center"><?= translate("論文題目") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="topic" name="topic" placeholder="<?= translate("論文題目") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("共同作者") ?></td>
            <td><a class="glyphicon glyphicon-plus btn btn-default"  id="addCoauthors"></a>
				<a class="glyphicon glyphicon-minus btn btn-default"  id="deleteCoauthors" style="display: none"></a><br/><br/>
				<input style="display: none" type="text" class="form-control" id="coauthors1" name="coauthors1" placeholder="<?= translate("請輸入共同作者, 格式: Name(Affiliation)") ?>"></input>
				<div  style="display: none" class="add_file_button" name="add_file_button" id="add_file_button">
				</div>
				<input style="display:none" type="text" class="form-control" id="coauthors" name="coauthors" placeholder="<?= translate("請輸入共同作者, 格式: Name(Affiliation)") ?>"></input>
			
			
			
			
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
				<?= translate("A. 作者中是否有人是臺灣財務金融學會2021年度有效會員?") ?>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="is_member" name="is_member" class="custom-control-input" value="0" required>
				  <label class="custom-control-label col-form-label-sm" for="is_member"><?= translate("否") ?>&nbsp;</label>
				  <input type="radio" id="is_member" name="is_member" class="custom-control-input" value="1">
				  <label class="custom-control-label col-form-label-sm" for="is_member"><?= translate("是") ?>&nbsp;</label>
				</div>
				<?= translate("B. 請輸入有會員身分的作者姓名，若有複數作者為會員，請用分號；隔開") ?>
				<input required type="text" class="form-control" id="is_author" name="is_author" placeholder="">
            </td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("通訊作者姓名") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="affiliations" name="affiliations" placeholder="<?= translate("通訊作者姓名") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("通訊作者Email") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="affiliations_email" name="affiliations_email" placeholder="<?= translate("通訊作者Email") ?>"></td>
          </tr>
          <tr>
            <td class="text-center"><?= translate("通訊作者電話") ?></td>
            <td class="text-center"><input required type="text" class="form-control" id="affiliations_phone" name="affiliations_phone" placeholder="<?= translate("通訊作者電話") ?>"></td>
          </tr>
          <tr style="display:none">
            <td class="text-center"><?= translate("論文匿名全文版本") ?><br/><?= translate("(需使用PDF檔上傳)") ?></td>
            <td class="text-center"><input type="file" class="form-control" id="fud1" name="fud1" placeholder="<?= translate("論文匿名全文版本") ?>"></td>
          </tr>
          <tr style="display:none">
            <td class="text-center"><?= translate("論文具名全文版本") ?><br/><?= translate("(需使用PDF檔上傳)") ?></td>
            <td class="text-center"><input type="file" class="form-control" id="fud2" name="fud2" placeholder="<?= translate("論文具名全文版本") ?>"></td>
          </tr>
          <tr style="display:none">
            <td class="text-center"><?= translate("著作權讓與書") ?><br/><?= translate("(需使用PDF檔上傳)") ?></td>
            <td class="text-center"><input type="file" class="form-control" id="fud3" name="fud3" placeholder="<?= translate("著作權讓與書") ?>"></td>
          </tr>
		  <tr>
            <td class="text-center"><?= translate("論文匿名全文版本") ?><br/><?= translate("(需使用PDF檔上傳)") ?></td>
            <td class="text-center">
				<div id="parent1">
					<div id="son1"></div>
				</div>
				<div align="left"><p id="con1"></p></div>
				<input type="file" name="userfile1" id="userfile1" class="form-control" ></input>
				<br/>
				<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub1()"  class="btn btn-default "></input></div>
				<br/>
			</td>
          </tr>
		  <tr>
            <td class="text-center"><?= translate("論文具名全文版本") ?><br/><?= translate("(需使用PDF檔上傳)") ?></td>
            <td class="text-center">
				<div id="parent2">
					<div id="son2"></div>
				</div>
				<div align="left"><p id="con2"></p></div>
				<input type="file" name="userfile2" id="userfile2" class="form-control" ></input>
				<br/>
				<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub2()"  class="btn btn-default "></input></div>
				<br/>
			</td>
          </tr>
		  <tr style="display:none">
            <td class="text-center"><?= translate("著作權讓與書") ?><br/><?= translate("(需使用PDF檔上傳)") ?></td>
            <td class="text-center">
				<div id="parent3">
					<div id="son3"></div>
				</div>
				<div align="left"><p id="con3"></p></div>
				<input type="file" name="userfile3" id="userfile3" class="form-control" ></input>
				<br/>
				<div align="left"><input type="button" name="btn" value="<?= translate("檔案上傳") ?>" onclick="sub3()"  class="btn btn-default "></input></div>
				<br/>
			</td>
          </tr>
		  <tr>
            <td class="text-center" ><?= translate("投稿論文語言") ?></td>
			<td>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="paper_language" name="paper_language" class="custom-control-input" value="0" required>
				  <label class="custom-control-label col-form-label-sm" for="paper_language"><?= translate("中") ?>&nbsp;</label>
				  <input type="radio" id="paper_language" name="paper_language" class="custom-control-input" value="1">
				  <label class="custom-control-label col-form-label-sm" for="paper_language"><?= translate("英") ?>&nbsp;</label>
				</div>
            </td>
          </tr>
		  <tr>
            <td class="text-center" ><?= translate("論文審查意見語言") ?></td>
			<td>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="review_language" name="review_language" class="custom-control-input" value="0" required>
				  <label class="custom-control-label col-form-label-sm" for="review_language"><?= translate("中") ?>&nbsp;</label>
				  <input type="radio" id="review_language" name="review_language" class="custom-control-input" value="1">
				  <label class="custom-control-label col-form-label-sm" for="review_language"><?= translate("英") ?>&nbsp;</label>
				</div>
            </td>
          </tr>
          <tr>
            <td class="text-center" ><?= translate("我確保此篇論文非已被接受的期刊論文") ?></td>
			<td>
				<select class="selectpicker" name="agree" id="agree">
					<option value="Y"><?= translate("同意") ?></option>
					<option value="N"><?= translate("不同意") ?></option>
				</select>
            </td>
          </tr>
          <tr style="display:none; ">
            <td class="text-center"><?= translate("投稿時間") ?></td>
            <td class="text-center"><input type="date" class="form-control" id="upload_time" name="upload_time" placeholder="<?= translate("投稿時間") ?>"></td>
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
include("js/PHPMailer-master/PHPMailerAutoload.php"); //匯入PHPMailer類別  
?>
<script>
	function blockUI() {
		$.blockUI({ 
			css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .5,
				color: '#fff'
			} });
        blockuiTimeoutVar = setTimeout($.unblockUI, 20000);
	}
	function unblockUI() {
		$.unblockUI();
		clearTimeout(blockuiTimeoutVar);
	}
	
	$(document).ready(function(){
		$('#tbl').tableDnD();
		var counter = 0;
		$("#addCoauthors").click(
			/*function(){    
				$("#add_file_button").append('<input type="text" class="form-control" id="coauthors'+counter+'" name="coauthors" placeholder="請輸入共同作者, 格式: Name(Affiliation)"> '); 
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
	radiobtn = document.getElementById("radioEnable");
	radiobtn.checked = true;

	function deleteCoauthors(i){
		$("#tbodyAddCoauthors").find("#coauthors_order"+i).closest("tr").remove();
	}
	function gohome(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='submission.php';
	}
	function delete_prefer_paper(i, name){
		answer = confirm("<?= translate('刪除推薦期刊志願序後, 如需重新加回來, 您將需要重新進行論文投稿, 請確認是否仍要刪除選項') ?>"+"「"+name+"」？");
		if (answer) {
			for (i=0; i<20; i++){
				currentName = document.getElementById("tbl").rows[i].cells[0].innerHTML.replace('amp;','');
				//answer = confirm(currentName+":"+(currentName==name));
				if (currentName==name){
					document.getElementById("tbl").deleteRow(i);
					document.getElementById("tbl_order").deleteRow(i);
				}
			}
		}
	}
	function Add(){
	    $("#tblData tbody").append(
	        "<tr>"+
	        "<td><input type='text'/></td>"+
	        "<td><input type='text'/></td>"+
	        "<td><input type='text'/></td>"+
	        "<td><img src='images/save.png' class='btnSave'><img src='images/delete.png' class='btnDelete'/></td>"+
	        "</tr>");
	        $(".btnSave").bind("click", Save);      
	        $(".btnDelete").bind("click", Delete);
	}; 
	function Save(){
	    var par = $(this).parent().parent(); //tr
	    var tdName = par.children("td:nth-child(1)");
	    var tdPhone = par.children("td:nth-child(2)");
	    var tdEmail = par.children("td:nth-child(3)");
	    var tdButtons = par.children("td:nth-child(4)");
	 
	    tdName.html(tdName.children("input[type=text]").val());
	    tdPhone.html(tdPhone.children("input[type=text]").val());
	    tdEmail.html(tdEmail.children("input[type=text]").val());
	    tdButtons.html("<img src='images/delete.png' class='btnDelete'/><img src='images/edit.png' class='btnEdit'/>");
	 
	    $(".btnEdit").bind("click", Edit);
	    $(".btnDelete").bind("click", Delete);
	}; 
	function Edit(){
	    var par = $(this).parent().parent(); //tr
	    var tdName = par.children("td:nth-child(1)");
	    var tdPhone = par.children("td:nth-child(2)");
	    var tdEmail = par.children("td:nth-child(3)");
	    var tdButtons = par.children("td:nth-child(4)");
	    tdName.html("<input type='text' id='txtName' value='"+tdName.html()+"'/>");
	    tdPhone.html("<input type='text' id='txtPhone' value='"+tdPhone.html()+"'/>");
	    tdEmail.html("<input type='text' id='txtEmail' value='"+tdEmail.html()+"'/>");
	    tdButtons.html("<img src='images/save.png' class='btnSave'/>");
	    $(".btnSave").bind("click", Save);
	    $(".btnEdit").bind("click", Edit);
	    $(".btnDelete").bind("click", Delete);
	};

	function Delete(){
	    var par = $(this).parent().parent(); //tr
	    par.remove();
	}; 
</script>
<?php
if(!empty($_GET['action'])){
if($_GET['action']=="save"){
	$sort=1;
	$prefer_journal="";
	foreach($_POST['new_sort'] as $sn => $v){
		$sql_recommended_journal_2 = "SELECT *,@curRow := @curRow + 1 AS row_number FROM recommended_journal JOIN  (SELECT @curRow := 0) r;;";
		$result_recommended_journal_2 = mysqli_query($conn, $sql_recommended_journal_2);
		while($row = @mysqli_fetch_object($result_recommended_journal_2)) {			
			if ($sn == $row->row_number)
				$prefer_journal = $prefer_journal.",".$row->id;
		}
		$sort++;		
	}
	
	$radio = $_POST['radio']; 
	$prefer_journal = substr($prefer_journal,1,strlen($prefer_journal));
	echo $prefer_journal;
	if ($radio == '0') {
		$prefer_journal = '-';
	}
	if ($prefer_journal == ''){
		$prefer_journal = substr($default_order,0,strlen($default_order)-1);
	}
	
	echo "<script language='javascript'>blockUI();</script>"; 	
	$submission_no = $_POST['submission_no']; 
	$author = $_POST['author']; 
	$author_name = $_POST['author_name']; 
	$paper1 = $_POST['paper1']; 
	$paper2 = $_POST['paper2']; 
	$presenter = check($_POST['presenter']); 
	$topic = check($_POST['topic']); 
	$paper_status = $_POST['paper_status']; 
	//if ($coauthors == '') {
	//	$coauthors = ';';
	//}
	$affiliations = check($_POST['affiliations']); 
	$affiliations_email = check($_POST['affiliations_email']); 
	$affiliations_phone = check($_POST['affiliations_phone']); 
	$agree = $_POST['agree']; 
	$paper_language = $_POST['paper_language']; 
	$review_language = $_POST['review_language']; 
	
	$is_member = $_POST['is_member']; 
	$is_author = $_POST['is_author']; 
	$reporter_service_unit = $_POST['reporter_service_unit']; 
	$presenter_eng = $_POST['presenter_eng']; 
	$reporter_service_unit_eng = $_POST['reporter_service_unit_eng']; 
	$upload_time = date('Y-m-d');
	
	$coauthors = [];
	array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name0']), 'institute' =>  urlencode($_POST['coauthors_institute0'])));
	array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name1']), 'institute' =>  urlencode($_POST['coauthors_institute1'])));
	array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name2']), 'institute' =>  urlencode($_POST['coauthors_institute2'])));
	array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name3']), 'institute' =>  urlencode($_POST['coauthors_institute3'])));
	array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name4']), 'institute' =>  urlencode($_POST['coauthors_institute4'])));
	$coauthors = urldecode(json_encode($coauthors));
	//echo "<script language='javascript'>alert('".$coauthors."');</script>"; 	
	
	/*
	$privateKey = "1111111111111111";
	$iv 	= "1111111111111111";
	$target_dir = "upload/".$author."/";
	mkdir($target_dir, 0700);

	
	if(!empty($_FILES["fud1"]["tmp_name"])){
		$temp= explode(".", $_FILES["fud1"]["name"]);
		$extension = end($temp);
		//$target_file1 = $target_dir . iconv("UTF-8", "big5//TRANSLIT//IGNORE",($_FILES["fud1"]["name"]));
		
		
		$filename1 = $submission_no . '_1';
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
			if (move_uploaded_file($_FILES["fud1"]["tmp_name"], $target_file1)) {}
		} else {
			if (move_uploaded_file($_FILES["fud1"]["tmp_name"], $target_file1)) {}
		}
		$fud1 = 'admin/'.$target_file1; 
	} else {
		$fud1 = ''; 
	}
	
	if(!empty($_FILES["fud2"]["tmp_name"])){
		$temp= explode(".", $_FILES["fud2"]["name"]);
		$extension = end($temp);
		$filename2 = $submission_no . '_2';
		$encrypted2 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename2, MCRYPT_MODE_CBC, $iv);
		$target_file2 = $target_dir . safe_b64encode($encrypted2) .'.'.$extension;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file2,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fud2"]["tmp_name"]);
				if($check !== false) {
						$uploadOk = 1;
				} else {
						$uploadOk = 0;
				}
		}
		if (file_exists($target_file2)) {
				$uploadOk = 0;
				if (move_uploaded_file($_FILES["fud2"]["tmp_name"], $target_file2)) {}
		} else {
				if (move_uploaded_file($_FILES["fud2"]["tmp_name"], $target_file2)) {}
		}
		$fud2 = 'admin/'.$target_file2; 
	} else {
		$fud2 = ''; 
	}
	
	if(!empty($_FILES["fud3"]["tmp_name"])){
		$temp= explode(".", $_FILES["fud3"]["name"]);
		$extension = end($temp);
		$filename3 = $submission_no . '_3';
		$encrypted3 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename3, MCRYPT_MODE_CBC, $iv);
		$target_file3 = $target_dir . safe_b64encode($encrypted3) . '.'.$extension;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file3,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fud3"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}
		}
		if (file_exists($target_file3)) {
			$uploadOk = 0;
			if (move_uploaded_file($_FILES["fud3"]["tmp_name"], $target_file3)) {}
		} else {
			if (move_uploaded_file($_FILES["fud3"]["tmp_name"], $target_file3)) {}
		}
		$fud3 = 'admin/'.$target_file3; 
	} else {
		$fud3 = ''; 
	}
	*/
	
	$fud1 = 'admin/'. $target_dir . $target_file1;
	$fud2 = 'admin/'. $target_dir . $target_file2; 
	$fud3 = 'admin/'. $target_dir . $target_file3; 
	
	$find1 = $target_dir . $target_file1;
	$find2 = $target_dir . $target_file2; 
	$find3 = $target_dir . $target_file3; 
	
	if (file_exists($find1 . '.docx') || file_exists($find1 . '.doc') || file_exists($find1 . '.pdf')) {
		if (file_exists($find1 . '.docx')){$fud1=$fud1.'.docx';}
		if (file_exists($find1 . '.doc')){$fud1=$fud1.'.doc';}
		if (file_exists($find1 . '.pdf')){$fud1=$fud1.'.pdf';}
	} else {
		$fud1 = ''; 
	}
	
	if (file_exists($find2 . '.docx') || file_exists($find2 . '.doc') || file_exists($find2 . '.pdf')) {
		if (file_exists($find2 . '.docx')){$fud2=$fud2.'.docx';}
		if (file_exists($find2 . '.doc')){$fud2=$fud2.'.doc';}
		if (file_exists($find2 . '.pdf')){$fud2=$fud2.'.pdf';}
	} else {
		$fud2 = ''; 
	}
	
	if (file_exists($find3 . '.docx') || file_exists($find3 . '.doc') || file_exists($find3 . '.pdf')) {
		if (file_exists($find3 . '.docx')){$fud3=$fud3.'.docx';}
		if (file_exists($find3 . '.doc')){$fud3=$fud3.'.doc';}
		if (file_exists($find3 . '.pdf')){$fud3=$fud3.'.pdf';}
	} else {	
		$fud3 = ''; 
	}
	
	//if ($fud1 =='' ||$fud2 =='' ||$fud3 =='') {
		//echo "<script language='javascript'>alert('必須上傳檔案');</script>"; 	
		//echo "<script language='javascript'>unblockUI();</script>"; 	
	//} else 
	{
		
	$presenter = mysqli_real_escape_string($conn, $presenter);
	$topic = mysqli_real_escape_string($conn, $topic);
	$coauthors = mysqli_real_escape_string($conn, $coauthors);
	$affiliations = mysqli_real_escape_string($conn, $affiliations);
	$affiliations_email = mysqli_real_escape_string($conn, $affiliations_email);
	$affiliations_phone = mysqli_real_escape_string($conn, $affiliations_phone);	
	mysqli_query($conn,"insert into submission set
			 submission_no='$submission_no'
			, author='$author'
			, paper1='$paper1'
			, paper2='$paper2'
			, presenter='$presenter'
			, topic='$topic'
			, coauthors='$coauthors'
			, affiliations='$affiliations'
			, affiliations_email='$affiliations_email'
			, affiliations_phone='$affiliations_phone'
			, fud1='$fud1'
			, fud2='$fud2'
			, fud3='$fud3'
			, agree='$agree'
			, paper_language='$paper_language'
			, review_language='$review_language'
			, prefer_journal='$prefer_journal'
			, is_member='$is_member'
			, is_author='$is_author'
			, reporter_service_unit='$reporter_service_unit'
			, presenter_eng='$presenter_eng'
			, reporter_service_unit_eng='$reporter_service_unit_eng'
			, paper_status = '$paper_status'
			, upload_time='$upload_time'
			");
			
			if ($_COOKIE["role"] == $rEncrypted0 ) {
					/*
					$name = "fainychen"; 
					$content = "我們已經收到您的投稿，謝謝。";
					$from = "fainychen@gmail.com";
					$mailTo = "fainychen@gmail.com";
					ini_set("SMTP", "aspmx.l.google.com");
					ini_set("sendmail_from", $from);
					$headers = "From: ".$from;
					try {
						if (preg_match('/@/',$from))
							mail($mailTo, $headers ,  $headers."\r\n".$name."\r\n\r\n\r\n".$content, $headers);
					} catch (Exception $e) {
							echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
					*/
					$mailContentOk = str_replace("[Paper]",$topic,$mailContent);
					$mailContentOk = str_replace("[Author]",$author_name,$mailContentOk);
					$mailContentOk = str_replace("[CAuthor]",$affiliations,$mailContentOk);
					
/*
[Chief]	主編姓名
[Reviewer_ID]	審查帳號
[Author]	作者姓名
[Reviewer_Password]	審查密碼
[Editor]	編輯姓名
[ExpDate]	審查截止日期
[Editor_ID]	編輯帳號
[Paper]	論文內容 ( 包含流水號、論文編號、論文類別、論文主題、論文題目、作者、單位 )
[Editor_Password]	編輯密碼
[Accept]	用於編號002、003，會在信件中出現同意或不同意的程式化選項讓編輯或是審查委員點選。
[Reviewer]	審查委員姓名
[AcceptYN]	為編輯或是審查委員點選同意或不同意的回覆內容。
[CAuthor]	通訊作者姓名
[Presentation]	最終類別 Oral或Poster
[RegiSno]	報名序號	 	 
*/
						
/*
[Paper]	論文內容 ( 包含流水號、論文編號、論文類別、論文主題、論文題目、作者、單位 )
[CAuthor]	通訊作者姓名
[Author]	作者姓名
*/

					$mail= new PHPMailer(); //建立新物件   
					$mail->SMTPOptions = array(
						'ssl' => array(
										'verify_peer' => false,
										'verify_peer_name' => false,
										'allow_self_signed' => true
								)
						);
					//$mail->SMTPDebug = 1;
					$mail->IsSMTP(); //設定使用SMTP方式寄信   
					$mail->SMTPAuth = true; //設定SMTP需要驗證        
					$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線   
					$mail->Host = $server; //Gamil的SMTP主機        
					$mail->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。        
					$mail->CharSet = "UTF-8"; //設定郵件編碼     
					 
					$mail->Username = $server_name; //設定驗證帳號   
					$mail->Password = $server_password; //設定驗證密碼   
					 
					$mail->From = $sender_email;; //設定寄件者信箱   
					$mail->FromName = $sender_name; //設定寄件者姓名   
					 
					$mail->Subject = "我們已經收到您的投稿，謝謝。"; //設定郵件標題   
					$mail->Body = ""."\r\n".$mailContentOk."\r\n"; //設定郵件內容 
					$mail->IsHTML(true); //設定郵件內容為HTML   
					$mail->AddAddress($sendTo, $recipient); //設定收件者郵件及名稱   
					if(!$mail->Send()) {   
						echo "Mailer Error: " . $mail->ErrorInfo;   
					} else {   
						echo "Message sent!";   
					}
					
					//===================
					$mail2= new PHPMailer(); //建立新物件   
					$mail2->SMTPOptions = array(
						'ssl' => array(
										'verify_peer' => false,
										'verify_peer_name' => false,
										'allow_self_signed' => true
								)
						);
					//$mail2->SMTPDebug = 1;
					$mail2->IsSMTP(); //設定使用SMTP方式寄信   
					$mail2->SMTPAuth = true; //設定SMTP需要驗證        
					$mail2->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線   
					$mail2->Host = $server; //Gamil的SMTP主機        
					$mail2->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。        
					$mail2->CharSet = "UTF-8"; //設定郵件編碼     
					 
					$mail2->Username = $server_name; //設定驗證帳號   
					$mail2->Password = $server_password; //設定驗證密碼   
					 
					$mail2->From = $sender_email;; //設定寄件者信箱   
					$mail2->FromName = $sender_name; //設定寄件者姓名   
					$mail2->Subject = "我們已經收到您的投稿，謝謝。"; //設定郵件標題   
					$mail2->Body = ""."\r\n".$mailContentOk."\r\n"; //設定郵件內容 
					$mail2->IsHTML(true); //設定郵件內容為HTML   
					$mail2->AddAddress($affiliations_email, $affiliations); //設定收件者郵件及名稱   
					if(!$mail2->Send()) {   
						echo "Mailer Error: " . $mail2->ErrorInfo;   
					} else {   
						echo "Message sent!";   
					}
					
					$mailContent6Ok = str_replace("[Paper]",$topic,$mailContent6);
					$mailContent6Ok = str_replace("[Author]",$author_name,$mailContent6Ok);
					$mailContent6Ok = str_replace("[CAuthor]",$affiliations,$mailContent6Ok);
					$mailContent6Ok = str_replace("[Chief]",$sender_email,$mailContent6Ok);
					//===================
					$mail3= new PHPMailer(); //建立新物件   
					$mail3->SMTPOptions = array(
						'ssl' => array(
										'verify_peer' => false,
										'verify_peer_name' => false,
										'allow_self_signed' => true
								)
						);
					//$mail3->SMTPDebug = 1;
					$mail3->IsSMTP(); //設定使用SMTP方式寄信   
					$mail3->SMTPAuth = true; //設定SMTP需要驗證        
					$mail3->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線   
					$mail3->Host = $server; //Gamil的SMTP主機        
					$mail3->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。        
					$mail3->CharSet = "UTF-8"; //設定郵件編碼     
					 
					$mail3->Username = $server_name; //設定驗證帳號   
					$mail3->Password = $server_password; //設定驗證密碼   
					 
					$mail3->From = $sender_email;; //設定寄件者信箱   
					$mail3->FromName = $sender_name; //設定寄件者姓名   
					$mail3->Subject = "作者投稿論文自動通知"; //設定郵件標題   
					$mail3->Body = ""."\r\n".$mailContent6Ok."\r\n"; //設定郵件內容 
					$mail3->IsHTML(true); //設定郵件內容為HTML   
					$mail3->AddAddress($sender_email, $sender_name); //設定收件者郵件及名稱   
					if(!$mail3->Send()) {   
						echo "Mailer Error: " . $mail3->ErrorInfo;   
					} else {   
						echo "Message sent!";   
					}
					
					$send_time = date("Y-m-d H:i:s"); ;
					mysqli_query($conn,"insert into email_log set
						 title='我們已經收到您的投稿，謝謝。'
						, mail='$sendTo'
						, content='$mailContentOk'
						, send_time='$send_time'
						");
					mysqli_query($conn,"insert into email_log set
						 title='我們已經收到您的投稿，謝謝。'
						, mail='$affiliations_email'
						, content='$mailContentOk'
						, send_time='$send_time'
						");	
					mysqli_query($conn,"insert into email_log set
						 title='作者投稿論文自動通知'
						, mail='$sender_email'
						, content='$mailContent6Ok'
						, send_time='$send_time'
						");
			}	
	echo "<script language='javascript'>unblockUI();</script>"; 	
	echo "<script language='javascript'>location='submission.php';</script>"; 
	}
}}

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
?>
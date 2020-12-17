<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	include("SQLconnect.php");
	$sql = "SELECT * FROM submission;";
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
      </div>
    </div>
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
</body>
</html>
<?php
	if( !empty($_GET['hideID'])){
		$sort=1;
		$prefer_journal="";
		$last_order = $_POST['last_order'];
		$default_order = $_POST['default_order'];
		foreach($_POST['new_sort'] as $sn => $v){
			//echo $sn;
			//where id in($default_order) 
			$sql_recommended_journal_2 = "SELECT *,@curRow := @curRow + 1 AS row_number FROM recommended_journal  JOIN  (SELECT @curRow := 0) r where id in($last_order)  order by field(id,$last_order);;";
			$result_recommended_journal_2 = mysqli_query($conn, $sql_recommended_journal_2);
			while($row = @mysqli_fetch_object($result_recommended_journal_2)){			
				if ($sn == $row->row_number)
					$prefer_journal = $prefer_journal.",".$row->id;
					//echo $row->id ;
			}
			$sort++;		
		}
		
		$radio = $_POST['radio']; 
		$prefer_journal = substr($prefer_journal,1,strlen($prefer_journal));
		if ($radio == '0') {
			$prefer_journal = '-';
		}
		$default_order = $_POST['default_order'];		
		if ($prefer_journal == ''){
			$prefer_journal = substr($default_order,0,strlen($default_order)-1);
		}
		
		$mID = $_GET['hideID'];
		$privateKey = "1111111111111111";
		$iv 	= "1111111111111111";
		$encryptedData = base64_decode($_GET['hideID']);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
		$ID = trim($decrypted);
		
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
		
		$submission_no = $_POST['submission_no']; 
		$author = $_POST['author']; 
		$paper1 = $_POST['paper1']; 
		$paper2 = $_POST['paper2']; 
		$presenter = check($_POST['presenter']); 
		$topic = check($_POST['topic']); 
			
		$coauthors = [];
		array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name0']), 'institute' =>  urlencode($_POST['coauthors_institute0'])));
		array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name1']), 'institute' =>  urlencode($_POST['coauthors_institute1'])));
		array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name2']), 'institute' =>  urlencode($_POST['coauthors_institute2'])));
		array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name3']), 'institute' =>  urlencode($_POST['coauthors_institute3'])));
		array_push($coauthors, array('name' =>  urlencode($_POST['coauthors_name4']), 'institute' =>  urlencode($_POST['coauthors_institute4'])));
		$coauthors = urldecode(json_encode($coauthors));
		
		
		$paper_status = $_POST['paper_status']; 
		$affiliations = check($_POST['affiliations']); 
		$affiliations_email = check($_POST['affiliations_email']); 
		$affiliations_phone = check($_POST['affiliations_phone']); 
		
		$agree = $_POST['agree'];
		$paper_language = $_POST['paper_language']; 
		$review_language = $_POST['review_language']; 
		$upload_time = $_POST['upload_time']; 
		
		/*
		$privateKey = "1111111111111111";
		$iv 	= "1111111111111111";
		$target_dir = "upload/".$author."/";
		//mkdir($target_dir, 0700);
			
		if (!empty($_POST['fud1'])){
			$fud1 = $_POST['fud1'];
		} else if(!empty($_FILES["fud1"]["tmp_name"])){
			//$target_file1 = $target_dir . basename($_FILES["fud1"]["name"]);
			$temp= explode(".", $_FILES["fud1"]["name"]);
			$extension = end($temp);
			
			$filename1 = $submission_no . '_1';
			$encrypted1 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename1, MCRYPT_MODE_CBC, $iv);
			$target_file1 = $target_dir  . safe_b64encode($encrypted1).'.'.$extension;
			$imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["fud1"]["tmp_name"], $target_file1);
			$fud1 = 'admin/'.$target_file1; 
		} else if(!empty($_FILES["fud1_2"]["tmp_name"])){
			$temp= explode(".", $_FILES["fud1_2"]["name"]);
			$extension = end($temp);
			
			$filename1 = $submission_no . '_1';
			$encrypted1 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename1, MCRYPT_MODE_CBC, $iv);
			$target_file1 = $target_dir  . safe_b64encode($encrypted1).'.'.$extension;
			$imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["fud1_2"]["tmp_name"], $target_file1);
			$fud1 = 'admin/'.$target_file1; 
		} else {
			$fud1 = "";
		}
		
		if (!empty($_POST['fud2'])){
			$fud2 = $_POST['fud2'];echo "1";
		} else if(!empty($_FILES["fud2"]["tmp_name"])){
			$temp= explode(".", $_FILES["fud2"]["name"]);
			$extension = end($temp);
			$filename2 = $submission_no . '_2';
			$encrypted2 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename2, MCRYPT_MODE_CBC, $iv);
			$target_file2 = $target_dir . safe_b64encode($encrypted2) .'.'.$extension;
			$imageFileType = pathinfo($target_file2,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["fud2"]["tmp_name"], $target_file2);
			$fud2 = 'admin/'.$target_file2; 
			echo "2";
		} else if (!empty($_FILES["fud2_2"]["tmp_name"])){
			$temp= explode(".", $_FILES["fud2_2"]["name"]);
			$extension = end($temp);$filename2 = $submission_no . '_2';
			$encrypted2 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename2, MCRYPT_MODE_CBC, $iv);
			$target_file2 = $target_dir . safe_b64encode($encrypted2) .'.'.$extension;
			$imageFileType = pathinfo($target_file2,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["fud2_2"]["tmp_name"], $target_file2);
			$fud2 = 'admin/'.$target_file2; 
			echo "3";
		} else {
			$fud2 = "";echo "4";
		}
		
		if (!empty($_POST['fud3'])){
			$fud3 = $_POST['fud3'];
		} else if(!empty($_FILES["fud3"]["tmp_name"])){
			$temp= explode(".", $_FILES["fud3"]["name"]);
			$extension = end($temp);
			$filename3 = $submission_no . '_3';
			$encrypted3 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename3, MCRYPT_MODE_CBC, $iv);
			$target_file3 = $target_dir . safe_b64encode($encrypted3) . '.'.$extension;
			$imageFileType = pathinfo($target_file3,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["fud3"]["tmp_name"], $target_file3);
			$fud3 = 'admin/'.$target_file3; 
		} else if(!empty($_FILES["fud3_2"]["tmp_name"])){
			$temp= explode(".", $_FILES["fud3_2"]["name"]);
			$extension = end($temp);
			$filename3 = $submission_no . '_3';
			$encrypted3 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $filename3, MCRYPT_MODE_CBC, $iv);
			$target_file3 = $target_dir . safe_b64encode($encrypted3) . '.'.$extension;
			$imageFileType = pathinfo($target_file3,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["fud3_2"]["tmp_name"], $target_file3);
			$fud3 = 'admin/'.$target_file3; 
		} else {
			$fud3 = "";
		}
		*/
		$target_dir = "upload/".$_COOKIE["id"]."/";
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
		
		
		
		$presenter = mysqli_real_escape_string($conn, $presenter);
		$topic = mysqli_real_escape_string($conn, $topic);
		$coauthors = mysqli_real_escape_string($conn, $coauthors);
		$affiliations = mysqli_real_escape_string($conn, $affiliations);
		$affiliations_email = mysqli_real_escape_string($conn, $affiliations_email);
		$affiliations_phone = mysqli_real_escape_string($conn, $affiliations_phone);
		
		//if ($fud1 =='' ||$fud2 =='' ||$fud3 =='') {
		//	echo "<script language='javascript'>alert('必須上傳檔案');</script>"; 	
		//	echo "<script language='javascript'>unblockUI();</script>"; 
		//	echo "<script language='javascript'>history.go(-1)</script>"; 	
		//} else 
		
		{
			mysqli_query($conn,"update submission set 
				 author='$author'
				, paper1='$paper1'
				, paper2='$paper2'
				, presenter='$presenter'
				, topic='$topic'
				, coauthors='$coauthors'
				, paper_status='$paper_status'
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
				, upload_time='$upload_time' where submission_no='$submission_no'");
			echo "<script language='javascript'> location='submission.php';</script>";				
		}
	}
	
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
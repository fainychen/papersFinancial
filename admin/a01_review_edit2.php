<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
    include("SQLconnect.php");
    $sql = "SELECT * FROM submission;";
    $result = mysqli_query($conn, $sql);
		
	$sql_email_template_2 = "SELECT * FROM email_template where id = '2'";
	$result_email_template2 = mysqli_query($conn, $sql_email_template_2);
	while($row2 = @mysqli_fetch_object($result_email_template2)) {
		$mailContent2 = $row2->content;
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
require 'js/PHPMailer-master/class.phpmailer.php';
require ("js/PHPMailer-master/PHPMailerAutoload.php"); //匯入PHPMailer類別  
?>
<?php
	if( !empty($_GET['hideID'])){
		/*
		echo $_FILES["fud1"]["name"];
		echo $_FILES["fud2"]["name"];
		echo $_FILES["fud3"]["name"];
		echo $_FILES["fud1_2"]["name"];
		echo $_FILES["fud2_2"]["name"];
		echo $_FILES["fud3_2"]["name"];*/
		if (!empty($_POST['fud1'])){
			$fud1 = $_POST['fud1'];
		} else if(!empty($_FILES["fud1"]["tmp_name"])){
			$target_dir = "upload/";
			$target_file1 = $target_dir . basename($_FILES["fud1"]["name"]);
			$imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
			if (file_exists($target_file1)) {
			} else {
				if (move_uploaded_file($_FILES["fud1"]["tmp_name"], $target_file1)) {
				} 
			}
			$fud1 = 'admin/'.$target_file1; 
		} else if(!empty($_FILES["fud1_2"]["tmp_name"])){
			$target_dir = "upload/";
			$target_file1 = $target_dir . basename($_FILES["fud1_2"]["name"]);
			$imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
			if (file_exists($target_file1)) {
			} else {
				if (move_uploaded_file($_FILES["fud1_2"]["tmp_name"], $target_file1)) {
				}
			}
			$fud1 = 'admin/'.$target_file1; 
		} else {
			$fud1 = "";
		}
		
		if (!empty($_POST['fud2'])){
			$fud2 = $_POST['fud2'];echo "1";
		} else if(!empty($_FILES["fud2"]["tmp_name"])){
			$target_dir = "upload/";
			$target_file2 = $target_dir . basename($_FILES["fud2"]["name"]);
			$imageFileType = pathinfo($target_file2,PATHINFO_EXTENSION);
			if (file_exists($target_file2)) {
			} else {
				if (move_uploaded_file($_FILES["fud2"]["tmp_name"], $target_file2)) {
				} 
			}
			$fud2 = 'admin/'.$target_file2; 
			echo "2";
		} else if (!empty($_FILES["fud2_2"]["tmp_name"])){
			$target_dir = "upload/";
			$target_file2 = $target_dir . basename($_FILES["fud2_2"]["name"]);
			$imageFileType = pathinfo($target_file2,PATHINFO_EXTENSION);
			if (file_exists($target_file2)) {
			} else {
				if (move_uploaded_file($_FILES["fud2_2"]["tmp_name"], $target_file2)) {
				}
			}
			$fud2 = 'admin/'.$target_file2; 
			echo "3";
		} else {
			$fud2 = "";echo "4";
		}
		
		if (!empty($_POST['fud3'])){
			$fud3 = $_POST['fud3'];
		} else if(!empty($_FILES["fud3"]["tmp_name"])){
			$target_dir = "upload/";
			$target_file3 = $target_dir . basename($_FILES["fud3"]["name"]);
			$imageFileType = pathinfo($target_file3,PATHINFO_EXTENSION);
			if (file_exists($target_file3)) {
			} else {
				if (move_uploaded_file($_FILES["fud3"]["tmp_name"], $target_file3)) {
				} 
			}
			$fud3 = 'admin/'.$target_file3; 
		} else if(!empty($_FILES["fud3_2"]["tmp_name"])){
			$target_dir = "upload/";
			$target_file3 = $target_dir . basename($_FILES["fud3_2"]["name"]);
			$imageFileType = pathinfo($target_file3,PATHINFO_EXTENSION);
			if (file_exists($target_file3)) {
			} else {
				if (move_uploaded_file($_FILES["fud3_2"]["tmp_name"], $target_file3)) {
				}
			}
			$fud3 = 'admin/'.$target_file3; 
		} else {
			$fud3 = "";
		}
		
		$ID = $_GET['hideID'];
		$author = $_POST['author']; 
		$paper1 = $_POST['paper1']; 
		$paper2 = $_POST['paper2']; 
		$presenter = $_POST['presenter']; 
		$topic = $_POST['topic']; 
		$coauthors = $_POST['coauthors']; 
		$affiliations = $_POST['affiliations']; 
		$affiliations_email = $_POST['affiliations_email']; 
		$fud1 = $fud1; 
		$fud2 = $fud2; 
		$fud3 = $fud3; 
		$agree = $_POST['agree']; 
		$upload_time = $_POST['upload_time']; 
		$paper3 = $_POST['paper3']; 
		$update_time = $_POST['update_time']; 
		$reporter_service_unit = $_POST['reporter_service_unit']; 
		$presenter_eng = $_POST['presenter_eng']; 
		$reporter_service_unit_eng = $_POST['reporter_service_unit_eng']; 
		
		$sql_max = "SELECT * FROM submission where submission_no = '$ID'";
		
		$result_max = mysqli_query($conn, $sql_max);
		$row_max=mysqli_fetch_row($result_max);
		if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"])	&& $row_max[18] != $_COOKIE["id"]) { 
			$a_reviewer_no = $_COOKIE["id"] ;
			$b_reviewer_no = $_POST['b_reviewer_no']; 
			$a_update_time = date('Y-m-d H:i:s');
			$b_update_time = $_POST['b_update_time']; 
			$paper_status = '1'; 
		} else {
			$a_reviewer_no = $_POST['a_reviewer_no']; 
			$b_reviewer_no = $_COOKIE["id"] ; 
			$a_update_time = $_POST['a_update_time']; 
			$b_update_time = date('Y-m-d H:i:s');
			$paper_status = '3'; 
		}
		
		
		
		$a_reviewer_name = $_POST['a_reviewer_name']; 
		$a_q1 = isset( $_POST['a_q1']) ? $_POST['a_q1'] : ""; 
		$a_q2 = isset( $_POST['a_q2']) ? $_POST['a_q2'] : ""; 
		$a_q3 = isset( $_POST['a_q3']) ? $_POST['a_q3'] : ""; 
		$a_q4 = isset( $_POST['a_q4']) ? $_POST['a_q4'] : ""; 
		$a_q5 = isset( $_POST['a_q5']) ? $_POST['a_q5'] : ""; 
		$a_q6 = isset( $_POST['a_q6']) ? $_POST['a_q6'] : ""; 
		$a_q7 = isset( $_POST['a_q7']) ? $_POST['a_q7'] : ""; 
		$a_q8 = isset( $_POST['a_q8']) ? check($_POST['a_q8']) : ""; 
		$a_q9 = isset( $_POST['a_q9']) ? $_POST['a_q9'] : ""; 
		
		$b_reviewer_name = $_POST['b_reviewer_name']; 
		$b_q1 = isset( $_POST['b_q1']) ? $_POST['b_q1'] : ""; 
		$b_q2 = isset( $_POST['b_q2']) ? $_POST['b_q2'] : ""; 
		$b_q3 = isset( $_POST['b_q3']) ? $_POST['b_q3'] : ""; 
		$b_q4 = isset( $_POST['b_q4']) ? $_POST['b_q4'] : ""; 
		$b_q5 = isset( $_POST['b_q5']) ? $_POST['b_q5'] : ""; 
		$b_q6 = isset( $_POST['b_q6']) ? $_POST['b_q6'] : ""; 
		$b_q7 = isset( $_POST['b_q7']) ? $_POST['b_q7'] : ""; 
		$b_q8 = isset( $_POST['b_q8']) ? check($_POST['b_q8']) : ""; 
		$b_q9 = isset( $_POST['b_q9']) ? $_POST['b_q9'] : ""; 
		
		
		if ($a_reviewer_no =='' || $b_reviewer_no =='') {
			//echo '論文狀態:2';
			$paper_status = '2';
		} else if ($a_reviewer_no !='' && $b_reviewer_no !='') {
			//echo '論文狀態:3';
			$paper_status = '3';
		} else {
			//echo '論文狀態:1';
			$paper_status = '1';
		}
			
			
		$a_q8 = mysqli_real_escape_string($conn, $a_q8);
		$b_q8 = mysqli_real_escape_string($conn, $b_q8);
			mysqli_query($conn,"update submission set 
				 author='$author'
				, paper1='$paper1'
				, paper2='$paper2'
				, presenter='$presenter'
				, topic='$topic'
				, coauthors='$coauthors'
				, affiliations='$affiliations'
				, affiliations_email='$affiliations_email'
				, fud1='$fud1'
				, fud2='$fud2'
				, fud3='$fud3'
				, agree='$agree' 
				, reporter_service_unit='$reporter_service_unit' 
				, presenter_eng='$presenter_eng'
				, reporter_service_unit_eng='$reporter_service_unit_eng'
				, upload_time='$upload_time'
				, paper3='$paper3'
				, paper_status='$paper_status'
				, update_time='$update_time'
				, a_reviewer_no='$a_reviewer_no'
				, b_reviewer_no='$b_reviewer_no'
				, a_reviewer_name='$a_reviewer_name'
				, a_q1='$a_q1'
				, a_q2='$a_q2'
				, a_q3='$a_q3'
				, a_q4='$a_q4'
				, a_q5='$a_q5'
				, a_q6='$a_q6'
				, a_q7='$a_q7'
				, a_q8='$a_q8'
				, a_q9='$a_q9'
				, a_update_time='$a_update_time'
				, b_reviewer_name='$b_reviewer_name'
				, b_q1='$b_q1'
				, b_q2='$b_q2'
				, b_q3='$b_q3'
				, b_q4='$b_q4'
				, b_q5='$b_q5'
				, b_q6='$b_q6'
				, b_q7='$b_q7'
				, b_q8='$b_q8'
				, b_q9='$b_q9'
				, b_update_time='$b_update_time'
				where submission_no='$ID'");
				
				
			if ($paper_status=='3') {  //審稿結束，等待編輯決定
					$mailContentOk = str_replace("[Paper]",$topic,$mailContent2);
					//$mailContentOk = str_replace("[Author]",$author_name,$mailContentOk);
					//$mailContentOk = str_replace("[CAuthor]",$affiliations,$mailContentOk);
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
					$mail3->Body = ""."\r\n".$mailContentOk."\r\n"; //設定郵件內容 
					$mail3->IsHTML(true); //設定郵件內容為HTML   
					$mail3->AddAddress($sender_email, $sender_name); //設定收件者郵件及名稱   
					if(!$mail3->Send()) {   
						echo "Mailer Error: " . $mail3->ErrorInfo;   
					} else {   
						echo "Message sent!";   
					}
					$send_time = date("Y-m-d H:i:s"); ;
					mysqli_query($conn,"insert into email_log set
						 title='作者投稿論文自動通知'
						, mail='$sender_email'
						, content='$mailContentOk'
						, send_time='$send_time'
						");
			} 
			echo "<script language='javascript'> location='a01_review.php';</script>";				
		}
?>
<script>
</script>


<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include("SQLconnect.php");
	if ($_COOKIE["role"] == $rEncrypted0 ) {
		$a = $_COOKIE["id"];
		$sql = "SELECT * FROM submission where author = $a and enable is null";
	} else {
		$sql = "SELECT * FROM submission where enable is null;";
	}
	$result = mysqli_query($conn, $sql);
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
        <h2><?= translate("建立投稿") ?></h2>
      </div>
    </div>
    <a class="glyphicon glyphicon-plus btn btn-default" onclick="additem()"></a>
    <br/>
    <br/>
    <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center"><?= translate("作者") ?></th>
            <th class="text-center"><?= translate("論文主題(第一)") ?></th>
            <th class="text-center"><?= translate("論文主題(第二)") ?></th>
            <th class="text-center"><?= translate("報告者姓名(中文)") ?></th>
            <th class="text-center"><?= translate("論文題目") ?></th>
            <th class="text-center"><?= translate("通訊作者姓名") ?></th>
            <th class="text-center"><?= translate("論文狀態") ?></th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <?php
		  	while($row = @mysqli_fetch_object($result))
			{			
		  ?>
          <tr>
            <td class="text-center">
						<?php
						

  $sql1 = "SELECT * FROM author;";
  $result1 = mysqli_query($conn, $sql1);
							$i = 0;
							while($row1 = @mysqli_fetch_object($result1))
							{
								$i = $i +1;
								if ($row->author == $row1->author_no) echo $row1->name;
							}
						?>
						
						</td>
            <td class="text-center">
						<?php
							$sql_ref_paper = "SELECT * FROM ref_paper;";
							$result_ref_paper1 = mysqli_query($conn, $sql_ref_paper);
							$i = 0;
							while($row1 = @mysqli_fetch_object($result_ref_paper1))
							{
								$i = $i +1;
								if ($row->paper1 == $row1->id) echo $row1->name;
							}
						?>
						</td>
            <td class="text-center">
						<?php
							$sql_ref_paper = "SELECT * FROM ref_paper;";
							$result_ref_paper2 = mysqli_query($conn, $sql_ref_paper);
							$i = 0;
							while($row1 = @mysqli_fetch_object($result_ref_paper2))
							{
								$i = $i +1;
								if ($row->paper2 == $row1->id) echo $row1->name;
							}
$privateKey = "1111111111111111";
$iv 	= "1111111111111111";
$data 	= $row->submission_no;
$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data, MCRYPT_MODE_CBC, $iv);
							//base64_encode($encrypted)
						?>
						</td>
            <td class="text-center"><?=$row->presenter?></td>
            <td class="text-center"><?=$row->topic; ?></td>
            <td class="text-center"><?=$row->affiliations; ?></td>
            <td class="text-center"><?php if ($row->paper_status != NULL && $row->paper_status != '0')  echo '已投稿' ;
			if ($row->paper_status != NULL && $row->paper_status == '0') echo '暫存'  ?></td>
            <td class="text-center">
			<!-- TODO  -->
                <button <?php if ($row->paper_status != NULL && $row->paper_status != '0') { ?> style="display:none" <?php } ?>
				class="glyphicon glyphicon-pencil btn btn-default" onclick="self.location.href='submission_edit.php?action=modify&hideID=<?=base64_encode($encrypted); ?>'"></button>
                <button class="btn btn-default glyphicon glyphicon-trash" onclick="deleteitem('<?=$row->submission_no; ?>')"></button>
            </td>
          </tr>            
          <?php
            }
          ?>
        </tbody>
     </table>
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
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
<script>
	function additem(a){
		location.href='submission_add.php';
	}
	function deleteitem(a){
		answer = confirm("<?= translate('您確定要刪除此筆資料嗎？') ?>"	);
		if (answer) {
			location.href='submission_edit.php?action=delete&hideID='+a+'';
		}
	}
</script>

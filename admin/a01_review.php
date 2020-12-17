<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include("SQLconnect.php");
	if ($_COOKIE["role"] == $rEncrypted1) {
		$a = $_COOKIE["id"];
		$topic = $_COOKIE["topic"];
		$sql = "SELECT * FROM submission where paper3 = '$topic' and enable is null";
	} else {
		$sql = "SELECT * FROM submission where enable is null;";
	}
	$result = mysqli_query($conn, $sql);
	
	$sql_ref_paper = "SELECT * FROM ref_paper where id =  '$topic'";
	$result_ref_paper = mysqli_query($conn, $sql_ref_paper);
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
		<?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> 
			<ul class="nav navbar-nav">
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><?= translate("功能選單") ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="a01_review.php"><?= translate("論文審查及下載") ?></a> </li>
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
    <br/>
    <br/>
    <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center"><?= translate("審查主題") ?></th>
            <th class="text-center"><?= translate("論文題目") ?></th>
            <th class="text-center"><?= translate("論文審查意見語言") ?></th>
            <th class="text-center"><?= translate("論文下載") ?></th>
            <th class="text-center"><?= translate("審查時間") ?></th>
            <th class="text-center" style="width:20%"><?= translate("審查結果") ?></th>
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
            <td class="text-center"><?php if ($row->review_language!='1') echo '中' ;if ($row->review_language=='1') echo '英' ?></td>
            <td class="text-center">
				<a id="attachment" name="attachment" value="<?php echo $row->fud1 ; ?>" href="../<?php echo $row->fud1 ; ?>" >
				<button class="glyphicon glyphicon-download-alt btn btn-default"></button>
				</a>
			</td>
			<td class="text-center">
				<?php if ($_COOKIE["id"] == $row->a_reviewer_no) { ?><?=$row->a_update_time; ?><?php } ?>
				<?php if ($_COOKIE["id"] == $row->b_reviewer_no) { ?><?=$row->b_update_time; ?><?php } ?>
			</td>
            <td class="text-center">
				<?php if ($_COOKIE["id"] == $row->a_reviewer_no) { ?><?=$row->a_q9; ?><?php } ?>
				<?php if ($_COOKIE["id"] == $row->b_reviewer_no) { ?><?=$row->b_q9; ?><?php } ?>
			</td>
            <td class="text-center">
                <button class="glyphicon glyphicon-pencil btn btn-default" onclick="self.location.href='a01_review_edit.php?action=modify&hideID=<?=$row->submission_no; ?>'"></button>
			</td>
          </tr>            
          <?php
            }
          ?>
        </tbody>
     </table>
		 <br/><br/><?= translate("審查上限&已審查統計") ?><br/>
		 <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center"><?= translate("論文主題名稱") ?></th>			
            <th class="text-center"><?= translate("接受最大篇數上限") ?></th>						
            <th class="text-center"><?= translate("已接受篇數") ?></th>			
            <th class="text-center"><?= translate("接受並推薦到期刊最大篇數上限") ?></th>
            <th class="text-center"><?= translate("已接受並推薦篇數") ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
		  	while($row = @mysqli_fetch_object($result_ref_paper)) {			
		  ?>
          <tr>
            <td class="text-center"><?=$row->name; ?></td>
            <td class="text-center"><?=$row->accept_max; ?></td>
            <td class="text-center">
				<?php
					$sql_submission = "SELECT count(*) as total FROM submission where 
					(a_reviewer_no = '$a' and a_update_time !='' and (a_q9 ='同意收錄到國際大數據與ERP學術及實務研討會' or a_q9 ='同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊')) or 
					(b_reviewer_no= '$a' and b_update_time !='' and (b_q9 ='同意收錄到國際大數據與ERP學術及實務研討會' or b_q9 ='同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊'));";
					$result_submission = mysqli_query($conn, $sql_submission);
					$data=mysqli_fetch_assoc($result_submission);
					echo $data['total'];
					?>
			</td>
            <td class="text-center"><?=$row->recommend_max; ?></td>
            <td class="text-center">
				<?php
				$sql_submission = "SELECT count(*) as total FROM submission where 
				(a_reviewer_no = '$a' and a_update_time !='' and (a_q9 ='同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊')) or 
				(b_reviewer_no= '$a' and b_update_time !='' and (b_q9 ='同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊'));";
				$result_submission = mysqli_query($conn, $sql_submission);
				$data=mysqli_fetch_assoc($result_submission);
				echo $data['total'];
				?>
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
        <p>Copyright © CERPS. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.js"></script>
</body>
</html>
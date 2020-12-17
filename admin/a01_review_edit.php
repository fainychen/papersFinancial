<?php
	include("Setting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include("SQLconnect.php");
	$sql = "SELECT * FROM submission;";
	$result = mysqli_query($conn, $sql);

	$sql1 = "SELECT * FROM author;";
	$result1 = mysqli_query($conn, $sql1);

	$sql2 = "SELECT * FROM reviewer;";
	$result2 = mysqli_query($conn, $sql2);
	
	$sql3 = "SELECT * FROM reviewer;";
	$result3 = mysqli_query($conn, $sql3);
	
	$sql_ref_paper = "SELECT * FROM ref_paper;";
	$result_ref_paper1 = mysqli_query($conn, $sql_ref_paper);
	if(!empty($_GET['action']) && !empty($_GET['hideID'])){
		$ID = $_GET['hideID'];
		if($_GET['action']=="delete"){
			$sql_delete = "delete FROM submission where submission_no = '$ID'";
			$result_delete = mysqli_query($conn, $sql_delete);
			echo "<script language='javascript'>location.href='a01_chief_decide.php';</script>";
		} else if($_GET['action']=="modify"){
			$sql_max = "SELECT * FROM submission where submission_no = '$ID'";
			$result_max = mysqli_query($conn, $sql_max);
			$row_max=mysqli_fetch_row($result_max);
		}
	}
	mysqli_close($conn);
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
        <h2><?= translate("編輯論文審查及下載") ?></h2>
      </div>
    </div>
    <form action="a01_review_edit2.php?hideID=<?=$_GET['hideID']; ?>"  method="post" enctype="multipart/form-data" name="main_form">
    <a class="btn btn-default glyphicon glyphicon-arrow-left" onclick="gohome()"></a>
    
    <br/><br/>
			<div class="panel panel-default" style="display: none">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseCard">
							<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
							&nbsp;<?= translate("論文內容") ?>
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse in" id="collapseCard">
					<div class="panel-body">									
						<table class="table table-hover">
							<tbody>
								<tr style="display: none">
									<td class="text-center"><?= translate("論文編號") ?></td>
									<td class="text-center"><input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="text" class="form-control" id="submission_no" name="submission_no" value="<?php echo $row_max[0] ; ?>" placeholder="<?= translate("論文編號") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("作者") ?></td>
									<td>
										<select class="selectpicker" name="author" id="author" disabled >
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
									</td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("論文主題(第一)") ?></td>
									<td class="text-center"><input readonly type="text" class="form-control" id="paper1" name="paper1" value="<?php echo $row_max[2] ; ?>" placeholder="<?= translate("論文主題(第一)") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("論文主題(第二)") ?></td>
									<td class="text-center"><input readonly type="text" class="form-control" id="paper2" name="paper2" value="<?php echo $row_max[3] ; ?>" placeholder="<?= translate("論文主題(第二)") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("報告者") ?></td>
									<td class="text-center"><input readonly type="text" class="form-control" id="presenter" name="presenter" value="<?php echo $row_max[4] ; ?>" placeholder="<?= translate("報告者") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("論文題目") ?></td>
									<td class="text-center"><input readonly type="text" class="form-control" id="topic" name="topic" value="<?php echo $row_max[5] ; ?>" placeholder="<?= translate("論文題目") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("共同作者") ?></td>
									<td class="text-center"><input readonly type="text" class="form-control" id="coauthors" name="coauthors" value="<?php echo $row_max[6] ; ?>" placeholder="<?= translate("共同作者") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("通訊作者") ?></td>
									<td class="text-center"><input readonly type="text" class="form-control" id="affiliations" name="affiliations" value="<?php echo $row_max[7] ; ?>" placeholder="<?= translate("通訊作者") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("通訊作者Email") ?></td>
									<td class="text-center"><input readonly type="text" class="form-control" id="affiliations_email" name="affiliations_email" value="<?php echo $row_max[8] ; ?>" placeholder="<?= translate("通訊作者Email") ?>"></td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("論文匿名全文版本") ?></td>
									<td class="">
										<?php if ($row_max[9]== ''){ ?>
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud1" id="fud1" value="<?php echo $row_max[9] ; ?>" style="display: none">
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud1_2" id="fud1_2" value="" style="display: none">
										<?php } else { ?>
											<a  <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> target="_blank" name="file01" id="file01" value="<?php echo $row_max[9] ; ?>" href="../<?php echo ''.$row_max[9] ; ?>" ><?php echo str_replace("admin/upload/",'', $row_max[9] ) ?></a>
											<input style="display: none" <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="text" class="form-control" id="fud1" name="fud1" value="<?php echo $row_max[9] ; ?>" src="../<?php echo $row_max[9] ; ?>" alt="...">
											<a class="btn btn-default glyphicon glyphicon-remove" id="urldelete1" onclick="deletephoto1()" style="display: none" ></a>
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud1_2" id="fud1_2"  value="<?php echo $row_max[9] ; ?>" >
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("論文具名全文版本") ?></td>
									<td class="">
										<?php if ($row_max[10]== ''){ ?>
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud2" id="fud2" value="<?php echo $row_max[10] ; ?>" style="display: none">
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud2_2" id="fud2_2" value="" style="display: none">
										<?php } else { ?>
											<a  <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> target="_blank" name="file02" id="file02" value="<?php echo $row_max[10] ; ?>" href="../<?php echo ''.$row_max[10] ; ?>" ><?php echo str_replace("admin/upload/",'', $row_max[10] ) ?></a>
											<input style="display: none" <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="text" class="form-control" id="fud2" name="fud2" value="<?php echo $row_max[10] ; ?>" src="../<?php echo $row_max[10] ; ?>" alt="...">
											<a class="btn btn-default glyphicon glyphicon-remove" id="urldelete2" onclick="deletephoto2()" style="display: none" ></a>
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud2_2" id="fud2_2"  value="<?php echo $row_max[10] ; ?>" >
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("著作權讓與書") ?></td>
									<td class="">
										<?php if ($row_max[11]== ''){ ?>
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud3" id="fud3" value="<?php echo $row_max[11] ; ?>" style="display: none">
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud3_2" id="fud3_2" value="" style="display: none">
										<?php } else { ?>
											<a  <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> target="_blank" name="file03" id="file03" value="<?php echo $row_max[11] ; ?>" href="../<?php echo ''.$row_max[11] ; ?>" ><?php echo str_replace("admin/upload/",'', $row_max[11] ) ?></a>
											<input style="display: none"  <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="text" class="form-control" id="fud3" name="fud3" value="<?php echo $row_max[11] ; ?>" src="../<?php echo $row_max[11] ; ?>" alt="...">
											<a class="btn btn-default glyphicon glyphicon-remove" id="urldelete3" onclick="deletephoto3()" style="display: none" ></a>
											<input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="file" name="fud3_2" id="fud3_2"  value="<?php echo $row_max[11] ; ?>" >
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td class="text-center"><?= translate("我確保此篇論文從未在其它地方發表過") ?></td>
									<td>
										<select class="selectpicker" name="agree" id="agree" disabled>
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
					</div>
				</div>
			</div>
				<div class="panel panel-default" style="display:none" >
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseReviewerSetting">
								<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
								&nbsp;<?= translate("審查設定") ?>
							</a>
						</h4>
					</div>
					<div class="panel-collapse collapse" id="collapseReviewerSetting">
						<div class="panel-body">
							<table class="table table-hover">
									<tbody>
										<tr>
											<td class="text-center"><?= translate("審查主題") ?></td>
											<td>
												<select class="selectpicker" name="paper3" id="paper3">
													<?php
														$i = 0;
														while($row1 = @mysqli_fetch_object($result_ref_paper1))
														{
															$i = $i +1;
														?>
															<option value="<?=$row1->id; ?>" <?php if ($row_max[14] == $row1->id) echo ' selected="selected"'; ?>  ><?=$row1->name; ?></option>
														<?php
														}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td class="text-center"><?= translate("審查結果") ?></td>
											<td class="text-center"><input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="text" class="form-control" id="paper_status" name="paper_status" value="<?php echo $row_max[15] ; ?>" placeholder="<?= translate("審查結果") ?>"></td>
										</tr>
										<tr>
											<td class="text-center"><?= translate("審查完成時間") ?></td>
											<td class="text-center"><input <?php if ($_COOKIE["role"] == $rEncrypted1 ) { ?> readonly <?php } ?> type="date" class="form-control" id="update_time" name="update_time" value="<?php echo $row_max[16] ; ?>" placeholder="<?= translate("審查完成時間") ?>"></td>
										</tr>
										<tr>
											<td class="text-center"><?= translate("A審查委員編號") ?></td>
											<td class="text-center"><input type="text" class="form-control" id="a_reviewer_no" name="a_reviewer_no" value="<?php echo $row_max[17] ; ?>" placeholder="<?= translate("A審查委員編號") ?>"></td>
										</tr>
										<tr>
											<td class="text-center"><?= translate("B審查委員編號") ?></td>
											<td class="text-center"><input type="text" class="form-control" id="b_reviewer_no" name="b_reviewer_no" value="<?php echo $row_max[18] ; ?>" placeholder="<?= translate("B審查委員編號") ?>"></td>
										</tr>
										</tbody>
										</table>
						</div>
					</div>
				</div>
												<div class="panel panel-default" <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) { } else { ?> style="display:none" <?php } ?>>
													<div class="panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseReviewerA">
																<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
																Paper Review
															</a>
														</h4>
													</div>
													<div class="panel-collapse collapse in" id="collapseReviewerA">
														<div class="panel-body">									
																										
															<table class="table table-hover">
															<tbody>
																<tr style="display:none">
																	<td class="text-center"><?= translate("審查委員姓名") ?></td>
																	<td class="text-center"><input type="text" class="form-control" id="a_reviewer_name" name="a_reviewer_name" value="<?php echo $row_max[19] ; ?>" placeholder="<?= translate("審查委員姓名") ?>"></td>
																</tr>
																<tr >
																	<td class="text-center"><?= translate("1研究的原創性或創新性") ?></td>
																	
																	<td class="text-center">
																	
																		<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q1" value="極優"  <?php if ($row_max[20] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																		<input type="radio" name="a_q1" value="優"  <?php if ($row_max[20] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																		<input type="radio" name="a_q1" value="普通"  <?php if ($row_max[20] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																		<input type="radio" name="a_q1" value="差"  <?php if ($row_max[20] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																		<input type="radio" name="a_q1" value="極差"  <?php if ($row_max[20] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																	</td>
																</tr>
																<tr >
																	<td class="text-center"><?= translate("2議題的重要性") ?></td>
																	<td class="text-center">
																		<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q2" value="極優"  <?php if ($row_max[21] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																		<input type="radio" name="a_q2" value="優"  <?php if ($row_max[21] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																		<input type="radio" name="a_q2" value="普通"  <?php if ($row_max[21] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																		<input type="radio" name="a_q2" value="差"  <?php if ($row_max[21] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																		<input type="radio" name="a_q2" value="極差"  <?php if ($row_max[21] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																	</td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("3文獻的相關性與完整性") ?></td>
																	<td class="text-center">
																		<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q3" value="極優"  <?php if ($row_max[22] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																		<input type="radio" name="a_q3" value="優"  <?php if ($row_max[22] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																		<input type="radio" name="a_q3" value="普通"  <?php if ($row_max[22] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																		<input type="radio" name="a_q3" value="差"  <?php if ($row_max[22] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																		<input type="radio" name="a_q3" value="極差"  <?php if ($row_max[22] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																	</td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("4方法的正確性與嚴謹度") ?></td>
																	<td class="text-center">
																	<input type="radio" name="a_q4" value="極優"  <?php if ($row_max[23] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																		<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q4" value="優"  <?php if ($row_max[23] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																		<input type="radio" name="a_q4" value="普通"  <?php if ($row_max[23] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																		<input type="radio" name="a_q4" value="差"  <?php if ($row_max[23] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																		<input type="radio" name="a_q4" value="極差"  <?php if ($row_max[23] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																	</td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("5文章的組織結構") ?></td>
																	<td class="text-center">
																	<input type="radio" name="a_q5" value="極優"  <?php if ($row_max[24] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																		<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q5" value="優"  <?php if ($row_max[24] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																		<input type="radio" name="a_q5" value="普通"  <?php if ($row_max[24] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																		<input type="radio" name="a_q5" value="差"  <?php if ($row_max[24] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																		<input type="radio" name="a_q5" value="極差"  <?php if ($row_max[24] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																	
																	</td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("6學術價值或應用價值") ?></td>
																	<td class="text-center">
																		<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q6" value="極優"  <?php if ($row_max[25] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																		<input type="radio" name="a_q6" value="優"  <?php if ($row_max[25] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																		<input type="radio" name="a_q6" value="普通"  <?php if ($row_max[25] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																		<input type="radio" name="a_q6" value="差"  <?php if ($row_max[25] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																		<input type="radio" name="a_q6" value="極差"  <?php if ($row_max[25] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																	
																	</td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("7總結") ?></td>
																	<td>
																	<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q7" value="8"  <?php if ($row_max[26] == '8') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+8)") ?>
																	<input type="radio" name="a_q7" value="7"  <?php if ($row_max[26] == '7') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+7)") ?>
																	<input type="radio" name="a_q7" value="6"  <?php if ($row_max[26] == '6') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+6)") ?>
																	<input type="radio" name="a_q7" value="5"  <?php if ($row_max[26] == '5') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+5)") ?>
																	<input type="radio" name="a_q7" value="4"  <?php if ($row_max[26] == '4') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+4)") ?>
																	<input type="radio" name="a_q7" value="3"  <?php if ($row_max[26] == '3') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+3)") ?>
																	<input type="radio" name="a_q7" value="2"  <?php if ($row_max[26] == '2') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+2)") ?>
																	<input type="radio" name="a_q7" value="1"  <?php if ($row_max[26] == '1') echo ' checked="checked"'; ?> > <?= translate("建議接受(+1)") ?>
																	<input type="radio" name="a_q7" value="0.1"  <?php if ($row_max[26] == '0.1') echo ' checked="checked"'; ?> > <?= translate("傾向接受(+0)") ?>
																		<br/>
																	<input type="radio" name="a_q7" value="-0.1"  <?php if ($row_max[26] == '-0.1') echo ' checked="checked"'; ?> > <?= translate("傾向拒絕(-0)") ?>
																	<input type="radio" name="a_q7" value="-1"  <?php if ($row_max[26] == '-1') echo ' checked="checked"'; ?> > <?= translate("建議拒絕(-1)") ?>
																	<input type="radio" name="a_q7" value="-2"  <?php if ($row_max[26] == '-2') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-2)") ?>
																	<input type="radio" name="a_q7" value="-3"  <?php if ($row_max[26] == '-3') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-3)") ?>
																	<input type="radio" name="a_q7" value="-4"  <?php if ($row_max[26] == '-4') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-4)") ?>
																	<input type="radio" name="a_q7" value="-5"  <?php if ($row_max[26] == '-5') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-5)") ?>
																	<input type="radio" name="a_q7" value="-6"  <?php if ($row_max[26] == '-6') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-6)") ?>
																	<input type="radio" name="a_q7" value="-7"  <?php if ($row_max[26] == '-7') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-7)") ?>
																	<input type="radio" name="a_q7" value="-8"  <?php if ($row_max[26] == '-8') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-8)") ?>
																	</td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("評論及修改意見") ?></td>
																	<td class="text-center">
																	<textarea <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  rows="10" type="text" class="form-control" id="a_q8" name="a_q8"  value="" placeholder="<?= translate("請就上述議題、論文之優缺點及具體方向評述。請最少填寫30字的審查意見。") ?>"><?php echo $row_max[27] ; ?></textarea></td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("本論文審查結論") ?></td>
																	<td>
																		<input <?php if ((($row_max[29] == '' && $row_max[17] =='' )|| $row_max[17] == $_COOKIE["id"]) && $row_max[18] != $_COOKIE["id"]) echo ' required'; ?>  type="radio" name="a_q9" value="不同意收錄到國際大數據與ERP學術及實務研討會"  <?php if ($row_max[28] == '不同意收錄到國際大數據與ERP學術及實務研討會') echo ' checked="checked"'; ?> > <?= translate("不同意收錄到國際大數據與ERP學術及實務研討會") ?><br/>
																		<input type="radio" name="a_q9" value="同意收錄到國際大數據與ERP學術及實務研討會"  <?php if ($row_max[28] == '同意收錄到國際大數據與ERP學術及實務研討會') echo ' checked="checked"'; ?> > <?= translate("同意收錄到國際大數據與ERP學術及實務研討會") ?><br/>
																		<input type="radio" name="a_q9" value="同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊"  <?php if ($row_max[28] == '同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊') echo ' checked="checked"'; ?> > <?= translate("同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊") ?>
																	</td>
																</tr>
																<tr>
																	<td class="text-center"><?= translate("審查更新時間") ?></td>
																	<td class="text-center"><input readonly type="text" class="form-control" id="a_update_time" name="a_update_time" value="<?php echo $row_max[29] ; ?>" placeholder="<?= translate("審查更新時間") ?>"></td>
																</tr>
															</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="panel panel-default" <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) && $row_max[17] != $_COOKIE["id"]) { } else {  ?> style="display:none" <?php } ?>>
													<div class="panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseReviewerB">
																<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
																&nbsp;Paper review.&nbsp;
															</a>
														</h4>
													</div>
													<div class="panel-collapse collapse in" id="collapseReviewerB" >
														<div class="panel-body">
															<table class="table table-hover">
																<tbody>
																	<tr style="display:none">
																		<td class="text-center"><?= translate("審查委員姓名") ?></td>
																		<td class="text-center"><input type="text" class="form-control" id="b_reviewer_name" name="b_reviewer_name" value="<?php echo $row_max[30] ; ?>" placeholder="<?= translate("審查委員姓名") ?>"></td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("1研究的原創性或創新性") ?></td>
																		<td class="text-center">
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q1" value="極優"  <?php if ($row_max[31] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																			<input type="radio" name="b_q1" value="優"  <?php if ($row_max[31] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																			<input type="radio" name="b_q1" value="普通"  <?php if ($row_max[31] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																			<input type="radio" name="b_q1" value="差"  <?php if ($row_max[31] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																			<input type="radio" name="b_q1" value="極差"  <?php if ($row_max[31] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("2議題的重要性") ?></td>
																		<td class="text-center">
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q2" value="極優"  <?php if ($row_max[32] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																			<input type="radio" name="b_q2" value="優"  <?php if ($row_max[32] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																			<input type="radio" name="b_q2" value="普通"  <?php if ($row_max[32] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																			<input type="radio" name="b_q2" value="差"  <?php if ($row_max[32] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																			<input type="radio" name="b_q2" value="極差"  <?php if ($row_max[32] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("3文獻的相關性與完整性") ?></td>
																		<td class="text-center">
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q3" value="極優"  <?php if ($row_max[33] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																			<input type="radio" name="b_q3" value="優"  <?php if ($row_max[33] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																			<input type="radio" name="b_q3" value="普通"  <?php if ($row_max[33] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																			<input type="radio" name="b_q3" value="差"  <?php if ($row_max[33] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																			<input type="radio" name="b_q3" value="極差"  <?php if ($row_max[33] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("4方法的正確性與嚴謹度") ?></td>
																		<td class="text-center">
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q4" value="極優"  <?php if ($row_max[34] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																			<input type="radio" name="b_q4" value="優"  <?php if ($row_max[34] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																			<input type="radio" name="b_q4" value="普通"  <?php if ($row_max[34] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																			<input type="radio" name="b_q4" value="差"  <?php if ($row_max[34] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																			<input type="radio" name="b_q4" value="極差"  <?php if ($row_max[34] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("5文章的組織結構") ?></td>
																		<td class="text-center">
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q5" value="極優"  <?php if ($row_max[35] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																			<input type="radio" name="b_q5" value="優"  <?php if ($row_max[35] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																			<input type="radio" name="b_q5" value="普通"  <?php if ($row_max[35] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																			<input type="radio" name="b_q5" value="差"  <?php if ($row_max[35] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																			<input type="radio" name="b_q5" value="極差"  <?php if ($row_max[35] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("6學術價值或應用價值") ?></td>
																		<td class="text-center">
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q6" value="極優"  <?php if ($row_max[36] == '極優') echo ' checked="checked"'; ?> > <?= translate("極優") ?>
																			<input type="radio" name="b_q6" value="優"  <?php if ($row_max[36] == '優') echo ' checked="checked"'; ?> > <?= translate("優") ?>
																			<input type="radio" name="b_q6" value="普通"  <?php if ($row_max[36] == '普通') echo ' checked="checked"'; ?> > <?= translate("普通") ?>
																			<input type="radio" name="b_q6" value="差"  <?php if ($row_max[36] == '差') echo ' checked="checked"'; ?> > <?= translate("差") ?>
																			<input type="radio" name="b_q6" value="極差"  <?php if ($row_max[36] == '極差') echo ' checked="checked"'; ?> > <?= translate("極差") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("7總結") ?></td>
																		<td>
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q7" value="8"  <?php if ($row_max[37] == '8') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+8)") ?>
																			<input type="radio" name="b_q7" value="7"  <?php if ($row_max[37] == '7') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+7)") ?>
																			<input type="radio" name="b_q7" value="6"  <?php if ($row_max[37] == '6') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+6)") ?>
																			<input type="radio" name="b_q7" value="5"  <?php if ($row_max[37] == '5') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+5)") ?>
																			<input type="radio" name="b_q7" value="4"  <?php if ($row_max[37] == '4') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+4)") ?>
																			<input type="radio" name="b_q7" value="3"  <?php if ($row_max[37] == '3') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+3)") ?>
																			<input type="radio" name="b_q7" value="2"  <?php if ($row_max[37] == '2') echo ' checked="checked"'; ?> > <?= translate("強烈接受(+2)") ?>
																			<input type="radio" name="b_q7" value="1"  <?php if ($row_max[37] == '1') echo ' checked="checked"'; ?> > <?= translate("建議接受(+1)") ?>
																			<input type="radio" name="b_q7" value="0.1"  <?php if ($row_max[37] == '0.1') echo ' checked="checked"'; ?> > <?= translate("傾向接受(+0)") ?>
																				<br/>
																			<input type="radio" name="b_q7" value="-0.1"  <?php if ($row_max[37] == '-0.1') echo ' checked="checked"'; ?> > <?= translate("傾向拒絕(-0)") ?>
																			<input type="radio" name="b_q7" value="-1"  <?php if ($row_max[37] == '-1') echo ' checked="checked"'; ?> > <?= translate("建議拒絕(-1)") ?>
																			<input type="radio" name="b_q7" value="-2"  <?php if ($row_max[37] == '-2') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-2)") ?>
																			<input type="radio" name="b_q7" value="-3"  <?php if ($row_max[37] == '-3') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-3)") ?>
																			<input type="radio" name="b_q7" value="-4"  <?php if ($row_max[37] == '-4') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-4)") ?>
																			<input type="radio" name="b_q7" value="-5"  <?php if ($row_max[37] == '-5') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-5)") ?>
																			<input type="radio" name="b_q7" value="-6"  <?php if ($row_max[37] == '-6') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-6)") ?>
																			<input type="radio" name="b_q7" value="-7"  <?php if ($row_max[37] == '-7') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-7)") ?>
																			<input type="radio" name="b_q7" value="-8"  <?php if ($row_max[37] == '-8') echo ' checked="checked"'; ?> > <?= translate("強烈拒絕(-8)") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("評論及修改意見") ?></td>
																		<td class="text-center">
																		<textarea <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> rows="10" type="text" class="form-control" id="b_q8" name="b_q8"  value="" placeholder="<?= translate("請就上述議題、論文之優缺點及具體方向評述。請最少填寫30字的審查意見。") ?>"><?php echo $row_max[38] ; ?></textarea></td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("本論文審查結論") ?></td>
																		<td>
																			<input <?php if ((($row_max[29] != '' && $row_max[40] == '')|| $row_max[18] == $_COOKIE["id"]) &&  $row_max[17] != $_COOKIE["id"]) echo ' required'; ?> type="radio" name="b_q9" value="不同意收錄到國際大數據與ERP學術及實務研討會"  <?php if ($row_max[39] == '不同意收錄到國際大數據與ERP學術及實務研討會') echo ' checked="checked"'; ?> > <?= translate("不同意收錄到國際大數據與ERP學術及實務研討會") ?><br/>
																			<input type="radio" name="b_q9" value="同意收錄到國際大數據與ERP學術及實務研討會"  <?php if ($row_max[39] == '同意收錄到國際大數據與ERP學術及實務研討會') echo ' checked="checked"'; ?> > <?= translate("同意收錄到國際大數據與ERP學術及實務研討會") ?><br/>
																			<input type="radio" name="b_q9" value="同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊"  <?php if ($row_max[39] == '同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊') echo ' checked="checked"'; ?> > <?= translate("同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊") ?>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-center"><?= translate("審查更新時間") ?></td>
																		<td class="text-center"><input readonly type="text" class="form-control" id="b_update_time" name="b_update_time" value="<?php echo $row_max[40] ; ?>" placeholder="<?= translate("審查更新時間") ?>"></td>
																	</tr>
																</tbody>
														 </table>
														</div>
													</div>
												</div>
		<button class="btn btn-default" type="submit" name="action" id="check_select" 
		<?php if (($row_max[29] != NULL && $row_max[17] != $_COOKIE["id"]	)&&(($row_max[29] == NULL || $row_max[40] != NULL)&& $row_max[18] != $_COOKIE["id"])) { ?> style="display:none" <?php } ?>><?= translate("送出") ?></button>
  
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
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>
</html>
<script>
	$(document).ready(function() {
		$( "#fud1_2" ).hide();		
		$( "#fud2_2" ).hide();
		$( "#fud3_2" ).hide();
		$("#check_select").click(
			function(){    
				$("#author").removeAttr("disabled");
				$("#agree").removeAttr("disabled");
			}
		);
	});
	function deletephoto1(){
			$( "#fud1_2" ).show();
			$( "#fud1" ).hide();
			$( "#urldelete1" ).hide();
			$( "#fud1" ).val("");
				$( "#file01" ).hide();
	}
		function deletephoto2(){
			$( "#fud2_2" ).show();
			$( "#fud2" ).hide( );
			$( "#fud2" ).val("");
			$( "#urldelete2" ).hide();
				$( "#file02" ).hide();
	}
	function deletephoto3(){
			$( "#fud3_2" ).show( );
			$( "#fud3" ).hide( );
			$( "#urldelete3" ).hide();
			$( "#fud3" ).val("");
				$( "#file03" ).hide();
	}
	function edititem(a){
		answer = confirm("你確定要編輯此筆資料嗎？");
	}
	function gohome(){
		answer = confirm("<?= translate('您確定放棄此次異動嗎？') ?>");
		if (answer)
		location.href='a01_review.php';
	}
</script>
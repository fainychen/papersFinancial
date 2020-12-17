<?php 
  error_reporting(0);
  include("Setting.php");
  // 上传文件进行简单错误过滤
  if ($_FILES['userfile3']['error'] > 0) {
    exit(translate("文件上傳有錯").$_FILES['userfile3']['error']);
  }

  // 定义存放上传文件的真实路径
  $path = './upload/'.$_POST['mPath'];
  // 定义存放上传文件的真实路径名字
  //$name = $_FILES['userfile3']['name'];
  $name = $_POST['mName'];
  // 将文件的名字的字符编码从UTF-8转成GB2312
  $name = iconv("UTF-8", "GB2312", $name);
  // 将上传文件移动到指定目录文件中
  if (move_uploaded_file($_FILES['userfile3']['tmp_name'], $path.'/'.$name)) {
    echo translate("文件上傳成功");
  } else {
    echo translate("文件上傳失敗");
  }
 ?>
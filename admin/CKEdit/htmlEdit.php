<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="梅問題,教學網,photoshop教學,flex教學,javascript教學,css教學,網頁教學,架站教學,wordperss教學,jQuery教學">
<meta content="all" name="minwt.com" />
<meta name="author" content="梅干扣肉" />

<title>梅問題‧教學網-範例整合【CKedit+CKfinder即見即所得文章編輯器】</title>
<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<form action="htmlEdit.php" method="post">
		<p>
  <div style="width:500px;">
            <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
  </div>
        </p>
		<p>
			<input type="submit" value="自動存檔" id="ID_Submit"/>
		</p>
	</form>
    
 <p>
   <?php
	include_once "ckeditor/ckeditor.php";
	$CKEditor = new CKEditor();
	$CKEditor->basePath = 'ckeditor/';
	$CKEditor->replace("editor1");
//define('AUTOSAVE_CONTENT', 'editor1');
class Autosave {
	public $debugMode = FALSE;
	public function saveToFile($path) {		
		$result = file_put_contents( $path, $_POST['editor1'] );
		// OK
		if ($result !== FALSE) {
			return $result;
		}
		// An error occurred
		if ($this->debugMode) {
			$error = error_get_last();
			if (!empty($error)) {
				return $result;
			}
		}
		return $result;
	}
}

// Uncomment the lines below to try the autosave plugin.
 $autosave = new Autosave();
 $autosave->debugMode = true;
 $temp_file = 'D:/autosave_'.time().'.txt';
  $autosave->saveToFile($temp_file);
 /*
   $autosave = new Autosave();
   $autosave->debugMode = true;
  $autosave->saveToFile('/CKEdit/upload/file.txt');*/
?>
 </p>
</body>
</html>
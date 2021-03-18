<?php
include("Setting.php");
include("SQLconnect.php");

$sql = "SELECT * FROM submission where enable is null;";
$result = mysqli_query($conn, $sql);


header("Content-type: application/vnd.ms-word;charset=utf-8;");
header("Content-Disposition: attachment;Filename=投稿人資料_完整版.doc");

echo "<html >";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8;\">";

echo "<style type=\"text/css\">";
echo ".tg  {border-collapse:collapse;border-spacing:0;table-layout:fixed;}";
echo ".tg td{border-color:black;border-style:solid;border-width:1px;font-family:標楷體, Times New Roman;font-size:12px;";
echo "  overflow:hidden;padding:10px 5px;word-break:normal;}";
echo ".tg th{border-color:black;border-style:solid;border-width:1px;font-family:標楷體, Times New Roman;font-size:12px;";
echo "  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}";
echo ".tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}";
echo ".tg .tg-1pky{border-color:inherit;text-align:center;vertical-align:top; }";

echo "@page{";
echo "	mso-page-border-surround-header: no;";
echo "	mso-page-border-surround-footer: no;";
echo "}";
echo "@page WordSection1{";
echo "	size:841.9pt 595.3pt;";
echo "	mso-page-orientation:landscape;";
echo "	margin:36.0pt 36.0pt 36.0pt 36.0pt;";
echo "	mso-header-margin:42.55pt;";
echo "	mso-footer-margin:49.6pt;";
echo "	mso-paper-source:0;";
echo "}";

echo "div.WordSection1";
echo "{";
echo "page: WordSection1;";
echo "}";

echo "</style>";
echo "<body>";
echo "<div class=\"WordSection1\">";
echo "<div class=\"row\" style=\"text-align:center\"><span style=\"font-family:標楷體, Times New Roman;font-size:26.5px;\"><b>投稿人資料</b></span></div><br/>";
$now = new DateTime();
echo "<span style=\"font-family:標楷體, Times New Roman;font-size:12px;\">更新日期：". $now->format('Y-m-d H:i:s') ."</span><br/>";
echo "<br/>";


echo "<table width=\"100%\" class=\"tg\">";
echo "<thead>";
echo "  <tr>";
echo "    <th class=\"tg-1pky\"><b>作者</b></th>";
echo "    <th class=\"tg-1pky\"><b>論文題目</b></th>";
echo "    <th class=\"tg-1pky\"><b>通訊作者</b></th>";
echo "    <th class=\"tg-1pky\"><b>共同作者</b></th>";
echo "  </tr>";
echo "</thead>";
echo "<tbody>";
	while($row = @mysqli_fetch_object($result))
	{		
		echo "  <tr style=\"background-color: #D2E9FF;\">";
			
			echo "    <td class=\"tg-1pky\">";
			$sql1 = "SELECT * FROM author;";
			$result1 = mysqli_query($conn, $sql1);
			$i = 0;
			while($row1 = @mysqli_fetch_object($result1))
			{
				$i = $i +1;
				if ($row->author == $row1->author_no) echo $row1->name;
			}
			echo "</td>";
			
			echo "    <td class=\"tg-0pky\">";
				echo $row->topic;;
			echo "</td>";
			
			echo "    <td class=\"tg-1pky\">";
				echo $row->affiliations;;
			echo "</td>";
			
			$mCoauthors = json_decode($row->coauthors, true);
			echo "    <td class=\"tg-1pky\">";
				echo $mCoauthors[0]["name"] . " ";
				echo $mCoauthors[1]["name"] . " ";
				echo $mCoauthors[2]["name"] . " ";
				echo $mCoauthors[3]["name"] . " ";
				echo $mCoauthors[4]["name"];
				//echo $row->coauthors;;
			echo "</td>";
			
echo "  </tr>";	
}
echo "</tbody>";
echo "</table>";
echo "<br/>";
echo "</div>";
echo "</body>";
echo "</html>";
?>
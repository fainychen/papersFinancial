<?php



header("Content-type: application/vnd.ms-word;charset=utf-8;");
header("Content-Disposition: attachment;Filename=評審意見表.doc");

echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8;\">";
echo "<body>";
echo "<div class=\"row\" style=\"text-align:center\"><span style=\"font-family:標楷體, Times New Roman;font-size:26.5px;\"><b>評審意見表</b></span></div><br/>";
echo "<span style=\"font-family:標楷體, Times New Roman;font-size:21px;\">論文題目*：".$_GET['paper_name']."</span><br/>";
echo "<span style=\"font-family:標楷體, Times New Roman;font-size:21px;\">評審姓名*：(免填)</span><br/>";
echo $_GET['name'];
echo "<span style=\"font-family:標楷體, Times New Roman;font-size:21px;\">送審日期：(免填)</span><br/>";
echo "<span style=\"font-family:標楷體, Times New Roman;font-size:21px;\">截稿日期：(免填)</span><br/>";
echo "<span style=\"font-family:標楷體, Times New Roman;font-size:21px;\">連絡email：conf@cerps.org.tw</span><br/>";
echo "<br/>";

echo "<style type=\"text/css\">";
echo ".tg  {border-collapse:collapse;border-spacing:0;}";
echo ".tg td{border-color:black;border-style:solid;border-width:1px;font-family:標楷體, Times New Roman;font-size:18.5px;";
echo "  overflow:hidden;padding:10px 5px;word-break:normal;}";
echo ".tg th{border-color:black;border-style:solid;border-width:1px;font-family:標楷體, Times New Roman;font-size:18.5px;";
echo "  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}";
echo ".tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}";
echo ".tg .tg-1pky{border-color:inherit;text-align:center;vertical-align:top}";
echo "</style>";
echo "<table width=\"100%\" class=\"tg\">";
echo "<thead>";
echo "  <tr>";
echo "    <th class=\"tg-0pky\"></th>";
echo "    <th class=\"tg-1pky\"><b>極優</b></th>";
echo "    <th class=\"tg-1pky\"><b>優</b></th>";
echo "    <th class=\"tg-1pky\"><b>普通</b></th>";
echo "    <th class=\"tg-1pky\"><b>差</b></th>";
echo "    <th class=\"tg-1pky\"><b>極差</b></th>";
echo "  </tr>";
echo "</thead>";
echo "<tbody>";
echo "  <tr style=\"background-color: #D2E9FF;\">";
echo "    <td class=\"tg-0pky\">1. 研究的原創性或創新性</td>";
if ($_GET['q1'] == '極優') {
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q1'] == '優'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q1'] == '普通'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q1'] == '差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q1'] == '極差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
echo "  </tr>";
echo "  <tr>";
echo "    <td class=\"tg-0pky\">2. 議題的重要性</td>";
if ($_GET['q2'] == '極優') {
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q2'] == '優'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q2'] == '普通'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q2'] == '差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q2'] == '極差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
echo "  </tr>";
echo "  <tr style=\"background-color: #D2E9FF;\">";
echo "    <td class=\"tg-0pky\">3. 文獻的相關性與完整性</td>";
if ($_GET['q3'] == '極優') {
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q3'] == '優'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q3'] == '普通'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q3'] == '差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q3'] == '極差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
echo "  </tr>";
echo "  <tr>";
echo "    <td class=\"tg-0pky\">4. 方法的正確性與嚴謹度</td>";
if ($_GET['q4'] == '極優') {
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q4'] == '優'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q4'] == '普通'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q4'] == '差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q4'] == '極差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
echo "  </tr>";
echo "  <tr style=\"background-color: #D2E9FF;\">";
echo "    <td class=\"tg-0pky\">5. 文章的組織結構</td>";
if ($_GET['q5'] == '極優') {
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q5'] == '優'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q5'] == '普通'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q5'] == '差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q5'] == '極差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
echo "  </tr>";
echo "  <tr>";
echo "    <td class=\"tg-0pky\">6. 學術價值或應用價值</td>";
if ($_GET['q6'] == '極優') {
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q6'] == '優'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q6'] == '普通'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q6'] == '差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
if ($_GET['q6'] == '極差'){
echo "    <td class=\"tg-1pky\">☑</td>";
} else {
echo "    <td class=\"tg-1pky\">□</td>";
}
echo "  </tr>";
echo "  <tr style=\"background-color: #D2E9FF;\">";
echo "    <td class=\"tg-0pky\">7. 總結</td>";
echo "    <td colspan=\"5\" class=\"tg-0pky\">";

if ($_GET['q7'] == '6' || $_GET['q7'] == '7' || $_GET['q7'] == '8'){
echo "☑強烈接受(+2)";
} else {
echo "□強烈接受(+2)";
}
if ($_GET['q7'] == '3' || $_GET['q7'] == '4' || $_GET['q7'] == '5'){
echo "☑建議接受(+1)";
} else {
echo "□建議接受(+1)";
}
echo "<br>";
if ($_GET['q7'] == '0.1' || $_GET['q7'] == '1' || $_GET['q7'] == '2'){
echo "☑傾向接受(+0)";
} else {
echo "□傾向接受(+0)";
}

if ($_GET['q7'] == '-0.1' || $_GET['q7'] == '-1' || $_GET['q7'] == '-2'){
echo "☑傾向拒絕(-0)";
} else {
echo "□傾向拒絕(-0)";
}
echo "<br>";
if ($_GET['q7'] == '-3' || $_GET['q7'] == '-4' || $_GET['q7'] == '-5'){
echo "☑建議拒絕(-1)";
} else {
echo "□建議拒絕(-1)";
}
if ($_GET['q7'] == '-6' || $_GET['q7'] == '-7' || $_GET['q7'] == '-8'){
echo "☑強烈拒絕(-2)";
} else {
echo "□強烈拒絕(-2)";
}
echo "<br>";
echo "</td>";
echo "  </tr>";
echo "</tbody>";
echo "</table>";

echo "<br/>";
echo "<span style=\"font-family:標楷體, Times New Roman;font-size:18.5px;\">8.評論及修改意見*︰（請就上述議題、論文之優缺點及具體修改方向評述，內容長度希望能盡量接近一頁，謝謝。）<br/>".$_GET['q8']."</span><br/>";
echo "<br/>";

echo "</body>";
echo "</html>";
?>
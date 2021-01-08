<?php
	
	//date_default_timezone_set("Asia/Taipei");
	error_reporting(0);
	
	$r0 = '0';
	$r1 = '1';
	$r2 = '2';
	
	$privateKey = "1111111111111111";
	$iv 	= "1111111111111111";
	$data0 	= $r0;
	$rEncrypted0 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data0, MCRYPT_MODE_CBC, $iv);
	
	$data1 	= $r1;
	$rEncrypted1 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data1, MCRYPT_MODE_CBC, $iv);
	
	$data2 	= $r2;
	$rEncrypted2 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data2, MCRYPT_MODE_CBC, $iv);
	
	
	/*
		使用方式如下:
		<?= translate("功能選單") ?>
	*/
	function translate($string) {
		if (empty($_COOKIE['lang'])) {
			return $string;
		} else {
			$lang = $_COOKIE['lang'];
			if ($lang == "zh-TW") {
				return $string;
			} else if ($lang == "en_US") {
				switch ($string) {
					case "切換語言":						return "Switch Language";
					case "中文":							return "Traditional Chinese";
					case "English":							return "English";
					case "查看版本訊息":					return "Version Message";
					case "登入管理後台":					return "System Login";
					case "建議使用 Chrome, Microsoft Edge 瀏覽; 若瀏覽器未能跳轉至註冊頁面, ":				return "It is recommended to use Chrome, Microsoft Edge";
					case "作者註冊請點我":					return "Author Registration";
					case "帳號":							return "E-mail Account";
					case "密碼":							return "Password";
					case "身分別":							return "Role";
					case "作者":							return "Author";
					case "審查委員":						return "Reviewer";
					case "大會工作人員":					return "Conference Staff";
					case "系統管理員":						return "System Administrator";
					case "＊ 新功能登場囉！<br/>
		＊ 感謝您使用本論文投稿系統，我們已修復了一些小問題並改善系統安全性及穩定度":						return "＊ New features are available! <br/>
＊ Thank you for using this paper submission system, we have fixed some minor problems and improved system security and stability";
					case "登入":							return "Log In";
					case "作者註冊":						return "Author Registration";
					
					// 功能選單
					case "功能選單":						return "menu";
					case "投稿管理":						return "Paper submission management";
					case "一般管理":						return "General management";
					case "參數設定":						return "Parameter setting";
					case "統計與查詢":						return "Statistics and search";
					case "論文投稿":						return "Paper submit";
					case "資料維護":						return "Data maintain";
					case "論文審查及下載":					return "Paper review and download";
					case "審查結果寄發":					return "Send review result";
					case "論文修改":						return "edit paper";
					case "(模擬作者)":						return "Simulate author";
					case "作者管理":						return "Author management";
					case "系統參數設定":					return "System parameter setting";
					case "通知信設定":						return "Notification letter setting";
					case "總編輯帳號設定":					return "Account setting of Chief editor";
					case "論文類別維護":					return "Paper category maintenance";
					case "論文主題維護":					return "Paper topic maintenance";
					case "推薦期刊維護":					return "Recommendation Journal maintenance";
					case "郵件備份":						return "Mail backup";
					case "您好,":							return "Hello,";
					case "登出":							return "Log out";
					case "建立審查委員名單":				return "Establish a review committee list";
					
					// 論文審查及下載
					case "論文審查及下載":					return "Paper review and download";
					case "請選擇":							return "Choose";
					case "作者暫存論文":					return "Temporary save"; 
					case "作者上傳完論文":					return "Submit"; 
					case "審稿進行中":						return "Reviewing";
					case "審稿結束，等待編輯決定":			return "Review is over, waiting editor's decision";
					case "接受":							return "Accept";
					case "拒絕":							return "Reject";
					case "接受並推薦到期刊":				return "Accept and recommend to Journal";
					case "審查主題":						return "Topic";
					case "論文題目":						return "Paper subject";
					case "論文匿名全文版本":				return "Anonymous-full-text version of the paper"; 
					case "論文具名全文版本":				return "Named - full-text version of the paper"; 
					case "著作權讓與書":					return "Copyright Assignment"; 
					case "投稿時間":						return "Submission time";
					case "目前狀態":						return "Status";
					case "您確定要刪除此筆資料嗎？":		return "Are you sure to delete this data???"; 
					
					// 編輯論文審查及下載
					case "編輯論文審查及下載":				return "Edit paper review and download";
					case "論文內容":						return "Paper content";
					case "論文編號":						return "Paper number";
					case "作者":							return "Author";
					case "論文主題(第一)":					return "Thesis topic (first)";
					case "論文主題(第二)":					return "Thesis topic (second)";
					case "推薦期刊志願序":					return "Recommended journal volunteer order";
					case "不願意推薦期刊":					return "Unwilling to be recommend journals";
					case "(拖曳表格內容以修改志願序)":		return "(Drag the table content to modify the voluntary order)"; 
					case "願意推薦期刊":					return "Willing to be recommend journals";
					case "推薦期刊名稱":					return "Recommended journal title";
					case "志願序":							return "Voluntary order";
					case "操作":							return "Operation";
					case "索引":							return "Index";
					case "限制條件":						return "Limitation";
					case "推薦流程":						return "Recommended process";
					case "報告者姓名":						return "Presenter Name";
					case "報告者服務單位(單位全名、國家名)":	return "Presenter Service Unit(Full name of unit, country name)";
					case "論文題目":						return "Paper topic";
					case "共同作者":						return "Co-author";
					case "通訊作者":						return "Corresponding author";
					case "通訊作者Email":					return "Corresponding author e-mail";
					case "論文匿名全文版本":				return "Anonymous full text version of the paper";
					case "論文具名全文版本":				return "Named - full-text version of the paper"; 

					case "著作權讓與書":					return "Copyright Assignment"; 
					case "檔案下載":						return "File download";
					case "我確保此篇論文從未在其它地方發表過":		return "I make sure this paper has never been published elsewhere";
					case "同意":							return "Agree";
					case "不同意":							return "Disagree";
					case "投稿時間":						return "Submission time";
										
					case "審查設定":						return "Review settings";
					case "審查主題":						return "Review subject";
					case "審查結果":						return "Review result";
					case "不同意收錄到國際大數據與ERP學術及實務研討會":										return "Disagree to be included in International Conference on the Development and Application of Big Data and Enterprise Resource Management ";
					case "同意收錄到國際大數據與ERP學術及實務研討會":										return "Agree to be included in International Conference on the Development and Application of Big Data and Enterprise Resource Management";
					case "同意收錄到國際大數據與ERP學術及實務研討會且推薦到期刊":							return "Agree to be included in International Conference on the Development and Application of Big Data and Enterprise Resource Management and recommended to the journal";
					case "審查更新時間":					return "Update time";
					case "A審查委員編號":					return "Reviewer A"; 
					case "B審查委員編號":					return "Reviewer B "; 
					
					case "審查委員A":						return "Reviewer A"; 
					case "審查委員B":						return "Reviewer B";
					case "審查委員姓名":					return "Reviewer name"; 
					case "1研究的原創性或創新性":			return "1 Originality or innovation of the study";
					case "2議題的重要性":					return "2 The importance of the issue";
					case "3文獻的相關性與完整性":			return "3 Relevance and completeness of the literature";
					case "4方法的正確性與嚴謹度":			return "4 The accuracy and rigor of method";
					case "5文章的組織結構":					return "5 The organizational structure of the paper";
					case "6學術價值或應用價值":				return "6 Academic value or application value";
					case "7總結":							return "7 Conclusion";
					case "評論及修改意見":					return "Comment";
					case "本論文審查結論":					return "Conclusion";
					case "審查更新時間":					return "Update time";
					case "請就上述議題、論文之優缺點及具體方向評述。請最少填寫30字的審查意見。":			return "Please enter your comment for this topic including pros and cons";
					case "您確定放棄此次異動嗎？":			return "Are you sure to abandon this transaction";
					case "返回":							return "Back";
					case "儲存":							return "Save";
					
					// 郵件備份
					case "編輯郵件備份":					return "Edited mail backup";
					case "郵件備份":						return "Mail backup";
					case "標題":							return "Title";
					case "收件信箱":						return "Receiver";
					case "寄送時間":						return "Delivery time";
					case "詳細內容":						return "Details";
					case "編號":							return "Number";
					case "新增郵件備份":					return "Add New mail backup";
					
					// 論文投稿
					case "新增投稿":						return "Add submission";
					case "請輸入共同作者, 格式: Name(Affiliation)":											return "Please enter co-author, format: Name(Affiliation)";
					case "通訊作者電話":					return "Corresponding author's phone number";
					case "投稿論文語言":					return "The language of paper";
					case "(需使用PDF檔上傳)":				return "Pdf";
					case "(需使用WORD檔上傳)":				return "Word";
					case "中":								return "Chinese";
					case "英":								return "English";
					case "論文審查意見語言":				return "The Language of paper review comments";
					case "論文狀態":						return "Status";
					case "送出":							return "Send";
					case "暫存":							return "Temporary save"; 
					case "建立投稿":						return "Establish submission";
					case "編輯投稿":						return "Edit submission";
					case "原始順序":						return "Original sequence";
					case "刪除推薦期刊志願序後, 如需重新加回來, 您將需要重新進行論文投稿, 請確認是否仍要刪除選項":					return "Are you sure to delete it?";
					
					// 論文審查
					case "論文審查及下載":					return "Paper review and download";
					case "論文下載":						return "Download";
					case "審查時間":						return "Time";
					case "審查上限&已審查統計":				return "Reviewed statistics"; 
					case "論文主題名稱":					return "Paper title";
					case "接受最大篇數上限":				return "Accept the maximum number of articles";
					case "已接受篇數":						return "Number of articles accepted";
					case "接受並推薦到期刊最大篇數上限":	return "Accept and recommend to the maximum number of journals";
					case "已接受並推薦篇數":				return "Accepted and recommended";
					
					case "極優":							return "Excellent";
					case "優":								return "Good";
					case "普通":							return "Ordinary";
					case "差":								return "Poor"; 
					case "極差":							return "Very poor";  
					case "強烈接受(+8)":					return "Strongly accept(+8)";
					case "強烈接受(+7)":					return "Strongly accept(+7)";
					case "強烈接受(+6)":					return "Strongly accept(+6)";
					case "強烈接受(+5)":					return "Strongly accept(+5)";
					case "強烈接受(+4)":					return "Strongly accept(+4)";
					case "強烈接受(+3)":					return "Strongly accept(+3)";
					case "強烈接受(+2)":					return "Strongly accept(+2)";
					case "建議接受(+1)":					return "Suggest to accept(+1)";
					case "傾向接受(+0)":					return "Tend to accept(+0)"; 
					case "傾向拒絕(-0)":					return "Tend to reject(-0)"; 
					case "建議拒絕(-1)":					return "Suggest to reject(-1)";
					case "強烈拒絕(-2)":					return "Strongly reject(-2)";
					case "強烈拒絕(-3)":					return "Strongly reject(-3)";
					case "強烈拒絕(-4)":					return "Strongly reject(-4)";
					case "強烈拒絕(-5)":					return "Strongly reject(-5)";
					case "強烈拒絕(-6)":					return "Strongly reject(-6)";
					case "強烈拒絕(-7)":					return "Strongly reject(-7)";
					case "強烈拒絕(-8)":					return "Strongly reject(-8)";
					
					// 總編輯帳號
					case "名稱":							return "Name";
					case "電子郵件":						return "E-mail";
					case "權限":							return "Authority";
					case "登入帳號":						return "Login account";
					case "E-mail":							return "E-mail";
					case "權限設定":						return "Permission setting";
					case "新增總編輯帳號":					return "Add Chief Editor Account";
					case "編輯總編輯帳號":					return "Edit Chief Editor Account";
					
					// 最新消息管理
					case "最新消息管理":					return "News management";
					case "日期":							return "Date";
					case "標題":							return "Title";
					case "新增最新消息":					return "Add news";
					case "簡要說明":						return "Description";
					case "請輸入日期, 格式: YYYY-MM-DD":											return "Date , format: YYYY-MM-DD";
					case "請輸入標題, 顯示於首頁, 建議字數為15個字以內":							return "Please enter title which shows on website, please within 15 words ";
					case "請輸入簡要說明, 顯示於首頁, 建議字數為200字以內":							return "Please enter the brief description which shows on website, please within 200 words";
					case "請輸入是否顯示, 格式: 1顯示; 0不顯示":									return "Please enter if need to show 1:show;0:Do not show";	
					case "是否顯示":						return "Show or not";
					case "編輯最新消息":					return "Edit news";
					
					// 作者註冊
					case "回登入頁面":						return "Home";
					case "流水號":							return "Serial number";
					case "帳號 (E-mail)":					return "Account (E-mail)";
					case "請輸入您的電子郵件 (登入帳號)":	return "Please enter your mail(login account)";
					case "姓名":							return "Name";
					case "單位":							return "Institution";
					case "職稱":							return "Job title";
					case "手機號碼":						return "phone number";
					case "輸入密碼":						return "enter password";
					case "再次輸入密碼":					return "enter password again";
					case "建立密碼 ( 6 - 12 characters )":	return "establish password (6-12)";
					case "傳真":							return "Fax";
					case "地址":							return "Address";
					case "註冊時間":						return "Registration time";
					case "為必填欄位":						return "is required";
					
					// 作者管理+個人資料維護
					case "個人資料維護":					return "Personal info maintenance"; 
					case "新增作者":						return "Add editor";
					case "電話":							return "Phone";
					case "編輯作者":						return "Editor"; 
					
					// 審查結果寄發
					case "流水編號":						return "Serial number"; 
					
					// 系統參數設定
					case "審查委員通知信-寄送狀態重置":		return "Reset";
					case "寄件者名稱":						return "Sender name";
					case "寄件者電子郵件":					return "Sender's mail";
					case "編輯系統參數":					return "Edit";
					
					// 通知信設定
					case "主旨":							return "Title";
					case "說明":							return "Description";
					case "內容":							return "Content";
					case "備註":							return "Remark";
					case "你可以使用下列標籤 (包含中括號) 放置在信件內容的任何位置，系統將幫您自動置換掉標籤所對應的資訊。
							<br/>
							請注意，在郵件內容中使用標籤時，大小寫必須完全一致，否則系統無法協助轉換。
							<br/><br/>
							[Paper]	論文內容 ( 包含流水號、論文編號、論文類別、論文主題、論文題目、作者、單位 )<br/>
							[CAuthor]	通訊作者姓名<br/>
							[Author]	作者姓名<br/>
							[Reviewer]	審查委員姓名<br/>
							[Reviewer_ID]	審查帳號<br/>
							[Reviewer_Password]	審查密碼<br/>
							[Chief_Decide]	論文審查結論":					return "";
					case "新增通知信設定":					return "Add";
					case "編輯通知信設定":					return "Edit";
					
					// 推薦期刊維護
					case "新增推薦期刊":					return "Add";
					case "編輯推薦期刊":					return "Edit";
					case "推薦期刊代碼":					return "Recommend journals No.";
					case "推薦期刊名稱":					return "Recommended journal title"; 
					case "索引":							return "Index";
					case "限制條件":						return "Limitation";
					case "推薦流程":						return "Recommend Process";
					
					// 論文主題維護
					case "新增論文類別":					return "Add";
					case "編輯論文類別":					return "Edit";
					case "論文主題代碼":					return "Paper topic code";
					case "論文主題名稱":					return "Paper topic name";
					case "審查委員數":						return "Review Committee"; 
					case "接受最大篇數":					return "Accept the maximum number of articles";
					case "接受並推薦到期刊最大篇數":		return "Accept and recommend to the maximum number of journals";
					
					// 論文類別維護
					case "新增論文類別":					return "Add";
					case "編輯論文類別":					return "Edit";
					case "類別代碼":						return "Category code";
					case "類別名稱":						return "Category name";
					
					// 審查委員
					case "審查委員名單":					return "Reviewer List";
					case "新增審查委員名單":				return "Add";
					case "編輯審查委員名單":				return "Edit";
					case "帳號(Email)":						return "Account(Email)";
					case "領域":							return "Field";
					case "Chief":							return "Chief";
					case "已審篇數":						return "Number of articles reviewed";
					case "寄送邀請通知":					return "Send invitation notice"; 
					case "已寄":							return "Sent";
					case "序號":							return "No";
					case "是否為Chief":						return "Chief?";
					case "是":								return "Yes";
					case "否":								return "No";
					
					case "檔案上傳":						return "File upload";
					case "文件上傳有錯":					return "Upload Error";
					case "文件上傳成功":					return "Upload Success";
					case "文件上傳失敗":					return "Upload Fail";
					
					
					case "順序":					        return "Order";
					case "服務單位":					    return "Service Unit";
					case "會員身份確認":					return "Membership Confirmation";
					case "A. 作者中是否有人是臺灣財務金融學會2021年度有效會員?":					    return "A. Is any of the authors a valid member of The Taiwan Finance Association in 2021?";
					case "B. 請輸入有會員身分的作者姓名，若有複數作者為會員，請用分號；隔開":					    return "B. Please enter the name of the author who is a member. If there are multiple authors as members, please use semicolons; separate";
					case "刪除":					   		return "Delete";
				}
			}
		}
	}
?>
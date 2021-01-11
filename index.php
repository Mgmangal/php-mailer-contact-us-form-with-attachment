<?php
	session_start();
	$_SESSION['language'] = "english";

	if(isset($_POST['wp-submit']))
	{
		$send = true;
		$language = $_POST['language'];
		$_SESSION['language'] = $language;
		$services = "";
		$source = "";
		$target = "";
		$name = "";
		$phone = "";
		$email = "";

		if(isset($_POST['services']))
		{
			$services = $_POST['services'];
		}
		else
		{
			$send = false;
		}

		if(!empty($_POST['source']))
		{
			$source = $_POST['source'];
		}
		else{
			$send = false;
		}

		if(!empty($_POST['target']))
		{
			$target = $_POST['target'];
		}
		else{
			$send = false;
		}

		if(!empty($_POST['name']))
		{
			$name = $_POST['name'];
		}
		else{
			$send = false;
		}

		if(!empty($_POST['phone']))
		{
			$phone = $_POST['phone'];
		}
		else{
			$send = false;
		}

		if(!empty($_POST['email']))
		{
			$email = $_POST['email'];
		}
		else{
			$send = false;
		}

		$message = $_POST['message'];
		$date = $_POST['date'];
		$deliverydate = date("M d, Y", strtotime($date));
		$uploadedfile = "";

		if(!empty($_FILES['customfile']['name']))
		{
			$filename = $_FILES['customfile']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$extensions = array('xls', 'ppt', 'docx', 'otx', 'xslx', 'xltx', 'pptx', 'pdf', 'xml', 'html', 'txt', 'mp3', 'wav', 'mid', 'mp4', 'avi', '3gp', 'flv');

			if(($_FILES['customfile']['size'] < 20971520) && (in_array($ext,$extensions)))
			{
				move_uploaded_file($_FILES['customfile']['tmp_name'], "files/" . basename($filename));
			}
			else
			{
				$uploadedfile = "invalid";
				$send = false;
			}

			$directory = "https://honyakuservices.000webhostapp.com/files/" . basename($filename);
		}
		else
		{
			$uploadedfile = "no file";
			$send = false;
		}

		if($send == true)
		{
			$to = "sales@honyakuservices.com";
			if($language === "english")
			{
				$subject = "Request";
			}
			if($language === "japanese")
			{
				$subject = "リクエスト";
			}

			if($language === "english")
			{
				$content = "<b>Name:</b><br/>" . $name . "<br/><br/><b>Phone:</b><br/>" . $phone . "<br/><br/><b>Email:</b><br/>" . $email . "<br/><br/><b>Services:</b><br/>" . $services . "<br/><br/><b>Source:</b><br/>" . $source . "<br/><br/><b>Target:</b><br/>" . $target . "<br/><br/><b>Delivery Deadline:</b><br/>" . $deliverydate . "<br/><br/><b>Project File:</b><br/><a href='" . $directory . "'>" . basename($filename) . "</a><br/><br/><b>Message:</b><br/>" . $message;
			}

			if($language === "japanese")
			{
				$content = "<b>名前:</b><br/>" . $name . "<br/><br/><b>電話:</b><br/>" . $phone . "<br/><br/><b>Eメール:</b><br/>" . $email . "<br/><br/><b>サービス:</b><br/>" . $services . "<br/><br/><b>ソース:</b><br/>" . $source . "<br/><br/><b>目標:</b><br/>" . $target . "<br/><br/><b>納期:</b><br/>" . $deliverydate . "<br/><br/><b>プロジェクトファイル:</b><br/><a href='" . $directory . "'>" . basename($filename) . "</a><br/><br/><b>メッセージ:</b><br/>" . $message;
			}

			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "Reply-To: " . $email . "\r\n";

			mail($to,$subject,$content,$headers);
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<!-- Required meta tags -->
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Contact Form - Honyaku Services</title>
     
          <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
          <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.min.css">-->
          <link rel="stylesheet" type="text/css" href="css/form.css">
          <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'> 
 
  
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>	
     <style type="text/css">
     #ui-datepicker-div{
     	background-color: #000000;
     }
     .ui-datepicker table{
        background-color: #000000;
     }
     .ui-datepicker th{
        color: white;
     }
     #ui-datepicker-div {
    padding: 0px;
    background: rgb(0, 0, 0);
    border: none
    }
    .ui-datepicker .ui-datepicker-header {
        background: #000;  
        border: none
    }
    .ui-state-default, .ui-widget-content .ui-state-default {
        color: #fff;
        background: #000;
        text-align: center;
        border: transparent;
    }
    .ui-datepicker-today .ui-state-default {
    border-radius: 2px;
    }
    .ui-widget.ui-widget-content {
        padding: 0px;
        border: unset;
        background: transparent;
    }
    .ui-datepicker .ui-datepicker-header {
        border-radius: 0px;
    }
    td.ui-datepicker-current-day .ui-state-active {
        background: blue;
    }
    .ui-widget-content .ui-datepicker-prev .ui-icon {
    background:url(https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/images/ui-icons_ffffff_256x240.png) ;
    background-position: -80px -192px;
 }

 .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover {
    border-color: #fff;
    background: #000;
    border: none;
 }

 .ui-state-hover .ui-icon {
  background:url(https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/images/ui-icons_ffffff_256x240.png) ;
    background-position: -48px -192px;
 }
  .ui-datepicker .ui-datepicker-prev-hover {
    top: 1px;
 }
 .ui-datepicker .ui-datepicker-next-hover {
    top: 1px;
 }
 .ui-datepicker .ui-datepicker-prev {
    top: 1px;
 }
 .ui-datepicker .ui-datepicker-next {
      top: 1px;
 }
 
 option:checked {
    display: none !important;
}

.japanese option:checked {
    display: none !important;
} 
        
     </style>
</head>
<body>
<?php if (isset($_SESSION['message']['contact'])) { ?>
  <div class="alert alert-dismissible" style="color: #000000;
    background-color: #ffffff;
    border-color:#ffffff;
    margin-bottom: 0px;
    border-radius: 0px;
    text-align: center;">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
   <?php echo $_SESSION['message']['contact']; ?>
  </div>
 <?php
     unset($_SESSION['message']['contact']);
    }
 ?>
<div id="language_switch">
	<a href="index.php" class="lang_eng">&nbsp;</a>
	<a href="#" class="lang_jap">&nbsp;</a>
</div>		
<section class="form-section">
	<div class="top_info">
	<div class="contact-info">
		<p class="mb-0">
		<span class="d-inline-block"><span class="english">Contact:</span><span class="japanese">連絡先：</span></span>
		
		<span class="d-inline-block">
			<a href="tel:+0091 7019619169">+0091 7019619169</a><br />
			<a href="tel:+0091 8837476812">+0091 8837476812</a>
		</span>
		</p>
		<p><span class="english">Email:</span>
			<span class="japanese">Eメール：</span>
			<a href="mailto:sales@honyakuservices.com">sales@honyakuservices.com</a>
		</p>
	</div>
	<div class="form-info-title english">
		Our priority is to secure customer data safe and committed to assure the protection and confidentiality of our client's data.
	</div>
	<div class="form-info-title japanese">
		お客様のデータを保護し、弊社の間でやり取りするデータは全てのプライバシー保護すること
		で安全を確保と守秘義務を誓約しています。
	</div>
</div>
	<?php
		if(isset($_POST['wp-submit']))
		{
			if($send == true)
			{
				if($language === "english")
				{
					echo '<p style="text-align: center; font-size: 22px; margin-bottom: 40px;">Thank you, your information has been sent!</p>';
				}
				if($language === "japanese")
				{
					echo '<p style="text-align: center; font-size: 22px; margin-bottom: 40px;">ありがとう、あなたの情報が送られました！</p>';
				}
			}
		}
	?>
	

	<form method="POST"   action="send_contact.php" name = "myForm" onsubmit = "return(validate());" enctype="multipart/form-data">
		<input type="hidden" name="language" id="language" value="<?php echo $_SESSION['language']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="box">
				<h4 class="english">Services</h4>
				<h4 class="japanese">サービス</h4>
				<div class="form-check english">
				  <input class="form-check-input" type="radio" name="services" id="Translation" value="Translation" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "Translation"){ echo 'checked'; }}}?>" checked>
				  <label class="form-check-label english" for="Translation">
				   	Translation
				  </label>
				</div>
				<div class="form-check english">
				  <input class="form-check-input" type="radio" name="services" id="Interpreter" value="Interpreter" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "Interpreter"){ echo 'checked'; }}}?>>
				  <label class="form-check-label english" for="Interpreter">
				   	Interpretation
				  </label>
				</div>
				<div class="form-check english">
				  <input class="form-check-input" type="radio" name="services" id="Transcribing" value="Transcribing" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "Transcribing"){ echo 'checked'; }}}?>>
				  <label class="form-check-label english" for="Transcribing">
				   	Transcribing
				  </label>
				</div>
				<div class="form-check english">
				  <input class="form-check-input" type="radio" name="services" id="Localization" value="Localization" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "Localization"){ echo 'checked'; }}}?>>
				  <label class="form-check-label english" for="Localization">
				   	Localization
				  </label>
				</div>
				<div class="form-check english">
				  <input class="form-check-input" type="radio" name="services" id="Subtitling" value="Subtitling" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "Subtitling"){ echo 'checked'; }}}?>>
				  <label class="form-check-label english" for="Subtitling">
				   	Subtitling
				  </label>
				</div>
				<div class="form-check english">
				  <input class="form-check-input" type="radio" name="services" id="Proofreading" value="Proofreading" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "Proofreading"){ echo 'checked'; }}}?>>
				  <label class="form-check-label english" for="Proofreading">
				   	Proofreading
				  </label><br/><br/>
				  <span class="english"><?php if(isset($_POST['wp-submit'])){ if(empty($services)){ echo 'Please select a service'; }}?></span>
				</div>
				
				<div class="form-check japanese">
				  <input class="form-check-input jap-fst" type="radio" name="services" id="Translation" value="翻訳" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "翻訳"){ echo 'checked'; }}}?> >
				  <label class="form-check-label japanese" for="Translation">
				   	翻訳
				  </label>
				</div>
				<div class="form-check japanese">
				  <input class="form-check-input" type="radio" name="services" id="Interpreter" value="通訳" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "通訳"){ echo 'checked'; }}}?>>
				  <label class="form-check-label japanese" for="Interpreter">
				  目標言語
				  </label>
				</div>
				<div class="form-check japanese">
				  <input class="form-check-input" type="radio" name="services" id="Transcribing" value="書き換える" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "書き換える"){ echo 'checked'; }}}?>>
				  <label class="form-check-label japanese" for="Transcribing">
				   	書き換える
				  </label>
				</div>
				<div class="form-check japanese">
				  <input class="form-check-input" type="radio" name="services" id="Localization" value="ローカライズ" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "ローカライズ"){ echo 'checked'; }}}?>>
				  <label class="form-check-label japanese" for="Localization">
				   	ローカライズ
				  </label>
				</div>
				<div class="form-check japanese">
				  <input class="form-check-input" type="radio" name="services" id="Subtitling" value="字幕翻訳" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "字幕翻訳"){ echo 'checked'; }}}?>>
				  <label class="form-check-label japanese" for="Subtitling">
				   	字幕翻訳
				  </label>
				</div>
				<div class="form-check japanese">
				  <input class="form-check-input" type="radio" name="services" id="Proofreading" value="プルーフリーディング" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($services === "プルーフリーディング"){ echo 'checked'; }}}?>>
				  <label class="form-check-label japanese" for="Proofreading">
				   	プルーフリーディング
				  </label><br/><br/>
				  <span class="japanese"><?php if(isset($_POST['wp-submit'])){ if(empty($services)){ echo 'サービスを選択してください'; }}?></span>
				</div>
				 <p id="servicesa" style="color: red"></p>
			</div>
			</div>

			<div class="col-md-3">
				<div class="box">
				<h4 class="english">Language Pair</h4>
				<h4 class="japanese">言語ペア</h4>
				<div class="form-group">
				    <label for="Source" class="english">Source*</label>
				    <label for="Source" class="japanese">原文言語 *</label>
				    
				    <select class="form-control" id="Source" name="source">
						<option value="English" class="english"  <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($source === "English"){ echo 'selected'; }}}?>>English</option>
						<option value="英語" class="japanese" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($source === "英語"){ echo 'selected'; }}}?>>英語</option>
						<option value="Japanese" class="english" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($source === "Japanese"){ echo 'selected'; }}}?>>Japanese</option>
						<option value="日本語" class="japanese" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($source === "日本語"){ echo 'selected'; }}}?>>日本語</option>
						<option value="Chinese" class="english" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($source === "Chinese"){ echo 'selected'; }}}?>>Chinese (Simplified)</option>
						<option value="中国語（簡体字）" class="japanese" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($source === "中国語（簡体字）"){ echo 'selected'; }}}?>>中国語（簡体字）</option>
				    </select>
				    
				  </div>
				  <div class="form-group">
				    <label for="Target" class="english">Target*</label>
				    <label for="Target" class="japanese">目標 *</label>
				    <select class="form-control" id="Target" name="target">
						<option value="English" class="english" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($target === "English"){ echo 'selected'; }}}?>>English</option>
						<option value="英語" class="japanese" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($target === "英語"){ echo 'selected'; }}}?>>英語</option>
						<option value="Japanese" class="english" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($target === "Japanese"){ echo 'selected'; }}}?>>Japanese</option>
						<option value="日本語" class="japanese" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($target === "日本語"){ echo 'selected'; }}}?>>日本語</option>
						<option value="Chinese" class="english" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($target === "Chinese"){ echo 'selected'; }}}?>>Chinese (Simplified)</option>
						<option value="中国語（簡体字）" class="japanese" <?php if(isset($_POST['wp-submit'])){ if($send == false){ if($target === "中国語（簡体字）"){ echo 'selected'; }}}?>>中国語（簡体字）</option>
				    </select>
				    
				 
				  </div>
				  <div class="form-group">
				    <label for="name" class="english">Name*</label>
				    <label for="name" class="japanese">お名前 *</label>
				    <input class="form-control" type="text" name="name" >
					<span class="english"><?php if(isset($_POST['wp-submit'])){ if(empty($name)){ echo '<br/>Please enter your name'; }}?></span>
					<span class="japanese"><?php if(isset($_POST['wp-submit'])){ if(empty($name)){ echo '<br/>名前を入力してください'; }}?></span>
				  </div>
				   <p id="namea" style="color: red"></p>
				  <div class="form-group">
				    <label for="phone" class="english">Phone*</label>
				    <label for="phone" class="japanese">電話番号 *</label>
				    <input class="form-control" type="number" name="phone" value="<?php if(isset($_POST['wp-submit'])){ if($send == false){ echo $phone; }}?>">
					<span class="english"><?php if(isset($_POST['wp-submit'])){ if(empty($phone)){ echo '<br/>Please enter your phone'; }}?></span>
					<span class="japanese"><?php if(isset($_POST['wp-submit'])){ if(empty($phone)){ echo '<br/>電話を入力してください'; }}?></span>
				  </div>
				  <p id="phonea" style="color: red"></p>
				  <div class="form-group">
				    <label for="email" class="english">Email*</label>
				    <label for="email" class="japanese">電子メール *</label>
				    <input class="form-control" type="email" name="email" value="<?php if(isset($_POST['wp-submit'])){ if($send == false){ echo $email; }}?>">
					<span class="english"><?php if(isset($_POST['wp-submit'])){ if(empty($email)){ echo '<br/>Please enter your email'; }}?></span>
					<span class="japanese"><?php if(isset($_POST['wp-submit'])){ if(empty($email)){ echo '<br/>あなたのメールアドレスを入力してください'; }}?></span>
				  </div>
				  <p id="emaila" style="color: red"></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box">
				<h4 class="english">Project File</h4>
				<h4 class="japanese">プロジェクトファイル</h4>
				<div class="form-group">
				<label class="english">Drop Source Document/Video*</label>
				<label class="japanese">ここに原稿・ビデオをドラッグアンドドロップ *</label>
				<div class="custom-file">
				  <input type="file" class="custom-file-input" id="customFile" name="customfile">
				  <?php if(isset($_POST['wp-submit'])){ if($uploadedfile === "no file"){ echo '<br/><span class="english">Please select a file</span><span class="japanese">ファイルを選択してください</span>'; } if($uploadedfile === "invalid"){ echo '<br/><span class="english">Invalid file. You file must have less than 20MB in size and be in one of the formats allowed.</span><span class="japanese">無効なファイル。 ファイルのサイズは20MB未満で、許可されている形式のいずれかである必要があります。</span>'; }}?>
				  <label class="custom-file-label english" for="customFile">No file chosen</label>
				  <label class="custom-file-label japanese" for="customFile">ファイルが選択されていません</label>
				  <small class="english">Maximum filesize: 20MB Allowed extensions: xls, ppt, docx, otx, xslx, xltx, pptx, pdf, xml, html, txt, mp3, wav, mid, mp4, avi, 3gp, flv</small>
				  <small class="japanese">最大ファイルサイズ：20MB許可される拡張子：xls、ppt、docx、otx、xslx、xltx、pptx、pdf、xml、html、txt、mp3、wav、mid、mp4、avi、3gp、flv</small>
				</div>
				<p id="customfilea" style="color: red"></p>
			</div>
				<div class="form-group">
				    <label for="message" class="english">Message</label>
				    <label for="message" class="japanese">メッセージ</label>
				    <textarea class="form-control" id="message" name="message" rows="5"><?php if(isset($_POST['wp-submit'])){ if($send == false){ echo $message; }}?></textarea>
				  </div>
				  	<p id="messagea" style="color: red"></p>
				  <div class="form-group">
				   <div class="g-recaptcha" data-sitekey="6LdECyQaAAAAABH0TeVSN30kV9LEgAgKDC_3X0tp"></div>
				  </div>
				  <div class="form-group text-right">
				    <input type="submit" name="wp-submit" id="wp-submit" class="btn bg-dark text-white no-box-shadow english" value="Submit">
				    <input type="submit" name="wp-submit" id="wp-submit" class="btn bg-dark text-white no-box-shadow japanese" value="送信する">
				  </div>
				 
				</div>
			</div>
			<div class="col-md-3">
				<div class="box">
				<h4 class="english">Delivery Deadline</h4>
				<h4 class="japanese">ご希望納期</h4>
                
				<div class="form-group">
				
		            <input type="hidden" name="date" id="date"/>
                    <div id="datepicker-13"  ></div>
                    
				</div>
			

				
				
				<p id="datea" style="color: red"></p>
				
				
		</div>
	</form>
</section>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script src="https://use.fontawesome.com/75e38a9c1f.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script> 
<!--<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>-->
<script src="js/init.js"></script>
<script type="text/javascript">
var lang = "english";
var updateDate = function(value){
    $("#date").val(value);
}
    $.datepicker.regional['en'] = {
                  "closeText": "Done",
                  "prevText": "Prev",
                  "nextText": "Next",
                  "currentText": "Today",
                  "monthNames": [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December"
                  ],
                  "monthNamesShort": [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec"
                  ],
                  "dayNames": [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                  ],
                  "dayNamesShort": [
                    "Sun",
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat"
                  ],
                  "dayNamesMin": [
                    "Su",
                    "Mo",
                    "Tu",
                    "We",
                    "Th",
                    "Fr",
                    "Sa"
                  ],
                  "weekHeader": "Wk",
                  "dateFormat": "mm/dd/yy",
                  "firstDay": 0,
                  "isRTL": false,
                  "showMonthAfterYear": false,
                  "yearSuffix": ""
                };
    $.datepicker.regional['ja'] = {
                  "closeText": "Done",
                  "prevText": "Prev",
                  "nextText": "Next",
                  "currentText": "Today",
                  "monthNames": [
                    "一月",
                    "二月",
                    "三月",
                    "四月",
                    "五月",
                    "六月",
                    "七月",
                    "八月",
                    "九月",
                    "十月",
                    "十一月",
                    "十二月"
                  ],
                  "monthNamesShort": [
                  
                    "1月",
                    "2月",
                    "3月",
                    "4月",
                    "5月",
                    "6月",
                    "7月",
                    "8月",
                    "9月",
                    "10月",
                    "11月",
                    "12月"
                  ],
                  "dayNames": [
                    "日曜日",
                    "月曜日",
                    "火曜日",
                    "水曜日",
                    "木曜日",
                    "金曜日",
                    "土曜日"
                  ],
                  "dayNamesShort": [
                    "太陽",
                    "月曜日",
                    "火曜日",
                    "結婚した",
                    "木",
                    "金",
                    "土"
                  ],
                  "dayNamesMin": [
                    "日",
                    "月",
                    "火",
                    "水",
                    "木",
                    "金",
                    "土"
                  ],
                  "weekHeader": "Wk",
                  "dateFormat": "mm/dd/yy",
                  "firstDay": 0,
                  "isRTL": false,
                  "showMonthAfterYear": false,
                  "yearSuffix": ""
                };
	
	$(document).ready(function(){
		$('.lang_eng').click(function(){
		    lang = "english";
			$('.japanese').hide();
			$('.english').show();
			$.datepicker.setDefaults($.datepicker.regional['en']);
			$( "#datepicker-13" ).datepicker( "destroy" );
			$( "#datepicker-13" ).datepicker({
                  onSelect: function(selected,evnt) {
                     updateDate(selected);
                },
                altFormat: "dd-mm-yy",
                dateFormat: "dd-mm-yy"
              });
		})
		$('.lang_jap').click(function(){
		    lang = "japanese";
			$('.english').hide();
			$('.japanese').show();
			$('#language').val('japanese');
			$('#Source option:eq(0)').text('英語');
			$('#Target option:eq(0)').text('英語');
			$.datepicker.setDefaults($.datepicker.regional['ja']);
			$( "#datepicker-13" ).datepicker( "destroy" );
			$( "#datepicker-13" ).datepicker({
                  onSelect: function(selected,evnt) {
                     updateDate(selected);
                },
                altFormat: "dd-mm-yy",
                dateFormat: "dd-mm-yy"
              });
		})
		$('#customFile').on('change',function(){
			var file = $('#customFile').val().match(/[^\\/]*$/)[0];;
			$('.custom-file-label').text(file);
		})
        var language = "<?php if(isset($_POST['wp-submit'])){ echo $language; }?>";
		if(language == "japanese")
		{
			$('.english').hide();
			$('.japanese').show();
		}
	})
	
	<!--function formatDate(date, format){-->
	<!--    format.replace('mm', date.getMonth()+1)-->
	<!--          .replace('dd', date.getDate())-->
	<!--          .replace('yy', date.getYear())-->
	<!--   return format-->
	<!--}-->
	
	function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

     if (month.length < 2) 
        month = '0' + month;
     if (day.length < 2) 
        day = '0' + day;
     return [day, month, year].join('-');
   
   }

  $( "#datepicker-13" ).datepicker({
        
      onSelect: function(selected,evnt) {
          
        var ToDate = new Date();
        
         today=formatDate(ToDate);
        
        
        <!--var today = formatDate(ToDate, "dd-mm-yy")-->
        <!--alert (today)-->
        if (selected <= today) {
          alert("The date must be greater than or equal to today's date");
          document.getElementById("date").value = ""
          return false;
        }
        updateDate(selected);
        return true;
    },
    altFormat: "dd-mm-yy",
    dateFormat: "dd-mm-yy"
   
   });
   
  $(function() {
    $( "#datepicker-13" ).datepicker({ maxDate: new Date()});
 })
</script>



<script type = "text/javascript">
         // Form validation code will come here.
      function validate() {
          msg = "";
         if( document.myForm.name.value == "" ) {
            if(lang == "japanese"){
                msg = "有効なお名前を入力してください。";
            }else{
                msg = "Please enter a valid Name..";
            }
            document.getElementById("namea").innerHTML = msg;
            document.myForm.name.focus() ;
            return false;
         }
         
         if( document.myForm.name.value.length < 2 ) {
             if(lang == "japanese"){
                msg = "有効なお名前を入力してください。";
            }else{
                msg = "Please enter a valid Name..";
            }
            document.getElementById("namea").innerHTML = msg;
            document.myForm.name.focus() ;
            return false;
          }
         
         
         
        if( document.myForm.phone.value == "" ) {
         if(lang == "japanese"){
                msg = "有効なお名前を入力してください。";
            }else{
                msg = "Please enter a valid phone number.";
            }
        document.getElementById("phonea").innerHTML = msg;
        document.myForm.phone.focus() ;
        return false;
        }
        
        if( document.myForm.phone.value.length < 7 ) {
            
         if(lang == "japanese"){
                msg = "有効な電話番号を入力してください。";
            }else{
                msg = "Please enter a valid phone number.";
            }
        document.getElementById("phonea").innerHTML = "Please enter a valid phone number.";
        document.myForm.phone.focus() ;
        return false;
        }
        
         if( document.myForm.email.value == "" ) {
            if(lang == "japanese"){
                msg = "有効なEメールアドレスを入力してください。";
            }else{
                msg = "Please enter a valid Email address.";
            }
            document.getElementById("emaila").innerHTML = msg;
            document.myForm.email.focus() ;
            return false;
         }
         if( !validateEmail(document.myForm.email.value) ) {
            if(lang == "japanese"){
                msg = "有効なEメールアドレスを入力してください。";
            }else{
                msg = "Please enter a valid Email address.";
            }
            document.getElementById("emaila").innerHTML =msg;
            document.myForm.email.focus() ;
            return false;
         }
         
          if( document.myForm.customfile.value == "" ) {
            
            if(lang == "japanese"){
                msg = "ファイルを入力してください。";
            }else{
                msg = "Please Enter Your File.";
            }
            document.getElementById("customfilea").innerHTML = msg;
            document.myForm.customfile.focus() ;
            return false;
         }
         
         if( document.myForm.message.value == "" ) {
            
            if(lang == "japanese"){
                msg = "メッセージを入力してください。";
            }else{
                msg = "Please input your message.";
            }
            document.getElementById("messagea").innerHTML = msg;
            document.myForm.message.focus() ;
            return false;
         }
         
         if( document.myForm.date.value == "" ) {
             
             
            if(lang == "japanese"){
                msg = "有効な納期予定日を指定してください。";
            }else{
                msg = "Please select a valid delivery date..";
            }
            document.getElementById("datea").innerHTML = msg;
            document.myForm.date.focus() ;
            return false;
         }
        
      
        

         
        if (grecaptcha.getResponse() == ""){
           alert("reCAPTCHA is not valid. Please try again!");
           return false;
         }
     
        
      }
      function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
      }
      
      

  </script>
    <script>
        $(document).ready(function(){
            $('.lang_jap').click(function(){
                $('.eng-fst').attr("checked","unchecked");
                $('.jap-fst').attr("checked","checked");
                $(':selected').attr("selected","unselected");
                $("[value=英語]").attr("selected","selected");
            })
        })
        
    </script>

  
     
          
        
</body>
</html>

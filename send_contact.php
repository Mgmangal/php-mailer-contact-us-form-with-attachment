<?php include('config/config.php');  ?>
<?php
if(isset($_POST['wp-submit']))
{ 
 $targetDir = "uploads/";
 $uploadedFile = "";
 $fileName = basename($_FILES["customfile"]["name"]);
 $targetFilePath = $targetDir . $fileName;
 $customfile = $_FILES['customfile']['name'];
 $file_tmp1 = $_FILES['customfile']['tmp_name'];
 
 if(move_uploaded_file($file_tmp1,$targetFilePath)){
    $uploadedFile = $targetFilePath;
 }else{
    $uploadStatus = 0;
    $statusMsg = "Sorry, there was an error uploading your file.";
    header('location: index.php');
    exit();
 }
 // print_r($_POST);
 //  exit();

$language=$mysqli -> real_escape_string($_POST['language']);
$services=$mysqli -> real_escape_string($_POST['services']);
$source=$mysqli -> real_escape_string($_POST['source']);
$target=$mysqli -> real_escape_string($_POST['target']);
$name=$mysqli -> real_escape_string($_POST['name']);
$phone=$mysqli -> real_escape_string($_POST['phone']);
$email=$mysqli -> real_escape_string($_POST['email']);
$message=$mysqli -> real_escape_string($_POST['message']);
$date=$mysqli -> real_escape_string($_POST['date']);


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
 $sql="INSERT INTO `contact` (`language`,`services`,`source`,`target`,`name`,`phone`,`email`,`customfile`,`message`,`date`)
        VALUES ('".$language."','".$services."','".$source."','".$target."','".$name."','".$phone."','".$email."','".$customfile."','".$message."','".$date."')";
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

  
  // print_r($result);
  // exit();
  if($result==true){
   //echo "your data insert successfully.";

      $subject1='Enquiry for Component';
    $subject2="Enquiry confirmation for Component";
                                    
   $message = // contents of report in $message
        "<div style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Sir,<br /><br />Kindly check the enquiry generated by user for Components .<br /><br>
                      <h4>name : $name </h4>
                      <h4>Email : $email</h4>
                    <table width='100%' cellspacing='0' cellpadding='5' border='1' >
                <thead>
                    <tr>
                        <th> Language.</th>
                        <th> Services</th>
                        <th> Source</th>
                        <th> Target</th>
                        <th> Phone </th>
                        <th> Message</th>
                        <th> Delivery Deadline</th>
                    </tr>    
                </thead>
                <tbody>
        
                        <tr style='border:1px solid #111'>
                            <td> $language </td> 
                            <td> $services </td>
                            <td> $source </td>
                            <td> $target </td>
                            <td> $phone </td>
                            <td> $message </td>
                            <td> $date</td>
                       </tr>
                      
            </tbody>
            </table>
          </div>"; 
          
   $emails= 'test@raamjaap.com'; 


        // echo $body2;die();
        //   echo $message;die();

    require 'class/class.phpmailer.php';
    $mail = new PHPMailer;
    $mail->IsSMTP();                //Sets Mailer to send message using SMTP
    $mail->Host = 'mail.raamjaap.com';   //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = 587;                //Sets the default SMTP server port
    $mail->SMTPAuth = true;             //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'test@raamjaap.com';         //Sets SMTP username
    $mail->Password = 'V6bET@wvv5bU';         //Sets SMTP password
    $mail->SMTPSecure = 'tls';              //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->From = $emails;          //Sets the From email address for the message
    $mail->FromName = $_POST["name"];       //Sets the From name of the message
    $mail->setFrom('test@raamjaap.com');
    $mail->addAddress($email, 'User');
    $mail->AddCC('sales@honyakuservices.com');
    $mail->CharSet="UTF-8";
     // Attachments
    $mail->addAttachment($uploadedFile);         // Add attachments

    //$email->AddAttachment( $file_to_attach , 'http://test.raamjaap.com/uploads/$customfile' );
    $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);              //Sets message type to HTML       
    $mail->Subject = $subject1;       //Sets the Subject of the message
    $mail->Body = $message;       //An HTML or plain text message body
   
    
    if($mail->Send())               
        {  
             
            session_start();
         	if($language === "english")
			{
			  $_SESSION['message']['contact'] = 'Thank you, your information has been sent!';
			}else{
			  $_SESSION['message']['contact'] = 'ありがとう、あなたの情報が送られました！';
			}
           
             header('location:index.php');
          
        }
        header('location:index.php');
      }
  
  else
  {
  	echo "you are not regiter";
  }
}

?>
<?php 
include "connection.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\PHPMailer\src\Exception.php';

  
    require 'C:\PHPMailer\src\PHPMailer.php';

  
    require 'C:\PHPMailer\src\SMTP.php';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_SESSION['emailHost'];
    $mail->SMTPAuth = true;
    
    $mail->Username =$_SESSION['emailUserID'];
    $mail->Password =$_SESSION['emailPassword'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = $_SESSION['emailPort'];
   
    $mail->From = $_SESSION['emailUserID'];
    $mail->FromName = "Fotopia";

     $mail->addAddress($_REQUEST['email']);

    $mail->addReplyTo($_SESSION['emailUserID'], "Reply");

    $mail->isHTML(true);

    $mail->Subject = "Testing email";
    $mail->Body = "Testing email";
    
    try {
        $mail->send();
     
    } catch (Exception $e) {
      echo $e->getMessage();
        echo "Mailer Error: " . $mail->ErrorInfo;
    }



?>
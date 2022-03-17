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
	
	
	   $date               = '20220326';
    $startTime          = '1500';
    $endTime            = '1530';
    $subject            = 'Fotopia Live discussion';
    $desc               = 'Lets connect to discuss!';
$location = 'meeting room';
$organizer          = 'Hi Bharath';

    $organizer_email    = 'admin@fotopia.no';   
    $participant_name_1 = 'Bharath';
    $participant_email_1= @$_REQUEST['email'];
	
	 $text = "BEGIN:VCALENDAR\r\n
    VERSION:2.0\r\n
    PRODID:-//Deathstar-mailer//theforce/NONSGML v1.0//EN\r\n
    METHOD:REQUEST\r\n
    BEGIN:VEVENT\r\n
    UID:" . md5(uniqid(mt_rand(), true)) . "example.com\r\n
    DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z\r\n
    DTSTART:".$date."T".$startTime."00Z\r\n
    DTEND:".$date."T".$endTime."00Z\r\n
    SUMMARY:".$subject."\r\n
    ORGANIZER;CN=".$organizer.":mailto:".$organizer_email."\r\n
    LOCATION:".$location."\r\n
    DESCRIPTION:".$desc."\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN".$participant_name_1.";X-NUM-GUESTS=0:MAILTO:".$participant_email_1."\r\n
    END:VEVENT\r\n
    END:VCALENDAR\r\n";
	
	$headers = "From: Sender\n";
$headers .= 'Content-Type:text/calendar; Content-Disposition: inline; charset=utf-8;\r\n';
$headers .= "Content-Type: text/plain;charset=\"utf-8\"\r\n"; #EDIT: TYPO
$mail->Subject = $subject;
$mail->Body = $desc; 
$mail->AltBody = $text; // in your case once more the $text string
$mail->Ical = $text;

    $mail->Subject = "Fotopia Meeting";
    
    try {
        $mail->send();
     
    } catch (Exception $e) {
      echo $e->getMessage();
        echo "Mailer Error: " . $mail->ErrorInfo;
    }



?>
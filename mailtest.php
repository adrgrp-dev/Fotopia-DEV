<?php 
require 'PHPMailerAutoload.php';


$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'xxx.xx.com';                       // Specify main and backup server
$mail->SetFrom('xx@xx.com', 'xx xxx');
$mail->SMTPAuth = false;                               // Enable SMTP authentication
$mail->Username = '';                   // SMTP username
$mail->Password = '';               // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 25;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->addAddress('kelvinfoodumb@gmail.com');  // Add a recipient
//$mail->addCC($manlv4);
//$mail->addBCC('kelvinfoodumb@gmail.com');
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML

$location           = "Stardestroyer-013";
    $date               = '20151216';
    $startTime          = '0800';
    $endTime            = '0900';
    $subject            = 'Millennium Falcon';
    $desc               = 'This email is a reminder for you. Please accept!';

$organizer          = 'Darth Vader';

    $organizer_email    = 'hxxr@xx.com';   
    $participant_name_1 = 'Kelvin';
    $participant_email_1= 'xx@xx.com';

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
$mail->Ical = $text; // ical format, in your case $text string


if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
?>
?>



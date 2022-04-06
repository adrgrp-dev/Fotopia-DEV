<?php 


	function sendIcalEvent($from_name, $from_address, $to_name, $to_address, $startTime, $endTime,     
$subject, $description, $location,$method,$GID)
{
$domain="fotopia.no";

 $mime_boundary = "----Meeting Booking----".MD5(TIME());

    $headers = "From: ".$from_name." <".$from_address.">\n";
    $headers .= "Reply-To: ".$from_name." <".$from_address.">\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
    $headers .= "Content-class: urn:content-classes:calendarmessage\n";

    //Create Email Body (HTML)
    $message = "--$mime_boundary\r\n";
        $ical = 'BEGIN:VCALENDAR' . "\r\n" .
    'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
    'VERSION:2.0' . "\r\n" .
    'METHOD:'.$method . "\r\n" .
    'BEGIN:VTIMEZONE' . "\r\n" .
    'TZID:Eastern Time' . "\r\n" .
    'BEGIN:STANDARD' . "\r\n" .
    'DTSTART:20091101T020000' . "\r\n" .
    'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
    'TZOFFSETFROM:+0530' . "\r\n" .
    'TZOFFSETTO:+0530' . "\r\n" .
    'TZNAME:GMT' . "\r\n" .
    'END:STANDARD' . "\r\n" .
    'BEGIN:DAYLIGHT' . "\r\n" .
    'DTSTART:20090301T020000' . "\r\n" .
    'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
    'TZOFFSETFROM:+0530' . "\r\n" .
    'TZOFFSETTO:+0530' . "\r\n" .
    'TZNAME:GMT' . "\r\n" .
    'END:DAYLIGHT' . "\r\n" .
    'END:VTIMEZONE' . "\r\n" .  
    'BEGIN:VEVENT' . "\r\n" .
    'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n";

	 $to_addressIs=explode(",",$to_address);
	 $addressCount=count($to_addressIs);
	 for($i=0;$i<$addressCount;$i++)
	 {	 
    $to_nameIs=explode("--",$to_addressIs[$i]);
	 $ical.='ATTENDEE;CN='.$to_nameIs[0].';ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_nameIs[1]."\r\n";
	 }
    $ical.='LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
    'UID:'.$GID."\r\n" .
    'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
    'DTSTART;TZID="Eastern Time":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
    'DTEND;TZID="Eastern Time":'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
    'TRANSP:OPAQUE'. "\r\n" .
    'SEQUENCE:1'. "\r\n" .
    'SUMMARY:' . $subject . "\r\n" .
    'LOCATION:' . $location . "\r\n" .
    'CLASS:PUBLIC'. "\r\n" .
    'PRIORITY:5'. "\r\n" .
    'BEGIN:VALARM' . "\r\n" .
    'TRIGGER:-PT15M' . "\r\n" .
    'ACTION:DISPLAY' . "\r\n" .
    'DESCRIPTION:Reminder' . "\r\n" .
    'END:VALARM' . "\r\n" .
    'END:VEVENT'. "\r\n" .
    'END:VCALENDAR'. "\r\n";
    $message .= 'Content-Type: text/calendar;name="meeting.ics";method='.$method."\n";
    $message .= "Content-Transfer-Encoding: 8bit\n\n";
    $message .= $ical;

// echo "<pre>".$ical; exit;
return $ical;


//$mailsent = mail($to_address, $subject, $message, $headers);

//return ($mailsent)?(true):(false);
}




?>
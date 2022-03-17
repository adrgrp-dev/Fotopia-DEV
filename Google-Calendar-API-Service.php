<?php 
include "connection.php";
session_start();
//error_reporting(E_ALL);
$APIkey='AIzaSyCTPPWUkcYXU_s0Qelncs3GKrKW_kQDUIs';
//$CalId='bharathwaj.v@adrgrp.com';

//selinux command for curl support is below :
//setsebool -P httpd_can_network_connect on

//print_r($_SERVER);
$calendarId = $_SESSION["loggedin_email"];
$photgrapher_id=$_SESSION["loggedin_id"];
$service_url = "https://www.googleapis.com/calendar/v3/calendars/calendarId/events/?key=".$APIkey."&calendarId=".$calendarId."&orderBy=startTime&singleEvents=true&timeMin=".date('Y-m-d')."T03:00:00-00:00&maxResults=100";
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
//echo 'response ok!';
echo  "<pre>";
print_r($decoded);
echo  "</pre>";

$events = $decoded->items;
mysqli_query($con,"delete from appointments where photographer_id='$photgrapher_id' and gmail_cal_event=1");
    foreach ($events as $event) {
        $start = $event->start->dateTime;
		 $end = $event->end->dateTime;
        /*if (empty($start)) {
            $start = $event->start->date;
        }  */
		//echo $start;
      //  printf("%s (%s)\n", $event->getSummary(), $start);
	  mysqli_query($con,"insert into appointments (photographer_id,from_datetime,to_datetime,gmail_cal_event)values('$photgrapher_id','$start','$end',1)") or die(mysqli_error($con));
	 
    }



?>
<?php 
header('Access-Control-Allow-Origin: *');


$url='https://maps.googleapis.com/maps/api/place/queryautocomplete/json?input=Lindheimvegen 6, 6900,&language=en&key=AIzaSyCTPPWUkcYXU_s0Qelncs3GKrKW_kQDUIs';
$url=str_replace(" ","+",$url);
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

// Get URL content
$lines_string=curl_exec($ch);
// close handle to release resources
curl_close($ch);
//output, you can also save it locally on the server
echo "<pre>";
print_r($lines_string);
echo "</pre>";
 ?>
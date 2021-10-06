<?php 

$array = str_split("512990856326512987150086512990852250", 12);


for($i=0;$i<count($array);$i++)
{
echo $array[$i]."<br>";
}

echo implode(",",$array);
echo "<br>";

$string="   512990                8563265129871 5008651             2990    852250      ";
$stringResult = preg_replace('/\s+/', '', $string);
echo $stringResult;
?>

<table class="table-stripped" cellpadding="10" cellspacing="10" width="100%"><thead><tr style="font-weight:bold;font-size:14px;"><td style="padding:5px;"><span adr_trans="label_product_name">Product Name</span></td><td style="padding:5px"><span adr_trans="label_timeline"> Timeline</span></td><td style="padding:5px" rowspan="2"><span adr_trans="label_product_cost">Product Cost</span></td></tr></thead><tbody><tr><td style="padding:5px;font-size:14px;">30 STANDARD PHOTOS</td><td style="padding:5px">1 hour</td><td style="padding:5px">200</td></tr><tr><td style="padding:5px">40 STANDARD PHOTOS</td><td style="padding:5px">2 hours</td><td style="padding:5px">250</td></tr><tr><td style="padding:5px">DRONE SHOOT</td><td style="padding:5px">2 hours</td><td style="padding:5px">300</td></tr><tr><td style="padding:5px">FLOOR PLAN</td><td style="padding:5px">1 hour</td><td style="padding:5px">100</td></tr></tbody></table>
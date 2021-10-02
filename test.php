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
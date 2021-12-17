<?php 

$str='./temp/order_80';
function unlinkr($dir, $pattern = "*") {
    // find all files and folders matching pattern
    $files = glob($dir . "/$pattern"); 

    //interate thorugh the files and folders
    foreach($files as $file){ 
    //if it is a directory then re-call unlinkr function to delete files inside this directory     
        if (is_dir($file) and !in_array($file, array('..', '.')))  {
            echo "<p>opening directory $file </p>";
            unlinkr($file, $pattern);
            //remove the directory itself
            echo "<p> deleting directory $file </p>";
            rmdir($file);
        } else if(is_file($file) and ($file != __FILE__)) {
            // make sure you don't delete the current script
            echo "<p>deleting file $file </p>";
            unlink($file); 
        }
    }
}
unlinkr($str);
exit;
$fi = new FilesystemIterator("./raw_images/order_80", FilesystemIterator::SKIP_DOTS);

$fileCount = 0;
foreach ($fi as $f) {
    if ($f->isFile()) {
        $fileCount++;
    }
}
echo("There were %d Files".$fileCount);
exit;
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
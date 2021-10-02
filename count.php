<?php
$id_url=$_REQUEST['id'];
$imagesDirectory = "./raw_images/order_".$id_url;

if (is_dir($imagesDirectory))
{
 $opendirectory = opendir($imagesDirectory);
while (($image = readdir($opendirectory)) !== false)
{

if(($image == '.') || ($image == '..'))
{
  continue;
}
$cnt++;

}
    echo "0";
}
else
{
 $a=5;
    echo "1";
}
?>

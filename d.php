<?php
$hour=date('H:i:s');

$h2=strtotime($hour);
echo $h2."<br>";
$h=date("H",$h2)-1;
if ($h=="-1")
    $h='23';
if ($h=="0")
    $h='24';
echo $h;
?>

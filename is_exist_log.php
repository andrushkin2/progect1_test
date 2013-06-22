<?php
require("config.php");

$login=escape($_POST['l']);
$org=escape($_POST['o']);
//if login exists
$date=query("select * from admin where login='$login'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['l'] = false;
else
    $return['l'] = true;
//if org exists
$date=query("select * from admin where organization='$org'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['o'] = false;
else
    $return['o'] = true;


echo json_encode($return);
?>

<?php
require("config.php");

$login=$_POST['l'];
$pass=$_POST['p'];

$date=mysql_query("select * from admin where login='$login' and pass='$pass'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['msg'] = false;
else
    $return['msg'] = true;
echo json_encode($return);
?>

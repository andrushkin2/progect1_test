<?php
require("config.php");
$login=$_POST['l'];
$pass=$_POST['p'];
$code=$_POST['e'];
$date=mysql_query("select login,trening_code,pass from admin where login='$login' and pass='$pass' and trening_code='$code'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['msg'] = true;
else{
    $return['msg'] = false;
}
echo json_encode($return);
?>

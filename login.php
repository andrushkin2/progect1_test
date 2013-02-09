<?php
$login=$_POST['l'];
$pass=$_POST['p'];
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());
$date=mysql_query("select * from admin where login='$login' and pass='$pass'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['msg'] = false;
else
    $return['msg'] = true;
echo json_encode($return);
?>

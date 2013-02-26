<?php
$login=$_POST['l'];
$pass=$_POST['p'];
$code=$_POST['e'];
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());
$date=mysql_query("select login,trening_code,pass from admin where login='$login' and pass='$pass' and trening_code='$code'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['msg'] = true;
else{
    $return['msg'] = false;
}
echo json_encode($return);
?>

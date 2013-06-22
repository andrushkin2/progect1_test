<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Изменение времени</title>
</head>
<?php
require("config.php");
	$hours=$_POST['hours'];
	$minutes=$_POST['minutes'];
	$num=$_POST['num'];
	$times=$hours.":".$minutes;
	mysql_query("UPDATE admin set time='$times' where name='$num'");//tut
	$tim1=mysql_query("select time from admin where name='$num'");//tut
	$row=mysql_fetch_array($tim1);
	$t=explode(":",$row['time']);
	echo "$t[0] $t[1]";
	echo "<form method=GET action=admin_menu.php><input type=hidden name=num value=$num><input type=submit id=1 value=Назад style=font-size:22px></form>";
	echo "<script>document.getElementById(1).click()</script>";
?>
</html>

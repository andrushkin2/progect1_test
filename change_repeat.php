<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Изменение времени</title>
</head>
<?php
	$val=$_POST['val'];
	$num=$_POST['num'];
	mysql_connect('localhost','saltoext_salto','5700');
	mysql_select_db('saltoext_salto1') or die(mysql_error());
	//mysql_query("UPDATE admin set time='$times' where name='$num'");//tut
	$date=mysql_query("select year,month,day from admin where name='$num'");//tut
	$row=mysql_fetch_array($date);
	//$t=explode(":",$row['time']);
	//echo "$row[month]$row[day]$row[year]";
	if ($val==0){
		$t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']));
		if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	if ($val==1){
		$t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+7,$row['year']));
		if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	if ($val==2){
		$t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+14,$row['year']));
		if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	if ($val==3){
		$t = date("Y-m-d",mktime('0','0','0',$row['month']+1,$row['day'],$row['year']));
		if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	mysql_query("UPDATE admin set rep='$val' where name='$num'");
	echo "<form method=GET action=admin_menu.php><input type=hidden name=num value=$num><input type=submit id=1 value=Назад style=font-size:22px></form>";
	echo "<script>document.getElementById(1).click()</script>";
?>
</html>

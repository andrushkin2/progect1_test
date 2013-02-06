<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Изменение даты</title>
</head>
<?php
	$dat=$_POST['date'];
	$month=$_POST['month'];
	$year=$_POST['year'];
	$num=$_POST['num'];
	mysql_connect('localhost','saltoext_salto','5700');
	mysql_select_db('saltoext_salto1') or die(mysql_error());
	mysql_query("UPDATE admin set day ='$dat',month='$month',year='$year' where name='$num'");//tut
	$tim=mysql_query("select rep from admin where name='$num'");
	$row=mysql_fetch_array($tim);
	if ($row['rep']==0){
		$t1 = date("Y-m-d",mktime('0','0','0',$month,$dat,$year));
		if (mysql_query("UPDATE admin set nextDate='$t1' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	if ($row['rep']==1){
		$t1 = date("Y-m-d",mktime('0','0','0',$month,$dat+7,$year));
		if (mysql_query("UPDATE admin set nextDate='$t1' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	if ($row['rep']==2){
		$t1 = date("Y-m-d",mktime('0','0','0',$month,$dat+14,$year));
		if (mysql_query("UPDATE admin set nextDate='$t1' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	if ($row['rep']==3){
		$t1 = date("Y-m-d",mktime('0','0','0',$month+1,$dat,$year));
		if (mysql_query("UPDATE admin set nextDate='$t1' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
	echo "<form method=GET action=admin_menu.php><input type=hidden name=num value=$num><input type=submit id=1 value=Назад style=font-size:22px></form>";
?>
</html>
<script type="text/javascript">
	document.getElementById(1).click();
</script>

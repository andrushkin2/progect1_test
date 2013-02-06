<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Разблокировка номера</title>
<?php
	$all="375";
	$kd=$_POST['kode'];
	$phone=$_POST['mPhone'];
	$num=$_POST['num'];
	$allPhone=$all.$kd.$phone;
	mysql_connect('localhost','saltoext_salto','5700');
	mysql_select_db('saltoext_salto1') or die(mysql_error());
	$phones=mysql_query("select phone from dBase where num='$num'");//tut
	$flag=true;
	for($i=0;$i<mysql_num_rows($phones);$i++)
	{
		if (mysql_result($phones,$i,0)==$allPhone){
			$flag=false;
			$avalible="select * from dBase where phone='$allPhone' and num='$num'";//tut
			$res=mysql_query($avalible);
			$row=mysql_fetch_array($res);
			if ($row['acces']==1){
				mysql_query("UPDATE dBase set acces ='0' where phone='$allPhone' and num='$num'");//tut
				echo "<b style=font-size:22px>Блокировка с номера успешно снята</b>";
			}
			if ($row['acces']==0){
				echo "<b style=font-size:22px>Пользователь с данным номером не заблокирован</b>";
			}
		}
	}
	if($flag==true)
		echo "<b style=font-size:22px>Пользователся с данным номером нет в базе</b>";
	echo "<br><br><form method=GET action=admin_menu.php><input type=hidden name=num value=$num><input type=submit value=Назад style=font-size:22px></form>"
?>
</html>

<?php
	$kol=$_POST['kol'];
	$num=$_POST['num'];
	mysql_connect('localhost','saltoext_salto','5700');
	mysql_select_db('saltoext_salto1') or die(mysql_error());
	mysql_query("UPDATE admin set maxCol ='$kol' where name='$num'");//tut
	echo "<form method=GET action=admin_menu.php><input type=hidden name=num value=$num><input type=submit id=1 value=Назад style=font-size:22px></form>";
?>
<script type="text/javascript">
	document.getElementById(1).click();
</script>

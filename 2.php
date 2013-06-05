<?php
require('config.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Тренировка</title>
</head>
<body>
Тренировка:	<select name='num'>
    <?php
    $date=query("select * from admin where login='$login' and pass='$pass'");//tut
    while ($row = fetch_array($date, MYSQL_ASSOC)){
        $t=explode(':',$row['Time']);
        echo "<option value='$row[name]'>$row[day]-$row[month]-$row[year] $t[0]:$t[1]</option>";
    }
    ?>
</select>
Пароль:	<input type="text" id="2"><br>
<a id="5" href="admin_trening.php" id="3"><input type="button" id="4" style="visibility:hidden"></a>
<input type="button" value="Вход" onClick="check();" style="font-size:18px">
</body>
<script type="text/javascript">
	function check(){
		if(document.getElementById(1).value=='admin')
			if(document.getElementById(2).value=='admin'){
				document.getElementById(5).href="admin_trening.php?num=2";
				document.getElementById(4).click();
			}
		if(document.getElementById(1).value=='admine')
			if(document.getElementById(2).value=='admine'){
				document.getElementById(5).href="admin_menu1.php?num=2";
				document.getElementById(4).click();
			}		
	}
</script>
</html>

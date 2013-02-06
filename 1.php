<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Вход на тренировку</title>
</head>
<body>
Логин:	<input type="text" id="1"><br>
Пароль:	<input type="text" id="2"><br>
<a id="5" href="admin_trening.php" id="3"><input type="button" id="4" style="visibility:hidden"></a>
<input type="button" value="Вход" onClick="check();" style="font-size:18px">
</body>
<script type="text/javascript">
	function check(){
		if(document.getElementById(1).value=='admin')
			if(document.getElementById(2).value=='admin'){
				document.getElementById(5).href="admin_trening.php?num=1&sort=fam&fl=asc";
				document.getElementById(4).click();
			}
		if(document.getElementById(1).value=='admine')
			if(document.getElementById(2).value=='admine'){
				document.getElementById(5).href="admin_menu1.php?num=1";
				document.getElementById(4).click();
			}		
	}
</script>
</html>

﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Администрирование</title>
</head>
<body>
Логин:	<input type="text" id="1"><br>
Пароль:	<input type="text" id="2"><br>
<a href="admin_menu.php" id="3"><input type="button" id="4" style="visibility:hidden"></a>
<input type="button" value="Вход" onClick="check();" style="font-size:18px">
</body>
<script type="text/javascript">
	function check(){
		if(document.getElementById(1).value=='admine')
			if(document.getElementById(2).value=='admine')
				document.getElementById(4).click();
	}
</script>
</html>

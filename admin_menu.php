<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Администрирование</title>
</head>

<body>
<table align="дуае" border="2">
<tbody>
<tr>
	<td>
    	Установить количество мест:
    </td>
    <td>
		<form name="form1" action="change_abon.php" method="POST">
		<?php
			$num=$_GET['num'];
			echo "<input type=hidden name=num value=$num>";
        ?>
    	<input type="text" id="1" size="3" name="kol" style="font-size:16px"/><input type="button" id="2" onClick="abonim();" value="Готово"/>
    	</form>
    </td>
</tr>
<tr height="30px"></tr>
<tr>
	<td>
		Снять блокировку с номера:
	</td>
	<td>
		<form  method="POST" action="access_phone.php" name="forma" onSubmit="return false">
		<?php
			$num=$_GET['num'];
			echo "<input type=hidden name=num value=$num>";
        ?>
		<g style="font-size:18px;font-weight:bold">+375</g>
		<select name="kod" id="9" style="font-size:20px">
			<option value="25" >25</option>
			<option value="29" >29</option>
			<option value="33">33</option>
			<option value="44">44</option>
			<option selected></option>
		</select>
		<input type="hidden" id="8" name="kode" value="">
		<input type="text" id="4" name="Phone"  size="7" maxlength="7" style="font-size:18px">
		<input type="button" id="5" onclick="cheked_mPhone(4)" value="Далее" style="font-size:22px">
		<p id="6" style="visibility:hidden;font-size:18px">Неверно введен номер.Проверьте правильность ввода!</p>
		<input type="hidden" id="13" name="kode" value="">
		<input type="hidden" id="14" name="mPhone" value="">
		</form>
	</td>
</tr>
<tr height="30px"></tr>
<tr>
	<td>
		Указать дату проведения занятия
	</td>
	<td>
		<form method="POST" action="change_date.php" name="form2" onSubmit="return false">
		<?php
			$num=$_GET['num'];
			echo "<input type=hidden name=num value=$num>";
        ?>
		Число<input type="text" border="1" size="1" maxlength="2" name="date" id="10"><br>
		Месяц<input type="text" border="1" size="1" maxlength="2" name="month" id="11"><br>
		Год<input type="text" border="1" size="3" maxlength="4" name="year" id="12"><br>
		</form>
		<input type="button" value="Применить" onClick="check_date()">
	</td>
</tr>
<tr height="30px"></tr>
<tr>
	<td>
		Указать время проведения занятия
	</td>
	<td>
		<form method="POST" action="change_time.php" name="form3" onSubmit="return false">
		<?php
			$num=$_GET['num'];
			echo "<input type=hidden name=num value=$num>";
        ?>
			Часы<input type="text" border="1" size="1" maxlength="2" name="hours" id="15">
			Минуты<input type="text" border="1"size="1"  maxlength="2" name="minutes" id="16">
		</form>
		<input type="button" value="Применить" onClick="check_time()">
	</td>
</tr>
<tr height="30px"></tr>
<tr>
	<td>
		Периодичность занятия
	</td>
	<td>
		<form method="POST" action="change_repeat.php" name="form10" onSubmit="return false">
		<?php
			$num=$_GET['num'];
			echo "<input type=hidden name=num value=$num>";
        ?>
		<select name="repeat" style="font-size:20px">
			<option value="0" selected>Один раз</option>
			<option value="1">Раз в неделю</option>
			<option value="2" >Через неделю</option>
			<option value="3">Раз в месяц</option>
		</select>
		<input type="hidden" id="99" name="val">
		</form>
		<input type="button" value="Применить" onClick="check_rep()">
	</td>
</tr>
</tbody>
</table>
</body>
</html>
<script type="text/javascript">
function check_rep(){
	$selectIndex=document.forms["form10"].repeat.selectedIndex;
			document.getElementById(99).value=document.forms["form10"].repeat.options[$selectIndex].value;
	document.forms['form10'].submit();
}
function check_time(){
	document.getElementById(15).style.borderColor="white";
	document.getElementById(16).style.borderColor="white";
	$flag=true;
	if ((document.getElementById(15).value < 0 || document.getElementById(15).value > 23) || document.getElementById(15).value==""){
		$flag=false;
		document.getElementById(15).style.borderColor="red";
	}
	if (document.getElementById(16).value=="" || (document.getElementById(16).value < "0" || document.getElementById(16).value > "59")){
		$flag=false;
		document.getElementById(16).style.borderColor="red";
	}
	if($flag)
		document.forms['form3'].submit();
}
function check_date(){
	$flag=true;
	if (document.getElementById(10).value==""||document.getElementById(10).value=="0"){
		$flag=false;
		document.getElementById(10).style.borderColor="red";
	}
	if (document.getElementById(11).value==""||document.getElementById(11).value=="0"){
		$flag=false;
		document.getElementById(11).style.borderColor="red";
	}
	if (document.getElementById(12).value==""||document.getElementById(12).value=="0"||document.getElementById(12).length<4){
		$flag=false;
		document.getElementById(12).style.borderColor="red";
	}
	if ($flag)
		document.forms['form2'].submit();
}

function abonim(){
	if (document.getElementById(1).value!='')
		document.forms['form1'].submit();
}


	function kod(id){
		var e=document.getElementById(id);
		$selectIndex=document.forms["forma"].kod.selectedIndex;
			document.getElementById(id).value=document.forms["forma"].kod.options[$selectIndex].text;
	}
	function cheked_mPhone(id){
		var c=document.getElementById(6);
		var d=document.getElementById(5);
		c.style.visibility='hidden';
		var e=document.getElementById(id);
		$val=e.value;
		$flag=true;
		if($val[0]==0 || e.value.length<7){
			c.style.visibility='visible';
			$flag=false;
			return;
		}
		for($i=0;$i<=e.value.length-1;$i++)
			if($val[$i]!=1)
				if($val[$i]!=2)
					if($val[$i]!=3)
						if($val[$i]!=4)
							if($val[$i]!=5)
								if($val[$i]!=6)
									if($val[$i]!=7)
										if($val[$i]!=8)
											if($val[$i]!=9)
												if($val[$i]!=0)
													if($val[$i]==' '){
												c.style.visibility='visible';
												$flag=false;
												return;
											}
		if(c.style.visibility=='hidden'){
			d.style.visibility='visible';
			kod(13);
		}
		if (document.getElementById(13).value==''){
			$falg=false;
			c.style.visibility='visible';
			document.getElementById(9).style.borderColor='red';
			return ;
		}
		if ($flag){
			document.getElementById(14).value=$val;
			document.forms['forma'].submit();
		}
	}
</script>

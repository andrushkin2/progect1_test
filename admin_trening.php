﻿<?php
require('config.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Тренировка</title>
</head>
<body>
	<form action="checkbox-form.php" method="post" name="form1">
	<?php
		$num=$_POST['num'];
        $login=$_POST['login'];
        $pass=$_POST['pass'];
        if ($login=="" || $pass=="")
            echo "<form method='GET' action='1.php' name='f'>
                        <input type='submit' id='1' style='font-size:22px;visibility: hidden'></form>
                        <script>document.getElementById(1).click();</script>";
		echo "<input type='hidden' name='num' value='$num'>";
        echo "<input type='hidden' name='login' value='$login'>";
        echo "<input type='hidden' name='pass' value='$pass'>";
	?>
	<table align="left">
    <tbody>
    <tr><td>№</td><td><g style="cursor:pointer" onClick="sortt('fam','asc')">Фамилия</g></td><td>Имя</td><td>Год</td><td>Номер телефона</td><td><g style="cursor:pointer" onClick="sortt('avalible','desc')">Пришел</g></td><td>Не пришел</td></tr>
	<?php
		$num=$_POST['num'];
		$sort=$_POST['sort'];
		$fl=$_POST['fl'];
		$avalible="select * from admin where name='$num'";//tut
								$res=mysql_query($avalible);
								$row=mysql_fetch_array($res);
								$mest=$row['maxCol']-$row['aboniments']-$row['records'];
                                $year=$row['year'];
                                $month=$row['month'];
                                $day=$row['day'];
                                echo "<input type='hidden' id='5551' value='$mest'>";
                                echo "<input type='hidden' id='5552' value='$year'>";
                                echo "<input type='hidden' id='5553' value='$month'>";
                                echo "<input type='hidden' id='5554' value='$day'>";
        $dat=$row['year']."-".$row['month']."-".$row['day'];
        $time=escape($row['Time']);
		$phones=query("select dBase.* from dBase,records where dBase.id=records.id_user and records.id_event='$num' and records.date_event='$dat' and records.time_event='$time'
        and records.comment='Record to event' and records.is_true='1' order by $sort $fl");//tut
		$flag=0;
		//echo "<script>$col=0</script>";
//    	for($i=0;$i<mysql_num_rows($phones);$i++)
        while ($row = fetch_array($phones, MYSQL_ASSOC)){
    		//if (mysql_result($phones,$i,0)==$allPhone){
					$name1 = iconv("WINDOWS-1251","UTF-8", $row['name']);
					$fam1 = iconv("WINDOWS-1251","UTF-8", $row['fam']);
					$flag+=1;
					echo "<tr><td align='center'>$flag</td><td>$fam1</td><td>$name1</td><td align='center'>$row[age]</td>
					    <td align='center'>$row[phone]</td><td align='center'>$row[avalible]</td>
					        <td align='center'>$row[not_avalible]</td><td><input type='checkbox' name='formDoor[]' value='$row[id]' id='$flag'/></td></tr>";
		}
		echo "<input type='hidden' id='1000' value='$flag'>";
	?>
    </tbody>
    </table>
    </form>
    <?php
        echo "<form action='admin_trening.php' method='post' name='form2'><input type='hidden' name='num' value='$num'>
        <input type='hidden' name='login' value='$login'><input type='hidden' name='pass' value='$pass'>
            <input type='hidden' name='sort'><input type='hidden' name='fl'></form>";
    ?>
    <br><br>
    <script>for ($i=0;$i<document.getElementById(1000).value;$i++) document.write("<br>")  
    </script>
    <p align="left"><input type="button" id="500" value="Закончить тренировку" style="font-size:16px" onClick="document.getElementById(333).style.visibility='visible';document.getElementById(3331).style.visibility='visible';"></p>
    <div id="333" align="right" style="position:fixed;border:dotted;background-color:#333;border-color:#F00;top:30%;width:400px;height:185px;visibility:hidden">
	<div id="3331" modal='true' style="position:static;visibility:hidden">
    	<p id="99" align="center" style="font-size:28px;color:#FFF">Вы уверены,что хотите закночить тренировку?</p>
        <p align="center">  
          <input type="button" value="Да" onClick="document.forms['form1'].submit();" style="font-size:24px"> 
        <g style="visibility:hidden">gnkdjkjs</g>
        <input type="button" value="Нет"  onClick="Div_hide(3331)" style="font-size:24px">
        </p>
    </div>
</div>
</body>
<script type="text/javascript">
function Div_hide(id){
	document.getElementById(id).style.visibility='hidden';
	document.getElementById(333).style.visibility='hidden';
}
function sortt(sor,fl){
    document.form2.sort.value=sor;
    document.form2.fl.value=fl;
    document.forms['form2'].submit();
}
function check(){
	$year=document.getElementById(5552).value;
	$month=document.getElementById(5553).value;
	$day=document.getElementById(5554).value;
	var date=new Date();
	if (date.getHours()>=9 && date.getDate()== $day && date.getMonth()== $month && date.getFullYear()==$year)
		document.getElementById(500).style.visibility='visible';	
	else
		document.getElementById(500).style.visibility='hidden';
}


</script>
</html>

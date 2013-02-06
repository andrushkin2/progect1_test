<?php
$kol=$_POST['kol'];
$num=$_POST['num'];
$date=$_POST['date'];
$month=$_POST['month'];
$year=$_POST['year'];
$hours=$_POST['hours'];
$minutes=$_POST['minutes'];
$xdate=$_POST['xdate'];
$xmonth=$_POST['xmonth'];
$xyear=$_POST['xyear'];
$xhours=$_POST['xhours'];
$xminutes=$_POST['xminutes'];
$repeat=$_POST['repeat'];
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());
if ($kol!="")
    mysql_query("UPDATE admin set maxCol ='$kol' where name='$num'");//tut


    $flag=true;
    $a="Update admin set ";
    if ($date!=""){
        $flag=false;
        $a.=" day='$date'";
    }
    if ($month!="")
        if ($flag){
            $flag=false;
            $a.=" month='$month'";
        }
        else
            $a.=",month='$month'";
    if ($year!=""){
        if ($flag) {
            $flag=false;
            $a.=" year='$year'";
        }
        else
            $a.=",year='$year'";
    }
    if (!$flag){
        $a.=" where name='$num'";
        echo $a;
        if (mysql_query($a))
            echo "GOOD a";
    }
    $date=mysql_query("select year,month,day,Time,xDate,xTime from admin where name='$num'");//tut
    $row=mysql_fetch_array($date);
    $t3 = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']));
    $t3=explode("-",$t3);
    $tim=explode(":",$row['Time']);
    if ($hours!="")
        $tim[0]=$hours;
    if ($minutes!="")
        $tim[1]=$minutes;
    mysql_query("UPDATE admin set Time ='$tim[0]:$tim[1]',day='$t3[2]',month='$t3[1]',year='$t3[0]' where name='$num'");//tut

    $xdat=explode("-",$row['xDate']);
    $xtim=explode(":",$row['xTime']);
    if ($xdate!="")
        $xdat[2]=$xdate;
    if($xmonth!="")
        $xdat[1]=$xmonth;
    if ($xyear!="")
        $xdat[0]=$xyear;
    if ($xhours!="")
        $xtim[0]=$xhours;
    if ($xminutes!="")
        $xtim[1]=$xminutes;
    mysql_query("UPDATE admin set xTime ='$xtim[0]:$xtim[1]',xDate='$xdat[0]-$xdat[1]-$xdat[2]' where name='$num'");//tut

    if ($repeat==0){
        $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']));
        if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
            echo "GOOD";
        else
            echo "BAD";
    }
    if ($repeat==1){
        $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+1,$row['year']));
        if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
            echo "GOOD";
        else
            echo "BAD";
    }
    if ($repeat==2){
        $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+7,$row['year']));
        if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
            echo "GOOD";
        else
            echo "BAD";
    }
    if ($repeat==3){
        $t = date("Y-m-d",mktime('0','0','0',$row['month']+1,$row['day'],$row['year']));
        if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
            echo "GOOD";
        else
            echo "BAD";
    }
    if ($repeat==4){
        $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']+1));
        if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
            echo "GOOD";
        else
            echo "BAD";
    }
    mysql_query("UPDATE admin set rep='$repeat' where name='$num'");

echo "<form method=GET action=1.php><input type=hidden name=num value=$num><input type=submit id=1 onclick='document.getElementById(1).click();' value=Назад style=font-size:22px></form>";
?>
<script type="text/javascript">
    document.getElementById(1).click();
</script>
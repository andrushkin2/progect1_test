<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
    <script src="js/jquery.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Новое событие</title>
    <style type="text/css">
        g{font-size: 20px;display: none;color: red}
    </style>
</head>
<body>
<?php
$login=$_POST['login'];
$pass=$_POST['pass'];
if ($login=="" || $pass=="")
    echo "<form method='GET' action='1.php' name='f'>
                        <input type='submit' id='1' style='font-size:22px;visibility: hidden'></form>
                        <script>document.getElementById(1).click();</script>";
$pass_admin=$_POST['pass_admin'];
$kol=$_POST['kol'];
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
$x_rep_date=$_POST['x_rep_date'];
$x_rep_year=$_POST['x_rep_year'];
$x_rep_month=$_POST['x_rep_month'];
$check=$_POST['check'];
if ($_POST['never'])
    $never=1;
else
    $never=0;
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());
 $re=mysql_query("select * from admin where login='$login' and pass='$pass'");
$res=mysql_fetch_array($re,MYSQL_ASSOC);
$org=$res['organization'];
$url_site=$res['url_site'];
    $a1=mysql_query("insert into admin (maxCol,login,pass,aboniments,organization,url_site,trening_code) values ('$kol','$login','$pass','0','$org','$url_site','$pass_admin')");//tut
    $num=mysql_insert_id();
echo "Код для вставки:<br>
    <textarea cols='50' rows='7'><a href='http://salto.extreme.by/Project1/main.php?num=$num'><input type='button' value='+1' style='font-size:42px;color:red;fontWeight:bold'></a></textarea>";

mysql_query("UPDATE admin set never_rep ='$never' where name='$num'");//tut


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
        //echo $a;
        if (mysql_query($a))
            echo "";
    }

    $date=mysql_query("select year,month,day,Time,xDate,xTime,never_rep,end_rep from admin where name='$num'");//tut
    $row=mysql_fetch_array($date);
    $t3 = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']));
    $t3=explode("-",$t3);
    $tim=explode(":",$row['Time']);
    if ($hours!="")
        $tim[0]=$hours;
    if ($minutes!="")
        $tim[1]=$minutes;
    mysql_query("UPDATE admin set Time ='$tim[0]:$tim[1]',day='$t3[2]',month='$t3[1]',year='$t3[0]' where name='$num'");//tut

    $end_rep_all=explode('-',$row['end_rep']);
if ($x_rep_date!="")
    $end_rep_all[2]=$x_rep_date;
if($x_rep_month!="")
    $end_rep_all[1]=$x_rep_month;
if ($x_rep_year!="")
    $end_rep_all[0]=$x_rep_year;
mysql_query("UPDATE admin set end_rep='$end_rep_all[0]-$end_rep_all[1]-$end_rep_all[2]' where name='$num'");//tut


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

    if (!$check){   //если повторять checked=false
        $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']));
        if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
            echo "";
        else
            echo "";
        mysql_query("UPDATE admin set rep='0' where name='$num'");
    }
    else{ // если повторять checked=true
        if ($row['never_rep']==1){ //если окончания повторов нет
            if ($repeat==1){
                $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+1,$row['year']));
                if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                    echo "";
                else
                    echo "";
            }
            if ($repeat==2){
                $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+7,$row['year']));
                if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                    echo "";
                else
                    echo "";
            }
            if ($repeat==3){
                $t = date("Y-m-d",mktime('0','0','0',$row['month']+1,$row['day'],$row['year']));
                if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                    echo "";
                else
                    echo "";
            }
            if ($repeat==4){
                $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']+1));
                if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                    echo "";
                else
                    echo "";
            }
            mysql_query("UPDATE admin set rep='$repeat' where name='$num'");
        }//если окончания повторов...
        else{  //если окончание повторов есть
            if ($repeat==1){
                $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+1,$row['year']));
                if (equal_date($t,'$end_rep_all[0]-$end_rep_all[1]-$end_rep_all[2]'))
                    if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                        echo "";
                    else
                        echo "";
            }
            if ($repeat==2){
                $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day']+7,$row['year']));
                if (equal_date($t,'$end_rep_all[0]-$end_rep_all[1]-$end_rep_all[2]'))
                    if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                        echo "";
                    else
                        echo "";
            }
            if ($repeat==3){
                $t = date("Y-m-d",mktime('0','0','0',$row['month']+1,$row['day'],$row['year']));
                if (equal_date($t,'$end_rep_all[0]-$end_rep_all[1]-$end_rep_all[2]'))
                    if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                        echo "";
                    else
                        echo "";
            }
            if ($repeat==4){
                $t = date("Y-m-d",mktime('0','0','0',$row['month'],$row['day'],$row['year']+1));
                if (equal_date($t,'$end_rep_all[0]-$end_rep_all[1]-$end_rep_all[2]'))
                    if (mysql_query("UPDATE admin set nextDate='$t' where name='$num'"))
                        echo "";
                    else
                        echo "";
            }
            mysql_query("UPDATE admin set rep='$repeat' where name='$num'");
        } //если окончание повторов...
    }
echo "<br><br><form method=post action=adm_page.php><input type=hidden name=login value=$login> <input type=hidden name=pass value=$pass>
    <input type=submit id=1 onclick='document.getElementById(1).click();' value='Главное меню' style=font-size:22px></form>";
function equal_date($next,$end){
    $next=explode('-',$next);
    $end=explode('-',$end);
    if($next[0]<$end[0])
        return true;
    else
        if($next[0]=$end[0] && $next[1]<$end[1])
            return true;
        else
            if ($next[0]=$end[0] && $next[1]=$end[1] && $next[2]<=$end[2])
                return true;
            else
                return false;
    return false;
}
?>
<script type="text/javascript">
    //document.getElementById(1).click();
</script>
</body>
</html>
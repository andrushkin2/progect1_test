<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Выполнение операции</title>
</head>
<body>
<?php
	mysql_connect('localhost','saltoext_salto','5700');
    mysql_select_db('saltoext_salto1') or die(mysql_error());
    $num=$_POST['num'];
  $aDoor = $_POST['formDoor'];
  //if(!empty($aDoor))
  {
    $N = count($aDoor);
    echo("Операция успешно выполнена. Можно закрыть страницу. ");
    for($i=0; $i < $N; $i++)
    {	
		$avalible="select * from dBase where id='$aDoor[$i]' and num='$num'";//tut
		$res=mysql_query($avalible);
		$row=mysql_fetch_array($res);
		mysql_query("UPDATE dBase set record ='0' where id='$aDoor[$i]' and num='$num'");//tut
		if ($row['record']==1)
		if ($row['avalible']<9){
			$t=$row['avalible'];
			$t+=1;
			mysql_query("UPDATE dBase set avalible ='$t' where id='$aDoor[$i]' and num='$num'");//tut
		}
    }
	$phones=mysql_query("select id from dBase where num='$num' order by fam");//tut
    	for($i=0;$i<mysql_num_rows($phones);$i++)
		{
				{$tmp=mysql_result($phones,$i,0);
				$avalible="select * from dBase where id='$tmp' and num='$num'";//tut
				$res=mysql_query($avalible);
				$row=mysql_fetch_array($res);
				if ($row['record']==1){
					//mysql_query("UPDATE dBase set avalible ='0' where id='$tmp' and num='$num'");//tut
					//mysql_query("UPDATE dBase set acces ='1' where id='$tmp' and num='$num'");//tut
					mysql_query("UPDATE dBase set record ='0' where id='$tmp' and num='$num'");//tut
				}
			}
		
		}
  }
	$tim=mysql_query("select nextDate,rep,xDate,end_rep,never_rep from admin where name='$num'");
	$row=mysql_fetch_array($tim);
    $xt=explode("-",$row['xDate']);
	$t=explode("-",$row['nextDate']);
	if (mysql_query("UPDATE admin set year='$t[0]',month='$t[1]',day='$t[2]' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";

	if ($row['rep']==0){
		$t1 = date("Y-m-d",mktime('0','0','0',$t[1],$t[2],$t[0]));
		$t2 = date("Y-m-d",mktime('0','0','0',$xt[1],$xt[2],$xt[0]));
		if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
			echo "GOOD";
		else
			echo "BAD";
	}
    else{
        if ($row['never_rep']==1){
            if ($row['rep']==1){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1],$t[2]+1,$t[0]));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1],$xt[2]+1,$xt[0]));
                if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                    echo "GOOD";
                else
                    echo "BAD";
            }
            if ($row['rep']==2){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1],$t[2]+7,$t[0]));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1],$xt[2]+7,$xt[0]));
                if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                    echo "GOOD";
                else
                    echo "BAD";
            }
            if ($row['rep']==3){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1]+1,$t[2],$t[0]));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1]+1,$xt[2],$xt[0]));
                if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                    echo "GOOD";
                else
                    echo "BAD";
            }
            if ($row['rep']==4){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1],$t[2],$t[0]+1));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1],$xt[2],$xt[0]+1));
                if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                    echo "GOOD";
                else
                    echo "BAD";
            }
        }
        else{
            if ($row['rep']==1){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1],$t[2]+1,$t[0]));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1],$xt[2]+1,$xt[0]));
                if (equal_date($t1,$row['end_rep']))
                    if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                        echo "GOOD";
                    else
                        echo "BAD";
            }
            if ($row['rep']==2){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1],$t[2]+7,$t[0]));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1],$xt[2]+7,$xt[0]));
                if (equal_date($t1,$row['end_rep']))
                    if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                        echo "GOOD";
                    else
                        echo "BAD";
            }
            if ($row['rep']==3){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1]+1,$t[2],$t[0]));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1]+1,$xt[2],$xt[0]));
                if (equal_date($t1,$row['end_rep']))
                    if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                        echo "GOOD";
                    else
                        echo "BAD";
            }
            if ($row['rep']==4){
                $t1 = date("Y-m-d",mktime('0','0','0',$t[1],$t[2],$t[0]+1));
                $t2 = date("Y-m-d",mktime('0','0','0',$xt[1],$xt[2],$xt[0]+1));
                if (equal_date($t1,$row['end_rep']))
                    if (mysql_query("UPDATE admin set nextDate='$t1',xDate='$t2' where name='$num'"))
                        echo "GOOD";
                    else
                        echo "BAD";
            }
        }
    }

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
  //mysql_close();
?>  

</body>
</html>

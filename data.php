<?php
$id=$_GET['i'];
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());
$date=mysql_query("select year,month,day,maxCol,records from admin where name='$id'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['msg'] = false;
else{
    $ost=$row['maxCol']-$row['records'];
    $date=$row['day']."-".$row['month']."-".$row['year'];
    $t = date("l",mktime('0','0','0',$row['month'],$row['day'],$row['year']));
    $return['msg']=true;
}
echo $_GET['callback'] . '(' . "{'col' : '".$ost."','date' : '".$date."','day' : '".$t."','msg' : '".$return['msg']."'}" .')';
?>

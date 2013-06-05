<?php
require("config.php");
$id=$_GET['i'];
$id=escape($id);
refresh_rec($id);
$date=query("select year,month,day,maxCol,records,xDate,xTime from admin where name='$id'");//tut
$row=fetch_array($date);
if (!$row)
    $return['msg'] = false;
else{
    $ost=$row['maxCol']-$row['records'];
    $date=$row['day']."-".$row['month']."-".$row['year'];
    $t = date("l",mktime('0','0','0',$row['month'],$row['day'],$row['year']));
    $return['msg']=true;
}
echo $_GET['callback'] . '(' . "{'col' : '".$ost."','date' : '".$date."','day' : '".$t."','msg' : '".$return['msg']."','xDate' : '".$row['xDate']."','xTime' : '".$row['xTime']."'}" .')';
?>

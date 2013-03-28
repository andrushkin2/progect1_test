<?php
require('config.php');

$comment=$_POST['c'];

switch ($comment){
    case 'cancel':$comment='Canceling record';break;
    case 'update':$comment='Update account info';break;
    case 'new':$comment='Record to event';break;
    default: {
        die("Error data:unknown comment");
        exit;
    }
}

$id=$_POST['i'];
$phone=$_POST['p'];
$id=escape($id);
$comment=escape($comment);
$phone=escape($phone);

$admin=query("SELECT organization,Time,year,month,day,maxCol,records FROM admin where name='$id'");
$adm=fetch_array($admin);
if (!$adm){
    die ("Error on load data org");
    exit;
}
$maxCol=$adm['maxCol'];
$records=$adm['records'];
$org=escape($adm['organization']);
$time=escape($adm['Time']);
$dat=escape($adm['year']."-".$adm['month']."-".$adm['day']);
$at_date=escape(date("Y-m-d"));
$at_time=escape(date("H:i:s"));

$date=query("SELECT id FROM dBase WHERE phone='$phone' and event='$org'");//tut
$row=fetch_array($date);
if (!$row){
    die('Error on load data '.$org." \n".$phone." \n".$date);
    exit;
}
$user_id=$row['id'];


////////////////////////////////////////////////////
///////                                      ///////
///////         Canceling record             ///////
///////                                      ///////
////////////////////////////////////////////////////
if ($comment=='Canceling record'){
    $q=query("UPDATE records SET is_true='0' WHERE records.id_user='$user_id' and records.date_event='$dat' and records.time_event='$time' and records.id_event='$id'
        and records.comment='Record to event' and records.is_true='1'");
    if (!$q){
        die('Error on query');
        exit;
    }
    else{
        $return['msg']=true;
    }
}
////////////////////////////////////////////////////
///////                                      ///////
///////         Update user data             ///////
///////                                      ///////
////////////////////////////////////////////////////
if ($comment=='Update account info'){
    $name=$_POST['name'];
    $fam=$_POST['fam'];
    $age=$_POST['age'];
    $name = escape($name);
    $fam = escape($fam);
    $age=escape($age);
    $name = iconv("UTF-8", "WINDOWS-1251", $name);
    $fam = iconv("UTF-8", "WINDOWS-1251", $fam);
    $q=query("UPDATE dBase SET name='$name',fam='$fam',age='$age' WHERE id='$user_id'");
    if (!$q){
        die('Error on query');
        exit;
    }
    else{
        $return['msg']=true;
    }
}
////////////////////////////////////////////////////
///////                                      ///////
///////         New record to event          ///////
///////                                      ///////
////////////////////////////////////////////////////
if ($comment=='Record to event'){
    if ($maxCol>$records){
        $records++;
        $records=escape($records);
        query("UPDATE admin SET records='$records' WHERE name='$id'");
        $q=query("insert into records (id_user,id_event,comment,date_event,time_event,at_date,at_time,sms) values ('$user_id','$id','$comment','$dat','$time','$at_date','$at_time','0')");
        if (!$q){
            die('Error on query');
            exit;
        }
        else{
            $return['msg']=true;
        }
    }
    else{
        $return['msg']=false;
    }
}

echo json_encode($return);
?>

<?php
require("config.php");
$id=escape($_GET['i']);
$code=escape($_GET['e']);
$date=mysql_query("select login,pass from admin where name='$id' and trening_code='$code'");//tut
$row=mysql_fetch_array($date);
if (!$row){
    $return['msg'] = false;
    echo $_GET['callback'] . '(' . "{'msg' : 'false'}" .')';
}
else{
        $return['msg'] = true;
        $return['log'] = $row['login'];
        $return['pas'] = $row['pass'];
    echo $_GET['callback'] . '(' . "{'msg' : 'true','log' : '".$return['log']."','pas' : '".$return['pas']."'}" .')';
}
?>

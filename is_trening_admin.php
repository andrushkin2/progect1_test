<?php
$id=$_POST['i'];
$code=$_POST['e'];
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());
$date=mysql_query("select login,trening_code,pass from admin where name='$id'");//tut
$row=mysql_fetch_array($date);
if (!$row)
    $return['msg'] = false;
else{
    if ($row['trening_code']==$code){
        $return['msg'] = 'adm';
        $return['log'] = $row['login'];
        $return['pas'] = $row['pass'];
        echo json_encode($return);
        return;
    }
    else
        if ($row['pass']==$code){
            $return['msg'] = 'main';
            $return['log'] = $row['login'];
            $return['pas'] = $row['pass'];
            echo json_encode($return);
            return;
        }
    $return['msg'] = false;
}
echo json_encode($return);
?>

<?php
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());

function escape($string){
    return mysql_real_escape_string($string);
}
function nextId(){
    return mysql_insert_id();
}
function query($string){
    return mysql_query($string);
}
function fetch_array($string,$result_type = MYSQL_BOTH){
    return mysql_fetch_array($string,$result_type);
}
function refresh_rec($num){
    $num=escape($num);
    $avalible="select * from admin where name='$num'";//tut
    $res=query($avalible);
    $row=fetch_array($res);
    $dat=$row['year']."-".$row['month']."-".$row['day'];
    $time=escape($row['Time']);
    $phones=query("select dBase.* from dBase,records where dBase.id=records.id_user and records.id_event='$num' and records.date_event='$dat' and records.time_event='$time'
        and records.comment='Record to event' and records.is_true='1'");
    $col=mysql_num_rows($phones);
    query("UPDATE admin set records ='$col' where name='$num'");
}
?>
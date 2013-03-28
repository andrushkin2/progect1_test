<?php
mysql_connect('localhost','saltoext_salto','5700');
mysql_select_db('saltoext_salto1') or die(mysql_error());

function escape($string){
    return mysql_real_escape_string($string);
}
function query($string){
    return mysql_query($string);
}
function fetch_array($string,$result_type = MYSQL_BOTH){
    return mysql_fetch_array($string,$result_type = MYSQL_BOTH);
}
?>
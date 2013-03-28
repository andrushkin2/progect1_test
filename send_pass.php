<?php
require('config.php');
$id=$_POST['i'];
$phone=$_POST['p'];
$comment=$_POST['c'];

switch ($comment){
    case 'cancel':$comment='Canceling record';break;
    case 'update':$comment='Update account info';break;
    default: {
        die("Error data:unknown comment");
        exit;
    }
}
$id=escape($id);
$comment=escape($comment);
$phone=escape($phone);
$admin=mysql_query("SELECT organization,Time,year,month,day FROM admin where name='$id'");
$adm=mysql_fetch_array($admin);
if (!$adm){
    die ("Error on load data org");
    exit;
}
$org=escape($adm['organization']);
$time=$adm['Time'];
$dat=$adm['year']."-".$adm['month']."-".$adm['day'];
$at_date=date("Y-m-d");
$at_time=date("H:i:s");
$date=mysql_query("SELECT id FROM dBase WHERE phone='$phone' and event='$org'");//tut
$row=mysql_fetch_array($date);
if ($row['id']==null || $row['id']==""){
    die('Error on load data '.$org." \n".$phone." \n".$date);
    exit;
}
$user_id=$row['id'];
    $k=rand(100,999);
    //echo "<input type=hidden id=1000 value=$k>";
    $p="fyPoEZDnbmOI";
    $pas=$phone.$p;
    $pass=md5($pas);
    $url ="http://api.smsline.333by.com:83?target=1333&msisdn=$phone&text=Kod+aktivacii:+$k++++++++++++++++++++++++++++++++++++++++Akrobaticheskij+klub+SALTO,+ul.+Kalinovskogo+111, +www.salto.extreme.by&login=bfog&pass=$pass"; 													// это адрес, по которому скрипт передаст данные методом POST. Как видно, здесь указаны переменные, которые будут переданы через GET
    $parse_url = parse_url($url); // при помощи этой функции разбиваем адрес на массив, который будет содержать хост, путь и список переменных.
    $path = $parse_url["path"]; // путь до файла(/patch/file.php)
    if($parse_url["query"]) // если есть список параметров
        $path .= "?" . $parse_url["query"]; // добавляем к пути до файла список переменных(?var=23&var2=54)
    $host= $parse_url["host"]; // тут получаем хост (test.ru)
    $data = "target=1333&msisdn=$phone&text=Kod+aktivacii:+$k++++++++++++++++++++++++++++++++++++++++Akrobaticheskij+klub+SALTO,+ul.+Kalinovskogo+111, +www.salto.extreme.by&login=bfog&pass=$pass"; // а вот тут создаем список переменных с параметрами. Эти данные будут переданы через POST. Все значения переменных обязательно нужно кодировать urlencode ("еще тест")

    $fp = fsockopen($host, 83, $errno, $errstr, 10);
    if ($fp)
    {
        $out = "POST ".$path." HTTP/1.1\n";
        $out .= "Host: ".$host."\n";
        $out .= "Referer: ".$url."/\n";
        $out .= "User-Agent: Opera\n";
        $out .= "Content-Type: application/x-www-form-urlencoded\n";
        $out .= "Content-Length: ".strlen($data)."\n\n";
        $out .= $data."\n\n";

        fputs($fp, $out); // отправляем данные
        fclose($fp);
    }
    mysql_query("insert into records (id_user,id_event,comment,date_event,time_event,at_date,at_time,sms) values ('$user_id','$id','$comment','$dat','$time','$at_date','$at_time','1')");
    $return['kod']=md5($k);

echo json_encode($return);
?>

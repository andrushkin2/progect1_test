<?php
require('config.php');

$hour=date('H:i:s');
$h2=strtotime($hour);
$h=date("H",$h2)-1;
if ($h=="-1")
    $h='23';
if ($h=="0")
    $h='24';

$id=escape($_POST['i']);
$phone=$_POST['p'];
$admin=query("SELECT organization,Time,year,month,day FROM admin where name='$id'");
$adm=fetch_array($admin);
$org=escape($adm['organization']);
$time=escape($adm['Time']);
$dat=escape($adm['year']."-".$adm['month']."-".$adm['day']);
$ret_date=$adm['day']."-".$adm['month']."-".$adm['year'];
$tmp=explode(":",$adm['Time']);
$ret_time=$tmp[0].":".$tmp[1];
$at_date=escape(date("Y-m-d"));
$at_time=escape(date("H:i:s"));
$date=query("select dBase.id,dBase.name,dBase.fam,dBase.record,dBase.age,dBase.avalible,dBase.not_avalible from dBase where dBase.phone='$phone' and dBase.event='$org'");//tut
$row=fetch_array($date);
if (!$row){
    $return['msg'] = 'new';
    if ($h < 21 && $h >= 9){
        query("insert into dBase (name,fam,phone,age,acces,avalible,kode,num,first_date,first_time,record,event) values ('','','$phone','','0','0','0','$num','$at_date','$at_time','0','$org')");
        $user_id=mysql_insert_id();
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
        query("insert into records (id_user,id_event,comment,date_event,time_event,at_date,at_time,sms) values ('$user_id','$id','New user','$dat','$time','$at_date','$at_time','1')");
        $return['kod']=md5($k);
    }
} //END if new account
else{
    $user_id=escape($row['id']);
    $avt=query("select id from records where id_event in (select id from admin where organization='$org') and comment='Canceling record' and id_user='$user_id'");
    $canceling=mysql_num_rows($avt);
    if (!$canceling)
        $canceling=0;
    $return['avt']=$row['avalible']-$row['not_avalible']*2-$canceling;
    $name1 = iconv("WINDOWS-1251","UTF-8", $row['name']);
    $fam1 = iconv("WINDOWS-1251","UTF-8", $row['fam']);
    $return['name']=$name1;
    $return['fam']=$fam1;
    $return['age']=$row['age'];
    $return['date']=$ret_date;
    $return['time']=$ret_time;
    $date=query("SELECT records.id_user FROM records WHERE records.id_user='$user_id' and records.date_event='$dat' and records.time_event='$time' and records.id_event='$id'
        and records.comment='Record to event' and records.is_true='1'");//tut
    $row=fetch_array($date);
    if (! $row){
        $return['msg'] = 'no';
    }
    else{
        $return['msg'] = 'yes';
    }
}
echo json_encode($return);
?>

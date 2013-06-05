<?php
require("config.php");
$mas = $_POST['mas'];
$txt = escape($_POST['txt']);
$N = count($mas);
$in = "";
if ($N>0){
    for ($i=0;$i<$N;$i++){
        if ($i==0)
            $in.=$mas[$i];
        else
            $in.=", ".$mas[$i];
    }
}
$que = "select dBase.phone from dBase where dBase.id IN (".$in.")";
$data = query($que);//tut
$url = "http://api.smsline.333by.com:83";
if (mysql_num_rows($data) == 1){
    $row = fetch_array($data);
    $phone = $row['phone'];
    $p = "fyPoEZDnbmOI";
    $pas = $phone.$p;
    $pass = md5($pas);
    //$txt = preg_replace('/\s/',"+",$txt);
    $data = array('target' => '1333', 'msisdn' => $phone, 'text' => $txt, 'login' =>'bfog', 'pass' =>$pass);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
}
else{
    while ($row = fetch_array($data, MYSQL_ASSOC)){
        $phone = $row['phone'];
        $p = "fyPoEZDnbmOI";
        $pas = $phone.$p;
        $pass = md5($pas);
        //$txt = preg_replace('/\s/',"+",$txt);
        $data = array('target' => '1333', 'msisdn' => $phone, 'text' => $txt, 'login' =>'bfog', 'pass' =>$pass);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        /*$return['phone'] = $phone;
        $return['txt'] = $txt;
        echo json_encode($return);*/
    }
}
$ret['ok'] = true;
echo json_encode($ret);
?>

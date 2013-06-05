<?php
require("config.php");
$id=escape($_POST['i']);
$avalible="select * from admin where name='$id'";
$date=query($avalible);//tut
$row=fetch_array($date);
$dat=$row['year']."-".$row['month']."-".$row['day'];
$time=escape($row['Time']);
$phones=query("select dBase.* from dBase,records where dBase.id=records.id_user and records.id_event='$id' and records.date_event='$dat' and records.time_event='$time'
        and records.comment='Record to event' and records.is_true='1' order by fam");//tut
$flag=0;
$color=false;
$first=true;
$code="<table border='2'><tbody><tr style='background: whitesmoke;'>
            <td class='td_head'>№</td><td class='td_head'>Фамилия</td><td class='td_head'>Имя</td><td class='td_head'>Год</td><td class='td_head'>Номер телефона</td><td class='td_head'>Пришел</td><td class='td_head'>Не пришел</td><td class='td_head'><input type='checkbox' class='all_check_box' onchange='check_all()'/></td></tr>";
//$test=fetch_array($phones);

while ($row = fetch_array($phones, MYSQL_ASSOC)){
    $name1 = iconv("WINDOWS-1251","UTF-8", $row['name']);
    $fam1 = iconv("WINDOWS-1251","UTF-8", $row['fam']);
    $flag+=1;
    if ($color){
        $code.="<tr style='background-color: #e5e8f7'><td class='td'  align='center'>$flag</td><td class='td' >$fam1</td><td class='td' >$name1</td><td class='td'  align='center'>$row[age]</td>
					    <td class='td'  align='center'>$row[phone]</td><td class='td'  align='center'>$row[avalible]</td>
					        <td class='td'  align='center'>$row[not_avalible]</td><td class='td' ><input type='checkbox' name='formDoor[]' value='$row[id]' id='$flag'/></td></tr>";
        $color=false;
    }
    else{
        if ($first){
            $code.="<tr style='background-color: #f7f7f7'><td class='td_first'  align='center'>$flag</td><td class='td_first' >$fam1</td><td class='td_first' >$name1</td><td class='td_first'  align='center'>$row[age]</td>
					    <td class='td_first'  align='center'>$row[phone]</td><td class='td_first'  align='center'>$row[avalible]</td>
					        <td class='td_first'  align='center'>$row[not_avalible]</td><td class='td_first' ><input type='checkbox' name='formDoor[]' value='$row[id]' id='$flag'/></td></tr>";
            $color=true;
            $first=false;
        }
        else{
            $code.="<tr style='background-color: #f7f7f7'><td class='td'  align='center'>$flag</td><td class='td' >$fam1</td><td class='td' >$name1</td><td class='td'  align='center'>$row[age]</td>
					    <td class='td'  align='center'>$row[phone]</td><td class='td'  align='center'>$row[avalible]</td>
					        <td class='td'  align='center'>$row[not_avalible]</td><td class='td' ><input type='checkbox' name='formDoor[]' value='$row[id]' id='$flag'/></td></tr>";
            $color=true;
        }
    }
}
if ($first){
    $return['empty']=true;
    echo json_encode($return);
    exit;
}
$code.="</tbody></table>";
$return['code']=$code;//htmlspecialchars($code);
echo json_encode($return);
?>

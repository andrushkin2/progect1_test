<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" charset="utf-8">
    <script src="js/jquery.js" type="text/javascript"></script>
<title>База данных</title>
    <style type="text/css">
        g{font-size: 20px}
        .but{
            font-size: 18px !important;
            -webkit-border-radius:35px;
            -khtml-border-radius: 35px;
            -moz-border-radius: 35px;
            border-radius: 35px;
        }
        table{
            -webkit-border-radius:10px;
            -khtml-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }
        select{
            font-size:20px;
            -webkit-border-radius:10px;
            -khtml-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }
        .td{
            border-bottom: 0px;
            border-bottom-color: white;
            border-top: 0px;
            border-top-color: white;
            padding: 3px 4px 3px 4px;
            font-size: 14px;
        }
        .td_first{
            border-bottom: 0px;
            border-bottom-color: white;
            padding: 3px 4px 3px 4px;
            font-size: 14px;
        }
        /*#f7f7f7*/
    </style>
</head>
<body>
<?php
$login=$_POST['login'];
$pass=$_POST['pass'];
if ($login=="" || $pass=="")
    echo "<form method='GET' action='1.php' name='f'>
                        <input type='submit' id='1' style='font-size:22px;visibility: hidden'></form>
                        <script>document.getElementById(1).click();</script>";
?>
<div style="padding: 5px">
    <input class="but" type='button' onclick="document.forms['form1'].action='adm_page.php';document.forms['form1'].submit();" value='Главное меню'>
</div>
<table border="2" style="padding: 3px;border-color: floralwhite;border-spacing: 0px;">
    <tbody>
    <tr>
        <td onclick="sort('organization desc')" style='cursor:pointer'>
            Организация
        </td>
        <td  onclick="sort('url_site desc')" style='cursor:pointer'>
            Ссылка на сайт
        </td>
        <td  onclick="sort('login desc')" style='cursor:pointer'>
            Логин
        </td>
        <td  onclick="sort('pass desc')" style='cursor:pointer'>
            Пароль
        </td>
        <td  onclick="sort('trening_code desc')" style='cursor:pointer'>
            Пароль тренеровки
        </td>
        <td  onclick="sort('maxCol desc')" style='cursor:pointer'>
            Всего мест
        </td>
        <td  onclick="sort('records desc')" style='cursor:pointer'>
            Кол-во записавшихся
        </td>
        <td  onclick="sort('year,month,day,Time desc')" style='cursor:pointer'>
            Начало события
        </td>
        <td  onclick="sort('xDate,xTime desc')" style='cursor:pointer'>
            Окончание регистрации
        </td>
        <td  onclick="sort('rep desc')" style='cursor:pointer'>
            Повтор события
        </td>
        <td  onclick="sort('organization')" style='cursor:pointer'>
            Окончание повторов
        </td>
    </tr>
            <?php
            mysql_connect('localhost','saltoext_salto','5700');
            mysql_select_db('saltoext_salto1') or die(mysql_error());
            $sort=$_POST['sort'];
            if ($sort=='')
                $sort='organization desc';
            $date=mysql_query("select * from admin where login='$login' and pass='$pass' order by $sort");//tut
            $color=false;
            $first=true;
            while ($row = mysql_fetch_array($date, MYSQL_ASSOC)){
                $t=explode(':',$row['Time']);
                $xt=explode(':',$row['xTime']);
                $xd=explode("-",$row{'xDate'});
                $end_rep=explode('-',$row['end_rep']);
                switch($row['rep']){
                    case 0:
                        $rep='Никогда';
                        break;
                    case 1:
                        $rep='Каждый день';
                        break;
                    case 2:
                        $rep='Каждую неделю';
                        break;
                    case 3:
                        $rep='Каждый месяц';
                        break;
                    case 4:
                        $rep='Каждый год';
                        break;
                }
                switch($row['never_rep']){
                    case 1:
                        $never_rep='Никогда';
                        break;
                    case 0:
                        $never_rep=$end_rep[2]."-".$end_rep[1]."-".$end_rep[0];
                }
                if ($color){
                    echo "<tr style='background-color: #e5e8f7;'><td class='td' >".$row['organization']."</td><td class='td' >".$row['url_site']."</td>
                        <td class='td' >".$row['login']."</td><td class='td' >".$row['pass']."</td><td class='td' >".$row['trening_code']."</td>
                        <td class='td' >".$row['maxCol']."</td><td class='td' >".$row['records']."</td><td class='td' >".$row['day']."-".$row['month']."-".$row['year']." ".$t[0].":".$t[1]."</td>
                        <td class='td' >".$xd[2]."-".$xd[1]."-".$xd[0]." ".$xt[0].":".$xt[1]."</td><td class='td' >".$rep."</td><td class='td' >".$never_rep."</td></tr>";
                    $color=false;
                }
                else{
                    if ($first){
                        echo "<tr class='background-color: #f7f7f7;'><td class='td_first' >".$row['organization']."</td><td class='td_first' >".$row['url_site']."</td>
                        <td class='td_first' >".$row['login']."</td><td class='td_first' >".$row['pass']."</td><td class='td_first' >".$row['trening_code']."</td>
                        <td class='td_first' >".$row['maxCol']."</td><td class='td_first' >".$row['records']."</td><td class='td_first' >".$row['day']."-".$row['month']."-".$row['year']." ".$t[0].":".$t[1]."</td>
                        <td class='td_first' >".$xd[2]."-".$xd[1]."-".$xd[0]." ".$xt[0].":".$xt[1]."</td><td class='td_first' >".$rep."</td><td class='td_first' >".$never_rep."</td></tr>";
                        $color=true;
                        $first=false;
                    }
                    else{
                        echo "<tr class='background-color: #f7f7f7;'><td class='td' >".$row['organization']."</td><td class='td' >".$row['url_site']."</td>
                        <td class='td' >".$row['login']."</td><td class='td' >".$row['pass']."</td><td class='td' >".$row['trening_code']."</td>
                        <td class='td' >".$row['maxCol']."</td><td class='td' >".$row['records']."</td><td class='td' >".$row['day']."-".$row['month']."-".$row['year']." ".$t[0].":".$t[1]."</td>
                        <td class='td' >".$xd[2]."-".$xd[1]."-".$xd[0]." ".$xt[0].":".$xt[1]."</td><td class='td' >".$rep."</td><td class='td' >".$never_rep."</td></tr>";
                        $color=true;
                    }
                }
            }
            ?>
    </tbody>
    </table>
<form action="#"method="post" name='form1' onsubmit="return false">
    <?php
        echo "<input type=hidden name=login value=$login>";
        echo "<input type=hidden name=pass value=$pass>";
        echo "<input id=sort type=hidden name=sort value=organization>";
    ?>
</form>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('#close_win').click(function(){
            $('#event').hide();
        });
        $('#data_base').click(function(){
            document.forms['form1'].action='database.php';
            document.forms['form1'].submit();
        });
        $('#change').click(function(){
            document.forms['form1'].action='admin_menu1.php';
            document.forms['form1'].submit();
        });
        $('#open_win').click(function(){
            $('#event').slideDown('fast');
        });
        $('#new_trening').click(function(){
            document.forms['form1'].action='create_menu.php';
            document.forms['form1'].submit();
        });
    });
    function sort(value){
        $('#sort').attr('value',value);
        document.forms['form1'].submit();
    }
</script>
</html>

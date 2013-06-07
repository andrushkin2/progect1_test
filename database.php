<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" charset="utf-8">
    <script src="js/jquery.js" type="text/javascript"></script>
<title>База данных</title>
    <style type="text/css">
        g{font-size: 20px}

        /*#f7f7f7*/
    </style>
</head>
<body>
<?php
require("config.php");
$login=$_POST['login'];
$pass=$_POST['pass'];
if ($login=="" || $pass=="")
    echo "<form method='GET' action='1.php' name='f'>
                        <input type='submit' id='1' style='font-size:22px;visibility: hidden'></form>
                        <script>document.getElementById(1).click();</script>";
?>
<div class="conteiner">
<div style="padding: 5px" class="bar">
    <!--<input class="but" type='button' onclick="document.forms['form1'].action='adm_page.php';document.forms['form1'].submit();" value='Главное меню'>
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;-->
    <input type="button" class="but" value="Создать" id='new_trening' onclick="document.forms['form2'].action='create_menu.php';
            document.forms['form2'].submit();">
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <input type="button" class="but" value="Изменить" id='open_win' onclick="$('#event').slideDown('fast');">
</div>
  <div class="tren_tab">
<table border="2" style="padding: 3px;border-spacing: 0px;">
    <tbody>
    <tr>
        <td class="td_head" onclick="sort('organization desc')" style='cursor:pointer'>
            Организация
        </td>
        <td class="td_head"  onclick="sort('url_site desc')" style='cursor:pointer'>
            Ссылка<br>на сайт
        </td>
        <td class="td_head"  onclick="sort('login desc')" style='cursor:pointer'>
            Логин
        </td>
        <td class="td_head"  onclick="sort('pass desc')" style='cursor:pointer'>
            Пароль
        </td>
        <td class="td_head"  onclick="sort('trening_code desc')" style='cursor:pointer'>
            Пароль<br>тренеровки
        </td>
        <td class="td_head"  onclick="sort('maxCol desc')" style='cursor:pointer'>
            Всего мест
        </td>
        <td class="td_head"  onclick="sort('records desc')" style='cursor:pointer'>
            Кол-во<br>записавшихся
        </td>
        <td class="td_head"  onclick="sort('year,month,day,Time desc')" style='cursor:pointer'>
            Начало события
        </td>
        <td class="td_head"  onclick="sort('xDate,xTime desc')" style='cursor:pointer'>
            Окончание<br>регистрации
        </td>
        <td class="td_head"  onclick="sort('rep desc')" style='cursor:pointer'>
            Повтор<br>события
        </td>
        <td class="td_head"  onclick="sort('organization')" style='cursor:pointer'>
            Окончание<br>повторов
        </td>
    </tr>
            <?php
            $sort=escape($_POST['sort']);
            if ($sort=='')
                $sort='organization desc';
            $date=query("select * from admin where login='$login' and pass='$pass' order by $sort");//tut
            $color=false;
            $first=true;
            while ($row = fetch_array($date, MYSQL_ASSOC)){
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
                    echo "<tr style='background-color: #e5e8f7;' id='$row[name]'><td class='td' >".$row['organization']."</td><td class='td' >".$row['url_site']."</td>
                        <td class='td' >".$row['login']."</td><td class='td' >".$row['pass']."</td><td class='td' >".$row['trening_code']."</td>
                        <td class='td' >".$row['maxCol']."</td><td class='td' >".$row['records']."</td><td class='td' >".$row['day']."-".$row['month']."-".$row['year']." ".$t[0].":".$t[1]."</td>
                        <td class='td' >".$xd[2]."-".$xd[1]."-".$xd[0]." ".$xt[0].":".$xt[1]."</td><td class='td' >".$rep."</td><td class='td' >".$never_rep."</td></tr>";
                    $color=false;
                }
                else{
                    if ($first){
                        echo "<tr style='background-color: #f7f7f7;' id='$row[name]'><td class='td_first' >".$row['organization']."</td><td class='td_first' >".$row['url_site']."</td>
                        <td class='td_first' >".$row['login']."</td><td class='td_first' >".$row['pass']."</td><td class='td_first' >".$row['trening_code']."</td>
                        <td class='td_first' >".$row['maxCol']."</td><td class='td_first' >".$row['records']."</td><td class='td_first' >".$row['day']."-".$row['month']."-".$row['year']." ".$t[0].":".$t[1]."</td>
                        <td class='td_first' >".$xd[2]."-".$xd[1]."-".$xd[0]." ".$xt[0].":".$xt[1]."</td><td class='td_first' >".$rep."</td><td class='td_first' >".$never_rep."</td></tr>";
                        $color=true;
                        $first=false;
                    }
                    else{
                        echo "<tr style='background-color: #f7f7f7;' id='$row[name]'><td class='td' >".$row['organization']."</td><td class='td' >".$row['url_site']."</td>
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
  </div>
</div>
<div id="event"  align="center" style="position: absolute;background:gray;top:50%;margin-top: -100px;display: none;left: 50%;margin-left: -180px;width: 365px;height: auto">
    <div style="cursor:pointer;position: relative;top: 4px;left: 163px;font-size: 26px;color: wheat;font-weight: bold;font-family: arial;" onclick="$('#event').hide()">x</div>
    <div>
        <table border="0">
            <tbody>
            <tr>
                <td style="border: 0px">
                    <g style='color: wheat'>Событие:</g>
                </td>
                <td style="border: 0px;padding: 4px">
                    <form action="" method="post" name='form2' onsubmit="return false">
                        <select name='num'>
                            <?php
                            $date=mysql_query("select * from admin where login='$login' and pass='$pass'");//tut
                            while ($row = mysql_fetch_array($date, MYSQL_ASSOC)){
                                $t=explode(':',$row['Time']);
                                echo "<option value='$row[name]'>$row[day]-$row[month]-$row[year] $t[0]:$t[1]</option>";
                            }
                            ?>
                        </select>
                        <?php
                        echo "<input type=hidden name=login value=$login>";
                        echo "<input type=hidden name=pass value=$pass>";
                        echo "<input id=sort type=hidden name=sort value=organization>";
                        ?>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div style="margin-top: 20px;margin-bottom: 10px">
        <input type="button" id="change" value="Изменить" class="but" onclick="document.forms['form2'].action='admin_menu1.php';
            document.forms['form2'].submit();"/>
    </div>
</div>
<form action="#"method="post" name='form1' onsubmit="return false">
    <?php
        echo "<input type=hidden name=login value=$login>";
        echo "<input type=hidden name=pass value=$pass>";
        echo "<input id=sort type=hidden name=sort value=organization>";
    ?>
</form>
    <div id="modal_box" style="position: fixed;height: 100%;width: 100%;display: none;background: black"></div>
    <div id="admin_window" align="center" style="display: none;text-align: center; position: absolute;width: 600px;margin-left: -300px;box-shadow: 0px 0px 14px #888888;
            padding: 15px; background: grey;top: 120px;left: 50%;z-index: 5">
        <div style="cursor:pointer;position: absolute;top: 4px;left: 603px;float: left;font-size: 26px;color: wheat;font-weight: bold;font-family: arial;" onclick="hide_madal()    ">x</div>
        <div style="font-size: 20px;color: wheat;padding: 12px;">Список записавшихся</div>
        <div class="admin_window_loading">
            <div><b style="color: whitesmoke">Идет загрузка...</b></div>
            <div><img src='Images/ajax-loader-big.gif'/></div>
        </div>
        <div class="admin_window_text" ></div>
        <div class="admin_window_message" style="margin-top: 16px;">
            <div style="display: inline-block">
                <textarea style="resize: none" cols="35" maxlength="160" rows="3"></textarea>
            </div>
            <div style="display: inline-block;position: relative;top: -21px;">
                <input type="button" value="Отправить" onclick="send_message()">
            </div>
        </div>
        <div class="admin_window_message_prog" style="margin-top: 16px;display: none">
            <div><b style="color: whitesmoke">Отправка сообщения...</b></div>
            <div><img src='Images/ajax-loader-big.gif'/></div>
        </div>
    </div>
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
        /*$('#change').click(function(){
            document.forms['form1'].action='admin_menu1.php';
            document.forms['form1'].submit();
        });*/
        $('.tren_tab table tr').click(function(){
            if (! /selected_tr/.test(this.className)){
                $('tr.selected_tr').removeClass('selected_tr');
                $(this).addClass('selected_tr');
                return;
            }
            $('#admin_window div.admin_window_loading').attr('style','display:block');
            $('#admin_window div.admin_window_text').html("");
            $('#modal_box').addClass('admin');
            $('#admin_window').slideDown('fast');
            //alert('ajax');
            $.ajax({
                type:'POST',
                url:'people_list.php',
                dataType:'json',
                data:{
                    i:$(this).attr('id')
                },
                success : function(data){
                    $('#admin_window div.admin_window_loading').hide();
                    if (data.empty){
                        $('#admin_window div.admin_window_text').html("<b style='color: whitesmoke'>Нет записавшихся на занятие</b>");
                    }
                    else
                        $('#admin_window div.admin_window_text').html(data.code);
                }
            })
        });
        $('#open_win').click(function(){
            $('#event').slideDown('fast');
        });
        $('#new_trening').click(function(){
            document.forms['form1'].action='create_menu.php';
            document.forms['form1'].submit();
        });
    });
    function send_message(){
        if (! $('#admin_window div.admin_window_message textarea').val().length > 0){
            alert("Введите текст сообщения!");
            return;
        }
        var mas=new Array();
        var checked=$("#admin_window table td input[name='formDoor[]']:checked");
        if (checked.length > 0){
            $('#admin_window div.admin_window_message').hide( 10, function(){
                $('#admin_window div.admin_window_message_prog').slideDown();
            });
            for ( var i = 0; i < checked.length; i++){
                mas.push($(checked[i]).val())
            }
            $.ajax({
                type:'POST',
                url:'send_message.php',
                dataType:'json',
                data:{
                    mas:mas,
                    txt:$('#admin_window div.admin_window_message textarea').val()
                },
                success:function(data){
                    if (!data.ok){
                        //alert(data.phone + " - " + data.txt);
                    }
                    else if (data.ok){
                        $('#admin_window div.admin_window_message textarea').val("");
                        $('#admin_window div.admin_window_message_prog').hide( 10, function(){
                            $('#admin_window div.admin_window_message').slideDown();
                        });
                    }

                }
            })
        }
        else{
            alert("Не выбраны получатели сообщения!");
            return;
        }
    }
    function check_all(){
        if ($("#admin_window table td .all_check_box").is(':checked'))
            $("#admin_window table td input[name='formDoor[]']").attr('checked','checked');
        else
            $("#admin_window table td input[name='formDoor[]']").attr('checked',false);
    }
    function hide_madal(){
        $('#admin_window').hide('fast',function(){
            $('#modal_box').removeClass('admin');
        });
    }
    function sort(value){
        $('#sort').attr('value',value);
        document.forms['form1'].submit();
    }
</script>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="js/jquery.js" type="text/javascript"></script>
<title>Администрирование</title>
    <style type="text/css">
        g{font-size: 20px}
        .but{
            font-size: 22px;
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
<table border="2">
    <tbody>
    <tr>
        <td  style="border: 0px">
            <table border="2">
                <tbody>
                <tr>
                    <td style="border: 0px">
                        <g>Тренировка:</g>
                    </td>
                    <td style="border: 0px;padding: 4px">
                        <form action="" method="post" name='form1' onsubmit="return false">
                            <select name='num'>
                                <?php
                                mysql_connect('localhost','saltoext_salto','5700');
                                mysql_select_db('saltoext_salto1') or die(mysql_error());
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
                            ?>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="border: 0px;padding: 4px;text-align: center">
            <input type="button" class="but" value="Вход на тренировку" id='trening'>
        </td>
    </tr>
    <tr>
        <td style="border: 0px;padding: 4px;text-align: center">
            <input type="button" class="but" value="Настройка тренировки" id='change'>
        </td>
    </tr>
    <tr>
        <td style="border: 0px;padding: 4px;text-align: center">
            <input type="button" class="but" value="Новая тренировка" id='new_trening'>
        </td>
    </tr>
    </tbody>
</table>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('#trening').click(function(){
            document.forms['form1'].action='admin_trening.php';
            document.forms['form1'].submit();
        });
        $('#change').click(function(){
            document.forms['form1'].action='admin_menu1.php';
            document.forms['form1'].submit();
        });
        $('#new_trening').click(function(){
            document.forms['form1'].action='create_menu.php';
            document.forms['form1'].submit();
        });
    });
</script>
</html>

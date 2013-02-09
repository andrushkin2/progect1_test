<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            -webkit-border-radius:10px;
            -khtml-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<?php
    $num=$_GET['num'];
    mysql_connect('localhost','saltoext_salto','5700');
    mysql_select_db('saltoext_salto1') or die(mysql_error());
    $tim1=mysql_query("select * from admin where name='$num'");
    $row=mysql_fetch_array($tim1);
?>
<body>
<form name="form1" onsubmit="return false" action="change.php" method="POST">
    <?php
        echo "<input type=hidden name=num value=$num>";
    ?>
    <table align="left" border="2">
        <tbody>
            <tr>
                <td style="border: 0px;padding-left: 20px;padding-right: 20px">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <g>Установить количество мест: <?php echo $row['maxCol']." "?></g>
                                </td>
                                <td align="left">
                                    <input type="text" id="1" size="3" name="kol" style="font-size:20px"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr height="30px"></tr>
            <tr>
                <td style="border: 0px;padding-left: 20px;padding-right:20px">
                    <g>Начало мероприятия:</g>
                </td>
            </tr>
            <tr>
                <td style="border: 0px;padding-left: 20px;padding-right:20px">
                    <table border="2">
                        <tbody>
                            <tr>
                                <td style="border: 0px">
                                    <g>Дата: <?php echo $row['day']."-".$row['month']."-".$row['year']?> </g>
                                </td>
                                <td style="border: 0px;padding: 4px">
                                    <select name="date" style="font-size:20px">
                                        <option value=""></option>
                                        <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                        <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option>
                                        <option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option>
                                        <option value="30">30</option><option value="31">31</option>
                                    </select>
                                </td>
                                <td style="border: 0px;padding: 4px">
                                    <select name="month" style="font-size:20px;text-align: center">
                                        <option value=""></option>
                                        <option value="1">январь</option><option value="2">февраль</option><option value="3">март</option><option value="4">апрель</option><option value="5">май</option><option value="6">июнь</option><option value="7">июль</option><option value="8">август</option><option value="9">сентябрь</option>
                                        <option value="10">октябрь</option><option value="11">ноябрь</option><option value="12">декабрь</option>
                                    </select>
                                </td>
                                <td style="border: 0px;padding: 4px">
                                    <select name="year" style="font-size:20px">
                                        <option value=""></option>
                                        <option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px;padding: 4px;text-align: center"></td>
                                <td style="border: 0px;padding: 4px;text-align: center">Число</td>
                                <td style="border: 0px;padding: 4px;text-align: center">Месяц</td>
                                <td style="border: 0px;padding: 4px;text-align: center">Год</td>
                            </tr>
                            <tr height="10px"></tr>
                            <tr>
                                <td style="border: 0px;padding: 4px">
                                    <g>Время: <?php $t=explode(":",$row['Time']);echo $t[0].":".$t[1];?></g>
                                </td>
                                <td style="border: 0px;padding: 4px">
                                    <select name="hours" style="font-size:20px">
                                        <option value=""></option>
                                        <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                        <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option>
                                        <option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option>
                                    </select>
                                </td>
                                <td style="border: 0px;padding: 4px">
                                    <select name="minutes" style="font-size:20px">
                                        <option value=""></option>
                                        <option value="0">00</option><option value="5">05</option>
                                        <option value="10">10</option><option value="15">15</option>
                                        <option value="20">20</option><option value="25">25</option>
                                        <option value="30">30</option><option value="35">35</option>
                                        <option value="40">40</option><option value="45">45</option>
                                        <option value="50">50</option><option value="55">55</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px;padding: 4px;text-align: center"></td>
                                <td style="border: 0px;padding: 4px;text-align: center">Часов</td>
                                <td style="border: 0px;padding: 4px;text-align: center">Минут</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr height="30px"></tr>
            <tr>
                <td style="border: 0px;padding-left: 20px;padding-right:20px">
                    <g>Окончание регистрации:</g>
                </td>
            </tr>
            <tr>
                <td style="border: 0px;padding-left: 20px;padding-right:20px">
                    <table border="2">
                        <tbody>
                        <tr>
                            <td style="border: 0px">
                                <g>Дата: <?php $t1=explode("-",$row['xDate']);echo $t1[2]."-".$t1[1]."-".$t1[0]?> </g>
                            </td>
                            <td style="border: 0px;padding: 4px">
                                <select name="xdate" style="font-size:20px">
                                    <option value=""></option>
                                    <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                    <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option>
                                    <option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option>
                                    <option value="30">30</option><option value="31">31</option>
                                </select>
                            </td>
                            <td style="border: 0px;padding: 4px">
                                <select name="xmonth" style="font-size:20px;text-align: center">
                                    <option value=""></option>
                                    <option value="1">январь</option><option value="2">февраль</option><option value="3">март</option><option value="4">апрель</option><option value="5">май</option><option value="6">июнь</option><option value="7">июль</option><option value="8">август</option><option value="9">сентябрь</option>
                                    <option value="10">октябрь</option><option value="11">ноябрь</option><option value="12">декабрь</option>
                                </select>
                            </td>
                            <td style="border: 0px;padding: 4px">
                                <select name="xyear" style="font-size:20px">
                                    <option value=""></option>
                                    <option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;padding: 4px;text-align: center"></td>
                            <td style="border: 0px;padding: 4px;text-align: center">Число</td>
                            <td style="border: 0px;padding: 4px;text-align: center">Месяц</td>
                            <td style="border: 0px;padding: 4px;text-align: center">Год</td>
                        </tr>
                        <tr height="10px"></tr>
                        <tr>
                            <td style="border: 0px;padding: 4px">
                                <g>Время: <?php $t=explode(":",$row['xTime']);echo $t[0].":".$t[1];?></g>
                            </td>
                            <td style="border: 0px;padding: 4px">
                                <select name="xhours" style="font-size:20px">
                                    <option value=""></option>
                                    <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                    <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option>
                                    <option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option>
                                </select>
                            </td>
                            <td style="border: 0px;padding: 4px">
                                <select name="xminutes" style="font-size:20px">
                                    <option value=""></option>
                                    <option value="0">00</option><option value="5">05</option>
                                    <option value="10">10</option><option value="15">15</option>
                                    <option value="20">20</option><option value="25">25</option>
                                    <option value="30">30</option><option value="35">35</option>
                                    <option value="40">40</option><option value="45">45</option>
                                    <option value="50">50</option><option value="55">55</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;padding: 4px;text-align: center"></td>
                            <td style="border: 0px;padding: 4px;text-align: center">Часов</td>
                            <td style="border: 0px;padding: 4px;text-align: center">Минут</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr height="30px"></tr>
            <tr>
                <td style="border: 0px;padding-left: 20px;padding-right:20px">
                    <g>Повторить:</g>
                    <input type="checkbox" name='check' id='check' <?php if($row['rep']!=0) echo "checked" ?> onclick="checke()" />
                </td>
            </tr>
            <tr id="tr" style="display: <?php if($row['rep']!=0) echo "table-row"; else echo "none"?> ">
                <td style="border: 0px;padding-left: 20px;padding-right: 20px">
                    <table border="2" style="width: 432px">
                        <tbody>
                        <tr >
                            <td style="border: 0px;">
                                <table border="0">
                                    <tbody>
                                    <tr>
                                        <td style="border: 0px;padding: 4px">
                                            <g>Каждый день</g>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <input type="radio" name="repeat" value="1" <?php if($row['rep']==1) echo "checked" ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px;padding: 4px">
                                            <g>Каждую неделю</g>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <input type="radio" name="repeat" value="2" <?php if($row['rep']==2) echo "checked" ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px;padding: 4px">
                                            <g>Каждый месяц</g>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <input type="radio" name="repeat" value="3" <?php if($row['rep']==3) echo "checked" ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px;padding: 4px">
                                            <g>Каждый год</g>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <input type="radio" name="repeat" value="4" <?php if($row['rep']==4) echo "checked" ?>>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="30px"></tr>
                        <tr>
                            <td style="border: 0px;padding-left: 8px;padding-right:20px">
                                <g>Окончание повторов:</g>
                            </td>
                        </tr>
                        <tr >
                            <td style="border: 0px;">
                                <table border="0">
                                    <tbody>
                                    <tr>
                                        <td style="border: 0px;padding: 4px">
                                            <g>Никогда</g>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <input type="checkbox" name="never" id="never" onclick="if_never()" <?php if($row['never_rep']==1) echo "checked" ?>>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr id="x_rep" style="display: <?php if($row['never_rep']==1) echo "none"; else echo "table-row"; ?>">
                            <td style="border: 0px;">
                                <table border="0">
                                    <tbody>
                                    <tr>
                                        <td style="border: 0px">
                                            <g>Дата: <?php $t1=explode("-",$row['end_rep']);echo $t1[2]."-".$t1[1]."-".$t1[0]?> </g>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <select name="x_rep_date" style="font-size:20px">
                                                <option value=""></option>
                                                <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                                <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option>
                                                <option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option>
                                                <option value="30">30</option><option value="31">31</option>
                                            </select>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <select name="x_rep_month" style="font-size:20px;text-align: center">
                                                <option value=""></option>
                                                <option value="1">январь</option><option value="2">февраль</option><option value="3">март</option><option value="4">апрель</option><option value="5">май</option><option value="6">июнь</option><option value="7">июль</option><option value="8">август</option><option value="9">сентябрь</option>
                                                <option value="10">октябрь</option><option value="11">ноябрь</option><option value="12">декабрь</option>
                                            </select>
                                        </td>
                                        <td style="border: 0px;padding: 4px">
                                            <select name="x_rep_year" style="font-size:20px">
                                                <option value=""></option>
                                                <option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td style="border: 0px;padding: 4px;text-align: center">Число</td>
                                        <td style="border: 0px;padding: 4px;text-align: center">Месяц</td>
                                        <td style="border: 0px;padding: 4px;text-align: center">Год</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr height="20px"></tr>
            <tr align="right">
                <td style="border: 0px;padding-left: 20px;padding-right: 20px">
                    <input type="button" class="but"  value="Отменить"/>
                    <g style="visibility: hidden">aaa</g>
                    <input type="button" class="but" value="Применить" onclick="document.forms['form1'].submit();"/>
                </td>
            </tr>
        </tbody>
    </table>
</form>
</body>
<script type="text/javascript">
    function checke(){
        if (document.getElementById('check').checked)
            document.getElementById("tr").style.display="table-row";
        else
            document.getElementById("tr").style.display="none";
    }
    function if_never(){
        if (document.getElementById('never').checked)
            document.getElementById("x_rep").style.display="none";
        else
            document.getElementById("x_rep").style.display="table-row";
    }
</script>
</html>

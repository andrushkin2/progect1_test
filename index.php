<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" charset="utf-8">
    <script type="text/javascript" src='js/jquery.js' charset="utf-8"></script>
    <script type="text/javascript" src='js/register.js' charset="utf-8"></script>
    <script type="text/javascript" src='js/md5.js' charset="utf-8"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registration</title>
</head>
<body>
<?php
$num=$_GET['num'];
?>
<div id="body" style="width:100%;height:100%;padding:0px;margin:0px;background: lightsteelblue;">
    <div id="modal" class="middleBox">
        <div class="centerBox" id="main_window" style="display: none">
            <div class="title_name">
                <h2 align="center">
                    <span style="color:darkcyan;">Онлайн запись на мероприятие</span>
                </h2>
            </div>

            <!--шаг первый: правм=ила регестрации-->
            <div id="first_window" class="first_vnimanie">
                <h3 style="color:#F00">Правила регестрации:</h3>
                <!--<p style="color:#F00;font-size:24px;font-weight:bold">Правила регестрации:</p>-->
                <p align="left" style="font-size:20px" id="warning">
                    <!--<b>ВНИМАНИЕ!</b> <b style="color:#F00">Система "АНТИРАЗГВОЗДЯЙ":</b> если Вы зарегистрировались и не пришли на занятие, то регистрация в дальнейшем для Вас будет возможна только по телефону и только при наличии свободных мест.-->
                    <b>Первая регистрация возможна с 9.00 до 21.00.</b><br> Время белорусское.<br><g style="color:red;font-size: 0.9em;font-weight: bold">Правила учета Авторитета:</g><br>Зарегистрировался и пришел +1 к авторитету.<br>Зарегистрировался и не пришел -2 к авторитету.<br>
                    Зарегистрировался и отменил регистрацию* -1 к авторитету.<br><g style="font-size: 14px">*Для отмены регистрации нажмите кнопку «+1» и пройдите регистрацию еще раз.</g>
                </p>
                <p align="center"><input class="but" type="button" style="width: 140px;margin-top: 15px;" value="Принять условия" id="vote_first"></p>
            </div>

            <!--шаг второй:ввод номера-->
            <div id="second_window" class="first_vnimanie" style="display: none">
                <h3 style="color:#F00">Идентификация</h3>
                <p align="center" style="color:black;font-size:24px">Введите номер Вашего мобильного телефона</p>
                    <p align="center">
                        <span style="font-size:24px;font-weight:bold">+375</span>
                        <select name="kod" id="select_kode" style="font-size:20px">
                            <option value="25">25</option>
                            <option value="29">29</option>
                            <option value="33">33</option>
                            <option value="44">44</option>
                            <option selected=""></option>
                        </select>
                        <input type="text" id="number" name="phone" size="10">
                    </p>
                    <p align="center" id="second_error" style="display: none;font-size:18px">Неверно введен номер.Проверьте правильность ввода!</p>
                    <p align="center" id="second_error1" style="display: none;font-size:18px">Укажите код оператора!</p>
                    <p align="center">
                        <input type="button" id="vote_second" style="margin-top: 15px;" class="but" value="Далее" ">
                    </p>
            </div>

            <!-код активации-->
            <div id="kode_window" class="first_vnimanie" style="display: none">
                <h3 style="color:#F00">Код активации</h3>
                <div align="center">
                    <div align="centre" style="font-size:24px">Введите код активации:</div>
                    <div align="centre"><small>в течении 10 секунд на Ваш телефон придет СМС с кодом</small></div>
                    <div>
                        <input type="text" border="2" id="kode_text" maxlength="3" size="2" style="font-size:20px"/>
                    </div>
                    <p align="center" id="kode_error" style="display: none;font-size:18px">Неверный код активации!</p>
                    <div style="padding: 10px"><input type="button" id="kode_vote" class="but" value="Далее"/></div>
                </div>
            </div>

            <!-запись уже пройдена ранее-->
            <div id="already_window" class="first_vnimanie" style="display: none">
                <h3 style="color:#F00">Управление записью</h3>
                <div><p align="left" style="font-size:22px;padding: 20px;"><span id="already_n_f"></span>,<br> Вы уже записаны на мероприятие (<span id="already_date"></span>)</p></div>
                <div align="center">
                    <input type="button" value="Отменить запись" class="but" style="width: 140px" id="already_change"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Выход" class="but" style="width: 140px" onclick="document.location.href='<?php echo $_GET['url'];?>'" id="finally_vote"/>
                </div>
            </div>

            <!-информация пользователя-->
            <div id="info_window" class="first_vnimanie" style="display: none">
                <h3 style="color:#F00">Информация пользователя</h3>
                <div style="padding: 20px">
                    <div style="font-size: 22px"> Фамилия:<span id="info_fam"></span></div>
                    <div style="font-size: 22px"> Имя:<span id="info_name"></span></div>
                    <div style="font-size: 22px"> Год рождения:<span id="info_age"></span></div>
                </div>
                <div align="center">
                    <input type="button" value="Изменить" class="but" id="info_change">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Далее" class="but" id="info_vote">
                </div>
            </div>

            <!-новый пользователь-->
            <div id="regist_window" class="first_vnimanie" style="display: none">
                <h3 style="color:#F00">Ввод данных пользователя</h3>
                <form action="#" onsubmit="return false" name="regist_form" id>
                <div style="padding: 20px">
                    <div style="font-size: 22px"> Фамилия:<input type="text" id="regist_fam" name="fam"></div>
                    <div style="font-size: 22px"> Имя:<input type="text" id="regist_name" name="name"></div>
                    <div style="font-size: 22px"> Год рождения:
                        <select name="regist_age" id="regist_age" style="font-size:20px">
                            <?php
                                for ($i=1960;$i<=2005;$i++)
                                    echo "<option value='$i'>$i</option>";
                            ?>
                            <option selected value=""></option>
                        </select>
                    </div>
                </div>
                </form>
                <div align="center">
                    <input type="button" value="Применить" class="but" id="regst_vote"/>
                </div>
            </div>

            <!-успешная запись-->
            <div id="finally_window" class="first_vnimanie" style="display: none">
                <div style="padding: 20px">
                    <div id="finally_yes_div" style="font-size: 22px;display: none"><span id="finally_yes"></span>,Вы успешно зарегистрировались на мероприятие.<br>Ваш Авторитет:<span id="finally_avt"></span><br><br>
                        <g style="font-size: 20px"><g style="color:red;font-size: 0.9em;font-weight: bold">Правила учета Авторитета:</g><br>Зарегистрировался и пришел +1 к авторитету.<br>Зарегистрировался и не пришел -2 к авторитету.<br>
                        Зарегистрировался и отменил регистрацию* -1 к авторитету.<br><g style="font-size: 14px">*Для отмены регистрации нажмите кнопку «+1» и пройдите регистрацию еще раз.</g></g>
                    </div>
                    <div id="finally_no_div" style="font-size: 22px;display: none"><span id="finally_no"></span>, приносим Вам свои извинения. Все места на занятие уже заняты.</div>
                </div>
                <div align="center">
                    <input type="button" value="Выход" class="but" onclick="document.location.href='<?php echo $_GET['url'];?>'" id="finally_vote"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!--отменить запись?-->
<div id="cancel_record" align="center" style="position: fixed; border: dotted rgb(255, 0, 0); background-color: rgb(51, 51, 51);box-shadow: 0px 0px 14px #888888;
                top: 50%; width: 512px; height: auto;margin-top: -70px;display: none;z-index: 5;margin-left: -256px;left: 50%;">
    <p id="99" align="center" style="font-size:28px;color:#FFF">Вы уверены,что хотите отменить запись?</p>
    <p align="center">
        <input type="button" value="Да" id="cancel_record_yes" style="width:72px">
        <g style="visibility:hidden">gnkdjkjs</g>
        <input type="button" value="Нет" id="cancel_record_no" style="width:72px">
    </p>
</div>

<!--успешная отписка-->
<div id="commit_cancel" align="center" style="position: fixed; border: dotted rgb(255, 0, 0); background-color: rgb(51, 51, 51);
                top: 50%; width: 512px; height: 140px;margin-top: -70px;display: none;z-index: 5;margin-left: -256px;left: 50%;box-shadow: 0px 0px 14px #888888;">
    <p id="99" align="center" style="font-size:28px;color:#FFF">Вы успешно отписались от мероприятия</p>
    <p align="center">
        <input type="button" value="Выход" onclick="document.location.href='<?php echo $_GET['url'];?>'" id="commit_cancel_vote">
    </p>
</div>

<!--невозможность проведения операции-->
<div id="error_action" align="center" style="position: fixed; border: dotted rgb(255, 0, 0); background-color: rgb(51, 51, 51);
                top: 50%; width: 512px; height: auto;margin-top: -70px;display: none;z-index: 5;margin-left: -256px;left: 50%;box-shadow: 0px 0px 14px #888888;">
    <p id="" align="center" style="font-size:28px;color:#FFF">Данная операция возможна с 9.00 до 21.00</p>
    <p align="center">
        <input type="button" value="Выход" onclick="document.location.href='<?php echo $_GET['url'];?>'" id="error_action_vote">
    </p>
</div>

<!--admin_window-->
<div id="admin_window" style="display: none;text-align: center; position: fixed;width: 290px;height: 96px;margin-top: -48px;margin-left: -145px;box-shadow: 0px 0px 14px #888888;
  padding: 15px; background: grey;top: 50%;left: 50%;z-index: 5">
    <div align="right"><span align="right" style="cursor: pointer;color: wheat" id="close_admin_win">X</span></div>
    <form id="admin_win" action="#" method="post" onsubmit="return false" name="admin_win">
        <input type="hidden" name="num" value="<?php echo $num; ?>"/>
        <input id="log" type="hidden" name="login"/>
        <input id="pas" type="hidden" name="pass"/>
        <input type='hidden' name='sort' value='fam'>
        <input type='hidden' name='fl' value='asc'>
    </form>
    <div style="font-size: 20px;color: wheat;padding: 12px;">Администрирование</div>
    <span>
        <input type="button" class="but" id="panel" value="Изменить" onclick="adm_opt(1)"/>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" class="but" id="change" value="Отметить" onclick="adm_opt(2)"/>
    </span>
</div>
<div id="modal_box" style="position: fixed;height: 100%;width: 100%;display: none;background: black"></div>
</body>
</html>
<script type='text/javascript'>
    $(document).ready(function(){
        $num=<?php echo $num; ?>;
        $('#main_window').slideDown('slow',
                function(){
                   $('#vote_first').focus();
                    collection.step++;
                    collection.history[collection.step]='#vote_first';
                });
    });
</script>
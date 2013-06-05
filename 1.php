<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" charset="utf-8">
    <script src="js/jquery.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Вход на тренировку</title>
    <style type="text/css">
        g{font-size: 20px;display: none;color: red}
    </style>
</head>
<body>
<div class="autorization">
<g id='incorrect'>Incorrect login or pass</g>
<form action="database.php" id='form1' name='form1' onsubmit="return false" method="POST">
    <div>
    Логин:&nbsp;&nbsp;<input type="text" name='login' id="1"><br>
    Пароль:	<input type="text" name='pass' id="2"><br>
    <?php
    echo "<input id='sort' type='hidden' name='sort' value='organization'>";
    ?>
    </div>
</form>
    <div align="center" class="but_div">
        <input type="button" class="but" value="Вход" id='vote'>
    </div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('#vote').click(function(){
            $('#incorrect').slideUp('fast');
            $.ajax({
                type:'POST',
                url:'login.php',
                dataType:'json',
                data:{
                    l:$('#1').val(),
                    p:$('#2').val()
                },
                success : function(data){
                    {
                        if (!data.msg)
                            $('#incorrect').show('fast');
                        else
                            document.forms['form1'].submit();
                    }
                }
            });
        });
    });
</script>
</html>

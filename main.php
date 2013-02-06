<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Регистрация</title>
<style type="text/css">
textarea{resize:none};
.texte         { font-family: BauhausCCT, Verdana, Sans-Serif, Arial; font-size: 8pt; color: #000000; font-weight: normal; }
.menu	      	      { text-decoration: none; font-family: Verdana, Sans-Serif, Arial; font-size: 10pt; color: #000000; }
.menu:visited	      { text-decoration: none; font-family: Verdana, Sans-Serif, Arial; font-size: 10pt; color: #000000; }
.menu:hover	      { text-decoration: none; font-family: Verdana, Sans-Serif, Arial; font-size: 10pt; color: #FC0006; }
.menu:active	      { text-decoration: none; font-family: Verdana, Sans-Serif, Arial; font-size: 10pt; color: #000000; }
</style>
<style type="text/css">
	span.auto-style21
	{font-family:"Verdana","sans-serif";
	}
	span.auto-style11
	{}
	.auto-style1 {
	color: #000000;
	}
	.auto-style2 {
	text-decoration: none;
	}
	.auto-style3 {
	color: #000;
	font-size: 9px;
	}
	.auto-style4 {
	text-align: center;
	}
	.auto-style6 {
	text-align: center;
	font-family: "Times New Roman";
	color: #FF0000;
	}
	.auto-style5 {
	font-family: "Times New Roman";
	}
	font {
	font-size: 12;
	color: #000;
	}
	#table35 tr .texte p .auto-style3 {
	color: #F00;
	}
	#table35 tr .texte p .auto-style3 {
	font-size: 12px;
	font-family: "Times New Roman", Times, serif;
}
</style>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0">
<table width="100%" cellspacing="0" border="0">
<tbody>
	<tr>
    	<td colspan="5" height="40" bgcolor="#999999" nowrap align="center">
        <table width="915" cellpadding="0" cellspacing="0" border="0">
            	<tr>
                     <td align="right">
                        <div style="position:relative;visibility:hidden">
                        <?php	
								mysql_connect('localhost','saltoext_salto','5700');
								mysql_select_db('saltoext_salto1') or die(mysql_error());
								$avalible="select * from admin where name='1'";//tut
								$res=mysql_query($avalible);
								$row=mysql_fetch_array($res);
								$mest=$row['maxCol']-$row['aboniments']-$row['records'];
								echo "<g style=padding-right:10px;color:white;font-size:33px>$mest</g>";
							?>
                        	<div style="position:relative;float:right">
                            	<a href="in.php"><input type="image" class="butt" src="Images/button.gif" style="cursor:pointer"></a>
                        	</div
                        ></div>
                    </td>
                </tr>
            </table>
         </td>
    </tr>
    <tr><!-- главная часть страницы-->
    	<td bgcolor="#999999" nowrap></td><!-- Левая часть страницы-->
        <td width="1" bgcolor="#727272" nowrap></td>
		<!-- центральная часть-->
        <td width="915" valign="top" align="center" style="background-repeat:no-repeat;color:#000">
        	<table width="100%" cellspacing="0" cellpadding="0" border="0"><!-- Верхняя полоса-->
				<tbody>
                	<tr>
                    	<td bgcolor="#999999" nowrap="" height="1"></td>
                    </tr>
				</tbody>
			</table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0"><!-- Акробатический клуб...-->
				<tbody><tr><td height="10" width="100%"></td></tr>
					<tr><td bgcolor="#FF0100" height="3" width="100%"></td></tr>
					<tr><td height="25" width="100%"></td></tr>
					<tr><td height="70" width="100%" align="left" valign="middle">
						<img border="0" src="Images/logo.jpg" width="544" height="61" align="left"></td></tr>
					<tr><td>
						<img src="Images/verh_big.gif" width="915" height="110">	
					</td></tr>
					<tr><td height="3" width="100%"></td></tr>
					<tr><td bgcolor="#FF0100" height="3" width="100%"></td></tr>
					<tr><td height="7" width="100%"></td></tr>
					<tr><td bgcolor="#FF0100" height="7" width="100%"></td></tr>
				</tbody>
            </table>
			<table width="915" cellspacing="0" cellpadding="0" border="0"></table>
			<table width="100%" cellspacing="0" cellpadding="0" border="0"><!-- Информационная часть-->
				<tbody>
                	<tr>
                    	<td width="0" nowrap=""></td>
                        <td width="147" valign="top"><!-- Левая часть инф.части со ссылками-->
							<table width="100%" cellspacing="0" cellpadding="0" border="0" id="table30">
								<tbody>
                                	<tr>
										<td width="0" nowrap></td>
										<td width="147" valign="top">
                                        	<table width="100%" cellspacing="3" cellpadding="0" border="0" id="table46"><!-- таблица со ссылками-->
		  									<tbody>
                                            	<tr>
		    										<td>&nbsp;</td>
		   										</tr>
		  										<tr>
		    										<td>&nbsp;<img src="Images/square.gif" alt="" width="9" height="9">&nbsp;<a class="menu" href="http://salto.extreme.by/"> Главная<br>
                                                    </td>
		    									</tr>
		  										<tr>
		    										<td>&nbsp;<img src="Images/square.gif" alt="" width="9" height="9">&nbsp;<a class="menu" href="../graffic.html">Расписание</a><br>
                                                    </td>
		   										</tr>
		 										<tr>
		    										<td>&nbsp;<img src="Images/square.gif" alt="" width="9" height="9">&nbsp;<a href="price.html" class="menu">Цены и Акции</a><br>
                                                    </td>
		    									</tr>
		  										<tr>
		    										<td>&nbsp;<img src="Images/square.gif" alt="" width="9" height="9">&nbsp;<a class="menu" href="../element.html">Элементы</a><br>
                                                    </td>
		    									</tr>
		  										<tr>
		    										<td>&nbsp;<img src="Images/square.gif" alt="" width="9" height="9">&nbsp;<a href="../mail.html" class="menu">Контакты</a><br>
                                                    </td>
		    									</tr>
		  										<tr>
		    										<td>&nbsp;<img src="Images/square.gif" alt="" width="9" height="9"><a class="menu" href="../prajd.html"><span style="text-decoration: none">&nbsp;</span></a><a href="../compet.html" class="menu">Соревнования</a><br>
                                                    </td>
		    									</tr>
		  										<tr>
		    										<td>&nbsp;<img src="Images/square.gif" alt="" width="9" height="9">&nbsp;<a class="menu" href="../photo.html">Фото</a><br>
                                                    </td>
		    									</tr>
		  										<tr>
		    										<td>&nbsp;</td>
		    									</tr>
		  									</tbody>
										</table>
		  								<p class="texte">&nbsp;</p>
										<p></p>
										<p class="texte">&nbsp;</p>
										<p class="texte">&nbsp;&nbsp;Контакты:<br>
										<br>
										<span lang="ru">&nbsp;г.Минск</span><br>
										<span lang="ru">&nbsp;ул.Калиновского 111</span><br>
										<span lang="ru">&nbsp;</span><br>
										&nbsp;(+375 29) <span lang="ru">310 20 49</span><br>
       									&nbsp;(+375 29) <span lang="ru">570 79 40</span></p>
                                        </td>
									</tr>
								</tbody>
							</table>

		  					<p class="texte">&nbsp;</p>
                          </td>
                          <td width="0" nowrap=""></td>
                          <td width="7" bgcolor="#FF0100" nowrap=""></td>
                          <td width="19" nowrap=""></td>
                          <td width="569" valign="top">
                          	<p align="center" style="text-align:center"></p>
                            <p align="center" style="text-align:center">
                            	<h2 align="center">
                                	<span style="color:red;" >Онлайн запись на занятия</span>
                                </h2>
                            </p>
                                <h3 style="color:#F00">Шаг 1/5</h3>
   							<p style="color:#F00;font-size:24px;font-weight:bold">Правила регестрации:</p>
    							<!--<textarea name="textarea" cols="68" rows="20"  readonly="readonly">-->
                                <p align="left" style="font-size:21px">
	<b>ВНИМАНИЕ!</b> <b style="color:#F00">Система "АНТИРАЗГВОЗДЯЙ":</b> если Вы зарегистрировались и не пришли на занятие, то регистрация в дальнейшем для Вас будет возможна только по телефону и только при наличии свободных мест.
	<br><b>Первая регистрация возможна с 9.00 до 21.00.</b> Время белорусское.
    							</p>
    							<!--</textarea>-->
    							<?php
    							$num=$_GET['num'];
    							echo "<form action=step2.php>";
    							echo "<input type=hidden name=key value=1>";
    							echo "<input type=hidden name=num value=$num>";
    							echo "<p align=center><input class=but style=font-size:22px type=submit value=\"Я ознакомлен\" id=2 ></p></form>";
                                ?>
                                <br>
                                <br>
                          </td>
                      <td width="19" nowrap></td>
                          <td width="7" bgcolor="#ff0100" nowrap></td>
                          <td width="147" nowrap=""></td>
                    	</tr>
                	<tr>
                	  <td nowrap=""></td>
                	  <td valign="top">&nbsp;</td>
                	  <td nowrap=""></td>
                	  <td bgcolor="#FF0100" nowrap=""></td>
                	  <td nowrap=""></td>
                	  <td valign="top">&nbsp;</td>
                	  <td nowrap></td>
                	  <td bgcolor="#ff0100" nowrap></td>
                	  <td nowrap=""></td>
              	  </tr>
					</tbody>
				</table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
               	  <tbody>
                    	<tr>
                        	<td bgcolor="#ff0100" height="3" width="100%"></td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                	<tbody>
                    	<tr>
                        	<td height="60" width="915">
                            	<img src="Images/niz_big.gif" width="915" height="60">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                	<tbody>
                    	<tr>
                        	<td bgcolor="#ff0100" height="3" width="100%"></td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                	<tbody>
                    	<tr>
                        	<td width="147" height="60" nowrap=""></td>
                            <td width="7" bgcolor="#FF0100" nowrap=""></td>
                            <td width="100%" align="left" nowrap="">
                            	<font size="1">&nbsp;&nbsp;&nbsp;&nbsp;
                            		<a href="./second/dreamteam.html" class="auto-style3">Copyright © 2012, 
		salto.extreme.by</a>
        						</font><br>
&nbsp;
							</td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
                    	<tr>
                        	<td bgcolor="#999999" nowrap="" height="1">
                            </td>
                        </tr>
					</tbody>
                </table>
			</td>
        <td width="1" bgcolor="#727272" nowrap></td>
        <td bgcolor="#999999" nowrap></td>
    </tr>
    <!--Нижняя часть-->
	<tr>
    	<td colspan="5" height="40" bgcolor="#999999" nowrap="">&nbsp;</td>
    </tr>
</tbody>
</table>
<!--_______________________________________________________________________-->

<script type="text/javascript">
<!--
//-->
</script>
</body>
</html>

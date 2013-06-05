var self;
$(document).ready(function () {
this.modal=document.createElement('div');
    this.modal.setAttribute('id','errorDiv_modal');
this.modal.setAttribute('style','position: fixed;height: 100%;width: 100%;display: none;background: black;' +
    'top: 0px;left: 0px;zoom: 1;z-index: 2000;opacity: 0.2;cursor: progress;');
document.body.appendChild(this.modal);
this.errorDiv=document.createElement('div');
    this.errorDiv.setAttribute('id','errorDiv_infoPanel');
this.errorDiv.setAttribute('style','position:fixed;left:50%;border:dotted;background-color:#333;' +
    'border-color:#F00;top:50%;width:600px;height:auto;z-index:2001;display:none;margin-left:-300px;margin-top:-68px');
document.body.appendChild(this.errorDiv);
    this.trening=document.createElement('div');
    this.trening.setAttribute('id','info_treningDiv');
    this.trening.setAttribute('style','text-align:center;position:fixed;left:50%;border:dotted;background-color:#333;' +
        'border-color:#F00;top:50%;width:600px;height:auto;z-index:2001;display:none;margin-left:-300px;margin-top:-68px');
    this.trening.innerHTML="<form id='info_trning_win' action='#' method='post' onsubmit='return false' name='info_admin_win'>"+
        "<input type='hidden' name='num' value=''/>"+
        "<input id='log' type='hidden' name='login'/>"+
        "<input id='pas' type='hidden' name='pass'/>"+
        "<input type='hidden' name='sort' value='fam'>"+
            "<input type='hidden' name='fl' value='asc'>"+
            "</form>" +
        "<div style='color: white;margin-top: 5px'> Только для администратора</div>"+
        "<div style='margin-top: 5px;color: white'>Пароль:&nbsp;<input id='info_tren_input' type='text' maxlength='7' length='7'/></div>"+
        "<div id='info_treningDiv_errorCode' style='display: none;margin-top: 5px'><small style='color: red'>Неверный пароль</small></div>"+
        "<div align='center' style='margin: 5px 0px'><input type='button' value='Выход' onclick='logic.hide_modal()'/>&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value= 'Войти на тренировку' onclick='logic.valid()'/></div>";
    document.body.appendChild(this.trening);
this.errorDiv.innerHTML="<div align='center' style='color: red;font-size:28px'>Внимание!</div><p id='errorDiv_comment' align='center' style='font-size:28px;color:#FFF'>Запись на мероприятие окончена</p>"+
    "<p align='center'>"+
    "<input type='button' id='errorDiv_exit' value='Выход' onclick='error(\"\",false)'>"+
    "</p>";
})
window.mobileDetection = {
    Android:function () {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry:function () {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS:function () {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera:function () {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows:function () {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any:function () {
        return (this.Android() || this.BlackBerry() || this.iOS() || this.Opera() || this.Windows());
    }
};
function selector(id){
    if (window.isMobile = mobileDetection.any()){
        //alert(window.isMobile);
        return document.getElementById(id);
    }
    if (!document.querySelector)
        return document.getElementById(id);
    return document.querySelector('#'+id);
}
function error(text,show){
    var er=selector('errorDiv_infoPanel');
    var er1=selector('errorDiv_modal');
    if (show){
        //document.querySelector('#errorDiv_comment').innerHTML=text;
        er1.style.display='inline-block';
        er.style.display='block';
        $('#errorDiv_exit').focus();
    }
    else{
        //document.querySelector('#errorDiv_comment').innerHTML=text;
        er1.style.display='none';
        er.style.display='none';
    }
}
var logic={
    trening: '',
    init:function(parent,id){
        logic.posting(parent,id);
    },
    posting:function(parent,id){
        var a=this;
        /*this.body=document.querySelector("#"+parent);
        this.first=document.createElement('div');
        this.body.appendChild(this.first);
        this.first.innerHTML="<img src='http://salto.extreme.by/Project1/Images/ajax-loader-big.gif'/>";*/
        $.getJSON(
            'http://salto.extreme.by/Project1/data.php?callback=?',
            {i:id},
            function (data) {
                $(a.first).attr('style','display:none');
                //a.body.removeChild(a.first);
                $('#'+parent).attr('style','display:inline-block;font-family:arial');
                if (window.isMobile = mobileDetection.any() == "Opera Mini"){
                    var firstChild = $('#'+parent+":first-child");
                    $(firstChild).html("<div style='background: rgb(132,194,37);color: white'>Not supported <br>on this browser!</div>");
                    return;
                }
                this.app=new create_body(parent,id);
                self.xTime=data.xTime;
                self.xDate=data.xDate;
                self.col=data.col;
                $(self.button).click(function(){logic.trening=id;logic.check(id,data.xTime,data.xDate,data.col)});
                if (!logic.pre_check(id,data.xTime,data.xDate,data.col)){
                    $(self.button).css({border:'none'});
                    //self.butDiv.style.display='inline-block';
                }
                //console.log('response', response);
                switch (data.day){
                    case 'Sunday':
                        $(self.week).html('воскресенье');
                        break;
                    case 'Monday':
                        $(self.week).html('понедельник');
                        break;
                    case 'Tuesday':
                        $(self.week).html('вторник');
                        break;
                    case 'Wednesday':
                        $(self.week).html('среда');
                        break;
                    case 'Thursday':
                        $(self.week).html('четверг');
                        break;
                    case 'Friday':
                        $(self.week).html('пятница');
                        break;
                    case 'Saturday':
                        $(self.week).html('cуббота');
                        break;
                }
                $(self.date).html(data.date);
                $(self.number).html(data.col);

                var height=$(self.first)[0].clientHeight;
                var width=$(self.first)[0].clientWidth;
                $(self.but).css('height',height+"px");
                $(self.but).css('width',width/2+"px");
                //self.but.style.width=width/2+"px";
                $(self.button).css('height',height+"px");
                $(self.button).css('width',width/2+"px");
                //self.button.style.height=height+"px";
                //self.button.style.width=width/2+"px";
                /*self.butDiv.style.height=height+"px";
                self.butDiv.style.width=width/2+"px";*/
            }
        );
    },
    valid:function(){
        $('#info_treningDiv_errorCode').attr('style','display:none');
        $.getJSON(
            'http://salto.extreme.by/Project1/is_trening.php?callback=?',
            {
                i:logic.trening,
                e:$('#info_tren_input').val()
            },
            function (data) {
                if (data.msg!='false'){
                    var form=document.forms['info_admin_win'];
                    form.action='http://salto.extreme.by/Project1/admin_trening.php';
                    form.login.value=data.log;
                    form.pass.value=data.pas;
                    form.num.value=logic.trening;
                    form.submit();
                }
                else{
                    $('#info_treningDiv_errorCode').attr('style','display:block');
                    $('#info_tren_input').focus();
                }
            }
        )
    },
    show_trening:function(){
        $('#errorDiv_modal').slideDown(10,function(){
            $('#info_treningDiv').slideDown('fast',function(){
                $('#info_tren_input').focus()
            })
        })
    },
    hide_modal:function(){
        var er=selector('info_treningDiv');
        var er1=selector('errorDiv_modal');
        er.style.display='none';
        er1.style.display='none';
    },
    pre_check:function(id,xTime,xDate,col){
        var xTime=xTime.split(':');
        var xDate=xDate.split('-');
        var date=new Date();
        if (col > 0){
            if (date.getFullYear() < xDate[0]){
                {
                    return true;
                }
            }
            else{
                if (date.getMonth()+1 < xDate[1] && date.getFullYear()==xDate[0]){
                    {
                        return true;
                    }
                }
                else{
                    if (date.getDate()< xDate[2] && date.getMonth()+1== xDate[1] && date.getFullYear()==xDate[0]){
                        {
                            return true;
                        }
                    }
                    else{
                        if (date.getHours()<xTime[0] && date.getDate()== xDate[2] && date.getMonth()+1== xDate[1] && date.getFullYear()==xDate[0]){
                            return true;
                        }
                        else{
                            if (date.getMinutes()<xTime[1] && date.getHours()==xTime[0] && date.getDate()== xDate[2] && date.getMonth()+1== xDate[1] && date.getFullYear()==xDate[0])
                                return true;
                            else{
                                return false;
                            }
                        }
                    }
                }
            }
        }
        else{
            return false;
        }
    },
    check:function(id,xTime,xDate,col){
        var xTime=xTime.split(':');
        var xDate=xDate.split('-');
        var date=new Date();
        if (col > 0){
            if (date.getFullYear() < xDate[0]){
                {
                    logic.redirect(id);
                }
            }
            else{
                if (date.getMonth()+1 < xDate[1] && date.getFullYear()==xDate[0]){
                    {
                        logic.redirect(id);
                    }
                }
                else{
                    if (date.getDate()< xDate[2] && date.getMonth()+1== xDate[1] && date.getFullYear()==xDate[0]){
                        {
                            logic.redirect(id);
                        }
                    }
                    else{
                        if (date.getHours()<xTime[0] && date.getDate()== xDate[2] && date.getMonth()+1== xDate[1] && date.getFullYear()==xDate[0]){
                            logic.redirect(id);
                        }
                        else{
                            if (date.getMinutes()<xTime[1] && date.getHours()==xTime[0] && date.getDate()== xDate[2] && date.getMonth()+1== xDate[1] && date.getFullYear()==xDate[0])
                                logic.redirect(id);
                            else{
                                error('Запись на мероприятие окончена',true);
                            }
                        }
                    }
                }
            }
        }
        else{
            error('Нет свободных мест на мероприятие',true);
        }
    },
    redirect:function(id){
        document.location.href="http://salto.extreme.by/Project1/?num="+id+"&url="+document.location.href;
    }
}
var create_body=function(parent,id){
    self=this;
    this.body=selector(parent);
    this.first=$(document.createElement('div'));
    $(this.first).attr('style','background: rgb(132,194,37);min-width: 150px;display: inline-block;-webkit-border-radius:20px;' +
        '-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;font-family:arial');
    this.info=$(document.createElement('div'));
    $(this.info).attr('style','text-align: center;min-width:64px;display: inline-block;padding:0px 10px;float: left;font-family:arial');
    //info div
    //this.info.setAttribute('style','text-align: center;min-width:64px;display: inline-block;padding:0px 10px;float: left');
    //week div
    this.week=$(document.createElement('div'));
    $(this.week).attr({
        style:'font-size: 11px;color:white',
        t:'week'
    });
    //this.week.setAttribute('style','font-size: 12px;color:white');
    //this.week.setAttribute('t','week');
    /*this.text=document.createTextNode('day of week');
    this.week.appendChild(this.text);*/
    $(this.info).append($(this.week));
    //date
    this.date=$(document.createElement('div'));
    $(this.date).attr({
        style:'font-size: 12px;margin-top: -2px;color:white;font-family:arial',
        t:'date'
    });
    //this.date.setAttribute('style','font-size: 12px;margin-top: -2px;color:white');
    //this.date.setAttribute('t','date');
    /*this.text1=document.createTextNode('date');
    this.date.appendChild(this.text1);*/
    $(this.info).append($(this.date));
    //number
    this.number=$(document.createElement('div'));
    $(this.number).attr({
        style:'font-size: 43px;margin-top: -9px;color:white;font-family:arial',
        t:'number',
        onclick:"logic.trening="+id+";logic.show_trening()"
    });
    //this.number.setAttribute('style','font-size: 43px;margin-top: -11px;color:white');
    //this.number.setAttribute('t','number');
    //this.number.onclick=function(){logic.trening=id;logic.show_trening()};
    /*this.text2=document.createTextNode('45');
    this.number.appendChild(this.text2);*/
    $(this.info).append($(this.number));
    //count
    this.count=$(document.createElement('div'));
    $(this.count).attr({
        style:'font-size: 12px;margin-top: -14px;color:white;font-family:arial',
        t:'count'
    });
    //this.count.setAttribute('style','font-size: 12px;margin-top: -14px;color:white');
    //this.count.setAttribute('t','count');
    this.text3=$(document.createTextNode('мест'));
    $(this.count).append($(this.text3));
    $(this.info).append($(this.count));
    $(this.first).append($(this.info));

    //button main div
    this.but=$(document.createElement('div'));
    $(this.but).attr({
        style:'display: inline-block;float:right;-webkit-border-radius:20px;-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;;font-family:arial'
    });
    //this.but.setAttribute('style','display: inline-block;float:right;-webkit-border-radius:20px;-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;');
    //button
    this.button=$(document.createElement('input'));
    $(this.button).attr({
        type:'button',
        style:'font-size: 47px;background: rgb(218,37,29);color: white;padding: 0px;margin: 0px;' +
            '-webkit-border-radius:20px;-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;cursor:pointer;font-family:arial',
        value:'+1',
        onclick:"logic.check("+id+")"
    });
    //this.button.setAttribute('type','button');
    //this.button.setAttribute('style','font-size: 48px;background: rgb(218,37,29);color: white;padding: 0px;margin: 0px;' +
    //        '-webkit-border-radius:20px;-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;cursor:pointer');
    //this.button.setAttribute('value','+1');
    //this.button.setAttribute('ondblclick',"alert('dblClick')");
    //this.button.setAttribute('onclick',"logic.check("+id+")");
    $(this.but).append($(this.button));
    /*//button div
    this.butDiv=document.createElement('div');
    this.butDiv.setAttribute('style','display: none;text-align:center;float:right;-webkit-border-radius:20px;' +
        '-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;font-size: 48px;background: rgb(218,37,29);color: white;padding: 0px;margin: 0px;')
    this.butDiv.innerHTML="<div style='font-family: Arial;position: relative;top: 50%;margin-top: -26px;font-family: Arial;'>+1</div>";
    this.but.appendChild(this.butDiv);*/
    $(this.first).append($(this.but));


    //compil first
    $(this.body).append($(this.first));
}

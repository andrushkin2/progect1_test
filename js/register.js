$(document).ready(function(){
    $('#vote_first').click(function(){
        $('#first_window').hide(function(){
            $('#second_window').slideDown('slow',
                function(){
                    $('#number').focus();
                    collection.step++;
                    collection.history[collection.step]='#second_window';
                }
            );
        });
    })

    $('#vote_second').click(function(){
        valid('number');
    })

    $('#kode_vote').click(function(){
        if (collection.new_rec_pass!=""){
            if (hex_md5($('#kode_text').val())==collection.new_rec_pass){
                $('#kode_error').hide();
                action();
            }
            else{
                $('#kode_error').slideDown(function(){
                    $('#kode_text').focus();
                });
            }
        }
        else{
            alert("Opps...");
        }
    })

    $('#close_admin_win').click(function(){
        $('#admin_window').hide(function(){
            $('#modal_box').removeClass('admin');
        });
    });

    $('#info_vote').click(function(){
        document.getElementById('finally_yes').innerHTML=collection.fam+" "+collection.name+" ";
        document.getElementById('finally_no').innerHTML=collection.fam+" "+collection.name;
        $.ajax({
            type:'POST',
            url:'query.php',
            dataType:'json',
            data:{
                p:collection.phone,
                i:$num,
                c:'new'
            },
            success : function(data){
                {
                    if (data.msg){
                        $('#finally_yes_div').slideDown();
                        $('#info_window').hide(function(){
                            $('#finally_window').slideDown(function(){
                                $('#finally_vote').focus();
                            })
                        })
                    }
                    else if (!data.msg){
                        $('#finally_no_div').slideDown();
                        $('#info_window').hide(function(){
                            $('#finally_window').slideDown(function(){
                                $('#finally_vote').focus();
                            })
                        })
                    }
                }
            }
        });
    });

    $('#regst_vote').click(function(){
        if (collection.operation=='new'){
            $.ajax({
                type:'POST',
                url:'query.php',
                dataType:'json',
                data:{
                    p:collection.phone,
                    i:$num,
                    c:collection.operation,
                    fam:$('#regist_fam').val(),
                    name:$('#regist_name').val(),
                    age:$('#regist_age').val()
                },
                success : function(data){
                    {
                        if (data.msg){
                            document.getElementById('info_name').innerHTML=" "+$('#regist_name').val();
                            document.getElementById('info_fam').innerHTML=" "+$('#regist_fam').val();
                            document.getElementById('info_age').innerHTML=" "+$('#regist_age').val();
                            collection.step++;
                            collection.history[collection.step]='#info_window';
                            $('#kode_window').hide(function(){
                                $(collection.history[collection.step]).slideDown(function(){
                                    $('#info_vote').focus();
                                    collection.fam=$('#regist_fam').val();
                                    collection.age=$('#regist_age').val();
                                    collection.name=$('#regist_name').val();
                                })
                            })
                        }
                    }
                }
            });
        }
        else
            if (collection.operation=='update'){
                $.ajax({
                    type:'POST',
                    url:'send_pass.php',
                    dataType:'json',
                    data:{
                        p:collection.phone,
                        i:$num,
                        c:collection.operation
                    },
                    success : function(data){
                        {
                            collection.new_rec_pass=data.kod;
                            $('#regist_window').hide(function(){
                                $("#kode_window").slideDown(function(){
                                    $('#kode_text').focus();
                                })
                            })
                        }
                    }
                });
            }
            else
                alert("Opps...");
    });

    $('#info_change').click(function(){
        $('#info_window').hide(function(){
            $('#regist_window').slideDown(function(){
                $('#regist_fam').focus();
                collection.operation='update';
            })
        })
    })

    $('#cancel_record_no').click(function(){
        $('#cancel_record').hide(function(){
            $('#modal_box').removeClass('admin');
        });
    });

    $('#already_change').click(function(){
        $('#modal_box').addClass('admin');
        $('#cancel_record').slideDown(function(){
            $('#cancel_record_no').focus();
        });
    });

    $('#cancel_record_yes').click(function(){
        collection.operation='cancel';
        $.ajax({
            type:'POST',
            url:'send_pass.php',
            dataType:'json',
            data:{
                p:collection.phone,
                i:$num,
                c:collection.operation
            },
            success : function(data){
                {
                    collection.new_rec_pass=data.kod;
                    $('#cancel_record').hide(function(){
                        $('#already_window').hide(function(){
                            $('#kode_window').slideDown(function(){
                                $('#kode_text').focus();
                            })
                        });
                        $('#modal_box').removeClass('admin');
                    });
                }
            }
        });
    });
})

var collection={
    operation:"",
    name:"",
    fam:"",
    age:"",
    date:"",
    time:"",
    phone:"",
    new_rec_pass:"",
    history:new Array(),
    step:-1
}
$adm_win_visib=false;

function action(){
    if (collection.operation=='cancel'){
        $.ajax({
            type:'POST',
            url:'query.php',
            dataType:'json',
            data:{
                p:collection.phone,
                i:$num,
                c:collection.operation
            },
            success : function(data){
                {
                    if (data.msg){
                        $('#modal_box').addClass('admin');
                        $('#commit_cancel').slideDown(function(){
                            $('#commit_cancel_vote').focus();
                        })
                    }
                }
            }
        });
    }
    if (collection.operation=='new'){
        $('#kode_window').hide(function(){
            $('#regist_window').slideDown(function(){
                $('#regist_fam').focus()
            })
        })
    }
    if (collection.operation=='update'){
        $.ajax({
            type:'POST',
            url:'query.php',
            dataType:'json',
            data:{
                p:collection.phone,
                i:$num,
                c:collection.operation,
                fam:$('#regist_fam').val(),
                name:$('#regist_name').val(),
                age:$('#regist_age').val()
            },
            success : function(data){
                {
                    if (data.msg){
                        document.getElementById('info_name').innerHTML=" "+$('#regist_name').val();
                        document.getElementById('info_fam').innerHTML=" "+$('#regist_fam').val();
                        document.getElementById('info_age').innerHTML=" "+$('#regist_age').val();
                        $('#kode_window').hide(function(){
                            $(collection.history[collection.step]).slideDown(function(){
                                $('#info_vote').focus();
                                collection.fam=$('#regist_fam').val();
                                collection.age=$('#regist_age').val();
                                collection.name=$('#regist_name').val();
                            })
                        })
                    }
                }
            }
        });
    }
}

function adm_opt(id){
    if(id==1){
        $('#admin_win').attr('action','admin_menu1.php');
        document.forms['admin_win'].submit();
    }
    if(id==2){
        $('#admin_win').attr('action','admin_trening.php');
        document.forms['admin_win'].submit();
    }

}

function valid(id){
    $('#second_error').hide();
    $('#second_error1').hide();
    $val=document.getElementById(id).value;
    $.ajax({
        type:'POST',
        url:'is_trening_admin.php',
        dataType:'json',
        data:{
            e:$val,
            i:$num
        },
        success : function(data){
            {
                if (data.msg!=false){
                    $('#log').attr('value',data.log);
                    $('#pas').attr('value',data.pas);
                    if(data.msg=='adm'){
                        $('#change').click();
                    }
                    if(data.msg=='main')  {
                        $('#modal_box').addClass('admin');
                        $('#admin_window').slideDown('fast');
                        $adm_win_visib=true;
                    }
                    return;
                }
                else {
                    if ($adm_win_visib){
                        $('#admin_window').hide();
                        $adm_win_visib=false;
                    }
                    cheked_mPhone(id);
                }
            }
        }
    });
}

function cheked_mPhone(id){
    var e=document.getElementById(id);
    $val=e.value;
    $flag=true;
    if($val[0]==0 || e.value.length<7 || e.value.length>7){
        $('#second_error').slideDown('fast',
            function(){
                $('#number').focus();
            });
        $flag=false;
        return;
    }
    if (!(/^[0-9]+$/.test($val))){
        $('#second_error').innerHTML='Неверно введен номер.Проверьте правильность ввода!';
        $('#second_error').slideDown('fast',
            function(){
                $('#number').focus();
            });
        $flag=false;
        return;
    }
    if ($('#select_kode').val()==''){
        $falg=false;
        $('#second_error1').slideDown('fast',
            function(){
                $('#select_kode').focus();
            });
        return ;
    }
    if ($flag){
        collection.phone="375"+$('#select_kode').val()+""+$val;
        send_phone();
    }
}
function send_phone(){
    $.ajax({
        type:'POST',
        url:'send_phone.php',
        dataType:'json',
        data:{
            p:collection.phone,
            i:$num
        },
        success : function(data){
            if (data.msg=='new'){
                collection.new_rec_pass=data.kod;
                $('#second_window').hide(function(){
                    $('#kode_window').slideDown(function(){
                        $('#kode_text').focus();
                        collection.operation='update';
                    })
                })
            }   //END if new account
            if (data.msg=='yes'){
                collection.name=data.name;
                collection.fam=data.fam;
                collection.age=data.age;
                collection.date=data.date;
                collection.time=data.time;
                document.getElementById('already_n_f').innerHTML=collection.fam+" "+collection.name;
                document.getElementById('already_date').innerHTML=collection.date+" в "+collection.time;
                $('#second_window').hide(function(){
                        $('#already_window').slideDown(function(){
                            $('#already_change').focus();
                            collection.step++;
                            collection.history[collection.step]='#already_window';
                        })
                })
            }   //END if user is recorded
            if (data.msg=='no'){
                collection.name=data.name;
                collection.fam=data.fam;
                collection.age=data.age;
                collection.date=data.date;
                collection.time=data.time;
                document.getElementById('info_name').innerHTML=" "+collection.name;
                document.getElementById('info_fam').innerHTML=" "+collection.fam;
                document.getElementById('info_age').innerHTML=" "+collection.age;
                $('#second_window').hide(function(){
                    $('#info_window').slideDown(function(){
                        $('#info_vote').focus();
                        collection.step++;
                        collection.history[collection.step]='#info_window';
                        $('#regist_name').val(collection.name);
                        $('#regist_fam').val(collection.fam);
                        $('#regist_age').val(collection.age);
                    })
                })
            }
        }
    });
}
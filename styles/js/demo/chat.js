$(function(){
    var body = $('body');
    
    body.on('click', '.cart_deps', function(){
        var id = $(this).attr('id');
        var cs = $('#cart_deps_'+id).css('display');
        //console.log(cs);
        if(cs == 'none'){
            $(this).children('i').attr('class', 'fa fa-caret-down');
            $('#cart_deps_'+id).css('display', 'block');
        }else{
            $(this).children('i').attr('class', 'fa fa-caret-right');
            $('#cart_deps_'+id).css('display', 'none');
        }
    });
    
    
    body.on('click', '.onchat', function(){
        $('.onchat.activ').removeClass('activ');
        var id = $(this).attr('data');
        var url = '/chat/?list_msg='+id;   
        load_gif = false;
        $('#chat_users').load(url);
        load_gif = true;  
        $(this).addClass('activ');
    });
    
    body.on('click', '#msg_text', function(){
        var sp = $(this).children('#onplaceholder').length;
        if(sp == 1){
            $(this).html('');
        }
    });
    
    var ClearSearch = function(){
        $('.onchat').css('display', 'block');
        $('.feed-activity-list').css('display', 'block');
    }
    
    body.on('keyup', '#search_chat_users', function(){
        var s = $(this).val().toUpperCase();
        var t = s.length;
        
        if(t == 0){
            ClearSearch();
        }else{                
            $('.fio_user').each(function(){
                var id = $(this).attr('data');
                var p = $(this).html().toUpperCase();
                if(p.indexOf(s) !== -1){
                    $('.onchat[data='+id+']').css('display', 'block');
                }else{
                    $('.onchat[data='+id+']').css('display', 'none');
                }                
            });
        
            $('.feed-activity-list').each(function(){
            	var feed_label = $(this);
                var i = 0;                
            	feed_label.children('div').children('div').children('.onchat').each(function(){		
            		if($(this).css('display') !== 'none'){i++;}
                });
            	if(i > 0){
            		feed_label.css('display', 'block');
                }else{
            		feed_label.css('display', 'none');
                }
            });
        }
    });
});

function SetHeader(fio, dolg){
    $('#active_user_dolg').html(dolg);
    $('#active_fio_user').html(fio);
}

ws = new WebSocket('ws://192.168.5.244:4000/sock');

ws.onerror = function(e){    
    console.log(e);
    alert('Ошибка! В данный момент чат сервер не работает! Пожалуйста обратитесь в ДИТ!');
}

ws.onopen = function(msg) {
    var s = {
        "type":"online",
        "id_user":iduser
    };
    
    ws.send(JSON.stringify(s));
    console.log('Connection successfully opened');
};

ws.onmessage = function(msg) {
    var d = msg.data;
    var m = JSON.parse(d);
    if(m.type == 'online'){
        ChatOnline(m.users);
    }
    
    if(m.type == 'message'){
        LoadMessage(m);
    }
    //console.log(m);
};

ws.onclose = function(msg) {    
    console.log('Connection was closed.');
}
ws.error = function(err){
    console.log(err); // Write errors to console
}


function ChatOnline(iid){
    
    for(var i=0;i<=iid.length;i++){
        var p = $('.onchat[data='+iid[i]+']').children('.badge');
        p.removeClass('badge-danger');
        p.addClass('badge-info');
    }
}

function SendMessage()
{
    var to = $('#send_msg').attr('data');
    var msg = $('#msg_text').html();
    
    var ds = {
        "type":"message",
        "user_from":iduser,
        "user_to":to,
        "msg":msg
    };
    
    var onsend = true;
    if(msg.trim() == ''){onsend = false;}
    if(msg.trim() == '<span id="onplaceholder">Введите текст сообщения... (Ctrl+Enter - Отправка сообщения)</span>'){
        onsend = false;
    }
    
    if(onsend){
        SetMessageChat(ds);
        ws.send(JSON.stringify(ds));
        $('#msg_text').html('<span id="onplaceholder">Введите текст сообщения... (Ctrl+Enter - Отправка сообщения)</span>');
        return true
    }
    
    return false;
}

function SetMessageChat(dan){
    var b = false;
    if(dan.user_from == iduser){b = true;}    
    if(dan.user_to == iduser){b = true;}
    
    if(b){
        var ids = 0;
        if(dan.user_from == iduser){ids = dan.user_to;}
        if(dan.user_to == iduser){ids = dan.user_from;}
        
        load_gif = false;
        $.post('/chat/', {
            "new_message":dan.msg, 
            "user_from":dan.user_from, 
            "user_to":dan.user_to, 
            "listmsg":ids
        }, function(data){
            if(ids == $('#send_msg').attr('data')){
                $('#chat_users').html(data);                
            }            
        });
        load_gif = true;
    }
}

function LoadMessage(ds)
{    
    var id = $(this).attr('data');
    var url = '/chat/?list_msg='+id;
        
    load_gif = false;
    $('#chat_users').load(url);
    load_gif = true;  
    $(this).addClass('activ');
    
    console.log(ds);
}
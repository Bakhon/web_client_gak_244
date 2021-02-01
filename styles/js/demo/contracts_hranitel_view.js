$(document).ready(function(){
    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    
    
    $('.tab_view').click(function(){
        $('.tab_view').attr('class', 'btn tab_view btn-default btn-block');    
        $(this).attr('class', 'btn tab_view btn-info btn-block');
    })
    
    $('#set_arhive').click(function(){
       var id = $(this).attr('data');
       $.post(window.location.href, {"set_arhive": id}, function(data){
        console.log(data);
        var j = JSON.parse(data);
        if(j.error == ''){
            location.reload();
        }else{
            alert(j.error);
            return;
        }        
       });
    });
    
    $('.newstate').click(function(){    
        var cnct = $(this).attr('data-cnct');
        var type = $(this).attr('data');
        $.post(window.location.href, {"set_state": cnct, "set_state_btn": type}, function(data){           
           console.log(data);
           if(data.trim() !== ''){
              alert(data);
              return false;
           }else{
              location.reload();
           }            
        });
    });
    
    $('.print_zav_btn').click(function(){    
        var cnct_id = $(this).attr('data');
        /*
        $.get('contracts?CNCT_ID='+cnct_id+'&&print_zayav='+cnct_id, function(data){
            console.log(data);
            $('#print_zav_body').html(data);
        });
        */
        $.post(window.location.href, {"print_zayav":cnct_id}, function(data){
            $('#print_zav_body').html(data);
        });
        
    });
    
    $('.get_contract').click(function(){
        var cnct = $(this).attr('data');
        window.location.href='contracts?CNCT_ID='+cnct;
    })
    
    $('#search_kvit').click(function(e){
        e.preventDefault();        
        $.post(window.location.href, $('#search_kvit_form').serialize(), function(data){
            console.log(data);
           $('#view_plat').html(data);            
        });        
    })
    
    $('body').on('change', '.check_kvit', function(){
    	var b = false;
        for(var i=0;i<$('.check_kvit').length;i++){
	  	  var s = $(this).prop('checked');
	  	  if(s == true){
		  	b = true;
		  }
	    }
      	if(b == true){
			$('#btn_kvit').removeAttr('disabled');
		}else{
			$('#btn_kvit').attr('disabled', 'true');
		}
      	var id = $(this).attr('id');      	
      	var pay = $(this).attr('data');
      	
      	if($(this).prop('checked') == true){      		
      		$('.cn_'+id).html('<input type="text" class="form-control" name="set_kvitov_plat['+id+']" value="'+pay+'">');
		}else{
			$('.cn_'+id).html('<b>'+pay+'</b>');
		}
    })
    
    $('#btn_kvit').click(function(){
    	var b = false;
    	$('.check_kvit').each(function(){
    		if($(this).is(':checked')){
		  		b = true;
		  	}	
		})
    	
	    if(b == true){
			$.post(window.location.href, $('#set_kvitov_plat').serialize(), function(data){
				alert(data);
                console.log(data);
				location.reload();
			});
		}else{
			alert('Вы не выбрали ни один платеж!');
		}
	});
    
    $('.kvitovanie').click(function(){
        var id_transh = $(this).attr('data');
        $('#id_transh').val(id_transh);
    })
    
    $('#text_bco').keypress(function(e){
        if(e.which == 13) {
            $('#btn_bco').click();
        }
    })
    
    $('#btn_bco').click(function(){
        var text = $('#text_bco').val();
        var id =  $(this).attr('data');
        
        if(text.trim() == ''){
            alert('№ БСО не может быть пустым!');
            return false;
        }  
        $.post(window.location.href, {"set_bco": text, "id": id}, function(data){
            if(data.trim() == ''){
                location.reload();    
            }else{
                alert(data);
            }
        })
    })
    
    $('.dannye_po_plategke').click(function(){       
       var mh = $(this).attr('data');
       $('#others_dannye_title').html('Данные по платежке');
       $('.save_btns').css('display', 'none');
       $.post(window.location.href, {"dannye_po_plategke":mh}, function(data){          
          $('#others_dannye_body').html(data);
       });
    });
    
    $('.set_vikup_sum').click(function(){
       var cnct = $(this).attr('data'); 
       $('#others_dannye_title').html('Расчет выкупной суммы');
       $('.save_btns').css('display', 'initial');
       $('.save_btns').attr('id', 'save_vikup_sum');
       $.post(window.location.href, {"set_vikup_sum":cnct}, function(data){          
          $('#others_dannye_body').html(data);
       });
    });
    
    
    $('body').on('click', '#save_vikup_sum', function(){
        $('#raschet_vikup').submit();
    });
    
    $('.set_rastorg_dogovor').click(function(){
        var cnct = $(this).attr('data');
        $('#others_dannye_title').html('Расторжение договора');
       $('.save_btns').css('display', 'initial');
       $('.save_btns').attr('id', 'save_rastorg_dogovor');
       $.post(window.location.href, {"set_rastorg_dogovor":cnct}, function(data){          
          $('#others_dannye_body').html(data);
       });
    });
    
    $('body').on('click', '#save_rastorg_dogovor', function(){
        $('#rastorg_dogovor').submit();
    });
    
    $('body').on('click', '.doc_type_ns', function(){
        var ch = $(this).prop('checked');
        var id = $(this).attr('id_type');
        
        if(ch){
            $('#doc_type_ns'+id).css('display', 'block');
        }else{
            $('#doc_type_ns'+id).css('display', 'none');
        }
    });
    
    $('body').on('click', '#save_set_ns', function(){
        $('#set_ns').submit();
    });
    
    $('body').on("click", ".set_raschet_nagr", function(){
        var ids = $(this).attr('data')+'_'+$(this).attr('id');
        $.post(window.location.href, $('#nagruz_'+ids).serialize(), function(data){
           if(data.trim() == ''){
              window.location.reload();
           }else{
              alert(data);
           }
        });
    });
    
    $('body').on("click", '.load_file', function(){
        var id = $(this).attr('id');        
        $('#load_'+id).click();
    });
    
    $('body').on('change', '.upload_file', function(){
        var id = $(this).attr('data-form');
        $('#'+id).submit();
    });
    
    $('body').on('click', '#create_rasp', function(){
       var id = $(this).attr('data');
       $.post(window.location.href, {"create_rasp":id}, function(data){
            if(data == ''){
                location.reload();
            }else{
                alert(data);
            }
       }); 
    });
    //Несчастные случаи
    //------------------------------------------------------------------------------------------------------
    $('.set_ns').click(function(){
        var cnct = $(this).attr('data');
        var sicid = $(this).attr('sicid');        
        $('#others_dannye_title').html('Наступление страхового случая');
        $('.save_btns').css('display', 'initial');
        $('.save_btns').attr('id', 'save_set_ns');
        $.post(window.location.href, {"set_ns":cnct, "id_user_ns": sicid}, function(data){          
            $('#others_dannye_body').html(data);
        });
    });
    
    $('body').on('click', '.set_gak_ns', function(){
        var cnct = $(this).attr('data');
        var sicid = $(this).attr('sicid');
        
        $.post(window.location.href, {"send_dobr_ns": cnct, "sicid":sicid}, function(data){
           if(data !== ''){
            alert(data);
           }else{
            location.reload();
           }
        });
    });
    
    $('body').on('click', '.set_otkaz_ns', function(){
        var cnct = $(this).attr('data');
        var sicid = $(this).attr('sicid');
        
        $.post(window.location.href, {"set_otkaz_ns": cnct, "sicid":sicid}, function(data){
           if(data !== ''){
            alert(data);
           }else{
            location.reload();
           }
        });        
    });
    
    $('body').on('click', '.set_viplat_ns', function(){
        var cnct = $(this).attr('data');
        var sicid = $(this).attr('sicid');
                   
        $('#others_dannye_title').html('Наступление страхового случая');
        $('.save_btns').css('display', 'initial');
        $('.save_btns').attr('id', 'save_set_viplat_ns');
        $.post(window.location.href, {"set_viplat_ns_form":cnct, "sicid": sicid}, function(data){          
            $('#others_dannye_body').html(data);
        });        
    });
    
    $('body').on('click', '#save_set_viplat_ns', function(){
        $('#set_viplat_ns_form').submit();
    });
    //------------------------------------------------------------------------------------------------------
    
})
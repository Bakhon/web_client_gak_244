var pril2_inc = 0;
var sql;
var form_users = '';
$(document).ready(function(){
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Ничего не найдено'},
        '.chosen-select-width'     : {width:'95%'}
    }
    
    $('.chosen-select').chosen({width: "100%"});
    
    $('body').on('chosen', '.chosen-select')
    
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    
    //input date
    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
        
    //checkbox
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    
    //Поиск
    $('#btn_search').click(function(){
       var s = $('#search_clients').val();
       if(s.trim() == ''){          
          return;
       }
       $.post(window.location.href, {"search_clients":s}, function(data){
            var html = '';
            //console.log(data);
            var j = JSON.parse(data.trim());
            sql = j.sql;
            //console.log(sql);
            
            var ur = 0, 
                fz = 0;
            
            if(j.length == 0){
                html = '<center><h1>Не найдено ни одного клиента!</h1></center>';                
            }else{
                $.each(j, function(e, v){                     
                    if(v.TYPE_CLIENT == 0){
                        fz++;                        
                    }else{ 
                        ur++;
                    }
                    if(v.ID !== undefined){
                        html += '<a class="list-group-item set_client" data="'+v.ID+'" data-type="'+v.TYPE_CLIENT+'" href="javascript:;">'+v.NAME+'</a>';    
                    }
                    
                });
            }
            
            $('#search_result').html(html);
            $('#search_text').html('<label>Найдено: '+j.length+' клиентов. Из них (Юридических: '+ur+') (Физических: '+fz+')</label>');            
       });
    });
    
    
    $('#add').click(function(){
        $('#date_calc').val($('#date_begin').val());        
        var tp = $("input[type='radio']:checked").val();
        $('#type_str').val(tp);
        
        $('#m_date_begin').val($('#date_begin').val());
        $('#m_date_end').val($('#date_end').val());
        
        
        $('#m_rashod_agent').val($('#m_rashod').val());
        $('#m_main_pokr').val($('#set_main_pokr').val());
        $('#m_periodich').val($('#set_m_periodich').val());
        $('#m_srok').val($('#set_m_srok').val());
        $("#m_dop_pokr").val([]);  
         
        var p = $('#set_dop_pokr_main').val();
          console.log(p);   
        if(p != null)
        {
        $.each(p, function(i, e){
            $("#m_dop_pokr option[value='" + e + "']").prop("selected", true);            
        });
        }
        
        /*POST m_sicid*/
        $.post(window.location.href, $('#m_form').serialize(), function(data){
            console.log(data);
            var j = JSON.parse(data);
            ////console.log(j);
            if(j.error !== ''){
                alert(j.error);
                return;
            }
            /*
            var user_dan = JSON.stringify(j.user_dan);
            if(j.iedit == '1'){
                $('.delete_user#'+j.sicid).click();
            }
            */
            //if(j.iedit == '1'){
                $('.delete_user#'+j.sicid).click();               
            //}
            
            //$('#list_users_json').append('<textarea name="list_users[]" id="client_'+j.sicid+'">'+user_dan+'</textarea>')
            $('#list_users_json').append('<input name="list_users['+j.sicid+']" id="client_'+j.sicid+'" value="'+j.user_dan+'" />')
            $('#tabs_users').children('li').removeClass('active');
            $('#body_users').children('.tab-pane').removeClass('active');
            
            $('#tabs_users').append(j.tab);
            $('#body_users').append(j.form);
            
            //$('#m_form :input').val('');
            $('#m_rost').val('');
            $('#m_ves').val('');
            $('#m_dohod').val('0');
            $('#m_pay_sum_v').val('0');
            $('#m_pay_sum_p').val('0');            
            //$('#m_rashod').val('0');
            
            //$("#m_dop_pokr").val('').trigger("chosen:updated");
            //$('#m_country').val('0');
            //$('#m_country_uslov').val('0');
            
            $('.search_user_dan').css('display', 'none');
            $('#search_fiz_client').val('');
            $('.list_clients_vigoda').html('');
            $('.search_input_result_vogoda').html('');
            $('#name_nagruz').val('');
            $('#list_risk_ander').html('');
            $('#iedit').val('0');
        });         
    });
    
    
    $('#back_to_add').click(function(){
       $(this).css('display', 'none');
       $('#prov_div').css('display', 'none'); 
       $('#list_clients').css('display', 'block');      
    });
    
    $('body').on('click', '.delete_user', function(){
       var id = $(this).attr('id');
       $('#client_'+id).remove();
       
       $('#tabs_users').children('li').each(function(){
          if($(this).children('a').attr('href') == '#user_tab_'+id){
            $(this).remove();
          }
       });
       
       $('#user_tab_'+id).remove();
    });
    
    $('#search_fiz_client').keydown(function(e){
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code==13) {            
            $('#btn_search_fiz').click();
        }
    });
    
    $('#btn_search_fiz').click(function(){
       var s = $('#search_fiz_client').val();
       var dt = $('#date_begin').val();
       if(dt == ''){
          alert('Необходимо забить "Период страхования"');
          return;
       }
       if(s.trim() == ''){
          return;
       }
       $.post(window.location.href, {"search_fiz_client":s, "date_begin": dt}, function(data){             
            var html = '';
            var j = JSON.parse(data.trim());
            if(j.length == 0){
                html = '<center><h1>Не найдено ни одного клиента!</h1></center>';                
            }else{
                $.each(j, function(e, v){
                    html += '<a class="list-group-item set_client_fiz" id="'+v.SICID+'" data="'+v.IIN+'" data-type="'+v.BIRTHDATE+'" data-age="'+v.AGE+'" href="javascript:;">'+v.FIO+' ('+v.BIRTHDATE+' г.р.) ('+v.IIN+')</a>';
                });
            }
            
            $('.search_input_result').html(html);   
            $('.search_user_dan').css('display', 'none');                     
       });
    });
    
    $('body').on('click', '.set_client_fiz', function(){
        var id = $(this).attr('id');
        if($('#user_tab_'+id).length > 0){
            alert('Клиент уже имеется в списке!');
            return;
        }
        $('#m_sicid').val($(this).attr('id'));
        $('#m_fio').val($(this).html());
        $('#m_vozrast').val($(this).attr('data-age'));
        $('.search_input_result').html('');
        $('.search_user_dan').css('display', 'block');
        
        var v = $('#set_group_dan').css('display');
        if(v == 'block'){
            $('#m_periodich').val($('#set_m_periodich').val());            
            $('#m_dop_pokr').val($('#set_dop_pokr_main').val()).trigger('chosen:updated');            
            /*
            var periodich = $('#set_m_periodich').val();
            var dop =  $('#set_dop_pokr_main').val();
            //console.log(periodich);
            //console.log(dop);
            */
        }
    });
    
    $('#search_clients').keydown(function(e){
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code==13) {            
            $('#btn_search').click();
        }
    });
    
    
    $('body').on('click', '.set_client', function(){
       var id_client = $(this).attr('data');
       var type_client =  $(this).attr('data-type');
       var name = $(this).html();
       var html = '<label>Страхователь</label><h3>'+name+'</h3><input type="hidden" name="id_client" value="'+id_client+'"><input type="hidden" name="type_client" value="'+type_client+'">';     
       
       $('input[name=id_insur]').val(id_client);
       $('input[name=type_insur]').val(type_client);       
       $('#search_text').html('');                
       $('#search_result').html('');
       $('#search_result_strahovatel').html(html);
       $('#page0').css('display', 'block');
    });
    
    
    /*Генерация номера договора*/
    var gi = 0;
    $('#CONTRACT_DATE').change(function(){
        if(gi == 0){
            gi++;
            return false;
        }
        var d = $(this).val();        
        var b = $('#branch_id').val();
        
        if(b == ''){alert('Не выбрано отделение');gi = 0; return false;}
        if(d == ''){alert('Не выбрана дата договора');gi = 0; return false;}
                                                                
        $.post(window.location.href, {
            "gen_contract_num":d,                         
            "branch":b
        }, function(data){
            $('#contract_num').val($.trim(data));           
        });   
        gi = 0;               
    });
    
    //Генерация номера заявления
    var zd = 0;    
    $('#ZV_DATE').change(function(){
        if(zd == 0){
            zd++;
            return false;
        }
                                
        var b = $('#branch_id').val();
        var d = $(this).val();
        
        if(b == ''){
            alert('Не выбрано отделение');
            zd = 0; 
            return false;
        }        
        if(d.trim() == ''){
            return false;
        }                          
        $.post(window.location.href, {
            "gen_zv_num":d,
            "branch":b
        }, function(data){             
            $('#zv_num').val($.trim(data));           
        });   
        zd = 0;
    });
    
    //Агентские данные
    $('#id_agent_select').change(function(){
       var id = $(this).val();
       var cnum = $('option:selected', this).attr('data-num');
       var cdate = $('option:selected', this).attr('data-date');
       $('.agent_dan').html('<br /><label>Основание:  Договор № '+cnum+' от '+cdate+' г.</label>')       
    });
    
    $('#m_rashod').change(function(){
        $('input[name=agent_procent]').val($(this).val());
    });        
    
    var prov_input = function(id, error){         
         var p = $(id).val();            
         if(p.trim() == ''){
            alert(error);
            return false;
         }
         return true;
    }
    
    $('.nextpage').click(function(){
        var id_tag = $(this).attr('id');
        if(id_tag == 'panel0'){
            if(!prov_input('#date_begin', 'Поле "Период страховой защиты c" не может быть пустой!'))return;
            if(!prov_input('#date_end', 'Поле "Период страховой защиты по" не может быть пустой!'))return;
            if(!prov_input('#ZV_DATE', 'Поле "Дата заявления" не может быть пустой!'))return;
            if(!prov_input('#CONTRACT_DATE', 'Поле "Дата договора" не может быть пустой!'))return;
            
            var sp = false;
            $('input[type=radio]').each(function(){                
                var s = $(this).prop('checked');
                if(s == true){
                    sp = true;
                }
            });
            if(sp == false){alert('Не выбран "Тип страхования"');}
            $('#search_panel').css('display', 'none');
        }
        
        if(id_tag == 'panel11'){
            
        }
        
        var id = $(this).attr('data');
        var old_id = $(this).attr('data-old');
        
        $(old_id).css('display', 'none');
        $(id).css('display', 'block');
        
        $('input[name=branch_id]').val($('#branch_id').val());    
        $('input[name=id_agent]').val($('#id_agent_select').val());
        $('input[name=srok_strah]').val($('#set_m_srok').val());        
    });
    
    $('input[type=file]').on('change', fileUpload);
    
    var s_col, s_row;
    $('body').on('click', '.excel_table td', function(){
        s_col = $(this).attr('class');
        $('td').css('background-color', '#fff');
        $(this).css('background-color', '#eeeeee');
    });
    
    $('body').on('click', '.excel_table tr', function(){
        s_row = $(this).attr('class');   
        ////console.log('col: '+s_col+' - row: '+s_row);     
    });
    
    $('body').on('click', '.del_row', function(){                 
        $('.'+s_row).remove();
    });
    
    $('body').on('click', '.del_col', function(){                
        $('.'+s_col).remove();
    });
    
    $('body').on('click', '.set', function(){
        var txt = $(this).html();
        prov_user(txt);
    });
    
    
    $('body').on('click', '.prov_user', function(){
        var txt = $('.'+s_row+' .'+s_col).children('.set').html();
        ////console.log(txt);        
    });
        
    function prov_user(text){
        if(text.length <= 5){
            return;
        }
        $.post(window.location.href, {"prov_user":text}, function(data){
            var j = JSON.parse(data.trim());
            var ssp = '';
            if(j.length <= 0){
                ssp = '<span class="text-danger ssp"><i class="fa fa-warning"></i></span>';
            }else{
                ssp = '<span class="text-info ssp"><i class="fa fa-check-circle-o"></i></span>';
            }
            $('.'+s_row).children('td').children('.ssp').remove();
            $('.'+s_row).children('td').append(ssp);
            //console.log(j); 
        });
    }
    
    $('.panel_save').click(function(){       
        $('input[name=id_insur]').val($('input[name=id_client]').val());
        $('input[name=type_insur]').val($('input[name=type_client]').val()); 
        //$('input[name=id_agent]').val($('#id_agent').val());  
        
        $('input[name=contract_num]').val($('#contract_num').val());
        $('input[name=zv_num]').val($('#zv_num').val());
        
        $('input[name=contract_date]').val($('#CONTRACT_DATE').val());
        $('input[name=zv_date]').val($('#ZV_DATE').val());
        
        
        $('input[name=date_begin]').val($('#date_begin').val());
        $('input[name=date_end]').val($('#date_end').val());        
        
        var type_strah;
        $('input[type=radio]').each(function(){
          var name = $(this).attr('name');
          var ch = $(this).prop('checked');
          var val = $(this).val();
          if(name == 'type_strah[]'){
            if(ch == true){
                type_strah = val   
            };
          }
        });
        $('input[name=type_strah]').val(type_strah);
    });
    
    $('#btn_search_vigoda').click(function(){
        var s = $('#search_vigoda_client').val();        
        var dt = $('#date_begin').val();
        
        if(s.trim() == ''){
          return;
       }
       $.post(window.location.href, {"search_fiz_client":s, "date_begin": dt}, function(data){             
            var html = '';
            ////console.log(data);
            var j = JSON.parse(data.trim());
            if(j.length == 0){
                html = '<center><h1>Не найдено ни одного клиента!</h1></center>';                
            }else{
                $.each(j, function(e, v){
                    html += '<a class="list-group-item set_client_vigoda" id="'+v.SICID+'" data="'+v.IIN+'" data-type="'+v.BIRTHDATE+'" data-age="'+v.AGE+'" href="javascript:;">'+v.FIO+' ('+v.BIRTHDATE+' г.р.) ('+v.IIN+')</a>';
                });
            }
            $('.search_input_result_vogoda').html(html);
       });
    });
    
    $('body').on('click', '.set_client_vigoda', function(){
       var id = $(this).attr('id');
       var name = $(this).html();
       html = '<div class="col-lg-12" id="list_poluchatel_'+id+'">'+
       '<div class="col-lg-8"><input type="text" class="form-control vogodo_name" value="'+name+'" readonly></div>'+     
       '<div class="col-lg-3"><input type="number" min="0" max="100" class="form-control vogodo_proc" name="vogodo_proc['+id+']" value="0"></div>'+
       '<div class="col-lg-1"><span class="btn btn-block btn-danger del_vigoda" id="'+id+'"><i class="fa fa-trash"><i></span></div>'+
       '</div>';
       $('.list_clients_vigoda').append(html);
       $('.search_input_result_vogoda').html('');
    });
    
    $('body').on('click', '.del_vigoda', function(){
        var id = $(this).attr('id');
        $('#list_poluchatel_'+id).remove();
    });
        
    $('#search_vigoda_client').keydown(function(e){
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code==13) {            
            $('#btn_search_vigoda').click();
        }
    })
    
    $('#print_zav_btn').click(function(){
        var list = [];
        $('textarea').each(function(i, e){
            var txt = $(this).html();
            list[i] = txt;
        });

        var 
        array = {
            bank_id: $('input[name=bank_id]').val(),
            bank_type_schet: $('input[name=bank_type_schet]').val(),
            bank_schet : $('input[name=bank_schet]').val(),
            bank_iik : $('input[name=bank_iik]').val(),
            bank_lgot : $('input[name=bank_lgot]').val(),
            bank_date_lgot_begin : $('input[name=bank_date_lgot_begin]').val(),
            bank_date_lgot_end : $('input[name=bank_date_lgot_end]').val(),
            bank_date_do : $('input[name=bank_date_do]').val(),
            bank_num_sprav : $('input[name=bank_num_sprav]').val(),
            id_insur : $('input[name=id_insur]').val(),
            type_insur : $('input[name=type_insur]').val(),
            id_agent : $('input[name=id_agent]').val(),
            date_begin : $('input[name=date_begin]').val(),
            date_end : $('input[name=date_end]').val(),
            contract_num : $('input[name=contract_num]').val(),
            zv_num : $('input[name=zv_num]').val(),
            contract_date : $('input[name=contract_date]').val(),
            zv_date : $('input[name=zv_date]').val(),
            type_strah : $('input[name=type_strah]').val(),
            print_zayavlenie: list
        };                        
        $.post(window.location.href, array, function(data){            
            $('#print_zav_body').html(data);
        });
    });
    
    
    $('#save').click(function(){
        var ar = $('#form_result').serialize();
        $.post(window.location.href, ar, function(data){
            console.log(data);
            
            var j = JSON.parse(data);
            console.log(j);
            if(j.error.trim() !== ''){
                alert(j.error);
                return;
            }else{window.location.href = 'contracts?CNCT_ID='+j.cnct;}
            
        });        
    });
    
});


$('#add_risk_ander').click(function(){
    var id = $('#type_nagruz').val();
    var name = $('#name_nagruz').val();
    
    $.post(window.location.href, {"set_ander_risk_id":id, "set_ander_risk_name":name}, function(data){
        $('#list_risk_ander').append(data);
        $('#name_nagruz').val('');
    });
});

$('body').on('click', '.del_risk_ander', function(){
    var id = $(this).attr('data');
    $('#'+id).remove();
});

$('input[type=radio]').click(function(){
   var s = $(this).val();
   if(s == '2'){
      $('#set_group_dan').css('display', 'block');
   }else{
      $('#set_group_dan').css('display', 'none');
   }
});

$('#date_end').change(function(){
    var date_begin = $('#date_begin').val(); 
    var date_end = $('#date_end').val();
    $.post(window.location.href, {"raznica_date":"", "date_begin":date_begin, "date_end":date_end}, function(data){
       var j = JSON.parse(data);
       $('#set_m_srok').val(j.DS);
       $('#m_srok').val(j.DS);
    });
});

$('#date_begin').change(function(){
    var date_begin = $('#date_begin').val();
    var cnt_year = $('#set_m_srok').val();    
    if(cnt_year == '0'){ return;}
    if(cnt_year == ''){ return;}
    $.post(window.location.href, {"set_age_raschet":date_begin, "cnt_year":cnt_year}, function(data){
       var j = JSON.parse(data);
       $('#date_end').val(j.ST);
    });
});

$('#m_rashod').change(function(){
   var v = $(this).val();
   if(v < 0){
        alert('Диапозон "Агентских расходов" от 0% до 90%');
        $(this).val('0');
   }
   if(v > 90){
        alert('Диапозон "Агентских расходов" от 0% до 90%');
        $(this).val('0');
   }
   return false;
});

//$('#set_client_btn').click(function(){
//    //if(form_users == ''){
//   //     form_users = $('#m_form').html();
//   // }
//    
//    var p = $('#set_group_dan').css('display');
//    if(p.trim() == 'block'){
//        var periodich = $('#set_m_periodich').val();
//        var str_sum = $('#set_m_pay_sum_v').val();
//        var srok = $('#set_m_srok').val();
//        
//        var dop_pokr = $('#set_dop_pokr_main').val();                          
//        for(var i=0;i<dop_pokr.length;i++){
//            $('#m_dop_pokr option[value='+dop_pokr[i]+']').prop('selected', true);
//            //console.log(dop_pokr[i]);
//        }
//        
//        
//        //$('#m_dop_pokr').val(dop_pokr);
//        $('#m_periodich').val(periodich);
//        $('#m_pay_sum_v').val(str_sum);
//        $('#m_srok').val(srok);        
//    }else{
//        //$('#m_form').html(form_users);
//    }
//});

$('#set_m_periodich').change(function(){
    $('input[name=periodich]').val($(this).val());
});

$('#set_m_srok').change(function(){
    $('input[name=srok_strah]').val($(this).val());    
});

$('body').on('click', '.edit_user', function(){
    var id = $(this).attr('id');
    
    /*
    var id = $(this).attr('id');
    if($('#user_tab_'+id).length > 0){
        alert('Клиент уже имеется в списке!');
        return;
    }
    
    $('#m_fio').val($(this).html());
    $('#m_vozrast').val($(this).attr('data-age'));
    $('.search_input_result').html('');
    $('.search_user_dan').css('display', 'block');
     
    var v = $('#set_group_dan').css('display');
    if(v == 'block'){
        $('#m_periodich').val($('#set_m_periodich').val());           
        $('#m_dop_pokr').val($('#set_dop_pokr_main').val()).trigger('chosen:updated');
    }
    */
    
    var 
        d1 = $('#date_begin').val(),
        d2 = $('#date_end').val();
    $.post(window.location.href, {"get_user_dan":id, "d1":d1, "d2":d2}, function(data){
        //var j = JSON.parse(data);
        //console.log(data);
        
        $('#m_vozrast').val(data.user.AGE);
        $('#m_fio').val(data.user.FIO);
        $('#m_sicid').val(data.user.SICID);
        $('#m_dohod').val(data.user.GOD_DOHOD);
        $('#m_pay_sum_p').val(data.user.PAY_SUM_P);
        var idss = 1;
        $('#m_periodich option').each(function(){            
            if(this.text == data.user.PERIODICH){
                idss = this.value;
            }            
        });
        $('#m_periodich').val(idss);
        $('#m_rashod').val(data.user.RASHOD_AGENT);
        $('#m_rost').val(data.user.ROST);
        $('#m_srok').val(data.user.SROK);
        $('#m_pay_sum_v').val(data.user.STR_SUM);
        
        $('#m_date_begin').val($('#date_begin').val());
        $('#m_date_end').val($('#date_end').val());
        $('#type_str').val($('input[type=radio]:checked').val()); 
        $('#iedit').val('1');
        
        $('#date_calc').val(data.user.DATE_CALC);                
        $('#list_risk_ander').html('');
        
        var sel = [];
        $.each(data.calc, function(){
            if(this.TYPE_POKR == 1){
                sel.push(this.ID_POKR);
            }             
        });
        
        if(sel.length > 0){
            $('#m_dop_pokr').val(sel).change();
            $('#m_dop_pokr').trigger("chosen:updated");
        }
        
        $('#list_risk_ander').html(data.risk);
        $('.collapse-link').click();        
        
        $('.search_user_dan').css('display', 'block');    
    });
});


$('#recalc_all').click(function(){
    var p = $('#form_result').serialize();
    p = p.replace('save', 'recalc_all');
    p = p+'&id_main_pokr='+$('#set_main_pokr').val();
    
    var dp = $('#set_dop_pokr_main').val();
    var txt = '';
    if( $('#set_dop_pokr_main').has('option:selected').length > 0 ) {
        $.each(dp, function(i, e){
            if(i > 0){
                txt = txt+',';
            }
            txt = txt+e;
        });
    }
    p = p+'&id_dop_pokr='+txt;
    
    $.post(window.location.href, p, function(data){        
        var j = JSON.parse(data);
        if(j.msg.trim() !== ''){
            alert(j.msg);
            return false;
        }
        
        $('#tabs_users').html(j.tabs_users);
        $('#body_users').html(j.body_users);
        $('#list_users_json').html(j.list_users_json);
        
    });    
});

/*
function PrintElem(elem)
{
    Popup($(elem).html());
}

function Popup(data)
{
    var mywindow = window.open('', 'my div', 'height=400,width=600');
    mywindow.document.write('<html><head><title>my div</title>');
    //optional stylesheet //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10

    mywindow.print();
    mywindow.close();

    return true;
}
*/
function fileUpload(event){
    //notify user about the file upload status
    $(".upload_text").html(event.target.value+" uploading...");
    
    //get selected file
    files = event.target.files;
    //form data check the above bullet for what it is  
    var data = new FormData();                                   

    //file data is presented as an array
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if(file.size > 12048576){
            //check file size (in bytes)
            $(".upload_text").html("Sorry, your file is too large (>1 MB)");
        }else{
            //append the uploadable file to FormData object
            data.append('file', file, file.name);
            
            //create a new XMLHttpRequest
            var xhr = new XMLHttpRequest();     
            
            //post file data for upload
            xhr.open('POST', window.location.href, true);  
            xhr.send(data);
            xhr.onload = function () {
                $('#list_clients').css('display', 'none');
                $('#prov_div').css('display', 'block');
                $('#prov_div').html(xhr.responseText);
                $('#back_to_add').css('display', 'block');
            };
        }
    }
}
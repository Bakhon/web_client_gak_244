$(document).ready(function(){
    
    //Передвижение по статусу
    $('.set_state').click(function(){
        var id = $(this).attr('id');
        var btn = $(this).attr('data');
        var note = $('.note').val();         
        $.post(window.location.href, {            
            "type": btn,
            "note": note,
            "set_state": id
        }, function(data){
            if(data.trim() == ''){
                location.reload();
            }
            alert(data);
        });        
    });
    
    $('.set_note').click(function(){
        var id = $(this).attr('id');
        var data = $(this).attr('data');        
        var text = $(this).html();        
        
        $('.note').val('');        
        $('.set_state').attr('id', id);        
        $('.set_state').attr('data', data);
        $('.set_state').html(text);  
        $('.set_state_rasp').html(text);          
        $('input[name=set_num_rasp]').val(id);            
    });     
    
    $('.send_replace').click(function(){
        var id = $(this).attr('id');
        $.post(window.location.href, {"send_replace": id}, function(data){
            alert(data);
        }); 
    });
    
    //Возврат на 1 договор страхования
    $('.vozvrat').click(function(){
       var cnct = $(this).attr('data-cnct'); 
       var id = $(this).attr('data');      
       $('#list_contracts').html('');
       
       $('input[name=vozvrat]').val(cnct);
       $('input[name=id_contract_vozvrat]').val(id);
    
       $.post(window.location.href, {"dan_vozvrat":id, "cnct_vozvrat":cnct}, function(data){  
          
          var j = JSON.parse(data);
          console.log(j);
          $('input[name=vozvrat_contract_num]').val(j.CONTRACT_NUM+'/D1');
          $('input[name=vozvrat_pay_sum_opl]').val("-"+j.PAY_SUM_OPL);
          $('input[name=vozvrat_sum_s_strah]').val("-"+j.SUM_S_STRAH);
                
          //{"ID":"996","CONTRACT_NUM":"RE\/20171115\/F\/812","PAY_SUM_OPL":"45457.5","SUM_S_STRAH":"15675000"}
       });      
    });    
    
    //Возврат на договор перестрахования 
    $('.set_vozvrat_reins').click(function(){    
        var id = $(this).attr('data');
        
        $('#list_contracts').html('');    
        $('input[name=id_contract_vozvrat]').val(id);
        $('input[name=vozvrat]').val('');
        $('input[name=vozvrat_pay_sum_opl]').val('0');
        $('input[name=vozvrat_sum_s_strah]').val('0');
        $('#btn_plat').html('Найти');
        
        $.post(window.location.href, {"dan_vozvrat":id}, function(data){
            var j = JSON.parse(data);
            var html = '';
            
            $('input[name=vozvrat_contract_num]').val(j.contract_num);
            
            html += '<table class="table table-bordered">';
            html += '<tr><th></th><th>№ договора</th><th>Страхователь</th><th>Оплате</th><th>Обязательства</th></tr>';
            $.each(j.list_contracts, function(i, e){
                html += '<tr>';
                html += '<td><input type="checkbox" data="'+e.CNCT_ID+'" data-opl="'+e.PAY_SUM_OPL+'" data-strah="'+e.SUM_S_STRAH+'" class="vozvr_cnct" name="vozvr_cnct['+e.CNCT_ID+']"></td>';
                html += '<td>'+e.CONTRACT_NUM+'</td>';
                html += '<td>'+e.STRAHOVATEL+'</td><td class="pso_'+e.CNCT_ID+'" data="'+e.PAY_SUM_OPL+'">'+e.PAY_SUM_OPL+'</td><td class="sss_'+e.CNCT_ID+'" data="'+e.SUM_S_STRAH+'">'+e.SUM_S_STRAH+'</td></tr>';           
            });
            html += '</table>';
            $('#list_contracts').append(html);
        });
    });    
    
    $('.set_vozvrat').click(function(){
        var s = $('#list_contracts').html().trim();    
        if(s == ''){
            var id = $('input[name=id_contract_vozvrat]').val();
            var cnct = $('input[name=vozvrat]').val();
            var contract_num = $('input[name=vozvrat_contract_num]').val();
            var pay_sum_opl = $('input[name=vozvrat_pay_sum_opl]').val();
            var sum_s_strah = $('input[name=vozvrat_sum_s_strah]').val();
            var date_contract = $('input[name=vozvrat_date]').val();
            
            $.post(window.location.href, {
                "vozvrat":id, 
                "vozvrat_cnct":cnct, 
                "vozvrat_contract_num": contract_num,
                "vozvrat_pay_sum_opl": pay_sum_opl,
                "vozvrat_sum_s_strah": sum_s_strah,
                "vozvrat_date_contract" : date_contract
            }, function(data){
                alert(data);        
            });
        }else{
            $('#save_vozvrat').submit();
        }
    });   
    
    $('body').on('change', '.vozvr_cnct', function(){
        var list_cnct = [];
        var id = $('input[name=id_contract_vozvrat]').val();
        var s = false;
            
        $('input[name=vozvrat_pay_sum_opl]').val('0');
        $('input[name=vozvrat_sum_s_strah]').val('0');
        
        var s1 = $(this).attr('data-opl').replace(',', '.');
        var s2 = $(this).attr('data-strah').replace(',', '.');
        var cn = $(this).attr('data');
        if($(this).prop('checked') == true){
            $('.pso_'+cn).html('<input type="number" name="pso['+cn+']" class="pso" value="'+s1+'">');
            $('.sss_'+cn).html('<input type="number" name="sss['+cn+']" class="sss" value="'+s2+'">');
        }else{
            $('.pso_'+cn).html($(this).attr('data-opl'));
            $('.sss_'+cn).html($(this).attr('data-strah'));
        }
        
        $('.vozvr_cnct').each(function(i, e){
            var b = $(this).prop('checked');
            var cnct = $(this).attr('data');
            if(b == true){
                s = true;
                list_cnct.push(cnct);            
            }        
        });
        if(s){
            $.post(window.location.href, {"raschet_vozvr":list_cnct, "vozvrat_id_contract":id}, function(data){
                var d = JSON.parse(data);        
                $('input[name=vozvrat_pay_sum_opl]').val(d.PAY_SUM_OPL);
                $('input[name=vozvrat_sum_s_strah]').val(d.SUM_S_STRAH);
            });   
        } 
    });  
    
    $('body').on('focusout', '.pso', function(){
        var s = parseFloat(0);
        $('.pso').each(function(){
            var p = parseFloat($(this).val());
            s = s+p;
        });
        $('input[name=vozvrat_pay_sum_opl]').val('-'+s);    
    });
    
    $('body').on('focusout', '.sss', function(){
        var s = parseFloat(0);
        $('.sss').each(function(){
            var p = parseFloat($(this).val());
            s = s+p;
        });
        $('input[name=vozvrat_sum_s_strah]').val('-'+s);    
    });
    
    $('.pereraschet').click(function(){
       var id = $(this).attr('data');
       $.post(window.location.href, {'pereraschet':id}, function(data){
          if(data.trim() !== ''){
            alert(data);
          }
       }) 
    });
});
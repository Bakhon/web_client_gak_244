<?php   
    $btn1 = 'btn-success';
    $btn2 = 'btn-default';    
    $href = 'search';    
	if(isset($_GET['list_contracts'])){
	   $btn1 = 'btn-default';
	   $btn2 = 'btn-success';
       $href = 'list_contracts';
	}        
?>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="reins_bordero" class="btn <?php echo $btn2; ?>"><i class="fa fa-list-ul"></i> Не сформированные</a>
                    <a href="reins_bordero?list_transh" class="btn <?php echo $btn1; ?>"><i class="fa fa-list-ul"></i> Не сформированные c траншами</a>
                    <a href="reins_bordero?list_contracts" class="btn <?php echo $btn2; ?>"><i class="fa fa-list-alt"></i> Список договоров</a>                                        
                </div>
                <div class="ibox-content" style="float: left;">
                    <div class="form-group col-lg-2">
                        <?php if($dep == 13){ ?>
                        <button class="btn btn-default" id="form" data-target="#contr"><i class="fa fa-crosshairs"></i> Сформировать</button>
                        <?php } ?>
                    </div>
                    <form class="form-horizontal">
                        <div class="form-group col-lg-2">
                            <label class="col-lg-2" style="padding-top: 5px;">С: </label>
                            <div class="input-group date col-lg-10">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php
                                    $date_begin = '';
                                    if(isset($_GET['date_begin'])){
                                        $date_begin = $_GET['date_begin'];
                                    }
                                ?>
                                <input type="text" name="date_begin" class="form-control date_begin input-sm" data-mask="99.99.9999" value="<?php echo $date_begin; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group col-lg-2">
                            <label class="col-lg-2" style="padding-top: 5px;">По: </label>
                            <div class="input-group date col-lg-10">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php
                                    $date_end = '';
                                    if(isset($_GET['date_end'])){
                                        $date_end = $_GET['date_end'];
                                    }
                                ?>
                                <input type="text" name="date_end" class="form-control date_end input-sm" data-mask="99.99.9999" value="<?php echo $date_end; ?>">
                            </div>
                        </div> 
                        
                        <div class="form-group col-lg-4">
                            <label class="col-lg-2" style="padding-top: 5px;">Агент</label>
                            <div class="input-group col-lg-10">
                                <select class="form-control" name="id_agent">                                
                                    <option value="0">--Не выбран</option>
                                    <?php 
                                        $id_agent = 0;
                                        if(isset($_GET['id_agent'])){
                                            $id_agent = $_GET['id_agent'];
                                        }                                        
                                        foreach($bordero->list_agents() as $k=>$v){
                                            $s = '';
                                            if($v['ID'] == $id_agent){
                                                $s = 'selected';
                                            }
                                            echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-lg-1" style="text-align: right;">
                            <button type="submit" name="<?php echo $href; ?>" class="btn btn-success"><i class="fa fa-filter"></i></button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content bd_text">
                <?php 
                    echo $bordero->html;
                ?>
                </div>
            </div>              
        </div>                
    </div>
</div>

<div class="modal inmodal fade" id="contr" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Создание договоров</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="modal_body_text">
                                        
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_contracts">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Отмена</button>                
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="set_note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Комментарий</h4>
            </div>
            <div class="modal-body">
                <p><textarea class="form-control note"></textarea></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default set_state" id="" data=""></button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="set_note_rasp_transh" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Создание уведомления</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="gen_rasp" method="post" enctype="multipart/form-data">                                      
                    <label>Дата распоряжения</label>
                    <div class="input-group date ">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="idate_rasp" class="form-control idate_rasp input-sm" data-mask="99.99.9999" value="">
                    </div>
                                                
                    
                    <label>№ счета</label>
                    <input type="text" class="form-control" name="inum_shet"/>
                    
                    <label>Дата счета</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="idate_schet" class="form-control idate_schet input-sm" data-mask="99.99.9999" value="">
                    </div>                    
                    
                    <label>Скан. копия счета на оплату</label>
                    <input type="file" class="form-control" name="ischet_fail"/>
                    
                    <label>Примечание</label>
                    <textarea name="note" class="form-control note"></textarea>
                    <input type="hidden" name="set_transh_uv" value="0"/>
                </form>                                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success set_state_rasp_transh">Создать уведомление</button>
            </div>
        </div>
    </div>
</div>

<script>
    var succes = function(){
        $('#form').attr('class', 'btn btn-default');
        $('#form').attr("data-toggle", "");
        $('.check').each(function(){
            var b = $(this).prop('checked');
            if(b == true){
                $('#form').attr('class', 'btn btn-info');
                $('#form').attr("data-toggle", "modal");
            }
        });
    }    
    
    $('.check').click(function(){succes();});
    $('.check_all').click(function(){
        var b = $(this).prop('checked');
        $('.check').prop('checked', b);
        succes();
    });
    $('body').on('click', '#form.btn-default', function(){
        alert('Для формирвания бордеро необходимо выбрать хотя бы 1(один) договор');
    });
    
    
    $('body').on('click', '#form.btn-info', function(){
        var s = [];
        $('.check').each(function(){
            if($(this).prop('checked') == true){
                var 
                    pid = $(this).attr('id'),
                    pdata = $(this).attr('data');
                var p = {
                    id: pid,
                    data: pdata
                };        
                //s.push($(this).attr('id'));
                s.push(p);
            }
        });        
        $.post(window.location.href, {"new_contract": s}, function(data){
            //console.log(data); 
            $('#modal_body_text').html(data);
            $('#modal_body_text').append('<input type="hidden" name="save_contr_bordero" value="<?php echo $active_user_dan['emp']; ?>"/>');           
        });   
             
    });
    
    $('#save_contracts').click(function(){
        $('#modal_body_text').submit();    
    });
    
    
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
        var text = $(this).html()+' '+$(this).attr('title');
        
        $('.note').val('');        
        $('.set_state').attr('id', id);        
        $('.set_state').attr('data', data);
        $('.set_state').html(text);                
    })
    
    $('#del_list').click(function(){
        var list_contracts = [];
        $('.check').each(function(){            
            var b = $(this).prop('checked');
            if(b == true){
                list_contracts.push($(this).attr('id'));                
            }            
        });
        if(list_contracts.length == 0){
            alert('Не выбра ни один договор!');
        }else{
            
            $.post(window.location.href, {"del_list_bordero": list_contracts}, function(data){
               if(data.trim() == ''){
                    location.reload();
               }else{
                  alert(data);
               }
            });            
        }
    });
    
    //var h = window.screen.height = 200;
    //$('.bd_text')
    
    
$('.set_uv_transh').click(function(){    
    //var cnct = $(this).attr('id');
    var id_transh = $(this).attr('data');
    $('input[name=set_transh_uv]').val(id_transh);
});

$('.set_state_rasp_transh').click(function(){
    $('#gen_rasp').submit();
});          
</script>

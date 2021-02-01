<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title id_otchet" id="<?php echo $_GET['admin']; ?>">
            <h5>Администратирование отчета № <?php echo $dan['head']; ?></h5>
        </div>
        <div class="ibox-content" style="overflow: auto;">
        
            <div class="row">
                <div class="col-lg-12">    
                    <h5>Входящие параметры
                    <span class="btn btn-primary btn-xs pull-left" data-toggle="modal" data-target="#add_params"><i class="fa fa-plus"></i></span>                    
                    </h5>                                    
                    <div class="form-horizontal" id="list_params">
                    <?php echo $dan['params_html']; ?>           
                    </div>
                    
                </div>
            </div>
        <br />   
        <hr /> 
        <h5>Форма в АРМ системе</h5>                 
        <?php echo $dan['html']; ?>
        </div>
    </div>
</div>    


<div class="modal inmodal fade" id="add_params" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Создать входящий параметр</h4></div>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">                
                <div class="row" id="create_param"> 
                    <div class="col-lg-12">
                        <h4>№ п\п</h4>
                        <input type="number" class="form-control" id="num_pp" value="<?php echo $dan['max_num_pp']; ?>"/>
                    </div>                               
                    <div class="col-lg-12">
                        <h4>Название параметра</h4>
                        <input type="text" class="form-control" id="n_param_rus"/>
                    </div>
                    
                    <div class="col-lg-12">
                        <h4>Определитель параметра</h4>
                        <input type="text" class="form-control" id="n_param"/>
                    </div>
                    
                    <div class="col-lg-12">
                        <h4>Тип параметра</h4>
                        <select class="select2_demo_1 form-control" id="typ_param">
                            <?php 
                                foreach($dan['params_list'] as $k=>$v){
                                    echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-lg-12">
                        <h4>SQL Текст</h4>
                        <textarea class="form-control" id="sql_text"></textarea>
                        <span class="text-danger">Пример: select 1 id, 'Текст' name from dual</span>
                    </div>
                </div>                
            </div>
            
            <div class="modal-footer">
                <input type="hidden" name="id_other" value="0"/>
                <button id="save_param" class="btn btn-success" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>                        
        </div>        
    </div>
</div>

<script>
    $('.save_cell').click(function(){
       var id = $(this).attr('data');
       var sql = $('#'+id).val();
       var id_otchet = $('.form_table_otchet').attr('id');
       
       $.post(window.location.href, {"save_cell":id_otchet, "cell":id, "sqls":sql}, function(data){
          console.log(data);
       });
    });
    $('#save_param').click(function(){
        var id = $('.id_otchet').attr('id');
        var num_pp = $('#num_pp').val();
        var n_param_rus = $('#n_param_rus').val();
        var n_param = $('#n_param').val();
        var typ_param = $('#typ_param').val();
        var sql_text = $('#sql_text').val();
        
        $.post(window.location.href, {
            "set_param_new":id,
            "num_pp":num_pp, 
            "n_param_rus":n_param_rus, 
            "n_param":n_param, 
            "typ_param":typ_param, 
            "sql_text":sql_text
        }, function(data){
            $('#list_params').html(data);
            $('#num_pp').val('');
            $('#n_param_rus').val('');
            $('#n_param').val('');
            $('#typ_param').val('');
            $('#sql_text').val('');
        })
    });
    
    $('.delete_param').click(function(){
       var id = $('.id_otchet').attr('id');
       var idp = $(this).attr('id');
       
       $.post(window.location.href, {"del_param":id, "num_pp":idp}, function(data){
          $('#list_params').html(data);
       });  
    });
    
</script>

<style>
input{
    min-width: 150px;
}
</style>


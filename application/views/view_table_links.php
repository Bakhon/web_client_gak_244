<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Создать связь</h5>
                </div>
                <div class="ibox-content"> 
                    <div class="row">   
                        <div class="col-md-5">
                            <div class="form-group col-md-6">
                                <label for="title">Таблица 1</label>
                                <select class="form-control list_columns" id="table1" data="#column1">                                
                                    <?php 
                                        foreach($dan['TABLES'] as $k=>$v){
                                            echo '<option value="'.$v['ID'].'">'.$v['TABLE_NAME'].' ('.$v['TABLE_META'].')</option>';                                             
                                        }
                                    ?> 
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="title">Колонка 1</label>
                                <select class="form-control" id="column1">                                
                                    <?php 
                                        foreach($dan['COLUMNS'] as $k=>$v){
                                            echo '<option value="'.$v['ID'].'">'.$v['COL_NAME'].' ('.$v['COL_META'].')</option>';                                             
                                        }
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <span style="margin-top: 5px;float: left;width: 100%;text-align: center;"> 
                                <i class="fa fa-arrows-h fa-4x"></i> 
                            </span>                          
                        </div>             
                        <div class="col-md-5">
                            <div class="form-group col-md-6">
                                <label for="title">Таблица 2</label>
                                <select class="form-control list_columns" id="table2" data="#column2">                                
                                    <?php 
                                        foreach($dan['TABLES'] as $k=>$v){
                                            echo '<option value="'.$v['ID'].'">'.$v['TABLE_NAME'].' ('.$v['TABLE_META'].')</option>';                                             
                                        }
                                    ?> 
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="title">Колонка 2</label>
                                <select class="form-control" id="column2">                                
                                    <?php 
                                        foreach($dan['COLUMNS'] as $k=>$v){
                                            echo '<option value="'.$v['ID'].'">'.$v['COL_NAME'].' ('.$v['COL_META'].')</option>';                                             
                                        }
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1"><button class="btn btn-success btn-block" id="save_link" style="margin-top: 23px;"><i class="fa fa-save"></i></button></div>   
                    
                    </div>                 
                </div>
            </div>
        </div>
        
        <!-- -->
        
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Список связанных таблиц</h5>
                </div>
                <div class="ibox-content"> 
                    <div class="row">
                        <?php foreach($dan['LIST'] as $k=>$v){ ?>
                        <div class="col-lg-12 feed-element">
                            <div class="col-md-5">
                                <h3><?php echo $v['TABLE_NAME1'].".".$v['COL_NAME1']; ?></h3>
                                <h5><?php echo "{%".$v['TABLE_META1'].".".$v['COL_META1']."%}"; ?></h5>
                            </div>
                            <div class="col-md-1">
                                <span style="margin-top: 5px;float: left;width: 100%;text-align: center;"> 
                                    <i class="fa fa-arrows-h fa-4x"></i> 
                                </span>  
                            </div>
                            <div class="col-md-5">
                                <h3><?php echo $v['TABLE_NAME2'].".".$v['COL_NAME2']; ?></h3>
                                <h5><?php echo "{%".$v['TABLE_META2'].".".$v['COL_META2']."%}"; ?></h5>
                            </div>
                            <div class="col-md-1">
                                <button style="margin-top: 5px;" id="<?php echo $v['ID']; ?>" class="btn btn-danger btn-block del_link"> 
                                    <i class="fa fa-trash"></i> 
                                </button>  
                            </div>
                            <hr />
                        </div>
                        <?php } ?>                                                
                    </div>
                </div>
            </div>
        </div>        
                
    </div>
</div>
<style>
.feed-element{
    border-bottom: solid 1px #aeaeae;
}    
</style>

<script>
$('.list_columns').change(function(){
    var id = $(this).val();
    var ds = $(this).attr('data');
    $.post(window.location.href, {"list_columns":id}, function(data){
        var j = JSON.parse(data);
        $(ds).html('');
        $.each(j, function(index, dan){
            $(ds).append('<option value="'+dan.ID+'">'+dan.COL_NAME+' ('+dan.COL_META+')</option>');                      
        });        
    });
});


$('#save_link').click(function(){   
   var t1 = $('#table1').val(); 
   var t2 = $('#table2').val();
   var c1 = $('#column1').val();
   var c2 = $('#column2').val();
   $.post(window.location.href, {"save_link":"0", "table1":t1, "table2":t2, "column1":c1, "column2":c2
   }, function(data){
      if(data.trim() == ''){
        location.reload();
      }else{
        alert(data);
      }
   });
});
</script>
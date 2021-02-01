<?php 
    $id = 0;
    if($_GET['sql_editor_block'] !== '')
    {
        $id = $_GET['sql_editor_block'];
    }
?>
<div class="ibox float-e-margins">
    <div class="ibox-title" data-toggle="false">                
        <div class="input-group">
            <input type="text" name="title_block" value="" class="form-control" placeholder="Название блока запроса"/> 
            <span class="input-group-btn">
                <button class="btn btn-danger" id="save_examples"><i class="fa fa-save"></i> Сохранить</button>
                <input type="hidden" id="id_block" value="<?php echo $id; ?>"/>
            </span>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <textarea id="code_res" name="execSql">select * from dual</textarea>
                <br />
                <div>
                    <span class="btn btn-default" id="sql_example">Выполнить</span>                    
                </div>                
            </div>
            
            <div class="col-lg-8" id="sql_params">
                
            </div>
            
            <div class="col-lg-4" id="sql_cols">
            
            </div>
            
            <div id="sql_result" class="col-lg-12" style="overflow: auto;max-height:300px;">
                    
            </div> 
        </div>                                                         
    </div>
</div>
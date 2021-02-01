<div class="row wrapper wrapper-content">
    <div class="row">        
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title head_panel">
                    <h5>Добавить блок</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#test_contracts"><i class="fa fa-file-pdf-o"></i></a>                        
                        <a class="btn btn-primary btn-sm" id="new_block" data-toggle="modal" data-target="#add_standart_contracts"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-report">
        <?php 
            echo $dan['html'];
        ?>
        </div>        
    </div>
</div>    

<div class="modal inmodal fade" id="add_standart_contracts" data="<?php echo $_GET['id']; ?>" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Форма добавления блока документа</h4></div>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">                
                <div class="row"> 
                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="TITLE_TEXT" id="TITLE_TEXT" placeholder="Название заголовка"/>
                    </div>                               
                    <div class="col-lg-6">         
                        <h4>Позиция № п\п</h4>
                        <input type="number" class="form-control" name="POSITION"/>
                    </div>
                    <div class="col-lg-6">
                        <h4>Количество блоков на строке</h4>
                        <select class="select2_demo_1 form-control" name="NUM_PP" id="blockCount">
                            <option value="6">На пол строки</option>
                            <option value="12">На всю строку</option>                            
                        </select>
                    </div>                
                </div>
                <br />
                <div class="ibox float-e-margins">
                    <div class="ibox-content no-padding editorsContent">
                        <div id="editor_content" class="summernote">
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="modal-footer">
                <input type="hidden" name="id_other" id="id_block" value="0"/>
                <button id="save" class="btn btn-success" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>                        
        </div>        
    </div>
</div>

<div class="modal inmodal fade" id="test_contracts" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Выберите договор для проверки</h4></div>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">                
                <div class="row"> 
                    <div class="col-lg-12">
                        <label>Введите номер договора</label>
                        <input type="text" class="form-control" id="contract_num" value=""/>                        
                    </div>
                    <hr />
                    <div class="col-lg-12">
                        
                    </div>
                </div>                
            </div>
            
            <div class="modal-footer">                
                <button id="test_otchet" class="btn btn-success">Показать</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>                        
        </div>        
    </div>
</div>

<div class="right-menu">            
    <?php 
        foreach($dan['meta'] as $k=>$v){
            echo '
            <div class="btn-group btn-block">
            <button data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-expanded="false">'.$v['TABLE_META'].' <span class="caret"></span></button>
            <ul class="dropdown-menu">';      
            foreach($v['columns'] as $t=>$d){
                echo '<li><a class="sets_text" data="['.$v['TABLE_META'].'].['.$d['COL_META'].']" data-table="'.$v['ID'].'" data-col="'.$d['ID'].'">'.$d['COL_META'].'</a></li>';
            } 
            echo '</ul></div>';                        
        }
    ?>                        
</div>

<style>
.right-menu{
    display: none;
    position: absolute;
    top: 0px;
    left: 0px;
    border: solid 1px;
    max-width: 235px;
    z-index: 9999;   
}

.meta{
    color: red;
    cursor: pointer;
}

.meta.active{
    color: #0080FF;
    font-size: 14px;
    border: solid 1px;  
}

.dropdown-menu{
    height: 300px;
    overflow: auto;
}

.note-editable{
    height: auto;
}

.meta:hover{
    font-size: 14px;    
}

.note-editable{
    font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
    min-height: 245px;
}
</style>
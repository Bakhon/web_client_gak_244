<div class="row wrapper wrapper-content">
    <div class="row">        
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title head_panel">
                    <h5>Добавить блок</h5>
                    <div class="ibox-tools">                   
                                            <button data-toggle="dropdown" class="btn btn-primary drop down-toggle" aria-expanded="true"><i class="fa fa-cog"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu" style="height: 100px;">
                                                <li><a href="print_form?cnct_id=78881" target="_blank"><i class="fa fa-2x fa-file-text-o"></i> Печать договора</a></li>
                                                <li><a href="loadpdf2?cnct_id=78881" target="_blank"><i class="fa fa-2x fa-file-pdf-o"></i> PDF</a></li>
                                               </ul>                                                                                                                                                                    
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
    <div class="modal-dialog modal-lg" style="width: 75%;">
        <div class="modal-content modal-lg" id="new_modal" style="width: 100%;">
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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content no-padding editorsContent">
                                <div id="editor_content" class="summernote">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
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
                 </div>   
           <div class="row">
              <div class="col-lg-4">
                    <div class="ibox-tools">
                            <span class="pull-left">
                            <a class="btn btn-primary btn-sm" data-toggle="modal" onclick="" data-target="#add_params2"><i class="fa fa-plus">Добавить параметр</i></a>
                            </span>
                    </div>
                </div>    
           </div>   
                    
               
                <hr />
                <div class="row">                                                                       
                 <div class="col-lg-12">                 
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Таблица</th>
                            <th>Колонка</th>
                            <th>Условие</th>
                            <th>Входящий параметр </th>                                                     
                            <th></th>
                        </tr>
                    </thead>                   
                    <tbody id="table_test">                                                                           
                    </tbody>
                 
          </table>                 
                 </div>
                </div>   
                                       
                                <div class="row">                                                                       
                 <div class="col-lg-12">                 
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Вид договора </th>                                                 
                            <th></th>
                        </tr>
                    </thead>                   
                    <tbody id="table_test2">  
                                                                                             
                    </tbody>
                 
          </table>                 
                 </div>
                </div>   
                
                
                
                <div class="row">
                <div class="col-lg-12">

               
               <select id="selectID" class="select2_demo_1 form-control"></select>
               <option></option>
                
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


<div class="modal inmodal fade" id="add_params" data="<?php echo $_GET['id']; ?>" role="dialog"  aria-hidden="true">  
<div class="modal-dialog modal-lg"  >
        <div class="modal-content  ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Выберите условия</h4>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="form"  >                                                                   
                  
  <!--                  <div class="form-group">
                        <label class="control-label col-lg-3">Период действия</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="period_deistvia" class="form-control dateOform" name="period_deistvia" data-mask="99.99.9999" value="" type="text">
                            </div>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Дата действия договора</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="data_action_contract" class="form-control dateOform" name="data_action_contract" data-mask="99.99.9999" value="" type="text">
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="control-label col-lg-3">Вид договора</label>
                        <div class="col-lg-9">                            
                            <select class="form-control" name="TYP" id="TYP"> 
                             <?php
                                   foreach($list_dic as $k => $v)
                                   {
                            ?>                              
                                  <option value="<?php echo $v['ID'];?>"><?php echo $v['NAME']; ?></option>
                            <?php
                                   }
                            ?>
                            </select>                            
                        </div>
                    </div>
      -->              
       
                <div class="form-group">
                        <label class="control-label col-lg-3">Вид договора</label>
                        <div class="col-lg-9" id="checkBoxGroup" >                        
                            <?php
                                foreach($dan['list_type_contracts'] as $k => $v)
                                {
                            ?>
                                        <div class=""><label> <input name="vid_dog[]" id="<?php echo $v['ID']; ?>" value="<?php echo $v['ID']; ?>" type="radio"><?php echo ' '; ?><?php echo $v['NAME']; ?> </label></div>
                           <?php
                                }
                           ?>
                             <?php
                                foreach($dan['list_type_contracts2'] as $k1 => $v1)
                                {
                            ?>
                                        <div class=""><label> <input name="vid_dog[]" id="<?php echo $v1['ID']; ?>" value="<?php echo $v1['ID']; ?>" type="checkbox"><?php echo ' '; ?><?php echo $v1['NAME']; ?> </label></div>
                           <?php
                                }
                           ?>                                         
                       </div>
                  </div>  
                    
          <br />    
          <!--
                                                   
              <div class="form-group">                        
                        <label class="control-label col-lg-3">Выбор Таблицы</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help" name="PARAMS_TABLE" id="PARAMS_TABLE">                                
                                <?php 
                                    foreach($dan['list_tables'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['TABLE_META'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="help-block m-b-none" id="H_PARAMS_TABLE">
                                <?php echo $dan['list_tables'][0]['DESCRIPT']; ?>
                            </span>                            
                        </div>
              </div>
              
             <div class="form-group">                        
                        <label class="control-label col-lg-3">Выбор Колонки</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help" name="PARAMS_COLUMNS" id="PARAMS_COLUMNS">                               
                                <?php 
                                    foreach($dan['list_columns'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['COL_META'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="help-block m-b-none" id="H_PARAMS_COLUMNS">
                                <?php echo $v[0]['DESCRIPT']; ?>
                            </span>                            
                        </div>
             </div> 
             
            <div class="form-group">
                        <label class="control-label col-lg-3">Условие</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help" name="PARAMS_CONDIT" id="PARAMS_CONDIT">
                            <?php 
                                foreach($dan['list_condit'] as $k=>$v){
                                    echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIT'].'">'.$v['NAME'].' ('.$v['CONDT'].')</option>';
                                }
                            ?>
                            </select> 
                            <span class="help-block m-b-none"> Описание: 
                                <span class="text-info" id="H_PARAMS_CONDIT"><?php echo $list_condit[0]['DESCRIT']; ?></span> 
                            </span>                         
                        </div>
            </div>
            
            <div class="form-group">
                        <label class="control-label col-lg-3">Входящий параметр</label>
                        <div class="col-lg-9">
                            <input type="text" name="PARAMS_RES" id="PARAMS_RES" class="form-control" value=""/>
                            <span class="help-block m-b-none">
                                Введите необходимый параметр для будущего определения и выбора текущей типовой формы  
                            </span>                          
                        </div>                         
            </div>  
               <br />   
               -->                      
              </form>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="id_other" id="id_block" value="0"/>                              
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_form_params">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>




<div class="modal inmodal fade" id="add_params2" data="<?php echo $_GET['id']; ?>" role="dialog"  aria-hidden="true">  
<div class="modal-dialog modal-lg"  >
        <div class="modal-content  ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить параметр</h4>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="form"  >                                                                                                                                  
              <div class="form-group">                        
                        <label class="control-label col-lg-3">Выбор Таблицы</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help2" name="PARAMS_TABLE2" id="PARAMS_TABLE2">                                
                                <?php 
                                    foreach($dan['list_tables'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['TABLE_META'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="help-block m-b-none" id="H_PARAMS_TABLE2">
                                <?php echo $dan['list_tables'][0]['DESCRIPT']; ?>
                            </span>                            
                        </div>
              </div>
              
             <div class="form-group">                        
                        <label class="control-label col-lg-3">Выбор Колонки</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help2" name="PARAMS_COLUMNS2" id="PARAMS_COLUMNS2">                               
                                <?php 
                                    foreach($dan['list_columns'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['COL_META'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="help-block m-b-none" id="H_PARAMS_COLUMNS2">
                                <?php echo $v[0]['DESCRIPT']; ?>
                            </span>                            
                        </div>
             </div> 
             
            <div class="form-group">
                        <label class="control-label col-lg-3">Условие</label>
                        <div class="col-lg-9">
                            <select class="form-control st_help2" name="PARAMS_CONDIT2" id="PARAMS_CONDIT2">
                            <?php 
                                foreach($dan['list_condit'] as $k=>$v){
                                    echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIT'].'">'.$v['NAME'].' ('.$v['CONDT'].')</option>';
                                }
                            ?>
                            </select> 
                            <span class="help-block m-b-none"> Описание: 
                                <span class="text-info" id="H_PARAMS_CONDIT2"><?php echo $list_condit[0]['DESCRIT']; ?></span> 
                            </span>                         
                        </div>
            </div>
            
            <div class="form-group">
                        <label class="control-label col-lg-3">Входящий параметр</label>
                        <div class="col-lg-9">
                            <input type="text" name="PARAMS_RES2" id="PARAMS_RES2" class="form-control" value=""/>
                            <span class="help-block m-b-none">
                                Введите необходимый параметр для будущего определения и выбора текущей типовой формы  
                            </span>                          
                        </div>                         
            </div>  
             <br />                         
              </form>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="id_other" id="id_block2" value="0"/>                              
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_form_params2">Сохранить</button>
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
    /*font-size: 14px;*/
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
    /*font-size: 14px;*/    
}

.note-editable{
    font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
    min-height: 245px;
}
</style>

<script>

$('#TYP').change(function(){
        var id = $(this).val();
        if(id == '1'){
            $('#time_test').css('display', 'block');            
        }else{
            $('#time_test').css('display', 'none');
        }        
    });
    
        $('#PARAMS_TABLE').change(function(){
        var id = $(this).val();
        $.post(window.location.href, {"list_params_col_table":id}, function(data){
           $('#PARAMS_COLUMNS').html(data);
            $('#PARAMS_COLUMNS').change(); 
        });         
    });
    
    $('.st_help').change(function(){
       var text = $('option:selected', this).attr('data');
       var id = $(this).attr('id');
       $('#H_'+id).html(text);       
    });
    
    
        
        $('#PARAMS_TABLE2').change(function(){
        var id = $(this).val();
        $.post(window.location.href, {"list_params_col_table2":id}, function(data){
           $('#PARAMS_COLUMNS2').html(data);
            $('#PARAMS_COLUMNS2').change(); 
        });         
    });
    
    
                    
    
</script>





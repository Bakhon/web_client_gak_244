<link rel="stylesheet" href="styles/js/codemirror/codemirror.css" />
<link rel="stylesheet" href="styles/js/codemirror/show-hint.css" />
<link href="styles/css/plugins/steps/jquery.steps.css" rel="stylesheet">

<script>
    $.getScript("styles/js/codemirror/codemirror.js", function(){
        $.getScript("styles/js/codemirror/sql.js", function(){
            $.getScript("styles/js/codemirror/show-hint.js", function(){
                $.getScript("styles/js/codemirror/sql-hint.js", function(){
                        var table_list = '<?php echo $dan['tables']; ?>';
                        var tbls = JSON.parse(table_list);
                        
                        /*SQL редактор*/
                        sql_editor = CodeMirror.fromTextArea(
                            document.getElementById("code"), 
                            {
                                mode: "text/x-plsql",
                                indentWithTabs: true,
                                smartIndent: true,
                                lineNumbers: true,
                                matchBrackets : true, 
                                autofocus: true, 
                                extraKeys: {
                                    "Ctrl-Space": "autocomplete",
                                    "Ctrl-Enter": "execSql"
                                },
                                hintOptions: {
                                    tables: tbls
                                }
                            }                            
                        );                                              
                });
            });
        });
    });        
</script>

<div class="ibox float-e-margins">
    <div class="ibox-title"><h5>Создать блок</h5></div>
    <div class="ibox-content"> 
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">График</a></li>
                <li class=""><a data-toggle="tab" id="tab2" href="#tab-2">SQL запросы</a></li>
                <li class=""><a data-toggle="tab" href="#tab-3">Параметры</a></li>
                <li class=""><a data-toggle="tab" href="#tab-4">Результат</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">                    
                    <div class="panel-body">
                        <div class="row">       
                            <div class="col-lg-3">
                                <img src="styles/img/charts/chart0.jpg" style="width: 100%;"/>
                                <label>Без графики</label>
                                <button class="btn btn-block btn-info set_chart" id="0">Выбрать</button>                                
                            </div>                                           
                            <div class="col-lg-3">
                                <img src="styles/img/charts/chart1.png" style="width: 100%;"/>
                                <label>Столбы</label>
                                <button class="btn btn-block btn-info set_chart" id="1">Выбрать</button>                                
                            </div>                            
                            <div class="col-lg-3">
                                <img src="styles/img/charts/chart2.png" style="width: 100%;"/>
                                <label>Линии</label>
                                <button class="btn btn-block btn-info set_chart" id="2">Выбрать</button>                                
                            </div>
                            <div class="col-lg-3">
                                <img src="styles/img/charts/chart5.png" style="width: 100%; height: 178px"/>
                                <label>Круг</label>
                                <button class="btn btn-block btn-info set_chart" id="5">Выбрать</button>                                
                            </div>
                            <div class="col-lg-12">
                                <label>                                
                                <input type="checkbox" id="view_table_check" /> Скрывать таблицу
                                </label>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <h3>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-warning btn-xs dropdown-toggle" aria-expanded="false">Меню <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#create_tables">Создать таблицу</a></li>
                                <li class="divider"></li>                                
                                <li><a href="#" data-toggle="modal" data-target="#create_table_sql">Создать таблицу на основе запроса</a></li>                                                                
                            </ul>
                        </div>                        
                        Список SQL запросов для данного блока</h3>
                        
                        <div class="list_tables" style="overflow: auto;min-height: 500px;">
                            
                        </div>
                    </div>
                </div>
                
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        
                    </div>
                </div>
                
                <div id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <button class="btn btn-info btn-lg view_result">Показать результат</button>
                        
                        <button class="btn btn-success btn-lg save_result pull-right">Сохранить</button>
                        <div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-default btn-lg dropdown-toggle" aria-expanded="false">Размер блока <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <?php 
                                    for($i=1;$i<=12;$i++){
                                        $cl = '';
                                        if($i == 12){
                                            $cl = 'active';
                                        }
                                        echo '<li><a href="javascript:;" class="size_block '.$cl.'" data="'.$i.'">Ширина '.$i.'</a></li>';
                                    }
                                ?>                                                                
                            </ul>
                        </div>
                                                
                        <div class="row">
                            <div id="panel_result" class="col-lg-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                                                   
    </div>
</div>
<input type="hidden" id="id_block" value="0"/>


<div class="modal inmodal fade" id="create_tables" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title">Создать таблицу</h5>
            </div>
            <div class="modal-body">
                <p>
                    <label>Количество колонок</label>
                    <input type="number" min="1" class="form-control" id="columns" value="1"/>
                </p>
                <p>
                    <label>Количество строк</label>
                    <input type="number" min="1" class="form-control" id="rows" value="1"/>
                </p>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" id="set_table">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="create_table_sql" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title">Создать таблицу на основе SQL запроса</h5>
            </div>
            <div class="modal-body">                                
                <textarea id="code" name="execSql">select * from dual</textarea>                                        
                <div id="sql_result" style="overflow: auto;max-height:300px;">
                    
                </div>            
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="exesSql">Выполнить</button>
                <button type="button" data="0" class="btn btn-primary" id="set_table_sql">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-primary modal_sql_params" data-toggle="modal" data-target="#sql_params_set" style="display: none;"></button>
<div class="modal inmodal" id="sql_params_set" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header" style="padding: 15px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h2>Список параметров</h2>                
            </div>
            <form method="post" class="form_execute_sql">
                <div class="modal-body form-horizontal" id="list_params_sql_exec">
                    
                </div>
            </form>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary execute_sql">Выполнить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal_sql_lists" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">SQL блоки</h4>
            </div>
            <div class="modal-body" id="sql_blocks" style="margin-left: 0px; margin-right: 0px; margin-top: 15px;">
                <div class="row">
                    <div class="col-lg-12">
                    <select class="form-control" id="sql_blocks_lists">
                        <option value="0">--Не выбрано</option>
                    </select>
                    </div>
                    
                    <div id="sql_block_vls" style="display: none;" class="col-lg-12">
                        <div class="col-lg-12"><button class="btn btn-default btn-block" id="view_sql_text_block">Показать/Скрыть SQL текст</button></div>
                        <div class="col-lg-12" style="display: none;" id="sql_block_sql_text"></div>                                                            
                        <div class="col-lg-8">
                            <textarea class="form-control" id="sql_blocks_sqls">select sum(colname) c from ({%0%}) where colname = 0</textarea>
                        </div>
                        <div class="col-lg-4" id="sql_blocks_cols"></div>                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" id="set_from_sql_block">Добавить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<style>
    .CodeMirror-hints{
        z-index: 9999;
    }
    #sql_blocks_sqls{
        border: solid 1px;
        background-color: #fff;
        padding: 15px;    
    }
    
    .size_block.active{
        background-color: #9e9e9e;
        color: #fff;
    }
    
    #panel_result{        
        border: solid 1px;
        margin: 15px;
        padding: 15px;
    }
</style>
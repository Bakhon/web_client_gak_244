<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">   
            <!-- панель № 1-->                     
            <div class="col-lg-12 page" id="panel1" style="display: block;">
                <div class="ibox float-e-margins"> 
                    <div class="ibox-heading">
                        <h3>Основные данные</h3>
                    </div>                   
                    <div class="ibox-content">      
                        <label>Начните вводить "Наименование" клиента или "БИН"</label>  
                        
                        <div class="input-group m-b">
                            <input type="text" class="form-control" id="search_contr_agent" value=""/>
                            <span class="input-group-btn">
                                <button id="btn_search" class="btn btn-primary">Найти</button> 
                            </span>
                        </div>
                        <hr />                                                                
                        <div id="okeds" style="display: none;">                                                        
                            <div class="row">
                                <div class="col-lg-12">     
                                    <?php
                                        echo FORMS::InputText(9, 'Наименование клиента', 'strah_name', 'strah_name', '', 'form-control', '', true);
                                        echo FORMS::InputText(3, 'БИН', 'BIN', 'BIN', '', 'form-control', '', true);
                                    ?>
                                    
                                    <h4>Основной вид деятельности</h4>   
                                    <div class="col-lg-12">
                                        <label class="font-noraml">По заявлению страхователя</label>
                                        <div class="input-group m-b">
                                            <input type="text" id="NAME_OKED" name="NAME_OKED" readonly="" placeholder="" class="form-control" value="" required="">
                                            <span class="input-group-btn">
                                                <button data-toggle="modal" data-target="#modal1" class="btn btn-primary">Выбрать</button> 
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <?php                                          
                                        echo FORMS::InputText(12, 'По классу проф. риска (постановление правительства РК №652)', '', 'vd', 'Это поле заполнится автоматически...', 'form-control', '', true);                                    
                                        echo FORMS::InputText(2, 'ОКЭД', 'IOKED', 'oked', '', 'form-control', '', true);                                                                                                                                            
                                        echo FORMS::InputText(2, 'Класс проф.риска', 'irisk_id', 'risk', '', 'form-control', '', true);
                                        echo FORMS::InputText(3, 'Степень аффилированности', 'AFFILIR', 'AFFILIR', '', 'form-control', '', true);
                                    ?>                                    
                                    <input type="hidden" id="oked_id" value=""/>
                                    <input type="hidden" id="id_insur" value=""/>
                                    <input type="hidden" id="id_head" value="0"/>
                                </div>                                                                               
                            </div>
                            
                            <button class="btn btn-success pull-right next" id="1">Далее</button>                            
                        </div>
                        
                        <div class="list-group table-of-contents" id="search_result">                            
                            
                        </div>
                                                
                    </div>                                    
                </div>
                                
            </div>
            
            <!-- панель № 2-->
            <div class="col-lg-12 page" id="panel2" style="display: none;">
                <div class="ibox float-e-margins"> 
                    <div class="ibox-heading">
                        <h3>Данные для заведения договора</h3>
                    </div>                   
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Дата заявления</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="ZV_DATE" value="<?php echo date("d.m.Y"); ?>" data-mask="99.99.9999">
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <label>Дата договора</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="CONTRACT_DATE" value="<?php echo date("d.m.Y"); ?>" data-mask="99.99.9999">
                                </div>
                            </div>    
                            
                            <div class="col-lg-4">
                                <label>Были ли несчастные случаи на предприятии?</label>
                                <div class="onoffswitch2">
                                    <input type="checkbox" name="NS_BOOL" class="onoffswitch2-checkbox" id="myonoffswitch2" checked="">
                                    <label class="onoffswitch2-label" for="myonoffswitch2">
                                        <span class="onoffswitch2-inner"></span>
                                        <span class="onoffswitch2-switch"></span>
                                    </label>
                                </div>
                            </div>                                                    
                        </div>
                        <hr />
                        <div class="row">                                                        
                            <div class="col-lg-4">
                                <label>Период страхования с</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="DATE_BEGIN" name="DATE_BEGIN" value="" data-mask="99.99.9999">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>По</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="DATE_END" name="DATE_END" value="" data-mask="99.99.9999">
                                </div>
                            </div> 
                            
                            <div class="col-lg-4">
                                <label>Порядок уплаты</label>
                                <div class="onoffswitch1">
                                    <input type="checkbox" name="periodich" class="onoffswitch1-checkbox" id="myonoffswitch1" checked="">
                                    <label class="onoffswitch1-label" for="myonoffswitch1">
                                        <span class="onoffswitch1-inner"></span>
                                        <span class="onoffswitch1-switch"></span>
                                    </label>
                                </div>
                            </div>                                                       
                        </div>
                        <hr />
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-lg-12">
                                <label class="col-lg-12">Выберите агента</label>
                                <div class="col-lg-12">
                                    <select class="form-control chosen-select" id="AGENT" name="AGENT">                                    
                                        <?php 
                                            foreach($dan['AGENT'] as $k=>$v){                                                                                               
                                                echo '<option value="'.$v['KOD'].'">'.$v['NAME'].'</option>';
                                            }
                                        ?>                    
                                    </select>                                    
                                </div>
                            </div>
                            <div id="panel_agent" class="col-lg-12" style="display: none;">
                                <hr />
                                <h3>Данные по агенту</h3>
                            
                                <div class="col-lg-2">
                                    <label>Комиссия</label>
                                    <input type="text" class="form-control" id="komis" readonly/>
                                </div>
                                
                                <div class="col-lg-6">
                                    <label>Основание</label>
                                    <input type="text" class="form-control" id="osnov" readonly/>
                                </div>
                            </div>  
                                                                    
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                <button class="btn btn-warning pull-left prev" id="2">Назад</button>
                                <button class="btn btn-success pull-right next" id="2">Далее</button>
                                </div>
                            </div>           
                        </div>                                 
                    </div>                            
               </div>                    
            </div>
            
            <!-- панель № 3-->
            <div class="col-lg-12 page" id="panel3" style="display: none;">
                <div class="ibox float-e-margins"> 
                    <div class="ibox-heading">
                        <h3>Список сотрудников на преприятии
                        <a class="btn btn-success btn-sm" id="add_pril2" data-toggle="modal" data-target="#modal_pril2"><i class="fa fa-plus"></i>Добавить сотрудника</a>
                        </h3>
                    </div>                   
                    <div class="ibox-content">
                        <div class="row" id="pril2" style="min-height: 250px;"></div>                        
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <button class="btn btn-warning pull-left prev" id="3">Назад</button>
                                    <button class="btn btn-success pull-right next" id="3">Далее</button>
                                </div>
                            </div>           
                        </div>  
                    </div>
                </div>                
            </div>
            
            <!-- панель № 4-->
            <div class="col-lg-12 page" id="panel4" style="display: none;">
                <div class="ibox float-e-margins"> 
                    <div class="ibox-heading">
                        <h3>Статистика несчастных случаев
                            <a class="btn btn-info btn-sm" id="addRow" data-toggle="modal" data-target="#modal_ns"><i class="fa fa-plus"></i>Добавить</a>
                        </h3>
                    </div>                   
                    <div class="ibox-content">
                        <div class="row" id="list_ns" style="min-height: 250px;">
                            
                        </div>                        
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <button class="btn btn-warning pull-left prev" id="4">Назад</button>
                                    <button class="btn btn-success pull-right next" id="4">Далее</button>
                                </div>
                            </div>           
                        </div>  
                    </div>
                </div>                
            </div>
            
            <!-- панель № 5-->
            <div class="col-lg-12 page" id="panel5" style="display: none;">
                <div class="ibox float-e-margins"> 
                    <div class="ibox-heading">
                        <h3>Плановая оплата платежей (График)
                            <a class="btn btn-info btn-sm" id="add_transh" data-toggle="modal" data-target="#modal_transh"><i class="fa fa-plus"></i>Добавить</a>
                        </h3>
                    </div>                   
                    <div class="ibox-content">
                        <div class="row" id="list_transh">
                            
                        </div>                        
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <button class="btn btn-warning pull-left prev" id="5">Назад</button>
                                    <button class="btn btn-success pull-right next" id="5">Далее</button>
                                </div>
                            </div>           
                        </div>  
                    </div>
                </div>                
            </div>
            
            <!-- панель № 6-->
            <div class="col-lg-12 page" id="panel6" style="display: none;">
                <div class="ibox float-e-margins"> 
                    <div class="ibox-heading">
                        <h3>Результат данных</h3>
                    </div>                   
                    <div class="ibox-content">
                        <div class="row" id="list_result">
                            
                        </div>                        
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <button class="btn btn-warning pull-left prev" id="6">Назад</button>
                                    <button class="btn btn-success pull-right">Сохранить</button>
                                </div>
                            </div>           
                        </div>  
                    </div>
                </div>                
            </div>
            
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Справочник ОКЕД</h4>
                <small class="font-bold">Выберите из списка необходимы вид деятельности</small>
            </div>
            <div class="modal-body">
                <label>Введите Номер или Наименование вида экономической деятельности</label>
                <div class="input-group m-b">
                    <input type="text" id="search_oked_text" class="form-control">
                    <span class="input-group-btn">
                        <button id="btn_search_oked" class="btn btn-primary">Найти</button> 
                    </span>
                </div>
                <div class="list-group table-of-contents" id="list_okeds">                            
                            
                </div>                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal_pril2" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавление сотрудника</h4>
                <small class="font-bold">Добавление сотрудника во вкладку Приложение 2</small>
            </div>
            <div class="modal-body">
                <form class="new_pril2">
                    <label class="font-noraml">Наименование (Страхователь или Филиал)</label>
                    <select class="select2_demo_1 form-control pril2_naimen" name="pril2_dolg">                        
                        
                    </select>
                    <div class="form-group">
                        <label class="font-noraml">Должность</label>
                        <input type="text" placeholder="" class="form-control pril2_name" name="pril2_name">
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">Численность</label>
                        <input type="number" placeholder="" class="form-control pril2_chisl" value="1" name="pril2_chisl">
                    </div>                   
                    <div class="form-group">
                        <label class="font-noraml">Класс Проф. Риска</label>
                        <input type="text" placeholder="" class="form-control pril2_risk" name="pril2_risk" readonly>
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">Оклад</label>
                        <div class="input-group m-b">                             
                            <input type="number" placeholder="" class="form-control pril2_oklad" value="0" name="pril2_oklad">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info" id="calc_smzp"><i class="fa fa-calculator"></i> Расчитать</button> 
                            </span>
                        </div>                                                                        
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Средняя месячная заработная плата</label>
                        <input type="number" placeholder="" class="form-control pril2_smzp" name="pril2_smzp">
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">ГФОТ</label>
                        <input type="number" placeholder="" class="form-control pril2_gfot" name="pril2_gfot">
                    </div>                    
                    
                    <div class="form-group">
                        <label class="font-noraml">Страховая сумма</label>
                        <input type="number" placeholder="" class="form-control pril2_strsum" name="pril2_strsum">
                    </div>
                </form>
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_pril2" name="pril2_calc" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal_ns" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавление статистики</h4>
                <small class="font-bold">Добавление статистики несчастных случаев на производстве</small>
            </div>
            <div class="modal-body">
                <form class="new_pril2">
                    <label class="font-noraml">Наименование (Страхователь или Филиал)</label>
                    <select class="select2_demo_1 form-control ns_naimen" name="ns_naimen">                        
                        
                    </select>
                    <div class="form-group">
                        <label class="font-noraml">Год</label>
                        <select class="form-control ns_god" name="ns_god">                            
                        <?php 
                            $god = date("Y");
                            for($i=1;$i<6;$i++){
                                $god -= 1;
                                echo '<option value="'.$god.'">'.$god.'</option>';
                            }
                        ?>
                        </select>                        
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">Численность застрахованных</label>
                        <input type="number" placeholder="" class="form-control ns_chisl" value="0">
                    </div>                   
                    <div class="form-group">
                        <label class="font-noraml">УПТ со сроком</label>
                        <input type="text" placeholder="" class="form-control ns_upt_s" value="0">
                    </div>                    
                    <div class="form-group">
                        <label class="font-noraml">УПТ без срочно</label>                                                     
                        <input type="number" placeholder="" class="form-control ns_upt_not_s" value="0">                                                                    
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Смертность</label>
                        <input type="number" placeholder="" class="form-control ns_death" value="0">
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Численность пострадавших</label>
                        <input type="number" placeholder="" class="form-control ns_postr" value="0">
                    </div>                                                            
                </form>
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close-ns"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_ns" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="modal_transh" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
                <form class="new_pril2">                    
                    <div class="form-group">
                        <label class="font-noraml">Планируеммая сумма</label>
                        <input type="number" placeholder="" class="form-control transh_summa">
                    </div>     
                    
                    <div class="form-group">
                        <label class="font-noraml">Планируемая дата</label>                                    
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control transh_data" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close-transh"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_transh" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="new_person" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Ответственное лицо</h4>
                <small class="font-bold">Добавление ответственного лица</small>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-noraml">Фамилия</label>
                    <input id="secondname_otvetstvennoe" type="text" placeholder="" class="form-control ns_chisl">
                </div>
                <div class="form-group">
                    <label class="font-noraml">Имя</label>
                    <input id="firstname" type="text" placeholder="" class="form-control ns_chisl">
                </div> 
                <div class="form-group">
                    <label class="font-noraml">Отчество</label>
                    <input id="middlename" type="text" placeholder="" class="form-control ns_chisl">
                </div> 
            </div>
            <div class="modal-footer">                
                <span class="pull-left">                    
                    <span class="i-checks">
                        <label class="form-control" style="border: solid 0px;"> 
                            <input type="checkbox" id="dont-close-transh"/> <i></i>  Не закрывать при сохранении
                        </label>
                    </span>
                </span>            
                <button type="button" id="save_new_person" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>




<script>
    var agents = <?php echo json_encode($dan['AGENT']); ?>;        
</script>

<style>

.list_pril2{
    border: solid 1px #f3f3f4;
}

#search_result{        
    max-height: 400px;
    overflow: auto;
}

.onoffswitch2 {
    position: relative; width: 100px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch2-checkbox {
    display: none;
}
.onoffswitch2-label {
    display: block; overflow: hidden; cursor: pointer;    
    border-radius: 42px;
}
.onoffswitch2-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch2-inner:before, .onoffswitch2-inner:after {
    display: block; float: left; width: 50%; height: 37px; padding: 0; line-height: 37px;
    font-size: 20px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch2-inner:before {
    content: "Нет";
    padding-left: 18px;
    background-color: #1AB394; color: #FFFFFF;
}
.onoffswitch2-inner:after {
    content: "Да";
    padding-right: 28px;
    background-color: #5BADFF; color: #FFFFFF;
    text-align: right;
}
.onoffswitch2-switch {
    display: block; width: 28px; margin: 4.5px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 60px;
    border: 2px solid #E3E3E3; border-radius: 42px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch2-checkbox:checked + .onoffswitch2-label .onoffswitch2-inner {
    margin-left: 0;
}
.onoffswitch2-checkbox:checked + .onoffswitch2-label .onoffswitch2-switch {
    right: 0px; 
}




.onoffswitch1 {
    position: relative; width: 250px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch1-checkbox {
    display: none;
}
.onoffswitch1-label {
    display: block; overflow: hidden; cursor: pointer;    
    border-radius: 42px;
}
.onoffswitch1-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch1-inner:before, .onoffswitch1-inner:after {
    display: block; float: left; width: 50%; height: 37px; padding: 0; line-height: 37px;
    font-size: 20px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch1-inner:before {
    content: "Единовременно";
    padding-left: 18px;
    background-color: #1AB394; color: #FFFFFF;
}
.onoffswitch1-inner:after {
    content: "В расрочку";
    padding-right: 38px;
    background-color: #5BADFF; color: #FFFFFF;
    text-align: right;
}
.onoffswitch1-switch {
    display: block; width: 28px; margin: 4.5px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 210px;
    border: 2px solid #E3E3E3; border-radius: 42px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-inner {
    margin-left: 0;
}
.onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-switch {
    right: 0px; 
}


</style>
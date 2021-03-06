<div class="row">
    <h4>Причина: Договор добровального аннуитетного страхования для СУПТ 5% - 29%</h4>
</div>
<div class="pole">
                                    <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#tab-1voluntary">Смерть</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-2voluntary">Транши</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-3voluntary">Расчет выплаты</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-1voluntary" class="tab-pane active">
                                            
                                            <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                        
                                                        <label class="font-noraml">Причина</label>
                                                            <select class="select2_demo_1 form-control">
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                            </select>
                                                </div>
                                                
                                                <div class="col-lg-4">
                        
                                                        <label class="font-noraml">Статус аннуитета</label>
                                                            <select class="select2_demo_1 form-control">
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                            </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control" placeholder="Только цифры" required>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                            
                                                            <label class="font-noraml">Умерший кормилец</label>
                                                            <select class="select2_demo_1 form-control chosen-select">
                                                            <?php
                                                            echo '<option value="">Не выбрано</option>';
                                                            foreach($dbPrevKszh as $k => $v){
                                                            echo '<option value="">'.$v['NAME'].'</option>';
                                                                }
                                                                
                                                                ?>
                                                            </select>
                                                       
                                                </div>
                                                <?php
                                                    echo FORMS::InputDate(4, 'Дата смерти', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                                                ?>
                                                <div class="col-lg-2">
                                                    <label class="font-noraml">Возраст млад.ребенка</label>
                                                    <input type="number" class="form-control" placeholder="Только цифры" required>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="font-noraml">Количество иждевенцев</label>
                                                    <input type="number" class="form-control" placeholder="Только цифры" required>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="font-noraml">Диагноз</label>
                                                    <input type="text" id="risk" placeholder="" class="form-control" required>
                                                </div>
                                            </div>
                                            </div>
                                            
                                            
                                            
                                           
                                        </div>
                                        <div id="tab-2voluntary" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="row" id="strahTitle">
                                                        
                                                        <a href="javascript:;" class="btn btn-primary " id="addRowOsor" data-toggle="modal" data-target="#myModalOsor">Добавить</a>
                                                        <a href="javascript:;" class="btn btn-primary " id="removeOsor">Удалить</a>
                                                        <a href="javascript:;" class="btn btn-primary " id="resetOsor">Сбросить</a>                       
                                                        
                                                        <table class="table table-striped table-bordered table-hover inputs" id="editable" >
                                                        <thead>
                                                        <tr>
                                                            <th>Должность</th>
                                                            <th>ФИО</th>
                                                            <th>Номер акта N1</th>
                                                            <th>Дата акта N1</th>
                                                            <th>Причина</th>
                                                            <th>СМЗП</th>
                                                            <th>Возраст</th>
                                                            <th>Степень вины</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!--here rows-->
                                                        </tbody>
                                                        </table>
                                                        
                                                        <div class="col-lg-4">
                        
                                                            <label class="font-noraml">Периодичность выплат по траншам</label>
                                                                <select class="select2_demo_1 form-control">
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                </select>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tab-3voluntary" class="tab-pane">
                                            <div class="panel-body">
                                            <div class="row">
                                                    <div class="col-lg-2">
                                                        <label class="font-noraml">Средняя ЗП</label>
                                                        <input type="text" id="risk" placeholder="" class="form-control" required data-toggle="modal" data-target="#myModalOsorSredZP">
                                                    </div>
                                                    <?php
                                                        echo FORMS::InputDate(4, 'Дата расчета', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                                                    ?>
                                                    <div class="col-lg-2">
                                                        <label class="font-noraml">Выплаты АО "КСЖ ГАК"</label>
                                                        <input type="number" class="form-control" placeholder="Только цифры" required>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label class="font-noraml">С учетом опекунства</label>
                                                        <div class="i-checks"><label class=""> <input type="checkbox" value="" checked=""> <i></i>  </label></div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                    <h4>Расходы СО(%)</h4>
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">От страховой премии"</label>
                                                        <input type="number" class="form-control" placeholder="Только цифры" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">От страховой выплаты"</label>
                                                        <input type="number" class="form-control" placeholder="Только цифры" required>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                    </div>
                                                    <div class="col-lg-4">
                                                       
                                                            <button class="btn btn-primary" type="submit">Расчет страховой выплаты, премии и аннуитетного фактора</button>
                                                        
                                                    </div>
                                                    <div class="col-lg-4">
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label class="font-noraml">АФ</label>
                                                        <input type="text" id="risk" placeholder="" class="form-control" disabled="" required data-toggle="modal" data-target="#myModalOsorSredZP">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="font-noraml">Страховая выплата</label>
                                                        <input type="text" id="risk" placeholder="" class="form-control" disabled="" required data-toggle="modal" data-target="#myModalOsorSredZP">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="font-noraml">Страховая премия</label>
                                                        <input type="text" id="risk" placeholder="" class="form-control" disabled="" required data-toggle="modal" data-target="#myModalOsorSredZP">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                       $(document).ready(function(){
                                       var config = {
                                            '.chosen-select'           : {},
                                            '.chosen-select-deselect'  : {allow_single_deselect:true},
                                            '.chosen-select-no-single' : {disable_search_threshold:10},
                                            '.chosen-select-no-results': {no_results_text:'Ничего не найдено'},
                                            '.chosen-select-width'     : {width:'95%'}
                                        }
                                        
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
                                        
                                        $('.i-checks').iCheck({
                                            checkboxClass: 'icheckbox_square-green',
                                            radioClass: 'iradio_square-green'
                                        });
                                        
                                        var gi = 0;
                                        $('#CONTRACT_DATE').change(function(){
                                            if(gi == 0){
                                                gi++;
                                                return false;
                                            }
                                            var d = $(this).val();
                                            var paymcode = $(this).attr('data');
                                            var b = $('#branch').val();
                                            
                                            if(b == ''){alert('Не выбрано отделение');gi = 0; return false;}
                                            if(d == ''){alert('Не выбрана дата договора');gi = 0; return false;}
                                            
                                            if($('input[name="iCONTRACT_NUM"]').val() !== ''){
                                                return false;
                                            }
                                                                                    
                                            $.post('new_contract', {
                                                "gen_contract_num":"", 
                                                "paym_code":paymcode,
                                                "contract_date":d,
                                                "branch":b 
                                            }, function(data){
                                                $('input[name="iCONTRACT_NUM"]').val($.trim(data));           
                                            });   
                                            gi = 0;               
                                        });
                                        
                                        //Генерация номера заявления
                                        var zd = 0;
                                        $('#IZV_DATE').change(function(){
                                            if(zd == 0){
                                                zd++;
                                                return false;
                                            }
                                                    
                                            var paymcode = $(this).attr('data');
                                            var b = $('#branch').val();
                                            
                                            if(b == ''){alert('Не выбрано отделение');zd = 0; return false;}        
                                            if($('input[name="iZV_NUM"]').val() !== ''){
                                                return false;
                                            }                          
                                            $.post('new_contract', {
                                                "gen_zv_num":"", 
                                                "paym_code":paymcode,            
                                                "branch":b 
                                            }, function(data){            
                                                $('input[name="iZV_NUM"]').val($.trim(data));           
                                            });   
                                            zd = 0;
                                        }); 
                                    });    
                                </script>
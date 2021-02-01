<div class="row wrapper wrapper-content">
    <div class="row">
        <form>
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins">                         
                <div class="ibox-content">
                    <div class="row">  
                        <div class="col-lg-3">
                            <label class="font-noraml">Номер договора</label>
                            <input type="text" disabled="" placeholder="" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="font-noraml">Номер заявления</label>
                            <input type="text" disabled="" placeholder="" class="form-control" required>
                        </div>
                            <?php
                                echo FORMS::InputDate(3, 'Дата заявления', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                                echo FORMS::InputDate(3, 'Дата договора', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                            ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                        
                                <label class="font-noraml">Причина</label>
                                    <select class="select2_demo_1 form-control reason">
                                        <option value="didntCheck" id="didntCheck">Не выбрано</option>
                                        <option value="1" id="1">Проф. заболевание</option>
                                        <option value="2" id="2">Смерть</option>
                                        <option value="3" id="3">Трудовое увечье</option>
                                        <option value="several" id="several">Несколько сроков в одном договоре</option>
                                        <option value="7" id="7">Перерасчет в связи с увеличением заработной платы на основании судебного акта</option>
                                        <option value="8" id="8">Перерасчет в связи с увеличением заработной платы на основании письма</option>
                                        <option value="9" id="9">Заключение на срок СУПТ менее года</option>
                                        <option value="0" id="0">Договор добровольного аннуитетного страхования для СУПТ 5% - 29%</option>
                                    </select>
                        </div>
                        <div class="col-lg-3">
                            
                                    <label class="font-noraml">Отделение</label>
                                    <select class="select2_demo_1 form-control chosen-select">
                                        <?php
                                            echo '<option value="">Не выбрано</option>';
                                            foreach($dbAffiliate as $k => $v){
                                                echo '<option value="">'.$v['NAME'].'</option>';
                                            }
                                        ?>
                                    </select>
                               
                        </div>
                        <div class="col-lg-3">
                            <label class="font-noraml">Типовой</label>
                            <div class="i-checks"><label class=""> <input type="checkbox" value="" checked=""> <i></i>  </label></div>
                        </div>
                        <div class="col-lg-3">
                            <label class="font-noraml">Согласие на обработку данных</label>
                            <div class="i-checks"><label class=""> <input type="checkbox" value="" checked=""> <i></i>  </label></div>
                        </div>
                        
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">  
                        <div class="col-lg-6">
                            
                                    <label class="font-noraml">Аннуитет</label>
                                    <select class="select2_demo_1 form-control chosen-select">
                                    <?php 
                                        echo '<option value="">Не выбрано</option>';
                                        //foreach($dbStrahChose as $k=>$v){
                                        //    echo
                                        //    '<option value="'.$i.'">'.$v['NAME'].'</option>';
                                        //    }
                                    ?>
                                    </select>
                               
                        </div>
                        <div class="col-lg-6">
                            
                                    <label class="font-noraml">Получатель</label>
                                    <select class="select2_demo_1 form-control chosen-select">
                                    <?php
                                        echo '<option value="">Не выбрано</option>';
                                        foreach($dbAgent as $k => $v){
                                        echo '<option value="">'.$v['NAME'].'</option>';
                                            }
                                    ?>
                                    </select>
                               
                        </div>
                        <div class="col-lg-6">
                            
                                    <label class="font-noraml">Страхователь</label>
                                    <select class="select2_demo_1 form-control chosen-select">
                                    <?php
                                    echo '<option value="">Не выбрано</option>';
                                    foreach($dbFund as $k => $v){
                                    echo '<option value="">'.$v['NAME'].'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                               
                        </div>
                        <div class="col-lg-6">
                            
                                    <label class="font-noraml">Первичный страховщик</label>
                                    <select class="select2_demo_1 form-control chosen-select">
                                    <?php
                                    echo '<option value="">Не выбрано</option>';
                                    foreach($dbPrevKszh as $k => $v){
                                    echo '<option value="">'.$v['NAME'].'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                               
                        </div>
                        <div class="col-lg-4">
                                    <label class="font-noraml">Агент</label>
                                    <select class="select2_demo_1 form-control chosen-select">
                                    <?php
                                    echo '<option value="">Не выбрано</option>';
                                    foreach($dbAgent as $k => $v){
                                    echo '<option value="">'.$v['NAME'].'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                        </div>
                        <div class="col-lg-4">
                            <label class="font-noraml">Основание</label>
                            <input type="text" id="risk" placeholder="" class="form-control" required>
                        </div>
                        <?php
                            echo FORMS::InputDate(3, 'Дата начала выплат в другом КСЖ', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                        ?>
                        <div class="col-lg-1">
                            <label class="font-noraml">Опекун</label>
                            <div class="i-checks"><label class=""> <input type="checkbox" value="" checked=""> <i></i>  </label></div>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                       
                            <h4>Банковские данные, наличие льгот</h4>
                            <div class="ibox-tools">
                            </div>
                        
                        <div class="col-lg-4">
                            
                                    <label class="font-noraml">Банк</label>
                                    <select class="select2_demo_1 form-control chosen-select">
                                    <?php
                                    echo '<option value="">Не выбрано</option>';
                                    foreach($dbBank as $k => $v){
                                    echo '<option value="">'.$v['NAME'].'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                               
                        </div>
                        <div class="col-lg-2">
                        
                                <label class="font-noraml">Тип счета</label>
                                    <select class="select2_demo_1 form-control">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Счет</label>
                            <input type="text" placeholder="" class="form-control" required>
                        </div>
                        <div class="col-lg-4">
                            <label class="font-noraml">ИИК</label>
                            <input type="text" placeholder="" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                                <label class="font-noraml">Наличие льгот по налогооблажению</label>
                                    <select class="select2_demo_1 form-control">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                        </div>
                        <?php
                            echo FORMS::InputDate(2, 'Действует до', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                            echo FORMS::InputDate(2, 'Срок действия льгот с', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                            echo FORMS::InputDate(2, 'по', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                        ?>
                        
                        <div class="col-lg-2">
                            <label class="font-noraml">Номер справки</label>
                            <input type="text" placeholder="" class="form-control" required>
                        </div>
                        
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-12" id="id_panel">
                                <h1>Причина не выбрана</h1>
                        </div>
                    </div>
                                                
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="form-group">
                            
                                <button class="btn btn-primary btn-rounded btn-block" type="submit">Сохранить</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

                    </div>
                        </div>
                            <div class="modal inmodal fade" id="myModalOsor" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Добавление траншей</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <form>
                                                
                                                    <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control" placeholder="Только цифры" required>
                                                
                                                <?php
                                                    echo FORMS::InputDate(2, 'Действует до', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                                                ?>
                                                
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                                            <button type="button" id="add" class="btn btn-primary">Сохранить</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal inmodal fade" id="myModalOsorSredZP" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h6 class="modal-title">Заработная плата за последние 12 месяцев</h6>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-6" >
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m1" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалилности</label>
                                                    <input type="number" class="form-control m2" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалилности</label>
                                                    <input type="number" class="form-control m3" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m4" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m5" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m6" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m7" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m8" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php
                                                    echo FORMS::InputDate(6, 'Дата', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                                                    ?>
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m9" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m10" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m11" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Дата</label>
                                                        <input class="form-control" data-mask="99/99/9999" placeholder="" type="text">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="font-noraml">Группа инвалидности</label>
                                                    <input type="number" class="form-control m12" placeholder="Только цифры" required>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="row">
                                                    <div class="">
                                                        <a href="javascript:;" class="btn btn-primary" onclick="test()">Расчитать</a>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label class="font-noraml" id="resId">Средняя сумма</label>
                                                        <input type="number" disabled="" class="form-control sredZP" id="resId">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                                            <button type="button" class="btn btn-primary" onclick="saveZP()" data-dismiss="modal">Сохранить</button>
                                        </div>
                                        
                                        <script>
                                            function test(){
                                                var m1 = $(".m1").val();
                                                m1 = parseInt(m1);
                                                var m2 = $(".m2").val();
                                                m2 = parseInt(m2);
                                                var m3 = $(".m3").val();
                                                m3 = parseInt(m3);
                                                var m4 = $(".m4").val();
                                                m4 = parseInt(m4);
                                                var m5 = $(".m5").val();
                                                m5 = parseInt(m5);
                                                var m6 = $(".m6").val();
                                                m6 = parseInt(m6);
                                                var m7 = $(".m7").val();
                                                m7 = parseInt(m7);
                                                var m8 = $(".m8").val();
                                                m8 = parseInt(m8);
                                                var m9 = $(".m9").val();
                                                m9 = parseInt(m9);
                                                var m10 = $(".m10").val();
                                                m10 = parseInt(m10);
                                                var m11 = $(".m11").val();
                                                m11 = parseInt(m11);
                                                var m12 = $(".m12").val();
                                                m12 = parseInt(m12);
                                                
                                                var sum = m1+m2+m3+m4+m5+m6+m7+m8+m9+m10+m11+m12;
                                                
                                                var sumFloat = parseFloat(sum);
                                                var sredZP = sumFloat/12;
                                                $(".sredZP").val(sredZP);
                                            };
                                                
                                        </script>
                                       </div>
                                </div>
                            </div>
                            
                        <body>
                    </div>

 <div class="back-change">
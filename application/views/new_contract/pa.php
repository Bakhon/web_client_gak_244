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
                        <div class="col-lg-6">                            
                            <label class="font-noraml">Отделение</label>
                            <select class="select2_demo_1 form-control chosen-select">
                                <option value="">Не выбрано</option>
                            <?php                                
                                foreach($NewC->dan['branch'] as $k => $v){
                                    $s = '';
                                    if($NewC->dan['branch']['selected'] == $v){
                                        $s = 'selected';
                                    }
                                    echo '<option value="'.$v['KOD'].' '.$s.'">'.$v['NAME'].'</option>';
                                }
                            ?>
                            </select>                               
                        </div>                                                
                        <?php
                            echo FORMS::InputDate(3, 'Дата заявления', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                            echo FORMS::InputDate(3, 'Дата договора', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false); 
                        ?>
                        <div class="col-lg-3">
                            <br />
                            <label class="font-noraml" style="margin-top: 10px;">
                                <div class="i-checks">
                                    <label class=""> <input type="checkbox" value="" checked=""> <i></i>  Типовой</label></div>
                            </label>
                        </div>
                        <div class="col-lg-3">
                            <br />
                            <label class="font-noraml" style="margin-top: 10px;">
                                <div class="i-checks">
                                    <label class=""> 
                                        <input type="checkbox" value="" checked=""> 
                                        <i></i> Согласие на обработку данных
                                    </label>
                                </div>
                            </label>
                        </div>                        
                    </div>
                    <div class="row"></div>
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row">  
                        <div class="col-lg-8">                            
                            <label class="font-noraml">Аннуитет</label>
                            <input type="text" class="form-control" id="id_user" value="" data="" readonly="readonly" placeholder="Клик для выбора клиента"/>
                            
                            <div class="not_view well" style="display: none;">
                                <input type="text" class="form-control" id="search_user" placeholder="Начните вводить ФИО для поиска..."/>
                                <label>Результат поиска</label>
                                <div class="search_result list-group table-of-contents">
                                    
                                </div>
                            </div>                                                        
                        </div>
                        <div class="col-lg-4">
                            <label class="font-noraml">Возраст на момент заключения</label>                            
                            <input type="number" class="form-control" id="user_age" disabled value="0"/>                            
                        </div>
                                                
                        <div class="col-lg-8">                            
                            <label class="font-noraml">Получатель</label>
                            <input type="text" class="form-control" id="id_poluch" value="" data="" readonly="readonly" placeholder="Клик для выбора клиента"/>                                                         
                        </div>
                        
                        <div class="col-lg-4">
                            <label class="font-noraml">Уведомление о поступлении накоплений</label>
                            <select class="select2_demo_1 form-control">
                                <option value="1">На электронный адрес страхователя</option>
                                <option value="2">По почте на домашний адрес</option>
                                <option value="3">По телефонам</option>
                                <option value="4">По средствам СМС</option>
                                <option value="5">При личном обращении</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row">                      
                        <div class="col-lg-8">                            
                            <label class="font-noraml">Фонд</label>
                            <select class="select2_demo_1 form-control chosen-select">
                                <option value="">Не выбрано</option>
                                <?php                                    
                                foreach($NewC->dan['fond'] as $k => $v){
                                    echo '<option value="'.$v['KOD'].'">'.$v['NAME'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-8">                            
                            <label class="font-noraml">Предыдущий КСЖ</label>
                            <select class="select2_demo_1 form-control chosen-select">
                                <option value="">Не выбрано</option>
                                <?php                                    
                                    foreach($NewC->dan['pred_kszh'] as $k => $v){
                                        echo '<option value="'.$v['KOD'].'">'.$v['NAME'].'</option>';
                                    }                                        
                                ?>
                            </select>                               
                        </div>
                        <?php
                            echo FORMS::InputDate(4, 'Дата начала выплат в другом КСЖ', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false); 
                        ?>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row">  
                        <div class="col-lg-4">                            
                            <label class="font-noraml">Работник</label>
                            <select class="select2_demo_1 form-control chosen-select">
                                <option value="">Не выбрано</option>
                                <?php                                        
                                    foreach($NewC->dan['agents'] as $k=>$v){
                                        echo '<option value="'.$v['KOD'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-lg-4">
                            <label class="font-noraml">Основание</label>
                            <input type="text" id="risk" placeholder="" class="form-control">
                        </div>   
                        
                        <div class="col-lg-2">
                            <label class="font-noraml">% от премии</label>
                            <input type="number" id="irsp" class="form-control" value="3" required>                            
                        </div>                     
                        <div class="col-lg-2">
                            <label class="font-noraml">% от выплату</label>
                            <input type="number" id="irsv" class="form-control" value="3" required>                            
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="row">                       
                        <h4>Банковские данные, наличие льгот</h4>
                        <div class="ibox-tools"></div>
                        
                        <div class="col-lg-5">                            
                            <label class="font-noraml">Банк</label>
                            <select class="select2_demo_1 form-control chosen-select">
                                <option value="">Не выбрано</option>
                                <?php                                    
                                    foreach($NewC->dan['banks'] as $k=>$v){
                                        echo '<option value="'.$v['KOD'].'">'.$v['NAME'].'</option>';
                                    }                                        
                                ?>
                            </select>                               
                        </div>
                        <div class="col-lg-3">                
                            <label class="font-noraml">Тип счета</label>
                            <select class="select2_demo_1 form-control">
                                <option value="1">Лицевой</option>
                                <option value="2">Карточный</option>
                                <option value="3">Транзитный</option>
                                <option value="4">Депозитный</option>
                            </select>
                        </div>
                        
                        <div class="col-lg-4">
                            <label class="font-noraml">Счет</label>
                            <input type="text" placeholder="" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="font-noraml">ИИК</label>
                            <input type="text" placeholder="" class="form-control" required>
                        </div>                    
                        <div class="col-lg-4">
                            <label class="font-noraml">Наличие льгот по налогооблажению</label>
                            <select class="select2_demo_1 form-control">
                                <option value="1">Не имеет льгот</option>
                                <option value="2">Инвалид I группы</option>
                                <option value="3">Инвалид II группы</option>
                                <option value="4">Инвалид III группы</option>
                                <option value="5">Инвалид с детства</option>
                                <option value="6">Один из родителей инвалида с детства</option>
                                <option value="7">Участник ВОВ и лица приравненные к ним</option>                                        
                            </select>
                        </div>
                        <?php
                            echo FORMS::InputDate(3, 'Действует до', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false); 
                            echo FORMS::InputDate(2, 'Срок действия льгот с', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                            echo FORMS::InputDate(2, 'по', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                        ?>
                        <div class="col-lg-4">
                            <label class="font-noraml">Номер справки</label>
                            <input type="text" placeholder="" class="form-control" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- Расчетная часть -->
                    <div class="row">
                        <h2>Расчет выплат</h2>
                        <div class="ibox-tools"></div>
                        <h4>Размер пенсионных накоплений</h4>
                        <div class="ibox-tools"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-2">
                            <label class="font-noraml">По выписке</label>
                            <input type="number" placeholder="0" class="form-control" value="0" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Обязательные пенсионные взносы ЕНПФ (ОПВ)</label>
                            <input type="number" id="pay_sum_gfss" class="form-control" placeholder="0" value="0" required>
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Добровольные взносы с НПФ (ДПВ)</label>
                            <input type="number" id="npf" class="form-control" placeholder="0" value="0" required>
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Обязательные проф. взносы с ЕНПФ (ОППВ)</label>
                            <input type="number" id="oppv" class="form-control" placeholder="0" value="0" required>
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Выкупная сумма с др. КСЖ</label>
                            <input type="number" id="kszh" class="form-control" placeholder="0" value="0" required>
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Собственные средства</label>
                            <input type="number" id="sobst" class="form-control" placeholder="0" value="0" required>
                        </div>
                        
                        <div class="col-lg-4">
                            <span>Итого переводов</span>
                            <h2 class="font-bold" id="itogo">0 тг.</h2>
                        </div>
                        
                    </div>
                                    
                    
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="font-noraml">Периодичность выплат</label>
                            <select class="select2_demo_1 form-control" id="periodich">
                                <?php 
                                    foreach($NewC->dan['periodich_list'] as $k=>$v){
                                        echo '<option value="'.$v['NAME'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>                                                                
                            </select>
                        </div>
                        
                        <div class="col-lg-2">
                            <label class="font-noraml">Сумма выплаченная из ГАК</label>
                            <input type="number" class="form-control" value=""/>
                        </div>
                        
                        <div class="col-lg-2">
                            <label class="font-noraml">Процентная ставка</label>
                            <input type="number" class="form-control" placeholder="" value="0" required>
                        </div>
                        
                        <div class="col-lg-2">
                            <label class="font-noraml">Возраст</label>
                            <input type="number" id="vozrast" onblur="onBlurPa();" class="form-control" placeholder="Только цифры" required>
                        </div>
                        
                        <div class="col-lg-2">
                            <br />
                            <div class="i-checks">
                                <label style="margin-top: 10px;"> 
                                    <input type="checkbox" value="" checked="">                                     
                                    <i></i>  
                                    <label class="font-noraml">Индексация</label>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row">                        
                        <div class="col-lg-2">
                            <label class="font-noraml">Гарантирванный период (лет)</label>
                            <input type="number" class="form-control" placeholder="Только цифры" id="gp_year" required>
                        </div>
                        
                        <?php
                            echo FORMS::InputDate(2, 'С', 'iCONTRACT_DATE', 'CONTRACT_DATE', 'form-control', '', false, false);
                        ?>                        
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row">
                        <div class="col-lg-2">
                            <label class="font-noraml">Срок осуществления выплат</label>
                            <input type="number" class="form-control" placeholder="Только цифры" required>
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Период отсрочки</label>
                            <input type="number" disabled="" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Первая выплата</label>
                            <input type="number" disabled="" class="form-control" placeholder="Кол-во лет">
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Первая выплата</label>
                            <input type="number" disabled="" class="form-control" placeholder="Кол-во месяцев">
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Расходы СО</label>
                            <input id="rashodyS" type="number" onblur="rashodySO();" class="form-control" placeholder="От страх.премии" required>
                        </div>
                        <script>
                            function rashodySO(){
                                var rash = $('#rashodyS').val();
                                if(rash > 3 || rash < 1){
                                    alert('Число в окне "Расходы СО" должно быть от 0 до 3!');
                                }
                            };
                        </script>
                        <div class="col-lg-2">
                            <label class="font-noraml">От страховой выплаты</label>
                            <input type="number" class="form-control" placeholder="От страх.выплаты" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                           
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">                            
                                <button class="btn btn-primary" id="calc_btn">Расчет аннуитетного фактора и выплаты</button>                            
                        </div>
                        <div class="col-lg-4">
                        </div>
                        
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-1">
                            <label class="font-noraml">Выплата</label>
                            <input type="number" disabled="" class="form-control" placeholder="">
                        </div>
                        <div class="col-lg-1">
                            <label class="font-noraml">АФ</label>
                            <input type="number" disabled="" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">Количество гарант. выплат</label>
                            <input type="number" disabled="" class="form-control" placeholder="">
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">АФ с учетом расходов</label>
                            <input type="number" disabled="" class="form-control" placeholder="">
                        </div>
                        <div class="col-lg-2">
                            <label class="font-noraml">% пенсионных расходов</label>
                            <input type="number" disabled="" class="form-control" placeholder="">
                        </div>
                        <div class="col-lg-1">
                            <label class="font-noraml">%</label>
                            <input type="number" disabled="" class="form-control" placeholder="">
                        </div>
                        
                    </div>
                        <div class="row">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        <div class="hr-line-dashed"></div>
                            <span>
                                Достаточная премия
                            </span>
                            <h2 class="font-bold">
                                390,00 ТГ.
                            </h2>
                        </div>
                        </div>
                        <script>                        
                        $('.osnVidDeyatelnosty').change(function() {
                             var v = $(this).val();
                             alert($(this).val());
                             alert($(this).attr("title"));
                             
                             
                             $('#risk').val($(this).attr("title"));                                                                                                    
                             $('#oked').val($(this).val());
                             $('#vd').val($(this).attr('title'));
                        });
                        </script>
                        
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

<style>
input{
	border:1px solid #ccc;
	padding:8px;
	font-size:14px;
	width:300px;
	}
	
.submit{
	width:110px;
	background-color:#FF6;
	padding:3px;
	border:1px solid #FC0;
	margin-top:20px;}	

</style>
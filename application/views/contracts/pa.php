<input type="hidden" id="CNCT_ID" value="<?php echo $dan['contract']['CNCT_ID']; ?>"/>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">                 
                <div class="ibox-title">
                    <div class="btn-group">
                        <?php 
                                
                                foreach($dan as $k=>$v){
                                    $act = '';
                                    if($v['CNCT_ID'] == $cnct_id){$act = 'active';
                                    $clas = 'btn-primary';
                                    }   
                                                                                                         
                                    echo '<button class="btn '.$clas.' get_contract" type="button" data="'.$v['CNCT_ID'].'">'.$v['CONTRACT_NUM'].'</button>';                                    
                                }
                            ?>                 
                    </div>                    
                </div>
            </div>
             
                  <script type="text/javascript" language="javascript">
$(document).ready(function(){
	 $(".ibox-title").click(
	 function()
	 {
			 $(this).parent().children(".ibox-content").slideToggle();
             
            
	 }
	 );
 })
              </script>
              
    <style type="text/css">
.ibox-content{ display:none;}
.ibox-title{text-decoration:none; cursor:pointer;}
</style>          
              
            <div class="ibox float-e-margins">                 
                <div class="ibox-title">
                    <h5 id="title_program"><?php echo $v['PROGR_NAME']; ?> (Просмотр договора)</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                                        
                    </div> 
                </div>   
                                    
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>№ и Дата договора</label></div>
                        <div class="col-sm-3">
                            <span  class="form-control" readonly><?php echo $v['CONTRACT_NUM']; ?></span>
                        </div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $v['CONTRACT_DATE']; ?></span>
                        </div>
                        <div class="col-sm-4">  
                            <span class="form-control" readonly>Инспектор: <?php echo $v['EMP_NAME']; ?></span>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>№ и Дата заявления</label></div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $v['ZV_NUM']; ?></span>
                        </div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $v['ZV_DATE']; ?></span>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Аннуитент</label></div>
                        <div class="col-sm-10">
                            <span class="form-control" readonly><?php echo $v['ANNUIT']; ?></span>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Получатель</label></div>
                        <div class="col-sm-10">
                            <span class="form-control" readonly><?php echo $v['POLUCH_NAME']; ?></span>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Возраст аннуителя</label></div>
                        <div class="col-sm-10">
                            <span class="form-control" readonly><?php echo $v['AGE']; ?></span>
                        </div>
                                                                 
                    </div>                                        
                    <br />
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Отделение</label></div>
                        <div class="col-sm-10">
                            <span class="form-control" readonly><?php echo $v['BRANCH_NAME']; ?></span>
                        </div>                                                   
                    </div>
                    <hr />
                    
                    <div class="row">
                        <div class="col-sm-2 text-right"><label>Фонд</label></div>
                        <div class="col-sm-10">
                            <span class="form-control" readonly><?php echo  $v['CONTAG_NAME']; ?></span>
                        </div>                                                   
                    </div>
                                        
              
                                     
                </div>
            </div>
            
            <div class="ibox float-e-margins border-bottom">
                <div class="ibox-title">
                    <h5>Банковские данные</h5>
                   <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                                        
                    </div> 
                </div>
                
                <div class="ibox-content" style="display: none;">
                    <div class="row">
                        <div class="col-sm-2"><label>Банк</label></div>
                        <div class="col-sm-10">                                                
                            <span class="form-control" readonly><?php echo $v['BANK_NAME']; ?></span>
                        </div>
                        
                        <hr />
                      
         
                        <div class="col-sm-2"><label>Счет</label></div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $v['P_ACCOUNT']; ?></span>
                        </div>
                         <hr />
                        <div class="col-sm-2"><label>Тип счета</label></div>
                        <div class="col-sm-2">
                            <span class="form-control" readonly><?php echo $v['ACC_TYPE']; ?></span>
                        </div>
                         <hr />
                        <p>&nbsp;</p>
                    </div>
                    
                    <div class="row">      
                        <div class="col-sm-2"><label>Наличие льгот по налогообложению</label></div>
                        <div class="col-sm-3">
                            <span class="form-control" readonly><?php echo $v['LGOT_NAME']; ?></span>
                        </div>
                        
                        <div class="col-sm-3"><label>Период действия льгот</label></div>
                        <div class="col-sm-2"><span class="form-control" readonly><?php echo $v['LGOT_BEGIN_DATE']; ?></span></div>
                        <div class="col-sm-2"><span class="form-control" readonly><?php echo $v['DATE_END_LGOT']; ?></span></div>
                       </div> 
                        <hr />
                        <div class="row">
                        <div class="col-sm-2"><label>Размер пособия на погробение</label></div>
                        <div class="col-sm-4"><span class="form-control" readonly><?php echo $v['POGREB_PAY']; ?></span></div>
                        </div>
                    
                         
                    </div>
                </div>
            
            
            
              <div class="ibox float-e-margins border-bottom">
                <div class="ibox-title">
                    <h5>Расчетные данные</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                                        
                    </div>
                </div>
                
                <div class="ibox-content" style="display: none;">
                    <div class="row">
                        <div class="col-sm-2"><label>Размер пенсионных отчислений</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_ALL_PENS']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>Добровольные взносы с НПФ</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_P_DOBR']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>Обязательные проф. взносы с ЕНПФ (ОППВ)</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_P_F']; ?></span>
                        </div>
                        </div>
                        
                        <hr />
                       <div class="row">
                        <div class="col-sm-2"><label>Обязательные взносы (ОПВ)</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_ALL_PENS']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>Периодичность</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['PERIODICH']; ?></span>
                        </div>
                        
                        <div class="col-sm-2"><label>Средний месячный размер дохода</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_ALL_AVG']; ?></span>
                        </div>
              
                        
                        <p>&nbsp;</p>
                    </div>
                     <hr />
                   <div class="row">
                        <div class="col-sm-2"><label>Страховая выплата</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['PAY_SUM_V']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>Срок выплаты</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SROK_PAYM']; ?></span>
                        </div>
                        
                        <div class="col-sm-2"><label>Сумма достаточности</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_DOSTAT']; ?></span>
                        </div>
                </div>
                <hr />
                
                <div class="row">
                        <div class="col-sm-2"><label>Страховая премия</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_P_F']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>Гарант период</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['GARANT_PERIOD']; ?></span>
                        </div>
                        
                        <div class="col-sm-2"><label>Гарант период с</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['GARANT_PERIOD_BEGIN']; ?></span>
                        </div>
                </div>
                <hr />
                <div class="row">
                        <div class="col-sm-2"><label>АФ</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['AF']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>АФ2</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['AF2']; ?></span>
                        </div>
                        
                        <div class="col-sm-2"><label>Собственные средства</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['SUM_P_SOBST']; ?></span>
                        </div>
                </div>
                <hr />
                <div class="row">
                       <div class="col-sm-2"><label>Ставка доходности</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['STAVKA']; ?></span>
                        </div>
                        
                        <div class="col-sm-2"><label>Количество гарант. выплат</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['CNT_GARANT_VIPL']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>Остаток премии</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['PAY_SUM_P_OST']; ?></span>
                        </div>
                </div>
                
                 <hr />
            
            
                 
                <div class="row">
                        
                        <div class="col-sm-2"><label>Процент</label></div>
                        <div class="col-sm-2">                                                
                            <span class="form-control" readonly><?php echo $v['PAY_SUM_P_OST']; ?></span>
                        </div>
                        <div class="col-sm-2"><label>Рассчитан по калькулятору</label></div>
                        <div class="col-sm-6">                                                
                            <span class="form-control" readonly><?php echo $v['CALC_NAME']; ?></span>
                        </div>
                        
                        
                </div>
                <hr />
            </div>
        </div>
    </div>

         
         <div class="col-lg-4" style="background-color: white;" >
          <div class="ibox float-e-margins">                                         
                <div class="col-lg-12" >                 
                    <label>Дата начала выплат </label>                                        
                    <span class="form-controll" readonly><?php echo $v['DATE_BEGIN_DOGOV']; ?></span>
                    
                    <label>Дата окончания</label>
                    <span class="form-controll" readonly><?php echo $v['DATE_END']; ?></span>
                    
                    <label>Дата расчета</label>
                    <span class="form-controll" readonly><?php echo $v['DATE_CALC']; ?></span>
                    
                    <label>Оплатить до</label>
                    <span class="form-controll" readonly><?php echo $v['DATE_OPL_DO']; ?></span>
                    
                    <label>От премии</label>
                    <span class="form-controll" readonly><?php echo $v['IRSP']; ?></span>
                    <label>От выплаты</label>
                    <span class="form-controll" readonly><?php echo $v['IRSV']; ?></span>                    
                    <label>Доля от пенсионных накоплений</label>
                    <span class="form-controll" readonly><?php echo $v['PERSENT_P'].'%'; ?></span>                    
                    <label>Первая выплата за 0 лет</label>
                    <span class="form-controll" readonly><?php echo $v['FIRST_VIPL'].' тг.'; ?></span>
                     <label>Статус</label>
                    <span class="form-controll" readonly><?php echo $v['STATE_NAME']; ?></span>  
                    <label>Уровень принятия решения</label>
                    <span class="form-controll" readonly><?php echo $v['LEVEL_NAME']; ?></span>
                    <label>Предыдущий КСЖ</label>
                    <span class="form-controll" readonly><?php echo $v['FIRST_INSUR']; ?></span>
                    <label>Начало выплат по 1-й справке в пред.КСЖ</label>
                    <span class="form-controll" readonly><?php echo $v['DATE_KSZH']; ?></span>
                    <label>Примечание</label>
                    <span class="form-controll" readonly><?php echo $v['NOTE']; ?></span>
                    
                    <input type="checkbox" <?php if($v['DATA_COLLECT']==1){echo 'checked=""';} else {echo '';} ?> <?php echo 'disabled="" <i></i><label><div id="chekBoxPadding">Согласие на обработку данных</div></label>'?>
                    <input type="checkbox" <?php if($v['OPEKUN']==0){echo 'checked=""';} ?> <?php echo 'disabled="" <i></i><label><div id="chekBoxPadding">Отсутствие страх.дела</div></label>'?> 
                    
                     <hr/>
                     <input type="checkbox" <?php if($v['NASLED']==1){echo 'checked=""';} else {echo '';} ?> <?php echo 'disabled="" <i></i><label><div id="chekBoxPadding">С наследованием</div></label>'?> 
                   
                     <input type="checkbox" <?php if($v['DATA_COLLECT']==1){echo 'checked=""';} else {echo '';} ?><?php  echo 'disabled="" <i></i><label><div id="chekBoxPadding">Наличие индексации страховых выплат</div></label>'?> 
                </div>
            </div>
             
         </div>
         
         
         
            
    
    
    </div> 

</div>
  
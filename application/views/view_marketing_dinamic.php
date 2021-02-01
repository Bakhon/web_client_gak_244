<div class="row wrapper wrapper-content">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <form class="form-horizontal" method="get" action="marketing_dinamic">
                        <div class="col-lg-2">
                            <label>Период с </label>
                            <input type="date" class="form-control" name="period_begin" value="<?php echo date("Y-m-d", strtotime($d->d1)); ?>"/>
                        </div>
                        
                        <div class="col-lg-2">
                            <label>По</label>
                            <input type="date" class="form-control" name="period_end" value="<?php echo date("Y-m-d", strtotime($d->d2)); ?>"/>
                        </div>
                        
                        <div class="col-lg-2">
                            <label>Отделение</label>
                            <select class="form-control" name="asko">
                                <option value="">Все</option>
                                <?php 
                                    foreach($dan['list_asko'] as $k=>$v){
                                        $s = '';
                                        if($v['ID'] == $d->asko){
                                            $s = 'selected';
                                        }
                                        echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';
                                    }
                                ?>                            
                            </select>
                        </div>
                        
                        <div class="col-lg-4">
                            <label>Филиал</label>
                            <select class="form-control" name="region">
                                <option value="">Все</option>
                                <?php 
                                    foreach($dan['list_regions'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                    }
                                ?>                            
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn btn-info form-control" value="Фильтр"/>
                        </div>
                        <div class="col-lg-1">
                            <label>&nbsp;</label>
                            <a href="javascript:;" class="btn btn-default form-control" id="print"><i class="fa fa-print"></i></a>
                        </div>
                        <label></label>                    
                    </form>
                    <div class="col-lg-12" id="print_panel">
                        <center>
                            <h3>Динамика поступления страховых премий взятых в доход по ОСНС</h3>
                            <h3>за период с <?php echo date("d.m.Y", strtotime($d->d1)); ?> г. по <?php echo date("d.m.Y", strtotime($d->d2)); ?> г.</h3>
                        </center>
                        <table class="table table-bordered">
                    	<thead>
                    		<tr>
                    			<th colspan="1" rowspan="3">№ п\п</th>
                    			<th colspan="1" rowspan="3">Наименование филиала</th>
                    			<th colspan="2" rowspan="1">ПЛАН</th>
                    			<th colspan="5" rowspan="1">ФАКТ</th>
                    			<th colspan="6" rowspan="1">Из них</th>
                    		</tr>
                    		<tr>
                    			<th colspan="1" rowspan="2">Общий план по количеству договоров на <?php echo date("Y", strtotime($d->d1)); ?> год </th>
                    			<th colspan="1" rowspan="2">Общий план по сумме страховых премий на <?php echo date("Y", strtotime($d->d1)); ?> год </th>
                    			<th colspan="1" rowspan="2">Общее кол-во договоров</th>
                    			<th colspan="1" rowspan="2">% выполнения плана по количеству договоров</th>
                    			<th colspan="1" rowspan="2">Общая страховая премия</th>
                    			<th colspan="1" rowspan="2">% выполнения плана по сумме страховых премий</th>
                    			<th colspan="1" rowspan="2">Из них: общая сумма страховой премии, переданной на перестрахование</th>
                    			<th colspan="3" rowspan="1">Филиалы</th>
                    			<th colspan="3" rowspan="1">Страховые посредники</th>
                    		</tr>
                    		<tr>
                    			<th>количество договоров</th>
                    			<th>страховая премия</th>
                    			<th>из них: страховая премия, переданная на перестрахование</th>
                    			<th>количество договоров</th>
                    			<th>страховая премия</th>
                    			<th>из них: страховая премия, переданная на перестрахование</th>
                    		</tr>
                      </thead>
                      <tbody>
                        <?php
                            $int = 1; 
                            foreach($dan['table'] as $k=>$v){ 
                        ?>
                        <tr>
                			<td class="text-center"><?php echo str_replace(",", " ", $int); ?></td>
                			<td><?php echo $v['NAME']; ?></td>
                			<td class="text-center"><?php echo 0; ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['SUM_PLAN']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['CNT']); ?></td>
                			<td class="text-center"><?php echo 0; ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['PAY_SUM_P']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['PROC_PLAN']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['PAY_SUM_STRAH']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['CNT_FILIALS']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['PAY_SUM_FILIALS']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['PAY_SUM_STRAH_FILIALS']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['CNT_KOS']); ?></td>
                			<td class="text-center"><?php echo str_replace(",", " ", $v['PAY_SUM_KOS']); ?></td>
                    	    <td class="text-center"><?php echo str_replace(",", " ", $v['PAY_SUM_STRAH_KOS']); ?></td>
                    	</tr>
                   		<?php
                           $int++; 
                           } 
                        ?>
                    	</tbody>
                        </table>
                    </div>                                          
                </div>
            </div>
        </div>                
    </div>
</div>

<style>
    th{
        text-align: center;
    }
</style>
<script>
    var old_html = '';
    var panel_html = '';
    $('#print').click(function(){
        panel_html = $('#print_panel').html();
        old_html = $('body').html();
        $('body').html(panel_html);
        window.print();
        $('body').html(old_html);        
    });
</script>

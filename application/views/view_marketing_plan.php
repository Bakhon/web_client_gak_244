<?php
	/**
     * View
     * */
    $cnt = 0;
    $paysum = 0;    
    foreach($dan['static'] as $k=>$v){
        $cnt += $v['CNT'];
        $paysum +=  $v['PAY_SUM'];
    }
       
?>

<div class="row">
    <div class="col-lg-12">           
        <div class="ibox">
            <div class="ibox-content">                       
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins well">
                            <div class="ibox-title">
                                <h5>Общее количество договоров</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($cnt, 0, ',', ' '); ?></h1>                                
                                <small><i class="fa fa-info"></i> Общее количество заключенных договоров за период с 01.01.<?php echo date("Y"); ?> г. по 31.12.<?php echo date("Y"); ?> г.</small>
                            </div>
                        </div>                                                                
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins well">
                            <div class="ibox-title">
                                <h5>Страховая премия по договорам</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($paysum, 0, ',', ' '); ?></h1>                                
                                <small><i class="fa fa-info"></i> Cумма премий по заключенным договорам за период с 01.01.<?php echo date("Y"); ?> г. по 31.12.<?php echo date("Y"); ?> г.</small>
                            </div>
                        </div>                                                                
                    </div>  
                    
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins well">
                            <div class="ibox-title">
                                <h5><?php echo $dan['active_region']; ?></h5>
                            </div>
                            <div class="ibox-content">
                                <select class="form-control" id="list_region">
                                    <option value="0">Все филиалы</option>
                                    <?php 
                                        foreach($dan['list_region'] as $k=>$v){
                                            $s = '';
                                            if($v['ID'] == $dan['active_region_id']){
                                                $s = 'selected';    
                                            }                                            
                                            echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['TYPE_NAME'].' - '.$v['NAME'].'</option>';      
                                        }
                                    ?>                                    
                                </select>                                                                
                                <small><i class="fa fa-info"></i> Фильтрация. Выберете филиал для отображения</small>
                            </div>
                        </div>                                                                
                    </div>                                        
                </div>    
                
                <div class="row">
                    <?php 
                        foreach($dan['static'] as $k=>$v){
                            $ps = round($v['PAY_SUM'] / $v['SUM_PLAN'] * 100, 2);
                    ?>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins well">
                            <div class="ibox-title">
                                <h5><?php echo $v['PRODUCT_NAME']; ?></h5>
                                <span class="label label-success pull-right"><i class="fa fa-li"></i> <?php echo $ps; ?> % (<?php echo number_format($v['SUM_PLAN'], 0, ',', ' '); ?>)</span>
                            </div>
                            <div class="ibox-content list_contr">                                
                                <h1 class="no-margins"><?php echo number_format($v['PAY_SUM'], 0, ',', ' '); ?></h1>      
                                
                                <div class="progress" style="height: 10px;background-color: #FF6600;">
                                    <div style="width: <?php echo $ps; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="35" role="progressbar" class="progress-bar progress-striped progress-bar-success">
                                        <span class="sr-only"><?php echo $ps; ?>% Complete (success)</span>
                                    </div>
                                </div>
                       
                                <ul class="list-group clear-list m-t">                                                                                                
                                <?php 
                                    foreach($v['list_max'] as $t=>$d){
                                        echo '<li class="list-group-item fist-item">
                                            <span class="pull-right">
                                                <strong>'.$d['PAY_SUM'].'</strong>
                                            </span>
                                            <span class="label label-success">'.$d['ROWNUM'].'</span> <span>'.$d['NAME'].'</span>
                                        </li>';
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>                                                                
                    </div>
                    <?php } ?>
                </div> 
                
                <div>
                    <div id="lineChart"></div>
                </div>     
                
                           
            </div>
        </div>                 
    </div>                            
</div>
<link href="styles/css/plugins/c3/c3.min.css" rel="stylesheet">
<script src="styles/js/plugins/c3/c3.min.js"></script>
<script src="styles/js/plugins/c3/d3.min.js"></script>
<script>
    <?php 
        echo $method->js;
    ?>
</script>
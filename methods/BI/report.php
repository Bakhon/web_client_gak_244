<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5 class="collapse-link"><?php echo $dan['title']; ?></h5>
        <div class="ibox-tools">
            <span class="collapse-link"><i class="fa fa-chevron-up"></i></span>
            <span class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></span>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="bi1?create_block=<?php echo $dan['id']; ?>" class="btn_href">Создать блок</a></li>
                <li><a href="#" class="edit_params btn_href" data="<?php echo $dan['id']; ?>">Редактировать</a></li>
            </ul>                            
        </div>
    </div>                        
    <div class="ibox-content" id="list_params">
        <div class="row">
            <?php 
                if(count($dan['params']) > 0){
                    echo '<form method="POST" id="form'.$dan['id'].'">';
                    foreach($dan['params'] as $p=>$s){
                        $p_input = array(
                            "T"=>'<input type="text" name="'.$s['NAME'].'" class="form-control" value="" />',
                            "D"=>'<div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="'.$s['NAME'].'" class="form-control  input-sm" data-mask="99.99.9999" value="">
                              </div>',
                            "S"=>'<select class="form-control" name="'.$s['NAME'].'">
                            </select>'
                        );
                        echo '<div class="col-lg-3"><label>'.$s['TEXT'].'</label>';
                        echo $p_input[$s['TYPE']];
                        echo '</div>';
                    }
                    echo '<div class="col-lg-2">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn btn-info btn-block" data-result="chart_result" data="form'.$dan['id'].'" value="Сформировать" />
                        <input type="hidden" name="get_report" value="'.$dan['id'].'">
                    </div></form>';
                }
                
                foreach($dan['blocks'] as $k=>$v){
                    
                }
            ?>
            <div class="col-lg-12" id="chart_result">
                
                <pre>
               <?php print_r($dan); ?>
               </pre>
            </div>
            
            
        </div>
    </div>
</div>
<script>
    $.getScript("styles/js/plugins/fullcalendar/moment.min.js");
    $.getScript("styles/js/plugins/daterangepicker/daterangepicker.js");
    $.getScript('styles/js/plugins/datapicker/bootstrap-datepicker.js');
</script>
<?php
	//Файл HTML тела отчета    
?>
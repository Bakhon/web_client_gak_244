<div class="row">    
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Список отчетов</h5>
                <div class="ibox-tools">                    
                    <span class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></span>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="bi1?create_report" class="btn_href">Создать</a></li>
                        <li><a href="#" id="edit_report" class="btn_href">Редактировать</a></li>
                    </ul>                    
                </div>
            </div>                        
            <div class="ibox-content">
                <?php 
                    foreach($dan['reports'] as $k=>$v){
                        echo '<a href="bi1?report='.$v['ID'].'" class="btn btn-block btn-outline btn-primary btn-xs btn_reports btn_href" data="'.$v['ID'].'">'.$v['NAME'].'</a>';
                    }                    
                ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12" id="result">        
        <?php echo $bi->html; ?>
    </div>
    
    <div class="console" style="display: none;">
        <div class="ibox float-e-margins border-bottom" style="margin-bottom: 0px;">
            <div class="ibox-title">
                <h5>Console</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                    
                </div>
            </div>
            <div class="ibox-content" style="display: none;">                        
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab_text">Сообщение</a></li>
                        <li class=""><a data-toggle="tab" href="#tab_sql">SQL результат</a></li>
                        <li class=""><a data-toggle="tab" href="#tab_html">HTML результат</a></li>
                    </ul>
                    <div class="tab-content" style="height: 300px;">
                        <div id="tab_text" class="tab-pane active">
                            <div class="panel-body" style="overflow: auto; height: 300px;">
                                
                            </div>
                        </div>
                        <div id="tab_sql" class="tab-pane">
                            <div class="panel-body" style="overflow: auto; height: 300px;">
                                                            
                            </div>
                        </div>
                        
                        <div id="tab_html" class="tab-pane">
                            <div class="panel-body" style="overflow: auto; height: 300px;">

                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>                
    </div>
</div>    


<style>
.console{
    display: block;
    position: fixed;
    right: 0px;
    bottom: 0px;
    width: 88%;
}
</style>
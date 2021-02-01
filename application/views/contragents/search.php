<?php
    $contr_name = '';
    $bin = '';
    if(isset($GETS['contragent'])){
        $contr_name = $GETS['contragent'];
    }
    if(isset($GETS['bin'])){
        $bin = 	$GETS['bin'];
    }
?>
<div class="ibox float-e-margins">    
    <div class="ibox-title collapse-link">
        <h5>Поисковая панель</h5>
        <div class="ibox-tools">
            <span><i class="fa fa-chevron-up"></i></span>
        </div>
    </div>                        
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-7">                                    
                <div class="col-sm-12 b-r">
                    <div class="ibox-content">
                        <h3 class="m-t-none m-b">Поиск по наименованию</h3>
                        <form role="form" method="get">                                
                            <div class="form-group">                                    
                                <div class="input-group">
                                    <input type="text" name="contragent" placeholder="'Название фирмы' (Пример)" class="form-control input-sm" value="<?php echo $contr_name; ?>">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                    </span>   
                                    <input type="hidden" name="search" /> 
                                </div>                                    
                            </div>                               
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">                                    
                <div class="col-sm-12 b-r">
                    <div class="ibox-content">
                        <h3 class="m-t-none m-b">Поиск БИН</h3>
                            <form role="form" method="get">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="bin" placeholder="123456789101 (Пример)" class="form-control input-sm" value="<?php echo $bin; ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                        </span>    
                                        <input type="hidden" name="search"/>
                                    </div>                                    
                                </div>                               
                            </form>
                        </div>
                    </div>
                </div>                        
            </div>                            
        </div>                              
    </div>
                                
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <a href="contragents?group" class="btn btn-primary btn-sm" id="list-groups-contragents" style="margin-right: 15px;"><i class="fa fa-group"> Группы</i></a>
            <a href="contragents?edit=0" class="btn btn-sm btn-primary"><i class="fa fa-plus"> Добавить</i></a>                              
        </div>                                                
        <?php echo $contragents->html; ?>
    </div>  
    <div id="dan_contr"></div>
<style>
td{
    cursor: pointer;
}
</style>
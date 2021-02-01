<div class="row">
    <div class="col-lg-3">
        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Поиск и Фильтрация</h5>
            </div>
            <form method="get">
                <div class="ibox-content">
                    <h5>Наименование страхователя</h5>
                    <div class="form-group">                        
                        <?php
                                $search_contragents = '';
                                if(isset($_GET['search_contragents'])){
                                    $search_contragents = $_GET['search_contragents'];
                                }
                            ?>
                        <input type="text" name="search_contragents" class="form-control input-sm" id="search_contragent" placeholder="Начните вводите наименование контаргента" value="<?php echo htmlspecialchars($search_contragents); ?>">
                    </div>
                    <br />   
                    
                    <h5>Период заключения</h5>
                    <div class="form-horizontal">                    
                        <div class="form-group">
                            <label class="col-lg-2">С: </label>
                            <div class="input-group date col-lg-10">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php
                                    $date_begin = '';
                                    if(isset($_GET['date_begin'])){
                                        $date_begin = $_GET['date_begin'];
                                    }
                                ?>
                                <input type="text" name="date_begin" class="form-control date_begin input-sm" data-mask="99.99.9999" value="<?php echo $date_begin; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2">По: </label>
                            <div class="input-group date col-lg-10">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php
                                    $date_end = '';
                                    if(isset($_GET['date_end'])){
                                        $date_end = $_GET['date_end'];
                                    }
                                ?>
                                <input type="text" name="date_end" class="form-control date_end input-sm" data-mask="99.99.9999" value="<?php echo $date_end; ?>">
                            </div>
                        </div>                    
                    </div>
                    
                    <br />
                    <h5>№ договора перестрахования</h5>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            <?php
                                $contract_num = '';
                                if(isset($_GET['contract_num'])){
                                    $contract_num = $_GET['contract_num'];
                                }
                            ?>
                            <input type="text" name="contract_num" class="form-control input-sm" value="<?php echo $contract_num; ?>">
                        </div>
                    </div>
                    
                    <br />
                    <h5>Наименовани перестраховщика</h5>
                    <div class="form-group">
                        <select class="form-control" name="search_reins" id="reins_list">
                            <option value="0">- Не выбрано</option>
                            <?php 
                                $search_reins = 0;
                                if(isset($_GET['search_reins'])){
                                    $search_reins  = $_GET['search_reins'];
                                }
                                foreach($reins_contr->reins_list() as $k=>$v){
                                    $s = '';
                                    if($v['ID'] == $search_reins){
                                        $s = 'selected';
                                    }
                                    echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['R_NAME'].'</option>';
                                }
                            ?>                        
                        </select>
                    </div>
                    
                    <br />
                    <h5>Вид перестрахования</h5>
                    <div class="form-group">
                        <label>
                            <input type="radio" name="typ" value="0" <?php echo $reins_contr->type[0]; ?>/> Все
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="typ" value="1" <?php echo $reins_contr->type[1]; ?>/> Облигатор
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="typ" value="2, 3" <?php echo $reins_contr->type[2]; ?>/> Факультатив
                        </label>
                        
                    </div>
                    
                    <br />                     
                    <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search"></i> Найти</button>
                </div>
            </form>    
        </div>
        
    </div>  
    
    <div class="col-lg-9">    
        <div class="ibox float-e-margins">
            <div class="ibox-title">
              Список договоров
            </div>
            <div class="ibox-content">
            <?php     
                if(isset($reins_contr->dan)){            
                foreach($reins_contr->dan as $k=>$v)
                {
                    if($v['TYP'] == '1')
                    {
                        $url_htm = "reins_bordero?export_html=".$v['ID'];
                        $url_pdf = "reins_bordero?export_pdf=".$v['ID'];
                        $url_xls = "reins_bordero?export_xls=".$v['ID'];    
                    }else{                        
                        $url_htm = "reins_export?contract_num=".$v['ID']."&&export=html";
                        $url_pdf = "reins_export?contract_num=".$v['ID']."&&export=pdf";
                        $url_xls = "reins_export?contract_num=".$v['ID']."&&export=xls";
                    }                                                          
            ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-cog"></i> <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <?php 
                                      if($v['TYP'] == 2){
                                    ?>                                    
                                    <li><a href="print?id=<?php echo $v['ID']; ?>" target="_blank"><i class="fa fa-2x fa-file-text-o"></i> Печать договора</a></li>
                                    <?php  }?>
                                    <li><a href="<?php echo $url_htm; ?>" target="_blank"><i class="fa fa-file-text-o"></i> HTML</a></li>
                                    <li><a href="<?php echo $url_pdf; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                    <li><a href="<?php echo $url_xls; ?>" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a></li>                                                                        
                                    <li class="divider"></li>
                                    <li><a href="reins_bordero?form_setstate=<?php echo $v['ID']; ?>" target="_blank">Показать в отдельном окне</a></li>
                                </ul>
                            </div>
                                                        
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $v['ID']; ?>" aria-expanded="false" class="">
                                <span class="hts">№ договора: <span class="text-danger"><?php echo $v['CONTRACT_NUM']; ?></span></span>
                                <span class="hts">Дата: <span class="text-danger"><?php echo $v['CONTRACT_DATE']; ?></span></span>
                                <span class="hts">Сумма: <span class="text-danger"><?php echo $v['PAY_SUM']; ?></span></span>                                                       
                                <span class="hts">Кол-во: <span class="text-danger"><?php echo $v['COUNT_CONTRACTS']; ?></span></span>
                                <span>Статус: <span class="text-danger"><?php echo $v['STATE_NAME']; ?></span></span>                                                                
                            </a>                            
                        </h5>
                    </div>
                    <div id="collapse<?php echo $v['ID']; ?>" class="panel-collapse collapse" aria-expanded="false">
                        <div class="panel-body" style="overflow: auto;max-height: 400px;">
                            <table class="table table-bordered">   
                            <tr>
                                <th>№ договора страхования</th>
                                <th>Дата договора</th>
                                <th>Страхователь</th>
                                <th>Сумма к начислению</th>
                                <th>Сумма к оплате</th>
                                <th>Комиссия перестраховщика</th>
                                <th>Сумма перестраховщика</th>
                            </tr>                        
                            <?php 
                                foreach($v['list_contracts'] as $t=>$d){
                            ?>
                                <tr>
                                    <td><a target="_blank" href="contracts?CNCT_ID=<?php echo $d['CNCT_ID']; ?>"><?php echo $d['CONTRACT_NUM']; ?></a></td>
                                    <td><?php echo $d['CONTRACT_DATE']; ?></td>
                                    <td><?php echo $d['STRAH']; ?></td>
                                    <td><?php echo $d['PAY_SUM']; ?></td>
                                    <td><?php echo $d['PAY_SUM_OPL']; ?></td>
                                    <td><?php echo $d['KOMIS_REINS']; ?></td>
                                    <td><?php echo $d['SUM_S_STRAH']; ?></td>                                    
                                </tr>
                            <?php
                                }
                            ?>
                            </table>                            
                        </div>
                    </div>
                </div>
            <?php    
                }     
                }           
            ?>
            </div>        
        </div>        
    </div>   
</div>

<style>    
    .sr_result{
        position: relative;
        float: left;
        width: 100%;
        height: auto;
        border: solid 1px silver;
        cursor: pointer;
        background-color: #fff;
        padding: 5px;
    }
    .sr_result:hover{
        background-color: #E4E4E4;
    }
</style>

<script>
    $('#search_contragent').keyup(function(e){
        var s = $(this).val();
        if(s.length >= 3){        
            $.post('reins_contracts', {'search_contragent':s}, function(data){
                $('#search_result').remove();
                var html = '<div id="search_result">';
                var j = JSON.parse(data);
                for(var i=0;i<j.length;i++){
                    html = html+'<span id="'+j[i].ID+'" class="sr_result">'+j[i].NAME+'</span>';
                }
                html = html+'</div>';
                $('#search_contragent').after(html);               
            }); 
        }       
        
    });  
    
    $('body').on('click', '.sr_result', function(){
        var id = $(this).attr('id');
        var vl =  $(this).html();
        $('#search_contragent').attr('data', id);
        $('#search_contragent').val(vl);
        $('#search_result').remove();
    });      
</script>
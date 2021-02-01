<div class="ibox">
    <div class="ibox-title">
        <h3>Поиск договоров</h3>
    </div>
    <div class="ibox-content">
        <form class="row" method="post">            
            <div class="col-lg-3">
                <label>№ договора</label>
                <input type="text" class="form-control" name="contract_num" value="<?php echo $ipn->array['contract_num']; ?>"/>
            </div>
            
            <div class="col-lg-7">
                <div class="col-lg-4">
                    <label>Фамилия</label>
                    <input type="text" class="form-control" name="lastname" value="<?php echo $ipn->array['lastname']; ?>"/>
                </div>
                    
                <div class="col-lg-4">
                    <label>Имя</label>
                    <input type="text" class="form-control" name="firstname" value="<?php echo $ipn->array['firstname']; ?>"/>
                </div>
                
                <div class="col-lg-4">
                    <label>Отчество</label>
                    <input type="text" class="form-control" name="middlename" value="<?php echo $ipn->array['middlename']; ?>"/>
                </div>
            </div>              
            <div class="col-lg-2">
                <label>&nbsp;</label>
                <button class="btn btn-success btn-block" name="search"><i class="fa fa-search"></i> Найти</button>                
            </div>
                        
        </form>
    </div>   
    <div class="ibox-footer">
        <span class="text-muted">
            Если Вы не обнаружили договор в поисковом запросе, значит необходимо ввести более точные данные. 
        </span>
    </div> 
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h3>Результат запроса</h3>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>№ договора</td>
                        <td>Фамилия</td>
                        <td>Имя</td>
                        <td>Отчество</td>
                        <td>Периодичность</td>
                        <td>№</td>
                        <td>Дата</td>
                        <td>Период действия до </td>
                        <td>Заявление о применении налогового вычета</td>
                        <td>Заявление на корректировку ИПН</td>            
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($dan as $k=>$v){
                        $btn1 = '';
                        if(trim($v['FILENAME1']) !== ''){
                            $s = explode('/', $v['FILENAME1']);
                            foreach($s as $l){
                                $local_file = $l;
                            }                            
                            //$local_file = iconv("CP-1251", "UTF-8", $local_file);                                                        
                            $file = str_replace($local_file, urlencode($local_file), $v['FILENAME1']);
                            $btn1 = '<a href="ftp://upload:Astana2014@192.168.5.2'.$file.'" target="_blank" class="btn btn-info">Скачать</a>';
                        }
                    echo '<tr>
                        <td>'.$v['CONTRACT_NUM'].'</td>
                        <td>'.$v['LASTNAME'].'</td>
                        <td>'.$v['FIRSTNAME'].'</td>
                        <td>'.$v['MIDDLENAME'].'</td>
                        <td>'.$v['PERIODICH'].'</td>
                        <td>'.$v['VICH_Z_NUM'].'</td>
                        <td>'.$v['VICH_Z_DATE'].'</td>
                        <td>'.$v['VICH_Z_DATE_END'].'</td>
                        <td>'.$btn1.'</td>            
                        <td>'.$v['FILENAME2'].'</td>
                    </tr>';
                    } 
                ?>
                </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
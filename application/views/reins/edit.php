<?php 
    if(!isset($_GET['id'])){
        header("Location: reins");
    }
    $vids = array(
        array("id"=>"1", "name"=>"облигаторный пропорциональный"),
        array("id"=>"2", "name"=>"облигаторный непропорциональный"),
        array("id"=>"3", "name"=>"Факультатив пропорциональный"),
        array("id"=>"4", "name"=>"Факультатив непропорциональный")
    );
    
    $id = $_GET['id'];
    $dan = $reins->dan;        
?>
<div class="ibox-title">
    <a href="reins" class="btn btn-default btn-xs pull-left"><i class="fa fa-backward"></i> Назад</a>  
    <?php 
        if($_GET['id'] == 0){
            echo '<h5 style="width: 70%; text-align: center;">Создание нового перестраховщика</h5>';        
        }else{
            echo '<h5 style="width: 70%; text-align: center;">'.$dan['R_NAME'].'</h5>';
            if($dan['ACTUAL'] == 1){
                echo '<span id="deactivate_reins" data="'.$dan['ID'].'" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i> Заблокировать</span>';
            }
        }
    ?>          
</div>
<div class="ibox-content">            
    <form method="post" class="form-horizontal">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#tab-1" aria-expanded="true"> Общие данные</a>
                </li>
                <?php if($_GET['id'] !== '0'){ ?>
                <li>
                    <a data-toggle="tab" href="#tab-2" aria-expanded="true"> Реквизиты</a>
                </li>
                <?php } ?>
                <li>
                    <a data-toggle="tab" href="#tab-3" aria-expanded="true"> Договоры</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab-4" aria-expanded="true"> Контакты</a>
                </li>
            </ul>
            
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Полное наименование</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="r_name" value="<?php echo htmlspecialchars($dan['R_NAME']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Краткое наименование</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="r_name_krat" value="<?php echo htmlspecialchars($dan['R_NAME_KRAT']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">БИН</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="BIN" value="<?php echo htmlspecialchars($dan['BIN']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Должность руководителя</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="dir_dolgnost" value="<?php echo htmlspecialchars($dan['DIR_DOLGNOST']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">ФИО руководителя</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="dir_name" value="<?php echo htmlspecialchars($dan['DIR_NAME']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Рейтинг агенства</label>
                            <div class="col-lg-5">
                                <select class="form-control" id="reiting_agent">
                                <?php       
                                  if(isset($dan['ESTIMATION'])){
                                    $es = danreiting($dan['ESTIMATION']);
                                  }else{
                                    $es = 0;
                                  }
                                  foreach(ListReiting() as $k=>$v){
                                    $s = '';
                                    if(isset($dan['ESTIMATION'])){                        
                                        if($v['ID'] == $es['ID']){
                                            $s = 'selected';
                                        }
                                    }
                                    echo '<option value="'.$v['ID'].'" '.$s.'>'.htmlspecialchars($v['NAME']).'</option>';  
                                  }                  
                                ?>
                                </select>                
                            </div>
                            <div class="col-lg-4" id="estimate">
                                <select class="form-control" name="estimation" id="estimation">
                                <?php 
                                  if(isset($dan['ESTIMATION'])){
                                    $es = danreiting($dan['ESTIMATION']);
                                  }else{
                                    $es = 0;
                                  }
                                  
                                  foreach(ListEstimat(0) as $k=>$v){
                                    $s = '';
                                    if(isset($dan['ESTIMATION'])){                        
                                        if($v['ID'] == $es['ID_EG']){
                                            $s = 'selected';
                                        }
                                    }
                                    echo '<option value="'.$v['ID'].'" '.$s.'>'.htmlspecialchars($v['OCENKA']).'</option>';  
                                  }                  
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Страна</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="country">
                                <?php 
                                
                                    //$dan['COUNTRY']
                                    foreach(ListCountry() as $k=>$v){
                                        $s = '';
                                        if(isset($dan['COUNTRY'])){
                                            if($dan['COUNTRY'] == $v['NAME']){
                                                $s = 'selected';
                                            }
                                        }
                                        echo '<option value="'.$v['NAME'].'" '.$s.'>'.$v['NAME'].'</option>';
                                    }
                                ?>
                                </select>                
                            </div>
                        </div>
                                                
                    </div>
                </div>
                <?php if($_GET['id'] !== '0'){ ?>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <a class="btn btn-info btn-xs pull-left" data-toggle="modal" data-target="#add_bank"><i class="fa fa-plus"></i> Добавить</a>
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Наименование</th>
                                <th>БИК / Swift</th>
                                <th>ИИК / IBAN</th>
                                <th>КБЕ</th>
                                <th>КНП</th>
                                <th>Тип</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $banks = listBanksReins($_GET['id']);
                                foreach($banks as $k=>$v){
                                    echo '<tr class="del_bank'.$v['ID'].'">
                                        <td>'.$v['BANK_ID'].'</td>
                                        <td>'.$v['NAME'].'</td>
                                        <td>'.$v['SWIFT'].'</td>
                                        <td>'.$v['IBAN'].'</td>
                                        <td>'.$v['KBE'].'</td>
                                        <td>'.$v['KNP'].'</td>
                                        <td>'.$v['TYPE_TEXT'].'</td>
                                        <td>
                                            <span data="'.$v['ID'].'" id="del_bank" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></span>                                                                      
                                        </td>
                                    </tr>';
                                }
                            ?>
                        </tbody>
                        </table>
                                                
                    </div>
                </div>
                <?php } ?>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Вид</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="vid">
                                <?php 
                                    foreach($vids as $k=>$v){
                                        $s = '';
                                        if(isset($dan['VID'])){
                                            if($dan['VID'] == $v['id']){
                                                $s = 'selected';
                                            }
                                        }
                                        echo '<option value="'.$v['id'].'" '.$s.'>'.$v['name'].'</option>';
                                    }
                                ?>                
                                </select>                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">№ договора облигатора</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="contract_num" value="<?php echo htmlspecialchars($dan['CONTRACT_NUM']); ?>"/>
                            </div>
                            
                            <label class="col-lg-3 control-label">Дата заключения договора облигатора</label>
                            <div class="col-lg-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input name="contract_date" type="text" class="form-control" data-mask="99.99.9999" value="<?php echo htmlspecialchars($dan['CONTRACT_DATE']); ?>">
                                </div>                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Дата начала</label>            
                            <div class="col-lg-3">                
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input name="date_begin" type="text" class="form-control" data-mask="99.99.9999" value="<?php echo htmlspecialchars($dan['DATE_BEGIN']); ?>">
                                </div>                
                            </div>
                            <label class="col-lg-3 control-label">Дата окончания</label>
                            <div class="col-lg-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input name="date_end" type="text" class="form-control" data-mask="99.99.9999" value="<?php echo htmlspecialchars($dan['DATE_END']); ?>" >
                                </div>                
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Лимит премии</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" name="lim_sum" value="<?php echo htmlspecialchars($dan['LIM_SUM']); ?>"/>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Лимит количества работников</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" name="lim_cnt" value="<?php echo htmlspecialchars($dan['LIM_CNT']); ?>"/>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Комиссионный доход</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" name="skidka" value="<?php echo htmlspecialchars($dan['SKIDKA']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Доля страховой суммы перестраховщика</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" name="dol_s_perc" value="<?php echo htmlspecialchars($dan['DOL_S_PERC']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Доля страховой премии перестраховщика</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" name="dol_p_perc" value="<?php echo htmlspecialchars($dan['DOL_P_PERC']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Маржа</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" name="marzha" value="<?php echo htmlspecialchars($dan['MARZHA']); ?>"/>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
                
                <div id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <?php if($_GET['id'] !== '0'){ ?>
                        <a class="btn btn-info btn-xs pull-left" data-toggle="modal" data-target="#add_contact"><i class="fa fa-plus"></i> Добавить</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>ФИО</th>
                                    <th>Должность</th>
                                    <th>Рабочий тел</th>
                                    <th>Мобильный тел</th>
                                    <th>E-Mail</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($reins->list_contacts($_GET['id']) as $k=>$v)
                                    {
                                        echo  '<tr class="del_contact'.$v['ID'].'">
                                            <td>'.$v['ID'].'</td>
                                            <td>'.$v['FIO'].'</td>
                                            <td>'.$v['DOLGNOST'].'</td>
                                            <td>'.$v['RAB_TEL'].'</td>
                                            <td>'.$v['MOB_TEL'].'</td>
                                            <td>'.$v['EMAIL'].'</td>
                                            <td>
                                                <span id="del_contact" data="'.$v['ID'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></span>                                                
                                            </td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>                    
                        <br /><hr />
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Контактные даннные перестраховщика</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="contact_reins" value="<?php echo htmlspecialchars($dan['CONTACT_REINS']); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Контактные даннные ГАК</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="contact_gak" value="<?php echo htmlspecialchars($dan['CONTACT_GAK']); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-lg-9">
                <input type="submit" class="btn btn-success" value="Сохранить"/>
            </div>
        </div>
        <input type="hidden" name="id_reins" value="<?php echo $_GET['id']; ?>"/>
    </form>
        
 </div>  

<?php if($_GET['id'] !== '0'){ ?>
<div class="modal inmodal fade" id="add_contact" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="font-size: 40px;"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить контакт</h4>                
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label>ФИО</label>
                            <input type="text" class="form-control" name="fio" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>Должность</label>
                            <input type="text" class="form-control" name="dolgnost" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>Рабочий телефон</label>
                            <input type="text" class="form-control" name="rab_tel" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>Мобильный телефон</label>
                            <input type="text" class="form-control" name="mob_tel" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="text" class="form-control" name="email" value=""/>                        
                        </div>
                                                
                    </div>                    
                </div>
                <div class="modal-footer">                
                    <button type="submit" class="btn btn-primary" id="save">Добавить</button>                
                </div>
                <input type="hidden" name="set_reins_contact" value="<?php echo $_GET['id']; ?>"/>
            </form>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="add_bank" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="font-size: 40px;"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить банк</h4>                
            </div>
            <form method="post" enctype="multipart/form-data">            
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label>Банк</label>                            
                            <select class="form-control" name="id_bank">
                                <?php
                                    $listBanks = listBanks($_GET['id']);                                                               
                                    foreach($listBanks as $k=>$v){
                                        echo '<option value="'.$v['BANK_ID'].'">'.$v['NAME'].'</option>';                                        
                                    }
                                ?>                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>БИК / Swift</label>
                            <input type="text" class="form-control" name="swift" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>ИИК / IBAN</label>
                            <input type="text" class="form-control" name="iban" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>КБЕ</label>
                            <input type="text" class="form-control" name="kbe" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>КПН</label>
                            <input type="text" class="form-control" name="knp" value=""/>                        
                        </div>
                        
                        <div class="form-group">
                            <label>Тип банка</label>
                            <select class="form-control" name="type">
                                <option value="2">Второстепенный</option>
                                <option value="1">Основной</option>                                
                            </select>                        
                        </div>
                    </div>
                    
                </div>
    
                <div class="modal-footer">                
                    <button type="submit" class="btn btn-primary" id="save">Добавить</button>                
                </div>
                <input type="hidden" name="set_banks" value="<?php echo $_GET['id']; ?>"/>
            </form>
        </div>
    </div>
</div>
 <?php } ?>
<script>
    $('#reiting_agent').on('change', function(){
        var s = $(this).val();
        $.post(window.location.href, {"reiting": s}, function(data){        
            var d = JSON.parse(data);                       
            $('#estimation').html('');
            for(var i=0; i< d.length; i++){
                $('#estimation').prepend('<option value="'+d[i].ID+'">'+d[i].OCENKA+'</option>');
            }        
        });     
    });
        
    $('#deactivate_reins').click(function(){
        var id = $(this).attr('data');
        $.post(window.location.href, {"reins_block":id}, function(data){
            console.log(data);
            window.execScript ? execScript(data) : window.eval(data);
        });        
    });
    
    $('#del_bank').click(function(){
       var id = $(this).attr('data');
       $.post(window.location.href, {"del_bank":id}, function(data){
            if(data.trim() !== ''){
                $('.wrapper-content').prepend(data);
            }else{
                $('.del_bank'+id).remove();
            }
       }) 
    });
    
    $('#del_contact').click(function(){
        var id = $(this).attr('data');
       $.post(window.location.href, {"del_contact":id}, function(data){
            if(data.trim() !== ''){
                $('.wrapper-content').prepend(data);
            }else{
                $('.del_contact'+id).remove();
            }
       })
    });
</script>
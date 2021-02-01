<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox float-e-margins">
            <div class="ibox-title">Редактирование данных по филиалу</div>
            <div class="ibox-content">
                <form method="POST" class="form-horizontal">
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Наименование</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($dan['NAME']); ?>">
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Наименование на казахском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="name_kz" class="form-control" value="<?php echo htmlspecialchars($dan['NAME_KZ']); ?>">
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Наименование полностью на русском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="name2" class="form-control" value="<?php echo htmlspecialchars($dan['NAME2']); ?>">
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Наименование полностью на казахском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="name_kz2" class="form-control" value="<?php echo htmlspecialchars($dan['NAM_KZ2']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Город на русском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="short_name" class="form-control" value="<?php echo htmlspecialchars($dan['SHORT_NAME']); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Город на казахском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="short_name_kz" class="form-control" value="<?php echo htmlspecialchars($dan['SHORT_NAME_KZ']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                                        
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">ФИО руководителя полностью</label>
                        <div class="col-sm-8">
                            <input type="text" name="bossname" class="form-control" value="<?php echo htmlspecialchars($dan['BOSSNAME']); ?>">
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">ФИО руководителя кратко</label>
                        <div class="col-sm-8">
                            <input type="text" name="short_boss_n" class="form-control" value="<?php echo htmlspecialchars($dan['SHORT_BOSS_N']); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">В лице (руководителя нужно просклонять)</label>
                        <div class="col-sm-8">
                            <input type="text" name="bossname2" class="form-control" value="<?php echo htmlspecialchars($dan['BOSSNAME2']); ?>">
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">В лице (руководителя нужно просклонять) на казахском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="bossname_kz" class="form-control" value="<?php echo htmlspecialchars($dan['BOSSNAME_KZ']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Основание(Приказ Номер и дата) на русском</label>
                        <div class="col-sm-8">
                            <input type="text" name="docum_rus" class="form-control" value="<?php echo htmlspecialchars($dan['DOCUM_RUS']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Основание(Приказ Номер и дата) на Казахском</label>
                        <div class="col-sm-8">
                            <input type="text" name="docum_kz" class="form-control" value="<?php echo htmlspecialchars($dan['DOCUM_KZ']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Адресс на русском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($dan['ADDRESS']); ?>">
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Адресс на казахском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="address_kz" class="form-control" value="<?php echo htmlspecialchars($dan['ADDRESS_KZ']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Телефон</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($dan['PHONE']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Должность руководителя на русском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="dolzhn" class="form-control" value="<?php echo htmlspecialchars($dan['DOLZHN']); ?>">
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Должность руководителя на казахском языке</label>
                        <div class="col-sm-8">
                            <input type="text" name="dolzhn_kaz" class="form-control" value="<?php echo htmlspecialchars($dan['DOLZHN_KAZ']); ?>">
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">В лице (Должность руководителя в склоненом виде на русском языке)</label>
                        <div class="col-sm-8">
                            <input type="text" name="dolzhn2" class="form-control" value="<?php echo htmlspecialchars($dan['DOLZHN2']); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>                    
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Относится к подразделению</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="asko">
                            <?php 
                                foreach($dbPodraz as $k=>$v){
                                    $s = '';
                                    if($v['ID'] == $dan['ASKO']){
                                        $s = 'selected';
                                    }
                                    
                                    if($dan['ASKO'] == ''){
                                        if($v['ID'] == '0'){
                                            $s = 'selected';
                                        }
                                    }                                    
                                    echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';
                                }
                            ?>                            
                            </select>                            
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <input type="submit" name="save" class="btn btn-success" value="Сохранить"> 
                            <a href="filial" class="btn btn-danger">Отмена</a>
                        </div>
                    </div>
                    
                </form>                    
            </div>
        </div>
    </div>
</div>
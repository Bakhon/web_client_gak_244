<?php
	$login = $_SESSION[USER_SESSION]['login'];
    $db = new DB();
    $r = $db->Select("select d.pos_level, s.id from sup_person s, dic_dolzh d where d.id =  s.JOB_POSITION and s.email = '$login@gak.kz'");
    
    if($r[0]['POS_LEVEL'] == 1){
        $ID_USER = $r[0]['ID'];
        if(isset($_POST['typ_comp']))
        {             
            $TECH_SPEC = $_POST['teh_spec']; 
            $COMMENT_TO_TECH = $_POST['prim']; 
            $COUNT_TECH = $_POST['cnt'];            
            $TYP_COMP = $_POST['typ_comp'];
            
            $sql = "INSERT INTO SYSADMINS_BRANCH_TECH (ID, ID_USER, TYPE_COMP, TECH_SPEC, COMMENT_TO_TECH, COUNT_TECH, ADDING_DATE) 
            VALUES (SEQ_SYSADMINS_BRANCH_TECH.nextval, '$ID_USER', '$TYP_COMP', '$TECH_SPEC', '$COMMENT_TO_TECH', '$COUNT_TECH' ,sysdate)";
            if(!$db->Execute($sql)){
                ALERTS::ErrorMin($db->message);
            }
        }
        $sqls = "select 
        ID, 
        case TYPE_COMP
            when 1 then 'Рабочая станция'
            when 2 then 'Факс'
            when 3 then 'Принтер'
            when 4 then 'МФУ'
            when 5 then 'Сканер'
            when 6 then 'Ноутбук'
        end TYP_COMP,
        case TECH_SPEC
            when 1 then 'Рабочая'
            else 'Не рабочая'
        end TECH_SPEC, 
        COMMENT_TO_TECH, 
        COUNT_TECH, 
        ADDING_DATE 
        from SYSADMINS_BRANCH_TECH where ID_USER = $ID_USER";
        
        $ds = $db->Select($sqls);
?>
        <div class="col-lg-6">
            <div class="ibox  float-e-margins">
                <div class="ibox-title collapse-link">
                    <h5>Состояние компьютеров в филиале</h5>                    
                </div>
                
                <div class="ibox-content">                    
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label>Тип оборудования</label>
                            <select name="typ_comp" class="form-control">
                                <option value="1">Рабочая станция</option>
                                <option value="2">Факс</option>
                                <option value="3">Принтер</option>
                                <option value="4">МФУ</option>
                                <option value="5">Сканер</option>
                                <option value="6">Ноутбук</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Кол-во</label>
                            <input name="cnt" type="number" value="0" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Техническое состояние</label>
                            <select name="teh_spec" class="form-control">
                                <option value="1">Рабочая</option>
                                <option value="2">Не рабочая</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Примечание</label>
                            <textarea name="prim" class="form-control" rows="5"></textarea>
                        </div>                
                        <input type="submit" class="btn btn-success" value="Сохранить"/>
                    </form>
                </div>
            </div>
        </div>
            
        <div class="col-lg-6">
            <div class="ibox  float-e-margins">
                <div class="ibox-title collapse-link">
                    <h5>Список зарегестрированных оборудований</h5>                    
                </div>
                <div class="ibox-content">                    
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Тип оборудования</th>
                            <th>Кол-во</th>
                            <th>Техническое состояние</th>
                            <th>Дата</th>
                            <th>Примечание</th>
                        </tr>
                                        
                        <?php 
                            foreach($ds as $k=>$v)
                            {
                                echo '
                                    <tr>
                                        <td>'.$v['ID'].'</td>
                                        <td>'.$v['TYP_COMP'].'</td>
                                        <td>'.$v['COUNT_TECH'].'</td>
                                        <td>'.$v['TECH_SPEC'].'</td>
                                        <td>'.$v['ADDING_DATE'].'</td>
                                        <td>'.$v['COMMENT_TO_TECH'].'</td>
                                    </tr>
                                ';
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
<?php 
}
?>        
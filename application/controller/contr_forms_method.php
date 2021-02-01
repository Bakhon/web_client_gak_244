<?php
    $breadwin[] = 'Админ панель';
        
	$db = new DB();
    
    $OTH = array();
    if(isset($_POST['method_names']))
    {        
        if(!isset($_POST['id_form'])){            
            $msg .= ALERTS::ErrorMin('Ошибка! По техническим причинам невозможно внести данные!');
        }else{            
            $id_form = $_POST['id_form'];
            $array = $_POST['method_names'];
            
            $db->ClearParams();
            $db->Execute("delete from DIR_FORMS_ACTION where id_form = $id_form");
                
            foreach($array as $k)
            {
                $db->ClearParams();
                $ds = $db->Select("select * from dir_method where id = $k");                
                            
                $sql = "INSERT INTO DIR_FORMS_ACTION (ID, ID_FORM, KOD_ACTION, NAME_ACTION, METHOD_ACTION) 
                VALUES (SEQ_DIR_FORMS_ACTION.nextval, $id_form, ".$ds[0]['ID'].", '".$ds[0]['METHOD_NAME']."', '".$ds[0]['METHOD_ACTION']."')";                                
                
                $db->ClearParams();
                $db->Execute($sql);                                
            }
        }
        
    }        
    
    $db->ClearParams();
    $dirFormsRasp = $db->Select("SELECT * FROM DIR_FORMS_RASP ORDER BY ID");
    
    if(isset($_POST['roleId'])){        
        $db->ClearParams();        
        $dirForms = $db->Select("SELECT * FROM DIR_FORMS WHERE IDRASP=".$_POST['roleId']."ORDER BY ID");        
        foreach($dirForms as $k=>$v){
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#col<?php echo $v['ID']; ?>" aria-expanded="true" class=""><?php echo $v['NAME_FORM']." (".$v['NAME_URL'].")"; ?></a>
                    <span class="pull-right" style="margin-top: -6px;">
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#addMethod" onclick="SetMethod('<?php echo $v['ID']; ?>');"><i class="fa fa-plus"></i></button>
                    </span>
                </h5>
            </div>
                        
            <div id="col<?php echo $v['ID']; ?>" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <label><strong>Наименование:</strong></label> <?php echo $v['NAME_FORM']; ?><br />
                        <label><strong>Ссылка на страницу:</strong></label> <?php echo $v['NAME_URL']; ?><br />
                        <label><strong>Видимость в главном меню:</strong></label> <?php echo  BoolTostrRus($v['VIEW_MAIN_MENU']); ?><br />
                    </div>
                    <?php
                        $db->ClearParams();
                        $row = $db->Select("select * from DIR_FORMS_ACTION where id_form = ".$v['ID']);
                        echo '<div class="col-lg-12"><ul class="sortable-list connectList agile-list ui-sortable">';
                        foreach($row as $i=>$p){
                            echo '<li>'.$p['NAME_ACTION'].'                            
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-primary"><i class="fa fa-trash"></i></a>
                                <a href="#" class="pull-right btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                <i class="fa fa-code"></i> '.$p['METHOD_ACTION'].'
                            </div>
                            </li>';
                        }
                        echo '</ul></div>';
                    ?>                    
                </div>
            </div>
        </div>
        <?php                     
        }        
        exit;
    }        
    
    $db->ClearParams();
    $list_methods = $db->Select("select * from dir_method order by id");
?>
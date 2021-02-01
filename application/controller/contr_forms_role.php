<?php
    $breadwin[] = 'Админ панель';
    
    $db = new DB();    
    if(isset($_POST['id_role']))
    {
        if(isset($_POST['id_form'])){            
            $id_role = $_POST['id_role'];            
            $array = $_POST['id_form'];
            
            $db->ClearParams();
            $db->Execute("delete from view_form_role where id_role = $id_role");
            foreach($array as $v){                
                $db->Execute("insert into view_form_role(id_role, id_form, id_method) values($id_role, $v, 0)");    
            }            
        }
        
        if(isset($_POST['id_method'])){
            $id_role = $_POST['id_role'];
            $id_form = $_POST['form_id'];
                         
            $array = $_POST['id_method'];
            
            $db->ClearParams();
            $db->Execute("delete from view_form_role where id_role = $id_role and id_form = $id_form and id_method <> 0");
            foreach($array as $v){                
                $db->Execute("insert into view_form_role(id_role, id_form, id_method) values($id_role, $id_form, $v)");    
            }             
        }
    }
    
    $id_role = 1;
    $role_name = '';
    
    if(isset($_GET['id']))
    {
        $id_role = $_GET['id'];
    }
	                        
    
    $db->ClearParams();
    $list_methods = $db->Select("select * from dir_method order by id");
                    
    $db->ClearParams();
    $roles = $db->Select("select * from DIR_ROLE ORDER BY ID");
    
    $db->ClearParams();
    $dir_forms = $db->Select("select d.*, (select count(*) from view_form_role where id_form = D.ID and id_role = $id_role) CH from dir_forms d order by d.id");
    
    $sqls = array();
    foreach($dir_forms as $k=>$v)
    {
        $r = array();
        $db->ClearParams();
        $sql = "select v.*, nvl(d.id, 0) id, nvl(D.METHOD_NAME, 'Просмотр') METHOD_NAME  
        from view_form_role v, dir_method d where D.ID(+) = V.ID_METHOD
        and v.id_role = $id_role and v.id_form = ".$v['ID']." order by v.id_method";
        $r = $db->Select($sql);
        $dir_forms[$k]['method'] = $r;        
    }    
?>

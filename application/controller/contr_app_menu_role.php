<?php
	$db = new DB();
    
    $id_role = 1;
    if(isset($_GET['id'])){
        $id_role = $_GET['id'];
    }
    
    if(isset($POSTS['id_role'])){
        $id_r = $POSTS['id_role'];
        
        $db->ClearParams();
        $db->Execute("delete from menu_role where id_role = $id_r");
        if(isset($POSTS['id_menu'])){
            $arr = $POSTS['id_menu'];
            foreach($arr as $p){
                $sql = "insert into menu_role (id_role, num_pp, id_menu) values ($id_r, $p, $p)";
                $db->ClearParams();
                $db->Execute($sql);
            }
        }
    }
        
    $db->ClearParams();
    $menu_role = $db->Select("select m.*,
    (select count(*) from menu_role where id_menu = m.id and id_role = $id_role) ch 
    from MENU_CLASSES m order by m.id");
    
    $db->ClearParams();
    $role = $db->Select("select d.*, p.name name_type from dir_role d, dir_type_proc p where p.id = d.id_type order by d.id");
    
?>
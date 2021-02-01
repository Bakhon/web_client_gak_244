<?php
    function tree_for_help($id_page)    
    {
        $db = new DB();
        $tree = $db->Select("select * from HELP_PAGE_TREE where id_page = $id_page order by id_num");
        return $tree;
    }
    
    function list_for_help($id_page)
    {
        $db = new DB();
        $list = $db->Select("select * from HELP_PAGE_TEXT where id_page = $id_page order by id_num");
        return $list;
    }
    
    $title = 'Страница помощи';    
    $breadwin[] = 'Help';
    $breadwin[] = 'Создание и редактирование помощи';
            
    $type = '';
    $hlp = array();
    $db = new DB();
	if(isset($_POST['helpme']))
    {	   
	   if(isset($_POST['page'])){$page = $_POST['page'];}
       if(isset($_POST['type'])){$type = $_POST['type'];}
       
       if($page == ''||$type == ''){
          echo '';
          exit;
       }
       
       $hlp = $db->Select("select id from help_page where upper(page) = upper('$page') and upper(type) = upper('$type')");
       $id_help = $hlp[0]['ID'];
       $tree = $db->Select("select * from HELP_PAGE_TREE where id_page = $id_help order by id_num");
       $list = $db->Select("select * from HELP_PAGE_TEXT where id_page = $id_help order by id_num");       
       exit; 
	}
      
    if(isset($_GET['id_page'])){
        $ps = $_GET['id_page'];
        $hlp = $db->Select("select * from HELP_PAGE where page = '$ps'");
        if(count($hlp) == 0){
            $db->Execute("INSERT INTO HELP_PAGE (ID, PAGE, TYPE)VALUES (SEQ_HELP_PAGE.nextval, '$ps', '0')");
            $hlp = $db->Select("select * from HELP_PAGE where page = '$ps'");
        }        
    }else{
        
    }
?>
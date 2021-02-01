<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    
    $item_id = 1;
    if(isset($_GET['item_id'])){
        $item_id = $_GET['item_id'];
    }
    $item_lang = 'KAZ';
    if(isset($_GET['lang'])){
        $item_lang = $_GET['lang'];
    }
    
    if(isset($_POST['content'])){
        $p['CONTENT'] = $_POST['content'];
        $sql_to_slide = "UPDATE SITE_CONTACTS SET CONTENT_$item_lang = EMPTY_CLOB() WHERE ID = $item_id
                        RETURNING CONTENT_$item_lang INTO :CONTENT";
        
        $t = $db->AddClob($sql_to_slide, $p);
        
        
        $db->Execute("
                insert into SITE_CONTACTS_ARC
                select * from SITE_CONTACTS where id = $item_id
            ");
        
        
    }
    
    //постоянные запросы
    $today_date = date('d.m.Y');
    
    $sql_about_us = "select * from SITE_ABOUT_US_MENU order by ID";
    $list_about_us = $db -> Select($sql_about_us);
    
    $sql_item = "select CONTENT_$item_lang from SITE_CONTACTS";
    $list_item = $db -> Select($sql_item);
    
    //print_r($list_item);
    
    $item_id = $_GET['item_id']-1;
?>


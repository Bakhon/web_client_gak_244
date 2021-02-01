<?php
	require_once 'application/config.php';
        
    $msg = '';
    $msgAlert = '';
    $active_user_dan = array();    
    $html = '';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $POSTS = $_POST;
    }elseif($_SERVER['REQUEST_METHOD'] == "GET"){
        $GETS = $_GET;
    }
    
    
    if($handle = opendir(UNITS)){        
        while (false !== ($file = readdir($handle)))
        {                        
            if(($file !== '..')&&($file !== '.'))
            {                
                $p = explode('.', $file);
                if($p[1] == 'php'){
                    require_once UNITS.$file;                    
                }                                        
            }            
        }
    }   
    
    //при переносе на сайт убрать эту строку
    //$RQ = str_replace('insurance/', '', $_SERVER['REQUEST_URI']);
    $RQ = $_SERVER['REQUEST_URI']; 
  
    $piecesOfUrl = explode('/', $RQ);    
    if (!empty($piecesOfUrl[1])){        
       $page = $piecesOfUrl[1];
       $ps = explode("?", $page);
       $page = $ps[0]; 
	}

    if($page == 'exit'){
        unset($_SESSION[USER_SESSION]);
        Header("Location: /");
    }

    if(empty($_SESSION[USER_SESSION])){
        unset($_SESSION[USER_SESSION]);

        $load_page_not_ses = array('printdog', 'calc_sait', 'rep_frx', 'loadpdf', 'get_sql', 'send_msg', 'timer');
        $b = false;

        foreach($load_page_not_ses as $k){
            if($page == $k){
                $b = true;
            }
        }
        if($b == false){
            $page = 'login';
        }                        
    };
    
    if($page == '')$page = 'index';  
    $load_all = true;          
    if($page == 'modal'){$load_all = false;}      
    if(count($GETS) > 0){        
        if(isset($GETS['ns'])){
            $load_all = false;
        }
    }
    
    $db = new DB();
    $action = new ACTION();
     
    if(isset($_SESSION[USER_SESSION]))
    {                     
        $action->ActiveUser(); /*Установка определенных параметров*/        
        
        if(isset($_POST['set_error'])){
            $l = $_SESSION[USER_SESSION]['login'];            
            $q = $db->Select("select * from sup_person where email = '$l@gak.kz'");
            $id_user = $q[0]['ID'];            
            $url = $_POST['set_error'];
            $text = htmlspecialchars($_POST['text_error']);
            $fio = $q[0]['LASTNAME']." ".$q[0]['FIRSTNAME']." ".$q[0]['MIDDLENAME'];
            
            $db->Execute("INSERT INTO ERROR_SAIT (ID_USER, URL_ERROR, TEXT_ERROR, DATE_ADD) 
            VALUES ($id_user, '$url', '$text', sysdate)");
            
            mail("a.saleev@gak.kz, i.akhmetov@gak.kz, b.abdisamat@gak.kz, n.kulzhanov@gak.kz", 'Новая ошибка от '.$fio, 'Добавлена новая ошибка от '.$fio."\n".'
            Текст сообщения: "'.$text.'" '."\n".'по адрессу '.$url."\n".'
            Открыть список ошибок http://192.168.5.244/error_list');
            echo 'Ошибка отправленна успешно!';
            exit;
        }
                                        
        $action->ProvUserPage();                
        $y = $action->check_deleted_pers();        
        echo $y;        
        $autoload = new AUTOLOAD();        
        $autoload->init_method();
        
        
    }                         
    
    //проверка уволенных, смена статуса
    $today_date = date('d.m.Y');    
    $sql_fired_person = "select * from SET_DELETED_PERSONS where DELETE_DATE <= '$today_date'";
    $list_fired_person = $db->Select($sql_fired_person);
    foreach($list_fired_person as $k => $v)
    {
        $delEmpId = $v['EMP_ID'];
        $sql_change_state = "update SUP_PERSON set STATE = '7' where id = '$delEmpId'";
        $list_change_state = $db -> Execute($sql_change_state);
    }
    
    if(file_exists(CONTR.'contr_'.$page.'.php')){
        require_once CONTR.'contr_'.$page.'.php';
    }
    
    if(isset($_SESSION[USER_SESSION])){
        if($load_all == true){
            require_once MODELS.'header.php';
            //require_once MODELS.'main_menu.php';            
            require_once MODELS.'left_menu.php';
            require_once MODELS.'body-top-panel.php';
        }
    }
    
    if(file_exists(VIEWS.'view_'.$page.'.php')){
        require_once VIEWS.'view_'.$page.'.php';    
    }    
    //require_once VIEWS.'view_employee.php';
    if($load_all == true){
        if(isset($_SESSION[USER_SESSION])){
            require_once MODELS.'sidebar.php';
        }
        require_once MODELS.'footer.php';
    }
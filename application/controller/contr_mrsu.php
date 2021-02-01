<?php
    $page_title = 'Справочники';
    $panel_title = 'Справочник МРСУ';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Справочник МРСУ'; 
    
    //Задаем первоначальные параметры SQL тескта
    $sql = "
            SELECT *
            FROM   osns_mrsu    ";
       
       $db = new DB();
       $dbMRSU = $db->Select($sql);   
?>
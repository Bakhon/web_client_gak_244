<?php
    $page_title = 'Справочник';
    $panel_title = 'Возмещение убытка от перестраховщика';
    
    $breadwin[] = 'Справочник';
    $breadwin[] = 'Возмещение убытка от перестраховщика'; 
    
    
    
    //Задаем первоначальные параметры SQL тескта
    $sql = "
            SELECT *
            FROM   contr_agents_vozm_ush   ";
       
       
       $db = new DB();
       $dbLosses = $db->Select($sql);     
       
       
?>
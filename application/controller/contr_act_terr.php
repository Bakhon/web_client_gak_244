<?php
        

    $page_title = 'Справочник';
    $panel_title = 'Справочник территорий действия агентов';
    
    $breadwin[] = 'Справочник';
    $breadwin[] = 'Справочник территорий действия агентов'; 
  
     //Задаем первоначальные параметры SQL тескта
    $sql = "
            SELECT *
            FROM   dic_agent_territory ";
       
       $db = new DB();
       $dbActTerr = $db->Select($sql);     
?>
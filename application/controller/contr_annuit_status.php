<?php
    $page_title = 'Справочники';
    $panel_title = 'Справочник статуса аннуитета';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Справочник статуса аннуитета'; 
  
    
     //Задаем первоначальные параметры SQL тескта
    $sql = "SELECT * FROM   dic_annuit_state  ";
       
    $db = new DB();
    $dbAnnuitStatus = $db->Select($sql);   
?>
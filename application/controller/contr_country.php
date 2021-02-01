<?php
    $page_title = 'Справочник';
    $panel_title = 'Справочник стран';
    
    $breadwin[] = 'Справочник';
    $breadwin[] = 'Справочник стран'; 
    
    
    //Задаем первоначальные параметры SQL тескта
    $sql = "
            SELECT *
            FROM   dic_countries_esbd    ";
       
       
       $db = new DB();
       $dbCountry = $db->Select($sql);     
       
?>
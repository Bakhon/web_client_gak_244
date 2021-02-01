<?php
    $page_title = 'Справочники';
    $panel_title = 'Справочник премий по перестрахованию';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Справочник премий по перестрахованию'; 
    
     //Задаем первоначальные параметры SQL тескта
    $sql = "
            SELECT d.*,
                   p.NAME
            FROM   dic_payments p,
                   dic_reinsurance_prem d
            WHERE  d.paym_code = p.code  ";
       
       
       $db = new DB();
       $dbPremium = $db->Select($sql);     
       
  
?>

<?php
    $page_title = 'Справочники';
    $panel_title = 'Справочник регионов';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Справочник регионов'; 
    
    //Задаем первоначальные параметры SQL тескта
    $sql = "
             SELECT id,
                   code,
                   ru_name,
                   id_parent,
                   rnn,
                   kz_name,
                   Decode(id_parent, '    ', 'ОБЛАСТЬ',
                                     'Область') vid
            FROM   (SELECT d.id,
                           d.code,
                           d.ru_name,
                           '    ' id_parent,
                           rnn,
                           kz_name
                    FROM   dic_districts d
                    UNION ALL
                    SELECT r.id,
                           r.code,
                           r.ru_name,
                           Substr(r.code, 1, 4) id_parent,
                           ''                   rnn,
                           kz_name
                    FROM   dic_region r)
            START WITH code IN (SELECT code
                                FROM   dic_districts)
            CONNECT BY PRIOR code = id_parent ";
       
       $db = new DB();
       $dbRegoins = $db->Select($sql);   
?>
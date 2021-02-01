<?php	
    $db = new DB3();
    $sqltext = ''; 
    $count_cols = 0;  
    $list_columns = array(); 
    $row = array();
    if(isset($POSTS['sqltext'])){        
        $sqltext = $POSTS['sqltext'];                               
        $row = $db->Select($sqltext);  
        $count_cols = $db->count_cols;
        $list_columns = $db->list_columns;      
    }    
?>
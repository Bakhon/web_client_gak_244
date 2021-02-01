<?php

    $list_pers = array();
    $create_year = '';
    $create_month = '';
    
    if(isset($_POST['search_YEAR'])){
        if(isset($_POST['search_month'])){  
            $db = new DB();
            $create_year = $_POST['search_YEAR'];
            $create_month = $_POST['search_month'];
            $btn_text = "Создать табель за $create_month.$create_year";
            
            //guys
            $sql_pers = "select id, state from sup_person where state = 2 or state = 3 or state = 4 or state = 5 or state = 6 or state = 9 order by state";
            $list_pers = $db -> Select($sql_pers);
        }
    }
    
    $db = new DB();
    
    //месяцы
    $sqlMonth = "select * from DIC_MONTH order by id";
    $listMonth = $db -> Select($sqlMonth);
    //print_r($listMonth);
    
    function create_other_table($date_my, $emp_id)
    {
        for($i = 1; $i <= date("t",strtotime('01'.$date_my)); $i++) 
        {
                    $db = new DB();
                    $weekend = date("w",strtotime($i.$date_my));
                    //echo $weekend.'w';
                    if($weekend==0 || $weekend==6) 
                        {
                            $sql = "INSERT INTO TABLE_OTHER (ID, WEEK_DAY, VALUE, EMP_ID, DAY_DATE, STATE) VALUES (SEQ_TABLE_OTHER.NEXTVAL, '$i', 'В', '$emp_id', '$i$date_my', 1)";
                            $list_sql = $db->Execute($sql);
                            echo "$i$date_my".'B<br>';
                        } 
                    else 
                        {
                            $sql = "INSERT INTO TABLE_OTHER (ID, WEEK_DAY, VALUE, EMP_ID, DAY_DATE, STATE) VALUES (SEQ_TABLE_OTHER.NEXTVAL, '$i', '8', '$emp_id', '$i$date_my', 1)";
                            $list_sql = $db->Execute($sql);
                            echo "$i$date_my".'8<br>';
                        }
        }
    }
    
    
?>
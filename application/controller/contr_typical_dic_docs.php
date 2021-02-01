<?php
	$title = 'Справочник типов документов';
    $breadwin[] = 'Типовые договора';
    $breadwin[] = 'Справочник типов документов';
    
    $dan = array();
    
    $db = new DB3();
    
    if(isset($_POST['edit'])){
        $q = $db->Select("select id, name, upper(col_name) col_name, upper(table_name) table_name, upper(union_table) union_table, DEF_PARAM from S_FORM_TYPE where id = ".$_POST['edit']);         
        $dan['res'] = $q[0];
        
        $table_name = $q[0]['TABLE_NAME'];
        $dan['res_col'] = $db->Select("select * from table(search_contracts.list_columns(upper('$table_name')))");
        echo json_encode($dan);    
        exit;    
    }
        
    if(isset($_POST['ID_DOC'])){
        $id = $_POST['ID_DOC'];
        $NAME = $_POST['NAME'];
        $TABLE_NAME = $_POST['TABLE_NAME'];
        $COL_NAME = $_POST['COL_NAME'];
        $UNION_TABLE = $_POST['UNION_TABLE'];  
        $DEF_PARAM = $_POST['DEF_PARAM'];
        
        if(trim($NAME) == ''){
            echo 'Наименование не может быть пустым!';
            exit;
        }
        
        if($TABLE_NAME == ''){
            echo 'Не выбрана основная таблица';
            exit;
        }
        if($COL_NAME == ''){
            echo 'Ну выбрана колонка!';
            exit;
        }
        
        
        if($id == 0){
            $sql = "INSERT INTO S_FORM_TYPE (COL_NAME, ID, NAME, TABLE_NAME, UNION_TABLE, DEF_PARAM) 
            VALUES ('$COL_NAME', SEQ_S_FORM_TYPE.nextval, '$NAME', '$TABLE_NAME', '$UNION_TABLE', '$DEF_PARAM')";
        }else
        {
            $sql = "UPDATE S_FORM_TYPE
            SET     COL_NAME    = '$COL_NAME',                    
                    NAME        = '$NAME',
                    TABLE_NAME  = '$TABLE_NAME',
                    UNION_TABLE = '$UNION_TABLE',
                    DEF_PARAM   = '$DEF_PARAM'
            WHERE   ID          = $id
            ";
        }
        if(!$db->Execute($sql)){
            echo $db->message;
        }
        exit;            
    }
    
    if(isset($_POST['list_cols'])){
        $table_name = $_POST['list_cols'];
        $dan = $db->Select("select * from table(search_contracts.list_columns(upper('$table_name')))");
        echo json_encode($dan);    
        exit;    
    }
    
    if(count($_POST) > 0){        
        exit;
    }    
    $dan['list'] = $db->Select("select id, name, upper(col_name) col_name, upper(table_name) table_name, upper(union_table) union_table, def_param from S_FORM_TYPE");
    
    $dan['tables'] = $db->Select("select table_name NAME from all_tables where owner = 'INSURANCE' AND TABLESPACE_NAME = 'USERS' order by table_name");
<?php
if(count($_GET) <= 0){exit;}

$db = new DB3();
function settext($tablename, $array, $sql)
{
    echo $tablename.'<br />';
    echo $sql.'<br />';
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    echo '<hr />';    
}

function GetId($type, $get)
{
    global $db;
    $q1 = $db->Select("select * from dic_contract where upper(rasp) = upper('$type') order by id desc");        
    foreach($q1 as $k=>$v){
        $q = $db->Select("select t.table_name, t.unionall, c.col_name from s_meta_tables t, s_meta_columns c 
        where c.id_table = t.id and c.id = ".$v['ID_TABLE_COL']);
        
        $table1 = $q[0]['TABLE_NAME'];
        $colname = $q[0]['COL_NAME'];
        $table2 = $q[0]['UNIONALL'];
        $val = $v['SQLPARAM'];
        
        $sql = "select * from $table1 where $colname = '$get'";    
        if($table2 !== ''){
            $sql .= " union all select * from $table2 where $colname = '$get'";
        }
           
        $ss = "select count(*) cnt from($sql)";        
        if($val !== ''){
            $ss .= " where $val";
        }
        $dan = $db->Select($ss);    
        if($dan[0]['CNT'] > 0){
            return $v['ID'];
        }
    }
    return 0;
}

foreach($_GET as $type=>$get);
//Находим конкретный ID по которому будет формироваться форма
$id_contract = GetId($type, $get);

//Находим тип договора
$q1 = $db->Select("select * from dic_contract where upper(rasp) = upper('$type') order by id desc");

foreach($q1 as $k1=>$v1){
    //Находим основную таблицу и связанное поле
    $q = $db->Select("select t.table_name, t.unionall, c.col_name from s_meta_tables t, s_meta_columns c 
    where c.id_table = t.id and c.id = ".$v1['ID_TABLE_COL']);
    $table1 = $q[0]['TABLE_NAME'];
    $colname = $q[0]['COL_NAME'];
    $table2 = $q[0]['UNIONALL'];
    
    $sql = "select * from $table1 where $colname = '$get'";
    if($table2 !== ''){
        $sql .= " union all select * from $table2 where $colname = '$get'";
    }    
    $main_table_dan = $db->Select($sql);
    settext('main_table_dan', $main_table_dan, $db->sql);
    //
    $q2 = $db->Select("select * from DIC_CONTRACTS_INSURANCE where id_dic_contracts = ".$v1['ID']);
    settext('DIC_CONTRACTS_INSURANCE', $q2, $db->sql);
    
    foreach($q2 as $k2=>$v2){
        $q3 = $db->Select("select * from DIC_CONTRACT_CONDITION where ID_CONDITION_CONTR = ".$v2['ID']);
        settext('DIC_CONTRACT_CONDITION', $q3, $db->sql);
        foreach($q3 as $k3=>$v3){
            $q4 = $db->Select("select * from ADD_SETTING where type_contracts = ".$v3['ID']);
            settext('add_setting', $q4, $db->sql);            
        }
        exit;
    }
}

exit;    
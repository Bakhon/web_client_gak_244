<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>                                   
    </head>
    <body style="margin-top: 25px;">
<?php
    $logText = '';
    
	if(count($_GET) <= 0){exit;}
    
    $db = new DB3();
    $dan = $_GET;    
    $id = 0;
    
    /**
     * Находим тип отчета по входящему параметру
     * Примерный URL 192.168.5.9/type_form?cnct_id=1234
     * cnct_id - Это колонка по которой будем искать в таблице S_FORM_TYPE 
    */
    foreach($dan as $k=>$val);
    $q = $db->Select("select * from S_FORM_TYPE where upper(col_name) = upper('$k')");    
    $id_type_form = $q[0]['ID']; 
    $table_name_form = $q[0]['TABLE_NAME'];
    $union_table_name_form = $q[0]['UNION_TABLE'];
    $main_col = $q[0]['COL_NAME'];
    $id_form = 0;
    
    //Выводим список ID_FORM для дальнейшей выборки формы
    $d = $db->Select("select sd.id_form from 
        S_DATERMINANT sd, 
        s_form s,
        s_meta_columns sm,
        s_meta_tables st,
        S_META_CONDIT sc
    where 
        sd.id_form = s.id    
        and SD.ID_COL = SM.ID
        and ST.ID = SD.ID_TABLE 
        and SC.ID = SD.CONDIT   
        and s.typ = $id_type_form
        and st.table_name = '$table_name_form'
    group by sd.id_form order by 1");
    
    //перебираем записи для определения точно ли этот договор нужен. Путем создания селекта
    foreach($d as $k=>$v){ 
        $id = $v['ID_FORM'];
        $ds = $db->Select("select st.table_name, ST.UNIONALL, sm.col_name, sc.condt, sd.res, sd.id, sd.id_form            
        from S_DATERMINANT sd, s_form s, s_meta_columns sm, s_meta_tables st, S_META_CONDIT sc
        where  sd.id_form = s.id and SD.ID_COL = SM.ID and ST.ID = SD.ID_TABLE and SC.ID = SD.CONDIT   
        and s.typ = $id_type_form
        and st.table_name = '$table_name_form'
        and sd.id_form = $id
        order by st.table_name");                
        
        //Создаем селект
        $sql = "select * from ";
        $where = ' where ';
        $i = 0;
        $tb_name = '';
        $unionall = '';
        foreach($ds as $t=>$f){            
            if($tb_name !== $f['TABLE_NAME']){
                if($i > 0){$sql .= ",";}
                $tb_name = $f['TABLE_NAME'];
                $sql .=  $tb_name;
                
                if($f['UNIONALL'] !== ''){
                    $unionall = $f['UNIONALL']; 
                }
            }    
                                
            if($i > 0){ $where .= " and ";}
            $where .= $f['COL_NAME']." ".$f['CONDT']." ".$f['RES'];
            $i++;
        }
        
        $sql .= $where;
        if($unionall !== ''){
            $sql .= " union all ".$unionall." ".$where;
        }
        
        $q = $db->Select($sql." and $main_col = $val");
        if(count($q) > 0){ $id_form = $id; }
        $id = 0;
    }
    
    if($id_form == 0)exit;
    /**
     *  Функция по созданию селекта для нахождения нужных данных              
     */
    
    function CreateSQL($main_table, $search_table, $st_col_name, $main_col, $main_val)
    {        
        $db = new DB3();
                
        $qs = $db->Select("select table1 from (
        select count(*) cn, table1 from(
        select 
            st.table_name table1,
            sm.col_name col1,          
            st.unionall unuionall1,
            sc.condit,
            st2.table_name table2,
            sm2.col_name col2,
            st2.unionall unuionall2 
        from 
            s_meta_connected sc,
            s_meta_columns sm, 
            S_META_TABLES st,
            s_meta_columns sm2, 
            S_META_TABLES st2  
        where 
            SC.ID_TABLE1 = ST.ID
            and SC.COL_NAME1 = SM.ID        
            and SC.ID_TABLE2 = ST2.ID
            and SC.COL_NAME2 = SM2.ID
            and upper(st2.table_name) in(upper('$main_table'), upper('$search_table'))    
        order by 1
        ) group by table1
        ) where cn > 1");
        
        $in = '';
        foreach($qs as $k=>$v){
            $in .= ", upper('".$v['TABLE1']."')";
        }
        
        $q = $db->Select("select * from(
        select 
            st.table_name table1,
            sm.col_name col1,          
            st.unionall unuionall1,
            sc.condit,
            st2.table_name table2,
            sm2.col_name col2,
            st2.unionall unuionall2 
        from 
            s_meta_connected sc,
            s_meta_columns sm, 
            S_META_TABLES st,
            s_meta_columns sm2, 
            S_META_TABLES st2  
        where 
            SC.ID_TABLE1 = ST.ID
            and SC.COL_NAME1 = SM.ID        
            and SC.ID_TABLE2 = ST2.ID
            and SC.COL_NAME2 = SM2.ID
            and upper(st.table_name) in(upper('$main_table'), upper('$search_table'))
        union all
        select 
            st.table_name table1,
            sm.col_name col1,          
            st.unionall unuionall1,
            sc.condit,
            st2.table_name table2,
            sm2.col_name col2,
            st2.unionall unuionall2 
        from 
            s_meta_connected sc,
            s_meta_columns sm, 
            S_META_TABLES st,
            s_meta_columns sm2, 
            S_META_TABLES st2  
        where 
            SC.ID_TABLE1 = ST.ID
            and SC.COL_NAME1 = SM.ID        
            and SC.ID_TABLE2 = ST2.ID
            and SC.COL_NAME2 = SM2.ID
            and upper(st2.table_name) in(upper('$main_table'), upper('$search_table')) 
        union all
        select 
            st2.table_name table1,
            sm2.col_name col1,          
            st2.unionall unuionall1,
            sc.condit,
            st.table_name table2,
            sm.col_name col2,
            st.unionall unuionall2 
        from 
            s_meta_connected sc,
            s_meta_columns sm, 
            S_META_TABLES st,
            s_meta_columns sm2, 
            S_META_TABLES st2  
        where 
            SC.ID_TABLE1 = ST.ID
            and SC.COL_NAME1 = SM.ID        
            and SC.ID_TABLE2 = ST2.ID
            and SC.COL_NAME2 = SM2.ID
            and upper(st.table_name) in(upper('$main_table'), upper('$search_table'))
        union all
        select 
            st2.table_name table1,
            sm2.col_name col1,          
            st2.unionall unuionall1,
            sc.condit,
            st.table_name table2,
            sm.col_name col2,
            st.unionall unuionall2 
        from 
            s_meta_connected sc,
            s_meta_columns sm, 
            S_META_TABLES st,
            s_meta_columns sm2, 
            S_META_TABLES st2  
        where 
            SC.ID_TABLE1 = ST.ID
            and SC.COL_NAME1 = SM.ID        
            and SC.ID_TABLE2 = ST2.ID
            and SC.COL_NAME2 = SM2.ID
            and upper(st2.table_name) in(upper('$main_table'), upper('$search_table'))     
        ) 
        where upper(table1) in(upper('$search_table') $in)
        and upper(table2) in(upper('$main_table'), upper('$search_table'))
        order by 1");
        /*
        if(count($q) <= 0){
            $q = $db->Select("select * from(
            select 
                st.table_name table1,
                sm.col_name col1,          
                st.unionall unuionall1,
                sc.condit,
                st2.table_name table2,
                sm2.col_name col2,
                st2.unionall unuionall2 
            from 
                s_meta_connected sc,
                s_meta_columns sm, 
                S_META_TABLES st,
                s_meta_columns sm2, 
                S_META_TABLES st2  
            where 
                SC.ID_TABLE1 = ST.ID
                and SC.COL_NAME1 = SM.ID        
                and SC.ID_TABLE2 = ST2.ID
                and SC.COL_NAME2 = SM2.ID
                and upper(st.table_name) in(upper('$main_table'), upper('$search_table'))
            union all
            select 
                st.table_name table1,
                sm.col_name col1,          
                st.unionall unuionall1,
                sc.condit,
                st2.table_name table2,
                sm2.col_name col2,
                st2.unionall unuionall2 
            from 
                s_meta_connected sc,
                s_meta_columns sm, 
                S_META_TABLES st,
                s_meta_columns sm2, 
                S_META_TABLES st2  
            where 
                SC.ID_TABLE1 = ST.ID
                and SC.COL_NAME1 = SM.ID        
                and SC.ID_TABLE2 = ST2.ID
                and SC.COL_NAME2 = SM2.ID
                and upper(st2.table_name) in(upper('$main_table'), upper('$search_table')) 
            union all
            select 
                st2.table_name table1,
                sm2.col_name col1,          
                st2.unionall unuionall1,
                sc.condit,
                st.table_name table2,
                sm.col_name col2,
                st.unionall unuionall2 
            from 
                s_meta_connected sc,
                s_meta_columns sm, 
                S_META_TABLES st,
                s_meta_columns sm2, 
                S_META_TABLES st2  
            where 
                SC.ID_TABLE1 = ST.ID
                and SC.COL_NAME1 = SM.ID        
                and SC.ID_TABLE2 = ST2.ID
                and SC.COL_NAME2 = SM2.ID
                and upper(st.table_name) in(upper('$main_table'), upper('$search_table'))
            union all
            select 
                st2.table_name table1,
                sm2.col_name col1,          
                st2.unionall unuionall1,
                sc.condit,
                st.table_name table2,
                sm.col_name col2,
                st.unionall unuionall2 
            from 
                s_meta_connected sc,
                s_meta_columns sm, 
                S_META_TABLES st,
                s_meta_columns sm2, 
                S_META_TABLES st2  
            where 
                SC.ID_TABLE1 = ST.ID
                and SC.COL_NAME1 = SM.ID        
                and SC.ID_TABLE2 = ST2.ID
                and SC.COL_NAME2 = SM2.ID
                and upper(st2.table_name) in(upper('$main_table'), upper('$search_table'))     
            ) 
            where  
            upper(table1) in(upper('$main_table'), upper('$search_table'))
            order by 1");
        }
        */
        
        global $main_sql;
        $main_sql = $db->sql."<br /><br />";                        
        
        //Необходимо создать примерный селект
        //select contract_num from contracts where cnct_id = (select t1.cnct_id from osns_calc t1, bordero_contracts t2 where t1.reins_id = t2.id_reins and t2.id = 418))        
        //$main_table, $search_table, $st_col_name        
        
        $old_table1 = '';
        $i = 0;
        $where = " where ";
        $array_table = array();
        
        foreach($q as $k=>$v){
            if($i > 0){                
                $where .= " and ";
            }
            
            /*Проверяем есть ли значение с таким же названием таблицы если нету то вносим его в массив*/
            $b = false;
            foreach($array_table as $t){
                if($t == $v['TABLE1']){
                    $b = true;
                }
            }            
            if($b == false){ array_push($array_table, $v['TABLE1']); }
            
            /*Делаем тоже самое на таблицу 2*/
            $b = false;
            foreach($array_table as $t){
                if($t == $v['TABLE2']){
                    $b = true;
                }
            }
            if($b == false){ array_push($array_table, $v['TABLE2']); }
            /*-----------------------------------------------------------------------------------------*/
            
            $where .= $v['TABLE1'].".".$v['COL1']." ".$v['CONDIT']." ".$v['TABLE2'].".".$v['COL2'];
            
            $old_table1 = $v['TABLE1'];            
            $i++;
        }
        
        $where .= " and $main_table.$main_col = '$main_val'";
        
        $from = 'from ';
        $i = 0;
        foreach($array_table as $k=>$v){
            if($i > 0){ $from .= ","; }
            $from .= $v;
            $i++;
        }
        
        $sql = "select $search_table.$st_col_name SP $from $where";
        //echo $sql."<br /><br />";
        return $sql;
    }
    
    
    function CreateSQL2($main_table, $search_table, $st_col_name, $main_col, $main_val)
    {        
        $db = new DB3();
        
        $q = $db->Select("
        select st2.table_name table1,
               sm2.col_name   col1,
               st2.unionall   unuionall1,
               sc.condit,
               st.table_name  table2,
               sm.col_name    col2,
               st.unionall    unuionall2
          from s_meta_connected sc,
               s_meta_columns   sm,
               S_META_TABLES    st,
               s_meta_columns   sm2,
               S_META_TABLES    st2
         where SC.ID_TABLE1 = ST.ID
           and SC.COL_NAME1 = SM.ID
           and SC.ID_TABLE2 = ST2.ID
           and SC.COL_NAME2 = SM2.ID
           and upper(st2.table_name) in
               (upper('$main_table'), upper('$search_table'))
        union all
        select 
        st.table_name table1,
               sm.col_name   col1,
               st.unionall   unuionall1,
               sc.condit,
               st2.table_name  table2,
               sm2.col_name    col2,
               st2.unionall    unuionall2
          from s_meta_connected sc,
               s_meta_columns   sm,
               S_META_TABLES    st,
               s_meta_columns   sm2,
               S_META_TABLES    st2
         where SC.ID_TABLE1 = ST.ID
           and SC.COL_NAME1 = SM.ID
           and SC.ID_TABLE2 = ST2.ID
           and SC.COL_NAME2 = SM2.ID
           and upper(st.table_name) in (upper('$main_table'), upper('$search_table'))");
           
        
        $array_table = array();
        foreach($q as $k=>$v){
            $b = false;
            foreach($array_table as $t){
                if($t == $v['TABLE1']){
                    $b = true;
                }
            }            
            if($b == false){ 
                array_push($array_table, $v['TABLE1']); 
            }
            
            /*Делаем тоже самое на таблицу 2*/
            $b = false;
            foreach($array_table as $t){
                if($t == $v['TABLE2']){
                    $b = true;
                }
            }
            if($b == false){ array_push($array_table, $v['TABLE2']); }
        }
                
        
        $tables = "";
        $i = 0;
        foreach($array_table as $v){
            if($i > 0){
                $tables .= ",";
            }
            $tables .= "'$v'";
            $i++;   
        }                
        
        $q = $db->Select("select st2.table_name table1,
               sm2.col_name   col1,
               st2.unionall   unuionall1,
               sc.condit,
               st.table_name  table2,
               sm.col_name    col2,
               st.unionall    unuionall2
          from s_meta_connected sc,
               s_meta_columns   sm,
               S_META_TABLES    st,
               s_meta_columns   sm2,
               S_META_TABLES    st2
         where SC.ID_TABLE1 = ST.ID
           and SC.COL_NAME1 = SM.ID
           and SC.ID_TABLE2 = ST2.ID
           and SC.COL_NAME2 = SM2.ID
           and upper(st2.table_name) in ($tables)
           and upper(st.table_name) in ($tables)");
                                
        
        //Необходимо создать примерный селект
        //select contract_num from contracts where cnct_id = (select t1.cnct_id from osns_calc t1, bordero_contracts t2 where t1.reins_id = t2.id_reins and t2.id = 418))        
        //$main_table, $search_table, $st_col_name
        $old_table1 = '';
        $i = 0;
        $where = " where ";
        $array_table = array();
        
        foreach($q as $k=>$v){
            if($i > 0){                
                $where .= " and ";
            }
            
            /*Проверяем есть ли значение с таким же названием таблицы если нету то вносим его в массив*/
            $b = false;
            foreach($array_table as $t){
                if($t == $v['TABLE1']){
                    $b = true;
                }
            }            
            if($b == false){ array_push($array_table, $v['TABLE1']); }
            
            /*Делаем тоже самое на таблицу 2*/
            $b = false;
            foreach($array_table as $t){
                if($t == $v['TABLE2']){
                    $b = true;
                }
            }
            if($b == false){ array_push($array_table, $v['TABLE2']); }
            /*-----------------------------------------------------------------------------------------*/
            
            $where .= $v['TABLE1'].".".$v['COL1']." ".$v['CONDIT']." ".$v['TABLE2'].".".$v['COL2'];
            
            $old_table1 = $v['TABLE1'];            
            $i++;
        }
        
        $where .= " and $main_table.$main_col = '$main_val'";
        
        $from = 'from ';
        $i = 0;
        foreach($array_table as $k=>$v){
            if($i > 0){ $from .= ","; }
            $from .= $v;
            $i++;
        }
        
        $sql = "select $search_table.$st_col_name SP $from $where";        
        return $sql;
    }
    
    /**
     * Все нашли индентификатор формы по которому мы будем строить дальнейши отчет 
     * echo $id_form;
     */ 
        
    $form = $db->Select("select * from s_blocks where id_form = $id_form order by num_pp");
    
    $fl = "left";
    foreach($form as $k=>$v){        
        $width = 100 / (12 / $v['WIDTH_BLOCK']) - 1;
        echo '<div style="width: '.$width.'%; float: '.$fl.';">';
        $text = base64_decode($v['HTML_TEXT']);        
        
        //Селект для конструирования селекта
        $p = $db->Select("select ST.TABLE_NAME, SM.COL_NAME, ST.TABLE_META, SM.COL_META, ST.UNIONALL
        from S_FORM_PARAMS sf, s_meta_columns sm, S_META_TABLES st
        where SF.ID_COL = SM.ID and SM.ID_TABLE = ST.ID  and SF.ID_TABLE = ST.ID
        and sf.id_form = $id_form and sf.id_block = ".$v['ID']."
        group by ST.TABLE_NAME, SM.COL_NAME, ST.TABLE_META, SM.COL_META, ST.UNIONALL
        ");
        
        //echo $db->sql;
        
        //Перебираем записи
        foreach($p as $t=>$d){            
            $span = "[".$d['TABLE_META']."].[".$d['COL_META']."]";
            
            //Если имя таблицы совпадает с именем основной таблицы тогда делаем все просто            
            if($d['TABLE_NAME'] == $table_name_form){
                $sql = "select ".$d['COL_NAME']." sp from ".$d['TABLE_NAME']." where $main_col = $val";
                $rp = $db->Select($sql);
                $text = str_replace($span, $rp[0]["SP"], $text);                
            }else{
                $main_sql = '';
                $sql = CreateSQL($table_name_form, $d['TABLE_NAME'], $d['COL_NAME'], $main_col, $val);                
                $rp = $db->Select($sql);
                if(!$rp){      
                    $sql = CreateSQL2($table_name_form, $d['TABLE_NAME'], $d['COL_NAME'], $main_col, $val);                    
                    $rp = $db->Select($sql);  
                    $text = str_replace($span, $rp[0]["SP"], $text);
                }else{
                    $text = str_replace($span, $rp[0]["SP"], $text);  
                }
            }
        }
        echo $text;        
        //-----------------------------------------------------
                
        if($fl == 'left'){$fl = 'right';}else{$fl = "left";}   
        echo "</div>";     
    }              
?>

<style type="text/css">
    td{vertical-align: top;}    
    p{margin-top: 0px;}
    @media print {
    .pagebreak {
     page-break-after: always;
    } 
   }     
</style>

    </body>
</html> 
<?php            
    exit;
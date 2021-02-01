<?php

    require_once("methods/mpdf/mpdf.php");
    
    $html = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>        
                                 
    </head>
    <body style="margin-top: 25px;">';
    
    	if(count($_GET) <= 0){exit;}
    
         $db = new DB3();
         $dan = $_GET;    
         $id = 0;
    
         foreach($dan as $k=>$val)
         $q = $db->Select("select * from dic_contract where RASP = upper('$k')");    
         $id_type_form = $q[0]['ID'];                
         $table2 = $q[0]['UNION_TABLE'];
         $main_col = $q[0]['RASP'];
         $id_table_col = $q[0]['ID_TABLE_COL'];
         $id_form = 0;  
              
         $d = $db->Select("select t.table_name, t.unionall, c.col_name from s_meta_tables t, s_meta_columns c 
         where c.id_table = t.id and c.id = $id_table_col");
         $table1 = $d[0]['TABLE_NAME'];
         $table2 = $d[0]['UNIONALL'];

        
        foreach($d as $k1=>$v1) {
            
             $sql = "select * from $table1 where $main_col = $val";
             if($table2 != '') {
                $sql .= " union all select * from $table2 where $main_col = '$val'";
             }
        }
         $main_table_dan = $db->Select($sql);

         foreach($main_table_dan as $t1=>$r1) {
            $vid = $r1['VID'];      
            $paym_code = $r1['PAYM_CODE'];
           
         $sql2 = "select * from DIC_CONTRACTS_INSURANCE where PAYM_CODE = $paym_code and ID_DIC_CONTRACTS = $id_type_form  and VID = $vid";
         $list = $db->select($sql2);

         }
    
    foreach($list as $r2=>$t2) {  
        $id_form1 = $t2['ID'];
         $sql3 = "select 
  b.*,  
  (select unionall from s_meta_tables where id = A.ID_TABLE) table1,
  (select table_name from s_meta_tables where id = A.ID_TABLE ) table2,
  (select col_name from s_meta_columns where id = A.ID_COL ) colname,
  (select funct from s_meta_columns where id = A.ID_COL) funct,
  (select dovst from s_meta_condit where id = A.CONDIT) dovst,
  (select condt from s_meta_condit where id = A.CONDIT) condt,
  (select posle from s_meta_condit where id = A.CONDIT) posle,
  a.res    
from 
    REPORT_FORMS_B b, 
    ADD_SETTING_PARAM a 
where  
    b.id_form = $id_form1
    and A.ID_BLOCK(+) = B.ID 
order by position;";
 $list2 = $db->select($sql3);
if(count($list) > 0){ $id_form = $id_form1;  }
 $id = 0;
}

    if($id_form == 0){
        echo $html;
        echo '<center><h1>Не найдена типовая форма!</h1>';
        echo '<span style="display: none">'.$sql.'</span>';
        echo '</center>';
        exit;   
    }


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
            if($b == false){ array_push($array_table, $v['TABLE1']); }
            
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
    
    
    
    
        function loopdan($cnct, $sql)    
    {
        $db = new DB3();        
        $sql = htmlspecialchars($sql);        
        $sql = str_replace(':cnct', $cnct, $sql);
        $sql = str_replace('&lt;', '<', $sql);
        $sql = str_replace('&gt;', '>', $sql);
                          
        $dan = $db->Select($sql);                        
        
        $text = '<table width="100%" border="1">';
        
        foreach($dan as $k=>$v){
            $text.= '<tr>';
            foreach($v as $i=>$t){
                $text .= '<td>'.$t.'</td>';
            }
            $text .= '</tr>';                    
        }        
        $text .= '</table>';        
        $text = str_replace_kaz($text);        
        return $text;
    }
    
    
    
    
    
    
    $form = $db->Select("select * from report_forms_b where id_form = $id_form order by POSITION");
    
    $fl = "left";
    $wst = 0;
    foreach($form as $k=>$v){           
        $width = 100 / (12 / $v['SIZE_P']) - 3;
        
        if($wst >= 12){
            $html .= '<div style="width: 100%; float: left;"></div>';
            $fl = "left";
            $wst = 0; 
        }
        
        $wst += $v['SIZE_P'];  
                
        $text = base64_decode($v['HTML_TEXT']);
        
        if(trim($text) == '<div class="pagebreak"> </div>'){
            $html .= $text; 
        }else{ 
            $html .= '<div style="width: '.$width.'%; float: '.$fl.'; margin-left: 15px; font-size: 10px;">';
        }        
        
        //Селект для конструирования селекта
        $p = $db->Select("select SM.FUNCT, nvl(FUNCT, SM.COL_NAME ) nvl_colname,  ST.TABLE_NAME, SM.COL_NAME, ST.TABLE_META, SM.COL_META, ST.UNIONALL
        from S_FORM_PARAMS sf, s_meta_columns sm, S_META_TABLES st
        where SF.ID_COL = SM.ID and SM.ID_TABLE = ST.ID  and SF.ID_TABLE = ST.ID
        and sf.id_form = $id_form and sf.id_block = ".$v['ID']."
        group by  SM.FUNCT, ST.TABLE_NAME, SM.COL_NAME, ST.TABLE_META, SM.COL_META, ST.UNIONALL
        ");
        
        //echo $db->sql;
        
        //Перебираем записи
        foreach($p as $t=>$d){            
            $span = "[".$d['TABLE_META']."].[".$d['COL_META']."]";
            
            //Если имя таблицы совпадает с именем основной таблицы тогда делаем все просто
            
            
            
        
            
                                       
            if($d['TABLE_NAME'] == $table1){
                $sql = "select ".$d['NVL_COLNAME']." sp from ".$d['TABLE_NAME']." where $main_col = $val";
                $rp = $db->Select($sql);              
                $text = str_replace($span, $rp[0]["SP"], $text);                
            }else{
                $main_sql = '';
                $sql = CreateSQL($table1, $d['TABLE_NAME'], $d['NVL_COLNAME'], $main_col, $val);                                
                $rp = $db->Select($sql);
                if(!$rp){      
                    $sql = CreateSQL2($table1, $d['TABLE_NAME'], $d['NVL_COLNAME'], $main_col, $val);                    
                    $rp = $db->Select($sql);  
                    $text = str_replace($span, $rp[0]["SP"], $text);
                }else{
                    $text = str_replace($span, $rp[0]["SP"], $text);  
                }
            }
        }
        $html .= $text;        
        //-----------------------------------------------------
                
        if($fl == 'left'){$fl = 'right';}else{$fl = "left";}   
        $html .= "</div>";     
    }
    
    $html .= '</body></html> ';
 //   echo $html;
  //  exit;
     
     
      
    
    $txt = explode('<div class="pagebreak"> </div>', $html);   
    $mpdf = new mPDF();
    
    $q = $db->Select("
    select cnct_id, contract_num, contract_date, id_insur, pay_sum_p, pay_sum_v, date_begin, date_end from contracts where cnct_id = $val 
    union all 
    select cnct_id, contract_num, contract_date, id_insur, pay_sum_p, pay_sum_v, date_begin, date_end from contracts_maket where cnct_id = $val");
    
    $data = '';
    foreach($q[0] as $k=>$v){
        $data .= $v.";";
    }
        
        
    $h = 'http';
    if($active_user_dan['role'] == 21){
        $h = 'https';
    }
    $port = $_SERVER['SERVER_PORT'];
    if($port == 80){
        $port = '';
    }else{
        $port = ":".$port;
    }
    
    $http = strtolower($h."://".$_SERVER['SERVER_NAME'].$port);
    $url = "$http/methods/qrimage.php?data=$data&&type";    
                
    $mpdf->SetHTMLHeader('<div style="text-align: right;"><img style="margin-right: -50px; margin-top: -25px;" src="'.$url.'"></div>');          
        
    $mpdf->setFooter('{PAGENO}');
        
    for($i=0;$i<count($txt);$i++){
        $mpdf->AddPage();   
        $mpdf->WriteHTML($txt[$i]);    
    }
        
    
    $mpdf->Output();
    
    exit;                                                                                                                            
                                                                                                                        
?>
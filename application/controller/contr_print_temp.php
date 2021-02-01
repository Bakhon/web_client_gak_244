<?php
    $db = new DB();
    
    $sql_meta = "select * from DIC_META order by id";
    $list_meta = $db -> Select($sql_meta);
    
    if(isset($_GET['temp_id'])){
        $temp_id = $_GET['temp_id'];
        $sql = "select * from report_html_other where id_otchet = $temp_id order by position";
        $list_temp = $db -> Select($sql);
    }else{
        
    }
    
    if(isset($_GET['employee_id'])){
        //построение обьекта Employee
        $empId = $_GET['employee_id'];
    
        //создаем обьект Employee, в параметры передаем ID
        $employee = new Employee($empId);
        
        //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
        $empInfo = $employee -> get_emp_from_DB_trivial();
        
        $sqlEmpInfo = "select triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv             .DOCDATE, doc_place.NAME DOCPLACE_NAME, sex.NAME SEX from sup_person triv, DIC_DOC_PLACE doc_place, DIC_SEX SEX where triv.ID = 373 and triv.DOCPLACE = doc_place.ID          and sex.ID = triv.SEX and triv.ID = $empId";
        
        $sqlJOB_CONTR_NUM = 'select JOB_CONTR_NUM from JOB_CONTR_NUM where id = 1';
        $listJOB_CONTR_NUM = $db -> Select($sqlJOB_CONTR_NUM);
        $JOB_CONTR_NUM = $empInfo[0]['CONTRACT_JOB_NUM'];
        $CONTRACT_JOB_DATE = $empInfo[0]['CONTRACT_JOB_DATE'];
        
        $name = $empInfo[0]['LASTNAME'];
        $lastname = $empInfo[0]['FIRSTNAME'];
        $middlename = $empInfo[0]['MIDDLENAME'];
        $DOCNUM = $empInfo[0]['DOCNUM'];
        $DOCDATE = $empInfo[0]['DOCDATE'];
        $country = $empInfo[0]['RU_NAME'];
        $cityname = $empInfo[0]['FACT_ADDRESS_CITY'];
        $fact_street = $empInfo[0]['FACT_ADDRESS_STREET'];
        $fact_address_building = $empInfo[0]['FACT_ADDRESS_BUILDING'];
        $bossname = $_GET['bossname'];
        $bossname_kaz = $_GET['bossname_kaz'];
        $pos_id = $empInfo[0]['JOB_POSITION'];
        $dep_id = $empInfo[0]['JOB_SP'];
        $filial_id = $empInfo[0]['FILIAL'];
        $branch_id = $empInfo[0]['BRANCHID'];
        $sql_branch = "select NAME, NAME_KZ, ADDRESS, ADDRESS_KZ from DIC_BRANCH where RFBN_ID = $branch_id";
        $emp_branch = $db -> Select($sql_branch);
        $address_kaz = $emp_branch[0]['ADDRESS_KZ'];
        $address = $emp_branch[0]['ADDRESS'];
        $branch_name = $emp_branch[0]['NAME'];
        $branch_name_kaz = $emp_branch[0]['NAME_KZ'];
        $sql_depart = "select NAME, NAME_KAZ from DIC_DEPARTMENT where ID = $dep_id";
        $emp_depart = $db -> Select($sql_depart);
        $depName = $emp_depart[0]['NAME'];
        $depName_kaz = $emp_depart[0]['NAME_KAZ'];
        $sql_position = "select D_NAME, D_NAME_KAZ from DIC_DOLZH where id = $pos_id";
        $emp_position = $db -> Select($sql_position);
        $posName = $emp_position[0]['D_NAME'];
        $posNameKaz = $emp_position[0]['D_NAME_KAZ'];
        $telNum = $empInfo[0]['MOB_PHONE'];
        $IIN = $empInfo[0]['IIN'];
        $IIN = $empInfo[0]['IIN'];
        $OKLAD = $empInfo[0]['OKLAD'];
        $DOCPLACE_ID = $empInfo[0]['DOCPLACE'];
        $sql_doc = "select NAME_KAZ, NAME from DIC_DOC_PLACE where ID = $DOCPLACE_ID";
        $emp_doc = $db -> Select($sql_doc);
        $DOCPLACE = $emp_doc[0]['NAME'];
        $DOCPLACE_KAZ = $emp_doc[0]['NAME_KAZ'];
        
        $DOCDATE = $empInfo[0]['DOCDATE'];
        $FACT_ADDRESS = $empInfo[0]['FACT_ADDRESS'];
        
        $d = getdate();
        
        foreach ( $d as $key => $val )
        $_monthsList = array(
        "1"=>"Января","2"=>"Февраля","3"=>"Марта",
        "4"=>"Апреля","5"=>"Мая", "6"=>"Июня",
        "7"=>"Июля","8"=>"Августа","9"=>"Сентября",
        "10"=>"Октября","11"=>"Ноября","12"=>"Декабря");
         
        $month = $_monthsList[date("n")];
        
        $DATE_POST = $empInfo[0]['DATE_POST'];
        $last = substr($DATE_POST, -1);
        $last_rep = $last+1;
        $DATE_POST_PLUS_YEAR = substr_replace($DATE_POST, $last_rep,-1);
    }else{
        
    }
    
    $sqlEmpInfo = "select triv.OKLAD, triv.MOB_PHONE, triv.DATE_POST, triv.FACT_ADDRESS_FLAT, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.REG_ADDRESS_STREET, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv.DOCDATE, doc_place.NAME DOCPLACE_NAME, doc_place.NAME_KAZ DOCPLACE_NAME_KAZ, sex.NAME SEX, sex.NAME_KAZ SEX_KAZ, country.RU_NAME FACT_ADDRESS_COUNTRY_ID, branch.NAME BRANCHID, branch.NAME_KZ BRANCHID_KZ, dep.NAME JOB_SP, dep.NAME_KAZ JOB_SP_KAZ, dolzh.D_NAME JOB_POSITION, dolzh.D_NAME_KAZ D_NAME_KAZ from sup_person triv, DIC_DOC_PLACE doc_place, DIC_SEX sex, DIC_COUNTRY country, DIC_BRANCH branch, DIC_DEPARTMENT dep, DIC_DOLZH dolzh where triv.DOCPLACE = doc_place.ID and sex.ID = triv.SEX and country.ID = triv.FACT_ADDRESS_COUNTRY_ID and branch.RFBN_ID = triv.BRANCHID and dep.ID = triv.JOB_SP and dolzh.ID = triv.JOB_POSITION and triv.ID = $empId";
    
    if(isset($_GET['HOLIDAYS_ID']))
        {
            $holi_id = $_GET['HOLIDAYS_ID'];
            $sqlEmpInfo = "select triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE,                triv.DOCNUM, triv.DOCDATE,  holi.DATE_BEGIN, holi.DATE_END, CNT_DAYS, PERIOD_BEGIN, PERIOD_END, ORDER_NUM, ORDER_DATE from PERSON_HOLIDAYS holi,              sup_person triv WHERE triv.ID = holi.ID_PERSON and holi.ID = $holi_id";
        }
        $empInfo = $db -> Select($sqlEmpInfo);
        
    foreach($list_temp as $k => $v)
    {
        $NUM_PP = $v['NUM_PP'];
        if($NUM_PP == 6){
            $size = '48%';
        }else{
            $size = '100%';
        }
        $ID_OTCHET = $v['ID_OTCHET'];
        $POSITION = $v['POSITION'];
        $TITLE = $v['TITLE'];
        $HTML_TEXT = base64_decode($v['HTML_TEXT']);
        $ID = $v['ID'];
        foreach($list_meta as $k => $v){
            $arr_elem_name = $v['VARIABLE'];
            $repl_var = $empInfo[0]["$arr_elem_name"];
            $HTML_TEXT = str_replace($v['META'], $repl_var, $HTML_TEXT);
        }
        $fin_html .= $HTML_TEXT;
        $html .= "<div style='float: left; width: $size; margin-right: 10px; margin-left: 10px;'>
                         <div>".$fin_html."</div>
                  </div>";
        unset($fin_html);
    }
    
    //echo $html;
    
    //echo '<pre>';
    //print_r($list_temp);
    //echo '<pre>';
    include("methods/mpdf/mpdf.php");
    
    $mpdf = new mPDF('UTF-8', 'A4', '8', '', 10, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/
    $mpdf->charset_in = 'UTF-8'; /*не забываем про русский*/
    $mpdf->WriteHTML($stylesheet, 1);
    
    $mpdf->list_indent_first_level = 0; 
    $mpdf->WriteHTML($html, 2); /*формируем pdf*/
    $mpdf->Output('mpdf.pdf', 'I');
    
?>
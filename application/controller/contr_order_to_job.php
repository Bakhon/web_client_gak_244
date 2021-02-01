<?php
    $db = new DB();

    //построение обьекта Employee
    $empId = $_GET['employee_id'];
    
    //создаем обьект Employee, в параметры передаем ID
    $employee = new Employee($empId);
    
    //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
    $empInfo = $employee -> get_emp_from_DB_trivial();
    
    $sqlEmpInfo = "select * from sup_person where id = $empId";
    $empInfo = $db -> Select($sqlEmpInfo);
    $order_num = $_GET['номер_приказа'];
    
    $sqlJOB_CONTR_NUM = 'select JOB_CONTR_NUM from JOB_CONTR_NUM where id = 1';
    $listJOB_CONTR_NUM = $db -> Select($sqlJOB_CONTR_NUM);
    $JOB_CONTR_NUM = $empInfo[0]['CONTRACT_JOB_NUM'];
    $CONTRACT_JOB_DATE = $empInfo[0]['CONTRACT_JOB_DATE'];
    
    $name = $_GET['имя_рус'];
    $lastname = $_GET['фамилия_рус'];
    $middlename = $_GET['отчество_рус'];
    $name_kaz = $_GET['имя_каз'];
    $lastname_kaz = $_GET['фамилия_каз'];
    $middlename_kaz = $_GET['отчество_каз'];
    $DOCNUM = $empInfo[0]['DOCNUM'];
    $DOCDATE = $empInfo[0]['DOCDATE'];
    $country = $empInfo[0]['RU_NAME'];
    $cityname = $empInfo[0]['FACT_ADDRESS_CITY'];
    $fact_street = $empInfo[0]['FACT_ADDRESS_STREET'];
    $fact_address_building = $empInfo[0]['FACT_ADDRESS_BUILDING'];
    $bossname = $_GET['руководитель'];
    $bossname_kaz = $_GET['руководитель'];
    //position ID
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
    //position ID
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

    
$html = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%">ПРИКАЗ</th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="50%" style="text-align: justify; font-size: 14pt; width: 100%; text-indent: 20px;">
            <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                            № '.$order_num.'<br>
                            '.$CONTRACT_JOB_DATE.' г.	<br>
                            
                            '.$name_kaz.' '.$lastname_kaz.' '.$middlename_kaz.' жұмысқа қабылдау туралы
            </p>
            </td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="30%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
            <td></td>
            <td width="10%"></td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%">БҰЙЫРАМЫН:</th><br><br>
            <td width="10%">
            </td>
            </tr>
        </table>  
               <div style="padding: -20px 20px;">  
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    '.$name.' '.$lastname.' '.$middlename.' (бұдан әрі – жұмыскер) '.$DATE_POST.' «Мемлекеттік аннуитеттік компания» өмірді сақтандыру компаниясы» АҚ ___________ ___________ '.$DATE_POST.'  № '.$order_num.' Еңбек шартына сәйкес лауазымақымен тағайындалсын. 
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    2. Жұмыскердің тікелей басшысы ретінде '.$bossname_kaz.' ('.$posNameKaz.',                  А.Ә. Тегі) тағайындалсын, оған:
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                   1) жұмыскерге жұмыс орнын ұсыну;
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    2) МАК РӘС 601 талаптарына сәйкес жұмыскермен лауазымдық міндеттерін тиісінше орындау үшін қажетті техникалық оқуды ұйымдастыру;
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    3) МАК РӘС 601 талаптарына сәйкес сынақ мерзімін өткізуді ұйымдастыру тапсырылсын.
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 40px;">
                    3. Персоналды басқару бойынша бас маман үш күндік мерзімде осы бұйрықпен жұмыскерге қол қойдырып таныстырсын.
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 40px;">
                    4. Тікелей басшы жұмыскерді,
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    1) лауазымдық нұсқаулық және бөлімше туралы ережемен;
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    2) жұмыскердің қызметіне қатысты ішкі нормативтік құжаттармен қол қойдырып таныстырсын.
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 40px;">
                     5. Осы бұйрықтың орындалуын бақылау персоналды басқару бойынша бас маманға және жұмыскердің тікелей басшысына жүктеледі.
                </p>
                </div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%"></th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="50%">
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">Басқарма төрағасы</p> 
            </td>
            <td width="10%">
            </td>
            <td width="40%" style="text-align: right; font-size: 14pt; width: 100%">
            <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
            ______________________
            </p>
            </td>
            </tr>
            <tr>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%"></th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%"></th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%"></th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%">ПРИКАЗ</th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="50%" style="text-align: justify; font-size: 14pt; width: 100%; text-indent: 20px;">
            <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                            № '.$order_num.'<br>
                            '.$CONTRACT_JOB_DATE.' г.	<br>
                            
                            О приеме на работу '.$name.' '.$lastname.' '.$middlename.'
            </p>
            </td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="30%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
            <td></td>
            <td width="10%"></td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%">ПРИКАЗЫВАЮ:</th><br><br>
            <td width="10%">
            </td>
            </tr>
        </table>  
               <div style="padding: -20px 20px;">  
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    '.$name.' '.$lastname.' '.$middlename.' (в дальнейшем — работник) принять с '.$DATE_POST.' г. в АО «Компания по страхованию жизни «Государственная аннуитетная компания»  на должность '.$posName.' ('.$branch_name.', '.$depName.')  с окладом согласно трудовому договору № '.$order_num.' от '.$CONTRACT_JOB_DATE.' г. 
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    2. Непосредственным руководителем работника назначить '.$bossname.'('.$posName.', '.$name.' '.$lastname.' '.$middlename.'), которому/ой необходимо:
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    1) предоставить рабочее место работнику;
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    2) организовать техническую учебу, необходимую для надлежащего исполнения работником его должностных обязанностей, в соответствии с требованиями ПРО ГАК 601;
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    3) организовать проведение испытательного срока в соответствии с требованиями ПРО ГАК 601;
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    4) ознакомить под роспись работника с должностной инструкцией и положением о подразделении (при наличии);
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
                    5) ознакомить под роспись работника с внутренними нормативными документами, касающимися деятельности работника.
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 40px;">
                    3. Специалисту по управлению персоналом ознакомить под роспись работника с настоящим  приказом;
                </p>
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 40px;">
                    4. Контроль за исполнением данного Приказа возлагается на Специалиста по управлению персоналом и непосредственного руководителя работника.
                </p>
                </div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%"></th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="50%">
                <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">Председатель Правления</p> 
            </td>
            <td width="10%">
            </td>
            <td width="40%" style="text-align: right; font-size: 14pt; width: 100%">
            <p style="text-align: justify; font-size: 11pt; padding: -5px ; text-indent: 20px;">
            ______________________
            </p>
            </td>
            </tr>
            <tr>
            </tr>
        </table>
        ';

//require_once("methods/mpdf/mpdf.php");
include("methods/mpdf/mpdf.php");

$mpdf = new mPDF('utf-8', 'A4', '8', '', 10, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/
$mpdf->charset_in = 'utf-8'; /*не забываем про русский*/

$stylesheet = file_get_contents('style.css'); /*подключаем css*/
$mpdf->WriteHTML($stylesheet, 1);

$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($html, 2); /*формируем pdf*/
$mpdf->Output('mpdf.pdf', 'I');
?>
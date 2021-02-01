<?php
    $db = new DB();        

    //построение обьекта Employee
    if(isset($_GET['employee_id']))
    {
    $empId = $_GET['employee_id'];
    }
    if(isset($_GET['pt_id']))
    {
    $person_training_id = $_GET['pt_id'];
    }
    //создаем обьект Employee, в параметры передаем ID
    $employee = new Employee($empId);
    
    //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
 //   $empInfo = $employee -> get_emp_from_DB_trivial();
    $sqlEmpInfo = '';
    $sqlEmpInfo = "select pt.*,  triv.*,  doc_place.NAME DOCPLACE_NAME, doc_place.NAME_KAZ DOCPLACE_NAME_KAZ, sex.NAME SEX, sex.NAME_KAZ SEX_KAZ, country.RU_NAME FACT_ADDRESS_COUNTRY_ID, branch.NAME BRANCHID, branch.NAME_KZ BRANCHID_KZ, dep.NAME JOB_SP, dep.NAME_KAZ JOB_SP_KAZ, dolzh.D_NAME JOB_POSITION, dolzh.D_NAME_KAZ D_NAME_KAZ, (select sup.lastname  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_lastname, (select sup.firstname  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_firstname, (select sup.middlename  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_middlename,  ( select substr(sp.FIRSTNAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) first, ( select substr(sp.MIDDLENAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) surname,  (select DOLJ.D_NAME from  DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec, (select DOLJ.D_NAME_KAZ from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec_kaz, DOLZH.ID_PODPIS, osn.text_kaz, osn.text_rus from DIC_PERSON_OSN osn, sup_person triv, DIC_DOC_PLACE doc_place, DIC_SEX sex, DIC_COUNTRY country, DIC_BRANCH branch, DIC_DEPARTMENT dep, DIC_DOLZH dolzh, person_training pt where triv.DOCPLACE = doc_place.ID and sex.ID = triv.SEX and country.ID = triv.FACT_ADDRESS_COUNTRY_ID and branch.RFBN_ID = triv.BRANCHID and dep.ID = triv.JOB_SP and dolzh.ID = triv.JOB_POSITION and triv.ID = $empId and osn.id = dolzh.OSNOVANIE and pt.id_person = triv.id and pt.id = $person_training_id";
    $empInfo = $db -> Select($sqlEmpInfo);
    
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
    $location_rus = $empInfo[0]['LOCATION'];
    $location_kaz = $empInfo[0]['LOCATION_KAZ'];
    $date_begin = $empInfo[0]['DATE_BEGIN'];
    $date_end = $empInfo[0]['DATE_END'];
    $name_kz = $empInfo[0]['NAME_KAZ'];
    $name_ru = $empInfo[0]['NAME'];
    $sum_train = $empInfo[0]['SUM'];
    $bossname = $_GET['bossname'];
    $bossname_kaz = $_GET['bossname_kaz'];
    //position ID
    $pos_id = $empInfo[0]['JOB_POSITION'];
    $dep_id = $empInfo[0]['JOB_SP'];
    $filial_id = $empInfo[0]['FILIAL'];
    $branch_id = $empInfo[0]['BRANCHID'];
    $sql_branch = "select NAME, ADDRESS, ADDRESS_KZ from DIC_BRANCH where RFBN_ID = $branch_id";
    $emp_branch = $db -> Select($sql_branch);
    $address_kaz = $emp_branch[0]['ADDRESS_KZ'];
    $address = $emp_branch[0]['ADDRESS'];
    $branch_name = $emp_branch[0]['NAME'];
    $sql_depart = "select NAME from DIC_DEPARTMENT where BRANCH_ID = $branch_id";
    $emp_depart = $db -> Select($sql_depart);
    $depName = $emp_depart[0]['NAME'];
    $sql_position = "select D_NAME from DIC_DOLZH where ID = $pos_id";
    $emp_position = $db -> Select($sql_position);
    $posName = $emp_position[0]['D_NAME'];
    //position ID
    $telNum = $empInfo[0]['MOB_PHONE'];
    $IIN = $empInfo[0]['IIN'];
    $IIN = $empInfo[0]['IIN'];
    $OKLAD = $empInfo[0]['OKLAD'];
    
    $text_kaz = $empInfo[0]['TEXT_KAZ'];
    $text_rus = $empInfo[0]['TEXT_RUS'];
    $sup_firstname = $empInfo[0]['SUP_FIRSTNAME'];
    $sup_lastname = $empInfo[0]['SUP_LASTNAME'];
    $sup_middlename = $empInfo[0]['SUP_MIDDLENAME'];
    
    $DOCPLACE_ID = $empInfo[0]['DOCPLACE'];
    $sql_doc = "select NAME_KAZ, NAME from DIC_DOC_PLACE where ID = $DOCPLACE_ID";
    $emp_doc = $db -> Select($sql_doc);
    $DOCPLACE = $emp_doc[0]['NAME'];
    $DOCPLACE_KAZ = $emp_doc[0]['NAME_KAZ'];
    
    $DOCDATE = $empInfo[0]['DOCDATE'];
    $docdate2 = $DOCDATE[date("y")];
    $time=strtotime($DOCDATE);
    $year=date("Y",$time);
    $day = date("d", $time);
    $mon = date("m", $time);        
    
    
    $FACT_ADDRESS = $empInfo[0]['FACT_ADDRESS'];
    $BIRTHDATE = $empInfo[0]['BIRTHDATE'];
    $doctype = $empInfo[0]['DOCTYPE'];
    $list_doctype = $db->select("select * from DIC_DOC_PLACE where id = $doctype");
    
    
    $d = $DOCDATE;
    
    foreach ( $d as $key => $val )
    $_monthsList = array(
    "1"=>"Января","2"=>"Февраля","3"=>"Марта",
    "4"=>"Апреля","5"=>"Мая", "6"=>"Июня",
    "7"=>"Июля","8"=>"Августа","9"=>"Сентября",
    "10"=>"Октября","11"=>"Ноября","12"=>"Декабря");
     
    $month = $_monthsList[date("n")];
    $today_date = date('d.m.Y');    
    
    
    //$der = $DOCDATE;
    
   $der =  getdate(); 
    
    foreach ( $der as $key1 => $val1 )
    $_monthsList_kaz = array(
    "1"=>"Қантарда","2"=>"Ақпанда","3"=>"Наурызда",
    "4"=>"Сәуірде","5"=>"Мамырда", "6"=>"Маусымда",
    "7"=>"Шілдеде","8"=>"Тамызда","9"=>"Қыркүйекте",
    "10"=>"Қазанда","11"=>"Қарашада","12"=>"Желтоқсанда");
    $monthkaz = $_monthsList_kaz[date("n")];
       
    
    
    $DATE_POST = $empInfo[0]['DATE_POST'];
    $last = substr($DATE_POST, -1);
    $last_rep = $last+1;
    $DATE_POST_PLUS_YEAR = substr_replace($DATE_POST, $last_rep,-1);
    
    $html = '<div align="center">
            <div align="justify" style="float: left; width: 100%; margin-right: 10px; font-size: 14px; float: left; font-family: TimesNewRoman;            	
            	font-style: normal;
            	font-variant: normal;
            	font-weight: 400;">
                <div style="text-align:  center;">
                <b>Жұмыс берушінің қаржысы есебінен<br />
                қызметкерлерді оқыту жөнінде<br /> 
                №___шарт </b><br />
                <br>
                </div>
                <div style="text-align:  left;">
                 <b>Нұр-Сұлтан қ.</b>                             
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                 <b>'.$today_date.' ж.</b>                
                
                </div>            
                <br>
                <p align="justify" style="text-indent: 10px;">                
                Бұдан әрі «Жұмыс беруші» деп аталатын «Мемлекеттік аннитеттік компания»  өмірді сақтандыру компаниясы» АҚ атынан '.$text_kaz.' бір Тараптан, <br/> және бұдан әрі «Жұмыскер» деп аталатын <b>'.$name.' '.$lastname.' '.$middlename.'</b>, '.$BIRTHDATE.' жылы туылған, жеке куәлігінің № '.$DOCNUM.', ҚР '.$list_doctype[0]['NAME_KAZ'].'
                '.$year.' жылдың '.$day.'.'.$mon.' берілген, бірге «Тараптар» деп аталатындар, төмендегілер жөнінде осы шартты (бұдан әрі-Шарт) жасасты.   
                </p>
                <br/>
                
                <div style="text-align:  center;">
                <strong><b>1.	ШАРТТЫҢ МӘНІ</b></strong>
                </div>
                <br/>                
                <p align="justify" style="text-indent: 10px;">
                1.1.Жұмыс беруші Жұмыскерге '.$location_kaz.' қаласында '.$date_begin.' ж. '.$date_end.' ж. '.$name_kz.' тақырыпта оқумен (бұдан әрі – Оқу) байланысты шығындарды төлейді. 
                </p>
                <br/>
                <div style="text-align:  center;">
                <strong><b>2. ТАРАПТАРДЫҢ ҚҰҚЫҚТАРЫ МЕН <br/>МІНДЕТТЕРІ</b></strong>
                </div>
                <p align="justify" style="text-indent: 10px;">
                &nbsp;2.1. Жұмыскер: <br/>
                &nbsp;&nbsp;2.1.1. Тікелей басшысының келісімі бойынша егер бекітілген сабақ кестесі талап етсе өндірістен оқу кезінде ағымдағы лауазымдық міндеттерін орындаудан босатылуға  құқылы.<br/>
                &nbsp;&nbsp;2.2. Жұмыскер:<br/>
                &nbsp;&nbsp;2.2.1. Бекітілген оқу кестесі мен бағдарламасының талабына сәйкес оқыту бойынша барлық тапсырмаларды орындауға, курстың барлық сабақтарына қатысуға;<br/>
                &nbsp;&nbsp;2.2.2. Жұмыс берушіде оқу курсы аяқталған соң 1 жыл жұмыспен өтеуге;<br/>
                &nbsp;&nbsp;2.2.3. Еңбек шартын өзінің бастамасы, немесе теріс себептермен мерзімінен бұрын бұзған жағдайда Жұмыс берушіге Шарттың 3.1.-тармағында көрсетілген шығындарды, сондай-ақ іс-сапар (жол, өмір сүру, тәуліктік) шығындарын толықтай немесе өтелмеген мерзімге пропорционалды өтеуге;<br/>
                &nbsp;&nbsp;2.2.4. оқу процесінде алған білімін және дағдыларын тиімді қолдануға міндетті.<br/>
                &nbsp;&nbsp;2.3. Жұмыс беруші:<br/>
                &nbsp;&nbsp;2.3.1. Жұмыскер еңбек шартын өзінің бастамасы, немесе теріс себептермен мерзімінен бұрын бұзған жағдайда Шарттың 3.1.-тармағында көрсетілген шығындарды, сондай-ақ іс-сапар (жол, өмір сүру, тәуліктік) шығындарын толықтай немесе өтелмеген мерзімге пропорционалды өтетуге құқылы.<br/>    
                &nbsp;&nbsp;2.4. Жұмыс беруші:<br/>
                &nbsp;&nbsp;2.4.1. шарттың 1.1-тармағына сәйкес Жұмыскерге оқудан өтуге мүмкіндік беруге;<br/>
                &nbsp;&nbsp;2.4.2. Жұмыскерге оқуын төлеуге;<br/>
                &nbsp;&nbsp;2.4.3. Тікелей басшысының келісімі бойынша егер бекітілген сабақ кестесі талап етсе жұмыскерді өндірістен оқу кезінде ағымдағы лауазымдық міндеттерін орындаудан босатуға;<br/>
                &nbsp;&nbsp;2.4.5. оқу кезінде оның жұмыс орнын (лауазымын) және еңбек ақысын сақтауға міндетті.<br/>
                </p>
                <br/>
                <div style="text-align:  center;">
                <strong><b>3. ТӨЛЕМ ШАРТТАРЫ</b></strong>
                </div>
                <p align="justify" style="text-indent: 10px;">
                3.1. Оқу құны '.$sum_train.' ('.num3str($sum_train, true).') теңгені құрайды.<br/>
                &nbsp;&nbsp;3.2. Шығындарды өтеу еңбек шартын мерзімінен бұрын бұзған жағдайда Тараптардың келісімі бойына қосымша белгіленген мерзімде жүзеге асырылады.
                </p>
                <div style="text-align:  center;">
                <strong><b>4. ДАУЛАРДЫ ШЕШУ ТӘРТІБІ</b></strong>
                </div>
                <p align="justify" style="text-indent: 10px;">
                4.1. Осы Шарт бойынша міндеттемелерді орындау барысында туындаған даулар мен келіспеушіліктер Тараптармен келіссөздер арқылы шешіледі.<br/>
                &nbsp;&nbsp;4.2. Егер Тараптар келіссөздер тәсілімен келісімге келмеген жағдайда, даулар Қазақстан Республикасының қолданыстағы заңнамасына сәйкес сотпен қаралады.
                </p>
                <div style="text-align:  center;">
                <strong><b>5. ШАРТТЫҢ ҚОЛДАНЫС МЕРЗІМІ</b></strong>
                </div>
                <p align="justify" style="text-indent: 10px;">
                 5.1. Шарт оған Тараптар қол қойған сәттен күшіне енеді және ол бойынша Тараптар өздерінің міндеттемелерін толық өтегенге дейін қолданыста болады.
                </p>
                <div style="text-align:  center;">
                <strong><b>6. БАСҚА ШАРТТАР</b></strong>
                </div>
                <p align="justify" style="text-indent: 10px;">
                6.1. Осы Шартқа барлық өзгерістер мен толықтырулар Тараптардың келісімі бойынша қабылданады және осы Шарттың ажырамас бөлігі болып табылатын Тараптар қол қоятын Қосымша келісіммен рәсімделеді.<br/>
                &nbsp;&nbsp;6.2. Осы Шарт екі данада қазақ және орыс тілдерінде әр Тарапқа бір-бірден жасалды.
                </p>
                <br/>
                <br/>
                <br/>
                <p align="justify" style="text-indent: 10px;">
                <b>ЖҰМЫС БЕРУШІ: <br/>
«Мемлекеттік аннуитеттік компания»<br/>
өмірді сақтандыру компаниясы» АҚ</b><br/>
Адрес: Нұр-Сұлтан қ. Мәңгілік Ел көшесі, 20, <br/>"Palazzo degli affari" Бизнес орталығы<br/>
Тел. 8 (7172) 916-333<br/>
СТН 620300259355<br/>
ЖСК KZ 506010111000044734 <br/>
«Қазақстанның халық банкі» АҚ<br/>
Нұр-Сұлтан қ. өңірлік филиалы<br/>
БСК HSBKKZKX, КБе 15<br/>
  
                </p><br /><b>'.$sup_lastname.' '.$sup_firstname.' '.$sup_middlename.'</b> ________________  
                <br />
                <p align="justify" >
                <b>ЖҰМЫСКЕР:</b>
                </p>
                <p>
                 '.$name.' '.$lastname.' '.$middlename.' <br/> '.$BIRTHDATE.' жылы туылған,<br/> жеке куәлігінің №'.$DOCNUM.',<br/> ҚР '.$list_doctype[0]['NAME_KAZ'].' '.$DOCDATE.' жылы  берілген.
                </p>                               
                <p>
                <b>'.$name.' '.$lastname.' '.$middlename.'</b> ___________________  
                </p>

            </div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <div align="justify" style="float: left; width: 3%; margin-right: 10px; font-size: 10px; border-style:solid; border: 1px; border-color: white" float: right;>
    </div>
    <div align="justify" style="float: left; width: 100%; margin-right: 10px; font-size: 14px; float: left; font-family: TimesNewRoman;            	
            	font-style: normal;
            	font-variant: normal;
            	font-weight: 400;">
                <div style="text-align:  center;">
                <b>Договор<br/>
                об обучении сотрудников за счет средств работодателя <br/>
                № ______</b>
                </div>                
                <br/>
                <div style="text-align:  left;">
                <b>г.Нур-Султан</b>                                                                                         
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                <b>'.$today_date.' г.</b>
                </div>
                <br/>
                <p align="justify" style="text-indent: 10px;">
                АО «Компания по страхованию жизни «Государственная аннуитетная компания», именуемое в дальнейшем «Работодатель», '.$text_rus.' 
                и '.$name.' '.$lastname.' '.$middlename.'  '.$BIRTHDATE.' года рождения, удостоверение личности № '.$DOCNUM.', выдано '.$day.'.'.$mon.'.'.$year.' г, '.$list_doctype[0]['NAME'].'  РК, именуемый в дальнейшем «Работник», с другой стороны, совместно именуемые «Стороны», заключили настоящий договор о нижеследующем (далее – Договор):                
                </p>
                <br/>             
                <div style="text-align:  center;">
                <b>1. ПРЕДМЕТ ДОГОВОРА</b>
                </div
                <br/>
                <br/>
                <p align="justify" style="text-indent: 10px;">
                1.1. Работодатель  оплачивает  Работнику расходы, связанные с обучением  в городе '.$location_rus.' по теме '.$name_ru.' (далее – Обучение) с '.$date_begin.' г. по '.$date_end.' г.
                </p>
                <br/>
                <div style="text-align:  center;">
                <b>2. ПРАВА И ОБЯЗАННОСТИ СТОРОН</b>
                </div
                <br/>
                <p align="justify" style="text-indent: 10px;">
                2.1. Работник имеет право:<br/>
2.1.1. быть освобожденным от выполнения текущих должностных обязанностей, по согласованию с непосредственным руководством, на время обучения с отрывом от производства, если этого требует утвержденное расписание занятий;<br/>
2.2. Работник обязан:<br/>
2.2.1. посещать все занятия курса, выполнять все задания по обучению, в соответствии с учрежденным расписанием и программой обучения;<br/>
2.2.2. отработать у Работодателя 1 год после окончания курса обучения;<br/>
2.2.3. возместить Работодателю затраты указанные в пункте 3.1. Договора, а также командировочные расходы (проезд, проживание, суточные) полностью или пропорционально недоработанному сроку в случае досрочного расторжения  трудового договора по своей инициативе, либо по отрицательным мотивам;<br/>
2.2.4. эффективно использовать знания и навыки, полученные в процессе обучения.<br/>
 2.3. Работодатель имеет право:<br/>
2.3.1. на возмещение Работником затрат, указанных в пункте 3.1. Договора а также командировочные расходы (проезд, проживание, суточные), полностью или пропорционально недоработанному сроку в случае досрочного расторжения  трудового договора по инициативе работника, либо по отрицательным мотивам.<br/>
2.4. Работодатель обязан:<br/>
2.4.1. предоставить работнику возможность пройти обучение согласно пункту 1.1. Договора;<br/>
2.4.2. оплатить обучение Работнику;  <br/>
2.4.3. освободить работника от выполнения текущих должностных обязанностей, по согласованию с <br/>
непосредственным руководством, на время обучения с отрывом от производства, если этого требует утвержденное расписание занятий;<br/>
2.4.4. сохранить за ним место работы (должность) и заработную плату на время обучения.<br/>
                </p>                
                <div style="text-align:  center;">
                <b>3. УСЛОВИЯ ОПЛАТЫ</b>
                </div 
                <br/>               
                <p align="justify" style="text-indent: 10px;">
                3.1. Стоимость обучения составляет '.$sum_train.' ('.num2str($sum_train, true).') тенге.<br/>                
3.2. Возмещение затрат осуществляется в сроки, дополнительно установленные по соглашению сторон при досрочном расторжении трудового договора.
                </p>
                <div style="text-align:  center;">
                <b>4. ПОРЯДОК РАЗРЕШЕНИЯ СПОРОВ</b>
                </div>
                <p align="justify" style="text-indent: 10px;">
                4.1. Споры и разногласия, возникшие в ходе исполнения обязательств по настоящему Договору, разрешаются Сторонами путем переговоров. <br/>
4.2. В случае если Стороны не достигли согласия путем переговоров, споры рассматриваются судом в соответствии с действующим законодательством Республики Казахстан.

                </p>
                <div style="text-align:  center;">
                <b>5. СРОК ДЕЙСТВИЯ ДОГОВОРА</b>
                </div>
                <p align="justify" style="text-indent: 10px;">
                5.1. Договор вступает в силу с момента его подписания сторонами и действует до полного погашения сторонами обязательств по нему.
                </p>
                 <div style="text-align:  center;">
                <b>6. ПРОЧИЕ УСЛОВИЯ</b>
                </div>
                <p align="justify" style="text-indent: 10px;">                	
6.1. Все изменения и дополнения к настоящему Договору принимаются по согласованию Сторон и оформляются Дополнительным соглашением, которое подписывается Сторонами и является неотъемлемой частью настоящего Договора.<br/> 
6.2. Настоящий Договор составлен в двух экземплярах, на казахском и русском  языках, по одному для каждой Стороны.

                </p>
                <br/>
                <p align="justify" style="text-indent: 10px;">
                <b>РАБОТОДАТЕЛЬ:</b><br/>
<b>АО  « Компания  по  страхованию  жизни<br/>
«Государственная аннуитетная компания»<br/></b>
Адрес: г.Нур-Султан, ул.Мангилик Ел, 20, <br/>  Бизнес-центр «Palazzo degli affari» <br/>    
Тел. 8 (7172) 916-333<br/>
РНН 620300259355<br/>
ИИК KZ 506010111000044734 <br/>
Региональный филиал в г. Нур-Султан <br/>
АО «Народный Банк Казахстана»   <br/>            	
БИК HSBKKZKX, КБе 15<br/>

                </p><br />
               <b> '.$sup_lastname.' '.$sup_firstname.' '.$sup_middlename.'</b>  ____________ <br /> <br/>
                                               <div style="text-align: left;">
                                               <b>РАБОТНИК:</b><br />
                                               </div>
              
                <p align="justify" style="text-indent: 10px;">
                '.$name.' '.$lastname.' '.$middlename.'<br/>
  '.$BIRTHDATE.' года рождения,<br/>
удостоверение личности № '.$DOCNUM.',<br/>
выдано '.$DOCDATE.' г., '.$list_doctype[0]['NAME'].' РК.<br/>
</p>
<p>
<b>'.$name.' '.$lastname.' '.$middlename.' </b>  _____________
</p>

            </div>
            </div>';
    
    include("methods/mpdf/mpdf.php");
    
    //$mpdf = new mPDF('UTF-8', 'A4', '8', '', 10, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/
    //$mpdf->charset_in = 'cp1251'; /*не забываем про русский*/
    //$mpdf->WriteHTML($stylesheet, 1);
    
    //$mpdf->list_indent_first_level = 0; 
    //$mpdf->WriteHTML($html, 2); /*формируем pdf*/
    //$mpdf->Output('mpdf.pdf', 'I');
    
    function num2str($num) {
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('тиын' ,'тиын' ,'тиын',    1),
            array('тенге'   ,'тенге'   ,'тенге'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }
    
    function num3str($num) {
        $nul='ноль';
        $ten=array(
            array('','бір','екі','үш','төрт','бес','алты','жеті', 'сегіз','тоғыз'),
            array('','бір','екі','үш','төрт','бес','алты','жеті', 'сегіз','тоғыз'),
        );
        $a20=array('он','он бір','он екі','он үш','он төрт' ,'он бес','он алты','он жеті','он сегіз','он тоғыз');
        $tens=array(2=>'жиырма','отыз','қырық','елу','алпыс','жетпіс' ,'сексен','тоқсан');
        $hundred=array('','жүз','екі жуз','үш жуз','төрт жуз','бес жуз','алты жуз', 'жеті жуз','сегіз жуз','тоғыз жуз');
        $unit=array( // Units
            array('тиын' ,'тиын' ,'тиын',    1),
            array('теңге'   ,'теңге'   ,'теңге'    ,0),
            array('мың'  ,'мың'  ,'мың'     ,1),
            array('миллион' ,'миллион','миллион' ,0),
            array('миллиард','миллиард','миллиард',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }

    /**
     * Склоняем словоформу
     * @ author runcore
     */
    function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }
?>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="mail-box-header">
    <h2>
        Редактирование документа 
    </h2>
</div>
<div class="col-lg-12 animated fadeInRight" style="background-color: white;">
    <form id="form_send_html" method="POST" action="just_print" target="_blank">
    <input name="empId" hidden="" value="<?php echo $empId; ?>"/>
    <textarea name="content_append_contract" style="width: 100%;">
    	<?php
            echo $html;
        ?>
    </textarea>
    <div class="mail-body text-right tooltip-demo">
        <button onclick="" type="submit" target="_blank" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="print"><i class="fa fa-reply"></i> Конвертировать в PDF</button>
    </div>
    </form>
</div>
<script type="text/javascript" src="styles/js/others/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</body>
</html>
<?php
    exit;
?>

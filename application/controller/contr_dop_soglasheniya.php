<?php
    $db = new DB();

    //построение обьекта Employee
    $empId = $_GET['employee_id'];
    
    //создаем обьект Employee, в параметры передаем ID
    $employee = new Employee($empId);

    //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
    $empInfo = $employee -> get_emp_from_DB_trivial();

    $sqlEmpInfo = "select triv.*,  doc_place.NAME DOCPLACE_NAME, doc_place.NAME_KAZ DOCPLACE_NAME_KAZ, sex.NAME SEX, sex.NAME_KAZ SEX_KAZ, country.RU_NAME FACT_ADDRESS_COUNTRY_ID, branch.NAME BRANCHID, branch.NAME_KZ BRANCHID_KZ, dep.NAME JOB_SP, dep.NAME_KAZ JOB_SP_KAZ, dolzh.D_NAME JOB_POSITION, dolzh.D_NAME_KAZ D_NAME_KAZ, (select sup.lastname  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_lastname, (select sup.firstname  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_firstname, (select sup.middlename  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_middlename,  ( select substr(sp.FIRSTNAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) first, ( select substr(sp.MIDDLENAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) surname,  (select DOLJ.D_NAME from  DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec, (select DOLJ.D_NAME_KAZ from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec_kaz, DOLZH.ID_PODPIS, osn.text_kaz, osn.text_rus from DIC_PERSON_OSN osn, sup_person triv, DIC_DOC_PLACE doc_place, DIC_SEX sex, DIC_COUNTRY country, DIC_BRANCH branch, DIC_DEPARTMENT dep, DIC_DOLZH dolzh where triv.DOCPLACE = doc_place.ID and sex.ID = triv.SEX and country.ID = triv.FACT_ADDRESS_COUNTRY_ID and branch.RFBN_ID = triv.BRANCHID and dep.ID = triv.JOB_SP and dolzh.ID = triv.JOB_POSITION and triv.ID = $empId and osn.id = dolzh.OSNOVANIE";
    $empInfo = $db -> Select($sqlEmpInfo);      
    $sqlJOB_CONTR_NUM = 'select JOB_CONTR_NUM from JOB_CONTR_NUM where id = 1';
    $listJOB_CONTR_NUM = $db -> Select($sqlJOB_CONTR_NUM);
    $JOB_CONTR_NUM = $empInfo[0]['CONTRACT_JOB_NUM'];
    $CONTRACT_JOB_DATE = $empInfo[0]['CONTRACT_JOB_DATE'];
    $BIRTHDATE = $empInfo[0]['BIRTHDATE'];

    $name = $empInfo[0]['LASTNAME'];
    $lastname = $empInfo[0]['FIRSTNAME'];
   $name_high_regist =  mb_strtoupper($lastname, 'UTF-8');
   // echo $name_high_regist;
   
    $middlename = $empInfo[0]['MIDDLENAME'];
    $lastname_high_regist = mb_strtoupper($name, 'UTF-8');
    $name_high_regist =  mb_strtoupper($lastname, 'UTF-8');
    $middle_high_regist =  mb_strtoupper($middlename, 'UTF-8');
    
    
    $DOCNUM = $empInfo[0]['DOCNUM'];
    $DOCDATE = $empInfo[0]['DOCDATE'];
    $country = $empInfo[0]['RU_NAME'];
    $cityname = $empInfo[0]['FACT_ADDRESS_CITY'];
    $fact_street = $empInfo[0]['FACT_ADDRESS_STREET'];
    $fact_address_building = $empInfo[0]['FACT_ADDRESS_BUILDING'];
    $fact_address_flat = $empInfo[0]['FACT_ADDRESS_FLAT'];
  
    $bossname = $_GET['bossname'];
    $bossname_kaz = $_GET['bossname_kaz'];

    $name_first_simb = mb_substr($lastname,0,1,"UTF-8");
    $middlename_first_simb = mb_substr($middlename,0,1,"UTF-8");
    $big_simb_lastname = mb_convert_case($name, MB_CASE_UPPER, "UTF-8");
    
    
    $position = $empInfo[0]['JOB_POSITION'];
    $sql_req = "select * from dic_dolzh where id = $position";
    $list_req = $db->select($sql_req);    
    $id_podpis = $list_req[0]['ID_PODPIS'];
    $id_osnovanie = $list_req[0]['OSNOVANIE'];
    $list_dop_s = $db->select("select * from DIC_PERSON_DOP_SOGLASHENIYA where id = $id_osnovanie");
    $na_osnovanie = $list_dop_s[0]['TEXT_OSNOVANIE'];
    $na_osnovanie_kaz = $list_dop_s[0]['TEXT_OSNOVANIE_KAZ'];
    
    $list_podpisant = $db -> select("select * from sup_person where id =$id_podpis");
  //  print_r($list_podpisant);
    $lastname_signer = $list_podpisant[0]['LASTNAME'];
    $firsname_s = $list_podpisant[0]['FIRSTNAME'];
    $middlename_s = $list_podpisant[0]['MIDDLENAME'];
    $job_sp = $list_podpisant[0]['JOB_POSITION'];
    $list_dolzhn = $db->select("select * from dic_dolzh where id = $job_sp ");
    // название должности подписанта
    $name_dolzhn = $list_dolzhn[0]['D_NAME'];
    $name_dolzhn_kaz = $list_dolzhn[0]['D_NAME_KAZ'];
       $text_kaz = $empInfo[0]['TEXT_KAZ'];
    $text_rus = $empInfo[0]['TEXT_RUS'];
    $first_let = $empInfo[0]['FIRST'];
    $full_lastname = $empInfo[0]['SUP_LASTNAME'];
    
    $sup_firstname = $empInfo[0]['SUP_FIRSTNAME'];
    $sup_lastname = $empInfo[0]['SUP_LASTNAME'];
    $sup_middlename = $empInfo[0]['SUP_MIDDLENAME'];
    $sf_high_regist =  mb_strtoupper($sup_firstname, 'UTF-8');
    $sl_high_regist =  mb_strtoupper($sup_lastname, 'UTF-8');
    $sm_high_regist =  mb_strtoupper($sup_middlename, 'UTF-8');
    
    
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
    
    //transfer
    $transf_id = $_GET['transf_id'];
    $last_transf_id = $_GET['last_transf_id'];
    
    $sql_transf = "select CARD.ID_PERSON, CARD.EVENT_DATE, card.EVENT_START_DATE, CARD.ID, CARD.SALARY, DOLZH.D_NAME dolzh, DOLZH.D_NAME_KAZ D_NAME_KAZ, BRANCH.NAME BRANCHNAME, BRANCH.NAME_KZ BRANCHNAME_KAZ, DEP.NAME DEP_NAME, DEP.NAME_KAZ DEP_NAME_KAZ from T2_CARD card, DIC_DOLZH dolzh, DIC_BRANCH branch, DIC_DEPARTMENT dep where CARD.BRANCH_ID = BRANCH.RFBN_ID and CARD.DEPARTMENT = DEP.ID and CARD.POSITION = DOLZH.ID and CARD.id = $transf_id";
    $list_transf = $db -> Select($sql_transf);
    //print_r($list_transf);
    
    $empId = $list_transf[0]['ID_PERSON'];
    $EVENT_DATE = $list_transf[0]['EVENT_DATE'];
    $SALARY = $list_transf[0]['SALARY'];
    $DOLZH = $list_transf[0]['DOLZH'];
    $DOLZH_KAZ = $list_transf[0]['D_NAME_KAZ'];
    $BRANCHNAME = $list_transf[0]['BRANCHNAME'];
    $BRANCHNAME_KAZ = $list_transf[0]['BRANCHNAME_KAZ'];
    $DEP_NAME = $list_transf[0]['DEP_NAME'];
    $DEP_NAME_KAZ = $list_transf[0]['DEP_NAME_KAZ'];
    $EVENT_START_DATE = $list_transf[0]['EVENT_START_DATE'];
        $DOCDATE = $empInfo[0]['DOCDATE'];
    $docdate2 = $DOCDATE[date("y")];
    $time=strtotime($DOCDATE);
    $year=date("Y",$time);
    $day = date("d", $time);
    $mon = date("m", $time);  
    //transfer
    
    $html =   '<div align="justify" style="float: left; width: 100%; margin-right: 10px;  float: left; font-family: TimesNewRoman;
            	font-size: 14px;
            	font-style: normal;
            	font-variant: normal;
            	font-weight: 400;">
                <div style="text-align:  center;">
                <strong>ДОПОЛНИТЕЛЬНОЕ СОГЛАШЕНИЕ № ____<br />
                к Трудовому договору
                № '.$JOB_CONTR_NUM.' от '.$CONTRACT_JOB_DATE.' </strong><br /><br />
                </div>               
                <strong>г. Нур-Султан</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                 	 	                                                                      
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>«05» марта 2020 года</strong><br><br>
               <div align="justify" style="text-indent: 10px;">
                <strong >Стороны:</strong> 
               </div>
                <div align="justify" style="text-indent: 10px;"><strong>РАБОТОДАТЕЛЬ:</strong> Акционерное общество «Компания по страхованию жизни «Государственная аннуитетная компания», государственная регистрация № 19489–1901-АО от 15.06.2005 года, '.$text_rus.' и  
                </div>                
                <div align="justify" style="text-indent: 10px;"><strong>РАБОТНИК:</strong>
               
                '.$name.' '.$lastname.' '.$middlename.', удостоверение личности                          № '.$DOCNUM.' выдано '.$DOCPLACE.' РК от                '.$DOCDATE.' года,              ИИН '.$IIN.', проживающий по адресу:                     г. '.$cityname.', ул. '.$fact_street.', дом '                      .$fact_address_building.', кв. '.$fact_address_flat.' далее совместно именуемые Стороны, заключили настоящее дополнительное   соглашение к трудовому договору  № '.$JOB_CONTR_NUM.' от '.$CONTRACT_JOB_DATE.' (далее – Договор) на нижеследующих условиях (далее - Дополнительное соглашение):
                </div>
                <div align="justify" style="text-indent: 10px;">
                1.	Стороны пришли к соглашению внести в Договор следующее изменение и дополнение:
                </div>
                <div align="justify" style="text-indent: 10px;">
                1)	в пункте 1.2 Раздела 1 Договора изложить в следующей редакции:

                </div>
                <div align="justify" style="text-indent: 10px;">
                 «1.2. Место выполнения работы: Республика Казахстан, г.Нур-Султан, ул.Мәңгілік Ел д.20, 2-3 этаж.»;
                </div>
                <div align="justify" style="text-indent: 10px;">
                2. Все остальные условия Договора, не затронутые настоящим Дополнительным соглашением, остаются в неизменном виде и Стороны подтверждают по ним свои обязательства.
                </div>                
                <div align="justify" style="text-indent: 10px;">
                3. Настоящее Дополнительное соглашение вступает в силу с момента подписания Сторонами и является неотъемлемой частью Договора. 
                </div>
                <div align="justify" style="text-indent: 10px;">
                4.  Настоящее Дополнительное соглашение составлено в двух экземплярах, на русском и казахском языках, имеющих одинаковую юридическую силу, по одному экземпляру для каждой из Сторон.     
                </div>
                <br/>
               <div align="justify" style="text-indent: 10px;">
                <strong>РЕКВИЗИТЫ И ПОДПИСИ СТОРОН </strong>
                </div>
                <br/>
                 <div align="justify" style="text-indent: 10px;">
                <strong> РАБОТОДАТЕЛЬ: Акционерное общество «Компания по страхованию жизни   </strong>
                </div>
                 <div align="justify" style="text-indent: 10px;">
                <strong>«Государственная аннуитетная компания» </strong>
                </div>
                <br/>
                <div align="justify" style="text-indent: 10px;">
                Юридический и фактический адрес: г. Нур-Султан, ул. Мәңгілік Ел 20
                </div>               
                <div align="justify" style="text-indent: 10px;">
                РНН 620300259355, Телефон: 916-333.
                </div>
                <p align="justify" style="text-indent: 10px;">
                 _____________________ <b>'.$first_let.'. '.$sl_high_regist.'</b>
                </p>
                <div align="justify" style="text-indent: 10px;"><strong>РАБОТНИК:</strong>
               
                '.$name.' '.$lastname.' '.$middlename.', удостоверение личности                          № '.$DOCNUM.' выдано '.$DOCPLACE.' РК от                '.$DOCDATE.' года,              ИИН '.$IIN.', проживающий по адресу:                     г. '.$cityname.', ул. '.$fact_street.', дом '                      .$fact_address_building.', кв. '.$fact_address_flat.' 
                </div>
            <p align="justify" style="text-indent: 10px;">
                 _____________________        <b>'.$name_first_simb.'.'.$lastname_high_regist.'</b> 
                </p>                                                
            </div>
            
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div align="justify" style="float: left; width: 100%; margin-right: 10px; float: left; font-family: TimesNewRoman;
            	font-size: 14px;
            	font-style: normal;
            	font-variant: normal;
            	font-weight: 400;">
                
                <div style="text-align:  center;">
                <strong>
                '.$CONTRACT_JOB_DATE.' № '.$JOB_CONTR_NUM.' Еңбек шартына <br/> 
                №___ ҚОСЫМША КЕЛІСІМ
                </strong>                
                </div>    
                <br/>
                <br/> 
                <br/>          
                <strong>Нұр-Сұлтан қ.  </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	 	                                                                      
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>2020 жылғы «05» наурыз</strong><br><br>
               <div align="justify" style="text-indent: 10px;">
                <strong >Тараптар:</strong> 
               </div>
                <div align="justify" style="text-indent: 10px;"><strong>ЖҰМЫС БЕРУШІ:</strong> мекен-жайы:   «Мемлекеттік аннуитеттік компания» өмірді сақтандыру компаниясы» акционерлік қоғамы, мемлекеттік  тіркеуі 15.06.2005 жылғы №19489-1901-АҚ, '.$text_kaz.'   
                </div>                
                <div align="justify" style="text-indent: 10px;"><strong>ЖҰМЫСКЕР:</strong>
               
                '.$name.' '.$lastname.' '.$middlename.', '.$BIRTHDATE.' жылы туылған, жеке куәлік № '.$DOCNUM.', ҚР '.$list_doctype[0]['NAME_KAZ'].'
                '.$year.' жылдың '.$day.'.'.$mon.' берілген, ЖСН '.$IIN.', мекен-жайы:  '.$cityname.' қ., '.$fact_street.' көшесі, '.$fact_address_building.' үй, '.$fact_address_flat.' пәтер, бұдан әрі бірлесіп Тараптар деп аталатындар төмендегідей шарттарда '.$CONTRACT_JOB_DATE.' жылғы  № '.$JOB_CONTR_NUM.' Еңбек шартын ( бұдан әрі- Шарт) осы қосымша келісімді (бұдан әрі - Қосымша келісім) жасады:    
                </div>
                <div align="justify" style="text-indent: 10px;">
               1.Тараптар Шартқа келесі өзгерістер мен толықтыруларды енгізу келісіміне келді:
                </div>
                <div align="justify" style="text-indent: 10px;">
                1) Шарттың 1-бөлімінің 1.2-бабы келесі мазмұнда келесі редакцияда жазылсын:
                <br/>
                 «1.2. Жұмысты орындау жері: Қазақстан Республикасы, Нұр-Сұлтан қ., Мәңгілік Ел көшесі, 20 үй, "Palazzo degli affari" БО, 2-3 қабат.»
                </div>
                <div align="justify" style="text-indent: 10px;">
                 2. Осы Қосымша келісімде қарастырылмаған Шарттың басқа ережелері өзгеріссіз түрінде қалады және Тараптар олар бойынша өздерінің міндеттемелерін растайды.
                </div>                 
                <div align="justify" style="text-indent: 10px;">
               3. Осы Қосымша келісім Тараптармен қол қойылған күннен бастап күшіне енеді және  Шарттың ажырамас бөлігі болып табылады.
                </div>                
               
                <div align="justify" style="text-indent: 10px;">
                4. Осы Қосымша келісім Тараптардың әрқайсысы үшін бір-бір данадан бірдей заңды күші бар  қазақ және орыс тілінде екі түпнұсқалық данада жасалған. 
                </div>
                <br/>                                  
               <div align="justify" style="text-indent: 10px;">
                <strong>ТАРАПТАРДЫҢ ДЕРЕКТЕМЕЛЕРІ МЕН ҚОЛДАРЫ </strong>
                </div>
                <br/>
                 <div align="justify" style="text-indent: 10px;">
                <strong> ЖҰМЫС БЕРУШІ: «Мемлекеттік аннуитеттік компания» өмірді сақтандыру   </strong>
                </div>                
                 <div align="justify" style="text-indent: 10px;">
                <strong>бойынша компаниясы» акционерлік қоғамы  </strong>
                </div>
                <br/>
                <div align="justify" style="text-indent: 10px;">
                Заңды және нақты мекенжайы: Нұр-Сұлтан қ., Мәңгілік Ел көшесі, 20
                </div>
                <div align="justify" style="text-indent: 10px;">
                "Palazzo degli affari" БО, 2-3 қабат.
                </div>
                <div align="justify" style="text-indent: 10px;">
                СНН: 620300259355 Телефон: 916-333
                </div>
                <p align="justify" style="text-indent: 10px;">
                 _____________________ <b>'.$first_let.'. '.$sl_high_regist.'</b>
                </p>
                <div align="justify" style="text-indent: 10px;"><strong>ЖҰМЫСКЕР:</strong>
               
                '.$name.' '.$lastname.' '.$middlename.', '.$BIRTHDATE.' жылы туылған, жеке куәлік № '.$DOCNUM.', ҚР '.$list_doctype[0]['NAME_KAZ'].'
                '.$year.' жылдың '.$day.'.'.$mon.' берілген, ЖСН '.$IIN.', мекен-жайы:  '.$cityname.' қ., '.$fact_street.' көшесі, '.$fact_address_building.' үй, '.$fact_address_flat.' пәтер 
                </div>
            <p align="justify" style="text-indent: 10px;">
                 _____________________         <b>'.$name_first_simb.'.'.$lastname_high_regist.'</b> 
                </p>                                                
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            ';
    
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
        Редактирование документа документ
    </h2>
</div>
<div class="col-lg-12 animated fadeInRight" style="background-color: white;">
    <form id="form_send_html" method="POST" action="just_print" target="_blank">
    <textarea name="content" style="width: 100%;">
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
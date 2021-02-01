<?php
    $db = new DB();

    //построение обьекта Employee
    $empId = $_GET['employee_id'];
    
    //создаем обьект Employee, в параметры передаем ID
    $employee = new Employee($empId);
    
    //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
    $empInfo = $employee -> get_emp_from_DB_trivial();
    
    $sqlEmpInfo = "select triv.*,  doc_place.NAME DOCPLACE_NAME, doc_place.NAME_KAZ DOCPLACE_NAME_KAZ, sex.NAME SEX, sex.NAME_KAZ SEX_KAZ, country.RU_NAME FACT_ADDRESS_COUNTRY_ID, branch.NAME BRANCH, branch.NAME_KZ BRANCHID_KZ, dep.NAME JOB_SP, dep.NAME_KAZ JOB_SP_KAZ, dolzh.D_NAME JOB_POSITION_N, dolzh.D_NAME_KAZ D_NAME_KAZ, (select sup.lastname  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_lastname, (select sup.firstname  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_firstname, (select sup.middlename  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_middlename,  ( select substr(sp.FIRSTNAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) first, ( select substr(sp.MIDDLENAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) surname,  (select DOLJ.D_NAME from  DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec, (select DOLJ.D_NAME_KAZ from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec_kaz, DOLZH.ID_PODPIS, osn.text_kaz, osn.text_rus from DIC_PERSON_OSN osn, sup_person triv, DIC_DOC_PLACE doc_place, DIC_SEX sex, DIC_COUNTRY country, DIC_BRANCH branch, DIC_DEPARTMENT dep, DIC_DOLZH dolzh where triv.DOCPLACE = doc_place.ID and sex.ID = triv.SEX and country.ID = triv.FACT_ADDRESS_COUNTRY_ID and branch.RFBN_ID = triv.BRANCHID and dep.ID = triv.JOB_SP and dolzh.ID = triv.JOB_POSITION and triv.ID = $empId and osn.id = dolzh.OSNOVANIE";
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
    $sql_position = "select D_NAME, D_NAME_KAZ  from DIC_DOLZH where ID = $pos_id";
    $emp_position = $db -> Select($sql_position);
    $posName = $emp_position[0]['D_NAME'];
    $posName = mb_strtolower($posName, 'UTF-8');
    $posname_kz = $emp_position[0]['D_NAME_KAZ'];
    $posname_kz = mb_strtolower($posname_kz, 'UTF-8');
    //position ID
    $telNum = $empInfo[0]['MOB_PHONE'];
    $IIN = $empInfo[0]['IIN'];
    $IIN = $empInfo[0]['IIN'];
    $OKLAD = $empInfo[0]['OKLAD'];
    $FACT_ADDRESS_FLAT = $empInfo[0]['FACT_ADDRESS_FLAT'];
    
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
    
    $full_adress_emp_city = $empInfo[0]['REG_ADDRESS_CITY'];
    $full_adress_emp_street = $empInfo[0]['REG_ADDRESS_STREET'];
    $full_adress_emp_build = $empInfo[0]['REG_ADDRESS_BUILDING'];
    $full_adress_emp_flat = $empInfo[0]['REG_ADDRESS_FLAT'];
    
    $sup_firstname = $empInfo[0]['SUP_FIRSTNAME'];
    $sup_lastname = $empInfo[0]['SUP_LASTNAME'];
    $sup_middlename = $empInfo[0]['SUP_MIDDLENAME'];
    $sf_high_regist =  mb_strtoupper($sup_firstname, 'UTF-8');
    $sl_high_regist =  mb_strtoupper($sup_lastname, 'UTF-8');
    $sm_high_regist =  mb_strtoupper($sup_middlename, 'UTF-8');
    
      $lastname_high_regist = mb_strtoupper($name, 'UTF-8');
    $name_high_regist =  mb_strtoupper($lastname, 'UTF-8');
    $middle_high_regist =  mb_strtoupper($middlename, 'UTF-8');
    $text_kaz = $empInfo[0]['TEXT_KAZ'];
    $text_rus = $empInfo[0]['TEXT_RUS'];
    
    
    $d = $DOCDATE;
    
    foreach ( $d as $key => $val )
    $_monthsList = array(
    "1"=>"Января","2"=>"Февраля","3"=>"Марта",
    "4"=>"Апреля","5"=>"Мая", "6"=>"Июня",
    "7"=>"Июля","8"=>"Августа","9"=>"Сентября",
    "10"=>"Октября","11"=>"Ноября","12"=>"Декабря");
     
    $month = $_monthsList[date("n")];
    
    
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
                <b>Толық жеке материалдық жауапкершілік <br />
                туралы<br /> 
                ШАРТ №  ___  </b><br />
                <br>
                </div>
                <div style="text-align:  left;">
                 <b>Нұр-Сұлтан қ.</b>                               
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
                 «__» ________ 20___ж.                
                <br>
                </div>            
                <br>
                <p align="justify" style="text-indent: 10px;">                
                «Мемлекеттік аннуитеттік компания» өмірді сақтандыру компаниясы» АҚ, бұдан әрі – Қоғам деп аталатын, '.$text_kaz.' тұлғасында бір жағынан және азамат '.$name.' '.$lastname.' '.$middlename.' бұдан әрі – Қызметкер деп аталатын, екінші жағынан, бұдан әрі – бірлесіп Тараптар деп аталып, материалдық жауапкершілік туралы мына төмендегілер жайында осы Шартты (бұдан әрі –  Шарт) жасады:  
                </p>
                <br/>
                
                <div style="text-align:  center;">
                <strong><b>1.	ШАРТТЫҢ МӘНІ</b></strong>
                </div>                               
                <p align="justify" style="text-indent: 10px;">
                1.1. Қоғам береді, ал Қызметкер осы Шарттың талаптарына сай Қоғамның мүлкін және басқа материалдық құндылықтарын (бұдан әрі – құндылықтар) қабылдау-өткізу актінің, матери-алдық құндылықтарды қабылдау сенімхатының немесе өзге құжаттардың негізінде өз есебіне қабылдап алады.<br/>
1.2. Қоғамның құндылықтарының сақталуын қамтамасыз ету мақсатында '.$posname_kz.' қызметін атқаратын Қызметкер өзіне Қоғамның берген құндылықтарының сақталуын қамтамасыз ету үшін толық материалдық жауапкершілік алады.
 
                </p>
                <br/>
                <div style="text-align:  center;">
                <strong><b>2. ТАРАПТАРДЫҢ ҚҰҚЫҚТАРЫ МЕН <br/>МІНДЕТТЕРІ</b></strong>
                </div>
                <p align="justify" style="text-indent: 10px;">
                2.1. Қызметкер:<br/>
1) тиісті қабылдау-өткізу актінің немесе өзге құжаттар негізінде Қоғам беретін құндылықтарды өзінің есебіне қабылдауды;<br/>
2) өзіне сеніп тапсырылған құндылықтардың сақталуына қауіп төнген барлық жағдайлар туралы Қоғамның басшылығына дер кезінде хабарлап отыруды;<br/>
3) өзіне сеніп тапсырылған құндылықтардың жылжуы және қалдықтары туралы белгіленген         тәртіппен тауар-материалдық, есеп-ақша және өзге құжаттардың есебін жүргізуді, жасауды және ұсынуды, сенімхат арқылы алынған материалдық құндылықтарды уақытында тапсыру;<br/>
4) өзінің есебіне Қоғам сақтау үшін немесе басқа да мақсатқа берген құндылықтарды тиісті түрде    сақтауды және Қоғамға келетін қандай да бір шығынды     (зиянды) болдырмау үшін барлық тиісті шараларды қабылдауды;<br/>
5) Қоғам алдындағы өз міндеттемелерін орындау барысында белгілі болған құпия, банктік,          коммерциялық және басқа ақпаратты жария етпеуді;<br/>
6) өзіне сеніп тапсырылған құндылықтарды түгендеуге қатысуды;<br/>
7) Қоғамның алғашқы талап етуі бойынша Қызметкердің кінәсінен келтірілген шығынның (зиянның) орнын толық көлемде өз еркімен толтыруды міндетіне алады.<br/>
2.2. Қоғам:<br/>
1) Қызметкердің есебіне құндылықтарды қабылдау-өткізу, қабылдау сенімхатының немесе өзге құжаттар негізінде беруді;<br/>
2) Қызметкер өзінің атқаратын еңбек міндеттерін толық жүзеге асыруы және өзіне сеніп                   тапсырылған құндылықтардың толық сақталуын    қамтамасыз етуі үшін қажетті жағдайлар жасауды;<br/>
3) Қызметкердің есебіне Қоғам берген құндылықтарға белгіленген тәртіппен түгендеу жүргізуді; <br/>
4) Қызметкердің есебіне Қоғам берген құндылықтардың сақталуына, сондай-ақ оларды басқа адамның атына ауыстыруға (өткізуге) бақылау жасауды міндетіне алады.<br/>
5) Зиян айқындалған жағдайда, ішкі бұйрықпен, құрамы 3 (үш) адамнан кем емес комиссия құрып, Қызметкермен келтірілген зиянның сомасын анықтайды және жағдайға тергеу жүргізеді. Комиссия қорытындылары Актімен рәсімделеді.<br/> 
2.3.Қоғам:<br/>
1) Қызметкердің кінәсінен Қоғамға келтірілген шығынның (зиянның) орнын толтыруды Қызметкерден талап етуге;<br/>
2) Қызметкер Қоғамға шығын (зиян) келтірсе және ол ерікті түрде оның орнын толтырмаса, Қызметкердің келтірген шығынды өтеуі туралы сотқа шағымдануға;<br/>
3) Қоғам Қызметкердің кінәсінен келтірілген шығынды (зиянды) үшінші адамға өтеген жағдайда,  Қызметкер келтірген шығынның орнын толтыру туралы сотқа кері шағым-талап беруге құқылы. <br/>
2.4 Егер Қоғам құндылықтарды сақтауға жағдай жасамаған немесе қажетті ресурстар болмаған жағдайда, Қызметкер құндылықтарды қабылдаудан бас тартуға құқылы.<br/>
2.5 Егер дүлей күш немесе қажетті қорғаныстың аса қажеттілігі нәтижесінде залал пайда болса, онда жұмыс берушіге келтірілген залалға Қызметкердің жауапкершілігі артылмайды.<br/>
2.6 Қазақстан Республикасы Еңбек кодексінің 167-бабына сәйкес  Қызметкер келтірілген залал үшін материалдық жауаптылықта болады.<br/>

                </p>
                <br/>
                <div style="text-align:  center;">
                <strong><b>3.БАСҚА ТАЛАПТАР</b></strong>
                </div>
                <p align="justify" style="text-indent: 10px;">
                3.1. Осы Шарт Қызметкерге сеніп тапсырылған құндылықтармен жұмыс жүргізудің барлық кезеңінде, Қоғамның мүлігін алу кезеңінде қолданылады.<br/>
3.2. Шарт Қоғамның таратылу, қайта ұйымдастырылу (қосылу, бірігу, бөліну, бөлініп шығу, қайта құру) кезеңінде өзінің қолданылу күшін сақтайды. <br/>
3.3. Осы Шарт 2 (екі) данада  (Қоғам үшін Шарттың бір данасы, Қызметкер үшін  бір данасы): мемлекеттік және  орыс тілінде жасалған. <br/>

                </p>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                
              <div align="justify" style="text-indent: 10px;">
                 <strong>
                ЖҰМЫС БЕРУШІ: “Мемлекеттік аннуитеттік компания” өмірді сақтандыру бойынша компаниясы” акционерлік қоғамы
                </strong> 
                </div>              
                <div align="justify" style="text-indent: 10px;">Заңды және нақты мекенжайы: Нұр-Сұлтан қ.,
                </div>
                <div align="justify" style="text-indent: 10px;"> 
                Мәңгілік Ел көшесі, 20
                </div>
                <div align="justify" style="text-indent: 10px;"> 
                "Palazzo degli affari" БО
                </div>
                <div align="justify" style="text-indent: 10px;">СНН: 620300259355 
                </div>
                <div align="justify" style="text-indent: 10px;">Телефон: 916-333
                </div>               
                <br />
                <div align="justify" style="text-indent: 10px;"><strong>'.$sl_high_regist.' '.$sf_high_regist.' '.$sm_high_regist.'</strong> _______________</div>
                <br />
                <br />
                <div align="justify" style="text-indent: 10px;"><strong>ЖҰМЫСКЕР:</strong> '.$name.' '.$lastname.' '.$middlename.', жеке куәлік № '.$DOCNUM.' ҚР '.$DOCPLACE_KAZ.'             '.$DOCDATE.' ж. берілген, ЖСН '.$IIN.', мекен жайы: '.$cityname.' қаласы, '.$fact_street.' көшесі, '.$fact_address_building.'-үй. '.$FACT_ADDRESS_FLAT.' пәтер </div> <br/>
                <div align="justify" style="text-indent: 10px;"><strong>'.$lastname_high_regist.' '.$name_high_regist.' '.$middle_high_regist.'</strong>_______________</div>
            </div>
    <div align="justify" style="float: left; width: 3%; margin-right: 10px; font-size: 10px; border-style:solid; border-color: white; border: 1px" float: right;>
    </div>
                <p align="justify" style="text-indent: 10px;">
                
                </p>
                
                
                

            </div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <div align="justify" style="float: left; width: 3%; margin-right: 10px; font-size: 10px; border-style:solid; border: 1px; border-color: white" float: right;>
    </div>
    <div align="justify" style="float: left; width: 100%; margin-right: 10px; font-size: 14px; float: left; font-family: TimesNewRoman;            	
            	font-style: normal;
            	font-variant: normal;
            	font-weight: 400;">
                <div style="text-align:  center;">
                <b>ДОГОВОР № _____<br/>
                о полной индивидуальной материальной  <br/>
                ответственности </b>
                </div>                
                <br/>
                <div style="text-align:  left;">
                <b>г.Нур-Султан</b>                                                                                                         
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                «__» ________ 20___ г.
                </div>
                <br/>
                <p align="justify" style="text-indent: 10px;">
                АО «Компания по страхованию жизни «Государственная аннуитетная компания» именуемое в дальнейшем – Общество, '.$text_rus.' и гражданка/иин '.$name.' '.$lastname.' '.$middlename.' , именуемый в дальнейшем – Работник, с другой стороны, далее совместно именуемые – Стороны, заключили настоящий Договор  полной материальной ответственности (далее – Договор) о нижеследующем:
                                
                </p>
                <br/>
                
                <div style="text-align:  center;">
                <b>1. ПРЕДМЕТ ДОГОВОРА</b>
                </div
                <br/>
               
                <p align="justify" style="text-indent: 10px;">
                1.1. Общество передает, а Работник принимает в подотчет имущество и другие материальные ценности Общества (далее – ценности)  на основании актов приема-передачи, доверенности на получение материальных ценностей или иных документов согласно условиям настоящего Договора, которые являются неотъемлемым приложением к настоящему Договору.<br/>
1.2. В целях обеспечения сохранности ценностей, принадлежащих Обществу, Работник, занимающий должность '.$posName.' принимает на себя полную материальную ответственность за  обеспечение сохранности ценностей, вверенных  ему Обществом. 
 
                </p>
                <br/>
                <div style="text-align:  center;">
                <b>2. ПРАВА И ОБЯЗАННОСТИ СТОРОН</b>
                </div
                <br/>
                <p align="justify" style="text-indent: 10px;">
                2.1	Работник обязуется:<br/>
1) принимать в подотчет ценности, передаваемые Обществом на основании  актов приема – передачи  или иных  документов;<br/>
2) своевременно сообщать руководству Общества обо всех обстоятельствах, угрожающих обеспечению сохранности вверенных ему ценностей;<br/>
3) вести учет, составлять и представлять в установленном порядке товарно-материальные, расчетно-денежные и другие документы о движе-нии и остатках вверенных ему ценностей, своевременно передавать материальные ценности, полученные по доверенности;<br/>
4) принимать все необходимые меры для под-держания в надлежащем состоянии ценностей, переданных  ему в подотчет Обществом для хранения или других целей и предотвращения любого ущерба (вреда), наносимого Обществу;<br/>
5) не разглашать конфиденциальную,  коммерческую и другую информацию, ставшую ему известной вследствие исполнения своих обязательств перед Обществом;<br/>
6) участвовать в инвентаризации вверенных ему ценностей;<br/>
7) по первому требованию Общества добровольно возместить ущерб (вред), нанесенный по вине Работника, в полном объеме.<br/>
2.2	Общество обязуется:<br/>
1) передавать Работнику в подотчет ценности на основании актов приема-передачи, доверенности на получение  или иных документов;<br/>
2) создать условия, необходимые для полноценного осуществления Работником  его функцио-нальных трудовых обязанностей и обеспечения полной сохранности вверенных ему ценностей;<br/>
3) проводить в установленном порядке инвентаризацию переданных в подотчет Работнику Обществом ценностей;<br/>
4) осуществлять контроль за сохранностью ценностей, переданных в подотчет Обществом Работнику, а также их перемещение (передачу) иным лицам.<br/>
5) при выявлении случая ущерба, внутренним приказом, создать комиссию в составе не менее 3 (трех) человек, которая проводит расследова-ния случая и определяет сумму ущерба нанесенным Обществу Работником. Выводы комиссии оформляются Актом.<br/>
2.3	Общество вправе:<br/>
1) требовать от Работника добровольно возместить Обществу ущерб (вред), нанесенный по вине Работника;<br/>
2) в случае нанесения Работником ущерба (вреда) Обществу и не возмещения его в добровольном порядке, обратиться в суд с иском к Работнику, о возмещении своих затрат;<br/>
3) обратиться в суд с регрессным иском о возмещении своих затрат к Работнику, в случае возмещения Обществом ущерба (вреда) третьим лицам причиненного по вине работника.<br/>
2.4 Работник вправе отказаться от принятия ценностей в случае, если для сохранности ценностей Обществом не созданы условия или отсутствуют необходимые ресурсы.<br/>
2.5 Ответственность Работника за ущерб, причиненный работодателю исключается, если   ущерб возник в результате непреодолимой силы либо крайней необходимости необходимой обороны.<br/>
2.6 За причиненный ущерб Работник несет полную материальную ответственность в соответствии со ст. 123  Трудового кодекса РК.<br/>


                </p>
                <br/>  
                   <br/>             
                <div style="text-align:  center;">
                <b>3. 3. ПРОЧИЕ УСЛОВИЯ</b>
                </div   
                 <br/>              
                <p align="justify" style="text-indent: 10px;">
                3.1. Действие настоящего Договора распространяется на весь период работы с вверенными Работнику ценностями, на период получения имущества Общества.<br/>
3.2. Договор сохраняет свое действие на период ликвидации, реорганизации (слияния, присоединения, разделения, выделения, преобразования) Общества.<br/>
3.3. Договор составлен в 2 (двух) экземплярах (один экземпляр Договора – для Общества, один экземпляр Договора – для работника Общества): на государственном и русском языках. <br/>

                </p>
                <br/>
                <br/>
                <br/> 
                <br/>
                              
                <div style="float:left">
                <strong>РАБОТОДАТЕЛЬ: Акционерное общество «Компания по страхованию жизни «Государственная аннуитетная компания»</strong>
                </div>
                <br />
                Юридический и фактический  адрес:  г. Нур-Султан,<br />
                ул. Мангилик Ел, 20<br />
                БЦ "Palazzo degli affari"<br />
                РНН 620300259355<br />
                Телефон: 916-333<br /><br />
                
                <strong>'.$sl_high_regist.' '.$sf_high_regist.' '.$sm_high_regist.'</strong>_______________
                <br /><br />
                
                
                <strong>РАБОТНИК:</strong> '.$name.' '.$lastname.' '.$middlename.', удостоверение личности № '.$DOCNUM.' выдано '.$DOCPLACE.' РК                   
                '.$DOCDATE.' года, ИИН '.$IIN.', проживающий по адресу: г.'.$cityname.', ул.'.$fact_street.' д.'.$fact_address_building.'. кв. '.$FACT_ADDRESS_FLAT.'
                
                <br /><br />
                <strong>'.$lastname_high_regist.' '.$name_high_regist.' '.$middle_high_regist.'</strong>_______________
            ';
    
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

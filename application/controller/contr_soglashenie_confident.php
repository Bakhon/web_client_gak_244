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
    //print_r($empInfo);
    $deprt =  $empInfo[0]['JOB_SP'];
    $deprt_kaz = $empInfo[0]['JOB_SP_KAZ'];
    $sqlJOB_CONTR_NUM = 'select JOB_CONTR_NUM from JOB_CONTR_NUM where id = 1';
    $listJOB_CONTR_NUM = $db -> Select($sqlJOB_CONTR_NUM);
    $JOB_CONTR_NUM = $empInfo[0]['CONTRACT_JOB_NUM'];
    $CONTRACT_JOB_DATE = $empInfo[0]['CONTRACT_JOB_DATE'];
    
    $name = $empInfo[0]['LASTNAME'];
    $lastname = $empInfo[0]['FIRSTNAME'];
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
    $bossname = $_GET['bossname'];
    $bossname_kaz = $_GET['bossname_kaz'];
    //position ID
    $pos_id = $empInfo[0]['JOB_POSITION'];
    $dep_id = $empInfo[0]['JOB_SP'];
    $filial_id = $empInfo[0]['FILIAL'];
    $branch_id = $empInfo[0]['BRANCHID'];
    $sql_branch = "select NAME, NAME_KZ, ADDRESS, ADDRESS_KZ from DIC_BRANCH where RFBN_ID = $branch_id";
    $emp_branch = $db -> Select($sql_branch);
  // print_r($emp_branch);
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
    $FACT_ADDRESS_FLAT = $empInfo[0]['FACT_ADDRESS_FLAT'];
    $text_kaz = $empInfo[0]['TEXT_KAZ'];
    $text_rus = $empInfo[0]['TEXT_RUS'];
    $sup_firstname = $empInfo[0]['SUP_FIRSTNAME'];
    $sup_lastname = $empInfo[0]['SUP_LASTNAME'];
    $sup_middlename = $empInfo[0]['SUP_MIDDLENAME'];
    $sf_high_regist =  mb_strtoupper($sup_firstname, 'UTF-8');
    $sl_high_regist =  mb_strtoupper($sup_lastname, 'UTF-8');
    $sm_high_regist =  mb_strtoupper($sup_middlename, 'UTF-8');
    
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
    
    $html = '<div align="center">                                             
    <div align="justify" style="float: left; width: 100%; margin-right: 10px; font-size: 14px; float: left; font-family: TimesNewRoman;            	
            	font-style: normal;
            	font-variant: normal;
            	font-weight: 400;">
                <div style="text-align:  right;">
                '.$CONTRACT_JOB_DATE.'<br />
                № '.$JOB_CONTR_NUM.' Еңбек шартына<br /> 
                қосымша <br />
                <br>
                </div>
                <div style="text-align:  center;">
                <strong>«Мемлекеттік аннуитеттік компания» <br/>
                өмірді сақтандыру  компаниясы” АҚ-да </br>
                құпия ақпаратты жарияламау туралы </br>
                КЕЛІСІМ</strong>
                </div>
                <br>
                <div style="text-align:  center;">
                <strong>1.Келісімнің мәні
                </strong>
                 </div>
                 <br/>
                <div align="justify" style="text-indent: 10px;">
                <b>1.1.</b> Осы Келісіммен Тараптар еңбек шарты бойынша міндеттемелерін орындау кезінде оларға қолжетімді болған құпия ақпаратты жарияламау туралы бір-біріне кепілдік береді.
                </div>
                <div align="justify" style="text-indent: 10px;"><b>1.2.</b> Осы Келісімге қол қойған Жұмыскер еңбек міндеттерін орындау кезінде Жұмыс берушінің құпия ақпаратына жатқызылған ақпараттың қолжетімді екендігіне хабардар болғанын, осы Шарт-міндеттемемен көзделген талаптарда құпия ақпаратты сақтаумен байланысты өзіне ерікті түрде міндеттеме қабылдағанын растайды;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>1.3.</b> Жұмыс беруші осы Келісімге қол қоя отырып, Жұмыс берушінің жеке деректерін қорғауға кепілдік береді және Қазақстан Республикасының қолданыстағы заңнамасында көзделген ерекше тәртіпте және шарттарда көрсетілген деректерді өңдеуге (алуға, сақтауға және беруге) міндеттеледі.
                </div>
                <br/>
                 <div style="text-align:  center;">
                <strong>2. Тараптардың міндеттері
                </strong>
                 </div>  
                 <br/>
                 <div align="justify" style="text-indent: 10px;">
                <b>2.1. Жұмыс беруші</b>
                <br/>
              <div align="justify" style="text-indent: 10px;"><b>2.1.1.</b> Тексеру іс-шараларынан бас тартпауға және көренеу жалған анкеталық деректерді хабарламауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.2</b> Бөтен тұлғалар құпия ақпарат алуға талпынған жағдайда бұл туралы дереу Жұмыс берушіге хабарлауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.3</b> Жұмыс берушіні биографиялық деректеріндегі өзгерістер туралы толық және дер кезінде хабардар етуге;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.4</b> Жұмыс берушіге осы Келісімді сақтамау бойынша іс-қимылдардың салдарынан келген залалды өтеуге;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.5</b> Осы Келісімнің талаптарын өз еркімен орындауға, құпия ақпаратқа жататын оған сеніп тапсырылған деректерді қатаң сақтауға, еңбек қатынастары және олар тоқтаған соң 3 жылдың ішінде, оның ішінде:
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.6</b> Жұмыс бойынша оған сеніп тапсырылған немесе мәлім болған құпия ақпаратты құрайтын деректерді жарияламауға;
                
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.7</b> Құпия ақпаратты қорғау тәртібін реттейтін Жұмыс берушінің нормативтік акттері талаптарын орындауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.8</b> Жұмыс берушінің құпия ақпаратын құрайтын деректерді оның рұқсатынсыз үшінші тұлғаларға бермеуге және ашық жарияламауға;
                </div>
               <div align="justify" style="text-indent: 10px;"><b>2.1.9</b> Құпия ақпаратты қорғау тәртібін реттейтін Жұмыс берушінің нормативтік акттері талаптарын орындауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.10</b> Бөтен тұлғалардың немесе Жұмыскерге мәлім ақпаратқа қатысы жоқ Жұмыс берушінің жұмыскерлерінің құпия ақпаратты құрайтын деректерді одан алуға талпынған жағдайда, дереу Жұмыс берушіге хабарлауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.11</b> Жұмыс беруші іскерлік қарым-қатынастары бар ұйымдардың (тұлғалардың) құпия ақпаратын сақтауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.12</b> Жұмыс берушіге коммерциялық құпияны жеткізгіштерін, куәліктерін, режимдік орынжай, қойма, сейфтер (металл шкафтар), мөрлер және Жұмыс берушінің жұмыскерлерінің құпия ақпаратын жариялауға әкелуі мүмкін басқа  факттер туралы, сондай-ақ деректердің ықтимал жылыстау шарттары мен себептері туралы дереу хабарлауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.13</b> Жұмыс берушінің қызметкерлері құпия ақпаратты жариялаған жағдайларда және Жұмыскерге белгілі болған Жұмыс берушінің  ақпарат жылыстау көздері, оның ішінде Жұмыс берушінің Іскерлік әріптестері (Клиенттері) белгілі болған жағдайларда Жұмыс берушіге дереу хабарлауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.1.14</b> Жұмыстан шығарылған жағдайда жұмыс уақытында оның лауазымдық міндеттерін орындаумен байланысты Жұмыскердің иелігінде болған  Жұмыс берушінің  барлық құпия ақпаратты жеткізушілері (дисктер, дискеттер және т.б.) және ақпаратты қорғауға арналған барлық мүлкі Жұмыс берушіге қабылдау-тапсыру актіне сәйкес тапсыру керек.
                </div>                                                                              
                <div align="justify" style="text-indent: 10px;">
                <b>2.1. Жұмыс беруші міндетті:</b>
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.1.</b> Жұмыскердің жеке деректерін тек қана Қазақстан Республикасы заңдарының және өзге нормативтік – құқықтық акттерінің сақталуын қамтамасыз ету мақсатында өңдеуді жүзеге асыруға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.2.</b> Жұмыскерден оның саяси, діни, басқа сенімдері мен жеке өмірі туралы ақпаратты ұсынуын талап етпеуге;
                </div>
               <div align="justify" style="text-indent: 10px;"><b>2.2.3.</b> Жұмыскерден оның қоғамдық бірлестіктердегі, оның ішінде кәсіподақтардағы мүшелігі немесе қызметі туралы ақпаратты талап етпеуге;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.4.</b> Жұмыскердің мүддесін қозғайтын шешімдерді қабылдау кезінде, автоматты өңдеу нәтижесінде немесе электрондық тәсілмен алынған Жұмыскердің жеке деректеріне негізделмеуге;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.5.</b> Қазақстан Республикасы заңнамасымен белгіленген тәртіпте Жұмыскердің жеке деректерін қорғауды жүзеге асыруға және қамтамасыз етуге;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.6.</b> Жұмыскердің жазбаша келісімінсіз үшінші тарапқа Жұмыскердің жеке деректерін хабарламауға;
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.7.</b> Жұмыскердің жеке деректеріне қолжетімділікті арнайы уәкілетті тұлғаларға ғана беруге. Бұл ретте көрсетілген тұлғалар нақты фукцияларды орындау үшін қажетті жеке деректерге ғана құқық алулары керек және құпиялық режимін сақтауы керек. 
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.8.</b> Жұмыскердің жеке деректерін Жұмыскер таныс болуы тиісті Жұмыс берушінің акттеріне сәйкес ұйымның шегінде беруді жүзеге асыру керек.
                </div>
                <div align="justify" style="text-indent: 10px;"><b>2.2.9.</b> Қазақстан Республикасының Еңбек кодексінің 5-тарауымен көзделген өзге міндеттерді орындауға.                
                </div>                                
                <p>
                
                Таныстым ____________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________
                            <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(қолы)                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Аты-жөні, тегі)
    </div>                 
                                                     
    
        <br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/>
           <br/><br/><br/><br/><br/><br/><br/><br/><br/> <br/><br/><br/>                                      
            
                <div align="justify" style="float: left; width: 100%; margin-right: 10px; font-size: 14px; float: left; font-family: TimesNewRoman;            	
            	font-style: normal;
            	font-variant: normal;
            	font-weight: 400;">
                <div style="text-align:  right;">
                Приложение <br />
                к Трудовому договору <br />
                № '.$JOB_CONTR_NUM.' от '.$CONTRACT_JOB_DATE.'<br /><br />
                </div>
                <div style="text-align:  center;">
                <strong>СОГЛАШЕНИЕ<br /></strong>
                </div>
                <div style="text-align:  center;">
                <strong>о  неразглашении  конфиденциальной информации <br/>
                 в АО «Компания по страхованию жизни  <br/>
                «Государственная аннуитетная компания»</strong>
                </div>
                <br/>
                <div style="text-align:  center;">
                <strong>1. Предмет соглашения</strong>
                </div>
            <div align="justify" style="text-indent: 10px;">
                <b>1.1.</b> Настоящим Соглашением Стороны гарантируют друг другу о неразглашении конфиденциальной информации, доступ к которой они получают при исполнении обязанностей по трудовому договору:
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>1.2.</b> Работник подписанием настоящего Соглашения подтверждает, сто поставлен в известность о том, что при выполнении трудовых обязанностей будет допущен к информации, отнесенной к конфиденциальной информации Работодателя, принимает на себя добровольное обязательство, связанное с сохранением конфиденциальной информации, на условиях, предусмотренных настоящим Договором-обязательством;
                </div>
                 <div align="justify" style="text-indent: 10px;">
                <b>1.3.</b> Работодатель подписанием настоящего Соглашения гарантирует защиту персональных данных Работника и обязуется осуществлять обработку (получение, хранение и передачу) указанных данных исключительно в порядке и на условиях, предусмотренных действующим законодательством Республики Казахстан.
                </div>                
                 <div style="text-align:  center;">
                <strong>2. Обязанности Сторон</strong>
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.	Работник обязуется:</b>
                </div>
                 <div align="justify" style="text-indent: 10px;">
                <b>2.1.1.</b> Не уклоняться от проверочных мероприятий и не сообщать заведомо ложные анкетные данные;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.2.</b> В случае попытки посторонних лиц получить информацию конфиденциального характера немедленно сообщать об этом Работодателю;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.3.</b> Полно и своевременно информировать Работодателя об изменениях в биографических данных;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.4.</b> Возместить Работодателю убытки, понесенные Обществом, вследствие действий по несоблюдению данного соглашения;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.5.</b> Добросовестно выполнять требования настоящего Соглашения, строго сохранять доверенные ему сведения, относящиеся к конфиденциальной информации, в период трудовых отношений и в течение 3 лет после их прекращения, в том числе:
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.6.</b> Не разглашать сведения, составляющие конфиденциальную информацию, которые будут Работнику доверены или станут известны по работе;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.7.</b> Выполнять требования нормативных актов Работодателя, регламентирующих порядок защиты конфиденциальной информации;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.8.</b> Не передавать третьим лицам и не раскрывать публично сведения, составляющие конфиденциальную информацию Работодателя, без его согласия;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.9.</b> Не использовать знание конфиденциальной информации для занятия любой деятельностью, которая в качестве конкурентного действия (либо ущерба ее интересам) может нанести ущерб Работодателю;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.10.</b> В случае попытки посторонних лиц либо работников Работодателя, не имеющих отношения к известной Работнику информации получить от него сведения, составляющие конфиденциальную информацию немедленно сообщить Работодателю;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.11.</b> Сохранять конфиденциальную информацию тех организаций (лиц), с которыми Работодатель имеет деловые отношения;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.12.</b> Незамедлительно сообщать Работодателю об утрате (недостаче) носителей коммерческой тайны, удостоверений, пропусков, ключей от режимных помещений, хранилищ, сейфов (металлических шкафов), печатей и о других фактах, которые могут привести к разглашению конфиденциальной информации Работодателя, а также о причинах и условиях возможной утечки сведений;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.13.</b> Незамедлительно сообщать Работодателю о ставших известными Работнику случаях разглашения конфиденциальной информации сотрудниками Работодателя и о других, ставших известными Работнику источниках утечки информации Работодателя, в том числе Деловых партнеров (Клиентов) Работодателя;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.1.14.</b> В случае увольнения все носители конфиденциальной информации Работодателя (диски, дискеты и пр.), и имущество, предназначенное для защиты информации, которые находились в распоряжении Работника в связи с выполнением им должностных обязанностей во время работы, передать Работодателю, согласно акту приема-передачи.
                </div>                
                 <div align="justify" style="text-indent: 10px;">
                <b>2.2. Работодатель обязуется:</b>
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.1.</b> Осуществлять обработку персональных данных Работника исключительно в целях обеспечения соблюдения законов и иных нормативных правовых актов Республики Казахстан;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.2.</b> Не требовать у Работника предоставления информации о его политических, религиозных и иных убеждениях и частной жизни;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.3.</b> Не требовать у Работника информацию о его членстве или деятельности в общественных объединениях, в том числе в профессиональных союзах;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.4.</b> При принятии решений, затрагивающих интересы Работника, не основываться на персональных данных Работника, полученных в результате их автоматизированной обработки или электронным способом;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.5.</b> Осуществлять и обеспечивать защиту персональных данных Работника в порядке, установленном законодательством Республики Казахстан;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.6.</b> Не сообщать персональные данные Работника третьей стороне без письменного согласия Работника;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.7.</b> Разрешать доступ к персональным данным Работника только специально уполномоченным лицам. При этом указанные лица должны иметь право получать только те персональные данные Работника, которые необходимы для выполнения конкретных функций, и соблюдать режим конфиденциальности;
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.8.</b> Осуществлять передачу персональных данных Работника в пределах организации в соответствии с актом Работодателя, с которым должен быть ознакомлен Работник.
                </div>
                <div align="justify" style="text-indent: 10px;">
                <b>2.2.9.</b> Нести иные обязанности, предусмотренные Главой 5 Трудового Кодекса Республики Казахстан.
                </div>
                <br/>                
                 Ознакомлен ____________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________
                            <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(подпись)                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ф.И.О.)
            
            
            
            
            
            
            
            
            
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
        $hundred=array('','жүз','екі жүз','үш жүз','төрт жүз','бес жүз','алты жүз', 'жеті жүз','сегіз жүз','тоғыз жүз');
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
    <textarea name="content_job_contract" style="width: 100%;">
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

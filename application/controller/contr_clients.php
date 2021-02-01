<?php
    //error_reporting(E_ALL);
class CLIENTS
{
    private $db;
    private $dan;
    public $result = array();
    public $page;
    public $breadwin;
    public $title = 'Поиск клиентов';
    private $role_type;
    private $role_branch;
    private $role_emp;
    
    public function __construct()
    {        
        global $active_user_dan;
        $this->role_type = $active_user_dan['role_type'];
        $this->role_branch = $active_user_dan['brid'];
        $this->role_emp = $active_user_dan['emp'];
            
        $this->db = new DB3();
        
        $method = $_SERVER['REQUEST_METHOD'];                    
        $this->$method();    
    }
    
    private function GET()
    {        
        if(count($_GET) <= 0){            
            $this->index();
        }else{
            foreach($_GET as $k=>$v){                    
                if(method_exists($this, $k)){
                    $this->dan = $_GET;
                    unset($this->dan[$k]);
                    $this->$k($v);                        
                }
            } 
        }       
        $this->ajax();
        
    }
    
    private function POST()
    {
        if(count($_POST) > 0){                
            foreach($_POST as $k=>$v){                    
                if(method_exists($this, $k)){
                    $this->dan = $_POST;
                    unset($this->dan[$k]);
                    $this->$k($v);                    
                }
            }
            unset($_POST);                
        }
        $this->ajax();
        
        $this->GET();
    }
    
    private function ajax()
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                echo json_encode($this->result);
                exit;
            }
        }
    }
    
    private function index()
    {        
        $this->page = 'index';
        
        $this->breadwin[] = 'Клиенты';
        $this->breadwin[] = 'Поиск клиентов';
        $this->result = array();
    }
    
    private function edit($id)
    {
        $this->page = 'edit';
        if($id == 0){
            return array();
        }
        
        $q = $this->db->Select("select * from clients where sicid = $id");
        $this->result['dan'] = $q[0];
        
    }
    
    private function view($id)
    {
        $this->page = 'view';
        if($id == 0){
            return array();
        }
        
        
        $sql = "select c.*, 
        case 
            when trim(address_rus) is null then 'ул.'||reg_address_street||' д.'||REG_ADDRESS_BUILDING||' кв. '||reg_address_flat     
            else address_rus
        end addres_rus,        
        case doctype 
            when '1' then 'ПАСПОРТ РК'
            when '2' then 'УДОСТОВЕРЕНИЕ РК'
            when '3' then 'ВИД НА ЖИТЕЛЬСТВО РК'
            when '4' then 'СВИДЕТЕЛЬСТВО О РОЖДЕНИИ РК'
            when '5' then 'ЛИЦО БЕЗ ГРАЖДАНСТВА РК'
            when '6' then 'ПАСПОРТ РФ'
            else 'ИНОЙ ДОКУМЕНТ'
        end doctype_text,
        DOCser||' № '||DOCNum||' от '||DOCdate doc_ser,
        DOCPLACE,
        country_name(nvl(c.REG_ADDRESS_COUNTRY_ID, 1)) country_name, 
        FAMIL_NAME(c.FAMIL) FAMIL_NAME,
        reg_name(c.REG_ADDRESS_REGION_ID) r_name, 
        obl_name(c.REG_ADDRESS_DISTRICTS_ID) o_name 
        from clients c where sicid = $id";
        
        /*
        select 
      gbdfl.ADDRES_insur (p.REG_ADDRESS_DISTRICTS_ID,p.REG_ADDRESS_REGION_ID,p.REG_ADDRESS_CITY) ADDR, 
      EMP_NAME(P.EMPID) EMP_NAME, 
      BRANCH_name(P.BRANCHID) BRANCH_name, 
      FOND_NAME(P.FOND) FOND_NAME,  
      reg_name(p.REG_ADDRESS_REGION_ID) r_name, 
      obl_name(p.REG_ADDRESS_DISTRICTS_ID) o_name, 
      P.*  
    from 
      clients p  
    where
        */
            
        $q = $this->db->Select($sql);
        $this->result['dan'] = $q[0];
        
        $ds = $this->db->Select("select * from CLIENTS_PODFT where sicid = $id");
        $this->result['podft'] = $ds;
        
        
        $sqlDog = "select 
            state_name(d.state) state_name, 
            progr_name(d.paym_code) progr_name,  
            progr_name(substr(d.paym_code,1,4)) strah_name, 
            client_name(d.id_paym) poluch_name,  
            client_name(d.id_annuit) annuit, 
            'Макет договора' ISFile, 
            client_name(d.sicid_agent) fio_agent, 
            d.*, 
            cl.*  
        from 
            contracts_maket d, 
            clients cl   
        where 
            d.ID_ANNUIT = cl.sicid     
            and d.ID_ANNUIT = $id 
        union all   
        select 
            state_name(d.state) state_name, 
            progr_name(d.paym_code) progr_name,  
            progr_name(substr(d.paym_code,1,4)) strah_name, 
            client_name(d.id_paym) poluch_name,  
            client_name(d.id_annuit) annuit,
            'Договор' ISFile, 
            client_name(d.sicid_agent) fio_agent, 
            d.*, 
            cl.*  
        from 
            contracts d, 
            clients cl  
        where 
            d.ID_ANNUIT = cl.sicid 
            and d.ID_ANNUIT = $id";
            
        $this->result['dog'] = $this->db->Select($sqlDog);        
    }
    
    private function search()
    {
        $this->page = 'index';
        
        $this->breadwin[] = 'Клиенты';
        $this->breadwin[] = '<a href="clients">Поиск клиентов</a>';
        
        $lastname = $_GET['lastname'];
        $firstname = $_GET['firstname'];
        $middlename = $_GET['middlename'];
        $iin = $_GET['iin'];
        $ps = $iin.$lastname.$firstname.$middlename;
        if(trim($ps) == ''){
            $this->result['error'] = ALERTS::ErrorMin('Значения для поиска не могут быть пустыми!');
            return false;
        }
        
        if(trim($iin.$lastname) == ''){
            $this->result['error'] = ALERTS::ErrorMin('Фамилия или ИИН это обязательные значения для поиска!');
            return false;
        }
        
        $sql = "SELECT gbdfl.Addres_insur
           (p.reg_address_districts_id, p.reg_address_region_id, p.reg_address_city) ADDR,
           Emp_name(P.empid)                    EMP_NAME,
           Branch_name(P.branchid)              BRANCH_name,
           Fond_name(P.fond)                    FOND_NAME,
           Reg_name(p.reg_address_region_id)    r_name,
           Obl_name(p.reg_address_districts_id) o_name,
           P.*
        FROM clients p where ";
        
        if(trim($iin) !== ''){
            $sql .= " p.iin like '$iin%'";
        }
        
        if(trim($lastname) !== ''){
            if(trim($iin) !== ''){
                $sql .= ' and ';
            }
            $l = mb_strtoupper($lastname.'%', "UTF-8");
            $f = mb_strtoupper($firstname.'%', "UTF-8");
            $m = mb_strtoupper($middlename.'%', "UTF-8");
            
            $sql .= " p.lastname LIKE '$l' AND p.firstname LIKE '$f' AND p.middlename LIKE '$m'";
        }
                
        $q = $this->db->Select($sql);
        $this->result['dan'] = $q;                        
    }
    
    private function sicid($id)
    {
        $sql = "select c.*, 
        case 
            when trim(address_rus) is null then 'ул.'||reg_address_street||' д.'||REG_ADDRESS_BUILDING||' кв. '||reg_address_flat     
            else address_rus
        end addres_rus,        
        case doctype 
            when '1' then 'ПАСПОРТ РК'
            when '2' then 'УДОСТОВЕРЕНИЕ РК'
            when '3' then 'ВИД НА ЖИТЕЛЬСТВО РК'
            when '4' then 'СВИДЕТЕЛЬСТВО О РОЖДЕНИИ РК'
            when '5' then 'ЛИЦО БЕЗ ГРАЖДАНСТВА РК'
            else ''
        end||' '||DOCser||' № '||DOCNum||' от '||DOCdate||' '||DOCPLACE documents_dan from clients c where sicid = $id";
            
        $row = $this->db->Select($sql);
        
        
        $ds = $this->db->Select("select * from CLIENTS_PODFT where sicid = $id");
        $row['podft'] = $ds[0];
        
        
        $sqlDog = "select 
            state_name(d.state) state_name, 
            progr_name(d.paym_code) progr_name,  
            progr_name(substr(d.paym_code,1,4)) strah_name, 
            client_name(d.id_paym) poluch_name,  
            client_name(d.id_annuit) annuit, 
            'Макет договора' ISFile, 
            client_name(d.sicid_agent) fio_agent, 
            d.*, 
            cl.*  
        from 
            contracts_maket d, 
            clients cl   
        where 
            d.ID_ANNUIT = cl.sicid     
            and d.ID_ANNUIT = $id 
        union all   
        select 
            state_name(d.state) state_name, 
            progr_name(d.paym_code) progr_name,  
            progr_name(substr(d.paym_code,1,4)) strah_name, 
            client_name(d.id_paym) poluch_name,  
            client_name(d.id_annuit) annuit,
            'Договор' ISFile, 
            client_name(d.sicid_agent) fio_agent, 
            d.*, 
            cl.*  
        from 
            contracts d, 
            clients cl  
        where 
            d.ID_ANNUIT = cl.sicid 
            and d.ID_ANNUIT = $id";
            
        $dbDog = $this->db->Select($sqlDog);
        require_once 'application/views/clients/dannye.php';
    }
    
    private function iinForAjax($id)
    {        
        $q = $this->db->Select("select * from gbdfl.gbl_person_new where IIN = $id");
        echo json_encode($q[0]);
        exit;
    }
    
    private function areaForAjax($id)
    {        
        $listDbArea = $this->db->Select("select id, code kod, ru_name name from dic_districts");
        echo '<table class="table dataTables-example" id="areaTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Код</th>
                        <th>Область</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($listDbArea as $t => $y){
                    echo '<tr class="gradeX" data="'.$y['NAME'].'">
                            <td>'.$y['ID'].'</td>
                            <td>'.$y['KOD'].'</td>
                            <td>'.$y['NAME'].'</td>
                    </tr>';
        }
        echo '</tbody>
            </table>';
        exit;
    }
    
    private function cityForAjax()
    {        
        $listDbCity = $this->db->Select("select id, code kod, ru_name name from dic_region order by name");
        echo '<table class="table dataTables-example" id="cityTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Код</th>
                        <th>Район</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($listDbCity as $t => $y){
                    echo '<tr class="gradeX" data="'.$y['NAME'].'">
                            <td>'.$y['ID'].'</td>
                            <td>'.$y['KOD'].'</td>
                            <td>'.$y['NAME'].'</td>
                    </tr>';
        }
        echo '</tbody>
            </table>';
        exit;
    }
    
    private function iinForCheck($id)
    {        
        $sqlForIINList = $this->db->Select("select IIN from clients where IIN = '$id'");
        if(isset($sqlForIINList[0]['IIN'])){
            echo 'ИИН уже есть в базе. Проверьте правильность ввода';
        }else{
            echo '7';
        }
        exit;
    }
    
    private function countryForAjax()
    {
        $sqlCountry = "select id, code kod, name from DIC_COUNTRIES_ESBD";
        $listDbCountry = $this->db->Select($sqlCountry);
        echo '<table class="table dataTables-example" id="countryTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>SURNAME</th>
                        <th>SURNAME</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($listDbCountry as $t => $y){
                    echo '<tr class="gradeX" data="'.$y['NAME'].'">
                            <td>'.$y['ID'].'</td>
                            <td>'.$y['KOD'].'</td>
                            <td>'.$y['NAME'].'</td>
                    </tr>';
        }
        echo '</tbody>
            </table>';
        exit;
    }
    
    private function surnameForAjax()
    {
        $surname = $_POST['surnameForAjax'];
        $sqlLastname = '';
        $sqlMiddlename = '';
        $sqlFin = ' and rownum < 100';
        //echo $surname;
        
        $sqlSurname = "select * from gbdfl.gbl_person_new where Upper(SURNAME) LIKE upper ('%$surname%')";
        if($_POST['firstname'] !== ''){
            $firstname = $_POST['firstname'];
            $sqlFirstname = " and firstname like upper ('%$firstname%')";            
        }
        if($_POST['middlename'] !== ''){
            $middlename = $_POST['middlename'];
            $sqlMiddlename = " and SECONDNAME like upper ('%$middlename%')";
            
        }
                
        $personDB = $this->db->Select($sqlSurname.$sqlFirstname.$sqlMiddlename.$sqlFin);        
        
        echo '<div class="form-horizontal scrolltab" style="height: 600px;" id="clientsTable">
                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                    <thead>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Дата рождения</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($personDB as $k=>$v){
                    echo '<tr class="gradeX" data="'.$v['IIN'].'">
                            <td>'.$v['SURNAME'].'</td>
                            <td>'.$v['FIRSTNAME'].'</td>
                            <td>'.$v['SECONDNAME'].'</td>
                            <td>'.$v['BIRTH_DATE'].'</td>
                        </tr>';
                    }
        echo '</tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addInfoAboutClientFromGBDFL();">Добавить выбранного</button>
            </div>
            ';
            
        echo '
        <script>
            function addInfoAboutClientFromGBDFL(){
                var iinForAjax = $("#idIIN").val();
                $.post("clients_edit", {"iinForAjax": iinForAjax}, function(d){
                            console.log(JSON.parse(d));
                            var dsp = JSON.parse(d);
                            $("#surnameID").val(dsp.SURNAME);
                            $("#firstnameID").val(dsp.FIRSTNAME);
                            $("#middlenameID").val(dsp.SECONDNAME);
                            $("#BIRTHDATEid").val(dsp.BIRTH_DATE);
                            $("#idSic").val(dsp.SIC);
                            $("#DEATH_DATEid").val(dsp.DEATH_DATE);
                            $("#DEATH_SVID_BEGIN_DATEid").val(dsp.DEATH_SVID_BEGIN_DATE);
                            $("#DEATH_SVID_ISSUE_ORG_NAMEid").val(dsp.DEATH_SVID_ISSUE_ORG_NAME);
                            $("#DEATH_SVID_NUMBERid").val(dsp.DEATH_SVID_NUMBER);
                        })
                    }
        </script>
        <script>
        $("#clientsTable tr").click(function(){
                var tr = $(this);
                $(".gradeX").attr("class", "gradeX");
                tr.attr("class", "gradeX active");
                var s = tr.attr("data");
                console.log($(this).attr("data"));
                console.log(s);
                $("#idIIN").val(s);
                });
        </script>
        ';
        exit;
    }
    
    private function surname()
    {
        $ivid = 0;
        $seqNextVal = $_GET['sicid'];
        if($_GET['sicid'] == 0){
           $ivid = 1;
           $seqOracle = $this->db->Select("select seq_clients.nextval from dual");
           $seqNextVal = $seqOracle[0]['NEXTVAL'];           
        }
        
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $BIRTHDATE = $_POST['BIRTHDATE'];
        $SIK = $_POST['SIK'];
        $RNN = $_POST['RNN'];
        $IIN = $_POST['IIN'];
        $docdate = $_POST['docdate'];
        $docissued = $_POST['docissued'];
        $area = $_POST['area'];
        $region = $_POST['region'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $blockNumber = $_POST['blockNumber'];
        $country = $_POST['country'];
        $adresskaz = $_POST['adresskaz'];
        $adressrus = $_POST['adressrus'];
        $doctype = $_POST['doctype'];
        $docseries = $_POST['docseries'];
        $docnum = $_POST['docnum'];
        $telnum = $_POST['telnum'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];
        $profess = $_POST['profess'];
        $marital_status = $_POST['marital_status'];
        $pension_fund = $_POST['pension_fund'];
        $death_date = $_POST['death_date'];
        $death_date_check = $_POST['death_date_check'];
        $death_check_number = $_POST['death_check_number'];
        $death_issued = $_POST['death_issued'];
        
        
        $sqlNewClient = "
        begin card.new_client(
                $ivid,
                $seqNextVal,
                '$surname',
                '$firstname',
                '$middlename',
                '$BIRTHDATE',
                '11.11.1111',
                '1',
                '$SIK',
                '$IIN',
                '$RNN',
                '1',
                '$doctype',
                '$docdate',
                '$docseries',
                '$docnum',
                '$docissued',
                '1',
                '$death_check_number',
                '$death_date_check',
                '$death_issued',
                '1',
                '$region',
                '$city',
                '$street',
                '$blockNumber',
                '$adresskaz',
                '$adressrus',
                '$telnum',
                '$fax',
                '$email',
                '$profess',
                '$marital_status',
                '1',
                '1',
                '1'
                           );
                end;";
        
        $listDbNewClient = $this->db->Execute($sqlNewClient);
                
        if(isset($_GET['create_type'])){
            Header("Location: clients?sicid=$seqNextVal");
        }        
    }
}
            
    array_push($js_loader, 
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js', 
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js', 
        'styles/js/plugins/select2/select2.full.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js'
        );
        
    array_push($css_loader, 
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css', 
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css'
    );
        
    $client = new CLIENTS();        
    $dan = $client->result;
    
    $page_title = 'Клиенты';
    $panel_title = $client->title;
    
    $breadwin[] = 'Справочник';
    $breadwin[] = '<a href="clients">Клиенты</a>';    
    //$breadwin[] = '<a href="clients?edit=0">Регистрация клиентов</a>';
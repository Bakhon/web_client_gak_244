<?php
    class CLIENTS
    {
        private $db;
        private $array;
        public $dan;
        
        public function __construct()
        {
            global $active_user_dan;
            $this->role_type = $active_user_dan['role_type'];
            $this->role_branch = $active_user_dan['brid'];
            $this->role_emp = $active_user_dan['emp'];
            
            require_once 'application/units/database3.php';
            $this->db = new DB3();            
            $method = $_SERVER['REQUEST_METHOD'];            
            $this->$method();        
        }
        
        private function GET()
        {
            if(count($_GET) <= 0){
                $this->dan = array();                
            }else{            
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }else{
                        $this->array[$k] = $v;
                    }
                }
            }                        
        }
        
        private function POST()
        {
            if(count($_POST) > 0){                
                foreach($_POST as $k=>$v){                                
                    if(method_exists($this, $k)){                    
                        $this->array = $_POST;
                        $this->$k($v); 
                    }
                }
            }            
            $this->GET();             
        }
        
    } 
    
    $client = new CLIENTS();
    $dan = $client->dan;   
    
    
    $page_title = 'Поиск';
    $panel_title = 'Поиск клиентов';
    
    $breadwin[] = 'Поиск';
    $breadwin[] = 'Поиск клиентов';
    
    array_push($js_loader, 
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'styles/js/inspinia.js',
        'styles/js/plugins/pace/pace.min.js',

        'styles/js/plugins/footable/footable.all.min.js'
    );
        
    array_push($css_loader, 
        'styles/css/plugins/footable/footable.core.css',

        'styles/css/animate.css',
        'styles/css/style.css'        
    ); 
    
    $othersJs = "<script>
                $(document).ready(function() {
                        $('.footable').footable();
                        });
                </script>";
        
    if(isset($_POST['sicid'])){
        $db = new DB3();
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
        end||' '||DOCser||' № '||DOCNum||' от '||DOCdate||' '||DOCPLACE documents_dan from clients c where sicid = ".$_POST['sicid'];    
        $row = $db->Select($sql);
        //dogovora
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
            and d.ID_ANNUIT = ".$_POST['sicid']."
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
            and d.ID_ANNUIT = ".$_POST['sicid'];
        $dbDog = array();    
        $db = new DB();
        $dbDog = $db->Select($sqlDog);
 ?>

<div class="ibox">
                  <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                        <div class="row">
                                            <!--innner table start-->
                                                            <div class="col-lg-12">
                    <div class="row">
                    <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                        <h5>Основные данные клиента</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                        </div>
                        </div>
                    <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-2"><strong>Фамилия</strong><br><?php echo $row[0]['LASTNAME']; ?></div>
                        <div class="col-lg-2"><strong>Имя</strong><br>
                            <div id="idName"><?php echo $row[0]['FIRSTNAME']; ?></div>
                        </div>
                        <div class="col-lg-2"><strong>Отчество</strong><br><?php echo $row[0]['MIDDLENAME']; ?></div>
                        <div class="col-lg-2"><strong>Дата рождения</strong><br><?php echo $row[0]['BIRTHDATE']; ?></div>
                        <div class="col-lg-2"><strong>Пол</strong><br><?php if($row[0]['SEX'] == 1) {echo 'Муж.';} else {echo 'Жен.';};?></div>
                        <div class="col-lg-2"><strong>Резидент</strong><br>
                            <div class="i-checks">
                                <label><input type="checkbox" <?php if($row[0]['RESIDENT'] == 1){echo 'checked=""';} else { echo '';}; ?> disabled=""><i></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-3"><strong>Документ</strong><br><?php echo $row[0]['DOCUMENTS_DAN']; ?></div>
                        <div class="col-lg-3"><strong>Адрес(Рус)</strong><br><?php echo $row[0]['ADDRES_RUS']; ?></div>
                        <div class="col-lg-3"><strong>Адрес(Каз)</strong><br><?php echo $row[0]['ADDRES_KAZ']; ?></div>                        
                        <div class="col-lg-3"><strong>Адрес при конвертации</strong><br><?php echo $row[0]['ADDR_CONV']; ?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-4"><strong>СИК</strong><br><?php echo $row[0]['SIC']; ?></div>
                        <div class="col-lg-4"><strong>ИИН</strong><br><?php echo $row[0]['IIN']; ?></div>
                        <div class="col-lg-4"><strong>РНН</strong><br><?php echo $row[0]['RNN']; ?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-4"><strong>Телефон</strong><br><?php echo $row[0]['PHONE']; ?></div>
                        <div class="col-lg-4"><strong>EMAIL</strong><br><?php echo $row[0]['EMEIL']; ?></div>
                        <div class="col-lg-4"><strong>Факс</strong><br><?php echo $row[0]['FAX']; ?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-4"><strong>Профессия</strong><br><?php echo $row[0]['PROFFESION']; ?></div>
                        <div class="col-lg-4"><strong>Семейное положение</strong><br><?php echo $row[0]['BIRTHDATE']; ?></div>
                        <div class="col-lg-4"><strong>Фонд</strong><br><?php echo $row[0]['FOND']; ?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-4"><strong>Инспектор</strong><br><?php echo $row[0]['BIRTHDATE']; ?></div>
                        <div class="col-lg-4"><strong>Отделение</strong><br><?php echo $row[0]['BIRTHDATE']; ?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-lg-2"><strong>Дата смерти</strong><br><?php echo $row[0]['DEATH_DATE']; ?></div>
                        <div class="col-lg-3"><strong>Дата выдачи свидетельсвта о смерти</strong><br><?php echo $row[0]['DEATH_SVID_BEGIN_DATE']; ?></div>
                        <div class="col-lg-3"><strong>Номер свидетельсвта о смерти</strong><br><?php echo $row[0]['DEATH_SVID_NUMBER']; ?></div>
                        <div class="col-lg-4"><strong>Кем выдан</strong><br><?php echo $row[0]['DEATH_SVID_ISSUE_ORG_NAME']; ?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <a class="btn btn-primary pull-right" href="clients_edit?sicid=<?php echo $row[0]['SICID'] ?>"><i class="fa fa-search"></i>Редактировать</a>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
               

            <div class="hr-line-dashed"></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                        <h5>Договора</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                        </div>
                        </div>
                        <div class="ibox-content">

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>

                                    <th data-toggle="true">Номер договора</th>
                                    <th>Дата договора</th>
                                    <th>Аннуитет</th>
                                    <th>Программа страхования</th>
                                    <th>Статус</th>
                                    <th data-hide="all">Получатель</th>
                                    <th data-hide="all">Вид страхования</th>
                                    <th data-hide="all">Дата назначения</th>
                                    <th data-hide="all">Дата окончания</th>
                                    <th data-hide="all">&nbsp;</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                
                                <?php
                                if(count($dbDog) > 0){ 
                                foreach($dbDog as $k => $v){
                                
                                echo '<tr class="trka">
                                        <td>'.$v['CONTRACT_NUM'].'</td>
                                        <td>'.$v['CONTRACT_DATE'].'</td>
                                        <td>'.$v['ANNUIT'].'</td>
                                        <td>'.$v['PROGR_NAME'].'</td>
                                        <td>'.$v['STATE_NAME'].'</td>
                                        <td>'.$v['POLUCH_NAME'].'</td>
                                        <td>'.$v['STRAH_NAME'].'</td>
                                        <td>'.$v['DATE_BEGIN'].'</td>
                                        <td>'.$v['DATE_END'].'</td>
                                        <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'">подробнее...</a></td>
                                    </tr>';
                                }
                                }
                                ?>
                                
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                                
                            </table>
                            

                        </div>
                    </div>
                </div>
                <script>
                $(document).ready(function() {
                        $('.footable').footable();
                        });
                </script>
                
            </div>
         </div>
    </div>
</div>
</div>
</div>


            
<?php               
        //echo "<pre>";
        //print_r($dbDog);
        //echo '</pre>';    
        exit;
    }
    
    //$table = new ClientTable();
    
    //Задаем первоначальные параметры SQL тескта
    $sql = "
    SELECT gbdfl.Addres_insur
           (p.reg_address_districts_id, p.reg_address_region_id, p.reg_address_city)
                                                ADDR,
           Emp_name(P.empid)                    EMP_NAME,
           Branch_name(P.branchid)              BRANCH_name,
           Fond_name(P.fond)                    FOND_NAME,
           Reg_name(p.reg_address_region_id)    r_name,
           Obl_name(p.reg_address_districts_id) o_name,
           P.*
    FROM   clients p ";
    
    $tableHead = '<div class="col-lg-8">
                    <div class="ibox-content">
                        <div class="form-horizontal scrolltab">
                                <table class="table table-bordered dataTables-example" id="client_dan">
                                    <thead>
                                    <tr>
                                        <th>Фамилия</th>
                                        <th>Имя</th>
                                        <th>Отчество</th>
                                        <th>Дата рождения</th>
                                    </tr>
                                </thead>
                                <tbody>';
    $tableFoot = ' </table></div></div></div>';
                                
    $nothingFound = '<div class="content clearfix">
                                            <div aria-hidden="false" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0" class="step-content body current">
                                             <div class="text-center m-t-md">
                                                    <h2>Такого значения нет в базе</h2>
                                                    <p>
                                                        Введите данные в поля поиска
                                                    </p>
                                                    </div>
                                            </div>
                                          </div>';
    
    $inputText = '<div class="content clearfix">
                        <div aria-hidden="false" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0" class="step-content body current">
                         <div class="text-center m-t-md">
                                <h2>Введите данные</h2>
                                <p>
                                    Введите данные в поля поиска
                                </p>
                                </div>
                            </div>
                          </div>';
    
    if(count($GETS) > 0){
    
    // fio forms
    if(isset($GETS['clientLastname'])){
        if(trim($GETS['clientLastname']) == ''){
            $msg = ALERTS::ErrorMin('Фамилия не может быть пустой');
            function showTable(){
                global $inputText;
                echo $inputText;
            }
        } else {
            $l = mb_strtoupper($GETS['clientLastname'].'%', "UTF-8");
            $f = mb_strtoupper($GETS['clientFirstname'].'%', "UTF-8");
            $m = mb_strtoupper($GETS['clientMiddlename'].'%', "UTF-8"); 
            $b = true;
            
            $ss1 = 
            "WHERE  p.lastname LIKE '$l'
            AND p.firstname LIKE '$f'
            AND p.middlename LIKE '$m'   "; 
            
                                       
            $db = new DB3();
            $dbClients = $db->Select($sql.$ss1);
        
        function showTable(){
            global $dbClients;
            global $nothingFound;      
            global $tableHead;
            global $tableFoot;
                                    
            if(empty($dbClients)){
                echo $nothingFound;
            }else{
            
                    //table start
                    echo $tableHead;
                    foreach($dbClients as $k=>$v){
                    echo '<tr class="gradeX" data="'.$v['SICID'].'">
                            <td>'.$v['LASTNAME'].'</td>
                            <td>'.$v['FIRSTNAME'].'</td>
                            <td>'.$v['MIDDLENAME'].'</td>
                            <td>'.$v['BIRTHDATE'].'</td>
                        </tr>';}
                    echo $tableFoot;
                    //table finish
                    }
                            }
                        }
                    }
        
    //IIN forms    
    if(isset($GETS['iin'])){
        if(trim($GETS['iin']) == ''){
            $msg = ALERTS::ErrorMin('ИИН не может быть пустым');
            function showTable(){
                global $inputText;
                echo $inputText;}
        }
        else
        {
        $b = false;
        $iinInput = $GETS['iin'].'%';
        $ss1 = "WHERE  p.iin like '$iinInput' ";
        
        $db = new DB3();
        $dbIIN = $db->Select($sql.$ss1);
        
        function showTable(){
                global $dbIIN;
                global $tableHead;
                global $nothingFound;
                global $tableFoot;
                                if(empty($dbIIN)){
                                    echo $nothingFound;
                                }else{
                                
                                //table start
                                echo $tableHead;
                                 foreach($dbIIN as $x=>$z){
                                 echo '<tr class="gradeX" data="'.$z['SICID'].'">
                                        <td>'.$z['LASTNAME'].'</td>
                                        <td>'.$z['FIRSTNAME'].'</td>
                                        <td>'.$z['MIDDLENAME'].'</td>
                                        <td>'.$z['BIRTHDATE'].'</td>
                                    </tr>';}
                                echo $tableFoot;
                                //table finish
                                    }}}}
            }else{
                    function showTable(){
                        global $inputText;
                        echo $inputText;
                                        }
                 }
                 ?>

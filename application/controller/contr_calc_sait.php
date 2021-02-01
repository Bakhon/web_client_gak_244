<?php
   
   if(isset($_GET['email_client']))
    {
        $db = new DB();
        $document = new Document();
         require_once ('methods/xmpp.php');
        $name_client = $_GET['name_client'];
        $tel_client = $_GET['tel_client'];
        $email_client = $_GET['email_client'];
        $city = $_GET['city'];
        $name_product = $_GET['name_product'];
        
        $list_city = $db->select("select * from insurance2.CORPSITE_CITY where id = $city");
        $city_send = $list_city[0]['CITY_RU'];
        
        $email_to_send = array('b.abdisamat@gak.kz');
        
        foreach($email_to_send as $k=>$v) {        
        $document->sendmail("$v", 'Заявка от клиента с сайта на обратный звонок со страниц продуктов', "ФИО: $email_client  \r\nНомер телефона: $tel_client \r\nПочта: $name_client \r\nГород: $city_send \r\nНазвание продукта: $name_product");        
        }
        $document->sendmail('center@gak.kz', 'Заявка от клиента с сайта на обратный звонок со страниц продуктов', "ФИО: $email_client  \r\nНомер телефона: $tel_client \r\nПочта: $name_client \r\nГород: $city_send \r\nНазвание продукта: $name_product");            
        exit;        
    } 


    if(isset($_GET['email_to_send']))
    {
        $db = new DB();
        $document = new Document();
        $email_to_send = $_GET['email_to_send'];
        $client_name_req = $_GET['client_name_req']; // Surname
        $client_tel_num_req = $_GET['client_tel_num_req']; // tel
        $client_email_req = $_GET['client_email_req']; // email
        $city_from_client = $_GET['city_from_client'];
        
        $list_city = $db->select("select * from insurance2.CORPSITE_CITY where id = $city_from_client");
        $city = $list_city[0]['CITY_RU'];
        
      
        //На почту приходит много спама, после исправления, включить
      //  mail("$email_to_send", 'Заявка от клиента с сайта на обратный звонок', "ФИО: '$client_name_req' \r\nПочта: '$email_to_send' \r\nНомер телефона: '$client_tel_num_req'", 'From: site@gak.kz');
    //   $document->sendmail('b.abdisamat@gak.kz', 'Заявка от клиента с сайта на обратный звонок', "ФИО: $client_name_req \r\nПочта: $email_to_send \r\nНомер телефона: $client_tel_num_req");

        require_once ('methods/xmpp.php');
        $jabber = new JABBER();
        
        if($email_to_send == '4') {
            $category = "Сотрудничество и маркетинг";
            $email_to_send =  array('a.turgayev@gak.kz', 'a.kantarbayeva@gak.kz', 'a.mukanova@gak.kz');
        }
        
        if($email_to_send == '5') {
            $category = "Прочие вопросы";
            $email_to_send =  array('a.turgayev@gak.kz', 'a.kantarbayeva@gak.kz', 'a.mukanova@gak.kz');
        }
        if($email_to_send == '2') {
            $category = "Выплата по НС";
            $email_to_send = array('e.abdrasheva@gak.kz', 'e.abdyraimova@gak.kz', 'a.baimagambetova@gak.kz', 'zh.zhumabai@gak.kz', 'v.kaliev@gak.kz', 'n.kulzhabayeva@gak.kz', 's.sataibayeva@gak.kz');
        }
        if($email_to_send == '1') {
            $category = "Консультация по продуктам";
            $email_to_send = array('z.smailova@gak.kz', 'a.burkina@gak.kz', 'r.bainabekova@gak.kz', 'a.muhamedov@gak.kz', 'm.konokhova@gak.kz', 'a.nurgazinov@gak.kz');
        }
        
        if($email_to_send == '3') {
            $category = "Закупки";
            $email_to_send = array('d.mukazhanov@gak.kz', 'g.bekbergenova@gak.kz', 'z.demenova@gak.kz');
        }
        
        
    
        foreach($email_to_send as $k=>$v) {        
        $document->sendmail("$v", 'Заявка от клиента с сайта на обратный звонок', "ФИО: $client_name_req \r\nНомер телефона: $client_tel_num_req \r\n Город: $city \r\nКатегория вопроса: $category");
       // $jabber->send_message("$v", "К Вам пришла заявка от клиента на обратный звонок с корпоративного сайта www.gak.kz\r\nФИО: '$client_name_req' \r\nПочта: '$v' \r\nНомер телефона: '$client_tel_num_req'\r\n(для прочтения полного текста на почту)");
        }
        $document->sendmail('center@gak.kz', 'Заявка от клиента с сайта на обратный звонок', "ФИО: $client_name_req \r\nНомер телефона: $client_tel_num_req \r\nГород: $city \r\nКатегория вопроса: $category");
        exit;
    }
    
	class CALC_SAIT
    {
	    private $db;
        private $array;
        private $user_dan;
        public $dan = array();
        
        
        public function __construct()
        { 
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();                        
        }
        
        private function POST()
        {
            if(count($_POST) > 0){
                $this->array = $_POST;
                foreach($_POST as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }
                }
            }
        }
        
        private function GET()
        {            
            $this->array = $_GET;
            if(count($this->array) <= 0){
                $this->index();                
            }else{                           
                foreach($this->array as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }
                }
            }
        }
        
        private function index()
        {
            $array = array("header"=>"HTTP 1/1.0 Error", "message"=>"404 page not found");
            echo json_encode($array);
            exit;
        }
        
        private function product($id)
        {
             $s = "calc_$id";
             unset($this->array['product']);
             $this->$s();
        }
        
        private function calc_0701000001()
        {            
            $s_oked = $this->array['search_oked'];
            $cnt = $this->array['count_people'];
            $gfot = $this->array['gfot'];
            $str_sum = $this->array['str_sum'];
            
            if($str_sum == ''){$str_sum = $gfot;}
            if($str_sum <= 0){$str_sum = $gfot;}
            
            if(trim($gfot) == ''){
                echo ALERTS::ErrorMin('Строка "Общий годовой фонд оплаты труда (ГФОТ)" не может быть пустой');
                exit;
            }
            
            if($gfot <= 0){
                echo ALERTS::ErrorMin('Строка "Общий годовой фонд оплаты труда (ГФОТ)" не может быть меньше либо равна нулю');
                exit;
            }
            
            if(trim($cnt) == ''){
                echo ALERTS::ErrorMin('Строка "Общее количество сотрудников" не может быть пустой');
                exit;
            }
            
            if($gfot <= 0){
                echo ALERTS::ErrorMin('Строка "Общее количество сотрудников" не может быть меньше либо равна нулю');
                exit;
            }
            
            if(trim($s_oked) == ''){
                echo ALERTS::ErrorMin('Строка "Вид экономической деятельности (ОКЭД)" не может быть пустой');
                exit;
            }
            
            $q = $this->db->Select("select * from dic_oked_afn where concat(oked, name) like '%$s_oked%'");  
            if(count($q) <= 0){
                echo ALERTS::ErrorMin('Неверный Вид экономической деятельности (ОКЭД)');
                exit;
            }
            $q_oked = $q[0];
                                    
            $pr = $gfot / $cnt / 12;
            
            $year_now = date("Y");
            $q = $this->db->Select("select mzp from DIC_CONSTANTS where year = '$year_now'");            
            $mzp = $q[0]['MZP'];
            if($pr < $mzp){
                echo ALERTS::ErrorMin('ГФОТ по 1 сотруднику должен превышать 1 МЗП');
                exit;
            }
            
            if($pr > $mzp * 10){
                echo ALERTS::ErrorMin('ГФОТ по 1 сотруднику не должен превышать 10 МЗП');
                exit;
            }   

            $paysum = $str_sum * (is_float($q_oked['TARIF']) / 100);
            
            $html  = '<div class="row"><label class="col-md-4">ОКЭД: </label><code class="col-md-8" style="width: 63.667%;">'.$q_oked['OKED'].'</code><br /></div>';
            $html .= '<div class="row" style="margin-bottom: 5px;"><label class="col-md-4">Наименование ОКЭД: </label><code class="col-md-8" style="width: 63.667%;">'.$q_oked['NAME'].'</code><br /></div>';
            $html .= '<div class="row"><label class="col-md-4">Класс риска: </label><code class="col-md-8" style="width: 63.667%;">'.$q_oked['RISK_ID'].'</code><br /></div>';
            $html .= '<div class="row"><label class="col-md-4">Тариф: </label><code class="col-md-8" style="width: 63.667%;" >'.floatval($q_oked['TARIF']).' %</code><br /></div>';
            $html .= '<div class="row"><label class="col-md-4">Страховая сумма: </label><code class="col-md-8" style="width: 63.667%;">'.number_format($str_sum, 0, '.', ' ').'</code><br /></div>';
            $html .= '<div class="row"><label class="col-md-4">Страховая премия: </label><code class="col-md-8" style="width: 63.667%;">'.number_format($paysum, 0, '.', ' ').'</code></div>';
            //$html .= json_encode($q_oked);
            echo $html;                                  
        }
        
        private function calc_0101000002()
        {
            $pay_sum_gfss = $this->array['pay_sum_gfss']; 
            $birthday = date("d.m.Y", strtotime($this->array['birthday']));
            $periodich = $this->array['periodich'];
            $sex = $this->array['sex'];
            if($sex == '2'){
                $sex = 0;
            }
            $gp_year = $this->array['gp_year'];
            
            if(empty($this->array['gp_date'])){
                $gp_date = date("d.m.Y");
            }else{
                $gp_date = date("d.m.Y", strtotime($this->array['gp_date']));    
            }
            
            $v = $this->db->Select("select get_age(sysdate, to_date('$birthday', 'dd.mm.yyyy')) cn from dual");
            $vozrast = $v[0]['CN'];
            
            $sql = "
                begin
                  sum_calc.calc_af_pens_08082018(
                    4,
                    NULL,
                    '$pay_sum_gfss',
                    6,
                    $vozrast,
                    '$periodich',
                    0,
                    0,
                    100,                    
                    $sex,
                    '$gp_year',
                    1,
                    3,
                    :OUTAF, 
                    :OUTAF2,
                    :OUTSUM,
                    :CNTMES,
                    :CNT_GAR_VIPL,
                    :OUTFIRSTVIPL,
                    :OUT_PAYSUM_P_OST,
                    :OUT_SUM_DOST
                  );
                end;
            ";
            
            $array = array("OUTAF", "OUTAF2", "OUTSUM", "CNTMES", "CNT_GAR_VIPL", "OUTFIRSTVIPL", "OUT_PAYSUM_P_OST", "OUT_SUM_DOST");            
                             
            $ar = $this->db->ExecuteReturn($sql, $array);            
            $html  = '<div class="row"><label class="col-md-8">Аннуитентный фактор: </label>                    <code class="col-md-4" style="width: 30.333%;">'.$ar['OUTAF'].'</code><br /></div>';
            $html  .= '<div class="row"><label class="col-md-8">Аннутентный фактор с учетом расходов: </label>  <code class="col-md-4" style="width: 30.333%;">'.$ar['OUTAF2'].'</code><br /></div>';
            //$html  .= '<div class="row"><label class="col-md-8">Страховая премия: </label>                      <code class="col-md-4">'.number_format($ar['OUTSUM'], 0, '.', ' ').'</code><br /></div>';
            $html  .= '<div class="row"><label class="col-md-8">Количество гарантированных выплат: </label>     <code class="col-md-4" style="width: 30.333%;">'.$ar['CNT_GAR_VIPL'].'</code><br /></div>';
            //$html  .= '<div class="row"><label class="col-md-8">Первая выплата: </label>                        <code class="col-md-4">'.number_format($ar['OUTFIRSTVIPL'], 0, '.', ' ').'</code><br /></div>';
            //$html  .= '<div class="row"><label class="col-md-8">Страховая выплата: </label>                     <code class="col-md-4">'.number_format($ar['OUT_PAYSUM_P_OST'], 0, '.', ' ').'</code><br /></div>';
            $html  .= '<div class="row"><label class="col-md-8">Страховая выплата: </label>                     <code class="col-md-4" style="width: 30.333%;">'.number_format($ar['OUTSUM'], 0, '.', ' ').'</code><br /></div>';
            //$html  .= '<div class="row"><label class="col-md-8">Сумма достаточности: </label>                   <code class="col-md-4">'.number_format($ar['OUT_SUM_DOST'], 0, '.', ' ').'</code><br /></div>';
            echo $html;
                        
            //echo json_encode($ar);
            exit;
        }
        
        private function calc_0601000001()
        {            
            $date_calc = date("d.m.Y");
            $type_str = 2; //Индивидуальный
            $bithday = date("d.m.Y", strtotime($this->array['bithday']));
            $srok_ins = $this->array['srok_ins'];
            $gfot = $this->array['gfot'];   
            $str_sum = $this->array['str_sum'];
            $dop_pokr = $this->array['dop_pokr'];
            $sex = $this->array['sex'];                        
            
            $sql = "
            begin
                VOLUNTARY.Calc(
                    to_date('$date_calc', 'dd.mm.yyyy'), 
                    '$type_str', 
                    '$sex', 
                    to_date('$bithday', 'dd.mm.yyyy'), 
                    'Единовременно', 
                    '$str_sum', 
                    '$srok_ins', 
                    '1', 
                    0, 
                    15, 
                    :PAY_SUM_P, 
                    :TARIF, 
                    :TARIFS, 
                    :PAY_SUM_PS);
            end;";
            
            $array = array("PAY_SUM_P", "TARIF", "TARIFS", "PAY_SUM_PS");                        
            $ar = $this->db->ExecuteReturn($sql, $array); 
            $paysum_osn = round($str_sum * $ar['TARIF']);
            
            $html = '<label class="text-success">Данные по основному покрытию</label>';            
            $html .= '<div class="row"><label class="col-md-8">Тариф</label><code class="col-md-4" width: 30.333%;>'.floatval($ar['TARIF']).'</code></div>';
            $html .= '<div class="row"><label class="col-md-8">Страховая выплата</label><code class="col-md-4" width: 30.333%;>'.number_format($ar['PAY_SUM_P'], 0, '.', ' ').'</code></div>';
            $html .= '<div class="row"><label class="col-md-8">Страховая премия</label><code class="col-md-4" width: 30.333%;>'.number_format($paysum_osn, 0, '.', ' ').'</code></div>';
                                                
             $paysum_dop = 0;
             if($dop_pokr > 0){
             $sql = "
                begin
                    VOLUNTARY.Calc(
                        sysdate, 
                        '$type_str', 
                        '$sex', 
                        to_date('$bithday', 'dd.mm.yyyy'), 
                        'Единовременно', 
                        '$str_sum', 
                        '$srok_ins', 
                        '$dop_pokr', 
                        0, 
                        15, 
                        :PAY_SUM_P, 
                        :TARIF, 
                        :TARIFS, 
                        :PAY_SUM_PS);
                end;";
                $array = array("PAY_SUM_P", "TARIF", "TARIFS", "PAY_SUM_PS");                        
                $as = $this->db->ExecuteReturn($sql, $array);
                $paysum_dop = round($str_sum * $as['TARIF']);  
                
                $html .= '<label class="text-success">Данные по дополнительному покрытию</label>';            
                $html .= '<div class="row"><label class="col-md-8">Тариф</label><code class="col-md-4">'.floatval($as['TARIF']).'</code></div>';
                $html .= '<div class="row"><label class="col-md-8">Страховая выплата</label><code class="col-md-4">'.number_format($as['PAY_SUM_P'], 0, '.', ' ').'</code></div>';
                $html .= '<div class="row"><label class="col-md-8">Страховая премия</label><code class="col-md-4">'.number_format($paysum_dop, 0, '.', ' ').'</code></div>';                               
             }                          
             
             $html .= "<HR />";
             $html .= '<div class="row"><label class="col-md-8">Общая страховая премия</label><code class="col-md-4">'.number_format($paysum_dop + $paysum_osn, 0, '.', ' ').'</code></div>';
             
             
             $q = $this->db->Select("select round($paysum_all * mesyac_int('Единовременно') * $srok_ins) ps from dual");
             echo $html;
             
            //echo ALERTS::InfoMin('Данный блок калькулятора находится на стадии разработки');
            exit;                        
        }
        
        private function calc_0201000001()
        {
            echo ALERTS::InfoMin('Данный блок калькулятора находится на стадии разработки');
            exit;
        }
        
        private function list_dobr_dop()
        {
            $q = $this->db->Select("select id, naimen from DOBR_DOP_STRAH");
            echo json_encode($q);
            exit;
        }
               
	}
    
    $s = new CALC_SAIT();
    exit;
?>
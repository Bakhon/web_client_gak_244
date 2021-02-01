<?php
	//Единая системы учета электронных трудовых договоров

    error_reporting(-1);
    ini_set('display_errors', 1);

    //define("WSDL", "http://172.16.17.83:7005/ws/contract/ContractSyncChannelService?wsdl");
    //define("URL_SOAP", "http://172.16.17.83:7005/ws/contract/ContractSyncChannelService");
    define("WSDL", "http://213.157.38.43/test/ws/contract/ContractSyncChannelService?wsdl");
    define("URL_SOAP", "http://213.157.38.43/test/ws/contract/ContractSyncChannelService");
    
    define("ECP", "C:\\xampp\\htdocs\\soap\\ecp\\GOSTKNCA_1c5eb48670df884285c678e1f6d6caee693de894.p12");
    define("ECP_PASSWORD", "Asilan13");
    define("BIN", '050640002859');

    require_once __DIR__.'/../application/config.php';
    require_once __DIR__.'/../application/units/other.php';
    require_once __DIR__.'/../application/units/database.php';
    require_once __DIR__.'/ws/Base.php';
    require_once __DIR__.'/ws/client.php';

    ini_set("soap.wsdl_cache_enabled","0");   

class xml2array {    
        var $arrOutput = array();
        var $resParser;
        var $strXmlData;
        
        function parse($strInputXML) {
        
                $this->resParser = xml_parser_create ();
                xml_set_object($this->resParser,$this);
                xml_set_element_handler($this->resParser, "tagOpen", "tagClosed");
                
                xml_set_character_data_handler($this->resParser, "tagData");
            
                $this->strXmlData = xml_parse($this->resParser,$strInputXML );
                if(!$this->strXmlData) {
                    die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($this->resParser)),
                    xml_get_current_line_number($this->resParser)));
                }
                                
                xml_parser_free($this->resParser);
                
                return $this->arrOutput;
        }
        function tagOpen($parser, $name, $attrs) {
           $tag=array("name"=>$name,"attrs"=>$attrs); 
           array_push($this->arrOutput,$tag);
        }
        
        function tagData($parser, $tagData) {
           if(trim($tagData)) {
                if(isset($this->arrOutput[count($this->arrOutput)-1]['tagData'])) {
                    $this->arrOutput[count($this->arrOutput)-1]['tagData'] .= $tagData;
                } 
                else {
                    $this->arrOutput[count($this->arrOutput)-1]['tagData'] = $tagData;
                }
           }
        }
        
        function tagClosed($parser, $name) {
           $this->arrOutput[count($this->arrOutput)-2]['children'][] = $this->arrOutput[count($this->arrOutput)-1];
           array_pop($this->arrOutput);
        }
    }
    
class E_CONTRACTS
{
    private $db;
    private $xml;
    
    private $user = 'TEST';
    private $cor = "TEST";
    private $array;
    
    public $message = '';
    Public $res_xml = '';
    
    private $id_user = 0;
    private $id_zapros = 0;
     
    public function __construct()
    {
        $this->db = new DB();
    }
    
    private function SetPodpis($xml)
    {
        $connect = true;
        
        $client = new Client("wss://127.0.0.1:13579");
        $s = json_decode($client->receive());
                
        if(!$s->result){
            $connect  = false;
            $this->message = 'Ошибка подулючения к NCLayer на сервере 192.168.5.244';
            return false;
        }
                
        //$type = "SIGN";// 'ALL';
        $password_sert_crypt = '';        
        $password_sert_other = '';
        
        /*------------------------------------*/
        $opt = new stdClass();        
        $opt->method = "getKeys";
        $opt->args = array("PKCS12", ECP, ECP_PASSWORD, "SIGN");
                        
        $client->send(json_encode($opt));
        $res = json_decode($client->receive());
                
        $result = $res->result;
                
        $p = explode("|", $result);
        $password_sert_crypt = $p[3];        
        $password_sert_other = $p[2];
        
        if($password_sert_crypt == ''){
            $this->message = 'Ошибка! Проверьте сертификат пользователя подписанта!';
            return false;
        }
        
        $ot = new stdClass();        
        $ot->method = "signXml";
        $ot->args = array("PKCS12", ECP, $password_sert_crypt, ECP_PASSWORD, $xml);
                         
        $client->send(json_encode($ot));
        $dan = json_decode($client->receive());
                
        if($dan->errorCode !== 'NONE'){
            $this->message = $dan->errorCode;
            return false; 
        }        
        return $dan->result;                        
    }
        
    public function contract($id)
    {
        $this->id_user = $id;
        $this->id_zapros = 1;
        
        $q = $this->db->Select("select 
          S.IIN,
          S.CONTRACT_JOB_NUM CONTRACT_JOB_NUM,
          to_char(S.CONTRACT_JOB_DATE, 'yyyy-mm-dd') CONTRACT_JOB_DATE,
          to_char(S.DATE_POST, 'yyyy-mm-dd') DATE_POST,          
          D.DOLZH_ID_MINISTRY,
          S.MILITARY_RANK
        from 
            sup_person s,
            dic_dolzh d
        where 
            S.JOB_POSITION =  D.ID
            and s.id = $id");
        $d = $q[0];

        $dan = array();        
        $iin = $d['IIN'];//'830821399184';

        $contractNumber = $d['CONTRACT_JOB_NUM'];// '100026/15';
        $contractDate = $d['CONTRACT_JOB_DATE'].'+06:00';// '2018-07-12+06:00';
        $beginDate = $d['DATE_POST'].'+06:00'; //'2018-07-12+06:00';
        $position = $d['DOLZH_ID_MINISTRY'];// '314603';        
        $conscript = $d['MILITARY_RANK'];// '1';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
					<ns3:contractRequest xmlns:ns3="http://enbek.kz/contract/ws/schemas" xmlns:ns2="http://bip.bee.kz/SyncChannel/v10/Types">
						<newContractData>
							<employerData>
								<bin>'.BIN.'</bin>
							</employerData>
							<employeeData>
								<iin>'.$iin.'</iin>
							</employeeData>
							<contractData>
								<contractNumber>'.$contractNumber.'</contractNumber>
								<contractDate>'.$contractDate.'</contractDate>
								<beginDate>'.$beginDate.'</beginDate>
								<position>'.$position.'</position>
                                <establishedPost>'.$position.'</establishedPost>
							</contractData>
							<documentData>
								<conscript>'.$conscript.'</conscript>
							</documentData>
						</newContractData>
                    </ns3:contractRequest>';        
        $pxml = $this->SetPodpis($xml);
        
        if($pxml == false)
        {            
            echo $this->message;            
            return false;
        }

        $this->xml = $pxml;
        $bool = $this->sendSoap();
        return $bool;
    }

    public function dop_contract($id)
    {
        $this->id_user = $id;
        $this->id_zapros = 2;

        $sql = "select  
            s.CONTRACT_JOB_NUM,    
            s.iin, 
            T.ORDER_NUM,
            to_char(T.ORDER_DATE, 'yyyy-mm-dd') ORDER_DATE, 
            to_char(T.DATE_OP, 'yyyy-mm-dd') DATE_OP,
            D.DOLZH_ID_MINISTRY,
            S.MILITARY_RANK  
        from 
            T2_CARD t, 
            dic_dolzh d, 
            sup_person s 
        where 
            t.position = d.id
            and S.ID = T.ID_PERSON
            and t.id_person = $id
            and t.act_id = 3
        and t.id = (select max(id) from t2_card where id_person = $id and act_id = 3)";

        //Это тестовый скрипт потом удалить
        $sql = "select  
            nvl(s.CONTRACT_JOB_NUM, sysdate) CONTRACT_JOB_NUM,    
            s.iin, 
            T.ORDER_NUM,
            to_char(nvl(T.ORDER_DATE, sysdate), 'yyyy-mm-dd') ORDER_DATE, 
            to_char(nvl(T.DATE_OP, sysdate), 'yyyy-mm-dd') DATE_OP,
            D.DOLZH_ID_MINISTRY,
            S.MILITARY_RANK 
        from 
            T2_CARD t, 
            dic_dolzh d, 
            sup_person s 
        where 
            t.position = d.id
            and S.ID = T.ID_PERSON
            and t.id_person = $id
            and t.act_id = 3
        and t.id = (select max(id) from t2_card where id_person = $id and act_id = 3)";

        $q = $this->db->Select($sql);

        $d = $q[0];

        $dan = array();        
        $iin = $d['IIN'];

        $contractNumberOld = $d['CONTRACT_JOB_NUM'];// '100026/15';
        $contractNumber = $d['ORDER_NUM'];
        $contractDate = $d['ORDER_DATE'].'+06:00';// '2018-07-12+06:00';
        $beginDate = $d['DATE_OP'].'+06:00'; //'2018-07-12+06:00';
        $position = $d['DOLZH_ID_MINISTRY'];// '314603';        
        $conscript = $d['MILITARY_RANK'];// '1';

        $contractId = '';

        $sqls = "select * from SUP_PERSON_SOAP_TK where id_person = $this->id_user and id_type = 1 and res_id is not null";        
        $qs = $this->db->Select($sqls);

        if(count($qs) <= 0)
        {
            $this->message = 'Ошибка! Не найден основной договор в БД! Обратитесь в ДИТ!';
            return false;
        }

        $contractId = $qs[0]['RES_ID'];        

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
					<ns3:contractRequest xmlns:ns3="http://enbek.kz/contract/ws/schemas" xmlns:ns2="http://bip.bee.kz/SyncChannel/v10/Types">
					<subsidiaryContractData>
						<employerData>
							<bin>'.BIN.'</bin>
						</employerData>
                        <contractId>'.$contractId.'</contractId>
						<subsidiaryContractNumber>'.$contractNumber.'</subsidiaryContractNumber>
						<subsidiaryContractDate>'.$contractDate.'</subsidiaryContractDate>
						<beginDate>'.$beginDate.'</beginDate>
						<position>'.$position.'</position>
                        <establishedPost>'.$position.'</establishedPost>
					</subsidiaryContractData>
                    </ns3:contractRequest>'; 

        $pxml = $this->SetPodpis($xml);

        if($pxml == false)
        {
            echo $this->message;
            return false;
        }

        $this->xml = $pxml;
        $bool = $this->sendSoap();
        return $bool;
    }

    public function rastorzh_contract($id)
    {
        $this->id_user = $id;
        $this->id_zapros = 3;

        $sql = "select  
            s.CONTRACT_JOB_NUM,    
            s.iin, 
            T.ORDER_NUM,
            to_char(T.ORDER_DATE, 'yyyy-mm-dd') ORDER_DATE, 
            to_char(T.DATE_OP, 'yyyy-mm-dd') DATE_OP,
            D.DOLZH_ID_MINISTRY,
            S.MILITARY_RANK  
        from 
            T2_CARD t, 
            dic_dolzh d, 
            sup_person s 
        where 
            t.position = d.id
            and S.ID = T.ID_PERSON
            and t.id_person = $id
            and t.act_id = 3
        and t.id = (select max(id) from t2_card where id_person = $id and act_id = 3)";

        //Это тестовый скрипт потом удалить
        $sql = "select  
            nvl(s.CONTRACT_JOB_NUM, sysdate) CONTRACT_JOB_NUM,    
            s.iin, 
            T.ORDER_NUM,
            to_char(nvl(T.ORDER_DATE, sysdate), 'yyyy-mm-dd') ORDER_DATE, 
            to_char(nvl(T.DATE_OP, sysdate), 'yyyy-mm-dd') DATE_OP,
            D.DOLZH_ID_MINISTRY,
            S.MILITARY_RANK 
        from 
            T2_CARD t, 
            dic_dolzh d, 
            sup_person s 
        where 
            t.position = d.id
            and S.ID = T.ID_PERSON
            and t.id_person = $id
            and t.act_id = 3
        and t.id = (select max(id) from t2_card where id_person = $id and act_id = 3)";

        $q = $this->db->Select($sql);                
        $d = $q[0];

        $dan = array();
        $iin = $d['IIN'];

        $contractNumber = $d['CONTRACT_JOB_NUM'];
        $Date = $d['ORDER_DATE'].'+06:00';
        $reason = '05';//$d['DOLZH_ID_MINISTRY'];

        $contractId = '';

        $sqls = "select * from SUP_PERSON_SOAP_TK where id_person = $this->id_user and id_type = 1 and res_id is not null";        
        $qs = $this->db->Select($sqls);

        if(count($qs) <= 0)
        {
            $this->message = 'Ошибка! Не найден основной договор в БД! Обратитесь в ДИТ!';
            return false;
        }

        $contractId = $qs[0]['RES_ID'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
					<ns3:contractRequest xmlns:ns3="http://enbek.kz/contract/ws/schemas" xmlns:ns2="http://bip.bee.kz/SyncChannel/v10/Types">
						<terminationContractData>
    						<employerData>
    							<bin>'.BIN.'</bin>
    						</employerData>
    						<contractId>'.$contractId.'</contractId>
    						<terminationDate>'.$Date.'</terminationDate>
    						<terminationReason>'.$reason.'</terminationReason>
    					</terminationContractData>                                                
                    </ns3:contractRequest>';

        $pxml = $this->SetPodpis($xml);

        if($pxml == false)
        {
            echo $this->message;
            return false;
        }
        /*
        echo '<textarea>';
        echo $pxml;
        echo '</textarea>';
        exit;
        */

        $this->xml = $pxml;
        $bool = $this->sendSoap();
        return $bool;
    }

    private function sendSoap()
    {
        if(trim($this->xml) == '')
        {
            return false;
        }

        $array['request'] = array();
        $array['request']['requestInfo']['messageId'] = '533a94f7-5900-29a6-e054-001b782b8430';
        $array['request']['requestInfo']['serviceId'] = 'contract';
        $array['request']['requestInfo']['messageDate'] = date("Y-m-d")."T".date("H:i:s"); //'2017-08-25T17:02:36';
        $array['request']['requestInfo']['sender']['senderId'] = 'TEST';
        $array['request']['requestInfo']['sender']['password'] = 'TEST';

        $messageData = new StdClass();
        $messageData->data = new SoapVar($this->xml, XSD_STRING, "string", "http://www.w3.org/2001/XMLSchema");        
        $array['request']['requestData'] = $messageData;                

        $params = array('location' => URL_SOAP,'trace'=>1,);
        $cliente = new SoapClient(WSDL, $params);
        $vem = $cliente->__soapCall('sendMessage',array($array));    

        $this->XML_Request = htmlspecialchars($cliente->__getLastRequest());
        //$this->XML_Response = htmlspecialchars($cliente->__getLastResponse());
        $this->XML_Response = $cliente->__getLastResponse();
        
        echo '<h2>Отправка</h2>'; 
        echo '<textarea style="width: 100%; height: 250px;">';
        echo htmlspecialchars_decode($this->XML_Request);
        echo '</textarea>';
        echo '<hr />';
        
        echo '<h2>Ответ</h2>'; 
        echo '<textarea style="width: 100%; height: 250px;">';                                       
        echo $this->XML_Response;
        echo '</textarea>';
        echo '<hr />';
        
        return $this->RazborXML($this->XML_Response);        
    }

    private function RazborXML($xml_text)
    {
        $this->res_xml = $xml_text;
                
        $objXML = new xml2array();
        $arrOutput = $objXML->parse($xml_text);

        $dan =  $arrOutput[0]['children'][0]['children'][0]['children'][0]['children'][0]['children'];

        $code = '';
        $msg = '';
        $RESPONSEDATE = '';
        $MESSAGEID = '';

        foreach($dan as $k=>$v)
        {
            if($v['name'] == 'STATUS'){
                $code = $v['children'][0]['tagData'];
                $msg = $v['children'][1]['tagData'];
            }

            if($v['name'] == 'MESSAGEID'){
                $MESSAGEID = $v['tagData'];
            }

            if($v['name'] == 'RESPONSEDATE'){
                $RESPONSEDATE = $v['tagData'];
            }                        
        }

        $resid =  '';        
        $dan_other = $arrOutput[0]['children'][0]['children'][0]['children'][0]['children'];        
        if(isset($dan_other[1]['children'][0]['tagData'])){
            $xml_other = $dan_other[1]['children'][0]['tagData'];
            $array = $objXML->parse($xml_other);
            $resid = $array[0]['children'][1]['children']['0']['tagData'];            
        }

        $this->message = $msg;

        $sql = "INSERT INTO SUP_PERSON_SOAP_TK 
        (ID, ID_PERSON, ID_TYPE, RES_ID, DATE_SEND,  CODE, MSG, RESPONSEDATE,  MESSAGEID) 
        VALUES
        (0, $this->id_user, $this->id_zapros, '$resid', sysdate, '$code', '$msg', '$RESPONSEDATE', '$MESSAGEID')";
        
        $cols = array(            
            "RES_XML"=>$xml_text
        );

        if(!$this->db->Execute($sql)){
            echo $sql;
            echo '<hr />';
            echo '<pre>';
            print_r($cols);
            echo '</pre>';
            echo '<hr />';
            echo $this->db->message;
            return false;
        }
        
        return true;
    }

    public function SendAll()
    {
        $q = $this->db->Select("select id from sup_person s where S.STATE = 2");
        foreach($q as $k=>$v){
            $this->contract($v['ID']);
            echo '<div>'.$this->message.'</div><br /><hr>';
        }
    }
}

//$c = new E_CONTRACTS();
//$c->contract(618); Новый договор
//$c->dop_contract(618); Доп соглашение
//$c->rastorzh_contract(618); Расторжение
//echo $c->message;

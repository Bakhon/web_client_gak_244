<?php
	error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set("soap.wsdl_cache_enabled","0");

    //define("WSDL", "http://172.16.17.83:7005/ws/contract/ContractSyncChannelService?wsdl");
    //define("URL_SOAP", "http://172.16.17.83:7005/ws/contract/ContractSyncChannelService");
    define("WSDL", "https://web3.mkb.kz/iicwebservice.asmx?wsdl");
    define("URL_SOAP", "http://213.157.38.43/test/ws/contract/ContractSyncChannelService");
    
    define("ECP", "C:\\xampp\\htdocs\\soap\\ecp\\GOSTKNCA_1c5eb48670df884285c678e1f6d6caee693de894.p12");
    define("ECP_PASSWORD", "111111");
    define("BIN", '050640002859');

    require_once __DIR__.'/../application/config.php';
    require_once __DIR__.'/../application/units/other.php';
    require_once __DIR__.'/../application/units/database.php';
    require_once __DIR__.'/ws/Base.php';
    require_once __DIR__.'/ws/client.php';
    
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

class ESBD
{
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
    
    public function sendPA($cnct)
    {
        $xml = '<?xml version="1.0"?>
        <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://www.w3.org/2003/05/soap-envelope" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <SOAP-ENV:Body xmlns:NS1="http://www.w3.org/2003/05/soap-encoding" xmlns:NS2="https://icweb/IICWebService">
                <SetContractDsAnnuity xmlns="https://icweb/IICWebService">
                    <aSessionID>83599abae19045eab7965d7f2d05857e</aSessionID>
                    <aCONTRACT_DS_ANNUITY>
                        <CONTRACT_ID>0</CONTRACT_ID>
                        <CONTRACT_STATE_ID>2</CONTRACT_STATE_ID>
                        <CONTRACT_STATE>Черновик</CONTRACT_STATE>
                        <CONTRACT_NUMBER>ALM5200520140039Д1</CONTRACT_NUMBER>
                        <CONTRACT_DATE>30.05.2019</CONTRACT_DATE>
                        <DATE_BEG>30.05.2019</DATE_BEG>
                        <DATE_END>30.05.2119</DATE_END>
                        <SYSTEM_DELIMITER_ID>48</SYSTEM_DELIMITER_ID>
                        <SYSTEM_DELIMITER>ГАК</SYSTEM_DELIMITER>
                        <CLIENT_ID>12744153</CLIENT_ID>
                        <RECORD_CHANGED_AT></RECORD_CHANGED_AT>
                        <CREATED_BY_USER_ID>5918</CREATED_BY_USER_ID>
                        <INPUT_DATE>30.05.2019 17:05:38</INPUT_DATE>
                        <CHANGED_BY_USER_ID>5918</CHANGED_BY_USER_ID>
                        <RESCINDING_REASON_ID>0</RESCINDING_REASON_ID>
                        <BRANCH_ID>2</BRANCH_ID>
                        <BRANCH>1100 Алматы-1</BRANCH>
                        <PAYMENT_ORDER_TYPE_ID>1</PAYMENT_ORDER_TYPE_ID>
                        <PAYMENT_ORDER_TYPE>Единовременно</PAYMENT_ORDER_TYPE>
                        <INSURANCE_TYPE_ID>15</INSURANCE_TYPE_ID>
                        <INSURANCE_TYPE>Аннуитетное страхование</INSURANCE_TYPE>
                        <REWRITE_CONTRACT_ID>52907444</REWRITE_CONTRACT_ID>
                        <MIDDLEMAN_ID>0</MIDDLEMAN_ID>
                        <CONTRACT_TYPE_ID>3</CONTRACT_TYPE_ID>
                        <CONTRACT_TYPE>Доп. соглашение</CONTRACT_TYPE>
                        <CLIENT_FORM_ID>0</CLIENT_FORM_ID>
        				
                        <SCHEDULED_PAYMENT_LIST NS1:itemType="NS2:SCHEDULED_PAYMENT" NS1:arraySize="0" />
                        <CONTRACT_RISKS NS1:itemType="NS2:CONTRACT_RISK" NS1:arraySize="0" />
                        <CONTRACT_BENEFIT_RECIPIENTS NS1:itemType="NS2:CONTRACT_BENEFIT_RECIPIENT" NS1:arraySize="0" />
        				
                        <AMOUNT>46186</AMOUNT>
                        <PREMIUM>12222915.73</PREMIUM>
                        <PAYMENT_PERIODICITY_ID>1</PAYMENT_PERIODICITY_ID>
                    </aCONTRACT_DS_ANNUITY>
                </SetContractDsAnnuity>
            </SOAP-ENV:Body>
        </SOAP-ENV:Envelope>
        ';
        $xml_text = $this->SetPodpis($xml);
        $objXML = new xml2array();
        $dan = $objXML->parse($xml_text);
        print_r($dan);
        
        $this->SendSoap($dan, 'SetContractDsAnnuity');
    }
    
    private function SendSoap($array, $type_msg)
    {
        $params = array('location' => URL_SOAP,'trace'=>1,);
        $cliente = new SoapClient(WSDL, $params);
        $vem = $cliente->__soapCall($type_msg,array($array));    

        $this->XML_Request = htmlspecialchars($cliente->__getLastRequest());
        //$this->XML_Response = htmlspecialchars($cliente->__getLastResponse());
        $this->XML_Response = $cliente->__getLastResponse();
    }
}    
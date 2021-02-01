<?php 
header("Content-Type: text/html; charset=utf-8");
//Data, connection, auth
//$dataFromTheForm = $_POST['fieldName']; // request data from the form

$db = new DB();
    $r = $db->Cursor("aSB_EXPORT_test.GetContractList");
    foreach($r as $k=>$v){
        $CONTRACT_ID =$v['CONTRACT_ID'];
        $CLIENT_ID = $v['CLIENT_ID'];   
        $VID = $v['VID'];  
        $r1[] = $db->Cursor("aSB_EXPORT_test.GetClient($CLIENT_ID,$CONTRACT_ID,$VID)");
       foreach($r1 as $k1=>$v1) { if ($v1[0][VID_CLIENT]==1){
                                     
                                    $xml1=xml_create_fiz($v1[0][ESBD_IIN],$v1[0][ESBD_LASTNAME],$v1[0][ESBD_FIRSTNAME],$v1[0][ESBD_MIDDLENAME],$v1[0][ESBD_BIRTHDAY],$v1[0][ESBD_SEX],$v1[0][ECONOMICS_SECTOR_ID],$v1[0][ESBD_RESIDENCYCOUNTRY],$v1[0][ESBD_KZRESIDENCY],$v1[0][ESBD_ADDRESS],$v1[0][ESBD_PHONES],$v1[0][ESBD_EMAIL],$v1[0][ESBD_WEBSITE],$v1[0][ESBD_IDENTITYTYPE],$v1[0][ESBD_IDENTITYNUMBER],$v1[0][ESBD_IDENTITYISSUER],$v1[0][ESBD_IDENTITYISSUEDATE],$v1[0][ESBD_IDENTITYVALIDTO]);
                                    //$resp=sendxml($xml1);
                                   }
                                    }
                        }


 

// xml post structure

$xml_create_ur = '<?xml version="1.0" encoding="utf-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.esbd.bsbnb.kz/">
<soapenv:Header/>
<soapenv:Body>
<ws:createObject>
<object>
<className>ESBD_Entity</className>
<properties>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_BIN</name>
<value>151515125</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Name</name>
<value>Бритиш Петролеум</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Head</name>
<value>Ли Харпер</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Accountant</name>
<value>Оразбекова Сымбат Андреевна</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Address</name>
<value>г. Астана, ул.Панфилова д 23</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Phone</name>
<value>+7 765 345 89 29</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Email</name>
<value>secretary@bp.com</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_WebSite</name>
<value>www.bp.com</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Industry</name>
<value>0</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_BusinessType</name>
<value>1049</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_EconomicBranch</name>
<value>1</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Bank</name>
<value>Алтын Банк</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_Account</name>
<value>4453 4546 3445 5481</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_ResidencyCountry</name>
<value>1</value>
</property>
<property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<name>ESBD_KZResidency</name>
<value>1</value>
</property>
</properties>
</object>
</ws:createObject>
</soapenv:Body>
</soapenv:Envelope>';
function xml_create_fiz
   ($ESBD_IIN,
    $ESBD_LastName,
    $ESBD_FirstName,
    $ESBD_MiddleName,
    $ESBD_Birthday,
    $ESBD_Sex,
    $ECONOMICS_SECTOR_ID,
    $ESBD_RESIDENCYCOUNTRY,
    $ESBD_KZRESIDENCY,
    $ESBD_ADDRESS,
    $ESBD_PHONES,
    $ESBD_EMAIL,
    $ESBD_WEBSITE,
    $ESBD_IDENTITYTYPE,
    $ESBD_IDENTITYNUMBER,
    $ESBD_IDENTITYISSUER,
    $ESBD_IdentityIssueDate,
    $ESBD_IDENTITYVALIDTO) {
$xml_create_fiz = '<?xml version="1.0" encoding="utf-8"?> 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.esbd.bsbnb.kz/">
    <soapenv:Header/>
    <soapenv:Body>
        <ws:createObject>
            <object>
                <className>ESBD_Person</className>
                <properties>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_IIN</name>
                        <value>'.$ESBD_IIN.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_ITN</name>
                        <value></value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_LastName</name>
                        <value>'.$ESBD_LastName.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_FirstName</name>
                        <value>'.$ESBD_FirstName.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_MiddleName</name>
                        <value>'.$ESBD_MiddleName.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Birthday</name>
                        <value>'.$ESBD_Birthday.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Sex</name>
                        <value>'.$ESBD_Sex.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_MaritalStatus</name>
                        <value></value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Profession</name>
                        <value></value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Education</name>
                        <value></value>
                    </property>
                     <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Industry</name>
                        <value>'.$ECONOMICS_SECTOR_ID.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_KZResidency</name>
                        <value>'.$ESBD_RESIDENCYCOUNTRY.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_ResidencyCountry</name>
                        <value>'.$ESBD_KZRESIDENCY.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Address</name>
                        <value>'.$ESBD_ADDRESS.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Phone</name>
                        <value>'.$ESBD_PHONES.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Email</name>
                        <value>'.$ESBD_EMAIL.'</value>
                    </property>
                   <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_WebSite</name>
                        <value>'.$ESBD_WEBSITE.'</value>
                    </property>
                     <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_IdentityType</name>
                        <value>'.$ESBD_IDENTITYTYPE.'</value>
                    </property>
                     <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_IdentityNumber</name>
                        <value>'.$ESBD_IDENTITYNUMBER.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_IdentityIssuer</name>
                        <value>'.$ESBD_IDENTITYISSUER.'</value>
                    </property>
                    <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_IdentityIssueDate</name>
                        <value>'.$ESBD_IdentityIssueDate.'</value>
                    </property>
                     <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_IdentityValidTo</name>
                        <value>'.$ESBD_IDENTITYVALIDTO.'</value>
                    </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Bank</name>
                        <value></value>
                    </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_Account</name>
                        <value></value>
                    </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_ResidencyPermitNumber</name>
                        <value></value>
                    </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_DriverRating</name>
                        <value></value>
                    </property>
                       <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_DriverLicenseNumber</name>
                        <value></value>
                     </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_DriverLicenseIssueDate</name>
                        <value></value>
                     </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_DrivingExperience</name>
                        <value></value>
                     </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_DriverLicenseNumber</name>
                        <value></value>
                     </property>
                     <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_PrivilegeDocumentType</name>
                        <value></value>
                     </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_PrivilegeDocumentNumber</name>
                        <value></value>
                     </property>
                      <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_PrivilegeDocumentIssueDate</name>
                        <value></value>
                    </property>
                     <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_PrivilegeDocumentValidTo</name>
                        <value></value>
                    </property>
                        <property xsi:type="ws:simpleProperty" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                        <name>ESBD_DriverRatingUpdateTime</name>
                        <value></value>
                    </property>
                      </properties>
            </object>
        </ws:createObject>
    </soapenv:Body>
</soapenv:Envelope>';   // data from the form, e.g. some ID number
return $xml_create_fiz;
};

//$xml_post_string = $xml_create_fiz;


function sendxml($xml_post_string) {
$soapUrl = "http://earchive.bsbnb.kz:9080/esbd-ws/ESBDService"; // asmx URL of WSDL
$soapUser = "870104450107";  //  username
$soapPassword = "Rabiga_123"; // password    
$headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: http://earchive.bsbnb.kz:9080/esbd-ws/ESBDService", 
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL

            $url = $soapUrl;

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // converting
            $response = curl_exec($ch); 
        curl_close($ch);
        
return $response;

}
            // converting
        //    $response1 = str_replace("<soap:Body>","",$response);
       //     $response2 = str_replace("</soap:Body>","",$response1);

            // convertingc to XML
     //       $parser = simplexml_load_string($response2);
            // user $parser to get your data out of XML response and to display it.

//curl_close($ch);
//echo $response;
//$response = sendxml($xml_create_ur);

//file_put_contents('d:\\log.txt', date("Y-m-d H:i:s"), FILE_APPEND);
//file_put_contents('d:\\log.txt',"\n". $response, FILE_APPEND);


//$false = mb_stristr($response,"false",false);
//$true = mb_stristr($response,"true",false);
//if ($false != false ) {
//$status = mb_stristr($response,"Бизнес-правило:",false); // Ищет в строке слово и возвращает после него
//$response = mb_stristr($status,"failedBatchItem",true); // Ищет в строке слово и возвращает до него
//}

//if ($true != false ) { 
//$id = mb_stristr($response,"{",false);
//$id1 = mb_stristr($id,"}",true);
//$response = "Физическое лицо создано удачно, присвоен ID:". $id1;
//}









?>   
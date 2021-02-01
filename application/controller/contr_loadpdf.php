<?php
    require_once("methods/mpdf/mpdf.php");     
    
    if(isset($_GET['cnct_id'])){
        $cnct_id = $_GET['cnct_id'];        
    }else{
        echo '<center><h1>Ошибка</h1></center>';
        exit;
    }
   	
    $other = 0;
    if(isset($_GET['other'])){
        $other = $_GET['other'];
    }

    function loopdan($cnct, $sql)    
    {
        $db = new DB3();        
        $sql = htmlspecialchars($sql);        
        $sql = str_replace(':cnct', $cnct, $sql);
        $sql = str_replace('&lt;', '<', $sql);
        $sql = str_replace('&gt;', '>', $sql);
                          
        $dan = $db->Select($sql);                        
        
        $text = '<table width="100%" border="1">';
        
        foreach($dan as $k=>$v){
            $text.= '<tr>';
            foreach($v as $i=>$t){
                $text .= '<td>'.$t.'</td>';
            }
            $text .= '</tr>';                    
        }        
        $text .= '</table>';        
        $text = str_replace_kaz($text);        
        return $text;
    }
    
    function looptext($cnct, $sql, $html)    
    {
        $db = new DB3();
        $sql = str_replace(':cnct', $cnct, $sql);
        $db->ClearParams();
        $dan = $db->Select($sql);
        if(count($db) <= 0){
            return '';
        }
        $text = $html;     
        $txt = array();   
        foreach($dan as $k=>$v){            
            foreach($v as $i=>$t){                
                $txt[$i] .= $t.'<br>';
            }            
        }           
        foreach($txt as $k=>$v){                  
            $text = str_replace('{%'.$k.'%}',  $v, $text);            
        }
        $text = str_replace_kaz($text);
        return $text;
    }
    
    function replace_dan($cnct, $sql, $html)
    {
        $db = new DB3();
        $db->ClearParams();
        $text = $html;
        if(trim($sql) == ''){
            return $text;
        }
        
        $sql = str_replace(':cnct', $cnct, $sql);
        $dan = $db->Select($sql);
             
        foreach($dan as $k=>$v){            
            foreach($v as $t=>$y){                
                $text = str_replace('{%'.$t.'%}', $y, $text);
            }
        }       
        $text = str_replace_kaz($text); 
        return $text;        
    }
    //-------------------------------------------------------------------------------
    
    $db = new DB3();
    
    $body_text = '<style>table{font-size: 10px;}</style>';
        
    $sql = "select GET_REP_ID('$cnct_id', $other) id from dual";
    
    $rep = $db->Select($sql);    
    if($rep[0]['ID'] == '0'){
        $qs = $db->Select("select state from contracts where cnct_id = $cnct_id union all select state from contracts_maket where cnct_id = $cnct_id");
        $state = $qs[0]['STATE'];
        echo '<center><h1>Печать не возможна!<br> Договор имеет статус "'.$state.'"</h1></center>';
        exit;
    }
        
    $sql = "select * from REPORTS_HTML where id = ".$rep[0]['ID'];
    $rep = $db->Select($sql);
    
    $sql = "select * from report_html_other r where r.id_otchet = ".$rep[0]['ID']." order by r.position";
    $otchet = $db->Select($sql);
                      
    foreach($otchet as $k=>$v){
        $prst = round(100 / (12 / $v['NUM_PP']))-3;
        $body_text .= '<div style="float: left; width: '.$prst.'%; margin-left: 15px; font-size: 10px;">';
        if($v['CYCLE'] == 1){
            $body_text .= loopdan($cnct_id, $v['SQL_TEXT']);
        }elseif($v['CYCLE'] == 2){
            $body_text .= looptext($cnct_id, $v['SQL_TEXT'], base64_decode($v['HTML_TEXT']));
        }else{
            $body_text .= replace_dan($cnct_id, $v['SQL_TEXT'], base64_decode($v['HTML_TEXT']));
          //  echo $body_text;
        }
        $body_text .= "</div>";
    }
            
    $body_text = replace_dan($cnct_id, $rep[0]['SQL_TEXT'], $body_text);
   
    $html .= $body_text;  
    if(isset($_GET['word'])){
        echo '<div contenteditable="true">'; 
        echo $html;
        echo '</div>';
        exit;
    }
    
    //echo $html;
    //exit;
        
    $txt = explode('<div class="pagebreak"> </div>', $html);    
    $mpdf = new mPDF();
    
    $q = $db->Select("
    select cnct_id, contract_num, contract_date, id_insur, pay_sum_p, pay_sum_v, date_begin, date_end from contracts where cnct_id = $cnct_id 
    union all 
    select cnct_id, contract_num, contract_date, id_insur, pay_sum_p, pay_sum_v, date_begin, date_end from contracts_maket where cnct_id = $cnct_id");
    
    $data = '';
    foreach($q[0] as $k=>$v){
        $data .= $v.";";
    }
        
        
    $h = 'http';
    if($active_user_dan['role'] == 21){
        $h = 'https';
    }
    $port = $_SERVER['SERVER_PORT'];
    if($port == 80){
        $port = '';
    }else{
        $port = ":".$port;
    }
    
    $http = strtolower($h."://".$_SERVER['SERVER_NAME'].$port);
    $url = "$http/methods/qrimage.php?data=$data&&type";    
    $mpdf->SetHTMLHeader('<div style="text-align: right;"><img style="margin-right: -50px; margin-top: -25px;" src="'.$url.'"></div>');          
        
    $mpdf->setFooter('{PAGENO}');
        
    for($i=0;$i<count($txt);$i++){
        $mpdf->AddPage();   
        $mpdf->WriteHTML($txt[$i]);    
    }
        
    
    $mpdf->Output();
    
    exit;
?>
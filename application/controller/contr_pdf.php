<?php
    header('Content-Type: text/html; charset=utf-8'); //utf-8
    //Header('<link rel="stylesheet" type="text/css" media="print" href="print.css" />');    
    //echo '<link href="styles/css/bootstrap.min.css" rel="stylesheet">';
    //echo '<script src="styles/js/jquery-2.1.1.js"></script>';
    
    $db = new DB3();
    
    function loopdan($cnct, $sql)    
    {        
        $db = new DB3();
        $sql = str_replace(':cnct', $cnct, $sql);
        $sql = str_replace_kaz($sql);
        $db->ClearParams();
        $dan = $db->Select($sql);
        if(count($db) <= 0){
            return '';
        }
        
        $text = '<table width="100%" class="table table-bordered"><tbody>';
        foreach($dan as $k=>$v){
            $text.= '<tr>';
            foreach($v as $i=>$t){
                $text .= '<td>'.$t.'</td>';
            }
            $text .= '</tr>';
        }        
        $text .= '</tbody></table>';
        $text = str_replace_kaz($text);
        return $text;
    }
    
    function looptext($cnct, $sql, $html)    
    {        
        $db = new DB3();
        $sql = str_replace(':cnct', $cnct, $sql);
        $sql = str_replace_kaz($sql);
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
    
    echo '<style>   
    td{
    padding-left: 7.5px;
    padding-right: 7.5px;
    vertical-align: top;
    width: 50%;
    font-size: 11px;
    font-family: serif;
    }
    
    .pagebreak { page-break-before: always; }
    .table-bordered {
      border: 1px solid #EBEBEB;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
      background-color: #F5F5F6;
      border-bottom-width: 1px;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
      border: 1px solid #e7e7e7;
    }
    .table > thead > tr > th {
      border-bottom: 1px solid #DDDDDD;
      vertical-align: bottom;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      border-top: 1px solid #e7eaec;
      line-height: 1.42857;
      padding: 8px;
      vertical-align: top;
    }
    </style>';
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
    
    //$sql = "select GET_REP_ID('$cnct_id', $other) id from dual";
    //$rep = $db->Select($sql);   
    
    $rep = $db->ExecuteReturn("begin :ID := GET_REP_ID('$cnct_id', $other); end;", array('ID'));
    
    if($rep['ID'] == '0'){
        $qs = $db->Select("select state from contracts where cnct_id = $cnct_id union all select state from contracts_maket where cnct_id = $cnct_id");
        $state = $qs[0]['STATE'];
        echo '<center><h1>Печать не возможна!<br> Договор имеет статус "'.$state.'"</h1></center>';
        exit;
    }
        
    $sql = "select * from DIC_CONTRACTS_INSURANCE where id = ".$rep['ID'];
    $rep = $db->Select($sql);
    
    $sql = "select * from REPORT_FORMS_B r where r.ID_FORM = ".$rep[0]['ID']." order by r.position";
    $otchet = $db->Select($sql);
           
    $col = 0;
    $body_text= '';
    $body_text .= '<table width="100%" border="0">';     
    foreach($otchet as $k=>$v){        
        if($col == 0){
            $body_text .= '<tr>';
        }     
        if($v['CYCLE'] == 1){
            $body_text .= '</tr></table>';
            $col = 0;
            $body_text .= loopdan($cnct_id, $v['SQL_TEXT']);
            $body_text .= '<table width="100%" border="0">';
        }        
        elseif($v['CYCLE'] == 2){
            $body_text .= '<td>'.looptext($cnct_id, $v['SQL_TEXT'], base64_decode($v['HTML_TEXT'])).'</td>';
            //$body_text .= '<td>'.replace_dan($cnct_id, $v['SQL_TEXT'], base64_decode($v['HTML_TEXT'])).'</td>';
            $col += $v['NUM_PP'];
            
            if($col >= 12){            
                $body_text .= '</tr>';
                $col = 0;
            }
            $col++;                    
        }
        elseif(base64_decode($v['HTML_TEXT']) == '<div class="pagebreak"> </div>'){
            $body_text .= '</tr></table>'.base64_decode($v['HTML_TEXT']);
            $body_text .= '<table width="100%" border="0">';  
            $col = 0;           
        /*}elseif(strpos(base64_decode($v['HTML_TEXT']), 'table')){
            $body_text .= '</tr></table>';
            $col = 0;
            $body_text .= base64_decode($v['HTML_TEXT']);
            $body_text .= '<table width="100%" border="0">';
        */
        }else{
            $body_text .= '<td>'.replace_dan($cnct_id, $v['SQL_TEXT'], base64_decode($v['HTML_TEXT'])).'</td>';
            $col += $v['NUM_PP'];
            if($col >= 12){            
                $body_text .= '</tr>';
                $col = 0;
            }
            $col++;
        }
    }
    $body_text .= '</table>';
    $body_text = replace_dan($cnct_id, $rep[0]['SQL_TEXT'], $body_text);
    $body_text = str_replace_kaz($body_text);
                
//    echo $body_text;    
 //   exit;
    
    
        
    $db->ClearParams();
    $dan = $db->Select("select * from DIC_CONTRACTS_INSURANCE where id = 1");
    
    if(count($dan) <= 0){
        echo '<center><h1>Запрашиваемая печать не найдена!</h1></center>
        <div style="position: fixed; bottom: 0px; font-size: 8px;">'.$r.'</div>';
        exit;
    }
        
        
    $sql1 = strtoupper($dan[0]['SQL_TEXT']);
    $HTML = $dan[0]['HTML_TEXT'];
        

  
    
    $txt = explode('<div class="pagebreak"> </div>', $html);   
    $mpdf = new mPDF();
    
    $q = $db->Select("
    select cnct_id, contract_num, contract_date, id_insur, pay_sum_p, pay_sum_v, date_begin, date_end from contracts where cnct_id = $val 
    union all 
    select cnct_id, contract_num, contract_date, id_insur, pay_sum_p, pay_sum_v, date_begin, date_end from contracts_maket where cnct_id = $val");
    
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
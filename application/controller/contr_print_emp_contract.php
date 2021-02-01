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
        $db = new DB();        
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
        $db = new DB();
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
        $db = new DB();
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
    
    $db = new DB();
    
    $sql = "select * from docs where id = 1";
    $otchet = $db->Select($sql);
                      
    foreach($otchet as $k=>$v)
    
    $html .= $v['TEXT'];
    
    $txt = explode('<div class="pagebreak"> </div>', $html);
    $mpdf = new mPDF();
    
    for($i=0;$i<count($txt);$i++){
        $mpdf->AddPage();
        $mpdf->WriteHTML($txt[$i]);
    }
    
    $mpdf->Output();
    
    exit;   
?>
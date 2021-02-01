<?php    
    $s = '';
    if(!isset($_GET['cnct'])){exit;}
    if(!isset($_GET['other'])){exit;}
    
    $s = $_GET['cnct'].' '.$_GET['other'];
    $s = 'cnct_id='.$_GET['cnct'].'&other='.$_GET['other'];
    
    if(isset($_GET['sql'])){
        //url: rep_frx?cnct=194&other=6&sql=SQL_TEXT
        
        $cnct = $_GET['cnct'];
        $other = $_GET['other'];
        $zsql = $_GET['sql'];
        
        $db = new DB3();
        $sql = "begin GetRepId($cnct, $other, :ID, :MSG); end;";        
        $ar = array("ID", "MSG");
        
        $q = $db->ExecuteReturn($sql, $ar);    
        if(trim($q['MSG']) !== ''){
            echo $q['MSG'];
            exit;
        }
        
        $q = $db->Select("select * from frx_reports where id = ".$q['ID']);    
        if(count($q) == 0){
            exit;
        }
        
        $ss = strtoupper($zsql);
        header("Content-Type: text/xml");
        if($ss == 'XML_TEXT'){
            echo $q[0]['XML_TEXT'];
            exit;
        }
        
        
        $sql = $q[0][$ss];
        $sql = str_replace(':cnct', $cnct, $sql);        
        $qs = $db->Select($sql);        
        $cols = $db->list_columns;
        
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><DATAPACKET Version="2.0"> <METADATA> <FIELDS>';
        foreach($cols as $k=>$v){
            $xml .= '<FIELD attrname="'.$v.'" fieldtype="string" WIDTH="255"/> ';
        }
		
        $xml .= '</FIELDS><PARAMS/></METADATA><ROWDATA>';        
        
        foreach($qs as $k=>$v){
            $xml .= '<ROW ';
            foreach($cols as $t=>$c){
                $xml .= $c.'="'.$v[$c].'" ';
            }
            $xml .= '/>';
             //RowState="4" id="1" name="sdfsdfsdf"
        }
        $xml .= ' </ROWDATA> </DATAPACKET>';
        
        echo $xml;
        exit;        
    }
        
    header('Content-Type: text/html; charset=utf-8');
?>
<style>

.WordSection{
    page-break-before: always;
    overflow: hidden; 
    margin: 10px; 
    display: inline-block; 
    text-align: left; 
    vertical-align: top; 
    padding: 39px; 
    /*border: 1px solid gray;*/ 
    color: rgb(0, 0, 0); 
    background: rgb(255, 255, 255); 
    box-sizing: content-box; 
    /*height: 1046px;*/
    width: 798px;
}

p{
    margin-top: .0001pt;
}
</style>  
<!--
<div style="text-align: center;bottom: 0px;position: absolute;top: 33px;height: auto;overflow: auto;margin-top: 0px;width: 100%;">
-->
  
<?php

//----------------------------------------------------------------------------------------------------------------


//----------------------------------------------------------------------------------------------------------------
    if(count($_GET) <= 0){
        exit;
    }
    
    $cnct = $_GET['cnct'];
    
    if(isset($_GET['cnct_id'])){
        $cnct = $_GET['cnct_id'];
    }
    $other = 0;
    if(isset($_GET['other'])){$other = $_GET['other'];}
    
	$db = new DB3();
    $sql = "begin GetRepId($cnct, $other, :ID, :MSG); end;";
    
    $ar = array("ID", "MSG");
        
    $q = $db->ExecuteReturn($sql, $ar);    
    if(trim($q['MSG']) !== ''){
        echo $q['MSG'];
        exit;
    }
    
    //echo $q['ID'];
    
    $q = $db->Select("select * from frx_reports where id = ".$q['ID']);   
    if(count($q) == 0){
        exit;
    }
    
    //-----------------------------------------        
    require_once 'methods/FastReport/index.php';
    /*
    echo '<textarea>';
    echo $q[0]['XML_TEXT'];
    echo '</textarea>';
    exit;
    */
    $fr = new fastreport();
    $fr->xml = $q[0]['XML_TEXT'];
    $fr->init();
    echo $fr->style;    
    echo $fr->html;
?>    
</div>

<?php 
    exit;
?>
<?php 
class REP
{
    private $db;
    public $list_reports = array();
    public function __construct()
    {
        $this->db = new DB3();                
        if(count($_REQUEST) <= 0){
            $this->lists();
        }else{            
            foreach($_REQUEST as $k=>$v){
                if(method_exists($this, $k)){
                    $this->$k($v);
                }
            }
        }
        $this->onAjax();               
    }
    
    private function print_contract($id)
    {        
        $q = $this->db->Select("
            select substr(paym_code, 1, 2) ps from contracts where cnct_id = $id
            union all
            select substr(paym_code, 1, 2) ps from contracts_maket where cnct_id = $id
            union all
            select substr(paym_code, 1, 2) ps from dobr_dogovors where cnct_id = $id
        ");
        
        if($q[0]['PS'] == '06'){
            $page = 'hranitel';
        }else{
            echo 'Не найдена типовая форма договора';            
            exit;
        }
        require_once __DIR__."/../views/print_dogovors/$page.php";
        exit;
    }
        
    private function lists()
    {
        $id_role = 1;
        $dan = array();
        $ds = $this->db->Select("select group_id, name from(
            select  d.group_id, d.name, (
              select count(*) from s_reps s, s_reps_role r where s.id = R.ID_REP and group_id = d.group_id and R.ID_ROLE = $id_role ) cnc  
            from 
                S_REPS_group d 
            where 
                isnewses in (1,2,3,4) order by 1
            ) where cnc > 0
        ");                
        
        foreach($ds as $k=>$v){
            $dan[$v['NAME']] = $this->db->Select("
            select  *  from s_reps where isnewses in (1,2,3,4) and group_id = ".$v['GROUP_ID']."
            and id in(select id_rep from S_REPS_ROLE where id_role = $id_role)
            order by  id                        
            ");
        }
        
        $sql = "select  *  from s_reps where id < 2000 and isnewses in (1,2,3,4) and group_id is null
        and id in(select id_rep from S_REPS_ROLE where id_role = $id_role) order by id";
        
        $this->list_reports['reps_group'] = $dan;
        $this->list_reports['reps'] = $this->db->Select($sql);
    }
    
    private function onAjax()
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                exit;
            }
        }
    }
    
    private function otchet_params($id)
    {
        $result = array();
        $qs = $this->db->Select("select * from s_reps where id = $id");
        $result['title'] = $qs[0]['ID'].' - '.$qs[0]['NAME'];
        
        $sql = "select * from S_REP_PAR where repid = $id order by num";
        $q = $this->db->Select($sql);
        
        $result['prs'] = $q;
        $html = '<input type="hidden" name="report" value="'.$id.'">';
        $form = new FORMS();
        foreach($q as $k=>$v){
            if(strtoupper($v['TIP']) == "D"){
                $html .= $form->inputDate(12, $v['NAME'], 'param['.$v['NUM'].']', '', 'form-control', '');
            }
            
            if($v['TIP'] == "L"){
                $pst = $this->db->Select($v['LOV']);                
                $html .= $form->FormHorizontalSelectRep($v['NAME'], 'param['.$v['NUM'].']', $pst, 'form-control');
            }
            
            if($v['TIP'] == "S"){                                
                $html .= $form->FormHorizontalEdit(3, 9, $v['NAME'], 'param['.$v['NUM'].']');
            }
            
            if($v['TIP'] == "P"){                                
                $html .= $form->FormHorizontalCheck(1, 11, $v['NAME'], 'param['.$v['NUM'].']', '');
            }
        }
        $result['html_form'] = $html;         
        echo json_encode($result);
    }
    
    private function report($id)
    {            
    
  /*      foreach($_GET['param'] as $k=>$v){
        $sql_new = "select payments_SERG.CHECK_IPDL_CONTR_SERG_F('$v', 'b.abdisamat@gak.kz') msg from FOR_SEREGA";
         $qs = $this->db->select($sql_new);
        } 

        foreach($qs as $kk=>$vv)
        {
            if($vv['MSG'] == '0')
            {
               // echo '123';
             // return true;  
            }
            if($vv['MSG'] != '0') {
                
                echo "<script>alert('Первый руководитель относится к ИПДЛ! Необходимо получить разрешение на заключение договора');</script>";
              //  echo 'Первый руководитель относится к ИПДЛ! Необходимо получить разрешение на заключение договора';
               // return true;
              //  alert = new ALERTS();
               // echo alert::ErrorMin('Первый руководитель относится к ИПДЛ! Необходимо получить разрешение на заключение договора');
            }
        } */
      
      
         
        
        $type = 'html';
        if(isset($_GET['format'])){
            $type = $_GET['format'];            
        }
        
        $oncheck = 0;
        $q = $this->db->Select("select * from S_REP_PAR where repid = $id");
        foreach($q as $k=>$v){
            if($v['TIP'] == 'P'){
                $oncheck = $v['NUM'];
            }
        } 
        
      
        
        $sql = "Begin    
            Rep.AddReport($id); ";
          //  print_r($_GET['param']);
        foreach($_GET['param'] as $k=>$v){
            $q = $this->db->Select("select * from S_REP_PAR where repid = $id and num = $k");
            
            if($q[0]['TIP'] == 'D'){
                $sql .= "
                    Rep.AddParam($k,to_date('$v','dd.mm.yyyy')); ";
            }else{
                $sql .= "
                    Rep.AddParam($k,'$v'); ";    
            }
        }
        if($oncheck > 0){
            $rrs = 0;
            if(isset($_GET['param'][$oncheck])){
                if($_GET['param'][$oncheck] == 'on'){
                    $rrs = 1;
                }
            }
            $sql .= "
                    Rep.AddParam($oncheck, '$rrs'); ";  
        }
        
        $sql .= "
        Rep.RunRep;   
            :ZipText := Rep.GetText;   
        Exception   When others then    RollBack;    
            Rep.Bad;     
            :ZipText := Rep.GetText;               
        End; "; 
        
      // echo $sql;
        $h = $this->db->ExecReturn2($sql, "ZipText");
        
      
        if(isset($_GET['format'])){
            $this->header_format($_GET['format'], $id, $h);
        }
        $txt = $h;     
        //$txt = iconv("utf-8", "windows-1251", $h);
        echo $txt;
        exit;
        $txt = str_replace('xmlns:x="urn:schemas-microsoft-com:office:excel"', '', $txt);        
            
        if(isset($_GET['on_sql'])){
            echo '<pre>'.$sql.'</pre>';     
        }                        
        exit;        
    }
    
    private function header_format($type, $id, $body)
    {
        if($type == 'xls'){            
            header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Cache-Control: post-check=0, pre-check=0', FALSE);
            header('Content-transfer-encoding: binary');
            header("Content-Disposition: attachment; filename=rep_$id.xls");
            header('Content-Type: application/x-unknown');
            echo iconv("utf-8", "windows-1251", $body);
            exit;
        } 
    }
    
    private function search($text)
    {
        $id_role = 1;
        $dan = array();
        $ds = $this->db->Select("select group_id, name from(
            select  d.group_id, d.name, (
              select count(*) from s_reps s, s_reps_role r where s.id = R.ID_REP and group_id = d.group_id and R.ID_ROLE = $id_role
              and S.NAME||S.ID like '%$text%' 
            ) cnc  
            from 
                S_REPS_group d 
            where 
                isnewses in (1,2,3,4) 
                order by 1
            ) where cnc > 0
        ");                
        
        foreach($ds as $k=>$v){
            $dan[$v['NAME']] = $this->db->Select("
            select  *  from s_reps where isnewses in (1,2,3,4) and group_id = ".$v['GROUP_ID']."
            and id in(select id_rep from S_REPS_ROLE where id_role = $id_role)
            and upper(NAME||ID) like upper('%$text%')
            order by  id                        
            ");
        }
        
        $sql = "select  *  from s_reps where id < 2000 and isnewses in (1,2,3,4) and group_id is null
        and id in(select id_rep from S_REPS_ROLE where id_role = $id_role)
        and upper(NAME||ID) like upper('%$text%')
        order by id";
        
        $this->list_reports['reps_group'] = $dan;
        $this->list_reports['reps'] = $this->db->Select($sql);
    }
           
}    
    
    $rep = new REP();
    
    array_push($css_loader,
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/datapicker/datepicker3.css', 
        "styles/css/plugins/jsTree/style.min.css"
    );
    array_push($js_loader, 
        "styles/js/plugins/jsTree/jstree.min.js", 
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js'
    );
    
    $othersJs .= "<style>
                    .jstree-open > .jstree-anchor > .fa-folder:before {
                        content: '\f07c';
                    }
                    .jstree-default .jstree-icon.none {
                        width: 0;
                    }
                </style>";

    $othersJs .= "<script>
                    $(document).ready(function(){                
                        $('#jstree1').jstree({
                            'core' : {
                                'check_callback' : true
                            },
                            'plugins' : [ 'types', 'dnd' ],
                            'types' : {
                                'default' : {
                                    'icon' : 'fa fa-folder'
                                },
                                'report':{
                					'icon' : 'fa fa-file-o',
                                    'class': 'get_report'
                				},
                                
                            }
                        });                                                                                                                              
                    });                    
                </script>";    
    
    /*
    if(isset($_GET['export'])){
        $file = date("dd.mm.yyyy").rand(1000, 9999).".xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
    }else{    
        header('Content-Type: text/html; charset=utf-8');
        Header('<link rel="stylesheet" type="text/css" media="print" href="print.css" />');
    }
    	
    $id = $_GET['id'];
    $d = $_GET;    
    unset($d["id"]);
        
    $sql = "
    Begin    
        Rep.AddReport($id);";
    $i = 1;
    foreach($d as $k=>$v){
        $sql .= " 
            Rep.AddParam($i, '$k'); 
        ";
        $i++;
    }
    
    $sql .= " 
        Rep.RunRep;   
        :ZipText := Rep.GetText;   
    Exception   When others then    RollBack;    
        Rep.Bad;     
        :ZipText := Rep.GetText;   
    End;";
        
    //echo $sql;
    $db = new DB3();
    $html = $db->ExecReturn($sql, ':ZipText');     
    $html = str_replace('<head><meta content="text/html; charset=windows-1251" http-equiv=Content-Type>', '', $html);       
    echo $html;    
    exit;
    */
?>
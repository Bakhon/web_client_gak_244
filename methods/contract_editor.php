<?php

    class TYPICAL_FORMS{
        
 
        private $db;
        private $array;
        public $dan;
        
        public function __construct()
        {
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];
            $this->$method();            
        }   
        
        private function GET()
        {            
            if(count($_GET) <= 0){
                $this->index();                
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
                        unset($this->array[$k]);
                        $this->$k($v); 
                    }    
                }
                $this->GET();
            }
        }
        
        //-------------------------------- Начало основной формы --------------------------------------------
        private function index()
        {
                      
        }
         
         
             private function list_params_col_table($id)
        {
            $q = $this->db->Select("select id, col_meta, descript from s_meta_columns where id_table = $id order by col_meta");
            foreach($q as $k=>$v){
                echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['COL_META'].'</option>';
            }
            exit;
        }   
        
        
                     private function list_params_col_table2($id)
        {
            $q = $this->db->Select("select id, col_meta, descript from s_meta_columns where id_table = $id order by col_meta");
            foreach($q as $k=>$v){
                echo '<option value="'.$v['ID'].'" data="'.$v['DESCRIPT'].'">'.$v['COL_META'].'</option>';
            }
            exit;
        }
        
        private function select_html_text($idr) {
            $id = $this->array['edit_blockr'];
            $q = $this->db->select("select * from ADD_SELECT where id = $idr");
        //    print_r($q);
            $result = '';
            $id_block = $q[0]['ID_BLOCK'];
             $p['HTML'] = $q[0]['HTML_TEXT'];
          //  print_r($p);
             
             $q2 = "UPDATE REPORT_FORMS_B set 
                HTML_TEXT = EMPTY_CLOB() where ID = $id_block 
                RETURNING HTML_TEXT INTO :HTML";
          $result = $this->db->AddClob($q2, $p);
            
            
           // $dan = $p;                           
          //  echo json_encode($p['HTML']);
            
                
            $result .= $this->edit_block($id);
            echo $result;
             exit;
            
        }
        
                                          
                private function id($id)
        {            
            $q = $this->db->Select("select id, table_meta, descript from s_meta_tables");
            foreach($q as $k=>$v){
                $q[$k]['columns'] = $this->db->Select("select id, col_meta, descript from s_meta_columns where id_table = ".$v['ID']." order by col_meta");
            }
             
             $this->dan['list_tables'] = $this->db->Select("select id, table_meta, descript from s_meta_tables");
             $this->dan['list_columns'] = $this->db->Select("select id, col_meta, descript from s_meta_columns where id_table = ".$this->dan['list_tables'][0]['ID']." order by col_meta");
             $this->dan['list_condit'] = $this->db->Select("select * from S_META_CONDIT order by id");
             $this->dan['list_type_contracts'] = $this->db->Select("select * from DIC_CONTRACT_CONDITION where ID_CONDITION_CONTR = $id and SOCHETANIE = 0 order by id");  
             $this->dan['list_type_contracts2'] = $this->db->Select("select * from DIC_CONTRACT_CONDITION where ID_CONDITION_CONTR = $id and SOCHETANIE = 1 order by id");                     
             $this->dan['meta'] = $q;             
             $this->dan['html'] = $this->list_form($id); 
             return $this->dan;
        } 
                     
                private function list_form($id)
        {
            $i = 0;
            $html = '';
            $q = $this->db->Select("select * from REPORT_FORMS_B where id_form = $id order by position");
            foreach($q as $k=>$v){
                if($i >= 12){
                    $html .= '<div class="col-lg-12"></div>';
                    $i = 0;
                }
                $i += $v['SIZE_P'];
                $html .= '<div class="col-lg-'.$v['SIZE_P'].'" id="block'.$v['ID'].'" data="'.$v['ID'].'">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Добавить параметры</h5>
                                    <div class="ibox-tools">     
                                         
                                        </div>    
                                <br/>                            
                                <h5>№ п\п: '.$v['POSITION'].'. Название блока: '.$v['NAME'].'</h5>
                                    <div class="ibox-tools">                                        
                                        <a class="dropdown-toggle" data-toggle="modal" onclick="edit_block('.$v['ID'].');" data-target="#add_standart_contracts"><i class="fa fa-edit"></i></a>
                                        <a onclick="deleteBlock('.$v['ID'].');"><i class="fa fa-times"></i></a>                                                                                                              
                                                                               
                                    </div>
                            </div>
                            
                            <div class="ibox-content">
                                <div id="blockContent">'.base64_decode($v['HTML_TEXT']).'</div>
                            </div>
                                                        
                        </div>
                    </div>';
            }
            return $html;
        }
         
                private function new_id_block($id)
        {
            $id = str_replace('#', '', $id);
            $q = $this->db->Select("select nvl(max(POSITION), 0)+1 sp from REPORT_FORMS_B where ID_FORM = $id");
            echo $q[0]['SP'];
            exit;
        } 
                       
        private function set_bloc_report($id)
        {        
            $id_block = $this->array['id'];
            $result = '';
            $title = $this->array['name'];
            $pos_num = $this->array['position'];
            $position = $this->array['size_p'];
            $p['HTML'] = base64_encode($this->array['html']);
            
            if($p['HTML'] == ''){
                $result .= ALERTS::ErrorMin('Тело блока не может быть пустым');
            }
            
            if($id_block == 0){                         
                $sql = "INSERT INTO REPORT_FORMS_B (ID, NAME, POSITION, SIZE_P, HTML_TEXT, ID_FORM) 
                VALUES (SEQ_REPORT_FORMS_B.nextval, '$title', $pos_num, $position, EMPTY_CLOB(), $id) RETURNING HTML_TEXT INTO :HTML";
            }else{
                $sql = "UPDATE REPORT_FORMS_B set  
                POSITION = $pos_num,
                NAME = '$title',
                SIZE_P = $position,
                HTML_TEXT = EMPTY_CLOB() where ID = $id_block
                RETURNING HTML_TEXT INTO :HTML";
            }            
            $this->db->AddClob($sql, $p);
            $result .= $this->list_form($id);
                        
            if($id_block == 0){
                $l = $this->db->Select("select max(id) id from REPORT_FORMS_B where id_form = $id");
                $id_block = $l[0]['ID'];                
            }
            
            $this->db->Execute("delete from S_FORM_PARAMS where id_form = $id and id_block = $id_block");
            foreach($this->array['list_meta'] as $k=>$v){
                $this->set_form_toblock_meta($id, $v['id_table'], $v['id_col'], $id_block);
            }
                                                
            echo $result;            
            exit;
        }   
        
        private function set_param_report($id)
        {                          
  //      print_r($this->array);
              $add_set = $this->array['add_settings'];
              $result = '';              
              $id_block = $this->array['id_check'];

              $type_contracts = $this->array['vid_dog'];                           
 /*             $tables = $this->array['params_table'];
              $column = $this->array['params_column'];
              $condition = $this->array['params_condit'];
              $input_param = $this->array['params_res'];               */                              
                        

              foreach($type_contracts as $k=>$v){
                $sql = "INSERT INTO ADD_SETTING_WAR (ID, ID_BLOCK, TYPE_CONTRACTS) 
                VALUES(SEQ_ADD_SETTING.nextval, $add_set, '$v')";
                if(!$this->db->Execute($sql)){
                    return false;
                }                                                                        
              } 
              return true;
              
            $result .= $this->list_form($id);       
            echo $result;                                                                                                                                                                               
                exit; 
        }
        
        
                
        private function set_param_report2($id)
        {                          
              $add_set = $this->array['edit_block2'];
              $result = '';              
              $id_block = $this->array['id_check2'];
                        
              $tables = $this->array['params_table2'];
              $column = $this->array['params_column2'];
              $condition = $this->array['params_condit2'];
              $input_param = $this->array['params_res2'];                                             
                        
               if($input_param == '') {   
                exit;}
                else {          
                $sql = "INSERT INTO ADD_SETTING_PARAM (ID, ID_BLOCK, ID_TABLE, CONDIT, ID_COL, RES ) 
                VALUES(SEQ_ADD_SETTINGS22.nextval, $add_set, $tables, $condition,  $column, '$input_param')";
                if(!$this->db->Execute($sql)){
                    return false;
                }                                                                        
               
              return true;
            }   
            $result .= $this->edit_block(274);       
            echo $result;                                                                                                                                                                               
                exit; 
        }
        
                        
                private function set_form_toblock_meta($id_form, $id_table, $id_col, $id_block)
        {            
            $sql = "INSERT INTO S_FORM_PARAMS (ID_FORM, ID_TABLE, ID_COL, ID_BLOCK) VALUES ($id_form, $id_table, $id_col, $id_block)";
            if(!$this->db->Execute($sql)){
                return false;
            }
            return true;
            
        }
        
                private function edit_block($id)
        {                                              
            $q = $this->db->Select("select * from REPORT_FORMS_B where id = $id");
            foreach($q as $r=>$t){
                $tts = $this->db->Select("select add_s.ID, add_s.ID_block, st.TABLE_NAME, st.TABLE_META, sm.COL_NAME, sm.COL_META, sc.CONDT, add_s.res from ADD_SETTING_PARAM add_s, S_META_TABLES st, S_META_COLUMNS sm, S_META_CONDIT sc where add_s.ID_TABLE = st.ID and add_s.ID_COL = sm.ID and add_s.CONDIT = SC.ID and  add_s.ID_BLOCK =  ".$t['ID']);
                $q[$r]['list_params'] = $tts;
                $list_vidi_dogovorov = $this->db->select("select a.ID, a.ID_BLOCK, a.TYPE_CONTRACTS, dci.NAME from ADD_SETTING_WAR a, DIC_CONTRACT_CONDITION dci  where a.TYPE_CONTRACTS = dci.id and a.id_block =".$t['ID']);
                $q[$r]['list_set'] = $list_vidi_dogovorov;
                $list_select_parametr = $this->db->Select("select * from ADD_SELECT where id_block = ".$t['ID']);
                $q[$r]['list_select_params'] = $list_select_parametr;
            }
            $dan = $q[0];                       
            $dan['HTML_TEXT'] = base64_decode($dan['HTML_TEXT']);                            
            echo json_encode($dan);                                                                 
            exit;             
        }        
        
                private function del_block($id)
        {
            $res = '';
            $sql = "delete from REPORT_FORMS_B where id = $id";            
            if(!$this->db->Execute($sql)){
                $res .= ALERTS::ErrorMin($this->db->message);    
            }
            
            $this->db->Execute("delete from ADD_SELECT where ID_BLOCK = $id");    
            
            
            $this->db->Execute("delete from ADD_SETTING_PARAM where ID_BLOCK = $id");                        
                        
            $this->db->Execute("delete from S_FORM_PARAMS where id_block = $id");
                        
            $res .= $this->list_form($this->array['id_report']);
            echo $res;
            exit;       
        }
        
        private function del_param($id){
            $res = '';
                    
             $this->db->Execute("delete from ADD_SETTING_PARAM where id = $id"); 
           
        //     $res .= $this->edit_block($rep); 
             echo $res;                                                               
             exit;                        
        }     
        
        
                private function del_param_kind_contr($id){
                    print_r($this->array);
            $res = '';
                    
             $this->db->Execute("delete from ADD_SETTING_WAR where id = $id"); 
             
           // $res .= $this->list_form($this->array['id_rep']);
           
            $res .= $this->id($this->array['id_rep']); 
             echo $res;                                                               
             exit;                        
        } 
      
                                                                     
    }

?>
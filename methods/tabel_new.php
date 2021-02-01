<?php


class NEWTABLE {
    
    private $db;
    public $array = array(); 
    
    public function __construct()
    {
            $this->db = new DB();   
            $method = $_SERVER['REQUEST_METHOD'];                           
            $this->$method();        
    }
    
     private function GET()
            {
                if(count($_GET) <= 0){
                    $this->html = $this->index();                
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
                foreach($_POST as $k=>$v);                                
                if(method_exists($this, $k)){                                        
                    $this->array = $_POST;
                    $this->$k($v); 
                }
            }
            unset($_POST);            
            $this->GET();
        }
        
        public function index()
        {
            $dan = array();
            $q = $this->db->select("select * from DIC_DEPARTMENT where id = 14");           
            $dan = $q;
            foreach($dan as $k=>$v)
            {
                $qs = $this->db->select("select * from sup_person where state in (2,3) and job_sp = ".$v['ID']);
                if(count($qs) > 0)
                {
                    $dan[$k]['dolzh'] = $qs;                  
                }
            }            
           
          $this->array = $dan;                                                          
        }
        
              private function provcheck($curid, $id_dep)
        {
            $view = $this->db->Select("select count(*) c from curators c where c.dep_id = $id_dep and C.CURATORS_ID = $curid");           
            if($view[0]['C'] == 0){
                return false;
            }else{
                return true;
            }
        }
        
        
                private function forms_dolzh($id)
        {
            $html = '';
            $q = $this->db->Select("select * from dic_department order by id ASC");            
            foreach($q as $k=>$v){
                
                $ch = '';
                if($this->provcheck($id, $v['ID'])){
                    $ch = 'checked';
                }
                $html .= '<ol class="breadcrumb">                    
                    <li><strong>'.$v['NAME'].'</strong></li>                                      
                </ol>
                
                    <p><label>
                        <input type="checkbox" class="id_method" value="'.$id.';'.$v['ID'].';" '.$ch.'> Куратор
                    </label></p>
                ';
                
            
                $html .= '<hr />';
            }            
            echo $html;
            exit;
        } 
        
            private function set_form_user()
        {
            $dan = $this->array;
            $t = explode(";",$dan['set_form_user']);
            $cur_id = $t[0];
            $dep_id = $t[1];
            $method = $t[2];
            
            echo $dolzh;
            echo '<br/>';
            echo $form;
            
            
            if($dan['emp'] == 'true'){
                  $this->check_dep($dep_id);
                                                                                           
                $sql = "INSERT INTO CURATORS (DEP_ID, CURATORS_ID)
                VALUES ($dep_id, $cur_id)";   
            }else{
                $sql = "delete from curators where dep_id = $dep_id and CURATORS_ID = $cur_id";
            }
            $this->db->Execute($sql);
            $this->forms_dolzh($cur_id);        
            exit;
        }
        
        
        private function check_dep($id_dep)
        {
            
           $sql = "select count(*) c from curators c where c.dep_id = $id_dep";     
           $q = $this->db->select($sql);   
           if($q[0]['C'] > 0)
           {
             $sql = "delete from curators where dep_id = $id_dep";
             $this->db->execute($sql);
             return true;
           }    
           else{
            return false;
           }
                                                     
        }
        
    
}

?>
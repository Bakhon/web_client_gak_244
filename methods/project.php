<?php
	class PROJECT
    {
        private $db;
        public $result;
        public $load_page;
        
        private $path = 'application/views/project/';
        private $id_user;
        
        public function __construct()
        {
            $this->db = new DB();
            $this->load_page = $this->path.'main.php';
            
            $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
            $q = $this->db->Select("select * from sup_person where email = '$em'");
                        
            $this->id_user = $q[0]['ID'];
            
            $method = $_SERVER['REQUEST_METHOD'];
            if(method_exists($this, $method)){
                $this->$method();
            }
        }
        
        private function GET()
        {            
            if(count($_GET) <= 0){
                $this->main();
            }else{
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($_GET);
                    }
                }
            }
            $this->ajax();
        }
        
        private function POST()
        {
            foreach($_POST as $k=>$v){
                if(method_exists($this, $k)){
                    $this->$k($_POST);
                }
            }
            
            $this->ajax();
        }
        
        private function ajax()
        {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                    echo json_encode($this->result);
                    exit;
                }
            }
        }        

        private function main()
        {
            //Список проектов
            $q = $this->db->Select("select * from PROJECT where emp_id = $this->id_user order by id");   
            
            foreach($q as $k=>$v){
                //Список вопросов
                $qs = $this->db->Select("select * from QUESTION_P where id_project = ".$v['ID']." order by ID DESC");

                //Список ответов
                foreach($qs as $t=>$d){
                    //Узнаем распределитель
                    $e = $this->db->Select("select * from QUEST_RASP where id = ".$d['ID_RASP']);                                        
                    $qs[$t]['RASP'] = $e[0];
                    $tts = $this->db->Select("select * from RESULT_P where ID_QUESTION = ".$d['ID']);                    
                    $qs[$t]['list_variants'] = $tts; 
                                                                           
                }
                $q[$k]['list_quest'] = $qs;                                                                                 
            }
            
            $this->result['list_variants'] = $tts;            
            $this->result['list_quest'] = $qs;                                         
            $this->result['projects'] = $q;                                             
            $this->result['type_projects'] = $this->db->Select("select * from DIC_TYPE_PROJECT order by id");
            $this->rasp();
         }
        
        private function save_project()
        {               
            $id = $_POST['id_project'];
            $test_name = $_POST['name_project'];
            $emp_id = $_POST['emp_id'];
            $id_type = $_POST['id_type'];
            $time_result = $_POST['time_result'];
            $state = $_POST['state'];
            $date_close = $_POST['date_close'];                                    
                                                    
            if($id == '0'){
                $sql = "INSERT INTO PROJECT (ID, NAME, EMP_ID, ID_TYPE, TIME_RESULT, STATE, DATE_CLOSE) 
                VALUES (SEQ_PROJECT.NEXTVAL, '$test_name', '$emp_id','$id_type', '$time_result', '$state', '$date_close')";
                echo $sql;
            }else{
                $sql = "update PROJECT set NAME = '$test_name', EMP_ID = '$emp_id', ID_TYPE = '$id_type', 
                TIME_RESULT = '$time_result', STATE = '$state', DATE_CLOSE = '$date_close' where id = $id";
            }
                                                
            $m = $this->db->Execute($sql);
            if($m !== true){
                echo $m;
                return false;
            }
            header("Location: project");                    
        }
                
        private function rasp()
        {
            $this->result['rasp'] = $this->db->Select("select * from quest_rasp"); 
        }

        private function new_type_quest($dan)
        {
            $text = $dan['new_type_quest'];
            $sql = "insert into QUEST_RASP(NAME_RASP) values('$text')";
            $qs = $this->db->Execute($sql);            
            $this->rasp();
        }

        private function save_quest($dan)
        {
            $name = $dan['quest_name']; 
            $rasp = $dan['quest_rasp']; 
            $otv = $dan['res_quest']; 
            $id = $dan['id_quest']; 
            $id_r = $dan['id_t']; 
            $q_pr = $dan['q_pr'];
            $correct_opt = $dan['correct_opt'];
            if($id_r == '0'){ 
                $sql = "insert into QUESTION_P(ID, ID_PROJECT, QUESTION) values(SEQ_QUEST.NEXTVAL, '$id', '$name')"; 
                $id_quest = $this -> db -> select("select * from (select * from QUESTION_P order by ID desc) where rownum = 1");
                $m = $this->db->Execute($sql);  
            //    print_r($q_pr);
                // берем id последнего вопроса с таблицы вопросов
                foreach($id_quest as $kk => $vv){ 
                            $z = $vv['ID']; 
                            $zz = $z+1;} 
                            
                  
                if(isset($dan['q_pr']))
                {
                    foreach($dan['q_pr'] as $q=>$q_pr) 
                    {
                        foreach($otv as $k => $v)
                        {
                            $sql_2 = "insert into RESULT_P(ID, ID_QUESTION, ANSWER) values(SEQ_RES.NEXTVAL, '$zz', '$v')";
                            $mm = $this->db->execute($sql_2);
                            
                            $sql_set_correct_opt = "update RESULT_P set CORRECT_ANSWER = '1' where ANSWER = '$correct_opt'";
                          //  echo $sql_set_correct_opt;
                            $mm_set_correct_opt = $this->db->execute($sql_set_correct_opt);
                        }
                    }
                }
                
                else{
                   foreach($otv as $k => $v)
                    {
                        $sql_insert_opros = "insert into RESULT_P(ID, ID_QUESTION, ANSWER) values(SEQ_RES.NEXTVAL, '$zz', '$v')";
                        $m_insert_opros = $this->db->execute($sql_insert_opros);
                    }
                }
                
                 
                                               
                if($m !== true){ 
                            echo $m; 
                            return false; } 
                            header("Location:project"); 
                            
                                                       
                if($mm != true){ 
                            echo $mm; 
                            return false; } 
                            header("Location: project"); 
                   }
                }   
                
                private function update(){ 
                    echo "<pre>";
                    print_r($_POST);
                    echo "</pre>";
                    $OTV_ID = $_POST['$OTV_ID'];
                                                        
                    $test_id = $_POST['id_proverka'];
                    $ID_UPD = $_POST['ID_UPD'];
                    $QUESTION_UPD = str_replace("'", '"', $_POST['QUESTION_UPD']);                    
                    $ANSWER_UPD =   $_POST['ANSWER_UPD'];                       
                                                                                                                                                              
                    if($test_id == '0'){   
                           $sql_to_edit_question = "UPDATE QUESTION_P SET QUESTION = '$QUESTION_UPD' where ID = $ID_UPD";
                           $a_edit_quest = $this->db->execute($sql_to_edit_question); 
                           foreach($ANSWER_UPD as $k => $v){   
                           foreach($OTV_ID as $r => $t){                                                                                                                                                                    
                                     $sql_to_edit_answer = "UPDATE RESULT_P SET ANSWER = '$v' where ID_QUESTION = $ID_UPD and ID = $t";                                     
                                     $a_edit_ans = $this->db->execute($sql_to_edit_answer);                                                                                                                          
                   }                                                                                                                                   
                 }                                                           
               }
                header("Location:project");
             } 
                                                                                                                                  
            private function delete_question(){
                  $delete_q_id = $_POST['ID_UPD_del'];
                  $delete_quest_id = "Delete QUESTION_P where id = '$delete_q_id'"; 
                  $list_quest_id = $this->db->execute($delete_quest_id);  
                  $delete_ans_id = "Delete RESULT_P where ID_QUESTION = '$delete_q_id'";
                  $list_ans_id = $this->db->execute($delete_ans_id);
                  header("Location:project");                                                                                       
            }                                                                                         
    }

    $db = new DB();
?>
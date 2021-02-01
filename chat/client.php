<?php

class ClientChat
{
    private $db;
    public $id_user;
    public $tts;
    
    public function __construct()
    {
        $this->db = new DB();
        $this->db->Execute("ALTER SESSION SET NLS_DATE_FORMAT='DD.MM.YYYY HH24:MI:SS'");
        $login = $_SESSION[USER_SESSION]['login'];        
        $q = $this->db->Select("select * from sup_person where email = '$login@gak.kz'");
        $this->id_user = $q[0]['ID'];    
        //$this->tts = $this->WSActive();    
    }
    
    private function ActionUser()
    {
        $login = $_SESSION[USER_SESSION]['login'];        
        $q = $this->db->Select("select * from sup_person where email = '$login@gak.kz'");
        $this->id_user = $q[0]['ID'];
        return $q[0]['ID'];
    }
    
    public function CountNoReadMSG()
    {        
        $q = $this->db->Select("select count(*) cnt from chat where id_user_to = $this->id_user and onread = 0");        
        return $q[0]['CNT'];
    }
    
    public function ListUsers()
    {
        $this->db->Execute("ALTER SESSION SET NLS_DATE_FORMAT='DD.MM.YYYY HH24:MI:SS'");
        
        $q = $this->db->Select("select dep_name from(select case when job_sp = 0 then branch_name(branchid) else department_name(job_sp) 
        end dep_name from sup_person where state = 2) group by dep_name order by 1");
        
        foreach($q as $k=>$v){
            $s = $this->db->Select("select * from(
                select 
                    id,
                    lastname,
                    firstname,
                    middlename,
                    branchid,
                    job_sp,
                    job_position,
                    case 
                        when job_sp = 0 then branch_name(branchid) 
                        else department_name(job_sp) 
                    end dep_name,
                    dolzh_name(job_position) dolzhnost
                from 
                    sup_person 
                where 
                    state = 2
                    and id <> $this->id_user
                )
                where dep_name = '".$v['DEP_NAME']."'    
                order by job_position
            ");     
            $q[$k]['users'] = $s;       
        }
        return $q;
    }
    
    public function ListMsg($id)
    {
        $dan = array();
        $q = $this->db->Select("select 
                    id,
                    lastname||' '||firstname fio,                    
                    case 
                        when job_sp = 0 then branch_name(branchid) 
                        else department_name(job_sp) 
                    end||'<br /> '||dolzh_name(job_position) dep_name
                from 
                    sup_person 
                where id = $id");
        $dan['user'] = $q[0];
        
        $q = $this->db->Select("select 
                    id,
                    lastname||' '||firstname fio,                    
                    case 
                        when job_sp = 0 then branch_name(branchid) 
                        else department_name(job_sp) 
                    end||'<br /> '||dolzh_name(job_position) dep_name
                from 
                    sup_person 
                where id = $this->id_user");
        $dan['my'] = $q[0];
        
        $sql = "
        select * from chat where id_user_from in($id, $this->id_user) 
        and id_user_to in($id, $this->id_user)  
        order by date_send
        ";
        $dan['chat'] = $this->db->Select($sql);
        return $dan;
    }
    
    public function SaveMessage($user_from, $user_to, $message)
    {
        $msg = base64_encode($message);
        $sql = "INSERT INTO CHAT (ID_USER_FROM, ID_USER_TO, DATE_SEND, MSG, ONREAD) 
        VALUES ('$user_from', '$user_to', sysdate,
        '$msg', 0)";
        
        if(!$this->db->Execute($sql)){
            return false;   
        }   
        return true;
    }
    
}

?> 
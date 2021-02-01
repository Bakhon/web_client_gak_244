<?php
    $sql = "select 
    p.lastname||' '||p.firstname||' '||P.MIDDLENAME fio, 
    P.EMAIL,
    (select d_name from DIC_DOLZH where id = P.JOB_POSITION) dolgnost,
    (select name from DIC_DEPARTMENT where id = p.job_sp) department,
    e.id,
    e.text_error,
    to_char(e.date_add, 'dd.mm.yyyy HH24:MI:ss') date_add,    
    e.id_users_answer,
    to_char(e.date_answer, 'dd.mm.yyyy HH24:MI:ss') date_answer, 
    e.url_error,    
    sp.lastname||' '||sp.firstname||' '||sp.MIDDLENAME fio_answer, 
    sp.EMAIL email_answer,
    (select d_name from DIC_DOLZH where id = sp.JOB_POSITION) dolgnost_answer,
    (select name from DIC_DEPARTMENT where id = sp.job_sp) department_answer     
from 
    sup_person p, 
    ERROR_SAIT e,
    sup_person sp
where 
    E.ID_USER = p.id
    and SP.ID(+) = E.ID_USERS_ANSWER
order by e.id";
	$list = $db->Select($sql);
    
    
    if(isset($_POST['set_answer_error'])){
        $l = $_SESSION[USER_SESSION]['login'];            
        $q = $db->Select("select * from sup_person where email = '$l@gak.kz'");
        $id_user = $q[0]['ID'];            
        $id = $_POST['set_answer_error'];
        
        $db->Execute("update ERROR_SAIT set id_users_answer = $id_user, date_answer = sysdate where id = $id");        
        exit;        
    }  
?>
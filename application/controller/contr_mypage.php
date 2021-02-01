<?php
    $email = trim($_SESSION[USER_SESSION]['login']);    
    $db = new DB();
    $q = $db->Select("select id from sup_person where email like '$email%'");	
    $empId = $q[0]['ID'];
    require_once 'application/controller/contr_edit_employee.php';     
?>
<?php

$db = new DB();





if(isset($_POST['Month']))
{
    $month = $_POST['Month'];
    
    $list_person = $db -> select("select * from sup_person where EXTRACT(month FROM birthdate) = $month and state in (2,3,5,6)");
    
    
}

 ?>
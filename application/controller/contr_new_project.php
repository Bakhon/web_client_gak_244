<?php

$db = new DB();

$sql_dic_type_project = "Select * from DIC_TYPE_PROJECT order by id ASC";
$list_dic_type_project = $db -> Select($sql_dic_type_project);


   

?>


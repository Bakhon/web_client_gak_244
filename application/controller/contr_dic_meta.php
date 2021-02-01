<?php
    $db = new DB();
    $sql_meta = "select * from DIC_META order by id";
    $list_meta = $db -> Select($sql_meta);
?>
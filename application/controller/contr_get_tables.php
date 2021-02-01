<?php
    $db = new DB();

    $sql = "SELECT
              table_name
            FROM
              user_tables
            ORDER BY
              table_name";
    $list_tables = $db -> Select($sql);
    foreach($list_tables as $k => $v)
    {
        $table_name = $v['TABLE_NAME'];
        echo $table_name.'<br /><br />';
        $sql = "select data_type, column_name from all_tab_columns where table_name = '$table_name'";
        $list_tables = $db -> Select($sql);
        foreach($list_tables as $k => $v)
        {
            echo $v['COLUMN_NAME'].' - '.$v['DATA_TYPE'].'<br />';
        }
        echo '<br /><br /><br />';
    }
?>
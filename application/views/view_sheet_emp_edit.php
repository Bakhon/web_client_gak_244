<?php
    if(isset($_GET['sheet_id'])){
        $sheet_id = $_GET['sheet_id'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        echo $sheet_id.' '.$month.' '.$year;
    }
?>
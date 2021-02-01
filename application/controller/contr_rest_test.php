<?php
    $IIN = $_GET['iin'];
    $db = new DB();
    //$sql_to_GBDFL = "select * from gbdfl.gbl_person_new where Upper(SURNAME) LIKE upper ('%$LASTNAMEgbdfl%') and firstname like upper ('%$FIRSTNAMEgbdfl%') and SECONDNAME like upper ('%$MIDDLENAMEgbdfl%') and rownum <= 100 order by ID";
    $sql_to_GBDFL = "select * from gbdfl.gbl_person_new where IIN = '$IIN'";
    echo $sql_to_GBDFL.'<br>';
    $list_GBDFL = $db ->Select($sql_to_GBDFL);
    //print_r($list_GBDFL);
    echo json_encode($list_GBDFL);
?>


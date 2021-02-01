<?php

$db = new DB();

$list_person = $db->select("select sp.*, d.*, st.lastname podpis_lastname, ST.FIRSTNAME podpis_firstname, st.middlename podpis_middlename from sup_person sp , dic_dolzh d, sup_person st where SP.JOB_POSITION = d.id and D.ID_PODPIS = st.id  and sp.id = 1481");

?>
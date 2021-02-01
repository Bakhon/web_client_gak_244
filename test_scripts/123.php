<?php
    phpinfo();
    exit;
    
	require_once '/application/config.php';
    require_once '/application/units/other.php';
	require_once '/application/units/action.php';    
    require_once '/application/units/database3.php';
    
    $db = new DB3();
    
    $ar = array(
        
    );
    
    $sql = "begin 
        sum_calc.calc_af_korm_KRatk_04072019(
        '98', 
        '01.09.2019', 
        '01.07.2020', 
        '05.06.1999', 
        '0', 
        '1', 
        '6', 
        :isp, 
        :isv, 
        :icnct_id_osns, 
        '2', 
        :messtavka, 
        :mesdiscfak, 
        :outaf, 
        '01.10.2019'
        ); 
    end;";
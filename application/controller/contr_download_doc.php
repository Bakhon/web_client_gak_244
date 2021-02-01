<?php
    echo '777<br>';
    
    // объявление переменных
    $local_file = 'local.xlsx';
    $server_file = 'Persons/test/app_for_job';
    
    // установка соединения
    $conn_id = ftp_connect(FTP_SERVER);
    
    // вход с именем пользователя и паролем
    $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
    
    if($login_result){echo '$login_result'.'<br>';}
    
    header("Location: ftp://192.168.5.2/Persons/test/job_contract");
    
    // закрытие соединения
    //ftp_close($conn_id);
    
?>
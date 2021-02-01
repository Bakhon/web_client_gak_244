<?php
    //загрузка документа
    //$ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
    
    if(isset($_GET['get_file']))
    {
        $dir_name = $_GET['get_file'];
        echo $dir_name.'</br>';
        $conn_id = ftp_connect(FTP_SERVER);
        echo '$conn_id = '.$conn_id.'</br>';        
        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
        //echo '$login_result = '.$login_result.'                   ';
        
        $contents = ftp_nlist($conn_id, "$dir_name");
		// вывод $contents
        echo '<pre>';
		print_r($contents);
		echo '<pre>';
        //exit;
		echo "</br>";
        
		
        //$ftp_get = ftp_get($conn_id, 'C:\Users\User\Downloads\app_for_job', "ftp://192.168.5.2/Persons/$dir_name", FTP_BINARY);
		/*if(!ftp_get($conn_id, 'C:\Users\User\Downloads\3', "$dir_name/1", FTP_BINARY))
        {
		  echo "$dir_name/304[1]</br>";
		  echo 'Ошибка скачивания</br>';
		}*/
		
        // define some variables
        $local_file = '/right_icon.jpg';
        $server_file = '/right_icon.jpg';
        $ftp_server=FTP_SERVER;
        $ftp_user_name="upload";
        $ftp_user_pass="Astana2014";
        
        if(!$conn_id = ftp_connect($ftp_server))
        {
            echo 'connect problem';
        }
        
        // login with username and password
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        
        // try to download $server_file and save to $local_file
        if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
            echo "Successfully written to $local_file";
        }
        else {
            echo "There was a problem\n";
        }
        
        //echo '$ftp_get = '.$ftp_get.'                   ';
        ftp_close($conn_id);
        exit;
    }
    
    if(isset($_POST['get_file']))
    {
        $conn_id = ftp_connect(FTP_SERVER);
        echo '$conn_id = '.$conn_id.'                   ';  
        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
        echo '$login_result = '.$login_result.'                   ';
        $contents = ftp_nlist($conn_id, "/Persons/test");
        var_dump($contents);
        $ret = ftp_nb_get($conn_id, 'C:\Users\User\Downloads\app_for_job' , 'Persons/test/app_for_job', FTP_BINARY);
        if ($ret != FTP_FINISHED) {
           echo "При скачивании файла произошла ошибка...";
        }else{
            echo 'Все норм';
        }
        
        echo '$ftp_get = '.$ftp_get.'                   ';
        ftp_close($conn_id);
        exit;
    }
    
    
    // Здесь нужно сделать все проверки передаваемых файлов и вывести ошибки если нужно
     
    // Переменная ответа
 
    $data = array();

    if(count($_POST['file_test'])){
        $error = false;
        $files = array();
        
        echo '777';        
        print_r($_FILES);
    }        
?>
















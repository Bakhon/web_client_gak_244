<?php    
	if(!isset($_GET['f'])){
	   exit;
	}
        
    
    $file = $_GET['f'];
        
    $l = explode('/', $file);    
    foreach($l as $lp){
        $local_file = $lp;
    }        
    //$file=iconv("Windows-1251","UTF-8", $file);
    //$file=urlencode($file);
    
    /*
    $fh = fopen($local_file, 'w');
    
    $curl = curl_init();    
    curl_setopt($curl, CURLOPT_URL, "ftp://192.168.5.2".$file); #input
    curl_setopt($curl, CURLOPT_FILE, $fh); #output
    curl_setopt($curl, CURLOPT_USERPWD, "upload:Astana2014");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($curl);
    fclose($fn);
    exit;
    */
    
    $conn_id = ftp_connect(FTP_SERVER);
    $login_result = ftp_login($conn_id, FTP_USER, FTP_PASS);
    
    $s = ftp_put($conn_id, $local_file, $file, FTP_BINARY); 
    var_dump($s);
    exit;
    
    if($s) {
        echo "Произведена запись в $local_file\n";
    } else {
        echo "Не удалось завершить операцию\n";
    }    
    ftp_close($conn_id);
    exit;
    
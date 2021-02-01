<?php
	function SqlInject($param){
        $param = stripslashes($param); 
        //$param = mysql_real_escape_string($param); 
        $param = trim($param); 
        $param = htmlspecialchars($param); 
        return $param; 
    }
    
    function SetTextGetArray($arrayname){
        if(isset($_GET[$arrayname])){
            return $_GET[$arrayname];
        }else{
            return '';
        }
    }
    
    function SetBoolGetArray($arrayname, $params)
    {
        if(isset($_GET[$arrayname])){
            if($_GET[$arrayname] == $params){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    function StrToFloat($s){
        return floatval(str_replace(",", ".", $s));
    }
    
    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb"); 
        $data = explode(',', $base64_string);
        fwrite($ifp, base64_decode($data[1])); 
        fclose($ifp); 
        return $output_file; 
    }
    
    function BoolTostrRus($b){
        if($b == false){
            return 'Нет';
        }else{
            return 'Да';
        }
    }
    
    function BoolToInt($b)
    {
        if($b == false){
            return 0;
        }else{
            return 1;
        }
    }
    
    Function HTTP_URL_image_user($text)
    {
        if ($text == ''){
            return HTTP_NO_IMAGE_USER;
        }else{
            $txt = substr($text, 1, 4);        
            if($txt = 'http'){
                if (@fopen($text, "r")) {
                    return $text;
                }else return HTTP_NO_IMAGE_USER;
            }else {
                if (@fopen(HTTP_IMAGE.$text, "r")){
                    return HTTP_IMAGE.$text;    
                }else return HTTP_NO_IMAGE_USER;
            }
        }
    }
    
    function str_replace_kaz($text)
    {
        $kz1 = array("ј", "і", "ѕ", "є", "ї", "ў", "ќ", "ґ", "ћ", "Ј", "І", "Ѕ", "Є", "Ї", "Ў", "Ќ", "Ґ", "Ћ");
        $kz2 = array("ә", "і", "ң", "ғ", "ү", "ұ", "қ", "ө", "һ", "Ә", "І", "Ң", "Ғ", "Ү", "Ұ", "Қ", "Ө", "Һ");
        $txt = str_replace($kz1, $kz2, $text);
        //јіѕєїўќґћ ЈІЅЄЇЎЌҐЋ
        //әіңғүұқөһ ӘІҢҒҮҰҚӨҺ
        return $txt;        
    }
    
    function nvl($p1, $p2)
    {
        if(trim($p1) == ''){
            return $p2;
        }
        return $p1;    
    }
    
    function SetChecked($id)
    {
        if($id == 1){
            echo 'checked';
        }else{
            if($id == ''){
                echo  'checked';
            }else
            echo '';
        }        
    }
    
    function OnToNumber($s, $on, $off)
    {
        if($s == 'on'){
            return $on;
        }else{
            return $off;
        }
    }
    
    function consolExit($dan)
    {
        echo '<pre>';
        print_r($dan);
        echo '</pre>';
        exit;
    }
    
    function NumberRas($int)
    {
        $int = str_replace(',', '.', $int);
        if($int == ''){
            return '';
        }
        $txt  = number_format($int, 2, ',', ' ');
        
        if(substr($txt, -3) == ',00'){
            $txt = str_replace(',00', '', $txt);
        }
        
        return $txt;
    }
    
    function pr($dan, $exit = 0)
    {
        echo '<pre>';
        print_r($dan);
        echo '</pre>';
        if($exit > 0){
            exit;
        }
    }
    
    function downloadftp($ftp_server, $ftp_user, $ftp_pass, $filename)
    {
        $conn_id = ftp_connect($ftp_server);
        $login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);
        if($login_result){
            ftp_pasv($conn_id, true);
        }else{
            return false;
            exit;
        }
        
        $s = explode(".", $filename);
        $l = count($s)-1;
        $ras = $s[$l];            
        $local_file = date("YmdHis").".$ras";
        
        $link_filename = $filename;
        
        $e = ftp_get($conn_id, $local_file, $link_filename, FTP_BINARY);
        if(!$e){
            $link_filename = iconv('utf-8', 'windows-1251', $filename);
            $e = ftp_get($conn_id, $local_file, $link_filename, FTP_BINARY); 
        }

        if($e){
            $file_size = filesize($local_file);
            $filetype = filetype($local_file);
            
            header("Content-type: ".$filetype);
            header("Content-Disposition: attachment;Filename=".$local_file);        
            header('Content-Length: ' . $file_size);

            readfile($local_file);
            unlink($local_file);
        }else{
            //echo '<center><h1>Файл не найден</h1></center>';
            return false;
        }
        exit;
    }
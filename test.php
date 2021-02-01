<?php
  
    
    require_once __DIR__.'/application/config.php';
    require_once __DIR__.'/application/units/other.php';
    require_once __DIR__.'/application/units/database.php';
    
    $db = new DB();    
    
    if(isset($_GET['file'])){
        $q = $db->Select("select * from site_files where id = ".$_GET['file']);
        $q = $q[0];
        
        $conn_id = ftp_connect(FTP_SERVER);
        $login_result = ftp_login($conn_id, FTP_USER, FTP_PASS);
        if($login_result){
            ftp_pasv($conn_id, true);
        }else{
            echo 'Ошибка подключения';
            exit;
        }
        
        $local_file = $q['FILE_NAME'];
        
        $e = ftp_get($conn_id, $local_file, '/site/'.$q['FILE_NAME'], FTP_BINARY);
        if($e){
            header("Content-type: ".$q['FILE_TYPE']);
            header("Content-Disposition: attachment;Filename=".$q['FILE_NAME']);        
            header('Content-Length: ' . $q['FILE_SIZE']);
                    
            readfile(__DIR__.'/'.$q['FILE_NAME']);
            unlink(__DIR__.'/'.$q['FILE_NAME']);
        }else{
            echo '<center><h1>Файл не найден</h1></center>';
        }
        exit;
    }
    
    
    
    if(isset($_FILES['load_file'])){
        $f = $_FILES['load_file'];
        $name = $f['name'];
        $def_name = $f['name'];
        $type = $f['type'];
        $size = $f['size'];
                
        $tmp = $f['tmp_name'];
        
        $ps = explode('.', $name);
        $i = count($ps)-1;
        $rs = $ps[$i];
        
        $name = date("YmdHis").'.'.$rs;
        
        $uploaddir = '\\\192.168.5.2\insurance_life_files\site\\';         
        $uploadfile = $uploaddir . $name;
        
        if(move_uploaded_file($tmp, $uploadfile)){
            $sql = "INSERT INTO SITE_FILES (FILE_TYPE, FILE_SIZE, FILE_NAME, DEFAULT_NAME) VALUES ('$type', '$size', '$name', '$def_name')";
            $db->Execute($sql);
            echo 'Yes';
        }else{
            echo 'NO';
        }        
    }

?>	

<form method="post" enctype="multipart/form-data">
    <input type="file" name="load_file"/>
    <input type="submit" value="Загрузить"/>
</form>

<?php
    $list = $db->Select("select * from site_files");
    foreach($list as $k=>$v){
        echo '<a href="test.php?file='.$v['ID'].'" target="_blank">'.$v['DEFAULT_NAME'].'</a><br />';
    }
?>
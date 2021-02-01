<?php
    /**
     *  @param $id обязательный параметр для поиска, добавления, удаления, и проверки файлов в договоре    
     *  @param $isfile Проверка на существование файла
     *  @param $load Скачивание файла
     *  
     *  В случаи если идет проверка файла на существование тогда возврат будет true/false 
     *  @return bool
     * 
     *  
     */
 
    //if(count($_GET) == 0){exit;}
    
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
    
    $db = new DB3();
    if(isset($_GET['cnct_id'])){
        
        $cnct_id = $_GET['cnct_id'];
        $sql = "
            select cnct_id, paym_code, progr_name(paym_code) progr_name, level_r from contracts where cnct_id = $cnct_id
            union all
            select cnct_id, paym_code, progr_name(paym_code) progr_name, level_r from contracts_maket where cnct_id = $cnct_id
        ";
        $r = $db->Select($sql);        
        $r = $r[0];
            
        $files = $db->Select("select d.*, level_name(d.ID_ROLE) level_name, r.NAME otvetstv, c.id id_cf, c.CNCT_ID, c.ID_FILES, c.FILENAME, C.NOTE 
        from  dic_fails d, dir_role r, CONTRACTS_FILES c  where  d.ID_ROLE = r.ID and c.ID_FILES(+) = d.ID 
        and c.CNCT_ID(+) = $cnct_id
        and d.PAYM_CODE = substr('".$r['PAYM_CODE']."', 1, 2) 
        and d.LEVEL_R = ".$r['LEVEL_R']." order by d.ID");
    }
    
    if(isset($_POST['path_name'])){
        if(!$ftp->create_path($_POST['path_name'])){
            $msg .= ALERTS::WarningMin("Ошибка создания папки!");
        }
    }

 
// header('Content-Type: text/html; charset=cp1251');

//if(!isset($GETS['id'])){return exit;}
//$id = $_GET['id'];



/*
$db = new DB();
$db->ClearParams();
$row = $db->Select("select * from contracts_files where id = $id");
if(count($row) <= 0){
    header('Content-Type: text/html; charset=utf-8');    
    exit;
}



$list_files = $ftp->scandir($id);
$filename = $list_files[0];
$context = $ftp->upload($filename);

$t = explode(".", $filename);
$i = COUNT($t)-1;
$type = $t[$i];
$gencode = rand(1000, 1000000);

header("HTTP/1.1 200 OK");
header("Connection: close");
header("Content-Transfer-Encoding: binary"); 
header("Content-Type: application/$type");
header("Content-Disposition: attachment; filename=$gencode.$type");
echo $context;

exit;
*/
?>
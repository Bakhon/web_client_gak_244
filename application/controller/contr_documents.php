<?php 

$db = new DB();
$document = new Document();
$ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);

$sql_id = "select SEQ_DOCUMENTS.NEXTVAL from dual";
        $list_seq = $db -> Select($sql_id);
        $id = $list_seq[0]['NEXTVAL'];
     
       
            if(isset($_POST['doc_b64']))
        {    
            
        $NAME_RUS = $_POST['NAME_RUS'];

        $emp_id = $_POST['emp_id'];
        $data = date('d.m.Y');
          
                
       $sql_to_slide = "insert into DOC_ON_USAGE (ID, NAME, DOC_ID) values 
                         (SEQ_DOC_ON_USAGE.nextval, '$NAME_RUS', $id )";       
       $list_to_slide = $db->execute($sql_to_slide);
            
            
            //создание директории по id
            if(!$ftp->create_path("doc_syst/$id"))
                    {
                        //$msg .= ALERTS::WarningMin("Ошибка создания папки!");
                        echo "Ошибка создания папки!";
                    }
            $i = 0;
            foreach ($_POST['doc_b64'] as $key=>$doc_to_mail_in_B64)
            {
                $filename = $_POST['file_name_input'][$i];
                $file = base64_decode($doc_to_mail_in_B64);
                $handle = fopen($doc_to_mail_in_B64, 'r');
                
                //создание файла по имени id
                if(count($_FILES) > 0)
                {
                    if(!$ftp->uploadfile("doc_syst/$id/", "$filename", $handle))
                    {
                        echo "Ошибка создания файла!";
                    }
                }
                $i++;
            }
        }
                                                                                                                                                                                                                                      
    $list = $db->select("select * from DOC_ON_USAGE");
    
    


?>
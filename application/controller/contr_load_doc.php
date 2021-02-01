<?php
if(isset($_POST['doc_file'])){
        $path = '/';
        
        $doc_name = $_POST['doc_file'];
        $logo = $path.$_FILES['doc_file']['name'];
        
        echo $doc_name.'</br>';
        echo $path.'</br>';
        echo $logo;
        /*$sqlExp = "insert into person_stazh (ID, ID_PERSON, DATE_BEGIN, DATE_END, P_NAME, P_DOLZH, P_ADDRESS) 
                                         values (PERSON_STAZH_SEQ.nextval, 
                                                 '$idPersExp', 
                                                 '$expStartDate',
                                                 '$expEndDate',
                                                 '$P_NAME',
                                                 '$P_DOLZH',
                                                 '$P_ADDRESS'
                                                 )";
        $listExp = $db -> Execute($sqlExp);*/
        

    // Обработка запроса
    /*if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    	// Загрузка файла и вывод сообщения
    	if (!@copy($_FILES['image_file']['tmp_name'], $path.$_FILES['image_file']['name']))
    		echo 'Что-то пошло не так';
    	else
    		echo 'Загрузка удачна';
            echo $_FILES['image_file']['name'].'</br>';
               
             include('classSimpleImage.php');
               $image = new SimpleImage();
               $image->load($_FILES['image_file']['name']);
               $image->resize(400, 200);
               $image->save($path.'aftrsz/'.$_FILES['image_file']['name']);
    }*/
        exit;
    }
?>
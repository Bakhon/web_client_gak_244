<?php
    $db = new DB();
    $document = new Document();
    

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    $emp_fio = $_SESSION['insurance']['fio'];
    $step_id = $_GET['step_id'];
    $state_id = $_GET['state_id'];
    if(isset($_GET['table_name_eng']))
    {
    $state_table_name = $_GET['table_name_eng'];
  }
    $conn_id = ftp_connect(FTP_SERVER);      
    $login_result = ftp_login($conn_id, 'upload', 'Astana2014');

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);
    $dest_id = $_GET['dest_id'];

    $sql_sender_mail = "select * from DOC_TRIP_STEPS where ID = '$step_id'";
    $list_sender_mail = $db -> Select($sql_sender_mail);

    $trip_id = $list_sender_mail[0]['TRIP_ID'];

    $step_info = $document->get_next_and_prev_step($trip_id, $step_id);
    $prev_step_id = $step_info[0]['ID_PREV'];
    $next_step_id = $step_info[0]['ID_NEXT'];
     
                                                                                 

    if(isset($_GET['doc_id']))
    {
        $doc_id = $_GET['doc_id'];
        if(isset($_GET['rec_id']))
        {
        $rec_id = $_GET['rec_id'];
        } else { $rec_id = '0';}
        $sql_mail = "select * from DOCUMENTS where id = $doc_id";
        $list_mail = $db -> Select($sql_mail);
        $reg_ishod = $list_mail[0]['REG_NUM'];
        
        $sql_state = "select * from DOC_RECIEPMENTS where ID = '$rec_id'";    
        $list_state = $db -> Select($sql_state);
        $doc_state = $list_state[0]['STATE'];
        if($doc_state == 0)
        {
            $sql_read = "update $state_table_name set READ = 2, STATE = 1 where ID = '$rec_id'";
            $list_read = $db -> Select($sql_read);
        }
        $list_mail_state = get_all_property($doc_id);       
        foreach($list_mail as $k => $v)
        {               
           
        } 
        
        $reg = $v['REG_NUM'];        
        $date_start = $v['DATE_START'];        
    }

    if(isset($_POST['COMMENT']))
    {
        $doc_id = $_GET['doc_id'];
        $mail_id = $_GET['doc_id'];
        $REC_ID = $_POST['REC_ID'];
        $comment = $_POST['COMMENT'];
        $state = $_POST['STATE'];
        $comment_date = $_POST['COMMENT_DATE'];
        $comment_time = $_POST['COMMENT_TIME'];
        $reg_num = $_POST['REG_NUM'];
        $order_num = $_POST['ORDER_NUM'];
        $short_text = $_POST['SHORT_TEXT'];

        $SENDER_MAIL_COMMENT = $_POST['SENDER_MAIL_COMMENT'];

        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');

        if(isset($_POST['REG_NUM']))
        {
            $reg_num = $_POST['REG_NUM'];
            $sql_reg_num = "update DOCUMENTS set REG_NUM = '$reg_num' where ID = '$doc_id'";
            $list_reg_num = $db -> Select($sql_reg_num);
        }

        //отправить на утверждение
        if($state == 0)
        {
            $reciep_mail = $_POST['RECIPIENT'];
            $SHORT_TEXT = $_POST['SHORT_TEXT'];
            
            $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '12' where ID = '$REC_ID'";
            $list_upd_state = $db -> Select($sql_upd_state);

            $sql_reciep = "INSERT INTO DOC_RECIEPMENTS 
            (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, COMMENT_TO_DOC, DESTINATION) 
            VALUES
            (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$mail_id', '$reciep_mail', '$state', '$emp_mail', '$today_date', '$now_time', '$comment', '3')";
            $list_reciep = $db -> Select($sql_reciep);

            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_step_id', NEXT_STEP_ID = '0', PREV_STEP_ID = '$step_id' WHERE ID = '$mail_id'";
            $list_change_step = $db -> Select($sql_change_step);
        }

        //Завершено
        if($state == 3)
        {
                $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '2' where ID = '$REC_ID'";
               // echo $sql_upd_state;
                $list_upd_state = $db -> Select($sql_upd_state);

                check_other_reciepments($doc_id, $next_step_id, $step_id);

                if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio завершил письмо № $reg от $date_start с коротким описанием $short_text, добавив комментарий $comment. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&step_id=13");                                
              //  mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio завершил письмо с коротким описанием '$short_text', добавив комментарий '$comment'. Для ознакомления пройдите по ссылкк http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&step_id=13", "From: Система электронного документооборота");
              //  mail("d.nurkeibekova@gak.kz", 'Уведомление в СЭД', "Сотрудник $emp_fio подписал и прислал на присвоение регистрационного номера документ, с коротким описанием '$short_text', добавив комментарий '$comment'. Для ознакомления пройдите по ссылке   http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&step_id=13", "From: Система электронного документооборота");
                
        }

        //Отклонено
        if($state == 4)
        {
                reject_mail($doc_id);
                $table_name_eng = $_GET['table_name_eng'];

                $sql_change_step = "UPDATE $table_name_eng SET COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = 3 WHERE ID = '$REC_ID'";
                $list_change_step = $db -> Select($sql_change_step);

                $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '', NEXT_STEP_ID = '', PREV_STEP_ID = '', STATE = '6' WHERE ID = '$mail_id'";
                $list_change_step = $db -> Select($sql_change_step);
                
                    $list_mail_uvedom = get_all_property($doc_id);
                    $count = count($list_mail_uvedom); 
                    
                    $i = 0;   
                   while($i<$count){
                    $mail_rec =  $list_mail_uvedom[$i]['RECIEP_MAIL'];                                        
                    $document->sendmail($mail_rec, 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил письмо с коротким описанием $short_text, добавив комментарий $comment. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&step_id=13");
                 //   mail("$mail_rec", 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил письмо с коротким описанием '$short_text', добавив комментарий '$comment'. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&step_id=13  ", "From: Система электронного документооборота");
                    $i++;
                   }  
    
                if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz')  $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил письмо с коротким описанием $short_text, добавив комментарий $comment. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&step_id=13");                                
            //    mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил письмо с коротким описанием '$short_text', добавив комментарий '$comment'. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&step_id=13  ", "From: Система электронного документооборота");
        }

        //Согласовано
        if($state == 5)
        {
                $sql_upd_state = "update DOC_RECIEPMENTS_AGREEMENT set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '2' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state); 

                check_other_agreement($doc_id, $next_step_id, $step_id);

                $sql_upd_state = "update DOC_RECIEPMENTS_ASSIGNMENT set COMMENT_TO_DOC = '', STATE = '4' where MAIL_ID = '$mail_id' and SENDER_MAIL = '$emp_mail'";
                $list_upd_state = $db -> Select($sql_upd_state);

                if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio согласовал письмо с коротким описанием $short_text, добавив комментарий $comment. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=&dest_id=");                                
              //  mail("$SENDER_MAIL_COMMENT", "Уведомление в СЭД", "Сотрудник $emp_fio согласовал письмо с коротким описанием '$short_text', добавив комментарий'$comment'. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=&dest_id= ", "From: Система электронного документооборота");
        }

        //Утверждено
        if($state == 7)
        {
                $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '7' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state);

                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$doc_id', 'd.nurkeibekova@gak.kz', '0', '$emp_mail', '$today_date', '$now_time', '7')";
                $list_reciep = $db -> Select($sql_reciep);

                $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id' WHERE ID = '$mail_id'";
                $list_change_step = $db -> Select($sql_change_step);

                if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio утвердил письмо с коротким описанием $short_text, добавив комментарий $comment.");                                
             //   mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio утвердил письмо с коротким описанием '$short_text', добавив комментарий '$comment'.", "From: Система электронного документооборота");
        }

        //Запрос удовлетворен
        if($state == 8)
        {
                $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '8' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state);

                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$doc_id', 'a.ibrayeva@gak.kz', '0', '$emp_mail', '$today_date', '$now_time', '8')";
                $list_reciep = $db -> Select($sql_reciep);

                complete_mail($mail_id, $next_step_id);

                //если есть подгруженный файл то отправляем его на ftp сервер
                if(isset($_POST['doc_b64'])){
                    //создание директории по id
                    if(!$ftp->create_path("doc_syst/answer_docs/$REC_ID"))
                            {
                                //$msg .= ALERTS::WarningMin("Ошибка создания папки!");
                                //echo "Ошибка создания папки!<br>";
                            }
                    $i = 1;
                    foreach ($_POST['doc_b64'] as $key=>$doc_to_mail_in_B64)
                    {
                        $str = explode('.', $doc_to_mail_in_B64);
                        $format = end($str);
                        $file = base64_decode($doc_to_mail_in_B64);
                        $handle = fopen($doc_to_mail_in_B64, 'r');
                        
                        //создание файла по имени id
                        $ftp->uploadfile("doc_syst/answer_docs/$REC_ID/", "$i.$format", $handle);
                        $i++;
                    }
                }
        }

        //Присвоен регистрационный номер
        if($state == 9)
        {
                $sql_upd_state = "update DOC_RECIEPMENTS_REGIST_OUT set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '2' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state);

                $sql_change_step = "UPDATE DOCUMENTS SET REG_NUM = '$reg_num', STATE = '7' WHERE ID = '$doc_id'";
                $list_change_step = $db -> Select($sql_change_step);

                if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio присвоил регистрационный номер $reg_num к письму с коротким описанием $short_text, добавив комментарий $comment.");                                
             //   mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio присвоил регистрационный номер '$reg_num' к письму с коротким описанием '$short_text', добавив комментарий '$comment'.", "From: Система электронного документооборота");
        }

        //Ознакомлен
        if($state == 10)
        {
            
               $sql_upd_state = "update DOC_RECEIP_USAGE set state = 2, POST_DATE = '$today_date', POST_TIME = '$now_time', COMMENT_TO_DOC = '$comment' where MAIL_ID = $doc_id and RECIEP_MAIL = '$emp_mail'";
               $list_upd_state = $db->execute($sql_upd_state);
               
            //   $sql_change_state = "update documents set state = 7 where id = $doc_id";
            //   $list_change_state = $db->execute($sql_change_state);
               
               //mail('b.abdisamat@gak.kz', 'Уведомление в СЭД', "Сотрудник $emp_fio ознакомился с письмом", "From: Система электронного документооборота");
            
              /*  $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '10' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state);

                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$doc_id', 'a.ibrayeva@gak.kz', '0', '$emp_mail', '$today_date', '$now_time', '8')";
                $list_reciep = $db -> Select($sql_reciep);

                $sql_change_step = "UPDATE DOCUMENTS SET REG_NUM = '$reg_num', CURRENT_STEP_ID = '$next_step_id', NEXT_STEP_ID = '0', PREV_STEP_ID = '$step_id' WHERE ID = '$mail_id'";
                $list_change_step = $db -> Select($sql_change_step);

                complete_mail($mail_id, $next_step_id);
                */
        }

        //Тех. заявка согласована
        if($state == 11)
        {
                $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '11' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state);
                
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$doc_id', 'n.kulzhanov@gak.kz', '0', '$emp_mail', '$today_date', '$now_time', '11')";
                $list_reciep = $db -> Select($sql_reciep);
                
                $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id' WHERE ID = '$mail_id'";
                $list_change_step = $db -> Select($sql_change_step);
        }

        //Приказ утвержден
        if($state == 13)
        {
                $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '13' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state);
                
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$doc_id', 'a.ibrayeva@gak.kz', '0', '$emp_mail', '$today_date', '$now_time', '13')";
                $list_reciep = $db -> Select($sql_reciep);
                
                $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id' WHERE ID = '$mail_id'";
                $list_change_step = $db -> Select($sql_change_step);
        }

        //Присвоен регистрационный номер
        if($state == 14)
        {
                $reciep_mail = $_POST['RECIPIENT'];

                $sql_upd_state = "update DOC_RECIEPMENTS set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '14' where ID = '$REC_ID'";
                $list_upd_state = $db -> Select($sql_upd_state);

                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$doc_id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time', '14')";
                $list_reciep = $db -> Select($sql_reciep);

                $sql_change_step = "UPDATE DOCUMENTS SET REG_NUM = '$reg_num', ORDER_NUM = '$order_num', CURRENT_STEP_ID = '$next_step_id', NEXT_STEP_ID = '0', PREV_STEP_ID = '$step_id' WHERE ID = '$mail_id'";
                $list_change_step = $db -> Select($sql_change_step);

                if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Канцелярия присвоила регистрационный номер $reg_num к письму с коротким описанием $short_text, добавив комментарий $comment.");                                
            //    mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Канцелярия присвоила регистрационный номер '$reg_num' к письму с коротким описанием '$short_text', добавив комментарий'$comment'.", "From: Система электронного документооборота");
        }

        //поручение выполнено
        if($state == 15)
        {
            $sql_upd_state = "update DOC_RECIEPMENTS_ASSIGNMENT set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '2' where ID = '$REC_ID'";
            $list_upd_state = $db -> Select($sql_upd_state);

            check_other_assignment($doc_id, $next_step_id, $step_id);

            if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
            $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД',  "Сотрудник $emp_fio завершил поручение с коротким описанием $short_text, добавив комментарий $comment.");                        
        //    mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio завершил поручение с коротким описанием '$short_text', добавив комментарий'$comment'.", "From: Система электронного документооборота");
        }

        //резолюция утверждена
        if($state == 16)
        {
            $sql_upd_state = "update DOC_RECIEPMENTS_RESOLUTION set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '2' where ID = '$REC_ID'";
            $list_upd_state = $db -> Select($sql_upd_state);

            set_resolution($doc_id);
            foreach ($_POST['RECIPIENT'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME, DESTINATION, COMMENT_TO_DOC) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$doc_id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time', '2', '$comment')";
                $list_reciep = $db -> Select($sql_reciep);
                if($reciep_mail == 'g.amerkhojayev@gak.kz') $reciep_mail = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($reciep_mail,  'Уведомление в СЭД', "Сотрудник $emp_fio утвердил резолюцию с комментарием $comment. Для ознакомления пройдите по ссылке http://192.168.5.244/on_inbox_new.");                                
             //   mail("$reciep_mail", 'Уведомление в СЭД', "Сотрудник $emp_fio утвердил резолюцию с комментарием '$comment'. Для ознакомления пройдите по ссылке http://192.168.5.244/on_inbox_new.", "From: Система электронного документооборота");
               
            }

            foreach ($_POST['RECIEPMENTS_CONTROL'] as $key=>$reciep_mail)
            {
                $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_CONTROL (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, RECIEP_DATE, RECIEP_TIME) VALUES (SEQ_DOC_RECIEPMENTS_CONTROL.NEXTVAL, '$doc_id', '$reciep_mail', '0', '$emp_mail', '$today_date', '$now_time')";
                $list_reciep = $db -> Select($sql_reciep);
                if($reciep_mail == 'g.amerkhojayev@gak.kz') $reciep_mail = 'e.zhanaberdinova@gak.kz';
                $document->sendmail($reciep_mail, 'Уведомление в СЭД', "Сотрудник $emp_fio отправил Вам на контроль с коротким описанием $short_text, добавив комментарий $comment. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&dest_id=&step_id=00&next_step_id=84&state_id=00&prev_step_id=0");                                
           //     mail("$reciep_mail", 'Уведомление в СЭД', "Сотрудник $emp_fio отправил Вам на контроль с коротким описанием '$short_text', добавив комментарий '$comment'. Для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=$REC_ID&dest_id=&step_id=00&next_step_id=84&state_id=00&prev_step_id=0", "From: Система электронного документооборота");
            }
        }

        //подписан документ
        if($state == 17)
        {
            $select_author_id = "select dep.REG_NUM_ID, trivial.ID, trivial.JOB_POSITION, trivial.JOB_SP from sup_person trivial, DIC_DEPARTMENT dep where trivial.EMAIL = '$emp_mail' and dep.ID = trivial.JOB_SP";
            $list_author_id = $db -> Select($select_author_id);
            $REG_NUM_ID = $list_author_id[0]['REG_NUM_ID'];
            
            $sql_reg_num_seq = "select SEQ_REG_NUM_OUT.nextval from dual";
            $list_reg_num_seq = $db -> Select($sql_reg_num_seq);
            $reg_num_next_val = $list_reg_num_seq[0]['NEXTVAL'];
            
            $regn = $REG_NUM_ID.'/'.$reg_num_next_val;
            
            
            $sql_upd_state = "update DOC_RECIEPMENTS_SIGNATURE set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '2' where ID = '$REC_ID'";
            $list_upd_state = $db -> Select($sql_upd_state);

            $sql_upd_state = "update DOC_RECIEPMENTS_REGIST_OUT set STATE = '0' where MAIL_ID = '$doc_id'";
            $list_upd_state = $db -> Select($sql_upd_state);

            $sql_upd_state = "update DOCUMENTS set STATE = '10', REG_NUM = '$regn' where ID = '$doc_id'";
            $list_upd_state = $db -> Select($sql_upd_state);

            if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
            $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio подписал документ с коротким описанием $short_text, добавив комментарий $comment");            
          //  mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio подписал документ с коротким описанием '$short_text', добавив комментарий '$comment'.", "From: Система электронного документооборота");
       //     mail("d.nurkeibekova@gak.kz", 'Уведомление в СЭД', "Сотрудник $emp_fio подписал и прислал на присвоение регистрационного номера документ, с коротким описанием '$short_text', добавив комментарий '$comment'.", "From: Система электронного документооборота");
            $document->sendmail('d.nurkeibekova@gak.kz', 'Уведомление в СЭД', "Сотрудник $emp_fio подписал и прислал на присвоение регистрационного номера документ, с коротким описанием $short_text, добавив комментарий $comment. Для ознакомления пройдите по ссылке   http://192.168.5.244/mail_detail?doc_id=$doc_id&get_file=$doc_id&rec_id=134&dest_id=2&step_id=21&next_step_id=&state_id=7&prev_step_id=20&table_name_eng=DOC_RECIEPMENTS_REGIST_OUT");              
           //  mail("d.nurkeibekova@gak.kz", 'Уведомление в СЭД', "Сотрудник $emp_fio подписал и прислал на присвоение регистрационного номера документ, с коротким описанием '$short_text', добавив комментарий '$comment'. Для ознакомления пройдите по ссылке   http://192.168.5.244/mail_detail?doc_id=$doc_id&get_file=$doc_id&rec_id=134&dest_id=2&step_id=21&next_step_id=&state_id=7&prev_step_id=20&table_name_eng=DOC_RECIEPMENTS_REGIST_OUT", "From: Система электронного документооборота");
        }
        
        
        

        //поручение отклонено 
        if($state == 18)
        {
            $sql_upd_state = "update DOC_RECIEPMENTS_ASSIGNMENT set COMMENT_TO_DOC = '$comment', POST_DATE = '$comment_date', POST_TIME = '$comment_time', STATE = '3' where ID = '$REC_ID'";
            $list_upd_state = $db -> Select($sql_upd_state);

            $sql_upd_state = "select SENDER_MAIL from DOC_RECIEPMENTS_ASSIGNMENT where ID = '$REC_ID'";
            $list_upd_state = $db -> Select($sql_upd_state);

            $SENDER_MAIL_COMMENT = $list_upd_state[0]['SENDER_MAIL'];
            if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
            $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил документ с коротким описанием $short_text, добавив комментарий '$comment'.");
         //   mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил документ с коротким описанием '$short_text', добавив комментарий '$comment'.", "From: Система электронного документооборота");
        }

        //поручение отклонено
        if($state == 19)
        {
            agree_by_order($doc_id, $next_step_id, $step_id, $comment);

            $SENDER_MAIL_COMMENT = $list_upd_state[0]['SENDER_MAIL'];
            if($SENDER_MAIL_COMMENT == 'g.amerkhojayev@gak.kz') $SENDER_MAIL_COMMENT = 'e.zhanaberdinova@gak.kz';
            $document->sendmail($SENDER_MAIL_COMMENT, 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил документ с коротким описанием $short_text, добавив комментарий $comment.");
        //    mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "Сотрудник $emp_fio отклонил документ с коротким описанием '$short_text', добавив комментарий '$comment'.", "From: Система электронного документооборота");
        }

        if($state == 20)
        {
            $document->sendmail('i.gabdusheva@gak.kz', 'Ошибка в СЭД', "Ошибка в письме с ID - $doc_id, REC_ID - $REC_ID, comment - '$comment', date - $today_date, time - $now_time, sender - $emp_fio");
          //  mail("i.akhmetov@gak.kz", 'Ошибка в СЭД', "Ошибка в письме с ID - $doc_id, REC_ID - $REC_ID, comment - '$comment', date - $today_date, time - $now_time, sender - $emp_fio", "From: Система электронного документооборота");
          //  mail("i.gabdusheva@gak.kz", 'Ошибка в СЭД', "Ошибка в письме с ID - $doc_id, REC_ID - $REC_ID, comment - '$comment', date - $today_date, time - $now_time, sender - $emp_fio", "From: Система электронного документооборота");
          //  mail("b.abdisamat@gak.kz", 'Ошибка в СЭД', "Ошибка в письме с ID - $doc_id, REC_ID - $REC_ID, comment - '$comment', date - $today_date, time - $now_time, sender - $emp_fio", "From: Система электронного документооборота");
        }

        if($state != 20)
        {
            header('Location: on_inbox_new');
        } 
        
        
    }

    if(isset($_GET['get_file']))
    {
        $dir_name = $_GET['get_file'];
        
        $list_link = $db->select("select * from doc_receip_usage where mail_id = $dir_name");
        
        if($list_link)
        {
            $dir_name = $list_link[0]['LINK_FILE'];
        } 
        
      
		$contents = ftp_nlist($conn_id, "doc_syst/$dir_name/");

   /*     $ftp_get = ftp_get($conn_id, 'C:\Users\User\Downloads\app_for_job', 'ftp://192.168.5.2/Persons/test/job_contract', FTP_BINARY);
		if(!ftp_get($conn_id, 'app_for_job', '/Persons/test/./job_contract', FTP_BINARY)){
			//echo 'NO';
		} */

        $sql_upd_state = "select * from DOC_OTHER_DOC_LINK where MAIL_ID = '$doc_id'";
        $contents_added = $db -> Select($sql_upd_state);
    }
        else
    {
        echo 'Ошибка!';
    }

    if(isset($_GET['set_state']))
    {
        $setting_state = $_GET['set_state'];
        $doc_id = $_GET['doc_id'];
        if(isset($_GET['rec_id'])){
            $rec_id = $_GET['rec_id'];
            $sql_upd_state = "update DOC_RECIEPMENTS set STATE = '$setting_state' where ID = '$rec_id'";
            $list_upd_state = $db -> Select($sql_upd_state);
            $sql_sender_mail = "select SENDER_MAIL from DOC_RECIEPMENTS where ID = '$rec_id'";
            $list_sender_mail = $db -> Select($sql_sender_mail);
            $sender_mail = $list_sender_mail[0]['SENDER_MAIL'];
        }
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if(isset($_POST['get_file']))
    {
        $conn_id = ftp_connect(FTP_SERVER);
        $login_result = ftp_login($conn_id, 'upload', 'Astana2014');
        $s = explode('/', 'app_for_job');
        $t = count($s);
        $local_file = $s[$t-1];

        ftp_get($conn_id, $local_file, 'Persons/test/', FTP_BINARY);
        exit;
    }

    //сотрудники
    $sql_persons = "select triv.EMAIL, triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio from sup_person triv  where STATE = 2 ORDER BY triv.LASTNAME";
    $list_persons = $db -> Select($sql_persons);

    array_push
    ($js_loader,
        'styles/js/inspinia.js',  
        'styles/js/plugins/pace/pace.min.js', 
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',     
        'styles/js/plugins/chosen/chosen.jquery.js',
        'styles/js/plugins/jsKnob/jquery.knob.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js',
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js',
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/edit_employees_js.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_osns.js',
        'styles/js/plugins/sweetalert/sweetalert.min.js'
    );   

    array_push
    ($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',
        'styles/css/plugins/colorpicker/bootstrap-colorpicker.min.css',
        'styles/css/plugins/cropper/cropper.min.css',
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/jasny/jasny-bootstrap.min.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'styles/css/plugins/clockpicker/clockpicker.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css',
        "styles/css/plugins/steps/jquery.steps.css",
        'styles/css/animate.css'
    );

    $othersJs .= "<script>
                    $(document).ready(function(){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    });
                  </script>";

    $today_date = date('d.m.Y');
    $now_time = date('H:i:s');

    function complete_mail($mail_id, $next_step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$mail_id' and (STATE = 4 OR STATE = 0 OR STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $errors_count = count($list_state);
        if($errors_count == 0)
        {
            $sql_read = "update DOCUMENTS set CURRENT_STEP_ID = '$next_step_id', STATE = 2 where ID = '$mail_id'";
            $list_read = $db -> Select($sql_read);
        }
    }

    function approve_mail($mail_id, $next_step_id, $SENDER_MAIL_COMMENT, $emp_fio)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$mail_id' and (STATE = 4 OR STATE = 0 OR STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $errors_count = count($list_state);
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');

        if($errors_count == 0)
        {
            $sql_read = "update DOCUMENTS set CURRENT_STEP_ID = '$next_step_id', STATE = 2 where ID = '$mail_id'";
            $list_read = $db -> Select($sql_read);

            $sql_reciep = "INSERT INTO DOC_RECIEPMENTS (ID, MAIL_ID, RECIEP_MAIL, STATE, SENDER_MAIL, POST_DATE, POST_TIME, DESTINATION) VALUES (SEQ_DOC_RECIEPMENTS.NEXTVAL, '$mail_id', '$SENDER_MAIL_COMMENT', '0', 'robot_doc_syst', '$today_date', '$now_time', '9')";
            $list_reciep = $db -> Select($sql_reciep);
        }
    }

    //проверяет на наличие других согласований
    function check_other_agreement($doc_id, $next_trip_step_id, $step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS_AGREEMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);

        if(empty($list_state))
        {
            $next_step_id = get_next_step($doc_id);
            $state = get_state_by_name($next_step_id);
            change_docs_state($doc_id, $state, $next_step_id);
            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_trip_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id' WHERE ID = '$doc_id'";
            $list_change_step = $db -> Select($sql_change_step);
        }
            else
        {
            //echo 'Не все согласовали';
        }
        //exit;
    }

    //проверяет на наличие других согласований
    function check_other_reciepments($doc_id, $next_trip_step_id, $step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;

        $sql_state = "select * from DOC_RECIEPMENTS_AGREEMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_ASSIGNMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_RESOLUTION where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        if(empty($list_all_reciep))
        {
            $next_step_id = get_next_step($doc_id);
            $state = get_state_by_name($next_step_id);
            change_docs_state($doc_id, $state, $next_step_id);
            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_trip_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id', STATE = '7' WHERE ID = '$doc_id'";
            $list_change_step = $db -> Select($sql_change_step);
        }
            else
        {
            //echo 'Не все согласовали';
        }
        //exit;
    }

    //проверяет на наличие других согласований
    function check_other_assignment($doc_id, $next_trip_step_id, $step_id)
    {
        $db = new DB();
        $sql_state = "select * from DOC_RECIEPMENTS where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;

        $sql_state = "select * from DOC_RECIEPMENTS_AGREEMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_ASSIGNMENT where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "select * from DOC_RECIEPMENTS_RESOLUTION where MAIL_ID = '$doc_id' and (STATE = 0 or STATE = 1)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        if(empty($list_all_reciep))
        {
            //echo 'Все поручения исполнены';
            $next_step_id = get_next_step($doc_id);
            $state = get_state_by_name($next_step_id);
            change_docs_state($doc_id, $state, $next_step_id);
            $sql_change_step = "UPDATE DOCUMENTS SET CURRENT_STEP_ID = '$next_trip_step_id', NEXT_STEP_ID = '', PREV_STEP_ID = '$step_id', STATE = 7 WHERE ID = '$doc_id'";
            $list_change_step = $db -> Select($sql_change_step);
        }
            else
        {
            //echo 'Не все поручения исполнены';
        }
        //exit;
    }


    //возвращает следующий шаг
    function get_next_step($doc_id)
    {
        $db = new DB();
        //проверка всех поручений
        //$sql_state = "select reciep.*,'DOC_RECIEPMENTS_ASSIGNMENT' table_name from DOC_RECIEPMENTS_ASSIGNMENT reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        //$list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;

        //проверка всех согласований
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS_AGREEMENT' table_name from DOC_RECIEPMENTS_AGREEMENT reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = $list_state;
        //$list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех подписантов
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS_SIGNATURE' table_name from DOC_RECIEPMENTS_SIGNATURE reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех адресатов
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS' table_name from DOC_RECIEPMENTS reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех исходящих из компании
        $sql_state = "select reciep.*,'DOC_RECIEPMENTS_REGIST_OUT' table_name from DOC_RECIEPMENTS reciep where reciep.MAIL_ID = '$doc_id' and (reciep.STATE = 0 OR reciep.STATE = 1 OR reciep.STATE = 4)";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
        $last_elem = end($list_all_reciep);
        $next_step = $last_elem['TABLE_NAME'];
        return $next_step;
    }

    function get_state_by_name($next_step_id)
    {
        $db = new DB();
        //пполучение айди по названию таблицы шага
        $sql_state = "select state.ID, state.STATE_NAME from DIC_DOC_STATE state where state.TABLE_NAME = '$next_step_id'";
        $list_state = $db -> Select($sql_state);
        return $list_state[0]['ID'];
    }

    //меняем статус документа
    function change_docs_state($doc_id, $state, $next_step_table)
    {
        $db = new DB();
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        //активируем следующий шаг
        $sql_state = "update $next_step_table set STATE = '0', RECIEP_DATE ='$today_date', RECIEP_TIME = '$now_time' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        send_mail($next_step_table, $doc_id);

        //обновление статуса документа
        $sql_state = "update DOCUMENTS set STATE = '$state' where ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        //все документы на контроле в завершено
        $sql_state = "update DOC_RECIEPMENTS_CONTROL set STATE = '2' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);
        
      //  mail("i.akhmetov@gak.kz", "Уведомление в СЭД", "Статус .", "From: Система электронного документооборота");
    //    mail("b.abdisamat@gak.kz", "Уведомление в СЭД", "Статус .", "From: Система электронного документооборота");
    }

    //отклонение документа
    function reject_mail($doc_id)
    {
        $db = new DB();

        //смена статуса во всех таблицах на отклонено
        $sql_state = "update DOC_RECIEPMENTS_ASSIGNMENT set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS_AGREEMENT set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS_SIGNATURE set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        $sql_state = "update DOC_RECIEPMENTS_RESOLUTION set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);
        
        $sql_state = "update DOC_RECIEPMENTS_CONTROL set STATE = '3' where MAIL_ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);

        //перенос в проекты
        set_to_project($doc_id, 'DOC_RECIEPMENTS', 'RECIPIENT');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_AGREEMENT', 'RECIPIENT_AGREEMENT');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_ASSIGNMENT', 'DOC_RECIEPMENTS_ASSIGNMENT');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_REGISTRATION', 'RECIPIENT_REGISTRATION');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_RESOLUTION', 'RECIPIENT_RESOLUTION');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_SIGNATURE', 'DOC_RECIEPMENTS_SIGNATURE');
        set_to_project($doc_id, 'DOC_RECIEPMENTS_CONTROL', 'DOC_RECIEPMENTS_CONTROL');
    }

    function set_to_project($doc_id, $table_name, $table_name_for_insert)
    {
        $db = new DB();

        $sql_state = "SELECT reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               doc_state.NAME STATE,
                               '$table_name' table_name
                            FROM $table_name reciep,
                               DIC_DOC_RECIEPMENT_STATE doc_state
                            WHERE DOC_STATE.ID = RECIEP.STATE
                              AND reciep.STATE = '3'
                              AND reciep.MAIL_ID = $doc_id
                            ORDER BY RECIEP.ID";
        $list_all_reciep = $db -> Select($sql_state);
        foreach($list_all_reciep as $k => $v)
        {
            $reciep_mail = $v['RECIEP_MAIL'];
            $emp_mail = $v['SENDER_MAIL'];
            $today_date = $v['POST_DATE'];
            $now_time = $v['POST_TIME'];
            $sql_reciep = "INSERT INTO DOC_RECIEPMENTS_PROJECT (ID, MAIL_ID, RECIEP_MAIL, SENDER_MAIL, POST_DATE, POST_TIME, TABLE_NAME) VALUES (SEQ_DOC_RECIEPMENTS_PROJECT.NEXTVAL, '$doc_id', '$reciep_mail', '$emp_mail', '$today_date', '$now_time', '$table_name_for_insert')";
            $list_reciep = $db -> Select($sql_reciep);
        }
    }

    function get_all_property($doc_id)
    {
        $db = new DB();
        $sql_mail_state = 
                "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                       triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                       reciep.SENDER_MAIL,
                       reciep.ID,
                       reciep.POST_DATE,
                       reciep.POST_TIME,
                       reciep.SENDER_MAIL,
                       reciep.COMMENT_TO_DOC,
                       reciep.RECIEP_MAIL,
                       RECIEP.STATE,
                       reciep.RECIEP_DATE,
                       reciep.RECIEP_TIME,
                       doc_state.STATE_NAME,
                       reciep.DESTINATION
                FROM DOC_RECIEPMENTS reciep,
                     DIC_DOC_STATE doc_state,
                     SUP_PERSON triv,
                     SUP_PERSON triv2
                WHERE triv2.EMAIL = reciep.SENDER_MAIL
                  AND triv.EMAIL = reciep.RECIEP_MAIL
                  AND DOC_STATE.ID = RECIEP.STATE
                  AND reciep.STATE != '4'
                  AND reciep.MAIL_ID = $doc_id
                ORDER BY RECIEP.ID";
        $list_mail_state = $db -> Select($sql_mail_state);

        //проверка всех адресатов
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,
                               'Адресат' table_name
                        FROM DOC_RECIEPMENTS reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_all_reciep = $db -> Select($sql_state);
        $list_all_reciep = $list_all_reciep;

        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,
                               'Канцелярия (исходящее)' table_name
                        FROM DOC_RECIEPMENTS_REGIST_OUT reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,
                               'Поручение' table_name
                        FROM DOC_RECIEPMENTS_ASSIGNMENT reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);

        //проверка всех согласований
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,
                               'Согласование' table_name
                        FROM DOC_RECIEPMENTS_AGREEMENT reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
        
        
        
        
                 // проверка на контроль
                $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,
                               'На контроле' table_name
                        FROM DOC_RECIEPMENTS_CONTROL reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
                $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep); 
        
        
        
        
        
                
                 // проверка на ознакомленнһие
                $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,
                               'На ознакомлении' table_name
                        FROM DOC_RECEIP_USAGE reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
                $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep); 
        
        
        
        
        
        //проверка всех резолюций
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,
                               'Согласование' table_name
                        FROM DOC_RECIEPMENTS_RESOLUTION reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
        
        

        
        

        //проверка всех подписантов
        $sql_state = "SELECT triv2.LASTNAME ||'.'|| SUBSTR(triv2.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv2.MIDDLENAME, 1, 1) fio2,
                               triv.LASTNAME ||'.'|| SUBSTR(triv.FIRSTNAME, 1, 1) ||'.'|| SUBSTR(triv.MIDDLENAME, 1, 1) fio,
                               reciep.SENDER_MAIL,
                               reciep.ID,
                               reciep.POST_DATE,
                               reciep.POST_TIME,
                               reciep.SENDER_MAIL,
                               reciep.COMMENT_TO_DOC,
                               reciep.RECIEP_MAIL,
                               RECIEP.STATE,
                               reciep.RECIEP_DATE,
                               reciep.RECIEP_TIME,
                               doc_state.NAME STATE,
                               reciep.DESTINATION,                               
                               'Подписание' table_name
                        FROM DOC_RECIEPMENTS_SIGNATURE reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '4'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
                                                              
        return $list_all_reciep;
    }

    function set_resolution($doc_id)
    {
        $db = new DB();
        //обновление статуса документа
        $sql_state = "update DOCUMENTS set STATE = '3' where ID = '$doc_id'";
        $list_state = $db -> Select($sql_state);
    }

    function send_mail($next_step_table, $doc_id)
    {
        $db = new DB();
        $document = new Document();
        //проверка всех подписантов
        $sql_state = "SELECT 
                        doc.*,
                        reciep.*
                        FROM $next_step_table reciep,
                        DOCUMENTS doc
                        WHERE 
                        reciep.MAIL_ID = $doc_id
                        and doc.ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        //echo '<pre>';
        //print_r($list_state);
        //echo '<pre>';
        $reciep_mail = $list_state[0]['RECIEP_MAIL'];
        $SHORT_TEXT = $list_state[0]['SHORT_TEXT'];
        $SENDER = $list_state[0]['SENDER'];
        //mail("$SENDER_MAIL_COMMENT", 'Уведомление в СЭД', "К Вам, в СЭД пришло новое.", "From: Система электронного документооборота");
        if($reciep_mail == 'g.amerkhojayev@gak.kz') $reciep_mail = 'e.zhanaberdinova@gak.kz';
     //   $document->sendmail($reciep_mail, 'Уведомление СЭД', "К Вам, в СЭД, от сотрудника $SENDER пришло письмо с коротким описанием $SHORT_TEXT. Для прочтения пройдите по ссылке http://192.168.5.244/on_inbox_new");
      //  mail("$reciep_mail", 'Уведомление СЭД', "К Вам, в СЭД, от сотрудника $SENDER пришло письмо с коротким описанием '$SHORT_TEXT'. Для прочтения пройдите по ссылке http://192.168.5.244/on_inbox_new", "From: Система электронного документооборота");        
    }

    function agree_by_order($doc_id, $next_step_id, $step_id, $comment)
    {
        $db = new DB();
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        $document = new Document();
        //проверка всех последовательно согласовывающих
        $sql_state = "SELECT *
                        FROM DOC_RECIEPMENTS_AGREEMENT
                        WHERE MAIL_ID = '$doc_id'
                        and STATE != '2'
                        ORDER BY ID";
        $list_state = $db -> Select($sql_state);
        $i = 0;
        
        $sql_send = "SELECT *
                        FROM DOC_RECIEPMENTS_AGREEMENT agree,
                        documents doc
                        WHERE agree.MAIL_ID = '$doc_id'
                        and agree.STATE != '2'
                        and doc.id = agree.mail_id
                        order by agree.id DESC";
        $list_send = $db->select($sql_send);  
        $sender = $list_send[0]['SENDER']; 
        $short_text = $list_send[0]['SHORT_TEXT'];      
                 
        if(!empty($list_state))
        {
            foreach($list_state as $k => $v)
            {
                $rec_id = $v['ID'];
                $receip_mail = $v['RECIEP_MAIL'];
                //обновление статуса документа
                if($i == 0)
                {
                    $sql_state = "update DOC_RECIEPMENTS_AGREEMENT set STATE = '2', COMMENT_TO_DOC = '$comment', POST_DATE = '$today_date', POST_TIME = '$now_time' where ID = '$rec_id'";
                    $list_state = $db -> Select($sql_state);
                }
                    else if($i == 1)
                {
                    $sql_state = "update DOC_RECIEPMENTS_AGREEMENT set STATE = '0', RECIEP_DATE ='$today_date', RECIEP_TIME ='$now_time' where ID = '$rec_id'";
                    $list_state = $db -> Select($sql_state);
                    $document->sendmail($receip_mail, 'Уведомление СЭД', "К Вам, в СЭД, от сотрудника $sender пришло письмо с коротким описанием $short_text . Для прочтения пройдите по ссылке http://192.168.5.244/on_inbox_new");
                  //  mail("$receip_mail", 'Уведомление СЭД', "К Вам, в СЭД, от сотрудника '$sender' пришло письмо с коротким описанием '$short_text' . Для прочтения пройдите по ссылке http://192.168.5.244/on_inbox_new", "From: Система электронного документооборота");
                }
                $i++;
            }
        }

        //проверка всех последовательно согласовывающих
        $sql_state = "SELECT *
                        FROM DOC_RECIEPMENTS_AGREEMENT
                        WHERE MAIL_ID = '$doc_id'
                        and STATE != '2'
                        ORDER BY ID";
        $list_state = $db -> Select($sql_state);
        if(empty($list_state))
        {
            $next_step_id = get_next_step($doc_id);
            $state = get_state_by_name($next_step_id);
            change_docs_state($doc_id, $state, $next_step_id);
        }
    }
?>



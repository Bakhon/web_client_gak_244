<?php


array_push($js_loader,
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

    array_push($css_loader, 
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
        'styles/css/animate.css'
    );
    
    
    $othersJs .= "<script>

                        $(document).ready(function () {
                    
                            $('.demo1').click(function(){
                                swal({
                                    title: 'Welcome in Alerts',
                                    text: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
                                });
                            });
                    
                            $('.demo2').click(function(){
                                swal({
                                    title: 'Сохранено!',
                                    text: 'Информация ушла в базу данных!',
                                    type: 'success'
                                });
                            });
                    
                            $('.demo3').click(function () {
                                swal({
                                    title: 'Are you sure?',
                                    text: 'You will not be able to recover this imaginary file!',
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#DD6B55',
                                    confirmButtonText: 'Yes, delete it!',
                                    closeOnConfirm: false
                                }, function () {
                                    swal('Deleted!', 'Your imaginary file has been deleted.', 'success');
                                });
                            });
                    
                            $('.demo4').click(function () {
                                swal({
                                            title: 'Are you sure?',
                                            text: 'Your will not be able to recover this imaginary file!',
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#DD6B55',
                                            confirmButtonText: 'Yes, delete it!',
                                            cancelButtonText: 'No, cancel plx!',
                                            closeOnConfirm: false,
                                            closeOnCancel: false },
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                swal('Deleted!', 'Your imaginary file has been deleted.', 'success');
                                            } else {
                                                swal('Cancelled', 'Your imaginary file is safe :)', 'error');
                                            }
                                        });
                            });
                    
                    
                        });
                    
                    </script>";
    
                    
    $db = new DB();
    $sql_branch = "select * from INSURANCE2.dic_branch where RFBN_ID != 0000";
    $list_branch = $db -> Select($sql_branch);
    
    $sql_department = "select * from INSURANCE2.DIC_DEPARTMENT";
    $list_department = $db -> Select($sql_department);
    
    $year = array(2019, 2018, 2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010, 2009, 2008, 2007, 2006);
    
 //   $sql_kvartal = "select *from INSURANCE2.DIC_KVARTAL";
 //   $list_kvartal = $db -> Select($sql_kvartal);
 
    $quarter = array(1,2,3,4, "Годовой отчет");

    if(isset($_FILES['imagereader'])) {
        
  //       $ch = curl_init();
         
     //    $p1 = $_FILES['imagereader']; 
       //  print_r($_POST);
          
                                             
  /*       $url = "http://192.168.5.46?file=babdisamat@bk.ru";
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "root:Tashenova25");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_POST, 1);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        echo $output;
        
        curl_close($ch);  */
                                                                                                      
        $uploaddir = '/inetpub/wwwroot/upload/'; // Relative path under webroot
        $uploadfile = $uploaddir . basename($_FILES['imagereader']['name']);

        if (move_uploaded_file($_FILES['imagereader']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
           echo "File uploading failed.\n";
           }      
        
                    
        $title = $_POST['TITLE'];
        $date = $_POST['date_close'];                
        $p = $_POST['file_name_input'][0];
        $title_kaz = $_POST['TITLE_KAZ'];   
        $today_date = date('d.m.Y');                                              
        $sql_to_slide = "insert into SITE_REPORT_LINK (ID, REP_DATE, REP_LINK_RU, REP_NAME_RU, REP_NAME_KAZ, DATE_PUBLIC) values 
                         (SEQ_SITE_REPORT_LINK.nextval, '$date', '$p', '$title', '$title_kaz', '$today_date')";
        $db->Execute($sql_to_slide);                                                                                      
    }
    
    
    $sql_person = "select s.id from sup_person s where state in (2,3,5,6,9) and id not in(1481, 618, 630, 527 , 444)";
    
    $list_person = $db->select($sql_person);
    
    foreach($list_person as $k=>$v)
    {
        $id = $v['ID'];
     //   $sql = "INSERT INTO PERSON_HOLI_PAY(YEAR, STATE, EMP_ID) values(2020, 0, $id)";
     //   $list_add_holi_period = $db->execute($sql);
    }
    
    
    
   /*
       $day = date("d.m.Y",strtotime('+1 day'));
       $list_check_doc =$db->select("select * from documents where date_end = '$day' and (state != 7 and state != 6 and state != 5)");    

       foreach($list_check_doc as $k1=>$v1)
       {
       $doc_id = $v1['ID'];
       $short_text = $v1['SHORT_TEXT'];       
       
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
                               doc_state.NAME STATE,
                               'Адресат' table_name
                        FROM DOC_RECIEPMENTS reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '2' and reciep.state != '4' and reciep.state != '5'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_all_reciep = $db -> Select($sql_state);
        $list_all_reciep = $list_all_reciep;
       
       
       
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
                               doc_state.NAME STATE,
                               'Согласование' table_name
                        FROM DOC_RECIEPMENTS_AGREEMENT reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '2'
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
                               doc_state.NAME STATE,
                               'Согласование' table_name
                        FROM DOC_RECIEPMENTS_RESOLUTION reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '2'
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
                               doc_state.NAME STATE,
                               'Подписание' table_name
                        FROM DOC_RECIEPMENTS_SIGNATURE reciep,
                             DIC_DOC_RECIEPMENT_STATE doc_state,
                             SUP_PERSON triv,
                             SUP_PERSON triv2
                        WHERE triv2.EMAIL = reciep.SENDER_MAIL
                          AND triv.EMAIL = reciep.RECIEP_MAIL
                          AND DOC_STATE.ID = RECIEP.STATE
                          AND reciep.STATE != '2'
                          AND reciep.MAIL_ID = $doc_id
                        ORDER BY RECIEP.ID";
        $list_state = $db -> Select($sql_state);
        $list_all_reciep = array_merge($list_state, $list_all_reciep);
       
             
       
      foreach($list_all_reciep as $k=>$v){
        $mail_send = $v['RECIEP_MAIL'];
        $id = $v['ID'];
        $state = $v['TABLE_NAME'];
      //  mail("$mail_send", 'Уведомление в СЭД', "Письмо с коротким описанием $short_text с номером $id истекает, для ознакомления пройдите по ссылке http://192.168.5.244/mail_detail_just_read?doc_id=$doc_id&get_file=$doc_id&rec_id=&dest_id=", "From: Система электронного документооборота");
      }
    echo '<pre>';
      print_r($list_all_reciep);
      echo '</pre>';
      
      echo '<pre>';
      echo $short_text;
      echo '</pre>'; 
    }    
                                                                     
       // echo $day;
       $today_date = date('d.m.Y'); 

       $i = 0;

        while($i<5){
        if($i == 0) {
        $list_sp = $db->select("select * from sup_person where id = 1921");   
        $year_plus = $list_sp[0]['DATE_POST'];
        
        $date_year_plus = strtotime($year_plus); 
       
       
       $mod_date = strtotime("+1 years", $date_year_plus);
       $mod_date2= strtotime("-1 days", $mod_date);
       $convert_date = date('d.m.Y', $mod_date2); 
        
        
        }
        else{
       
       $list_sp = $db->select("select * from sup_person where id = 1921");   
       $year_plus = $list_sp[0]['DATE_POST'];    
       $year_plus = strtotime("+1 years", $year_plus); 
        
        
       $date_year_plus = strtotime($year_plus); 
       
       
       $mod_date = strtotime("+1 days", $date_year_plus);
       $mod_date2= strtotime("+1 years", $mod_date);
       $convert_date = date('d.m.Y', $mod_date2); 
       
          }   
       
        
       $sql_person_holidays_period = $db->Execute("insert into PERSON_HOLYDAYS_PERIOD(PERSON_ID, PERIOD_START, PERIOD_END, DAY_COUNT_USED_FOR_TODAY, ID, DIDNT_ADD, PAYING_FOR_HEALTH) values ('1921', '$year_plus', '$convert_date', '0', '1674', '0', '1')");
       
       $year_plus = $convert_date;
       $i++;
       }
       
       
      // echo $date;
       echo '<br/>';
       $perevod_data = date('d.m.Y', strtotime($date));
     //   echo $perevod_data;
        
       
            
              
       $year = mktime(0,0,0,'$year_plus');
       $fecha = date('$year_plus', $time);       
       
 
            
       $sql = "select * from Documents where DATE_END = '$day'";
       $list_expired_mail = $db->select($sql);       
          
                            
    //   $list = $db -> select("select * from documents where to_date(date_end, 'dd.mm.yyyy') = to_date(sysdate+1, 'dd.mm.yyyy') and state not in(7, 6, 5)");
         $list = $db->select("select * from list_causes l, EXECUTOR_CLAUSES e where state = 3 and to_date(e.date_end, 'dd.mm.yyyy') = to_date(sysdate, 'dd.mm.yyyy') and l.id = e.id_zayavka");         
        echo '<pre>';
        print_r($list);
        echo '</pre>';
        
        foreach($list as $k=>$v) {
            $id = $v['ID'];
            $list_upd = $db->execute("update list_causes set state = 5, SUCCESS = 3 where id = $id");
        }
        echo '<pre>';
        print_r($list_upd);
        echo '</pre>';
       
             
    */
    

?>
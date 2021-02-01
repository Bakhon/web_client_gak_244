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
        'styles/css/animate.css',
        "styles/css/plugins/steps/jquery.steps.css",
        "styles/css/plugins/jsTree/style.min.css"
    );




$db = new DB();
$document = new Document();

    $conn_id = ftp_connect(FTP_SERVER);      
    $login_result = ftp_login($conn_id, 'upload', 'Astana2014');

    //загрузка документа
    $ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);


$get_file = $_GET['get_file'];

$list_clauses = $db->Select("select * from LIST_CAUSES where id = $get_file");

foreach($list_clauses as $k=>$v) {}

$id = $v['AUTHOR']; 
$list_person = $db->Select("select * from sup_person where id = $id"); 

$job_sp = $list_person[0]['JOB_SP'];
$list_dep = $db->Select("select * from dic_department where id = $job_sp");

$condt = $v['PRICHINA_OBR']; 
$list_condt = $db->Select("select * from DIC_CAUSE where id = $condt");

$list_executor = $db->Select("select * from EXECUTOR_CLAUSES where ID_ZAYAVKA = $get_file");
foreach($list_executor as $k=>$v) {}

$emp_id = $v['EMP_ID'];
if($emp_id) {
$list_sp = $db->Select("select * from sup_person where id = $emp_id");
}

 if(isset($_GET['get_file']))
    {
        $dir_name = $_GET['get_file'];

		$contents = ftp_nlist($conn_id, "zayavki/$dir_name/");

        $ftp_get = ftp_get($conn_id, 'C:\Users\User\Downloads\app_for_job', 'ftp://192.168.5.2/Persons/test/job_contract', FTP_BINARY);
		if(!ftp_get($conn_id, 'app_for_job', '/Persons/test/./job_contract', FTP_BINARY)){
			//echo 'NO';
		}

    }
        else
    {
        echo 'Ошибка!';
    } 

  if(isset($_POST['except_id_zayavka'])) 
    {
        $id = $_POST['except_id_zayavka'];
        $today_date = date('d.m.Y');
        $time_today = date('H:i:s');
        $text_s = $_POST['text_sender'];
        
        $sql = $db->Execute("update LIST_CAUSES set SUCCESS = 1, STATE = 3 where id = $id");
        
        $sql_zayavki_end = $db->Execute("update EXECUTOR_CLAUSES set DATE_END = '$today_date', TIME_END = '$time_today', TEXT = '$text_s'  where ID_ZAYAVKA = $id");
        
  /*      if(updatezayavka($_POST['except_id_zayavka'], 1, '') == true)
        {
            $txt = 'Ваша заявка успешно выполнена! <p>Пожалуйста подтвердите выполнение заявки!</p>
            <p><a href="'.HTTP_SERVER.'index.php?accept_z='.$_POST['except_id_zayavka'].'">Подтвердить</a></p>';
            infoMessage('Выполнение по текущей заявке принято', '', '');
            sendmail($_POST['except_user_email'], 'Подтверждение Заявки #'.$_POST['except_id_zayavka'], $txt);   
        }   
        
              */
              
       $list_person = $db->select("select * from list_causes where id = $id");
       foreach($list_person as $k=>$v){
        $sender_id = $v['AUTHOR'];
        $short_text = $v['SHORT_TEXT'];
       }       
       $list_send_mail = $db->select("select * from sup_person where id = $sender_id");
       $send_mail = $list_send_mail[0]['EMAIL'];
       
       $document->sendmail($send_mail, 'Подтверждение заявки в СЭД', "Ваша заявка с номером $id с коротким описанием $short_text выполнено, войдите чтобы подтвердить заявку. Для ознакомления пройдите по ссылке http://192.168.5.244/zayavka_about?get_file=$id");
              
     // mail("$send_mail", 'Подтверждение заявки в СЭД', "Ваша заявка с номером $id с коротким описанием '$short_text' выполнено, войдите чтобы подтвердить заявку. Для ознакомления пройдите по ссылке http://192.168.5.244/zayavka_about?get_file=$id", "From: Система электронного документооборота");           
        
        header("Refresh:0");    
    } 
    
    
   if(isset($_POST['error_text'])) {
    $today_date = date('d.m.Y');
    $time = date('H:i:s');
    $id = $_POST['error_id_zayavka'];
    $text = $_POST['error_text'];
    
    $sql_ins = $db->Execute("update EXECUTOR_CLAUSES set TEXT = '$text', DATE_END = '$today_date', TIME_END = '$time' where ID_ZAYAVKA = $id");
    
    $sql = $db->Execute("update LIST_CAUSES set SUCCESS = 2, STATE = 4 where id = $id ");
    
    
     $list_person = $db->select("select * from list_causes where id = $id");
       foreach($list_person as $k=>$v){
        $sender_id = $v['AUTHOR'];
        $short_text = $v['SHORT_TEXT'];
       }       
       $list_send_mail = $db->select("select * from sup_person where id = $sender_id");
       $send_mail = $list_send_mail[0]['EMAIL'];
    
    $document->sendmail($send_mail, 'Отклонение заявки в СЭД', "Ваша заявка с номером $id с коротким описанием $short_text отклонено. Для ознакомления пройдите по ссылке http://192.168.5.244/zayavka_about?get_file=$id");
  //  mail("$send_mail", 'Отклонение заявки в СЭД', "Ваша заявка с номером $id с коротким описанием '$short_text' отклонено. Для ознакомления пройдите по ссылке http://192.168.5.244/zayavka_about?get_file=$id", "From: Система электронного документооборота");
            
     header("Refresh:0");
   } 
  
  
   if(isset($_POST['retake_zayavka']))
   {
    $retake_id = $_POST['retake_zayavka'];
    
     $db->Execute("
                insert into LIST_CAUSES_ARC
                select * from LIST_CAUSES where id = $retake_id
            ");
            
     $db->Execute("
                insert into EXECUTOR_CLAUSES_ARC
                select * from EXECUTOR_CLAUSES where ID_ZAYAVKA = $retake_id
            ");
    
    
    
    $sql_retake = $db->Execute("update LIST_CAUSES set SUCCESS = 0, State = 2, DATE_CONFIRM = '', TIME_CONFIRM = '', TEXT_COMMENT = '' where id = $retake_id");
    
    $sql_exec_ret = $db->Execute("update EXECUTOR_CLAUSES set DATE_END = '', TIME_END = '', TEXT = '' where ID_ZAYAVKA = $retake_id");
    header("Refresh:0");
    
   }



?>

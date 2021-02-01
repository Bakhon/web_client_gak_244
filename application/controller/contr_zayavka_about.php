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
foreach($list_executor as $kk=>$vv) {}
$emp_id = $vv['EMP_ID'];
if($emp_id) {
$list_sp = $db->Select("select * from sup_person where id = $emp_id");
}









 // $sql_upd_read = $db->Execute("update LIST_CAUSES set read = 1 where id = $get_file");


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


  if(isset($_POST['except_id_zayavka'])) {
    $date = date('d.m.Y');
    $time = date('H:i:s');
    $id = $_POST['except_id_zayavka'];  
    $text = $_POST['text'];
    $sql = $db->Execute("Update LIST_CAUSES set success = 3, DATE_CONFIRM = '$date', TIME_CONFIRM = '$time', TEXT_COMMENT = '$text', STATE = 5 where ID = $id");
    header("Refresh:0");
  }
  
  if(isset($_POST['error_text'])){
    $id = $_POST['error_id_zayavka'];
    $text = $_POST['error_text'];
    $date = date('d.m.Y');
    $time = date('H:i:s');
    
    $sql = $db->Execute("Update LIST_CAUSES set TEXT_COMMENT = '$text', DATE_CONFIRM = '$date', TIME_CONFIRM = '$time', SUCCESS = 4, STATE = 6 where id = $id");
                        
     $list_person = $db->select("select * from EXECUTOR_CLAUSES where ID_ZAYAVKA = $id");
       foreach($list_person as $k=>$v){
        $sender_id = $v['EMP_ID'];
        $short_text = $v['TEXT'];
       }       
       $list_send_mail = $db->select("select * from sup_person where id = $sender_id");
       $send_mail = $list_send_mail[0]['EMAIL'];
    
    $document->sendmail($send_mail, 'Отклонение заявки отправителем в СЭД', "Заявка с номером $id с коротким описанием $short_text отклонено отправителем. Для ознакомления пройдите по ссылке http://192.168.5.244/zayavka?get_file=$id");
  //  mail("$send_mail", 'Отклонение заявки отправителем в СЭД', "Заявка с номером $id с коротким описанием '$short_text' отклонено отправителем. Для ознакомления пройдите по ссылке http://192.168.5.244/zayavka?get_file=$id", "From: Система электронного документооборота");
                                
    header("Refresh:0");
    
  }




?>

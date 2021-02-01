<?php 


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
        'styles/css/plugins/steps/jquery.steps.css',
        'styles/css/animate.css'
    );
    
    
$db = new DB();
$document = new Document();

$ftp = new FTP(FTP_SERVER, FTP_USER, FTP_PASS);

$sql_cause = "select * from dic_cause order by id";
$list_cause = $db->Select($sql_cause);

$list_cause_num = $db->select("select * from cause_num where id = 1");
$seq = $list_cause_num[0]['CAUSE_NUM'];

$emp_mail = $_SESSION['insurance']['login'];


  $sql_id = "select SEQ_ZAYAVKA.NEXTVAL from dual";
        $list_seq = $db -> Select($sql_id);
        $id = $list_seq[0]['NEXTVAL'];

$today_date = date('d.m.Y');
$time = date('H:i:s');

if(isset($_POST['CREATE_MAIL'])){
                  
    $id = $seq;
    $title = $_POST['HEAD_TEXT'];
    $short_text = $_POST['SHORT_TEXT'];
    $cause = $_POST['cause'];
    $author_id = $_POST['author_id'];
    $PRICHINA_OBR = $_POST['cause'];
    
    
    $sql_zayavki = "INSERT INTO LIST_CAUSES(ID, AUTHOR, HEAD_TEXT, SHORT_TEXT, DATE_SEND, NOMER, DOC_LINK, PRICHINA_OBR, STATE,  TIME_SEND, SUCCESS, PERSON_EMAIL) VALUES($seq, '$author_id', '$title', '$short_text', '$today_date', '$id', '$id', '$PRICHINA_OBR', 1, '$time', 0, '$emp_mail' )";
       
    $list_zayavki = $db->Execute($sql_zayavki);
        
    $sql_executor = "INSERT INTO EXECUTOR_CLAUSES(ID, ID_ZAYAVKA) VALUES(SEQ_EX_CLAUS.NEXTVAL, $id)";
    $list_executor = $db->Execute($sql_executor);
    
    $list_upd_num_cause = $db->execute("update CAUSE_NUM set CAUSE_NUM =  CAUSE_NUM+1 where ID = 1");




  if(isset($_POST['doc_b64']))
        {
            //создание директории по id
            if(!$ftp->create_path("zayavki/$id"))
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
                    if(!$ftp->uploadfile("zayavki/$id/", "$filename", $handle))
                    {
                        echo "Ошибка создания файла!";
                    }
                }
                $i++;
            }
        }
        
       
$document->sendmail('n.omirbekov@gak.kz', 'Новая заявка в СЭД', "Вам пришла заявка с номером $id с коротким описанием $short_text, для ознакомления пройдите по ссылке http://192.168.5.244/na_rassmotrenii");
$document->sendmail('a.omarov@gak.kz', 'Новая заявка в СЭД', "Вам пришла заявка с номером $id с коротким описанием $short_text, для ознакомления пройдите по ссылке http://192.168.5.244/na_rassmotrenii");
// mail("n.omirbekov@gak.kz", 'Новая заявка в СЭД', "Вам пришла заявка с номером $id с коротким описанием '$short_text', для ознакомления пройдите по ссылке http://192.168.5.244/na_rassmotrenii", "From: Система электронного документооборота");
// mail("a.omarov@gak.kz", 'Новая заявка в СЭД', "Вам пришла заявка с номером $id с коротким описанием '$short_text', для ознакомления пройдите по ссылке http://192.168.5.244/na_rassmotrenii", "From: Система электронного документооборота");     
}
?>
<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    if(isset($_GET['user_email']))
    {
        $emp_mail = $_GET['user_email'];
    }
    
  //  echo $emp_mail;

    $sql_pos_id = "select JOB_POSITION from sup_person where EMAIL = '$emp_mail' and state in (2, 5)";
    $list_pos_id = $db -> Select($sql_pos_id);
    $emp_pos_id = $list_pos_id[0]['JOB_POSITION'];
  //   echo $emp_pos_id;
    if(isset($_POST['DELETE_MAIL']))
    {
        foreach($_POST['mail_check_box'] as $k => $v)
        {
            $sql_delete_mail = "UPDATE DOCUMENTS SET STATE = 3 where ID = $v";
            $list_delete_mail = $db->Execute($sql_delete_mail);
        }
    }

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
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js'
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
        'styles/css/plugins/select2/select2.min.css'
    );

    $othersJs .= "<script>
                    $(document).ready(function(){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    });
                  </script>";
    $sql_inbox = '';
    $sql_inbox .= "SELECT
                        doc.CURRENT_STEP_ID,
                        doc.NEXT_STEP_ID,
                        doc.PREV_STEP_ID,
                        doc.REG_NUM,
                        doc.DATE_END,
                        doc.SENDER,
                        doc.DOC_LINK,
                        DOC.DATE_START,
                        DOC.SHORT_TEXT,
                        doc.ID MAIL_ID
                    FROM 
                        DOCUMENTS doc
                    WHERE
                        doc.SENDER_MAIL = '$emp_mail'
                        AND DOC.STATE = 0
                        AND doc.TYPE = '0'
                    ORDER BY doc.ID";
    $list_reciep = $db -> Select($sql_inbox);
?>










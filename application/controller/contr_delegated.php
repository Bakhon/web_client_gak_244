<?php
    $db = new DB();
    
    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    //echo $emp_mail;
    
    if(isset($_POST['DELETE_MAIL'])){
        foreach($_POST['mail_check_box'] as $k => $v){
            $sql_delete_mail = "UPDATE DOC_RECIEPMENTS SET STATE = 6 where ID = $v";
            $list_delete_mail = $db->Execute($sql_delete_mail);
            echo $sql_delete_mail;
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
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_pa.js'
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
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                'dom': 'lTfigt',
                'tableTools': {
                    'sSwfPath': 'js/plugins/dataTables/swf/copy_csv_xls_pdf.swf'
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.html', {
                'callback': function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                'submitdata': function ( value, settings ) {
                    return {
                        'row_id': this.parentNode.getAttribute('id'),
                        'column': oTable.fnGetPosition( this )[2]
                    };
                },

                'width': '90%',
                'height': '100%'
            } );

        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                'Custom row',
                'New row',
                'New row',
                'New row',
                'New row' ] );

        }
    </script>";

    $othersJs .= "<script>
                    $(document).ready(function(){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    });
                  </script>";

    //$sql_outbox = "select * from DOCUMENTS where SENDER_MAIL = '$emp_mail' and (STATE = 2 OR STATE = 1) order by ID DESC";
    $sql_outbox .= "select 
                        TRIV.lastname||' '||TRIV.firstname||' '||TRIV.middlename fio, 
                        rec.DESTINATION,
                        rec.ID, 
                        rec.RECIEP_MAIL, 
                        doc.HEAD_TEXT, 
                        doc.REG_NUM, 
                        doc.SENDER, 
                        doc.DATE_START, 
                        doc.DATE_END, 
                        doc.SHORT_TEXT, 
                        DOC_KIND.NAME_KIND, 
                        doc.id MAIL_ID,
                        doc.DOC_LINK
                    from 
                        DOCUMENTS doc, 
                        DOC_RECIEPMENTS rec, 
                        DIC_DOC_KIND doc_kind, 
                        SUP_PERSON triv 
                    where 
                        rec.SENDER_MAIL = '$emp_mail' and 
                        REC.MAIL_ID = DOC.ID and 
                        DOC.KIND = DOC_KIND.ID and 
                        TRIV.EMAIL = rec.RECIEP_MAIL and 
                        (rec.STATE = 1 or rec.STATE = 2)";
    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_outbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }
    $sql_outbox .= " order by DOC.ID DESC";
    $list_outbox = $db -> Select($sql_outbox);
    //echo $sql_outbox;
?>


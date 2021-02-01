<?php
	$db = new DB();
    $rq = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(isset($_POST['TITLE_TEXT'])){
        $id = $_POST['id'];
        $titleText = $_POST['TITLE_TEXT']; 
        $dateAdd = $_POST['DATE_ADD'];
        $paymCode = $_POST['PAYM_CODE'];
        $dateBegin= $_POST['DATE_BEGIN'];
        $dateEnd = $_POST['DATE_END'];
        $dopNum= $_POST['ID_DOP_NUM'];
        
        if($id == 0){
            $sql = "insert into reports_html (ID, HTML_TEXT, SQL_TEXT,  TITLE_TEXT, PAYM_CODE, DATE_ADD, DATE_BEGIN, DATE_END, ID_DOP_NUM) values (REPORTS_HTML_SEQ.nextval, '', '', '$titleText','$paymCode', '$dateAdd',  '$dateBegin', '$dateEnd', $dopNum)";
        }else{
            $sql = "update reports_html set TITLE_TEXT = '$titleText', PAYM_CODE = '$paymCode', DATE_ADD = '$dateAdd', DATE_BEGIN = '$dateBegin', DATE_END = '$dateEnd', ID_DOP_NUM = '$dopNum' where ID = $id";
        }
        $s = $db->Execute($sql);  
        if($s !== true){
            $msg = ALERTS::ErrorMin($s);
        }else{
            Header("Location: $rq");
        }
    }
    
    //$active_user_dan['emp'];
    
    if(isset($_POST['deleted'])){
        $sql = "delete from DIC_SEGMENT_KURATORS where id = ".$_POST['deleted'];
        $s = $db->Execute($sql);
        if($s !== true){
            $msg = ALERTS::ErrorMin($s);
        }else{
            Header("Location: $rq");
        }
    }
    
    if(isset($_POST['reasonId'])){
        $sqlDicReason = "select * from dic_reason_dops where vid_dog = ".$_POST['reasonId']; //vid_dog =".$_POST['reasonId']);
        $dbDicReason = new DB();
        $sqlDicReason = $dbDicReason -> Select($sqlDicReason);
        echo '<option value="0">Основной договор</option>';
        foreach($sqlDicReason as $k => $v){
            echo "<option value=".$v['ID'].">".$v['REASON']."</option>";
        }
        print_r($sqlDicReason);
        exit;
    }
    
    $sql = "select sh_branch_name(branch_id) br_name,case when disabled = 1 then 'Заблокирован' else 'Активный' end dis_state, p.* from DIC_SEGMENT_KURATORS p order by BR_NAME";
    
    if(isset($GETS['id'])){
        $sql .= " where id = ".$GETS['id'];
    }
    
    if(isset($_POST['cityName'])){
        $id = $_POST['id'];
        $lastname = $_POST['LASTNAME'];
        $firstname = $_POST['FIRSTNAME'];
        $middlename = $_POST['MIDDLENAME'];
        $dolzhnost = $_POST['DOLZHNOST'];
        $branch_id = $_POST['branch_idInp'];
        $emp_id = $_POST['emp_id'];
        $disabled = $_POST['statusSelect'];
        if($_POST['id']==0){
            $dbUpdate = new DB();
            $sqlUpdate = "insert into DIC_SEGMENT_KURATORS (id, lastname, firstname, middlename, dolzhnost, branch_id, emp_id, disabled) values (SEQ_SEGMENT_KURATORS.nextval, '$lastname', '$firstname', '$middlename', '$dolzhnost', '$branch_id', SEQ_GS_EMP.nextval, '$disabled')";
            $danUpdate = $dbUpdate -> Execute($sqlUpdate);
            Header("Location: $rq");
        }else{
            $dbInsert = new DB();
            $sqlInsert = "update DIC_SEGMENT_KURATORS set lastname='$lastname', firstname='$firstname', middlename='$middlename', dolzhnost='$dolzhnost', branch_id='$branch_id', emp_id='$emp_id', disabled='$disabled' where  id = ".$id;
            $danInsert = $dbInsert -> Execute($sqlInsert);
            Header("Location: $rq");
        }
    }
    
    $dbBranchDan = new DB();
    $sqlBranchDan = "select * from dic_branch order by short_name";
    $dicBranchDan = $dbBranchDan -> Select($sqlBranchDan);
    
    $dbReport_html_other = new DB();
    $sqlReport_html_other = "select * from report_html_other ORDER BY ID";
    $sqlReport_html_other_dan = $dbReport_html_other -> Select($sqlReport_html_other);
    
    $dan = $db->Select($sql);
    
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
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/addClients.js',
        
        //'styles/js/plugins/jeditable/jquery.jeditable.js',
        
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/pace/pace.min.js'
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
        
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css'
    );
    
        $othersJs = "<script>
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
?>
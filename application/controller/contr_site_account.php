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
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_pa.js'
                
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
        'styles/css/plugins/select2/select2.min.css'
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
    
    $db = new DB();
    //$sql = "select * from sup_person order by id";
                
    if(isset($_POST['USER_TYPE'])){
        $user_type = $_POST['USER_TYPE'];
        $username = $_POST['NAME'];
        $authcode = $_POST['AUTH_CODE'];
        $telnum = $_POST['TEL_NUM'];
        $email = $_POST['EMAIL'];
        $emp_id = $_POST['emp_id'];  
        $today_date = date('d.m.Y');
        $now_time = date('H:i:s');
        
        create_site_user($user_type, $username, $authcode, $telnum, $email, $emp_id, $today_date, $now_time);
    }
    
    $sql = "select
                *
            from
                SITE_USERS
            order by ID";
    
    $listEmployee = $db -> Select($sql);
    //print_r($listEmployee);
    
    function create_site_user($user_type, $username, $authcode, $telnum, $email, $emp_id, $today_date, $now_time)
    {
        $pass = '';
        $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max=10;
        $size=StrLen($chars)-1;
        $pass=null; 
        while($max--)
        $pass.=$chars[rand(0,$size)]; 
        
        $db = new DB();
        $salt1 = generate_salt();
        $salt2 = generate_salt();
        $hashed_password = crypt($pass, "$salt1");
        
        $sql_new_user_salt = "insert into SITE_SALT (ID, AUTH_CODE, SALT1, SALT2) values (SEQ_SITE_SALT.nextval, '$authcode', '$salt1', '$salt2')";
        $insert_new_user_salt = $db -> Execute($sql_new_user_salt);
    
        $sql_new_user = "insert into SITE_USERS (ID, TYPE, AUTH_CODE, TEL_NUM, PASSWORD, EMAIL, PASS_WITHOUT_HASH, NAME, EMP_ID, POST_DATE, POST_TIME) values (SEQ_SITE_CLIENTS.nextval, '$user_type', '$authcode', '$telnum', '$hashed_password', '$email', '$pass', '$username', '$emp_id', '$today_date', '$now_time')";
        $insert_new_user = $db -> Execute($sql_new_user);
        
        mail("$email", "Ваш аккаунт зарегистрирован на сайте", "Для продолжения пройдите по ссылке http://192.168.5.46/cabinet \r\nЛогин: $authcode \r\nПароль: $pass \r\n", 'From: robot@gak.kz');
    }
    
    function generate_salt(){
        $length = rand(5, 12);
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
    
    function generatePassword(){
        $length = 8;
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
?>







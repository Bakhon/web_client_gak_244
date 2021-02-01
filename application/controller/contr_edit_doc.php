<?php
    $db = new DB();

    $sql_meta = "select * from DIC_META order by id";
    $list_meta = $db -> Select($sql_meta);
    if(isset($_GET['file_name']))
    { $file_name = $_GET['file_name'];
    }
    

    if(isset($_GET['temp_id']))
    {
        $temp_id = $_GET['temp_id'];
        $sql = "select * from report_html_other where id_otchet = $temp_id order by position";
        $list_temp = $db -> Select($sql);
    }
        else if(isset($_POST['text_for_edit']))
    {
        $html = $_POST['text_for_edit'];
        $holi_id = $_POST['holi_id'];
        $list_temp = '';
    }

    //построение обьекта Employee
    $empId = $_GET['employee_id'];

    //создаем обьект Employee, в параметры передаем ID
    $employee = new Employee($empId);

  //  $sqlEmpInfo = "select triv.DATE_LAYOFF, SUBSTR(triv.FIRSTNAME, 1, 1) FIRSTNAMES_FIRST_SIMB, SUBSTR(triv.MIDDLENAME, 1, 1) NAMES_FIRST_SIMB, triv.OKLAD, triv.MOB_PHONE, triv.DATE_POST, triv.FACT_ADDRESS_FLAT, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.REG_ADDRESS_STREET, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv.DOCDATE, doc_place.NAME DOCPLACE_NAME, doc_place.NAME_KAZ DOCPLACE_NAME_KAZ, sex.NAME SEX, sex.NAME_KAZ SEX_KAZ, country.RU_NAME FACT_ADDRESS_COUNTRY_ID, branch.NAME BRANCHID, branch.NAME_KZ BRANCHID_KZ, dep.NAME JOB_SP, dep.NAME_KAZ JOB_SP_KAZ, dolzh.D_NAME JOB_POSITION, dolzh.D_NAME_KAZ D_NAME_KAZ from sup_person triv, DIC_DOC_PLACE doc_place, DIC_SEX sex, DIC_COUNTRY country, DIC_BRANCH branch, DIC_DEPARTMENT dep, DIC_DOLZH dolzh where triv.DOCPLACE = doc_place.ID and sex.ID = triv.SEX and country.ID = triv.FACT_ADDRESS_COUNTRY_ID and branch.RFBN_ID = triv.BRANCHID and dep.ID = triv.JOB_SP and dolzh.ID = triv.JOB_POSITION and triv.ID = $empId";
    $sqlEmpInfo = "select triv.DATE_LAYOFF, SUBSTR(triv.FIRSTNAME, 1, 1) FIRSTNAMES_FIRST_SIMB, SUBSTR(triv.MIDDLENAME, 1, 1) NAMES_FIRST_SIMB, triv.OKLAD, triv.MOB_PHONE, triv.DATE_POST, triv.FACT_ADDRESS_FLAT, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.REG_ADDRESS_STREET, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv.DOCDATE, doc_place.NAME DOCPLACE_NAME, doc_place.NAME_KAZ DOCPLACE_NAME_KAZ, sex.NAME SEX, sex.NAME_KAZ SEX_KAZ, country.RU_NAME FACT_ADDRESS_COUNTRY_ID, branch.NAME BRANCHID, branch.NAME_KZ BRANCHID_KZ, dep.NAME JOB_SP, dep.NAME_KAZ JOB_SP_KAZ, dolzh.D_NAME JOB_POSITION, dolzh.D_NAME_KAZ D_NAME_KAZ, (select sup.lastname  from sup_person sup where id = DOLZH.ID_PODPIS_OTPUSK ) sup_lastname, ( select substr(sp.FIRSTNAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS_OTPUSK) first, ( select substr(sp.MIDDLENAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS_OTPUSK) surname,  (select DOLJ.D_NAME from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS_OTPUSK = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec, (select DOLJ.D_NAME_KAZ from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS_OTPUSK = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec_kaz from sup_person triv, DIC_DOC_PLACE doc_place, DIC_SEX sex, DIC_COUNTRY country, DIC_BRANCH branch, DIC_DEPARTMENT dep, DIC_DOLZH dolzh where triv.DOCPLACE = doc_place.ID and sex.ID = triv.SEX and country.ID = triv.FACT_ADDRESS_COUNTRY_ID and branch.RFBN_ID = triv.BRANCHID and dep.ID = triv.JOB_SP and dolzh.ID = triv.JOB_POSITION and triv.ID = $empId";

    if(isset($_GET['HOLIDAYS_ID']))
        {
            $holi_id = $_GET['HOLIDAYS_ID'];
              $sqlEmpInfo = "select DOLZH.SKLON_DAT, branch.NAME_KZ BRANCHID_KZ, branch.NAME BRANCHID, SUBSTR(triv.FIRSTNAME, 1, 1) FIRSTNAMES_FIRST_SIMB, SUBSTR(triv.MIDDLENAME, 1, 1) NAMES_FIRST_SIMB, DOLZH.D_NAME JOB_POSITION, DOLZH.D_NAME_KAZ D_NAME_KAZ, DEP.NAME JOB_SP, DEP.NAME_KAZ JOB_SP_KAZ,triv.FACT_ADDRESS_FLAT, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.REG_ADDRESS_STREET, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv.DOCDATE,  holi.DATE_BEGIN, holi.DATE_END, CNT_DAYS, PERIOD_BEGIN, PERIOD_END, ORDER_NUM, ORDER_DATE, DOLZH.ID_PODPIS, (select sup.lastname  from sup_person sup where id = DOLZH.ID_PODPIS_OTPUSK ) sup_lastname, ( select substr(sp.FIRSTNAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS_OTPUSK) first, ( select substr(sp.MIDDLENAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS_OTPUSK) surname,  (select DOLJ.D_NAME from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS_OTPUSK = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec, (select DOLJ.D_NAME_KAZ from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS_OTPUSK = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec_kaz, APP.APP_KAZ, APP.APP_RUS from PERSON_HOLIDAYS holi, sup_person triv, DIC_DEPARTMENT dep, DIC_DOLZH dolzh, DIC_BRANCH branch, DIC_APP app WHERE triv.ID = holi.ID_PERSON and TRIV.JOB_SP = DEP.ID and DOLZH.ID = TRIV.JOB_POSITION and branch.RFBN_ID = triv.BRANCHID and holi.ID = $holi_id and DOLZH.PRILOZHENIA_OTPUSK = app.id";
           // $sqlEmpInfo = "select branch.NAME_KZ BRANCHID_KZ, branch.NAME BRANCHID, SUBSTR(triv.FIRSTNAME, 1, 1) FIRSTNAMES_FIRST_SIMB, SUBSTR(triv.MIDDLENAME, 1, 1) NAMES_FIRST_SIMB, DOLZH.D_NAME JOB_POSITION, DOLZH.D_NAME_KAZ D_NAME_KAZ, DEP.NAME JOB_SP, DEP.NAME_KAZ JOB_SP_KAZ,triv.FACT_ADDRESS_FLAT, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.REG_ADDRESS_STREET, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv.DOCDATE,  holi.DATE_BEGIN, holi.DATE_END, CNT_DAYS, PERIOD_BEGIN, PERIOD_END, ORDER_NUM, ORDER_DATE from PERSON_HOLIDAYS holi, sup_person triv, DIC_DEPARTMENT dep, DIC_DOLZH dolzh, DIC_BRANCH branch WHERE triv.ID = holi.ID_PERSON and TRIV.JOB_SP = DEP.ID and DOLZH.ID = TRIV.JOB_POSITION and branch.RFBN_ID = triv.BRANCHID and holi.ID = $holi_id";
        }
        $empInfo = $db -> Select($sqlEmpInfo);

    if($_GET['temp_id'] == 38)
    {
        $sql_holy_return = "select branch.NAME_KZ BRANCHID_KZ, branch.NAME BRANCHID, SUBSTR(triv.FIRSTNAME, 1, 1) FIRSTNAMES_FIRST_SIMB, SUBSTR(triv.MIDDLENAME, 1, 1) NAMES_FIRST_SIMB, DOLZH.D_NAME JOB_POSITION, DOLZH.D_NAME_KAZ D_NAME_KAZ, DEP.NAME JOB_SP, DEP.NAME_KAZ JOB_SP_KAZ,triv.FACT_ADDRESS_FLAT, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.REG_ADDRESS_STREET, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv.DOCDATE, holy_ret.DATE_HOLY_START, holy_ret.DATE_HOLY_END, holy_ret.DAY_COUNT, (select sup.lastname  from sup_person sup where id = DOLZH.ID_PODPIS ) sup_lastname, ( select substr(sp.FIRSTNAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) first, ( select substr(sp.MIDDLENAME, 1, 1) from sup_person sp where sp.id = DOLZH.ID_PODPIS) surname,  (select DOLJ.D_NAME from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec, (select DOLJ.D_NAME_KAZ from DIC_DOLZH dolj, sup_person sp where DOLZH.ID_PODPIS = sp.id and sp.JOB_POSITION = DOLJ.ID  ) spec_kaz from RETURN_FROM_HOLY holy_ret, PERSON_HOLIDAYS holi, sup_person triv, DIC_DEPARTMENT dep, DIC_DOLZH dolzh, DIC_BRANCH branch where holy_ret.ID_HOLY = holi.ID and triv.ID = holi.ID_PERSON and TRIV.JOB_SP = DEP.ID and branch.RFBN_ID = triv.BRANCHID and DOLZH.ID = TRIV.JOB_POSITION and ID_HOLY = ".$_GET['HOLIDAYS_ID'];
       // $sql_holy_return = "select branch.NAME_KZ BRANCHID_KZ, branch.NAME BRANCHID, SUBSTR(triv.FIRSTNAME, 1, 1) FIRSTNAMES_FIRST_SIMB, SUBSTR(triv.MIDDLENAME, 1, 1) NAMES_FIRST_SIMB, DOLZH.D_NAME JOB_POSITION, DOLZH.D_NAME_KAZ D_NAME_KAZ, DEP.NAME JOB_SP, DEP.NAME_KAZ JOB_SP_KAZ,triv.FACT_ADDRESS_FLAT, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.REG_ADDRESS_STREET, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.BIRTHDATE, triv.IIN, triv.CONTRACT_JOB_NUM, triv.CONTRACT_JOB_DATE, triv.DOCNUM, triv.DOCDATE, holy_ret.DATE_HOLY_START, holy_ret.DATE_HOLY_END, holy_ret.DAY_COUNT from RETURN_FROM_HOLY holy_ret, PERSON_HOLIDAYS holi, sup_person triv, DIC_DEPARTMENT dep, DIC_DOLZH dolzh, DIC_BRANCH branch where holy_ret.ID_HOLY = holi.ID and triv.ID = holi.ID_PERSON and TRIV.JOB_SP = DEP.ID and branch.RFBN_ID = triv.BRANCHID and DOLZH.ID = TRIV.JOB_POSITION and ID_HOLY = ".$_GET['HOLIDAYS_ID'];
        $empInfo = $db -> Select($sql_holy_return);
    }

    foreach($list_temp as $k => $v)
    {
        $NUM_PP = $v['NUM_PP'];
        if($NUM_PP == 6){
            $size = '48%';
        }
            else
        {
            $size = '100%';
        }
        $ID_OTCHET = $v['ID_OTCHET'];
        $POSITION = $v['POSITION'];
        $TITLE = $v['TITLE'];
        $HTML_TEXT = base64_decode($v['HTML_TEXT']);
        $ID = $v['ID'];
        foreach($list_meta as $k => $v)
        {
            $arr_elem_name = $v['VARIABLE'];            
            $repl_var = $empInfo[0]["$arr_elem_name"];                               

                         
            if($v['META'] == '%текущий_год%')
            {
                $repl_var = date('Y');
            }
            
            if($v['META'] == '%позиция_подписанта%')
            {
                $d = $empInfo[0]['SPEC'];
                $razb = explode(" ", $d);
                
                $repl_var = mb_convert_case($d,  MB_CASE_TITLE, 'UTF-8');               
            }
            
             if($v['META'] == '%позиция_подписанта_каз%')
            {
                $dr = $empInfo[0]['SPEC_KAZ'];
                $repl_var = mb_convert_case($dr, MB_CASE_TITLE, 'UTF-8');
            }

            
            $HTML_TEXT = str_replace($v['META'], $repl_var, $HTML_TEXT);
        }
        $fin_html .= $HTML_TEXT;
        $html .= "<div style='float: left; width: $size; margin-right: 10px; margin-left: 10px;'>
                         <div>".$fin_html."</div>
                  </div>";
        unset($fin_html);
    }

  //  include("methods/mpdf/mpdf.php");
    
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
        'styles/js/plugins/sweetalert/sweetalert.min.js',
        'styles/js/plugins/summernote/summernote.min.js'
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
        'styles/css/plugins/summernote/summernote.css',
        'styles/css/plugins/summernote/summernote-bs3.css',
        'styles/css/animate.css'
    );
            
    $othersJs .= "<script>
                    $(document).ready(function(){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                        
                        $('#editor_content').summernote({                            
                            toolbar: [                            
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['table', ['table']],
                                ['font', ['fontname']]                    
                            ],
                            fontNames: [
                            'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande',
                            'Sacramento'
                                ]
                        });
                        
                        $('#editor_content').summernote({shortcuts: true});
            
                    });
                    var edit = function() {
                        $('.click2edit').summernote({focus: true});
                    };
                    var save = function() {
                        var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
                        $('.click2edit').destroy();
                    };
            
                </script>";        
?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="mail-box-header">
    <h2>
        Редактирование документа документ
    </h2>
</div>
<div class="col-lg-12 animated fadeInRight" style="background-color: white;">
    <form id="form_send_html" method="POST" action="just_print?file_name=<?php echo $file_name; ?>" target="_blank">
        <input hidden="" name="holi_id" value="<?php echo $holi_id; ?>"/>
        <textarea  name="content" style="width: 100%; ">
        	<?php
                echo $html;
            ?>
        </textarea>
    <div class="mail-body text-right tooltip-demo">
        <button onclick="" type="submit" target="_blank" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="print"><i class="fa fa-reply"></i> Конвертировать в PDF</button>
    </div>
    </form>
</div>
<script type="text/javascript" src="styles/js/others/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</body>
</html>
<?php
    exit;
?>
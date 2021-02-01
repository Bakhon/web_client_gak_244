<?php
    $page_title = 'Поиск';
    $panel_title = 'Поиск клиентов';
    
    $breadwin[] = 'Поиск';
    $breadwin[] = 'Поиск клиентов';
    
    array_push($js_loader, 
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'styles/js/inspinia.js',
        'styles/js/plugins/pace/pace.min.js',

        'styles/js/plugins/footable/footable.all.min.js',
        'styles/js/plugins/slick/slick.min.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/others/datepicker.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/jsKnob/jquery.knob.js'
    );
        
    array_push($css_loader, 
        'styles/css/plugins/footable/footable.core.css',

        'styles/css/animate.css',
        'styles/css/style.css',
        'styles/css/plugins/slick/slick.css',
        'styles/css/plugins/slick/slick-theme.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css'
    ); 
        
    $othersJs = "<script>
                $(document).ready(function() {
                        $('.footable').footable();
                        });
                </script>";
        
    $othersJs2 = "<script>
                    $(document).ready(function(){
                        $('.product-images').slick({
                            dots: true
                        });
                    });
                </script>";
                
    /*$othersJs3 = "<script>
        $(document).ready(function(){
            var $image = $('.image-crop > img')
            $($image).cropper({
                aspectRatio: 1.618,
                preview: '.img-preview',
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $('#inputImage');
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val('');
                            $image.cropper('reset', true).cropper('replace', this.result);
                        };
                    } else {
                        showMessage('Please choose an image file.');
                    }
                });
            } else {
                $inputImage.addClass('hide');
            }

            $('#download').click(function() {
                window.open($image.cropper('getDataURL'));
            });

            $('#zoomIn').click(function() {
                $image.cropper('zoom', 0.1);
            });

            $('#zoomOut').click(function() {
                $image.cropper('zoom', -0.1);
            });

            $('#rotateLeft').click(function() {
                $image.cropper('rotate', 45);
            });

            $('#rotateRight').click(function() {
                $image.cropper('rotate', -45);
            });

            $('#setDrag').click(function() {
                $image.cropper('setDragMode', 'crop');
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: 'linked',
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: 'linked',
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: 'dd/mm/yyyy'
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: 'linked',
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                        divStyle.backgroundColor = ev.color.toHex();
                    });

            $('.clockpicker').clockpicker();

            $('input[name='daterange']').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $('.select2_demo_1').select2();
            $('.select2_demo_2').select2();
            $('.select2_demo_3').select2({
                placeholder: 'Select a state',
                allowClear: true
            });


        });
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:'95%'}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

        $('#ionrange_1').ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: '$',
            maxPostfix: '+',
            prettify: false,
            hasGrid: true
        });

        $('#ionrange_2').ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: ' carats',
            prettify: false,
            hasGrid: true
        });

        $('#ionrange_3').ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: '°',
            prettify: false,
            hasGrid: true
        });

        $('#ionrange_4').ionRangeSlider({
            values: [
                'January', 'February', 'March',
                'April', 'May', 'June',
                'July', 'August', 'September',
                'October', 'November', 'December'
            ],
            type: 'single',
            hasGrid: true
        });

        $('#ionrange_5').ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: ' km',
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $('.dial').knob();

        $('#basic_slider').noUiSlider({
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        $('#range_slider').noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        $('#drag-fixed').noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });


    </script>
                ";    */
    
    //Задаем первоначальные параметры SQL тескта
    $sql = "select lastname, firstname, middlename, BIRTHDATE from osns_ns where lastname LIKE upper('ИВА%') and firstname LIKE upper('аб%') and middlename LIKE upper('аб%')";
    
    $db = new DB();
    //$listNS = $db -> Select($sql);
    
    //foreach($listNS as $k => $v){}
    
    //lastname, firstname, middlename, BIRTHDATE, CONTRACT_NUM, CONTRACT_DATE from osns_ns, contracts, clients
                                
    $nothingFound = '<div class="content clearfix">
                        <div aria-hidden="false" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0" class="step-content body current">
                         <div class="text-center m-t-md">
                                <h2>Такого значения нет в базе</h2>
                                <p>
                                    Введите данные в поля поиска
                                </p>
                                </div>
                        </div>
                      </div>';
    
    $inputText = '<div class="content clearfix">
                        <div aria-hidden="false" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0" class="step-content body current">
                         <div class="text-center m-t-md">
                                <h2>Введите данные</h2>
                                <p>
                                    Введите данные в поля поиска
                                </p>
                                </div>
                            </div>
                          </div>';
    
    $head = '   <div class="ibox-content">
                    <div class="form-horizontal scrolltab">
                            <table class="table table-bordered dataTables-example" id="client_dan">
                                <thead>
                                <tr>
                                    <th>Фамилия</th>
                                    <th>Имя</th>
                                    <th>Отчество</th>
                                    <th>Дата рождения</th>
                                    <th>Номер договора ОСНС</th>
                                    <th>Дата договора</th>
                                </tr>
                            </thead>
                            <tbody>';
    $foot = '</tbody></table></div></div>';

    if(isset($_POST['secondName'])){
        $secondName = $_POST['secondName'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        
        //select c .lastname, c.firstname, c.middlename, c.BIRTHDATE, d.CONTRACT_NUM, d.CONTRACT_DATE, s.id, s.cnct_id, s.sicid from clients c, contracts d, osns_ns s where c.sicid = s.sicid and  s.cnct_id = d.cnct_id and lastname LIKE upper('ИВА%') and firstname LIKE upper('%') and middlename LIKE upper('па%')
        
        $sql = "select c .lastname, c.firstname, c.middlename, c.BIRTHDATE, d.CONTRACT_NUM, d.CONTRACT_DATE, s.id, s.cnct_id, s.sicid from clients c, contracts d, osns_ns s where c.sicid = s.sicid and  s.cnct_id = d.cnct_id and c.lastname LIKE upper('$secondName%') and c.firstname LIKE upper('$firstName%') and c.middlename LIKE upper('$middleName%')";
        $db = new DB();
        $listNS = $db -> Select($sql);
        
        showTable($listNS);

        exit;
    }
    
    if(isset($_POST['docSearchNum'])){
        $docSearchNum = $_POST['docSearchNum'];
        $sql = "select c .lastname, c.firstname, c.middlename, c.BIRTHDATE, d.CONTRACT_NUM, d.CONTRACT_DATE, s.id, s.cnct_id, s.sicid from clients c, contracts d, osns_ns s where c.sicid = s.sicid and  s.cnct_id = d.cnct_id and CONTRACT_NUM  LIKE ('%$docSearchNum%') order by LASTNAME";
        $db = new DB();
        $listNS = $db -> Select($sql);
        //print_r ($listNS);
        
        showTable($listNS);
        
        exit;
    }
    
    if(isset($_POST['docStatus'])){
        $docStatus = $_POST['docStatus'];
        $sql = "select c .lastname, c.firstname, c.middlename, c.BIRTHDATE, d.CONTRACT_NUM, d.CONTRACT_DATE, s.id, s.cnct_id, s.sicid from clients c, contracts d, osns_ns s where c.sicid = s.sicid and  s.cnct_id = d.cnct_id and s.state = $docStatus";
        $db = new DB();
        $listStatus = $db -> Select($sql);
        
        showTable($listStatus);
        
        exit;
    }
    
    if(isset($_POST['docReason'])){
        $docReason = $_POST['docReason'];
        $sql = "select c .lastname, c.firstname, c.middlename, c.BIRTHDATE, d.CONTRACT_NUM, d.CONTRACT_DATE, s.id, s.cnct_id, s.sicid from clients c, contracts d, osns_ns s where c.sicid = s.sicid and  s.cnct_id = d.cnct_id and s.ns_reason = $docReason";
        
        $db = new DB();
        $listNs_reason = $db -> Select($sql);
        
        showTable($listNs_reason);
        
        exit;
    }
    
    if(isset($_POST['date_begin_doc'])){
        $date_begin_doc = $_POST['date_begin_doc'];
        $date_end_doc = $_POST['date_end_doc'];
                    
        $sql ="select c .lastname, c.firstname, c.middlename, c.BIRTHDATE, d.CONTRACT_NUM, d.CONTRACT_DATE, s.id, s.cnct_id, s.sicid from clients c, contracts d, osns_ns s where c.sicid = s.sicid and  s.cnct_id = d.cnct_id and s.uv_date between '$date_begin_doc' and '$date_end_doc'";
        
        $db = new DB();
        $listDate_begin_doc = $db -> Select($sql);
        
        showTable($listDate_begin_doc);
        
        exit;
    }
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sic_id = $_POST['sicid'];
        $sql ="select 
                    fond_name(d.id_insur) strahovatel, 
                    client_name(s.sicid) postradav,
                    case when S.UR_L = 1 then  fond_name(s.sicid_v) else  client_name(s.sicid_v) end vigodop,
                    p.LASTNAME, 
                    p.FIRSTNAME,
                    p.MIDDLENAME,
                    p.sicid,
                    state_name_ns(s.state) state_name,
                    p.DEATH_SVID_NUMBER, 
                    p.DEATH_SVID_BEGIN_DATE,  
                    p.DEATH_SVID_ISSUE_ORG_NAME, 
                    S.PAY_SUM , nvl((select sum(sum_pay) from pnpt_payment d where substr(rfpm_id,1,4) in ('0702','0703','0802') and sicid = p.sicid), 0) sum_ost,
                    reason_name(S.ns_reason) reason_name, 
                    bank_name(s.bank_id) bank_name, 
                    d.CONTRACT_NUM, 
                    d.CONTRACT_DATE, categ_pers(s.CATEGOR) categ_pers, s.*, d.*
                from 
                    osns_ns s, 
                    contracts d, 
                    clients p 
                where 
                    s.id =  $id
                    and p.sicid = s.sicid 
                    and d.cnct_id = s.cnct_id";
        $db = new DB();
        $l = $db -> Select($sql);
        
        
        $sqlNSdoc = "select * from ns_docs
                     where reas = 1 and id_ns = $id order by doc_type";
        $n = $db -> Select($sqlNSdoc);
        
        $sqlNSdeath = "select * from ns_docs
                     where reas = 2 and id_ns = $id order by doc_type";
        $nDeath = $db -> Select($sqlNSdeath);
        
        $sqlPayData = "select BRANCH_name(d.rfbn_id) BRANCH_name, d.rfpm_id || '' - ''  || paym_name2(d.rfpm_id) paym_name,
                       bank_name(bank_id) bank_name, d.* 
                            from pnpt_payment d
                       where substr(rfpm_id,1,4) in ('0702','0703','0802')
                       and sicid = $sic_id";
        $payData = $db -> Select($sqlPayData);
        //echo "<pre>";
        //print_r($payData);
        //echo "</pre>";
        
        ?>

        <div class="ibox-title">
                                <h5><?php echo $l[0]['LASTNAME'].' '.$l[0]['FIRSTNAME'].' '.$l[0]['MIDDLENAME']; ?></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-6">
                                    <address>
                                        <strong>Страхователь</strong><br>
                                        <?php echo $l[0]['STRAHOVATEL']; ?>
                                    </address>
                                    <address>
                                        <strong>Застрахованный</strong><br>
                                        <?php echo $l[0]['POSTRADAV']; ?>
                                    </address>
                                    <address>
                                        <strong>Выготоприобретатель</strong><br>
                                        <?php echo $l[0]['VIGODOP']; ?>
                                    </address>
                                </div>
                                <div class="col-lg-3">
                                    <address>
                                        <strong>Дата несчастного случая</strong><br>
                                        <?php echo $l[0]['NS_DATE_UV']; ?>
                                    </address>
                                </div>
                                <div class="col-lg-3">
                                    <address>
                                        <strong>Порядковый номер в журнале</strong><br>
                                            <?php echo $l[0]['UV_NOM']; ?>
                                    </address>
                                </div>
                                <div class="col-lg-6">
                                    <address>
                                        <strong>Причина</strong><br>
                                            <?php echo $l[0]['REASON_NAME']; ?>
                                    </address>
                                    <address>
                                        <strong>Статус</strong><br>
                                            <?php echo $l[0]['STATE_NAME']; ?>
                                    </address>
                                </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                 <div class="row">
                                        <div class="col-lg-12">
                                            <div class="tabs-container">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a data-toggle="tab" href="#tab-21">Регистрация уведомления об НС</a></li>
                                                    <li class=""><a data-toggle="tab" href="#tab-22">Собранные документы</a></li>
                                                    <li class=""><a data-toggle="tab" href="#tab-23">Регистрация НС</a></li>
                                                    <li class=""><a data-toggle="tab" href="#tab-24">Выплатные данные</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div id="tab-21" class="tab-pane active">
                                                        <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Дата вход. документа</strong><br>
                                                                    <?php echo $l[0]['ACT_DATE_IN']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Степень вины работодателя</strong><br>
                                                                    <?php echo $l[0]['STEP_NS']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Номер вход. документа</strong><br>
                                                                    <?php echo $l[0]['ACT_NUM_IN']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Степень тяжести НС</strong><br>
                                                                        <?php echo $l[0]['UV_NOM']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>&nbsp;</strong><br>
                                                                        &nbsp;
                                                                </address>
                                                                <address>
                                                                    <strong>Возраст пострадавшего</strong><br>
                                                                        <?php echo $l[0]['UV_NOM']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                            <div class="i-checks"> <input type="checkbox" checked="" disabled=""/>
                                                                                <label><div id="chekBoxPadding">Временная нетрудоспособность</div></label>
                                                                            </div>
                                                                </address>
                                                                <address>
                                                                            <div class="i-checks"> <input type="checkbox" checked="" disabled=""/>
                                                                                <label><div id="chekBoxPadding">Госпитализация</div></label>
                                                                            </div>
                                                                </address>
                                                            </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Профессия</strong><br>
                                                                    <?php echo $l[0]['PROFESION']; ?>
                                                                </address>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Должность</strong><br>
                                                                    <?php echo $l[0]['NS_DATE_UV']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Средняя ЗП за 12 мес.</strong><br>
                                                                    <?php echo $l[0]['ZP_12MES']; ?>
                                                                </address>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>ЗП в соответствии с заявкой на андеррайтинг</strong><br>
                                                                    <?php echo $l[0]['NS_DATE_UV']; ?>
                                                                </address>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <address>
                                                                    <strong>Крастое описание вреда здровью</strong><br>
                                                                    <?php echo $l[0]['OPIS_VRED']; ?>
                                                                </address>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <address>
                                                                    <strong>Дата причинения вреда здровью</strong><br>
                                                                    <?php echo $l[0]['DATE_VRED']; ?>
                                                                </address>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <address>
                                                                    <strong>Место причинения вреда здровью</strong><br>
                                                                    <?php echo $l[0]['PLACE_VRED']; ?>
                                                                </address>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <address>
                                                                    <strong>Краткое описание обстоятельства причинения вреда здровью</strong><br>
                                                                    <?php echo $l[0]['OPIS_OBST']; ?>
                                                                </address>
                                                            </div>
                                                    </div>   
                                                    <div class="row">
                                                            <div class="col-lg-6">
                                                                <address>
                                                                    <strong>Тип персонала</strong><br>
                                                                    <?php echo $l[0]['CATEG_PERS']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <address>
                                                                    <strong>Родственные отношения иждивенца к застрахованному</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                    </div> 
                                                    <div class="row">
                                                            <div class="col-lg-4">
                                                                <address>
                                                                    <strong>Номер постановления суда</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <address>
                                                                    <strong>Дата постановления суда</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <address>
                                                                            <div class="i-checks"> <input type="checkbox" checked="" disabled=""/>
                                                                                <label><div id="chekBoxPadding">Выплата по решению суда</div></label>
                                                                            </div>
                                                                </address>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <address>
                                                                    <strong>Основание для выплаты по суду</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                    </div>                                                       
                                                        </div>
                                                    </div>
                                                    <div id="tab-22" class="tab-pane">
                                                        <div class="panel-body">
                                                        <div <?php if(count($n)>0){}else{echo 'hidden=""';} ?>>
                                                        <h4>В случае установления степени утраты профессиональной трудоспособности</h4>
                                                        <div class="col-lg-12">
                                                            <address>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[0]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия договора страхования</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[1]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Акт о несчастном случае</div></label>
                                                                </div><div class="i-checks"> <input type="checkbox" <?php if(isset($n[2]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия дкоумента подтверждающего регистрационный номер налогоплательщика или ИИН пострадавшего работника</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[3]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия справки территориального подразделения уполномоченного органа об установлении утраты профессиональной трудоспособности</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[4]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия документа, подтверждающего наличие проф. заболевания, выданная организацией здравохранения, осуществляющей спец. мед. и экспертной помощи в области профессиональной паталогии</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[5]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия документа, подтверждающего размер заработной платы пострадавшего работника, за проработанный период, но не более чем за 12 месяцев, заверенная работодателем</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[6]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия справки территориального подразделения уполномоченного органа о нуждаемости в дополнительных видах помощи и ухода</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[7]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Документы, подтверждающие фактические расходы на оечение (счет-фактура, кассовый чек и другие)</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($n[8]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия справкитерриториального подразделения уполномоченного органа о размере назначенной выплаты на случай утраты общей трудоспособности либо отказе в ее назначении</div></label>
                                                                </div>
                                                            </address>
                                                        </div>
                                                        </div>
                                                        <div <?php if(count($nDeath) > 0){}else{echo 'hidden=""';} ?>>
                                                        <h4>В случае смерти работника</h4>
                                                        <div class="col-lg-12">
                                                            <address>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($nDeath[0]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия договора страхования</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($nDeath[1]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Акт о несчастном случае</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($nDeath[2]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Нотариально заверенная копия свидетельства о смерти работника</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($nDeath[3]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Нотариально заверенная копия дкоумента, подтверждающего право выготоприобретателя на возмещение вреда в случае смерти работника</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($nDeath[4]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия документа, удостоверяющего личность выготоприобретателя</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($nDeath[5]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия документа, подтверждающего регистрационный номер налогоплательщика или индивиудальный идентификационный номер выготоприобретателя</div></label>
                                                                </div>
                                                                <div class="i-checks"> <input type="checkbox" <?php if(isset($nDeath[6]['DOC_TYPE'])){ echo 'checked=""';} ?> disabled=""/>
                                                                    <label><div id="chekBoxPadding">Копия документа, подтверждающего размер заработной платы за проработанный погибшим работником период, но не более 12 месяцев, заверенная работодателем</div></label>
                                                                </div>
                                                            </address>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tab-23" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <address>
                                                                    <strong>Диагноз</strong><br>
                                                                    <?php echo $l[0]['OPIS_VRED']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <address>
                                                                    <strong>Вредный производственный фактор</strong><br>
                                                                    <?php echo $l[0]['VR_FACT']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <address>
                                                                    <strong>Номер заявления о возмещении</strong><br>
                                                                    <?php echo $l[0]['NOM_Z_VOZM']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Номер заключения НУГТиПЗ</strong><br>
                                                                    <?php echo $l[0]['ZAKL_NOM']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Номер акта Н1</strong><br>
                                                                    <?php echo $l[0]['N1_NOM']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Номер справки МСЭ</strong><br>
                                                                    <?php echo $l[0]['MSE_NOM']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Дата утраты первич. проф. трудоспобности</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>СУПТ (%)</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <address>
                                                                    <strong>от</strong><br>
                                                                    <?php echo $l[0]['DATE_Z_VOZM']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>от</strong><br>
                                                                    <?php echo $l[0]['ZAKL_DATE']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>от</strong><br>
                                                                    <?php echo $l[0]['N1_DATE']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>от</strong><br>
                                                                    <?php echo $l[0]['MSE_DATE']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>по</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>&nbsp;</strong><br>
                                                                    &nbsp;
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <address>
                                                                    <strong>Доля перестраховщика в убытке</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Доля убытка на собственное удержание</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                                <address>
                                                                    <strong>Расходы страховщика на урегулирование убытка</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                                <h4>Регресс</h4>
                                                                <div class="social-feed-box">
                                                                        <dl class="dl-horizontal m-t-md small">
                                                                            <dt>Сумма</dt>
                                                                            <dd>A description list is perfect for defining terms.</dd>
                                                                            <dt>Дата оплаты</dt>
                                                                            <dd>A description list is perfect for defining terms.</dd>
                                                                        </dl>
                                                                </div>
                                                                
                                                            </div>
                                                    </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Номер свидетельства о смерти</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Дата выдачи свидетельства о смерти</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong>Кем выдан</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <address>
                                                                    <strong class="text-danger">Выплата</strong><br>
                                                                    <?php echo $l[0]['STRAHOVATEL']; ?>
                                                                </address>
                                                            </div>
                                                    
                                                    </div>
                                                </div>
                                                <div id="tab-24" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                                            <ul class="list-group">
                                                                                <div class="col-lg-6">
                                                                                    <li class="list-group-item">
                                                                                        <span class="badge badge-primary">16</span>
                                                                                        Совокупный размер выплат
                                                                                    </li>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <li class="list-group-item">
                                                                                        <span class="badge badge-info">16</span>
                                                                                        Остаток выплаты
                                                                                    </li>
                                                                                </div>
                                                                            </ul>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tabs-container">
                                                                    <ul class="nav nav-tabs">
                                                                    <?php
                                                                        $i = 1;
                                                                        foreach($payData as $c => $b){
                                                                            echo '<li class="'; if($i == 1){echo 'active';} echo '"><a data-toggle="tab" href="#tab-3'.$i.'">Выплата '.$i.'</a></li>';
                                                                            $i++;}
                                                                    ?>
                                                                        </ul>
                                                                         <div class="tab-content">   
                                                                    <?php
                                                                        $ii = 1;
                                                                        $yy = 0;    
                                                                        foreach($payData as $c => $b){
                                                                        
                                                                    ?>
                                                                    
                                                                    
                                                                        <div id="tab-3<?php echo $ii; ?>" class="tab-pane <?php if($ii == 1){echo 'active';}?>">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <address>
                                                                                            <strong>Вид выплаты</strong><br>
                                                                                            <?php echo $payData[$yy]['PAYM_NAME']; ?>
                                                                                        </address>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <address>
                                                                                            <strong>Наименование филиала</strong><br>
                                                                                            <?php echo $payData[$yy]['BRANCH_NAME']; ?>
                                                                                        </address>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <address>
                                                                                            <strong>Комиссия банка</strong><br>
                                                                                            0<?php echo $payData[$yy]['BANK_KOMISS']; ?>
                                                                                        </address>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <address>
                                                                                            <strong>Страховая выплата</strong><br>
                                                                                            <?php echo $payData[$yy]['SUM_PAY']; ?>
                                                                                        </address>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <address>
                                                                                            <strong>Сумма к перечислению</strong><br>
                                                                                            <?php echo $payData[$yy]['SUM_NEW']; ?>
                                                                                        </address>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <h4>Банковские реквизиты</h4>
                                                                                    <div class="social-feed-box">
                                                                                            <div class="col-lg-6">
                                                                                                <dl class="dl-horizontal m-t-md small">
                                                                                                    <dt>Банк</dt>
                                                                                                    <dd><?php echo $payData[$yy]['BANK_NAME']; ?></dd>
                                                                                                    <dt>ИИК</dt>
                                                                                                    <dd>A description list is perfect for defining terms.</dd>
                                                                                                </dl>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <dl class="dl-horizontal m-t-md small">
                                                                                                    <dt>Тип счета</dt>
                                                                                                    <dd>A description list is perfect for defining terms.</dd>
                                                                                                    <dt>Счет</dt>
                                                                                                    <dd><?php echo $payData[$yy]['P_ACCOUNT']; ?></dd>
                                                                                                </dl>
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                    <?php
                                                                    $ii++;
                                                                    $yy++;
                                                                        }
                                                                    ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
        <?php
        //echo '<pre>';
        //print_r($l);
        //echo '</pre>';
        exit;
    }
    
    function showTable($list){
        $head = '   <div class="ibox-content">
                        <div class="form-horizontal scrolltab">
                                <table class="table table-bordered dataTables-example" id="client_dan">
                                    <thead>
                                    <tr>
                                        <th>Фамилия</th>
                                        <th>Имя</th>
                                        <th>Отчество</th>
                                        <th>Дата рождения</th>
                                        <th>Номер договора ОСНС</th>
                                        <th>Дата договора</th>
                                    </tr>
                                </thead>
                                <tbody>';
        $foot = '</tbody></table></div></div>';
    
        echo $head;
        foreach($list as $k => $v){
            echo '<tr class="gradeX" sicid="'.$v['SICID'].'" data="'.$v['ID'].'">
                            <td>'.$v['LASTNAME'].'</td>
                            <td>'.$v['FIRSTNAME'].'</td>
                            <td>'.$v['MIDDLENAME'].'</td>
                            <td>'.$v['BIRTHDATE'].'</td>
                            <td>'.$v['CONTRACT_NUM'].'</td>
                            <td>'.$v['CONTRACT_DATE'].'</td>
                        </tr>';
        }
        
        echo $foot;
        
        echo '<script>
                    $("#client_dan tr"). click(
                        function(){
                            var tr = $(this);
                            var id = tr.attr("data");
                            var sicid = tr.attr("sicid");
                            $(".gradeX").attr("class", "gradeX");
                            tr.attr("class", "gradeX active");
                            console.log(id);
                            console.log(sicid);
                            $.post("search_accidents", {"id":id, "sicid":sicid}, function(d){
                                                $("#bottom_panels").html(d);
                                            });
                        }
                    )
                </script>';
        
    
    }
    
    
?>


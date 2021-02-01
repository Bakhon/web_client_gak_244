<?php
    $page_title = 'Справочник сотрудников';
    $panel_title = 'Регистрация сотрудника';
    
    $breadwin[] = 'Справочник сотрудников';
    $breadwin[] = '<a href="clients_edit">Регистрация сотрудника</a>';
    
    $colaps = '';
    $load_page = 'search';
    
    array_push($js_loader,        
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
        'styles/js/plugins/select2/select2.full.min.js',
        'styles/js/plugins/Ilyas/addClients.js',
                
        
        'styles/js/plugins/flot/jquery.flot.js',
        'styles/js/plugins/flot/jquery.flot.tooltip.min.js',
        'styles/js/plugins/flot/jquery.flot.spline.js',
        'styles/js/plugins/flot/jquery.flot.resize.js',
        
        'styles/js/plugins/chartJs/Chart.min.js',
        'styles/js/plugins/peity/jquery.peity.min.js',
        'styles/js/demo/peity-demo.js',
        'styles/js/plugins/jquery-ui/jquery-ui.min.js',
        'styles/js/plugins/gritter/jquery.gritter.min.js',
        'styles/js/plugins/sparkline/jquery.sparkline.min.js',
        'styles/js/demo/sparkline-demo.js',
        
        'styles/js/plugins/toastr/toastr.min.js'
                
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
        'styles/css/style.css',
        'styles/css/plugins/morris/morris-0.4.3.min.css'
    );
    
        
    
    $othersJs = '<script>$(".osnVidDeyatelnosty_contr").select2(); $(document).ready(function () {$(".i-checks").iCheck({checkboxClass: "icheckbox_square-green",radioClass: "iradio_square-green",});});</script>';
    
    $othersJs2 = "<script>$(document).ready(function() {
                        
                        var data1 = [
                            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
                        ];
                        var data2 = [
                            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
                        ];
                        $('#flot-dashboard-chart').length && $.plot($('#flot-dashboard-chart'), [
                            data1, data2
                        ],
                                {
                                    series: {
                                        lines: {
                                            show: false,
                                            fill: true
                                        },
                                        splines: {
                                            show: true,
                                            tension: 0.4,
                                            lineWidth: 1,
                                            fill: 0.4
                                        },
                                        points: {
                                            radius: 0,
                                            show: true
                                        },
                                        shadowSize: 2
                                    },
                                    grid: {
                                        hoverable: true,
                                        clickable: true,
                                        tickColor: '#d5d5d5',
                                        borderWidth: 1,
                                        color: '#d5d5d5'
                                    },
                                    colors: ['#1ab394', '#1C84C6'],
                                    xaxis:{
                                    },
                                    yaxis: {
                                        ticks: 4
                                    },
                                    tooltip: false
                                }
                        );
            
                        var doughnutData = [
                            {
                                value: 20,
                                color: '#a3e1d4',
                                highlight: '#1ab394',
                                label: 'Осталось'
                            },
                            {
                                value: 11,
                                color: '#dedede',
                                highlight: '#1ab394',
                                label: 'Использовано'
                            }
                        ];
            
                        var doughnutOptions = {
                            segmentShowStroke: true,
                            segmentStrokeColor: '#fff',
                            segmentStrokeWidth: 2,
                            percentageInnerCutout: 45, // This is 0 for Pie charts
                            animationSteps: 100,
                            animationEasing: 'easeOutBounce',
                            animateRotate: true,
                            animateScale: false
                        };
            
                        var ctx = document.getElementById('doughnutChart').getContext('2d');
                        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);
            
                        var polarData = [
                            {
                                value: 5,
                                color: '#a3e1d4',
                                highlight: '#1ab394',
                                label: '2014-15 год'
                            },
                            {
                                value: 10,
                                color: '#dedede',
                                highlight: '#1ab394',
                                label: '2015-16 год'
                            },
                            {
                                value: 15,
                                color: '#A4CEE8',
                                highlight: '#1ab394',
                                label: '2016-17 год'
                            }
                        ];
            
                        var polarOptions = {
                            scaleShowLabelBackdrop: true,
                            scaleBackdropColor: 'rgba(255,255,255,0.75)',
                            scaleBeginAtZero: true,
                            scaleBackdropPaddingY: 1,
                            scaleBackdropPaddingX: 1,
                            scaleShowLine: true,
                            segmentShowStroke: true,
                            segmentStrokeColor: '#fff',
                            segmentStrokeWidth: 2,
                            animationSteps: 100,
                            animationEasing: 'easeOutBounce',
                            animateRotate: true,
                            animateScale: false
                        };
                        var ctx = document.getElementById('polarChart').getContext('2d');
                        var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);
            
                    });</script>";
                    
    $othersJs3 = "";
    
    $dbNewClient = new DB();
    $seqOracle = $dbNewClient -> Select("select seq_clients.nextval from dual");
    
    $ivid = 0;
    $seqNextVal = $_GET['sicid'];
        if($_GET['sicid'] == 0){
           $ivid = 1;
           $seqNextVal = $seqOracle[0]['NEXTVAL'];
           //$seqNextVal = $_GET['sicid'];
        }
    
    if(isset($_POST['transport'])){
        ?>
            <hr />
                <div class="form-group">
                   <label class="col-lg-3 control-label">Транспорт</label>
                   <div class="col-lg-9">
                        <select class="select2_demo_1 form-control" name="PAYM_CODE" id="stageSelector">
                            <option>Не выбрано</option>
                            <option value="1">Поезд</option>
                            <option value="2">Самолет</option>
                            <option value="3">Автобус</option>
                            <option value="4">Такси</option>
                            <option value="5">Личный транспорт</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-lg-3 control-label">Откуда</label>
                   <div class="col-lg-9">
                        <select class="select2_demo_1 form-control" name="PAYM_CODE" id="stageSelector">
                            <option>Не выбрано</option>
                            <option value="1">Тест</option>
                            <option value="2">Тест2</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-lg-3 control-label">Куда</label>
                   <div class="col-lg-9">
                        <select class="select2_demo_1 form-control" name="PAYM_CODE" id="stageSelector">
                            <option>Не выбрано</option>
                            <option value="1">Тест</option>
                            <option value="2">Тест2</option>
                        </select>
                    </div>
                </div>
        <?php
        exit;
    }
    
    if(isset($_POST['university'])){  
       ?>
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo $_POST['university'];?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="panel-body" >
                    <div class='m-b-sm'>
                            <small><strong>Название ВУЗа:</strong>"<?php echo $_POST['year'];?>"</small></div>
                        <div class='m-b-sm'>
                            <small><strong>Специальность:</strong>"<?php echo $_POST['spec'];?>"</small></div>
                        <div class='m-b-sm'>
                            <small><strong>Квалификация:</strong>"<?php echo $_POST['quality'];?>"</small></div>
                        <div class='m-b-sm'>
                            <small><strong>Уровень образования:</strong>"<?php echo $_POST['university'];?>"</small></div>
                        <div class='m-b-sm'>
                            <small><strong>Номер диплома:</strong>"<?php echo $_POST['sertNumber'];?>"</small></div>
                </div>
            </div>
        </div> <?php
        exit;
    }
    
    if(isset($_POST['corp'])){
        ?>
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo $_POST['corp'];?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="panel-body" >
                    <div class='m-b-sm'>
                        <small><strong>Название фирмы:</strong><?php echo $_POST['corp'];?></small></div>
                    <div class='m-b-sm'>
                        <small><strong>Дата начала:</strong><?php echo $_POST['yearStart'];?></small></div>
                    <div class='m-b-sm'>
                        <small><strong>Дата конца:</strong><?php echo $_POST['yearEnd'];?></small></div>
                    <div class='m-b-sm'>
                        <small><strong>Должность:</strong><?php echo $_POST['position'];?></small></div>
                </div>
            </div>
        </div>
        <?php
        exit;
    }
    
    if(isset($_POST['firstnameFam'])){
        ?>
        $('#place_for_formAddFamilyMember').append("
        <tr>
            <td class='text-center'>1</td>
            <td> Security doors
                </td>
            <td class='text-center small'>16 Jun 2014</td>
            <td class='text-center'><span class='label label-primary'>$483.00</span></td>
    
        </tr>");
        
        
        <tr>
            <td class="text-center">1</td>
            <td> Security doors
                </td>
            <td class="text-center small">16 Jun 2014</td>
            <td class="text-center"><span class="label label-primary">$483.00</span></td>
    
        </tr>
        <!--
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo $_POST['posFam'].': '.$_POST['firstnameFam'].' '.$_POST['lastnameFam'].' '.$_POST['middlenameFam'];?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="panel-body" >
                                        <div class='m-b-sm'>
                                            <small><strong>Имя:</strong><?php echo $_POST['firstnameFam'];?></small></div>
                                        <div class='m-b-sm'>
                                            <small><strong>Фамилия:</strong><?php echo $_POST['lastnameFam'];?></small></div>
                                        <div class='m-b-sm'>
                                            <small><strong>Отчество:</strong><?php echo $_POST['middlenameFam'];?></small></div>
                                        <div class='m-b-sm'>
                                            <small><strong>Позиция родства:</strong><?php echo $_POST['posFam'];?></small></div>
                                        <div class='m-b-sm'>
                                            <small><strong>Дата рождения:</strong><?php echo $_POST['birthdayFam'];?></small></div>
                </div>
            </div>
        </div>-->
        <?php
        exit;
    }
    
?>
<?php
    $db = new DB();
    
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
        'styles/js/demo/contracts_pa.js',
        'styles/js/plugins/jsTree/jstree.min.js'
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
        'styles/css/plugins/jsTree/style.min.css',
        'styles/css/animate.css'
    );
    
    $othersJs .= "<style>
                    .jstree-open > .jstree-anchor > .fa-folder:before {
                        content: '\f07c';
                    }
                
                    .jstree-default .jstree-icon.none {
                        width: 0;
                    }
                </style>";

    $othersJs .= "<script>
                    $(document).ready(function(){
                
                        $('#jstree1').jstree({
                            'core' : {
                                'check_callback' : true
                            },
                            'plugins' : [ 'types', 'dnd' ],
                            'types' : {
                                'default' : {
                                    'icon' : 'fa fa-folder'
                                },
                                'html' : {
                                    'icon' : 'fa fa-file-code-o'
                                },
                                'svg' : {
                                    'icon' : 'fa fa-file-picture-o'
                                },
                                'css' : {
                                    'icon' : 'fa fa-file-code-o'
                                },
                                'img' : {
                                    'icon' : 'fa fa-file-image-o'
                                },
                                'js' : {
                                    'icon' : 'fa fa-file-text-o'
                                }
                
                            }
                        });
                
                        $('#using_json').jstree({ 'core' : {
                            'data' : [
                                'Empty Folder',
                                {
                                    'text': 'Resources',
                                    'state': {
                                        'opened': true
                                    },
                                    'children': [
                                        {
                                            'text': 'css',
                                            'children': [
                                                {
                                                    'text': 'animate.css', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'bootstrap.css', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'main.css', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'style.css', 'icon': 'none'
                                                }
                                            ],
                                            'state': {
                                                'opened': true
                                            }
                                        },
                                        {
                                            'text': 'js',
                                            'children': [
                                                {
                                                    'text': 'bootstrap.js', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'inspinia.min.js', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'jquery.min.js', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'jsTree.min.js', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'custom.min.js', 'icon': 'none'
                                                }
                                            ],
                                            'state': {
                                                'opened': true
                                            }
                                        },
                                        {
                                            'text': 'html',
                                            'children': [
                                                {
                                                    'text': 'layout.html', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'navigation.html', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'navbar.html', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'footer.html', 'icon': 'none'
                                                },
                                                {
                                                    'text': 'sidebar.html', 'icon': 'none'
                                                }
                                            ],
                                            'state': {
                                                'opened': true
                                            }
                                        }
                                    ]
                                },
                                'Fonts',
                                'Images',
                                'Scripts',
                                'Templates',
                            ]
                        } });
                
                    });
                </script>";
                
        $sql_CEO = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 1 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_CEO = $db -> Select($sql_CEO);
        
        $sql_COO = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 3 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_COO = $db -> Select($sql_COO);
        
        $sql_deputy_CEO = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 2 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_deputy_CEO = $db -> Select($sql_deputy_CEO);
        
        $sql_СVO = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 4 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_СVO = $db -> Select($sql_СVO);
        
        $sql_mark_chief = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 5 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_mark_chief = $db -> Select($sql_mark_chief);
        
        $sql_region_dev = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 167 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_region_dev = $db -> Select($sql_region_dev);
        
        $sql_public_rel = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 168 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_public_rel = $db -> Select($sql_public_rel);
        
        $sql_reins = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 50 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_reins = $db -> Select($sql_reins);
        
        $sql_strat = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 10 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_strat = $db -> Select($sql_strat);
        
        $sql_adm = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 41 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_adm = $db -> Select($sql_adm);
        
        $sql_accountant = "select pers.LASTNAME, pers.FIRSTNAME, dolzh.D_NAME, state.NAME from DIC_DOLZH dolzh, sup_person pers, DIC_PERSON_STATE state where dolzh.id = 14 and pers.JOB_POSITION = dolzh.id and state.ID = pers.STATE";
        $list_accountant = $db -> Select($sql_accountant);
        
        //филиалы
        $sqlBranch = "select * from dic_branch where asko is null order by NAME";
        $listBranch = $db -> Select($sqlBranch);
        //echo '<pre>';
        //print_r($list_chief);
        //echo '<pre>';
?>
<?php
$title = '';

require_once 'methods/tabel_new.php';
$sup = new NEWTABLE();
$dan = $sup->array; 

    
    array_push($css_loader, "styles/css/plugins/jsTree/style.min.css");
    array_push($js_loader, "styles/js/plugins/jsTree/jstree.min.js");
    
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
                                'dolzh':{
                					'icon' : 'fa fa-child'
                				},
                                
                            }
                        });                                       
                
                    });
                </script>";
 


?>

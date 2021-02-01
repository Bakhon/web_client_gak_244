<?php
    $db = new DB();

    if(isset($_POST['position_id'])){
        $pos_id = $_POST['position_id'];
        
        $sql_events_del = "delete EVENT_POSIOTION where POS_ID =  '$pos_id'";
        $list_events_del = $db->Execute($sql_events_del);
        //echo $sql_events_del.'<br>';
        
        foreach($_POST['item'] as $k=>$r){
            $sql_events = "insert into EVENT_POSIOTION (POS_ID, EVENT_ID) values ('$pos_id', '$r')";
            $list_events = $db->Execute($sql_events);
        }
        header('Location: docs_privilege');
    }
    
    $sql_events = "select * from EVENTS order by ID";
    $list_events = $db -> Select($sql_events);
    
    if(isset($_POST['get_docs_privilege']))
    {
        $pos_id = $_POST['position_id_get_privelege'];
        
        $sql_events_checked = "select event_pos.EVENT_ID, event_pos.POS_ID, events.ITEM_NAME from EVENT_POSIOTION event_pos, EVENTS events where event_pos.EVENT_ID = events.ID and event_pos.POS_ID = '$pos_id'";
        $list_events_checked = $db->Select($sql_events_checked);
        
        foreach($list_events as $k => $v){
            $state = '';
            foreach($list_events_checked as $w => $q){
                if($v['ID'] == $q['EVENT_ID']){
                    $state = 'checked=""';
                }
            }
            ?>
                <p>
                    <label>
                        <input <?php echo $state; ?> name="item[]" type="checkbox" value="<?php echo $v['ID']; ?>"/> <?php echo $v['ITEM_NAME']; ?>
                    </label>
                </p>
                <hr/>
            <?php
        }
        exit;
    }

	$title = 'Назначение формы к должности';
    require_once 'methods/set_roles.php';
    $class = new SET_ROLES();
    $dan = $class->array;
    
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




s
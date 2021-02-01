<?php
    $db = new DB();

    if(isset($_POST['DELETE_STEP_NUM']))
    {
        $DELETE_STEP_NUM = $_POST['DELETE_STEP_NUM'];
        $sql_step_del = "delete DOC_TRIP_STEPS where ID = '$DELETE_STEP_NUM'";
        $list_step_del = $db->Select($sql_step_del);
    }

    if(isset($_POST['STEP_NUM']))
    {
        $STEP_NUM = $_POST['STEP_NUM'];
        $TRIP_NUM = $_POST['TRIP_NUM'];
        $sql_new_step = "INSERT INTO DOC_TRIP_STEPS (ID, TRIP_ID, STEP_ID) VALUES (SEQ_DOC_TRIP_STEPS.NEXTVAL, '$TRIP_NUM', '$STEP_NUM')";
        $list_new_step = $db->Execute($sql_new_step);
    }

    if(isset($_POST['TRIP_NAME']))
    {
        $TRIP_NAME = $_POST['TRIP_NAME'];
        $TRIP_TYPE = $_POST['TRIP_TYPE'];
        $sql_new_trip = "INSERT INTO DOC_TRIP (ID, TRIP_NAME, TRIP_TYPE) VALUES (SEQ_DOC_TRIP.NEXTVAL, '$TRIP_NAME', '$TRIP_TYPE')";
        $list_new_trip = $db->Execute($sql_new_trip);
    }

    if(isset($_POST['ADD_NEW_PRIV_STEP'])){
        $dest_id = $_POST['ADD_NEW_PRIV_STEP'];
        $sql_dest_del = "delete EVENT_AND_DESTINATION where DEST_ID = $dest_id";
        $list_dest_del = $db->Select($sql_dest_del);
        foreach($_POST['step_func'] as $k => $v)
        {
            $sql_new_dest_id = "insert into EVENT_AND_DESTINATION (ID, DEST_ID, EVENT_ID) values (SEQ_EVENT_AND_DESTINATION.nextval, $dest_id, $v)";
            $list_new_dest_id = $db->Execute($sql_new_dest_id);
        }
    }

    if(isset($_POST['new_pers_priv']))
    {
        $dest_id = $_POST['new_pers_priv'];
        $sql_dest_del = "delete DOC_TRIP_PRIVELEG_GROUP where STEP_ID = $dest_id";
        $list_dest_del = $db->Select($sql_dest_del);
        foreach($_POST['item_priv_pers'] as $k => $v)
        {
            $sql_new_dest_id = "insert into DOC_TRIP_PRIVELEG_GROUP (ID, STEP_ID, GROUP_ID) values (SEQ_DOC_TRIP_PRIVELEG_GROUP.nextval, $dest_id, $v)";
            $list_new_dest_id = $db->Execute($sql_new_dest_id);            
        }
    }

    if(isset($_POST['ADD_PRIV_STEP']))
    {
        $dest_id = $_POST['ADD_PRIV_STEP'];
        $sql_dest_del = "delete DOC_TRIP_PRIVELEG_GROUP where STEP_ID = $dest_id";
        $list_dest_del = $db->Select($sql_dest_del);
        foreach($_POST['step_item'] as $k => $v)
        {
            $sql_new_dest_id = "insert into DOC_TRIP_PRIVELEG_GROUP (ID, STEP_ID, GROUP_ID) values (SEQ_DOC_TRIP_PRIVELEG_GROUP.nextval, $dest_id, $v)";
            $list_new_dest_id = $db->Execute($sql_new_dest_id);
        }
    }

    if(isset($_POST['get_func_for_groups']))
    {
        //echo $_POST['get_func_for_groups'];        
        $dest_id = $_POST['get_func_for_groups'];

        $sql_dest = "select * from EVENTS where TYPE = 3 order by ID";
        $list_dest = $db->Select($sql_dest);

        $sql_dest_id = "select * from EVENT_AND_DESTINATION ev_dest, EVENTS events where events.ID = ev_dest.EVENT_ID and ev_dest.DEST_ID = '$dest_id'";
        $list_dest_id = $db->Select($sql_dest_id);

        echo '<table class="table table-striped table-hover">
            <tbody>';
        foreach($list_dest as $k => $v)
        {
            $state = '';
            foreach($list_dest_id as $w => $q){
                if($v['ID'] == $q['EVENT_ID']){
                    $state = 'checked=""';
                }
            }
    ?>
            <tr>
                <td><a class="client-link"><?php echo $v['ITEM_NAME']; ?></a></td>
                <td class="client-status">
                    <input name="step_func[]" value="<?php echo $v['ID']; ?>" type="checkbox" <?php echo $state; ?>>
                </td>
            </tr>
    <?php
        }
        echo '</tbody>
        </table>';
        exit;                
    }

    if(isset($_POST['get_id_for_groups']))
    {
        $get_id_for_groups = $_POST['get_id_for_groups'];
        $sql_all_step = "select * from DIC_POS_GROUPS order by ID";
        $list_all_step = $db->Select($sql_all_step);
        $sql_dest_id = "select step_pers.*, groups.POS_NAME from DOC_TRIP_PRIVELEG_GROUP step_pers, DIC_POS_GROUPS groups where STEP_ID = '$get_id_for_groups' and groups.ID = step_pers.GROUP_ID";
        $list_dest_id = $db->Select($sql_dest_id);

        echo '<table class="table table-striped table-hover">
            <tbody>';
        foreach($list_all_step as $k => $v)
        {
            $state = '';
            foreach($list_dest_id as $w => $q){
                if($v['ID'] == $q['GROUP_ID']){
                    $state = 'checked=""';
                }
            }
    ?>
            <tr>
                <td><a class="client-link"><?php echo $v['POS_NAME']; ?></a></td>
                <td class="client-status">
                    <input name="item[]" value="<?php echo $v['ID']; ?>" type="checkbox" <?php echo $state; ?>>
                </td>
            </tr>
    <?php
        }
        echo '</tbody>
        </table>';
        exit;
    }            

    if(isset($_POST['dest_id']))
    {
        $dest_id = $_POST['dest_id'];

        $sql_dest = "select * from EVENTS where TYPE = 3 order by ID";
        $list_dest = $db->Select($sql_dest);

        $sql_dest_id = "select * from EVENT_AND_DESTINATION ev_dest, EVENTS events where events.ID = ev_dest.EVENT_ID and ev_dest.DEST_ID = '$dest_id'";
        $list_dest_id = $db->Select($sql_dest_id);

        foreach($list_dest as $k => $v){
            $state = '';
            foreach($list_dest_id as $w => $q){
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
        ?>
            <input hidden="" name="new_event_dest" value="<?php echo $dest_id; ?>"/>
        <?php
        exit;
    }

    if(isset($_POST['dest_id_for_groups']))
    {
        $dest_id = $_POST['dest_id_for_groups'];

        $sql_dest = "select * from DIC_POS_GROUPS order by ID";
        $list_dest = $db->Select($sql_dest);

        $sql_dest_id = "select * from DOC_TRIP_PRIVELEG_GROUP where STEP_ID = '$dest_id'";
        $list_dest_id = $db->Select($sql_dest_id);

        foreach($list_dest as $k => $v)
        {
            $state = '';
            foreach($list_dest_id as $w => $q)
            {
                if($v['ID'] == $q['GROUP_ID'])
                {
                    $state = 'checked=""';
                }
            }
            ?>
                <p>
                    <label>
                        <input <?php echo $state; ?> name="item_priv_pers[]" type="checkbox" value="<?php echo $v['ID']; ?>"/> <?php echo $v['POS_NAME']; ?>
                    </label>
                </p>
                <hr/>
            <?php
        }
        ?>
            <input hidden="" name="new_pers_priv" value="<?php echo $dest_id; ?>"/>
        <?php
        exit;
    }

    array_push
    ($css_loader,
        "styles/css/bootstrap.min.css",
        "styles/font-awesome/css/font-awesome.css",
        "styles/css/plugins/iCheck/custom.css",
        "styles/css/plugins/steps/jquery.steps.css",
        "styles/css/plugins/jsTree/style.min.css"
    );

    array_push
    ($js_loader, 
        "styles/js/plugins/jsTree/jstree.min.js"
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
                                'dolzh':{
                					'icon' : 'fa fa-child'
                				},
                                
                            }
                        });                                       
                
                    });
                </script>";

    $sql_dest = "select * from DIC_DOC_DESTINATION order by ID";
    $list_dest = $db -> Select($sql_dest);

    $sql_events = "select * from EVENTS order by ID";
    $list_events = $db -> Select($sql_events);

    $sql_trip = "select * from DOC_TRIP order by ID";
    $list_trip = $db -> Select($sql_trip);
?>
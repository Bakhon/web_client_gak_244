<?php
    $db = new DB();
    
    if(isset($_POST['recruitId'])){
        $id = $_POST['recruitId'];
        $sql = "update sup_person set STATE = 1 where id = $id";
        $dbChiefRecruit = $db->Select($sql);
        
        $sql = "select s.id, s.lastname||' '||s.firstname||' '||s.middlename fio, s.OKLAD oklad, d.D_NAME dolzh_name, dep.NAME dep_name
            from 
        sup_person s, 
        DIC_DOLZH d, 
        DIC_DEPARTMENT dep 
            where 
        s.state = 0 and 
        d.id = s.JOB_POSITION and 
        DEP.ID = JOB_SP
        order by s.id";
        
        $listEmployee = $db -> Select($sql);
        foreach($listEmployee as $k => $v){
        ?>
        <tr class="gradeX">
            <td><?php echo $v['FIO']; ?></td>
            <td><?php echo $v['DEP_NAME']; ?>
            </td>
            <td><?php echo $v['DOLZH_NAME']; ?></td>
            <td class="center"><?php echo $v['OKLAD']; ?> тг.</td>
            <td class="">
                <div class="btn-group">
                    <a onclick="refuse(<?php echo $v['ID']; ?>);" class="btn-white btn btn-xs">Отклонить</a>
                    <a onclick="recruit(<?php echo $v['ID']; ?>);" class="btn-white btn btn-xs">Утвердить</a>
                </div>
            </td>
        </tr>
        <?php
            }
        exit;
    }

    if(isset($_POST['refuseId'])){
        $id = $_POST['refuseId'];
        $sql = "update sup_person set STATE = 8 where id = $id";
        $dbChiefRefuse = $db->Select($sql);
        
        $sql = "select s.id, s.lastname||' '||s.firstname||' '||s.middlename fio, s.OKLAD oklad, d.D_NAME dolzh_name, dep.NAME dep_name
                    from 
                sup_person s, 
                DIC_DOLZH d, 
                DIC_DEPARTMENT dep 
                    where 
                s.state = 0 and 
                d.id = s.JOB_POSITION and 
                DEP.ID = JOB_SP
                order by s.id";
        
        $listEmployee = $db -> Select($sql);
        foreach($listEmployee as $k => $v){
        ?>
        <tr class="gradeX">
            <td><?php echo $v['FIO']; ?></td>
            <td><?php echo $v['DEP_NAME']; ?>
            </td>
            <td><?php echo $v['DOLZH_NAME']; ?></td>
            <td class="center"><?php echo $v['OKLAD']; ?> тг.</td>
            <td class="">
                <div class="btn-group">
                    <a onclick="refuse(<?php echo $v['ID']; ?>);" class="btn-white btn btn-xs">Отклонить</a>
                    <a onclick="recruit(<?php echo $v['ID']; ?>);" class="btn-white btn btn-xs">Утвердить</a>
                </div>
            </td>
        </tr>
        <?php
            }
        exit;
    }

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
    
    //$sql = "select * from sup_person order by id";
                
    $sql = "select s.id, s.lastname||' '||s.firstname||' '||s.middlename fio, s.OKLAD oklad, d.D_NAME dolzh_name, dep.NAME dep_name
        from 
        sup_person s, 
        DIC_DOLZH d, 
        DIC_DEPARTMENT dep 
            where 
        s.state = 0 and 
        d.id = s.JOB_POSITION and
        DEP.ID = JOB_SP
        order by s.id";
    
    $listEmployee = $db -> Select($sql);
    //echo '<pre>';
    //print_r($listEmployee);
    //echo '<pre>';
?>
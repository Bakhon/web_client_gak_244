<?php
    $db = new DB();
    $dan = array();
    
    if(isset($_POST['save'])){
        if(isset($_GET['rfbn_id'])){
            $RFBN_ID = $_GET['rfbn_id'];
            
            $sql = "UPDATE DIC_BRANCH
            SET    NAME          = '".str_replace_kaz($_POST['name'])."',
                   SHORT_NAME    = '".str_replace_kaz($_POST['showrt_name'])."',
                   BOSSNAME      = '".str_replace_kaz($_POST['bossname'])."',
                   DOCUM_RUS     = '".str_replace_kaz($_POST['docum_rus'])."',
                   DOCUM_KZ      = '".str_replace_kaz($_POST['docum_kz'])."',
                   ADDRESS       = '".str_replace_kaz($_POST['address'])."',
                   PHONE         = '".str_replace_kaz($_POST['phone'])."',
                   BOSSNAME2     = '".str_replace_kaz($_POST['bossname2'])."',
                   NAME_KZ       = '".str_replace_kaz($_POST['name_kz'])."',
                   ADDRESS_KZ    = '".str_replace_kaz($_POST['address_kz'])."',
                   BOSSNAME_KZ   = '".str_replace_kaz($_POST['bossname_kz'])."',
                   NAME2         = '".str_replace_kaz($_POST['name2'])."',
                   DOLZHN        = '".str_replace_kaz($_POST['dolzhn'])."',
                   DOLZHN_KAZ    = '".str_replace_kaz($_POST['dolzhn_kaz'])."',
                   DOLZHN2       = '".str_replace_kaz($_POST['dolzhn2'])."',
                   NAME_KZ2      = '".str_replace_kaz($_POST['name_kz2'])."',
                   SHORT_NAME_KZ = '".str_replace_kaz($_POST['short_name_kz'])."',
                   SHORT_BOSS_N  = '".str_replace_kaz($_POST['short_boss_n'])."',
                   ASKO          = '".str_replace_kaz($_POST['asko'])."'
            WHERE  RFBN_ID       = '$RFBN_ID'
            ";
            $d = $db->Execute($sql);
            if($d == true){                
                header("Location: filial");
            }else{
                $msg = $db->message; 
            }                        
        }
    }
    
    array_push($js_loader, 
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js'
    );
        
    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css'        
    );        
    
    $othersJs = "    <script>
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
                'New row',
                'New row' ] );

        }
    </script>";
    
    $page_title = 'Справочники';
    $panel_title = 'Справочник филиалов и подразделений';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Справочник филиалов и подразделений'; 
    
     //Задаем первоначальные параметры SQL тескта    
    $sql = "SELECT d.*, t.name asko_name FROM dic_branch d, DIR_TYPE_PROC t where t.id = nvl(d.asko, 0) ORDER BY d.rfbn_id";
    if(isset($_GET['rfbn_id'])){
        $r = $_GET['rfbn_id'];
        $sql = "SELECT * FROM dic_branch where rfbn_id = '$r'";
    }
       
    
    $dbFilials = $db->Select($sql);  
    if(isset($_POST['save'])){
        $dan = $_POST;
    } else{
        $dan = $dbFilials[0];
    }
    
    $dbPodraz = $db->Select("select * from DIR_TYPE_PROC");  
       
?>
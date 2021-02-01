<?php
    $db = new DB();
    
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
                                'New row' ] );
                
                        }
                    </script>";

    $page_title = 'Справочник';
    $panel_title = 'Справочник префиксов договоров';
    
    $breadwin[] = 'Справочник';
    $breadwin[] = 'Справочник префиксов договоров'; 
    
    //Задаем первоначальные параметры SQL тескта
    $sql = "
            SELECT *
            FROM   prefiks  ";
       
    $dbContrPref = $db->Select($sql);    
    
?>

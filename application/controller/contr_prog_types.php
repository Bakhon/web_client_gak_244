<?php

	array_push($js_loader, 
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'styles/js/inspinia.js',
        'styles/js/plugins/pace/pace.min.js',

        'styles/js/plugins/footable/footable.all.min.js'
    );
        
    array_push($css_loader, 
        'styles/css/plugins/footable/footable.core.css',

        'styles/css/animate.css',
        'styles/css/style.css'        
    ); 
     
     $othersJs = "<script>
                $(document).ready(function() {
                        $('.footable').footable();
                        });
                </script>";
     
    $page_title = 'Справочники';
    $panel_title = 'Виды и программы страхования';
    
    $breadwin[] = 'Справочники';
    $breadwin[] = 'Виды и программы страхования';
    
    $tableHead = '
                <div class="col-lg-8">
                    <div class="ibox-content">
                        <div class="form-horizontal">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                            <th>Код</th>
                                            <th>Наименование</th>
                                            <th>Тип справочника</th>
                                        </tr>
                                </thead>
                                <tbody>';

    function showProgTypesTable(){
                                echo'
                                <div class="col-lg-12">
                                    <div class="ibox-content">
                                        <div class="form-horizontal">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                            <th>Код</th>
                                                            <th>Наименование</th>
                                                            <th>Тип справочника</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="gradeX">
                                                                <td>gg</td>
                                                                <td>s</td>
                                                                <td>bhf</td>
                                                            </tr>';
                                                        echo '</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>';
                        }
?>

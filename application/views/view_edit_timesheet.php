<?php
    $access_date = '2016/11/29';
    $date_elements  = explode("/",$access_date);
    $unixtime = mktime(0,0,0,$date_elements[1],$date_elements[2],$date_elements[0]);
    
    $this_month_last_day = date('t', $unixtime);
    
    $i = 1;
    
    print_r($listJOB_TIME);
?>
<div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="ibox-tools">
                <div class="row m-b-sm m-t-sm">
                <form method="POST">
                    <div class="col-md-5">
                        <dl class="dl-horizontal">
                            <dt>Год:</dt> 
                        <dd>
                        <select name="dep_table" id="dep_table" class="select2_demo_1 form-control">
                        <option></option>
                        <option>2016</option>
                        <option>2017</option>
                        </select>
                        </dd>
                        </dl>
                    </div>
                    <div class="col-md-5">
                        <dl class="dl-horizontal">
                            <dt>Месяц:</dt> 
                        <dd>
                        <select name="dep_table" id="dep_table" class="select2_demo_1 form-control">
                            <option></option>
                            <option>Январь</option>
                            <option>Февраль</option>
                            <option>Март</option>
                            <option>Апрель</option>
                            <option>Май</option>
                            <option>Июнь</option>
                            <option>Июль</option>
                            <option>Август</option>
                            <option>Сентябрь</option>
                            <option>Октябрь</option>
                            <option>Ноябрь</option>
                            <option>Декабрь</option>
                        </select>
                        </dd>
                        </dl>
                    </div>
                
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Показать</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
        <table class="table" >
        <thead>
        <tr>
            <th>ФИО</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
            <th>16</th>
            <th>17</th>
            <th>18</th>
            <th>19</th>
            <th>20</th>
            <th>21</th>
            <th>22</th>
            <th>23</th>
            <th>24</th>
            <th>25</th>
            <th>26</th>
            <th>27</th>
            <th>28</th>
            <th>29</th>
            <th>30</th>
            <th>31</th>
        </tr>
        </thead>
        <tbody>
            <tr class="gradeX" ondblclick="edit_time_sheet(192);">
                <td>Ахметов Ильяс</td>
                <td>
                <select id="190.01.12.2016">
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td><td>
                <select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
                <td><select>
                    <option></option>
                    <option>4</option>
                    <option>8</option>
                </select>
                </td>
            </tr>
            <tr class="gradeX">
                <td>Александр Пушкин</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
            </tr>
            <tr class="gradeX">
                <td>Нурсультан Назарбаев</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
                <td>8</td>
            </tr>
        </tbody>
        </table>
        <div class="col-md-5">
        </div>
        <div class="col-md-5">
        </div>
        <div class="col-md-2">
            <button id="saveTableSheet" class="btn btn-primary">Сохранить</button>
        </div>
        </div>
    </div>              
</div>
</div>
</div>

<script>
    function edit_time_sheet(id){
        var sheet_id = id;
        window.location.replace('http://192.168.5.244/sheet_emp_edit?sheet_id=192&month=11&year=2016');
    }
</script>



<?php
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
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/edit_employees_js.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_osns.js',
        'styles/js/plugins/sweetalert/sweetalert.min.js'
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

    
    $db = new DB();
    
    //табель
    $sql_timesheet = "select * from TABLE_OTHER order by WEEK_DAY";
    $list_timesheet = $db -> Select($sql_timesheet);
    
    //департаменты
    $sqlDepartments = "select * from DIC_Department order by id";
    $listDepartments = $db -> Select($sqlDepartments);
    
    //филиалы
    $sql_branch_name = "select RFBN_ID, NAME from DIC_BRANCH where ASKO is NULL";
    $list_branch_name = $db->Select($sql_branch_name);
    
    //статусы сотрудников
    $sqlState = "select * from DIC_PERSON_STATE order by id";
    $listState = $db -> Select($sqlState);
    
    //guys at depart
    if(isset($_POST['dep_id_for_table']))
    {
        $dep_id_for_table = $_POST['dep_id_for_table'];
        $branch_id = '';
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        $sql_guys = "select LASTNAME,ID from sup_person where JOB_SP = $dep_id_for_table";
        if($_POST['branch_id'] != 0){
            $branch_id = $_POST['branch_id'];
            $sql_guys = "select LASTNAME,ID from sup_person where BRANCHID = '$branch_id'";
            $dep_id_for_table = '';
        }
        //echo $sql_guys;
        $list_guys = $db -> Select($sql_guys);
        
        $sql_guy = "select WEEK_DAY from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and emp_id = 373 order by DAY_DATE";
        $list_guy = $db -> Select($sql_guy);
        //echo $sql_guy;
    }
    
    if(isset($_POST['id_table'])){
        $timesheet_date_start = $_POST['timesheet_date_start'];
        $timesheet_date_end = $_POST['timesheet_date_end'];
        if($_POST['branch_id'] != 0){
            $branch_id = $_POST['branch_id'];
            $sql_guys = "select LASTNAME,ID from sup_person where BRANCHID = '$branch_id'";
            $dep_id_for_table = '';
        }
        $table_id = $_POST['id_table'];
        $table_val = $_POST['table_state'];
        $sql_upd_val = "update TABLE_OTHER SET VALUE = '$table_val' where id = $table_id";
        $list_upd_val = $db -> Select($sql_upd_val);
    }
?>







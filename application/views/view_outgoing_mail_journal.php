<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input value="<?php echo $_POST['timesheet_date_start']; ?>" type="text" class="form-control dateOform" name="timesheet_date_start" data-mask="99.99.9999" id="timesheet_date_start" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input value="<?php echo $_POST['timesheet_date_end']; ?>" type="text" class="form-control dateOform" name="timesheet_date_end" data-mask="99.99.9999" id="timesheet_date_end" required/>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="dl-horizontal">
                                    <dt>Департамент:</dt>
                                <dd>
                                <select onchange="set_null();" name="dep_id_for_table" id="dep_id_for_table" class="select2_demo_1 form-control"/>
                                 <option value=""></option>
                                 <option <?php $dep_id_for_table = $_POST['dep_id_for_table']; if($dep_id_for_table == '') {echo "selected"; } ?> value="">Все</option>
                                    <?php
                                        foreach($dan['dep'] as $u => $i)
                                        {
                                            
                                    ?>
                                        <option <?php if(trim($i['ID']) == "$dep_id_for_table") {echo "selected";} ?> value="<?php echo trim($i['ID']); ?>"><?php echo $i['NAME']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                </dd>
                                </dl>
                            </div>
                            <!--
                            <div class="col-md-5">
                                <dl class="dl-horizontal">
                                    <dt>Филиал:</dt> 
                                <dd>
                                <select name="branch_id" id="branch_id" class="select2_demo_1 form-control branch_id"/>
                                <option value=""></option>
                                    <?php
                                        foreach($list_branch_name as $u => $i)
                                        {
                                    ?>
                                <option <?php if(trim($i['RFBN_ID']) == "$branch_id") {echo "selected";} ?> value="<?php echo trim($i['RFBN_ID']); ?>"><?php echo $i['NAME']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                </dd>
                                </dl>
                            </div>
                            -->
                            <div class="col-md-6">
                                <button type="submit" name="show_journal" class="btn btn-primary col-md-12">Показать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive" id="table_with_data">
                        <table style="width:100%; " class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="color: #23c6c8;">№ исх</th>
                                    <th colspan="2" style="color: #23c6c8;">Дата и индекс исходящего <br />(внутренного документа)</th>
                                    <th style="color: #1c84c6;">Корреспондент</th>
                                    <th style="color: #ed5565;">Заголовок или краткое <br /> содержание документа</th>
                                    <th style="color: #1c84c6;">Департамент</th>
                                </tr>
                                <tr>
                                    <th style="">1</th>
                                    <th style="">2</th>
                                    <th style="">2.1</th>
                                    <th style="">3</th>
                                    <th style="">4</th>
                                    <th style="">5</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                                foreach($dan['journal'] as $k => $v)
                                {
                                    
                                    //запрос значений из таблицы TABLE_OTHER
                                    $sql_timesheet_test = "select * from TABLE_OTHER where EMP_ID = ".$v['ID']." and DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and ACCOUNT_STATE = '1' order by DAY_DATE";
                                    $list_timesheet_test = $db -> Select($sql_timesheet_test);

                                    $hours = 0;
                                    $days = 0;
                                    $regnum = $v['REG_NUM'];
                                    $date_s = $v['DATE_START'];
                                    $to = $v['ORG_SENDER'];
                                    $short_text = $v['SHORT_TEXT'];
                                    $depname = $v['DEPNAME'];
                                    $sign_date = $v['POST_DATE'];
                                    $sign_time = $v['POST_TIME'];
                                    

                                    echo '<tr class="gradeX" style="border: 1px solid #1c84c6;">';
                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #7edddd;
                                            background-color: #23c6c8;
                                            cursor: default;">'
                                            .$i.
                                         '</td>';
                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #5bc0de; 
                                            background-color: #1c84c6;
                                            cursor: default;">'
                                            .$regnum.'</td>';
                                            echo '<td style="
                                            color: white;
                                            border: 1px solid #5bc0de; 
                                            background-color: #1c84c6;
                                            cursor: default;">'
                                            .$sign_date.' '.$sign_time.'</td>';
                                  
                                    echo '<td class="td_table" style=" color: white; border: 1px solid #7edddd;
                                            background-color: #23c6c8;">'.$to.'</td>';
                                    echo '<td class="td_table" style=" color: white; border: 1px solid #5bc0de;
                                            background-color: #1c84c6;">'.$short_text.'</td>';
                                            echo '<td class="td_table" style=" color: white; border: 1px solid #7edddd;
                                            background-color: #23c6c8;">'.$depname.'</td>';
                                    $i++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form target="_blank" id="table_form" method="post" action="export_xls">
                    <input name="dep_id" value="<?php echo $dep_id; ?>" style="display: none;"/>
                    <div hidden="" id="head_of_doc">
                        <div style="text-align: right;">
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;">Отчет по исходящей корреспонденции С <?php echo $_POST['timesheet_date_start']; ?> ПО <?php echo $_POST['timesheet_date_end']; ?></h3>
                                    </strong>
                                </div>
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;"><?php echo $dep_named[0]['NAME']; ?></h3>
                                    </strong>
                                </div>
                                <hr/>
                        </div>
                    </div>
                    <div hidden="" id="foot_of_doc">
                    </div>
                    <textarea hidden="" name="content" id="area_for_print">
                    </textarea>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <a id="submit_and_print" class="btn btn-primary pull-right">
                                <i class="fa fa-check-square-o"></i> 
                                    Экспортировать в excell
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('#submit_and_print').click
    (function() 
        {
            var head_of_doc = $('#head_of_doc').html();
            var foot_of_doc = $('#foot_of_doc').html();
            
            var table_with_data = $('#table_with_data').html();
            $('#area_for_print').html(head_of_doc+table_with_data+foot_of_doc);
            $('#table_form').submit();
        }
    )
</script>
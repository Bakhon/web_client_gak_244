<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group date ">                            
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>                                    
                                    <input value="<?php echo $timesheet_date_start; ?>" type="text" class="form-control dateOform" name="timesheet_date_start" data-mask="99.99.9999" id="timesheet_date_start" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input value="<?php echo $timesheet_date_end; ?>" type="text" class="form-control dateOform" name="timesheet_date_end" data-mask="99.99.9999" id="timesheet_date_end" required/>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary col-md-12">Показать</button>
                            </div>
                            
                        </div>
                        <br />
                        
                    </form>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive" id="table_with_data">
                        <table class="table table-hover">
                            <thead>                              
                                <tr>
                                    <th style="color: #23c6c8;">Вх. №</th>
                                    <th style="color: #23c6c8;">Дата поступления</th>
                                    <th style="color: #1c84c6;">Корреспондент, дата и индекс входящего документа</th>
                                    <th style="color: #ed5565;">Вид документа, заголовок или краткое содержание входящего документа</th>
                                    <th style="color: #1c84c6;">Резолюция или кому направлен документ на исполнение</th>
                                    <th style="color: #1c84c6;">Отметка об исполнение документа</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list_guys as $k => $v)
                                {
                                    //запрос значений из таблицы TABLE_OTHER
                                    $sql_timesheet_test = "select * from TABLE_OTHER where EMP_ID = ".$v['ID']." and DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and ACCOUNT_STATE = '1' order by DAY_DATE";
                                    $list_timesheet_test = $db -> Select($sql_timesheet_test);

                                    $hours = 0;
                                    $days = 0;
                                    $name = $v['FIRSTNAME'];
                                    $name_first_simb = mb_substr($name,0,1,"UTF-8");
                                    $middlename = $v['MIDDLENAME'];
                                    $middlename_first_simb = mb_substr($middlename,0,1,"UTF-8");
                                    $pers_email = $v['EMAIL'];

                                    echo '<tr class="gradeX" style="border: 1px solid #1c84c6;">';
                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #7edddd;
                                            background-color: #23c6c8;
                                            cursor: default;">'
                                            .$v['LASTNAME'].
                                            '. '.$name_first_simb.'. '.$middlename_first_simb.
                                         '</td>';
                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #5bc0de; 
                                            background-color: #1c84c6;
                                            cursor: default;">'
                                            .$v['D_NAME'].' ('.$pers_email.')'.'</td>';
                                    //в зависимости от значения добавляем стиль
                                    $complete_mail_count = show_complete_mail($pers_email, $timesheet_date_start, $timesheet_date_end);
                                    $at_work_mail_count = show_at_work_mail($pers_email, $timesheet_date_start, $timesheet_date_end);
                                    $inner_mail_count = show_inner_mail($pers_email, $timesheet_date_start, $timesheet_date_end);
                                    $outer_mail_count = show_outer_mail($pers_email, $timesheet_date_start, $timesheet_date_end);
                                    echo '<td class="td_table">'.$complete_mail_count.'</td>';
                                    echo '<td class="td_table">'.$at_work_mail_count.'</td>';
                                    echo '<td class="td_table">'.$inner_mail_count.'</td>';
                                    echo '<td class="td_table">'.$outer_mail_count.'</td>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form target="_blank" id="table_form" method="post" action="print_timesheet">
                    <input name="dep_id" value="<?php echo $dep_id; ?>" style="display: none;"/>
                    <div hidden="" id="head_of_doc">
                        <div style="text-align: right;">
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;">ОТЧЕТ ПО СЭД С <?php echo $timesheet_date_start; ?> ПО <?php echo $timesheet_date_end; ?></h3>
                                    </strong>
                                </div>
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;"><?php echo $dep_name; ?></h3>
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
                                    Утвердить и отправить на печать
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
                                    <input value="<?php echo $timesheet_date_start; ?>" type="text" class="form-control dateOform" name="timesheet_date_start" data-mask="99.99.9999" id="timesheet_date_start" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input value="<?php echo $timesheet_date_end; ?>" type="text" class="form-control dateOform" name="timesheet_date_end" data-mask="99.99.9999" id="timesheet_date_end" required/>
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
                                <option></option>
                                    <?php
                                        foreach($listDepartments as $u => $i)
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
                                <button type="submit" class="btn btn-primary col-md-12">Показать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive" id="table_with_data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="color: #23c6c8;"></th>
                                    <th style="color: #23c6c8;"></th>
                                    <th style="color: #1c84c6;" colspan="2">Входящие</th>
                                    <th style="color: #ed5565;" colspan="2">Исходящие</th>
                                </tr>
                                <tr>
                                    <th style="color: #23c6c8;">ФИО</th>
                                    <th style="color: #23c6c8;">Должность</th>
                                    <th style="color: #1c84c6;">Завершено</th>
                                    <th style="color: #ed5565;">Поступило в работу</th>
                                    <th style="color: #1c84c6;">Внутренние</th>
                                    <th style="color: #1c84c6;">Внешние</th>
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

<?php
    function show_complete_mail($emp_mail, $timesheet_date_start, $timesheet_date_end)
    {
        $db = new DB();
        $all_tables_name = get_all_tables();
        $on_inbox_new_all = 0;
        for($i=0;$i<count($all_tables_name);$i++)
        {
            $table_name = $all_tables_name[$i];
            $sql_inbox .=
                        "select
                           rec.ID
                        from
                           $table_name rec
                        where
                           rec.RECIEP_MAIL = '$emp_mail'
                           and rec.STATE = '2'
                           and rec.POST_DATE BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";
            $list_inbox = $db -> Select($sql_inbox);
            //echo $sql_inbox.'<br /><br />';
            $on_inbox_new = count($list_inbox);
            $on_inbox_new_all = $on_inbox_new+$on_inbox_new_all;
            $sql_inbox = "";
        }

        //делегированные
 /*       $sql_inbox .= 
            "select
               doc.CURRENT_STEP_ID,
               doc.NEXT_STEP_ID,
               doc.PREV_STEP_ID,
               doc.REG_NUM,
               doc.DATE_END,
               doc.SENDER,
               rec.DESTINATION,
               doc.DOC_LINK,
               rec.READ,
               DOC.DATE_START,
               KIND.NAME_KIND,
               STATE.STATE_NAME,
               DOC.SHORT_TEXT,
               rec.ID,
               doc.ID MAIL_ID,
               REC.COMMENT_TO_DOC,
               REC.SENDER_MAIL
            from
               DOC_RECIEPMENTS rec,
               DOCUMENTS doc,
               DIC_DOC_STATE state,
               DIC_DOC_KIND kind
            where
               rec.SENDER_MAIL = '$emp_mail'
               and REC.STATE = STATE.ID
               and REC.MAIL_ID = DOC.ID
               and KIND.ID = DOC.KIND
               and rec.STATE = 2
               and rec.DESTINATION = 5"; */
         
         //делегир      
              $sql_inbox .= "select
               doc.CURRENT_STEP_ID,
               doc.NEXT_STEP_ID,
               doc.PREV_STEP_ID,
               doc.REG_NUM,
               doc.DATE_END,
               doc.SENDER,
               rec.DESTINATION,
               doc.DOC_LINK,
               rec.READ,
               DOC.DATE_START,
               KIND.NAME_KIND,
               STATE.STATE_NAME,
               DOC.SHORT_TEXT,
               rec.ID,
               doc.ID MAIL_ID,
               REC.COMMENT_TO_DOC,
               REC.RECIEP_MAIL,
               rec.post_date           
            from
               DOC_RECIEPMENTS rec,
               DOCUMENTS doc,
               DIC_DOC_STATE state,
               DIC_DOC_KIND kind
            where
               rec.RECIEP_MAIL = '$emp_mail'
               and REC.STATE = STATE.ID
               and REC.MAIL_ID = DOC.ID
               and KIND.ID = DOC.KIND
               and rec.STATE = 5
               and rec.post_date BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";                              
               
        $list_inbox = $db -> Select($sql_inbox);
        //echo $sql_inbox.'<br /><br />';
        $on_inbox_new = 0;
        $on_inbox_new = count($list_inbox);
        $on_inbox_new_all = $on_inbox_new+$on_inbox_new_all;
        return $on_inbox_new_all;
    }

    function show_at_work_mail($emp_mail, $timesheet_date_start, $timesheet_date_end)
    {
        $db = new DB();
        $all_tables_name = get_all_tables();
        $on_inbox_new_all = 0;
        for($i=0;$i<count($all_tables_name);$i++)
        {
            $table_name = $all_tables_name[$i];
            if($table_name == 'DOC_RECIEPMENTS_ASSIGNMENT')
            {
               $column_name = 'SENDER_MAIL';
            }
                else
            {
                $column_name = 'RECIEP_MAIL';
            }
            $sql_inbox .=
                        "select
                           rec.ID
                        from
                           $table_name rec
                        where
                           rec.$column_name = '$emp_mail'
                           and (rec.STATE = '0' OR rec.STATE = '1' or rec.state = '2' or rec.state = '5')
                           and rec.STATE != '6'
                           and rec.RECIEP_DATE BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";
            $list_inbox = $db -> Select($sql_inbox);            
            //echo $sql_inbox.'<br /><br />';
            $on_inbox_new = count($list_inbox);
            $on_inbox_new_all = $on_inbox_new+$on_inbox_new_all;
            $sql_inbox = "";
        }
        $sql_inbox .=
                    "select
                       rec.ID
                    from
                       DOC_RECIEPMENTS_ASSIGNMENT rec
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and (rec.STATE = '0' OR rec.STATE = '1' or rec.state = '2')
                       and rec.DESTINATION = '5'
                       and rec.RECIEP_DATE BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";
        $list_inbox = $db -> Select($sql_inbox);
        //echo $sql_inbox;
        $on_inbox_new = count($list_inbox);
        $on_inbox_new_all = $on_inbox_new+$on_inbox_new_all;
        return $on_inbox_new_all;
    }

    function show_inner_mail($emp_mail, $timesheet_date_start, $timesheet_date_end)
    {
        $db = new DB();
        $sql_inbox .=
        "select
           doc.ID
        from
           DOCUMENTS doc
        where
           doc.SENDER_MAIL = '$emp_mail'
           and doc.TYPE = 0
           and doc.STATE != 0
           and doc.DATE_START BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";
        $list_inbox = $db -> Select($sql_inbox);
        //echo $sql_inbox.'<br /><br />';
        $on_inbox_new = count($list_inbox);
        return $on_inbox_new;
    }

    function show_outer_mail($emp_mail, $timesheet_date_start, $timesheet_date_end)
    {
        $db = new DB();
        $sql_inbox .=
        "select
           doc.ID
        from
           DOCUMENTS doc
        where
           doc.SENDER_MAIL = '$emp_mail'
           and doc.TYPE = 1
           and doc.STATE != 0
           and doc.DATE_START BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";
        $list_inbox = $db -> Select($sql_inbox);
        //echo $sql_inbox.'<br /><br />';
        $on_inbox_new = count($list_inbox);
        return $on_inbox_new;
    }

    function get_all_tables()
    {
        $all_tables = array
        (
            0  => "DOC_RECIEPMENTS",
            1  => "DOC_RECIEPMENTS_AGREEMENT",
            2  => "DOC_RECIEPMENTS_ASSIGNMENT",
            3  => "DOC_RECIEPMENTS_CONTROL",
            4  => "DOC_RECIEPMENTS_REGIST_OUT",
            5  => "DOC_RECIEPMENTS_REGISTRATION",
            6  => "DOC_RECIEPMENTS_RESOLUTION",
            7  => "DOC_RECIEPMENTS_SIGNATURE"
        );

        //echo '<pre>';
        //print_r($all_tables);
        //echo '<pre>';
        return $all_tables;
    }
?>
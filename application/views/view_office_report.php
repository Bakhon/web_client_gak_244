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
                            <div class="col-md-12">
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
                                    <th style="color: #1c84c6;" colspan="4">Количество корреспонденции на состояние <?php echo $timesheet_date_start.' - '.$timesheet_date_end; ?></th>
                                </tr>
                                <tr>
                                    <th style="color: #23c6c8;">№</th>
                                    <th style="color: #23c6c8;">СП</th>
                                    <th style="color: #1c84c6;">Количество входящих писем</th>
                                    <th style="color: #1c84c6;">Количество исходящих писем</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($listDepartments as $k => $v)
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
                                    $dep_id = $v['ID'];

                                    echo '<tr class="gradeX" style="border: 1px solid #1c84c6;">';
                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #7edddd;
                                            background-color: #23c6c8;
                                            cursor: default;">'
                                            .$v['ID'].
                                         '</td>';
                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #5bc0de; 
                                            background-color: #1c84c6;
                                            cursor: default;">'
                                            .$v['SHORT_NAME'].'</td>';
                                    //в зависимости от значения добавляем стиль
                                    $complete_incoming = show_incoming($dep_id, $timesheet_date_start, $timesheet_date_end);
                                    $complete_outgoing = show_outgoing($dep_id, $timesheet_date_start, $timesheet_date_end);
                                    echo '<td class="td_table">'.$complete_incoming.'</td>';
                                    echo '<td class="td_table">'.$complete_outgoing.'</td>';
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
    function show_incoming($dep_id, $timesheet_date_start, $timesheet_date_end)
    {
        $db = new DB();
        $list_guys= $db->Select("select trivial.EMAIL from SUP_PERSON trivial where TRIVIAL.JOB_SP = $dep_id and TRIVIAL.STATE = 2");
        $on_inbox_new_all = 0;
        foreach($list_guys as $k => $v)
        {
            $dir_email = $v['EMAIL'];
            $outer_mail_count = show_incoming_mail($dir_email, $timesheet_date_start, $timesheet_date_end);
            $on_inbox_new_all = $outer_mail_count+$on_inbox_new_all;
        }
        return $on_inbox_new_all;
    }

    function show_outgoing($dep_id, $timesheet_date_start, $timesheet_date_end)
    {
        $db = new DB();
        $list_guys= $db->Select("select trivial.EMAIL from SUP_PERSON trivial where TRIVIAL.JOB_SP = $dep_id and TRIVIAL.STATE = 2");
        $on_inbox_new_all = 0;
        foreach($list_guys as $k => $v)
        {
            $dir_email = $v['EMAIL'];
            $outer_mail_count = show_outgoing_mail($dir_email, $timesheet_date_start, $timesheet_date_end);
            $on_inbox_new_all = $outer_mail_count+$on_inbox_new_all;
        }
        return $on_inbox_new_all;
    }

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
                           $table_name rec,
                           DOCUMENTS doc
                        where
                           rec.RECIEP_MAIL = '$emp_mail'
                           and doc.ID = rec.MAIL_ID
                           and rec.STATE = '2'
                           and doc.TYPE = '1'
                           and rec.POST_DATE BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";
            $list_inbox = $db -> Select($sql_inbox);
            //echo $sql_inbox.'<br /><br />';
            $on_inbox_new = count($list_inbox);
            $on_inbox_new_all = $on_inbox_new+$on_inbox_new_all;
            $sql_inbox = "";
        }

        //делегированные
        $sql_inbox .= 
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
               and rec.DESTINATION = 5";
        $list_inbox = $db -> Select($sql_inbox);
        //echo $sql_inbox.'<br /><br />';
        $on_inbox_new = 0;
        $on_inbox_new = count($list_inbox);
        $on_inbox_new_all = $on_inbox_new+$on_inbox_new_all;
        return $on_inbox_new_all;
    }    

    function show_outgoing_mail($emp_mail, $timesheet_date_start, $timesheet_date_end)
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

    function show_incoming_mail($emp_mail, $timesheet_date_start, $timesheet_date_end)
    {
        $db = new DB();
        $sql_inbox .=
        "select
           doc.ID
        from
           DOCUMENTS doc,
           DOC_RECIEPMENTS rec
        where
           rec.MAIL_ID = doc.ID
           and (rec.SENDER_MAIL = 'g.amerkhojayev@gak.kz'
           OR rec.SENDER_MAIL = 'a.makanova@gak.kz'
           OR rec.SENDER_MAIL = 'a.akazhanov@gak.kz'
           OR rec.SENDER_MAIL = 'a.bekseitova@gak.kz')
           and rec.RECIEP_MAIL = '$emp_mail'
           and rec.DESTINATION = 2
           and doc.TYPE = 1
           and doc.STATE != 0
           and doc.DATE_START BETWEEN TO_DATE('$timesheet_date_start') AND ('$timesheet_date_end')";
        $list_inbox = $db -> Select($sql_inbox);
        echo $sql_inbox.'<br /><br />';
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
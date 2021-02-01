<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <form method="POST">
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-md-5">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input value="<?php echo $timesheet_date_start; ?>" type="text" class="form-control dateOform" name="timesheet_date_start" data-mask="99.99.9999" id="timesheet_date_start" required/>
                                </div>
                            </div>
                            <div class="col-md-5"> 
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input value="<?php echo $timesheet_date_end; ?>" type="text" class="form-control dateOform" name="timesheet_date_end" data-mask="99.99.9999" id="timesheet_date_end" required/>
                                </div>
                            </div>
                            <?php 
                             $vis = '';
                             if($mail == 'i.akhmetov@gak.kz'){$vis = '';}
                             else if($mail == 'a.ibrayeva@gak.kz'){$vis = '';}
                             else if($mail == 'a.nuryshova@gak.kz'){$vis = '';}
                             else {$vis = 'hidden=""';}?>
                            <div <?php echo $vis; ?> class="col-md-3">
                                <dl class="dl-horizontal">
                                    <dt>Департамент:</dt>
                                <dd>
                                <select onchange="set_null();" name="dep_id_for_table" id="dep_id_for_table" class="select2_demo_1 form-control"/>
                                <option></option>
                                    <?php
                                        foreach($listDepartments as $u => $i){$dep_id_for_table
                                    ?>
                                <option <?php if(trim($i['ID']) == "$dep_id_for_table") {echo "selected";} ?> value="<?php echo trim($i['ID']); ?>"><?php echo $i['NAME']; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                                </dd>
                                </dl>
                            </div>
                            <div <?php echo $vis; ?> class="col-md-3">
                                <dl class="dl-horizontal">
                                    <dt>Филиал:</dt> 
                                <dd>
                                <select name="branch_id" id="branch_id" class="select2_demo_1 form-control branch_id"/>
                                <option value="0"></option>
                                    <?php
                                        foreach($list_branch_name as $u => $i){
                                    ?>
                                <option <?php if(trim($i['RFBN_ID']) == "$branch_id") {echo "selected";} ?> value="<?php echo trim($i['RFBN_ID']); ?>"><?php echo $i['NAME']; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                                </dd>
                                </dl>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Показать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive" id="table_with_data">
                    <table class="table table-hover" >
                        <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Должность</th>
                                <?php
                                foreach($list_guy as $b => $d){
                                    echo '<th>'.$d['WEEK_DAY'].'</th>';
                                }
                                ?>
                                <th>Кол-во дней</th>
                                <th>Кол-во часов</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($list_guys as $k => $v)
                            {
                                $sql_timesheet_test = "select * from TABLE_OTHER where EMP_ID = ".$v['ID']." and DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' order by DAY_DATE";
                                //echo $sql_timesheet_test;
                                $list_timesheet_test = $db -> Select($sql_timesheet_test);
                                
                                $sql_timesheet_job_day = "select * from TABLE_OTHER where DAY_DATE between '$timesheet_date_start' and '$timesheet_date_end' and EMP_ID = ".$v['ID']." and VALUE = '8'";
                                $list_timesheet_job_day = $db -> Select($sql_timesheet_job_day);
                                $hours = 0;
                                $days = 0;
                                $name = $v['FIRSTNAME'];
                                $name_first_simb = mb_substr($name,0,1,"UTF-8");
                                $middlename = $v['MIDDLENAME'];
                                $middlename_first_simb = mb_substr($middlename,0,1,"UTF-8");
                                
                                echo '<tr class="gradeX">';
                                echo '<td style="border: 1px solid #8E8DA2">'.$v['LASTNAME'].'. '.$name_first_simb.'. '.$middlename_first_simb.'</td>';
                                echo '<td style="border: 1px solid #8E8DA2">'.$v['D_NAME'].'</td>';
                                foreach($list_timesheet_test as $x => $z)
                                {
                                        if
                                        ($z['VALUE'] == 'А'){$color = " style='cursor: pointer; border: 1px solid #8E8DA2; background-color:#dff0d8'";}else if
                                        ($z['VALUE'] == 'О'){$color = " style='cursor: pointer; border: 1px solid #8E8DA2; background-color:#fcf8e3'";}else if
                                        ($z['VALUE'] == 'Б'){$color = " style='cursor: pointer; border: 1px solid #8E8DA2; background-color:#d9edf7'";}else if
                                        ($z['VALUE'] == 'П'){$color = " style='cursor: pointer; border: 1px solid #8E8DA2; background-color:#bce8f1'";}else if
                                        ($z['VALUE'] == 'К'){$hours = $hours+8; $days = $days+1; $color = " style='cursor: pointer; border: 1px solid #8E8DA2; background-color:#d1dade'";}else if
                                        ($z['VALUE'] == ' '){$color = " style='cursor: pointer; border: 1px solid #8E8DA2; background-color:#2f4050'";}else if
                                        ($z['VALUE'] == '4'){$hours = $hours+4; $days = $days+1; $color = " style='cursor: pointer; border: 1px solid #8E8DA2'";}else if
                                        ($z['VALUE'] == '5'){$hours = $hours+5; $days = $days+1; $color = " style='cursor: pointer; border: 1px solid #8E8DA2'";}else if
                                        ($z['VALUE'] == '12'){$hours = $hours+12; $days = $days+1; $color = " style='cursor: pointer; border: 1px solid #8E8DA2'";}else if
                                        ($z['VALUE'] == 'В'){$color = " style='cursor: pointer; border: 1px solid #8E8DA2; background-color:#f8ac59'";}else
                                        {$hours = $hours+8; $days = $days+1;$color = " style='cursor: pointer; border: 1px solid #8E8DA2'";}
                                        echo '<td class="td_table" onmouseover="" data-toggle="modal" data-target="#edit_table" onclick="set_id('.$z['ID'].');"'.$color.'>'.$z['VALUE'].'</td>';
                                }
                                echo '<td style="border: 1px solid #8E8DA2">'.$days.'</td>';
                                echo '<td style="border: 1px solid #8E8DA2">'.$hours.'</td>';
                                //echo '<pre>';
                                //print_r($list_timesheet_test);
                                //echo '<pre>';
                                echo '</tr>';
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
                Утверждаю<br />
                <?php echo $curatots_pos; ?><br />
                АО "КСЖ "ГАК"<br /><br /><br />
                Г. Т. Амерходжаев_______________<br /><br />
                <div style="text-align: center;"><strong><h3>ТАБЕЛЬ УЧЕТА РАБОЧЕГО ВРЕМЕНИ С <?php echo $timesheet_date_start; ?> ПО <?php echo $timesheet_date_end; ?></h3></strong></div>
                <div style="text-align: center;"><strong><h3><?php echo $dep_name; ?></h3></strong></div>
                <hr/>
                </div>
                </div>
                <div hidden="" id="foot_of_doc">
                <hr/><br /><br /><br /><br />
Специалист по управлению персоналом
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
А. А. Ибраева
                </div>
                
                <textarea hidden="" name="content" id="area_for_print">
                    
                </textarea>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <a id="submit_and_print" class="btn btn-primary pull-right"><i class="fa fa-check-square-o"></i> Утвердить и отправить на печать</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="edit_table" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактирование табеля</h4>
                <small class="font-bold">выберите статус из выпадающего списка</small>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div hidden="" class="col-md-2">
                        <div class="input-group date ">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input value="<?php echo $timesheet_date_start; ?>" type="text" class="form-control dateOform" name="timesheet_date_start" data-mask="99.99.9999" id="timesheet_date_start" required/>
                        </div>
                    </div>
                    <div hidden="" class="col-md-2"> 
                        <div class="input-group date ">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input value="<?php echo $timesheet_date_end; ?>" type="text" class="form-control dateOform" name="timesheet_date_end" data-mask="99.99.9999" id="timesheet_date_end" required/>
                        </div>
                    </div>
                    <div hidden="" class="input-group" style="display: none;">
                        <input value="<?php echo $dep_id; ?>" type="text" class="form-control dateOform" name="dep_id_for_table_up" id="dep_id_for_table_up" required/>
                    </div>
                    <div hidden="" class="input-group" style="display: none;">
                        <input value="<?php echo $branch_id; ?>" type="text" class="form-control dateOform" name="branch_id_up" id="branch_id_up" required/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">ID table</label>
                        <input name="id_table" type="text" placeholder="" class="form-control" id="id_table" required>
                    </div>
                    <div class="form-group" id="data_1">
                        <select onchange="" name="table_state" id="table_state" class="select2_demo_1 form-control pos_btn">
                            <option value="8">8 часовой день</option>
                            <option value="4">4 часовой день</option>
                            <option value="5">5 часовой день</option>
                            <option value="12">12 часовой день</option>
                            <option value="О">В отпуске</option>
                            <option value="А">В декретном отпуске</option>
                            <option value="А">Отпуск без сохранения</option>
                            <option value="Б">На больничном</option>
                            <option value="У">Уволен</option>
                            <option value="Б">Больничный в связи с беременностью и родами</option>
                            <option value="П">Прогул</option>
                            <option value="В">Выходной</option>
                            <option value=" ">Пусто</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function set_id(id)
    {
        $('#id_table').val(id);
    }
</script>
<script>
    $('.td_table').mouseover(function()
    {
        $(this).parent('.td_table').css('border-color', '#ffffff');
        $(this).css('border-color', '#ffffff');
    });
    
    $('.td_table').mouseout(function() 
    {
        $(this).css('border-color', '#8E8DA2');
    });
</script>

<script>
    $('#submit_and_print').click(function() 
    {
        var head_of_doc = $('#head_of_doc').html();
        var foot_of_doc = $('#foot_of_doc').html();
        
        var table_with_data = $('#table_with_data').html();
        $('#area_for_print').html(head_of_doc+table_with_data+foot_of_doc);
        $('#table_form').submit();
    })
</script>


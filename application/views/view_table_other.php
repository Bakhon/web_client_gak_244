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
                            <div class="col-md-5">
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
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Показать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive" id="table_with_data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="color: #23c6c8;">ФИО</th>
                                    <th style="color: #1c84c6;">Должность</th>
                                    <?php                                    
                                    foreach($list_guy as $b => $d)
                                    {
                                        echo '<th style="color: #18a689;">'.$d['WEEK_DAY'].'</th>';
                                    }
                                    ?>
                                    <th style="color: #ed5565;">Дни</th>
                                    <th style="color: #1c84c6;">Часы</th>
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
                                            .$v['D_NAME'].'</td>';
                                    //в зависимости от значения добавляем стиль
                                    foreach($list_timesheet_test as $x => $z)
                                    {
                                            if
                                            ($z['VALUE'] == 'А'){$color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689; background-color:#dff0d8'";}else if
                                            ($z['VALUE'] == 'О'){$color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689; background-color:#fcf8e3'";}else if
                                            ($z['VALUE'] == 'Б'){$color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689; background-color:#d9edf7'";}else if
                                            ($z['VALUE'] == 'П'){$color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689; background-color:#bce8f1'";}else if
                                            ($z['VALUE'] == 'К'){$hours = $hours+8; $days = $days+1; $color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689; background-color:#d1dade'";}else if
                                            ($z['VALUE'] == ' '){$color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689; background-color:#2f4050'";}else if
                                            ($z['VALUE'] == '3'){$hours = $hours+3; $days = $days+1; $color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689'";}else if
                                            ($z['VALUE'] == '4'){$hours = $hours+4; $days = $days+1; $color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689'";}else if
                                            ($z['VALUE'] == '5'){$hours = $hours+5; $days = $days+1; $color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689'";}else if
                                            ($z['VALUE'] == '7'){$hours = $hours+7; $days = $days+1; $color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689'";}else if
                                            ($z['VALUE'] == '12'){$hours = $hours+12; $days = $days+1; $color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689'";}else if
                                            ($z['VALUE'] == 'В'){$color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689; background-color:#9cdacd'";}else
                                            {$hours = $hours+8; $days = $days+1;$color = " style='color: #18a689; cursor: pointer; border: 1px solid #18a689'";}
                                            echo '<td class="td_table" data-toggle="modal" data-target="#edit_table" onclick="set_id('.$z['ID'].');"'.$color.'>'.$z['VALUE'].'</td>';
                                    }

                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #eaa8af;
                                            background-color: #ed5565;
                                            cursor: default;">'.$days.'</td>';
                                    echo '<td style="
                                            color: white;
                                            border: 1px solid #5bc0de;
                                            background-color: #1c84c6;
                                            cursor: default;">'.$hours.'</td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <form  target="_blank" id="table_form" method="post" action="print_timesheet">
                <input name="dep_id" value="<?php echo $dep_id; ?>" style="display: none;"/>
                <div hidden="" id="head_of_doc">
                    <div style="text-align: right;">
                    <!--
                        Утверждаю<br />
                        <?php echo $curatots_pos; ?> <br /> Председатель Правления 
                        АО "КСЖ "ГАК"<br /><br /><br />
                             Г. Т. Амерходжаев_______________<br /><br /> 
                   <!--      А. К. Маканова_______________<br /><br /> --> 
                    <!--       Д. М. Касимова_______________<br /><br /> --> 
                            <div style="text-align: center;">
                                <strong>
                                    <h3 style="color: #676a6c;">ТАБЕЛЬ УЧЕТА РАБОЧЕГО ВРЕМЕНИ С <?php echo $timesheet_date_start; ?> ПО <?php echo $timesheet_date_end; ?></h3>
                                </strong>
                            </div>
                            <div style="text-align: center;">
                                <strong>
                                    <h3 style="color: #676a6c;"><?php echo $name_dep; ?></h3>
                                </strong>
                            </div>
                            <hr/>
                    </div>
                </div>
                <div hidden="" id="foot_of_doc">
                <hr/><br /><br /><br /><br />                                   
                    Руководитель Службы по управлению персоналом
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    А. Ибраева                
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

<div class="row">
    <div class="col-lg-12 fadeInRight">
        <div class="mail-box-header">
            <h2>
                Добавить опреденное значение всем
            </h2>
        </div>
        <div class="mail-box">
            <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                <div class="mail-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Значение</label>
                        <div class="col-sm-10">
                            <select onchange="" name="holyday_val" id="holyday_val" class="select2_demo_1 form-control pos_btn">
                                <option></option>
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Заменяемое значение</label>
                        <div class="col-sm-10">
                            <select onchange="" name="change_val" id="change_val" class="select2_demo_1 form-control pos_btn">
                                <option></option>
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Дата выходного</label>
                        <div class="col-sm-10">
                            <div class="input-group date ">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control dateOform" name="holyday_date" data-mask="99.99.9999" id="holyday_date" required=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mail-body">
                    <button type="submit" onclick=""  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Добавить"> Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 fadeInRight">
        <div class="mail-box-header">
            
            <h2>
                Создать табель на определенного человека
            </h2>
        </div>
            <div class="mail-box">
                <div class="mail-body">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Сотрудник:</label>
                            <div class="col-sm-10">
                                <select name="CREATE_TABLE_FOR_ONE_PERS_ID" data-placeholder="" class="chosen-select col-lg-12" multiple tabindex="4" required="">
                                    <option></option>
                                    <?php
                                        foreach($list_persons as $k => $v){
                                    ?>
                                        <option value="<?php echo $v['ID']; ?>"><?php echo $v['FIO'].' - ' .$v['D_NAME'].' ('.$v['DEP_NAME'].')'; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Дата начала работы</label>
                            <div class="col-sm-10">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control dateOform" name="work_start_day" data-mask="99.99.9999" id="work_start_day" required/>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="mail-body">
                    <button type="submit" onclick=""  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Добавить"> Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 fadeInRight">
        <div class="mail-box-header">
            <h2>
                Добавить значение между двумя датами
            </h2>
        </div>
            <div class="mail-box">
                <div class="mail-body">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Сотрудник:</label>
                        <div class="col-sm-10">
                            <select name="UPDATE_TABLE_FOR_ONE_PERS_ID" data-placeholder="" class="chosen-select col-lg-12" multiple tabindex="4" required="">
                                <option></option>
                                <?php
                                    foreach($list_persons as $k => $v)
                                    {
                                ?>
                                    <option value="<?php echo $v['ID']; ?>"><?php echo $v['FIO'].' - ' .$v['D_NAME'].' ('.$v['DEP_NAME'].')'; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Значение</label>
                        <div class="col-sm-10">
                            <select name="val_between" id="val_between" class="select2_demo_1 form-control pos_btn">
                                <option></option>
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Дата начала значения</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control dateOform" name="val_start_day" data-mask="99.99.9999" id="work_start_day" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Дата конца значения</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control dateOform" name="val_end_day" data-mask="99.99.9999" id="work_start_day" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Проставить выходные</label>
                        <div class="col-sm-10">
                            <div class="i-checks"><input name="holi_set" type="checkbox" value="1"/></div>
                        </div>
                    </div>
                </div>
                <div class="mail-body">
                    <button type="submit" onclick=""  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Добавить"> Добавить</button>
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
                    <div class="input-group" style="display: none;">
                        <input value="<?php echo $dep_id_for_table; ?>" type="text" class="form-control dateOform" name="dep_id_for_table_up" id="dep_id_for_table_up"/>
                    </div>
                    <div class="input-group" style="display: none;">
                        <input value="<?php echo $branch_id; ?>" type="text" class="form-control dateOform" name="branch_id_up" id="branch_id_up"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">ID table</label>
                        <input name="id_table" type="text" placeholder="" class="form-control" id="id_table" required>
                    </div>
                    <div class="form-group" id="data_1">
                        <select onchange="" name="table_state" id="table_state" class="select2_demo_1 form-control pos_btn">
                            <option value="8">8 часовой день</option>
                            <option value="3">3 часовой день</option>
                            <option value="4">4 часовой день</option>
                            <option value="5">5 часовой день</option>
                            <option value="7">7 часовой день</option>
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

    $('.td_table').mouseover(function()
    {
        $(this).css('box-shadow', '0 5px 7px rgba(0, 0, 0, 0.60) inset');
    });

    $('.td_table').mouseout(function() 
    {
        $(this).css('border-color', '#18a689');
        $(this).css('box-shadow', 'none');
    });

    $('#submit_and_print').click(function() 
    {
        var head_of_doc = $('#head_of_doc').html();
        var foot_of_doc = $('#foot_of_doc').html();
        
        var table_with_data = $('#table_with_data').html();
        $('#area_for_print').html(head_of_doc+table_with_data+foot_of_doc);
        $('#table_form').submit();
    })
</script>

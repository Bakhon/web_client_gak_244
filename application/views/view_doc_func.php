<div class="row">
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Steps</h5>
            </div>
            <div class="ibox-content">
                <div id="jstree1">
                    <ul>
                    <?php 
                        foreach($list_dest as $k=>$v)
                        {
                            echo '<li><a class="jstree-anchor" id="'.$v['ID'].'" onclick="set_dest_id('.$v['ID'].'); set_priv_pers('.$v['ID'].');">'.$v['NAME'].'</a></li>';
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <form method="post">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Functions (Buttons)</h5>
                </div>
                <div class="ibox-content">
                    <div class="ibox float-e-margins">
                        <div id="place_for_privilege" class="ibox-content">
                            
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4">
        <form method="post">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Должности-потенциальные адресаты</h5>
                </div>
                <div class="ibox-content">
                    <div class="ibox float-e-margins">
                        <div id="priv_pers" class="ibox-content">
                            
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Линейные маршруты документооборота</h5>
                <div class="text-right">
                    <button data-toggle="modal" data-target="#add_trip" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Добавить маршрут</button>                      
                </div>
            </div>
            <?php
                foreach($list_trip as $k => $v)
                {
                    $trip_id = $v['ID'];
                    $sql_steps = "select 
                                        step.*,
                                        DEST.NAME,
                                        nvl((select max(id) from DOC_TRIP_STEPS where TRIP_ID = '$trip_id' and id < step.id), 0) id_prev,
                                        nvl((select min(id) from DOC_TRIP_STEPS where TRIP_ID = '$trip_id' and id > step.id), 0) id_next
                                     from
                                        DOC_TRIP_STEPS step,
                                        DIC_DOC_DESTINATION dest
                                    where
                                        DEST.ID = STEP.STEP_ID and
                                        STEP.TRIP_ID = '$trip_id'
                                    order by step.ID";
                    $list_steps = $db -> Select($sql_steps);
            ?>
            <div class="ibox-content">
                <h2>
                     <?php echo $v['TRIP_NAME']; ?> (маршрут №<?php echo $v['ID']; ?>)
                     <div class="text-right">
                        <button data-toggle="modal" data-target="#add_step" class="btn btn-sm btn-primary" onclick="$('#TRIP_NUM').val('<?php echo $v['ID']; ?>');"><i class="fa fa-plus"></i> Добавить шаг</button>                      
                    </div>
                </h2>
                <form id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
                    <div class="steps clearfix">
                        <ul class="trip_id_<?php echo $v['ID']; ?>">
                            <?php
                                $class = 'current';
                                foreach($list_steps as $z => $x)
                                {
                            ?>
                                <li id="1" class="<?php echo $class; ?>">
                                    <a>
                                        <i title="Удалить шаг" style="cursor: pointer !important;" data-toggle="modal" data-target="#delete_step" class="fa fa-trash" onclick="$('#DELETE_STEP_NUM').val('<?php echo $x['ID']; ?>');"></i>
                                        <i title="Доступ пользователям" style="cursor: pointer !important;" data-toggle="modal" data-target="#add_priv_pers" class="fa fa-user-circle-o" onclick="$('.ADD_PRIV_PERS').val('<?php echo $x['STEP_ID']; ?>'); $('.ADD_PRIV_STEP').val('<?php echo $x['ID']; ?>'); get_priv_pers('<?php echo $x['ID']; ?>');"></i>
                                        <i title="Функции шага" style="cursor: pointer !important;" data-toggle="modal" data-target="#add_func" class="fa fa-sitemap" onclick="$('.ADD_PRIV_PERS').val('<?php echo $x['STEP_ID']; ?>'); $('.ADD_PRIV_STEP').val('<?php echo $x['ID']; ?>'); get_priv_func('<?php echo $x['ID']; ?>');"></i>
                                        <?php echo $x['NAME']; ?>
                                        <?php echo $x['ID_PREV'].' '.$x['ID'].' '.$x['ID_NEXT']; ?>
                                    </a>
                                </li>
                            <?php
                                $class = 'disabled';
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="actions clearfix" style="display: none;">
                        <ul>
                            <li id="prev_step_btn_2">
                                <a onclick="prev_step(<?php echo $v['ID']; ?>);">Откатить шаг</a>
                            </li>
                            <li>
                                <a onclick="next_step(<?php echo $v['ID']; ?>);">Пропустить шаг</a>
                            </li>
                            <li class="disabled" id="last_step_btn_<?php echo $v['ID']; ?>">
                                <a onclick="accept(<?php echo $v['ID']; ?>);">Завершить</a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<!-- MODAL WINDOWS -->
<div class="modal inmodal fade" id="add_trip" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить маршрут</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Название маршрута</label>
                        <input name="TRIP_NAME" type="text" class="form-control" id="TRIP_NAME" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тип</label>
                        <select id="TRIP_TYPE" name="TRIP_TYPE" class="select2_demo_1 form-control">
                            <option></option>
                            <option value="1">Внешний документ</option>
                            <option value="2">Внутренний документ</option>
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

<!-- MODAL WINDOWS -->
<div class="modal inmodal fade" id="add_step" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить шаг</h4>
            </div>
            <form method="post">
            <div class="modal-body">
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">Маршрут</label>
                    <input name="TRIP_NUM" type="text" class="form-control" id="TRIP_NUM" required=""/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">Выберите шаг</label>
                    <select id="STEP_NUM" name="STEP_NUM" class="select2_demo_1 form-control">
                        <option></option>
                        <?php
                            foreach($list_dest as $a => $s){
                        ?>
                            <option value="<?php echo $s['ID']; ?>"><?php echo $s['NAME']; ?></option>
                        <?php
                            }
                        ?>
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

<!-- MODAL WINDOWS -->
<div class="modal inmodal fade" id="delete_step" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Удалить шаг?</h4>
            </div>
            <form method="post">
            <div hidden="" class="modal-body">
                <div class="form-group" id="data_1">
                    <label class="font-noraml">DELETE_STEP_NUM</label>
                    <input name="DELETE_STEP_NUM" type="text" class="form-control" id="DELETE_STEP_NUM" required=""/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Удалить</button>
                <a type="button" class="btn btn-white" data-dismiss="modal">Отменить</a>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL WINDOWS -->
<div class="modal inmodal fade" id="add_priv_pers" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Группы с доступом к этому шагу</h4>
            </div>
            <form method="post">
            <div class="modal-body">
                <div class="form-group" id="data_1">
                    <label class="font-noraml">Шаг</label>
                    <input name="ADD_PRIV_STEP" type="text" class="form-control ADD_PRIV_STEP" id="ADD_PRIV_STEP" required=""/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">ID шага маршрута</label>
                    <input name="ADD_PRIV_PERS" type="text" class="form-control ADD_PRIV_PERS" id="ADD_PRIV_PERS" required=""/>
                </div>
                <div class="form-group" id="STEP_PRIV_PERS_PLACE">
                    
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

<!-- MODAL WINDOWS -->
<div class="modal inmodal fade" id="add_func" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Функции к этому шагу</h4>
            </div>
            <form method="post">
            <div class="modal-body">
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">Шаг</label>
                    <input name="ADD_NEW_PRIV_STEP" type="text" class="form-control ADD_PRIV_STEP" id="ADD_PRIV_STEP" required=""/>
                </div>
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">ID шага маршрута</label>
                    <input name="ADD_PRIV_PERS" type="text" class="form-control ADD_PRIV_PERS" id="ADD_PRIV_PERS" required=""/>
                </div>
                <div class="form-group" id="STEP_PRIV_FUNC_PLACE">
                    
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
    function next_step(trip_id){
        var first_step = 1;
        var last_step = 4;
        var current_step = $(".trip_id_"+trip_id).find(".current").attr('id');
        var prev_val = Number(current_step)-1;
        var next_val = Number(current_step)+1;
        
        if(prev_val == first_step)
        {
            $('#prev_step_btn_'+trip_id).addClass("disabled");
            $('#last_step_btn_'+trip_id).addClass("disabled");
        }
            else if(next_val == last_step)
        {
            $('#prev_step_btn_'+trip_id).removeClass("disabled");
            $('#last_step_btn_'+trip_id).removeClass("disabled");
        }
            else
        {
            $('#last_step_btn_'+trip_id).addClass("disabled");
            $('#prev_step_btn_'+trip_id).removeClass("disabled");
        }
        $(".trip_id_"+trip_id).find(".current").addClass('done');
        $(".trip_id_"+trip_id).find('#'+current_step).removeClass("current");
        $(".trip_id_"+trip_id).find("#"+next_val).addClass('current');
    }

    function prev_step(trip_id){
        var first_step = 1;
        var last_step = 4;
        var current_step = $(".trip_id_"+trip_id).find(".current").attr('id');
        var prev_val = Number(current_step)-1;
        var next_val = Number(current_step)+1;
        
        if(prev_val == first_step)
        {
            $('#prev_step_btn_'+trip_id).addClass("disabled");
            $('#last_step_btn_'+trip_id).addClass("disabled");
        }
            else
        {
            $('#last_step_btn_'+trip_id).addClass("disabled");
            $('#prev_step_btn_'+trip_id).removeClass("disabled");
        }
        $(".trip_id_"+trip_id).find(".current").addClass('disabled');
        $(".trip_id_"+trip_id).find('#'+current_step).removeClass("current");
        $(".trip_id_"+trip_id).find("#"+prev_val).removeClass("done");
        $(".trip_id_"+trip_id).find("#"+prev_val).addClass('current');
    }

    function set_dest_id(dest_id){
        $.post
        ('doc_func', 
            {"dest_id" : dest_id},
            function(d){
                $('#place_for_privilege').html(d);
            }
        )
    }
    
    function set_priv_pers(dest_id_for_groups)
    {
        $.post
        ('doc_func', 
            {"dest_id_for_groups" : dest_id_for_groups},
            function(d){
                $('#priv_pers').html(d);
            }
        )
    }
    
    function get_priv_pers(dest_id_for_groups)
    {
        $.post
        ('doc_func', 
            {"get_id_for_groups" : dest_id_for_groups},
            function(d){
                $('#STEP_PRIV_PERS_PLACE').html(d);
            }
        )
    }
    
    function get_priv_func(dest_id_for_groups)
    {
        $.post
        ('doc_func', 
            {"get_func_for_groups" : dest_id_for_groups},
            function(d){
                $('#STEP_PRIV_FUNC_PLACE').html(d);
            }
        )
    }
</script>


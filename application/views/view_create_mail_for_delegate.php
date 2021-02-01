<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    Отправить на исполнение
                </h2>
            </div>
                <div class="mail-box">
                    <div class="mail-body">
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">вид:</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="1" id="KIND" name="KIND" value="<?php echo $KIND; ?>"/>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">тип:</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="1" id="TYPE" name="TYPE" value="1"/>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Destination</label>
                            <div class="col-sm-10">
                                <input value="5" class="form-control" id="DESTINATION" name="DESTINATION" required=""/>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">статус:</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="1" id="STATE" name="STATE" value="1"/>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Получатель:</label>
                            <div class="col-sm-10">
                                <select name="RECIPIENT[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4" required="">
                                    <option></option>
                                    <?php
                                        foreach($list_persons as $k => $v)
                                        {
                                    ?>
                                        <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                            if($emp_mail == 'g.amerkhojayev@gak.kz')
                            {
                        ?>
                        <div class="form-group"><label class="col-sm-2 control-label">На контроль:</label>
                            <div class="col-sm-10">
                                <select name="RECIEPMENTS_CONTROL[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4">
                                    <option></option>
                                    <?php
                                        foreach($list_persons as $k => $v)
                                        {
                                    ?>
                                        <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Дата написания:</label>
                            <div class="col-sm-10"><input readonly="" type="text" class="form-control" value="<?php echo $today_date; ?>" id="DATE_START" name="DATE_START" required=""/></div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">привязан к письму:</label>
                            <div class="col-sm-10"><input type="number" class="form-control" id="LINK_FROM" name="LINK_FROM" value="<?php echo $mail_id; ?>"/></div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Заголовок:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="HEAD_TEXT" name="HEAD_TEXT" value="<?php echo $head_text; ?>" required=""/>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Регистрационный номер:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="<?php if($REG_NUM != ''){echo $REG_NUM;}else{echo '0';} ?>" id="REG_NUM" name="REG_NUM"/>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель:</label>
                            <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_fio; ?>"  id="SENDER" name="SENDER" required=""/></div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель email:</label>
                            <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_mail; ?>"  id="SENDER_MAIL" name="SENDER_MAIL" required=""/></div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Краткое содержание:</label>
                            <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $SHORT_TEXT; ?>" id="SHORT_TEXT" name="SHORT_TEXT"/></div>
                        </div>
                        <div id="text_areas_in_base64">
                        
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Дата ответа:</label>
                            <div class="col-sm-10">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control dateOform" name="DATE_END" data-mask="99.99.9999" id="DATE_END" value="<?php echo $today_date_plus_15; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Комментарий:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
                            </div>
                        </div>                        
                    </div>
                    <div class="mail-attachment">
                        <div class="attachment">
                            <?php
                                if(isset($_GET['mail_id']))
                                {
                                    foreach($contents as $k => $v)
                                    {
                                    ?>
                                    <div class="file-box">
                                        <div class="file">
                                            <a href="ftp://upload:Astana2014@192.168.5.2/<?php echo $v; ?>">
                                                <span class="corner">
                                                </span>
                                                <div class="icon">
                                                    <i class="fa fa-file">
                                                    </i>
                                                </div>
                                                <div class="file-name">
                                                    <a href="ftp://upload:Astana2014@192.168.5.2/<?php echo $v; ?>" target="_blank"><?php echo $v; ?>
                                                    </a>
                                                    <br/>
                                                    <small>Added: Jan 11, 2014</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                            ?>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                    <div class="mail-body">
                        <button type="submit" onclick=""  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Отправить"><i class="fa fa-reply"></i> Отправить</button>
                    </div>
                    <input name="CREATE_MAIL" value="test" style="display: none;"/>
                    
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="add_reciep" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Добавление получателя</h4>
                    <small class="font-bold">Выберите контакт из выпадающего списка</small>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Получатель</label>
                        <select onchange="get_reciepment();" class="select2_demo_1 form-control" name="RECIPIENT_mod" id="RECIPIENT_mod">
                            <option></option>
                            <?php
                                foreach($list_persons as $k => $v){
                            ?>
                                <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div id="place_for_reciepments">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="add_recipments" class="btn btn-primary" data-dismiss="modal">Добавить</a>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
            </div>
        </div>
    </div>
    
<script>
    $('#add_recipments').click
    (
        function()
        {
            var dep_name = $('#RECIPIENT_mod :selected').text();
            var director_email = $('#director_email').val();
            var curator_email = $('#curator_email').val();
            $('#RECIPIENTS').append('<p>'+dep_name+'</p>');
            $('#RECIPIENTS').append('<label class="col-sm-2 control-label">Директор</label><div class="col-sm-10"><input class="form-control" id="RECIPIENT" name="RECIPIENT[]" value="'+director_email+'"/></div>');
            $('#RECIPIENTS').append('<label class="col-sm-2 control-label">Куратор</label><div class="col-sm-10"><input class="form-control" id="RECIPIENT" name="RECIPIENT[]" value="'+curator_email+'"/></div>');
        }
    )
</script>

                    
<script>
    function get_reciepment(){
        var dep_id = $('#RECIPIENT_mod').val();
        console.log(dep_id);
        $.post('create_mail',
                {"get_reciepment": "get_reciepment",
                "dep_id": dep_id
                },
                    function(d)
                {
                    $('#place_for_reciepments').html(d);
                })
    }
</script>

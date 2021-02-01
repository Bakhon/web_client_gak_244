    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <?php
                    //require_once MODELS.'mail_menu.php';
                      foreach($list_mail as $k => $v) { 
                    $short_text = $v['SHORT_TEXT'];
                    $sender = $v['SENDER'];
                    }
                ?>
            </div>
            <div class="col-lg-12 animated fadeInRight">
                <div class="ibox-content">
                    <div id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
                    <div class="steps clearfix">
                        <ul>
                        <?php
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

                            foreach($list_steps as $z => $x)
                            {
                                if($state_id == $x['STEP_ID'])
                                {
                                    $class = 'current';
                                }
                                    else
                                {
                                    $class = 'disabled';
                                }
                        ?>
                            <li data-toggle="modal" data-target="#delete_step" id="1" class="<?php echo $class; ?>" onclick="$('#DELETE_STEP_NUM').val('<?php echo $x['ID']; ?>');"><a style="cursor: pointer !important;"> <?php echo $x['NAME']; //echo $x['NAME'].' '.$x['ID_PREV'].' '.$x['ID'].' '.$x['ID_NEXT']; ?></a></li>
                        <?php
                            }
                        ?>
                    </ul>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="pull-right tooltip-demo">
                    </div>
                    <h2>
                        Просмотр документа
                    </h2>
                    <?php  foreach($list_mail as $k => $v) { ?>
                    <div class="mail-tools tooltip-demo m-t-md">
                        <h3>
                            <span class="font-noraml">Заголовок: </span><?php echo $v['HEAD_TEXT']; ?>
                        </h3>
                        <h5>
                            <span class="pull-right"><strong>Дата написание письма: </strong><?php echo $v['DATE_START']; ?></span><br />
                            <span class="pull-right"><strong>Дата исполнения: </strong><?php echo $v['DATE_END']; ?></span><br />
                            <span class="font-noraml">Отправитель: </span><?php echo $v['SENDER']; ?><br />
                            <span class="font-noraml">Регистрационный номер: </span><?php echo $v['REG_NUM']; ?><br />
                            <span class="font-noraml">Номер приказа: </span><?php echo $v['ORDER_NUM']; ?>
                        </h5>
                    </div>
                    
                </div>
                <div class="mail-box">
                    <div class="mail-attachment">
                        <h3>
                            <span class="font-noraml">Краткое описание: </span><?php echo $v['SHORT_TEXT']; ?>
                        </h3>
                        <?php } ?>
                        <div class="attachment">
                            <?php
                                foreach($contents as $k => $c)
                                {
                                ?>
                                <div class="file-box">
                                    <div class="file">
                                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>">
                                            <span class="corner"></span>
                                            <div class="icon">
                                                <i class="fa fa-file"></i>
                                            </div>
                                            <div class="file-name">
                                                <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>" target="_blank"><?php $exp_str = explode('/', $c); echo $name_of_file = end($exp_str); ?></a>
                                                <br/>
                                                <small>Added: Jan 11, 2014</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                }

                                foreach($contents_added as $k => $c)
                                {
                                ?>
                                <div class="file-box">
                                    <div class="file">
                                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c['NAME']; ?>">
                                            <span class="corner"></span>
                                            <div class="icon">
                                                <i class="fa fa-file"></i>
                                            </div>
                                            <div class="file-name">
                                                <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c['NAME']; ?>" target="_blank"><?php $exp_str = explode('/', $c['NAME']); echo $name_of_file = end($exp_str); ?></a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                        <hr />
                        <div class="text-right">
                            <?php
                                if(isset($_GET['REVOKE']))
                                {
                                    echo '<a data-toggle="modal" data-target="#revoke" class="btn btn-sm btn-info"><i class="fa fa-hand-paper-o"></i> Отозвать письмо</a>&nbsp;';
                                }
                                echo '<a data-toggle="modal" data-target="#mistake" class="btn btn-sm btn-danger"><i class="fa fa-hand-paper-o"></i> Нашли неисправность?</a>&nbsp;';
                            ?>
                        </div>
                        <hr />
                        <div class="clearfix"></div>
                        <div class="mail-tools tooltip-demo m-t-md">
                           <ul class="list-group">
                                <?php
                                    foreach($list_mail_state as $s => $q)
                                    {
                                            $rec_contents = ftp_nlist($conn_id, "doc_syst/answer_docs/".$q['ID']."/");
                                            $state = $q['STATE'];
                                            switch ($state)
                                            {
                                                     case 0:
                                                     $prop = 'badge-warning';
                                                     break;
                                                     case 1:
                                                     $prop = 'badge-success';
                                                     break;
                                                     case 2:
                                                     $prop = 'badge-success';
                                                     break;
                                                     case 3:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 4:
                                                     $prop = 'badge-danger';
                                                     break;
                                                     case 5:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 6:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 7:
                                                     $prop = 'badge-success';
                                                     break;
                                                     case 8:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 9:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 9:
                                                     $prop = 'badge-primary';
                                                     break;
                                            };
                                ?>
                                    <li class="list-group-item">
                                        <span class="badge <?php echo $prop; ?>"><?php echo $q['STATE']; ?></span>
                                        <?php
                                            echo '<span class="label label-default">'.$q["TABLE_NAME"].'</span>';
                                            echo '<br />';echo '<br />';
                                            echo '<strong>Получатель:</strong> '.$q['FIO'];echo '<br />';
                                            echo '<strong>Отправитель:</strong> '.$q['FIO2'];echo '<br />';
                                           echo '<strong>Дата и время принятия:</strong> '.$q['RECIEP_DATE']." ". $q['RECIEP_TIME']; echo '<br />';
                                            if($q['STATE'] == "Делегировано") {
                                                echo '<strong>Дата и время делигирования:</strong> '.$q['POST_DATE']." ". $q['POST_TIME'];echo '<br />';
                                            }
                                            else {
                                            echo '<strong>Дата и время завершения:</strong> '.$q['POST_DATE']." ". $q['POST_TIME'];echo '<br />';
                                            }
                                                ?>
                                                <h3>Комментарий получателя: </h3>
                                                <div class="well">
                                                    <?php echo $q['COMMENT_TO_DOC']; ?>
                                                    
                                                    <hr />
                                                    <!--<img src="styles/img/1487344174_blank.png"/><br> <a href="ftp://upload:Astana2014@192.168.5.2/doc_syst/answer_docs/770/1.jpg" download>Скачать</a>-->
                                                    <?php
                                                    if($rec_contents) {
                                                        foreach($rec_contents as $v => $b)
                                                        {
                                                    ?>
                                                    <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $b; ?>" target="_blank"><i class="fa fa-file"></i> <?php $exp_rec_file = explode('/', $b); echo end($exp_rec_file); ?> скачать</a><br />
                                                    <?php
                                                        } }
                                                    ?>
                                                </div>
                                                <hr />
                                                <?php
                                        ?>
                                    </li>
                                <?php
                                    }
                                    ftp_close($conn_id);
                                ?>
                            </ul>
                        </div>
                        <form method="post" target="_blank" action="just_print">
                            <textarea hidden="" name="doc_list">
                                <div style="text-align: center;"><strong><h3>Лист согласования документа с заголовком<br />"<?php echo $v['HEAD_TEXT']; ?>"</h3></strong></div>
                                <ul class="list-group">
                                    <?php
                                        foreach($list_mail_state as $s => $q)
                                        {
                                                $rec_contents = ftp_nlist($conn_id, "doc_syst/answer_docs/".$q['ID']."/");
                                                $state = $q['STATE'];
                                                switch ($state)
                                                {
                                                         case 0:
                                                         $prop = 'badge-warning';
                                                         break;
                                                         case 1:
                                                         $prop = 'badge-success';
                                                         break;
                                                         case 2:
                                                         $prop = 'badge-success';
                                                         break;
                                                         case 3:
                                                         $prop = 'badge-primary';
                                                         break;
                                                         case 4:
                                                         $prop = 'badge-danger';
                                                         break;
                                                         case 5:
                                                         $prop = 'badge-primary';
                                                         break;
                                                         case 6:
                                                         $prop = 'badge-primary';
                                                         break;
                                                         case 7:
                                                         $prop = 'badge-success';
                                                         break;
                                                         case 8:
                                                         $prop = 'badge-primary';
                                                         break;
                                                         case 9:
                                                         $prop = 'badge-primary';
                                                         break;
                                                         case 9:
                                                         $prop = 'badge-primary';
                                                         break;
                                                };
                                    ?>
                                        <li class="list-group-item">
                                            <span class="label label-default"><?php echo $q["TABLE_NAME"]; ?> (<?php echo $q["STATE"]; ?>)</span><br />
                                            <?php 
                                                echo '<strong>Получатель:</strong> '.$q['FIO'];echo '<br />';
                                                echo '<strong>Отправитель:</strong> '.$q['FIO2'];echo '<br />';
                                                echo '<strong>Дата и время принятия:</strong> '.$q['RECIEP_DATE']." ". $q['RECIEP_TIME']; echo '<br />';
                                            if($q['STATE'] == "Делегировано") {
                                                echo '<strong>Дата и время делигирования:</strong> '.$q['POST_DATE']." ". $q['POST_TIME'];echo '<br />';
                                            }
                                            else {
                                            echo '<strong>Дата и время завершения:</strong> '.$q['POST_DATE']." ". $q['POST_TIME'];echo '<br />';
                                            }
                                                    ?>
                                                    <h3>Комментарий: </h3>
                                                    <div class="well">
                                                        <?php echo $q['COMMENT_TO_DOC']; ?>
                                                        
                                                        <hr />
                                                        <!--<img src="styles/img/1487344174_blank.png"/><br> <a href="ftp://upload:Astana2014@192.168.5.2/doc_syst/answer_docs/770/1.jpg" download>Скачать</a>-->
                                                        <?php
                                                            foreach($rec_contents as $v => $b)
                                                            {
                                                        ?>
                                                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $b; ?>" target="_blank"><i class="fa fa-file"></i> <?php $exp_rec_file = explode('/', $b); echo end($exp_rec_file); ?> скачать</a><br />
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <hr />
                                                    <?php
                                            ?>
                                        </li>
                                    <?php
                                        }
                                        ftp_close($conn_id);
                                    ?>
                                </ul>
                            </textarea>
                            <div class="text-right">
                                <button type="submit" class="btn btn-sm btn-info"> Распечатать лист согласования </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="reject" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Причина отклонения</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="4"/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Отклонено</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php
        if($dest_id != 6){
    ?>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="accept_btn" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Комментарий к завершению</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="3" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$step_id</label>
                        <input name="CURRENT_STEP" class="form-control pos_btn" id="CURRENT_STEP" value="<?php echo $next_step_id; ?>"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$next_step_id</label>
                        <input name="NEXT_STEP" class="form-control pos_btn" id="NEXT_STEP" value="0"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$prev_step_id</label>
                        <input name="PREV_STEP" class="form-control pos_btn" id="PREV_STEP" value="<?php echo $step_id; ?>"/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Завершено</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                    <div id="text_areas_in_base64">
                        
                    </div>
                    <input id="readimg" type="file" name="imagereader" accept=".jpg,.jpeg,.tiff,.tif,.png,.pdf,.xls,.xlsx,.doc,.docx, .ppt,.pptx,.bpm,.rtf"/>
                    <textarea id="getbase64" style="display: none;"></textarea>
                    <a id="openimage" class="btn btn-primary"><i class="fa fa-paperclip"></i> Прикрепить файл</a><br />
                    <label>Разрешенные форматы:</label> .jpg, .jpeg, .tiff, .tif, .png, .pdf, .xls, .xlsx, .doc, .docx, .ppt, .pptx, .bpm, .rtf
                    <div id="getimage"></div>
                    <div id="zona-drop" style="cursor: pointer;">
                        <div class="dz-default dz-message">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php
        }
    ?>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="tech_support" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Комментарий к согласованию тех.заявки</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$step_id</label>
                        <input name="CURRENT_STEP" class="form-control pos_btn" id="CURRENT_STEP" value="<?php echo $next_step_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$prev_step_id</label>
                        <input name="PREV_STEP" class="form-control pos_btn" id="PREV_STEP" value="<?php echo $step_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">REC_ID</label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="11" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Краткое описание</label>
                        <textarea class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" maxlength="999" required=""><?php echo $v['SHORT_TEXT']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Согласовано руководителем СП</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="approve" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Комментарий к согласованию</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$step_id</label>
                        <input name="CURRENT_STEP" class="form-control pos_btn" id="CURRENT_STEP" value="<?php echo $next_step_id; ?>"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$prev_step_id</label>
                        <input name="PREV_STEP" class="form-control pos_btn" id="PREV_STEP" value="<?php echo $step_id; ?>"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">REC_ID</label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="5" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Краткое описание</label>
                        <textarea class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" maxlength="999" required=""><?php echo $v['SHORT_TEXT']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Согласовано</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="affirm" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Комментарий к утверждению</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="7" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Краткое описание</label>
                        <textarea class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" maxlength="999" required=""><?php echo $v['SHORT_TEXT']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Утверждаю</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL WINDOWS -->
    <div class="modal inmodal fade" id="answer_with_file" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Ответить на запрос</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="8" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Файл добавлен</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                    <div id="text_areas_in_base64">
                        
                    </div>
                    <input id="readimg" type="file" name="imagereader" accept=".jpg,.jpeg,.tiff,.png,.pdf,.xls,.xlsx,.doc,.docx, .ppt,.pptx,.bpm,.rtf"/>
                    <textarea id="getbase64" style="display: none;"></textarea>
                    <a id="openimage" class="btn btn-primary"><i class="fa fa-paperclip"></i> Прикрепить файл</a><br />
                    <label>Разрешенные форматы:</label> .jpg, .jpeg, .tiff, .png, .pdf, .xls, .xlsx, .doc, .docx, .ppt, .pptx, .bpm, .rtf
                    <div id="getimage"></div>
                    <div id="zona-drop" style="cursor: pointer;">
                        <div class="dz-default dz-message">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="add_reg_num" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Присвоить регистрационный номер</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="9" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Регистрационный номер</label>
                        <input type="number" name="REG_NUM" class="form-control pos_btn" id="REG_NUM" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Регистрационный номер присвоен</textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="affirm_order" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Комментарий к утверждению</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="13" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Краткое описание</label>
                        <textarea class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" maxlength="999" required=""><?php echo $v['SHORT_TEXT']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Утверждаю</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="add_reg_order_num" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Присвоить номер приказа</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="14" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Номер приказа</label>
                        <input type="number" name="ORDER_NUM" class="form-control" id="ORDER_NUM" required=""/>
                    </div>
                    <div class="form-group">
                        <label>Ознакомить сотрудника:</label>
                        <select name="RECIPIENT" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" required="">
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
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Регистрационный номер присвоен</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="got_it" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Ознакомлен</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="10" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Ознакомлен</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="send_to_accept" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Отправить на утверждение</h4>
                    <small class="font-bold">выберите утверждающее лицо и добавьте комментарий</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Краткое описание</label>
                        <textarea class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" maxlength="999" required="">Описание: <?php echo $v['SHORT_TEXT']; ?></textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="0"/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Утверждающее лицо:</label>
                        <select name="RECIPIENT" class="select2_demo_1 form-control col-lg-12" required="">
                            <option></option>
                            <option value="g.amerkhojayev@gak.kz">Амерходжаев.Г.Т.</option>
                            <option value="a.akazhanov@gak.kz">Акажанов.А.А.</option>
                            <option value="a.bekseitova@gak.kz">Бексеитова.А.Т.</option>
                            <option value="a.makanova@gak.kz">Маканова.А.К.</option>
                            <option value="n.sagindykova@gak.kz">Сагиндыкова.Н.Е.</option>
                            <option value="zh.trimova@gak.kz">Тримова.Ж.Б.</option>
                            <option value="i.akhmetov@gak.kz">akhmetov</option>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">На утверждение</textarea>
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
    <div class="modal inmodal fade" id="add_assignment_comment" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Комментарий</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="15" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$step_id</label>
                        <input name="CURRENT_STEP" class="form-control pos_btn" id="CURRENT_STEP" value="00"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$next_step_id</label>
                        <input name="NEXT_STEP" class="form-control pos_btn" id="NEXT_STEP" value="0"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$prev_step_id</label>
                        <input name="PREV_STEP" class="form-control pos_btn" id="PREV_STEP" value="<?php echo $step_id; ?>"/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Завершено</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="add_agreement_comment" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Комментарий</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="15" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$step_id</label>
                        <input name="CURRENT_STEP" class="form-control pos_btn" id="CURRENT_STEP" value="00"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$next_step_id</label>
                        <input name="NEXT_STEP" class="form-control pos_btn" id="NEXT_STEP" value="0"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">$prev_step_id</label>
                        <input name="PREV_STEP" class="form-control pos_btn" id="PREV_STEP" value="<?php echo $step_id; ?>"/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Поручение согласовано</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="send_to_accept" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Отправить на утверждение</h4>
                    <small class="font-bold">выберите утверждающее лицо и добавьте комментарий</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Краткое описание</label>
                        <textarea class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" maxlength="999" required="">Описание: <?php echo $v['SHORT_TEXT']; ?></textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>"/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="0"/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Утверждающее лицо:</label>
                        <select name="RECIPIENT_ASSIGNMENT[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4" accesskey="" <?php if($trip_id == '3'){$required_state = 'required=""';}else{$required_state = 'hidden="" style="display: none;"';} echo $required_state; ?>>
                            <option></option>
                            <?php
                                foreach($list_persons as $k => $v)
                                {
                            ?>
                                <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO'].' - ' .$v['D_NAME'].' ('.$v['DEP_NAME'].')'; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">На утверждение</textarea>
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
    <div class="modal inmodal fade" id="add_accept_resolution" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Утвердить резолюцию</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div  class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="16" required=""/>
                    </div>
                    <div class="form-group">
                        <label>Исполнитель</label>
                        <select name="RECIPIENT[]" data-placeholder="Несколько получателей..." multiple class="chosen-select col-lg-12" required="">
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
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Резолюция утверждена</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="add_accept_signature" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Подписать исходящий документ</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="17" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required="">Подписан</textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="revoke" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Отозвать письмо</h4>
                    <small class="font-bold">добавить комментарий к действию</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Краткое описание</label>
                        <textarea class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" maxlength="999" required=""><?php echo $short_text; ?></textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Автор</label>
                        <input name="AUTHOR" class="form-control" id="AUTHOR" value="<?php echo $sender; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="12" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Комментарий</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999"></textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL WINDOWS -->            
    <div class="modal inmodal fade" id="mistake" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Сообщить о неисправности</h4>
                    <small class="font-bold">номер разработчика ПО (11-04)</small>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Отправитель</label>
                        <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml"></label>
                        <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Статус</label>
                        <input name="STATE" class="form-control pos_btn" id="STATE" value="20" required=""/>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Опишите подробно суть проблемы или предложения для улучшения системы</label>
                        <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999"></textarea>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="COMMENT_DATE" class="form-control pos_btn" id="COMMENT_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Время</label>
                        <input name="COMMENT_TIME" class="form-control pos_btn" id="COMMENT_TIME" value="<?php echo $now_time; ?>" required=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function lets_work_rec()
    {
        $('#lets_work_resolution').show();
    }

    function add_doc(name, type, format)
    {
        var img = $('#getbase64').val();
        console.log(name);
        $('#text_areas_in_base64').append('<textarea name="doc_b64[]" class="altay4">'+img+'.'+format+'</textarea>');
        var format = '';
    }

    function download_file()
    {
        $.post
        ('download_ftp', 
        {"get_file" : 'get_file'}, 
        function(d){console.log(d);}
        )
    }
    
    function delete_doc(class_name)
    {
        $(".altay4").remove();
    }

    function add_doc(name, type, format)
    {
        var img = $('#getbase64').val();
        console.log(name);
        $('#text_areas_in_base64').append('<textarea hidden="" name="doc_b64[]" class="altay4">'+img+'.'+format+'</textarea>');
        var format = '';
    }
    
    function check_file_size(size_int, size_form)
    {
        if(size_int > 10 && size_form == 'MB')
        {
            alert('Файл '+name+'слишком большой');
            return false;
        }
    }
    
    (function() {
  
          var zonaDrop = document.getElementById('zona-drop');
          zonaDrop.addEventListener("dragover", function(e){
          e.preventDefault();
            
            zonaDrop.setAttribute("class", "over");
            
          
          }, false);
        
          zonaDrop.addEventListener("drop", function(e){
              e.preventDefault();
            var files = e.dataTransfer.files;
            var fileCount = files.length;
            var i;
            
            if(fileCount > 0) {
              for (i = 0; i < fileCount; i = i + 1) {
                var file = files[i];
                var name = file.name;
                var class_name = name.slice(0, -4);
                
                var name_split = name.split('.');
                var format = name_split[name_split.length-1];
                
                var size = bytesToSize(file.size);
                var size_int_split = size.split(' ');
                console.log(size_int_split[0]);
                console.log(size_int_split[1]);
                var checker = check_file_size(size_int_split[0], size_int_split[1]);
                if(checker == false){
                    return false;
                }
                var type = file.type;
                var reader = new FileReader();
                
                zonaDrop.removeAttribute("class");
                
                reader.onload = function(e) {
                document.getElementById("getbase64").value = e.target.result;
                var img_source = e.target.result;
                if(format != 'jpg' && format != 'png'){
                    img_source = 'styles/img/1487344174_blank.png';
                }
                zonaDrop.innerHTML+= "<div class='altay4'><img src='" + img_source + "'/></br> Название " + name +", Тип: " + type +", Размер: " + size +" <a onclick='delete_doc(altay4);'>Delete</a></div>";
                add_doc(class_name, type, format);
                };        
                reader.readAsDataURL(file);
              }
             
            }
            
          }, false);
        
        })();
        
        function simulateclick(){
            document.getElementById("readimg").click();    
        }
        
        var zonaDrop = document.getElementById('zona-drop');
        document.getElementById("readimg").style.visibility = "collapse";
        document.getElementById("readimg").style.width = "0px";
        document.getElementById("openimage").addEventListener("click", simulateclick, false);
        
        function readImage() {
            var fileToLoad = document.getElementById("readimg").files[0];
            var name = fileToLoad.name;
            var class_name = name.slice(0, -4);
            
            var name_split = name.split('.');
            var format = name_split[name_split.length-1];
            
            var size = bytesToSize(fileToLoad.size);
            var size_int_split = size.split(' ');
            var checker = check_file_size(size_int_split[0], size_int_split[1]);
            if(checker == false){
                return false;
            }
            var type = fileToLoad.type;
                                        
        	var fileReader = new FileReader();
        	fileReader.onload = function(fileLoadedEvent) {
        		var textFromFileLoaded = fileLoadedEvent.target.result;
        		var previewimage = new Image();
                // previewimage.src = textFromFileLoaded;
                document.getElementById("getimage").appendChild(previewimage) ;   
                document.getElementById("getbase64").value = textFromFileLoaded;
                img_source = 'styles/img/1487344174_blank.png';
                zonaDrop.innerHTML+="<div class='altay4'><img src='" + img_source + "'/></br> Название "+ name +", Тип: " + type +", Размер: " + size +" <a onclick='delete_doc(altay4);'>Delete</a></div>";
                add_doc(class_name, type, format);
        	};
        	fileReader.readAsDataURL(fileToLoad);
        }
        function bytesToSize(bytes) {
           var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
           if (bytes == 0) return '0 Bytes';
           var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
           return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        };
        document.getElementById("readimg").addEventListener("change", readImage, false);
</script>










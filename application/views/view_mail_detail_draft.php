<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                </div>
                <h2>
                    Просмотр документа
                </h2>
                <?php  foreach($list_mail as $k => $v)  { ?>
       
                <div class="mail-tools tooltip-demo m-t-md" id="mail-body">
                    <h3>
                        <span class="font-noraml">Заголовок: </span><?php echo $v['HEAD_TEXT']; ?>
                    </h3>
                    <h5>
                        <span class="pull-right"><strong>Дата регистрации письма: </strong><?php echo $v['DATE_START']; ?></span><br />
                        <span class="pull-right"><strong>Дата исполнения: </strong><?php echo $v['DATE_END']; ?></span><br />
                        <span class="font-noraml">Отправитель: </span><?php echo $v['SENDER']; ?><br />
                        <span class="font-noraml">Регистрационный номер: </span><?php echo $v['REG_NUM']; ?><br />
                        <span class="font-noraml">Номер приказа: </span><?php echo $v['ORDER_NUM']; ?><br />
                        <span class="font-noraml">Внешний отправитель: </span><?php echo $v['ORG_SENDER'].' ('.$v['ADDRESS'].')'; ?>
                    </h5>
                </div>
                <?php } ?>
            </div>
            <div class="mail-box">
                <div class="mail-attachment">
                    <h3>
                        <span class="font-noraml">Краткое описание: </span><?php echo $v['SHORT_TEXT']; ?>
                    </h3>
                    <div class="attachment">
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
                                            echo '<strong>Дата:</strong> '.$q['POST_DATE'];echo '<br />';
                                            echo '<strong>Время:</strong> '.$q['POST_TIME'];echo '<br />';
                                                ?>
                                                <h3>Комментарий получателя: </h3>
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
                        </div>
                    </div>
                    <hr />
                    <div class="text-right">
                        <div class="pull-right social-action dropdown">
                            <a href="edit_draft?trip_id=<?php echo $ishod; ?>&DRAFT_DOC_ID=<?php echo $doc_id; ?>" class="btn btn-primary dropdown-toggle"><i class="fa fa-wrench"></i> Редактировать проект </a>
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-send"></i> Отправить как <span class="caret"></span></button>
                            <ul class="dropdown-menu m-t-xs">
                                <li><a href="create_inner_doc?trip_id=3&DRAFT_DOC_ID=<?php echo $doc_id; ?>">Внутренний документ</a></li>
                                <li><a href="create_mail_output?trip_id=<?php echo $ishod; ?>&DRAFT_DOC_ID=<?php echo $doc_id; ?>">Исходящий документ</a></li>
                                <li><a href="create_mail_reception?trip_id=1&DRAFT_DOC_ID=<?php echo $doc_id; ?>">Входящий документ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
<div class="modal inmodal fade" id="reject_assign_btn" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Причина отклонения согласования</h4>
                <small class="font-bold">добавить комментарий к действию</small>
            </div>
            <form method="post">
            <div class="modal-body">
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <input name="STATE" class="form-control pos_btn" id="STATE" value="18"/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">Комментарий</label>
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>                
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                <div class="form-group" id="data_1">
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">$step_id</label>
                    <input name="CURRENT_STEP" class="form-control pos_btn" id="CURRENT_STEP" value="<?php echo $next_step_id; ?>"/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">$prev_step_id</label>
                    <input name="PREV_STEP" class="form-control pos_btn" id="PREV_STEP" value="<?php echo $step_id; ?>"/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">Отправитель</label>
                    <input name="SENDER_MAIL_COMMENT" class="form-control pos_btn" id="SENDER_MAIL_COMMENT" value="<?php echo $list_mail[0]['SENDER_MAIL']; ?>" required=""/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">REC_ID</label>
                    <input name="REC_ID" class="form-control pos_btn" id="REC_ID" value="<?php echo $rec_id; ?>" required=""/>
                </div>
                <div class="form-group" id="data_1">
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <input name="STATE" class="form-control pos_btn" id="STATE" value="9" required=""/>
                </div>
                <div class="form-group" id="data_1">
                    <label>Регистрационный номер</label>
                    <input name="REG_NUM" class="form-control pos_btn" id="REG_NUM" required=""/>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                <div class="form-group" id="data_1">
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <input name="STATE" class="form-control pos_btn" id="STATE" value="15" required=""/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">$step_id</label>
                    <input name="CURRENT_STEP" class="form-control pos_btn" id="CURRENT_STEP" value="00"/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">$next_step_id</label>
                    <input name="NEXT_STEP" class="form-control pos_btn" id="NEXT_STEP" value="0"/>
                </div>
                <div class="form-group" id="data_1">
                    <label class="font-noraml">$prev_step_id</label>
                    <input name="PREV_STEP" class="form-control pos_btn" id="PREV_STEP" value="<?php echo $step_id; ?>"/>
                </div>
                <div class="form-group" id="data_1">
                    <label>Комментарий</label>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <input name="STATE" class="form-control pos_btn" id="STATE" value="16" required=""/>
                </div>
                <div class="form-group">
                    <label>На контроль</label>
                    <select name="RECIEPMENTS_CONTROL[]" data-placeholder="Несколько получателей..." multiple class="chosen-select col-lg-12">
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
                    <label class="font-noraml">SHORT_TEXT</label>
                    <input name="SHORT_TEXT" class="form-control pos_btn" id="SHORT_TEXT" value="<?php echo $list_mail[0]['SHORT_TEXT']; ?>" required=""/>
                </div>
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
                    <textarea class="form-control" id="COMMENT" name="COMMENT" maxlength="999" required=""></textarea>
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
    $.post
    ('mail_detail_draft',
       {
           "GET_DOCUMENT_FILE": "<?php echo $_GET['doc_id']; ?>"
       },
           function(d)
       {
           $('#mail-body').append(d);
       }
    )

    function lets_work_rec()
    {
        $('#lets_work_resolution').show();
    }

    function add_doc(name, type, format)
    {
        var img = $('#getbase64').val();
        console.log(name);
        $('#text_areas_in_base64').append('<textarea hidden="" name="doc_b64[]" class="altay4">'+img+'.'+name+'.'+format+'</textarea>');
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
        $('#text_areas_in_base64').append('<textarea hidden="" name="doc_b64[]" class="altay4">'+img+'.'+name+'.'+format+'</textarea>');
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
        	fileReader.onload = function(fileLoadedEvent) 
            {
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






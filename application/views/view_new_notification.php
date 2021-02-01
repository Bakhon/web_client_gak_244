<div class="wrapper wrapper-content">
    <div class="col-lg-12 animated fadeInRight">
        <form method="post">
            <div class="mail-box-header">
                <h2>
                    Входящие уведомление (не прочитанные)
                </h2>
                <div class="btn-group">
                    <button onClick="history.go(0)" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Обновить"><i class="fa fa-refresh"></i> Обновить</button>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">Создать <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php
                            $mail_menu = new MailMenu();
                            $mail_menu->show_menu_btn($emp_pos_id);
                        ?>
                    </ul>
                </div>
            </div>
            <div class="mail-box">
                <div class="row">
                    <div class="col-lg-12" id="osn-panel">
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover" id="editable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Рег. номер</th>
                                    <th>Краткое содержание</th>
                                    <th>Автор</th>
                                    <th>Тип</th>
                                    <th>Срок исполнения</th>
                                    <th>Дата отправки</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                            <tbody>
                                    <?php
                                        foreach($list_all_inbox as $k => $v)
                                        {
                                    ?>
                                    <tr class="read">
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['MAIL_ID']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['REG_NUM']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['SHORT_TEXT']; ?></a></td>
                                        <td class="mail-ontact"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['SENDER']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['NAME_KIND']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['DATE_END']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['DATE_START']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>&table_name_eng=<?php echo $v['TABLE_NAME_ENG'];?>"><?php echo $v['TABLE_NAME']; ?></a></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
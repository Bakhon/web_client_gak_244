<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <form method="post">
                <div class="mail-box-header">
                    <h2>
                        Архив канцелярии
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
                                        <th>Регистрационный номер</th>
                                        <th>Краткое содержание</th>
                                        <th>Автор</th>
                                        <th>Тип</th>
                                        <th>Срок исполнения</th>
                                        <th>Дата отправки</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($list_inbox as $k => $v)
                                            {                                                
                                            $date_end = $v['DATE_END'];
                                            $date_start = $v['DATE_START'];
                                            $sort_end = strtotime($date_end);
                                            $sort_start = strtotime($date_start);
                                        ?>                                                
                                        <tr class="read">
                                            <td class="mail-subject"><a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=8&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>"><?php echo $v['ID']; ?></a></td>
                                            <td class="mail-subject"><a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=8&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>"><?php echo $v['REG_NUM']; ?></a></td>
                                            <td class="mail-subject"><a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=8&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>"><?php echo $v['SHORT_TEXT']; ?></a></td>
                                            <td class="mail-ontact"><a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=8&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>"><?php echo $v['SENDER']; ?></a></td>
                                            <td class="mail-subject"><a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=8&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>"><?php echo $v['NAME_KIND']; ?></a></td>
                                            <td class="mail-subject"><a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=8&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>"><span class='hide'><?php echo $sort_end; ?></span><?php echo $v['DATE_END']; ?></a></td>
                                            <td class="mail-subject"><a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>&step_id=<?php echo $v['CURRENT_STEP_ID'];?>&next_step_id=<?php echo $v['NEXT_STEP_ID'];?>&state_id=8&prev_step_id=<?php echo $v['PREV_STEP_ID'];?>"><span class='hide'><?php echo $sort_start; ?></span><?php echo $v['DATE_START']; ?></a></td>
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
</div>


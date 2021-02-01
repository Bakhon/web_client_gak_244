<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    Проекты (внутренние)
                </h2>
            <form method="post">
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
                                    <th>Наименование организации</th>
                                    <th>Исход. ном. организации</th>
                                    <th>Автор</th>
                                    <th>Адресат</th>
                                    <th>Тип</th>
                                    <th>Срок исполнения</th>
                                    <th>Дата отправки</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($list_inbox as $k => $v)
                                        {
                                            $date = $v['DATE_END'];
                                            $date_2 = $v['DATE_START'];
                                            $date_sort = strtotime($date);
                                            $date_ss = strtotime($date_2);
                                    ?>
                                    <tr class="read">
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['ID']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['REG_NUM']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['SHORT_TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['ORG_SENDER']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['SENDER_REG_NUM']; ?></a></td>
                                        <td class="mail-ontact"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['SENDER']; ?></a></td>
                                        <td class="mail-ontact"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['FIO']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['NAME_KIND']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><span class='hide'><?php echo $date_sort; ?></span><?php echo $v['DATE_END']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&state_id=<?php echo $v['STATE_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><span class='hide'><?php echo $date_ss; ?></span><?php echo $v['DATE_START']; ?></a></td>
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
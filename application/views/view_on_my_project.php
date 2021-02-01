<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    Поиск
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
                      <div class="table-responsive">
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="editable">
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
                                        foreach($list_reciep as $k => $v)
                                        {
                                            $id  = $v['ID'];
                                            $name_kind = $v['NAME_KIND'];
                                    ?>
                                    <tr class="read">
                                        <td class="mail-subject"><a href="mail_detail_draft?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $id; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail_draft?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['REG_NUM']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail_draft?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['SHORT_TEXT']; ?></a></td>
                                        <td class="mail-ontact"><a href="mail_detail_draft?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['SENDER']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail_draft?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $name_kind; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail_draft?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['DATE_END']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail_draft?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['MAIL_ID'];?>&draft_mail_id=<?php echo $v['MAIL_ID'];?>"><?php echo $v['DATE_START']; ?></a></td>
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
            </div>
            </form>
        </div>
    </div>
</div>
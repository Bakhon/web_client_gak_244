<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                   Завершенные рекомендации
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
                                    <th>Заголовок</th>
                                    <th>Дата написания</th>
                                    <th>Основание</th>
                                    <th>Ответственное СТП</th>
                                    <th>Дата исполнения</th>
                                    <th>Последний комментарий</th>
                                    <th>Дата последнего комментария</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($list_reciep as $k => $v)
                                        {
                                            $doc_id = $v['ID'];
                                            $sql_inbox_detail .=
                                                        "select doc.*, TRIVIAL.JOB_SP, DEPART.NAME dep_name from DOC_ASSIGN_RECIEPMENTS doc, SUP_PERSON trivial, DIC_DEPARTMENT depart where doc.MAIL_ID = '$doc_id' and TRIVIAL.EMAIL = doc.RECIEPMENTS_MAIL and DEPART.ID = TRIVIAL.JOB_SP";
                                            $list_reciep_detail = $db -> Select($sql_inbox_detail);
                                            //echo '<pre>';
                                            //print_r($list_reciep_detail);
                                            //echo '<pre>';
                                            $sql_inbox_detail = '';

                                            $sql_assign_comments .= 
                                                        "select doc.* from DOC_ASSIGNMENTS_COMMENTS doc where doc.MAIL_ID = '$doc_id' and doc.ID = (select max(ID) from DOC_ASSIGNMENTS_COMMENTS where MAIL_ID = '$doc_id') ";
                                            $list_assign_comments = $db -> Select($sql_assign_comments);
                                            $sql_assign_comments = '';

                                            $sql_assign .= 
                                                        "select doc.* from DOC_ASSIGNMENT doc where doc.MAIL_ID = '$doc_id'";
                                            $list_assign = $db -> Select($sql_assign);
                                            $sql_assign = '';
                                    ?>
                                    <tr class="read">
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['ID']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['HEAD_TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['DATE_START']; ?></a></td>
                                        <td class="mail-ontact"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $list_assign[0]['COMMENT_TO_ASSIGN']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php foreach($list_reciep_detail as $z => $q){echo $q['DEP_NAME'].'<br />';} ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['DATE_END']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $list_assign_comments[0]['TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $list_assign_comments[0]['DATE_OF_COMMENT']; ?></a></td>
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


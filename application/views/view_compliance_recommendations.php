<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    Рекомендации комплаенс контроллера 
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
                                    <th>Заголовок</th>
                                    <th>Дата рекомендации</th>
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
                                                        "select doc.*, TRIVIAL.JOB_SP, DEPART.SHORT_NAME SHORT_NAME from DOC_ASSIGN_RECIEPMENTS doc, SUP_PERSON trivial, DIC_DEPARTMENT depart where doc.MAIL_ID = '$doc_id' and TRIVIAL.EMAIL = doc.RECIEPMENTS_MAIL and DEPART.ID = TRIVIAL.JOB_SP ORDER BY doc.ID";
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
                                                        "select doc.* from DOC_ASSIGNMENT doc where doc.MAIL_ID = '$doc_id' ORDER BY COMMENT_TO_ASSIGN";
                                            $list_assign = $db -> Select($sql_assign);
                                            $sql_assign = '';
                                    ?>
                                    <tr class="read">
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['ID']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['HEAD_TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['DATE_START']; ?></a></td>
                                        <td class="mail-сontact"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $list_assign[0]['COMMENT_TO_ASSIGN']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php foreach($list_reciep_detail as $z => $q){echo $q['SHORT_NAME'].'<br />';} ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $v['DATE_END']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $list_assign_comments[0]['TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="assign_detail?doc_id=<?php echo $v['ID']; ?>&get_file=<?php echo $v['ID'];?>"><?php echo $list_assign_comments[0]['DATE_OF_COMMENT']; ?></a></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                             <form method="post" target="_blank" action="print_timesheet">
                                <textarea hidden="" name="content">
                                    <div style="text-align: center;">
                                        <strong>
                                            <h3>Действующие рекомендации на <?php echo $today_date.' (время: '.$now_time.')'; ?></h3>
                                        </strong>
                                    </div>
                                    <table>
                                        <thead>
                                        <tr style="border: 1px solid;">
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">№</th>
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">Заголовок</th>
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">Дата поручения</th>
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">Основание</th>
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">Ответственное СТП</th>
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">Дата исполнения</th>
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">Последний комментарий</th>
                                            <th style="border: 1px solid;background-color: #1c84c6; color: white;">Дата последнего комментария</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                foreach($list_reciep as $k => $v)
                                                {
                                                    $doc_id = $v['ID'];
                                                    $sql_inbox_detail .=
                                                                "select doc.*, TRIVIAL.JOB_SP, DEPART.SHORT_NAME SHORT_NAME from DOC_ASSIGN_RECIEPMENTS doc, SUP_PERSON trivial, DIC_DEPARTMENT depart where doc.MAIL_ID = '$doc_id' and TRIVIAL.EMAIL = doc.RECIEPMENTS_MAIL and DEPART.ID = TRIVIAL.JOB_SP ORDER BY doc.ID";
                                                    $list_reciep_detail = $db -> Select($sql_inbox_detail);
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
                                            <tr>
                                                <td style="border: 1px solid; text-align: center;"><?php echo $i; ?></td>
                                                <td style="border: 1px solid;"><?php echo $v['HEAD_TEXT']; ?></td>
                                                <td style="border: 1px solid;"><?php echo $v['DATE_START']; ?></td>
                                                <td style="border: 1px solid;"><?php echo $list_assign[0]['COMMENT_TO_ASSIGN']; ?></td>
                                                <td style="border: 1px solid;"><?php foreach($list_reciep_detail as $z => $q){echo $q['SHORT_NAME'].'<br />';} ?></td>
                                                <td style="border: 1px solid;"<?php if(((strtotime($v['DATE_END'])<strtotime($today_date)))){echo 'style="background-color: red; color: white;"';} ?>><?php echo $v['DATE_END']; ?><?php if((strtotime($v['DATE_END'])<strtotime($today_date))){echo '<br />просрочено';} ?></td>
                                                <td style="border: 1px solid;"><?php echo $list_assign_comments[0]['TEXT']; ?></td>
                                                <td style="border: 1px solid;"><?php echo $list_assign_comments[0]['DATE_OF_COMMENT']; ?></td>
                                            </tr>
                                            <?php
                                                $i++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </textarea>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-info"> Распечатать лист рекомендаций </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


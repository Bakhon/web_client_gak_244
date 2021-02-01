<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
      

    $sql_pos_id = "select JOB_POSITION from sup_person where EMAIL = '$emp_mail' and state = 2";
    $list_pos_id = $db -> Select($sql_pos_id);
    $emp_pos_id = $list_pos_id[0]['JOB_POSITION'];
   
?>

    <div class="ibox float-e-margins">
        <div class="ibox-content mailbox-content">
            <div class="file-manager">
                <div class="input-group-btn">
                    <a class="btn btn-block btn-primary compose-mail dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span> Создать </a>
                    <ul class="dropdown-menu">
                        <?php
                            $mail_menu = new MailMenu();
                            $mail_menu->show_menu_btn($emp_pos_id);
                        ?>
                        <li><a href="create_mail_output">Исходящий документ</a></li>
                        <!--<li><a href="create_statement_for_pay">Заявление на выплату(в разработке)</a></li>-->
                    </ul>
                </div>
                <div class="space-25"></div>
                <h5>Папки</h5>
                <ul class="folder-list m-b-md" style="padding: 0">
                    <?php
                        $mail_menu->show_menu_item($emp_pos_id, $didnt_open_count, $didnt_at_work_open_count, $outbox, $didnt_delegated_open_count, $didnt_completed_open_count, $trash);
                    ?>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
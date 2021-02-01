<?php
    $db = new DB();
    $emp_mail = $_SESSION['insurance']['other']['mail'][0];
    if(isset($_GET['USER_MAIL']))
    {
        $emp_mail = $_GET['USER_MAIL'];
    }

    $on_inbox_new = get_newinbox_mail_count($emp_mail);
    $on_assignment = get_on_assignment_mail_count($emp_mail);
    $on_my_control = get_my_control_mail_count($emp_mail);
    $on_my_execution = get_my_execution_mail_count($emp_mail);
    $on_my_archive = get_my_archive_mail_count($emp_mail);
    $on_my_rejection = get_my_rejection_mail_count($emp_mail);

    $on_my_project = get_on_my_project_mail_count($emp_mail);
    $on_agreement = get_on_agreement_mail_count($emp_mail);
    $on_rejection = get_on_rejection_mail_count($emp_mail);
    $on_execution = get_on_execution_mail_count($emp_mail);
    $on_resulution = get_on_resulution_mail_count($emp_mail);
    $on_archive = get_on_archive_mail_count($emp_mail);
    $on_archive_outter = get_on_archive_outter_mail_count($emp_mail);

    $on_project = get_on_project_mail_count($emp_mail);
    $on_agreement_out = get_on_agreement_out_mail_count($emp_mail);
    $on_registration = get_on_registration_mail_count($emp_mail);
    $on_new_notification = get_newinbox_notification_mail_count($emp_mail);
    $on_notification_execution = get_my_notification_execution_mail_count($emp_mail);
    $on_notification_fin = notification_fin($emp_mail);
    $on_payment_archive = get_payment_archive($emp_mail);
    $on_payment_execution = get_payment_execution($emp_mail);

?>
<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="mail-box">
            <div class="mail-body" id="mail-body">
            <form enctype="multipart/form-data" class="form-horizontal" method="GET" id="main_form">
                <div class="mail-body">
                <div class="form-group"><label class="col-sm-2 control-label">Сотрудник:</label>
                    <div class="col-sm-10">
                        <select name="USER_MAIL" id="USER_MAIL" class="chosen-select col-lg-12">
                            <option></option>
                            <?php
                                foreach($list_persons as $k => $v)
                                {
                            ?>
                                <option <?php if($v['EMAIL'] == $emp_mail){echo 'selected';} ?> value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO'].' - ' .$v['D_NAME'].' ('.$v['DEP_NAME'].')'; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success col-lg-12" data-toggle="tooltip" data-placement="top" title="Найти"><i class="fa fa-search"></i> Найти</button>
                <hr />
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Входящие</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins">
                            <tbody>
                            <tr>
                                <td><a href="on_inbox_new?user_email=<?php echo $emp_mail; ?>" data1="doc_inbox" data2="documentooborot">Новые <span class="label label-info pull-right"><?php echo $on_inbox_new; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_assignment?user_email=<?php echo $emp_mail; ?>" data1="doc_inbox" data2="documentooborot">Делегировано <span class="label label-info pull-right"><?php echo $on_assignment; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_my_control?user_email=<?php echo $emp_mail; ?>" data1="doc_inbox" data2="documentooborot">На контроле <span class="label label-info pull-right"><?php echo $on_my_control; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_my_execution?user_email=<?php echo $emp_mail; ?>" data1="doc_inbox" data2="documentooborot">На исполнении <span class="label label-info pull-right"><?php echo $on_my_execution; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_my_archive?user_email=<?php echo $emp_mail; ?>" data1="doc_inbox" data2="documentooborot">В архиве <span class="label label-info pull-right"><?php echo $on_my_archive; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_my_rejection?user_email=<?php echo $emp_mail; ?>" data1="doc_inbox" data2="documentooborot">Отклоненные <span class="label label-info pull-right"><?php echo $on_my_rejection; ?></span></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>МОИ ПРОЕКТЫ (ВНУТРЕННИЕ)</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins">
                            <tbody>
                            <tr>
                                <td><a href="on_my_project?user_email=<?php echo $emp_mail; ?>" data1="doc_my_project" data2="documentooborot">Проекты<span class="label label-info pull-right"><?php echo $on_my_project; ?></span></td>
                            </tr>
                            <tr>
                                <td><a href="on_agreement?user_email=<?php echo $emp_mail; ?>" data1="doc_my_project" data2="documentooborot">На согласовании <span class="label label-info pull-right"><?php echo $on_agreement; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_rejection?user_email=<?php echo $emp_mail; ?>" data1="doc_my_project" data2="documentooborot">Отклоненные <span class="label label-info pull-right"><?php echo $on_rejection; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_execution?user_email=<?php echo $emp_mail; ?>" data1="doc_my_project" data2="documentooborot">В работе <span class="label label-info pull-right"><?php echo $on_execution; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_resulution?user_email=<?php echo $emp_mail; ?>" data1="doc_my_project" data2="documentooborot">Ожидает резолюции <span class="label label-info pull-right"><?php echo $on_resulution; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_archive?user_email=<?php echo $emp_mail; ?>" data1="doc_my_project" data2="documentooborot">Завершенные <span class="label label-info pull-right"><?php echo $on_archive; ?></span></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>МОИ ПРОЕКТЫ (ВНЕШНИЕ)</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins">
                            <tbody>
                            <tr>
                                <td><a href="on_project?user_email=<?php echo $emp_mail; ?>" data1="doc_outbox" data2="documentooborot">Проекты<span class="label label-info pull-right"><?php echo $on_project; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_agreement_out?user_email=<?php echo $emp_mail; ?>" data1="doc_outbox" data2="documentooborot">На согласовании/подписании<span class="label label-info pull-right"><?php echo $on_agreement_out; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_registration?user_email=<?php echo $emp_mail; ?>" data1="doc_outbox" data2="documentooborot">Подписанные <span class="label label-info pull-right"><?php echo $on_registration; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_archive_outter?user_email=<?php echo $emp_mail; ?>" data1="doc_outbox" data2="documentooborot">Отправленные <span class="label label-info pull-right"><?php echo $on_archive_outter; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="on_rejection?user_email=<?php echo $emp_mail; ?>" data1="doc_outbox" data2="documentooborot">Отклоненные <span class="label label-info pull-right"><?php echo $on_rejection; ?></span></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                   <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Уведомление</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins">
                            <tbody>
                            <tr>
                                <td><a href="on_my_notification_execution?user_email=<?php echo $emp_mail; ?>" data1="doc_notification" data2="documentooborot">На исполнении<span class="label label-info pull-right"><?php echo $on_notification_execution; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="end_notification?user_email=<?php echo $emp_mail; ?>" data1="doc_notification" data2="documentooborot">Завершенные<span class="label label-info pull-right"><?php echo $on_notification_fin; ?></span></a></td>
                            </tr>
                           
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                
                       <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Распоряжение на выплату</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins">
                            <tbody>
                            <tr>
                                <td><a href="payment_orders_execute?user_email=<?php echo $emp_mail; ?>" data1="doc_notification" data2="documentooborot">На исполнении<span class="label label-info pull-right"><?php echo $on_payment_execution; ?></span></a></td>
                            </tr>
                            <tr>
                                <td><a href="payment_orders_archive?user_email=<?php echo $emp_mail; ?>" data1="doc_notification" data2="documentooborot">Завершенные<span class="label label-info pull-right"><?php echo $on_payment_execution; ?></span></a></td>
                            </tr>
                           
                            </tbody>
                        </table>
                    </div>
                </div>
                
            <hr/>
            </form>
            </div>
        </div>
    </div>
</div>

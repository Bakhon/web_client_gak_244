<?php
    //echo '<pre>';
    //print_r($_SESSION);
    //echo '<pre>';
?>
<div class="wrapper wrapper-content">
    <div class="row">
            
            
            <div class="col-lg-12 animated fadeInRight">
            
            <div class="mail-box-header">
                <h2>
                    В работе
                </h2>
                <form method="post">
                <div class="btn-group">
                    <button onClick="history.go(0)" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Обновить"><i class="fa fa-refresh"></i> Обновить</button>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">Создать <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php
                            $db = new DB();

                            $emp_mail = $_SESSION['insurance']['other']['mail'][0];
                            
                            $sql_pos_id = "select JOB_POSITION from sup_person where EMAIL = '$emp_mail'";
                            $list_pos_id = $db -> Select($sql_pos_id);
                            $emp_pos_id = $list_pos_id[0]['JOB_POSITION'];
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
                                        <th class="text-right mail-date">Срок исполнения</th>
                                        <th class="text-right mail-date">Дата отправки</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($list_inbox as $k=> $v){ $state = $v['STATE']; switch ($state){ case 0: $prop = 'label-danger'; break; case 1: $prop = 'label-warning'; break; case 2: $prop = 'label-success'; break; case 3: $prop = 'label-danger'; break; case 4: $prop = 'label-primary'; break; case 5: $prop = 'label-danger'; break; }; ?>
                                    <tr class="read">
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>"><?php echo $v['ID']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>"><?php echo $v['REG_NUM']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>"><?php echo $v['SHORT_TEXT']; ?></a></td>
                                        <td class="mail-ontact"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>"><?php echo $v['SENDER']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>"><?php echo $v['NAME_KIND']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>"><?php echo $v['DATE_END']; ?></a></td>
                                        <td class="mail-subject"><a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>"><?php echo $v['DATE_START']; ?></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
        
<script>
/*
    $('.check-mail').click(
        function(){
            $('.check-mail').each(
                function(){
                    if($(this).is(":checked")){
                	   console.log($(this).val());
                    }
                }
            );
        }
    )
*/
</script>













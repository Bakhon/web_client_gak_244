<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <?php //require_once MODELS. 'mail_menu.php'; ?>
        </div>
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    История писем
                </h2>
            </div>
            <div class="mail-box">
                <div class="row">
                    <div class="col-lg-12" id="osn-panel">
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover" id="editable">
                                <thead>
                                    <tr>
                                        <tr>
                                            <th>Рег. номер</th>
                                            <th>ID письма</th>
                                            <th>Отправитель</th>
                                            <th>Внешний отправитель</th>
                                            <th>Заголовок</th>
                                            <th>Краткое</th>
                                            <th>Статус</th>
                                            <th class="text-right mail-date">Дата отправки</th>
                                        </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($list_inbox as $k=> $v){
                                        $date = $v['DATE_END'];
                                            $date_2 = $v['DATE_START'];
                                            $date_sort = strtotime($date);
                                            $date_ss = strtotime($date_2);
                                        $state = $v['STATE']; switch ($state){ case 0: $prop = 'label-danger'; break; case 1: $prop = 'label-warning'; break; case 2: $prop = 'label-success'; break; case 3: $prop = 'label-danger'; break; case 4: $prop = 'label-primary'; break; case 5: $prop = 'label-danger'; break; }; ?>
                                    <tr class="read">
                                        <td class="mail-subject">
                                            <a href="mail_detail_just_read?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>">
                                                <?php echo $v['REG_NUM']; ?>
                                        </td>
                                        <td>
                                            <?php echo $v['MAIL_ID']; ?>
                                        </td>
                                        <td class="mail-subject">
                                            <a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>">
                                                <?php echo $v['SENDER']; ?>
                                            </a>
                                        </td>
                                        <td class="mail-subject">
                                            <a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>">
                                                <?php echo $v['ORG_SENDER']; ?>
                                            </a>
                                        </td>
                                        <td class="mail-subject">
                                            <a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>">
                                                <?php echo $v['HEAD_TEXT']; ?>
                                        </td>
                                        <td class="mail-subject">
                                            <a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>">
                                                <?php echo $v['SHORT_TEXT']; ?>
                                        </td>
                                        <td class="mail-subject">
                                            <a href="mail_detail?doc_id=<?php echo $v['MAIL_ID']; ?>&get_file=<?php echo $v['DOC_LINK'];?>&rec_id=<?php echo $v['ID'];?>&dest_id=<?php echo $v['DESTINATION'];?>">
                                                <?php echo $v['STATE_NAME']; ?>
                                        </td>
                                        <td class="text-right mail-date">
                                            <span class='hide'><?php echo $date_ss; ?></span><?php echo $v['DATE_START']; ?>
                                        </td>
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
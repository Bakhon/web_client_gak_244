<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>ID отпуска</th>
                        <th>ФИО</th>
                        <th>Дата отпуска</th>
                        <th>Тип</th>
                        <th>Номер приказа</th>
                        <th>Дата приказа</th>
                        <th>Количество дней</th>
                        <th>Приказ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($listEmployee as $k=> $v)
                        { 
                    ?>
                    <tr ondblclick="$(location).attr('href','doc_detail?doc_id=<?php echo $v['ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td>
                            <?php echo $v['ID'];?>
                        </td>
                        <td>
                            <?php echo $v['FIO']. ' '.$v['FIRSTNAME']. ' '.$v['MIDDLENAME'];?>
                        </td>
                        <td>
                            <?php echo $v['DATE_HOLY'];?>
                        </td>
                        <td>
                            <?php echo $v['VID'];?>
                        </td>
                        <td>
                            <?php echo $v['ORDER_NUM'];?>
                        </td>
                        <td>
                            <?php echo $v['ORDER_DATE'];?>
                        </td>
                        <td>
                            <?php echo $v['CNT_DAYS'];?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#order<?php echo $v['ID'];?>">Приказ</button>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                </tbody>
            </table>
            <br />
            <!--<a href="employee" type="button" class="btn btn-primary btn-xs">Добавить нового сотрудника</a>-->
        </div>
    </div>
</div>
<?php 
foreach($listEmployee as $k=> $v)
    { 
?>
<div class="modal inmodal fade" id="order<?php echo $v['ID'];?>" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Приказ</h4>
            </div>
            <div class="modal-body">
                <?php echo $v['DOC_CONTENT'];?>
            </div>
            <form method="POST" action="edit_doc">
                <textarea hidden="" name="text_for_edit"><?php echo $v['DOC_CONTENT'];?></textarea>
                <input hidden="" name="holi_id" value="<?php echo $v['ID'];?>"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    }
?>
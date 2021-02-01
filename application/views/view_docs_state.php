<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>ID письма</th>
                        <th>Отправитель</th>
                        <th>Destination</th>
                        <th>Дата старта</th>
                        <th>Тип</th><a>
                        <th>Краткое описание</th>
                        <th>Адресат</th>
                        <th>Статус</th>
                        <th>Таблица</th>
                        <th>STATE_ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($listEmployee as $k=> $v)
                        {
                    ?>
                    <tr class="gradeX view_user_dan" style="cursor: default;">
                        <td>
                            <?php echo $v['MAIL_ID'];?>
                        </td>
                        <td>
                            <?php echo $v['SENDER'];?>
                        </td>
                        <td>
                            <?php echo $v['DESTINATION'];?>
                        </td>
                        <td>
                            <?php echo $v['DATE_START'];?>
                        </td>
                        <td>
                            <?php echo $v['NAME_KIND'];?>
                        </td>
                        <td>
                            <?php echo $v['SHORT_TEXT'];?>
                        </td>
                        <td>
                            <?php echo $v['SENDER_MAIL'];?>
                        </td>
                        <td>
                            <?php echo $v['STATE_NAME'];?>
                        </td>
                        <td>
                            <?php echo $v['TABLE_NAME'];?>
                        </td>
                        <td>
                            <?php echo $v['STATE_ID'];?>
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

<div class="row">
    <div class="col-lg-12" id="osn-panel">
       <div class="ibox-title"><h3 align="center">Результаты анкетирования</h3>
       </div>
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название проекта</th>
                        <th>Автор проекта</th>
                        <th>Тип проекта</th>
                        <th>Статус</th><a><!--
                        <th>ИИН</th>
                        <th>Номер удостеверения личности</th>-->
                        <th>Дата закрытие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list_project as $k => $v){ ?>
                    <tr ondblclick="$(location).attr('href','res_stat_full?project_id=<?php echo $v['ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td>
                            <?php echo $v['ID'];?>
                        </td>
                        <td>
                            <?php echo $v['NAME'];?>
                        </td>
                        <td>
                            <?php echo $fam_user. ' '.$fam_user1. ' '.$fam_user2;?>
                        </td>
                        <td>
                            <?php if($v['ID_TYPE'] == '1') { echo "Тестирование";} else{ echo "Опросник";}?>
                        </td>
                                                <td class="client-status">
                            <span class="<?php $state = $v['STATE']; switch ($state)
                            {
                                 case 0:
                                 echo 'label label-danger';
                                 break;
                                 case 1:
                                 echo 'label label-warning';
                                 break;
                                 case 2:
                                 echo 'label label-primary';
                                 break;
                                 }
                                 ?>">
                                 <?php echo $listState[$v['STATE']]['NAME'];
                                 ?>
                             </span>
                        </td>
                        <td>
                            <?php echo $v['DATE_CLOSE'];?>
                        </td>
                        <!--
                        <td>
                            <?php echo $v['IIN'];?>
                        </td>
                        <td>
                            <?php echo $v['DOCNUM'];?>
                        </td>
                        -->

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br />
            <!--<a href="employee" type="button" class="btn btn-primary btn-xs">Добавить нового сотрудника</a>-->
        </div>
    </div>
</div>
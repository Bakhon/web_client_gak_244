<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Должность</th>
                        <th>Департамент</th>
                        <th>Почта</th><a>
                        <th>Номер телефона</th>
                        <!--
                        <th>Номер удостеверения личности</th>
                        -->
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listEmployee as $k=> $v){ ?>
                    <tr ondblclick="$(location).attr('href','edit_employee?employee_id=<?php echo $v['ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td>
                            <?php echo $v['ID'];?>
                        </td>
                        <td>
                            <?php echo $v['FIO'];//. ' '.$v['FIRSTNAME']. ' '.$v['MIDDLENAME'];?>
                        </td>
                        <td>
                            <?php echo $v['D_NAME'];?>
                        </td>
                        <td>
                            <?php echo $v['DEP'];?>
                        </td>
                        <td>
                            <?php echo $v['EMAIL'];?>
                        </td>
                        <td>
                            <?php echo $v['WORK_PHONE'];?>
                        </td>
                        <!--
                        <td>
                            <?php echo $v['DOCNUM'];?>
                        </td>
                        -->
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
                                 case 3:
                                 echo 'label label-warning';
                                 break;
                                 case 4:
                                 echo 'label label-warning';
                                 break;
                                 case 5:
                                 echo 'label label-warning';
                                 break;
                                 case 6:
                                 echo 'label label-warning';
                                 break;
                                 case 7:
                                 echo 'label label-danger';
                                 break;
                                 case 8:
                                 echo 'label label-danger';
                                 break;
                            }
                                 ?>">
                                 <?php echo $listState[$v['STATE']]['NAME'];
                                 ?>
                             </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br />
            <!--<a href="employee" type="button" class="btn btn-primary btn-xs">Добавить нового сотрудника</a>-->
        </div>
    </div>
</div>

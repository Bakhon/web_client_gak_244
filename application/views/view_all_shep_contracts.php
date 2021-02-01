<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Организация</th>
                        <th>Номер запроса</th>
                        <th>SSD_ID</th>
                        <th>Дата запроса</th>
                        <th>GBDFLRESPONSE</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($shep_requests_list as $k=> $v){ ?>
                    <tr ondblclick="$(location).attr('href','online_contract?SSD_ID=<?php echo $v['SSD_ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td>
                            <?php echo $v['ID'];?>
                        </td>
                        <td>
                            <?php echo $v['ORGFULLNAMERU'];?>
                        </td>
                        <td>
                            <?php echo $v['REQUESTNUMBER'];?>
                        </td>
                        <td>
                            <?php echo $v['SSD_ID'];?>
                        </td>
                        <td>
                            <?php echo $v['MESSAGEDATE'];?>
                        </td>
                        <td>
                            <?php echo $v['SURNAME'].' '.$v['NAME'].' '.$v['PATRONYMIC'];?>
                        </td>
                        <td class="client-status">
                            <span class="<?php $state = $v['STATE']; switch ($state)
                            {
                                 case 0:
                                 echo 'label label-info';
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
                                 <?php echo $v['NAMERU'];
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

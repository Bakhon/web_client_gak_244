<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">            
            <table class="table table-striped table-bordered table-hover" id="editable" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ФИО</th>
                        <th>Название курса</th>
                        <th>Дата начало</th>
                        <th>Дата завершения</th>
                        <th>Количество дней</th>
                        <th>Расположение</th>
                        <th>Сумма(тенге)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($list_dep as $k => $v){
                            $date = $v['DATE_END'];
                                            $date_2 = $v['DATE_BEGIN'];
                                            $date_sort = strtotime($date);
                                            $date_ss = strtotime($date_2);
                    ?>
                    <tr ondblclick="$(location).attr('href','dep_page?dep_id=<?php echo $v['ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td><?php echo $v['ID'];?></td>
                        <td><?php echo $v['LASTNAME'].' '.$v['FIRSTNAME'].' '.$v['MIDDLENAME'];?></td>
                        <td><?php echo $v['NAME'];?></td>
                        <td><span class='hide'><?php echo $date_ss; ?></span><?php echo $v['DATE_BEGIN'];?></td>
                        <td><span class='hide'><?php echo $date_sort; ?></span><?php echo $v['DATE_END'] ?></td>
                        <td><?php echo $v['CNCT_DAY'] ?></td>
                        <td><?php echo $v['LOCATION'] ?></td>
                        <td><?php echo $v['SUM'];?></td>
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


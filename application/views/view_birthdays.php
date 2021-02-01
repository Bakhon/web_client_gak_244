                        <div class="row">
                            <div class="col-lg-12" id="osn-panel">
                            <div class="ibox-content">
<table class="table table-striped table-bordered table-hover" id="editable" >
        <thead>
        <tr>
            <th>ФИО</th>
            <th>Должность</th>
            <th>Департамент</th>
            <th>Дни рождения</th>
        </tr>
        </thead>
        <tbody>
        <?php 
                //echo '<pre>';
                //print_r($listEmployee);
                //echo '<pre>';
        ?>
        <?php
            foreach($listEmployee as $k => $v){
        ?>
        <tr ondblclick="$(location).attr('href','edit_employee?employee_id=<?php echo $v['ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
            <td><?php echo $v['FIO'].' '.$v['FIRSTNAME'].' '.$v['MIDDLENAME'];?></td>
            <td><?php echo $v['D_NAME'];?></td>
            <td><?php echo $v['DEP'];?></td>
            <td><strong><?php echo $v['BIRTHDATE'];?></strong></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<br />
<!--<a href="employee" type="button" class="btn btn-primary btn-xs">Добавить нового сотрудника</a>-->
</div></div></div>
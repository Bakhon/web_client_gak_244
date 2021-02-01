                        <div class="row">
                            <div class="col-lg-12" id="osn-panel">
                            <div class="ibox-content">
<table class="table table-striped table-bordered table-hover " id="editable" >
        <thead>
        <tr>
            <th>Название теста</th>
            <th>Тип теста</th>
            <th>Дата последнего обновления</th>
            <th>Автор</th>
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
        <tr ondblclick="$(location).attr('href','ques?test_id=<?php echo $v['ID']; ?>');" class="gradeX" data="<?php ?>" style="cursor: default;">
            <td><?php echo $v['NAME'];?></td>
            <td><?php echo $v['TYPE'];?></td>
            <td><?php echo $v['TEST_DATE'];?></td>
            <td><?php echo $v['AUTHOR_ID'];?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<br />
<!--<a href="employee" type="button" class="btn btn-primary btn-xs">Добавить нового сотрудника</a>-->
</div></div></div>
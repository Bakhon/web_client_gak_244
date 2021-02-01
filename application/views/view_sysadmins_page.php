<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Кандидаты утвержденные председателем, ожидающие данные для учетной записи</h5>
                        <div class="ibox-tools">
                            
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Филиал</th>
                        <th>Департамент</th>
                        <th>Должность</th>
                        <th>Логин</th>
                    </tr>
                    </thead>
                    <tbody id="placeForListEmployee">
                    <?php 
                        foreach($listEmployee as $k => $v){
                    ?>
                    <tr class="gradeX">
                        <td><?php echo $v['FIO']; ?></td>
                        <td><?php echo $v['DEP_NAME']; ?>
                        </td>
                        <td><?php echo $v['DOLZH_NAME']; ?></td>
                        <td class="center"><?php echo $v['OKLAD']; ?> тг.</td>
                        <td class="">
                            <div class="btn-group">
                                <a href="show_emp?employee_id=<?php echo $v['ID']; ?>" class="btn-white btn btn-xs">Подробнее</a>
                                <a onclick="refuse(<?php echo $v['ID']; ?>);" class="btn-white btn btn-xs">Отклонить</a>
                                <a onclick="recruit(<?php echo $v['ID']; ?>);" class="btn-white btn btn-xs">Утвердить</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
<script>
    function recruit(id){
        var recruitId = id;
        $.post('chief_page', {"recruitId": recruitId
                                     }, function(d){
                $('#placeForListEmployee').html(d);
                //console.log(d);
            });
    }
</script>

<script>
    function refuse(id){
        var refuseId = id;
        $.post('chief_page', {"refuseId": refuseId
                                     }, function(d){
                $('#placeForListEmployee').html(d);
            });
    }
</script>
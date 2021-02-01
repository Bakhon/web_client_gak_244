<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable">
                <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Инвенатрный номер</th>
                        <th>Тип</th>
                        <th>Цена</th>
                        <th>Отвественный</th>
                        <th>Функции</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list_techs as $k=> $v){ ?>
                    <tr ondblclick="$(location).attr('href','edit_employee?employee_id=<?php echo $v['ID']; ?>');" class="gradeX view_user_dan" data="<?php ?>" style="cursor: default;">
                        <td><?php echo $v['NAME']; ?></td>
                        <td><?php echo $v['INVENT_NUM']; ?></td>
                        <td><?php echo $v['ID_TYPE']; ?></td>
                        <td><?php echo $v['PRICE']; ?> тенге</td>
                        <td><?php echo $v['EMP_ID']; ?> </td>
                        <td><a data-toggle="modal" data-target="#add_owner" onclick="$('#TECH_ID').val(<?php echo $v['ID']; ?>);" class="btn btn-primary btn-xs">Добавить хозяина</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br />
        </div>
    </div>
</div>

<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="add_owner" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить хозяина</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Техника</label>
                        <select id="TECH_EMP_ID" name="TECH_EMP_ID" class="select2_demo_1 form-control chosen-select">
                            <option></option>
                            <?php
                                foreach($listEmployee as $s => $t){
                            ?>
                                <option  value="<?php echo trim($t['ID']); ?>"><?php echo $t['FIO']. ' '.$t['FIRSTNAME']. ' '.$t['MIDDLENAME'];?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Техника</label>
                        <input name="TECH_ID" class="form-control pos_btn" id="TECH_ID"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                  
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    //echo '<pre>';
   // print_r($_SESSION);
    //echo '</pre>';
?>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox-content">
                <!--<a data-toggle="modal" data-target="#addEmp" class="btn btn-sm btn-primary"><i class="fa fa-plus">Принять на работу</i></a>-->
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-noraml">Название проекта</label>
                                <input name="test_name" type="text" placeholder="" class="form-control" id="test_name" required>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">Тип теста</label>
                                <select name="test_type" class="select2_demo_1 form-control" id="test_type" required>
                                    <option value=""></option>
                                    <option value="2">Тест</option>
                                    <option value="1">Опросник</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">Дата теста</label>
                                <input name="test_date" type="text" placeholder="" class="form-control" id="test_date" value="<?php echo date("d.m.Y"); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">Автор теста</label>
                                <input name="test_author" type="text" placeholder="" class="form-control" id="test_author" value="<?php echo $_SESSION['insurance']['uid']; ?>" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>             
                    </div>
                    </form>
            </div>                
        </div>           
    </div>
</div>





















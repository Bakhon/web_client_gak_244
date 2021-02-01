<?php
    //echo '<pre>';
    //print_r($_SESSION);
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
                                <label class="font-noraml">Текст вопроса</label>
                                <textarea name="ques_text" id="ques_text" class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">ID теста</label>
                                <input name="id_test" type="text" placeholder="" class="form-control fio_place" id="id_test" value="<?php echo $_GET['test_id']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">Количество правильных ответов</label>
                                <select name="type" class="select2_demo_1 form-control" id="type" required>
                                    <option value="1">Один</option>
                                    <option value="2">Несколько</option>
                                </select>
                            </div>
                            <button data-toggle="modal" data-target="#add_answ"  type="button" class="btn btn-primary">Добавить вариант ответа</button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>             
                    </div>
                    </form>
            </div>                
        </div>           
    </div>
</div>

<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="add_answ" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить вариант ответа</h4>
            </div>
            <div class="modal-body">
            <form method="post">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">ID вопроса</label>
                        <input name="LASTNAMEgbdfl" type="text" placeholder="" class="form-control fio_place" id="LASTNAMEgbdfl" value="" required>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст ответа</label>
                        <input name="FIRSTNAMEgbdfl" type="text" placeholder="" class="form-control fio_place" id="FIRSTNAMEgbdfl" value="" required>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Корректность</label>
                        <select name="test_type" class="select2_demo_1 form-control" id="test_type" required>
                            <option value="0">Неправильный</option>
                            <option value="1">Правильный</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <a onclick="check_iin();" type="submit" class="btn btn-primary" data-dismiss="modal">Сохранить</a>
                <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                
            </div>
            </form>
        </div>
    </div>
</div>



















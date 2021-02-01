<div class="col-lg-12">
    <div class="row">
        
            <div class="ibox">
                <div class="ibox-content">
                                           <span class="pull-right">
                            <a target="_blank" href="site_elem_arc" class="btn btn-warning btn-xs"><i class="">История изменений</i></a>
                        </span> 
                </div>
            </div>
        
    </div>
</div>

<?php
    foreach($list_words as $f => $g){
?>
        <div class="col-lg-12">
            <form method="POST">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h5><?php
                            $sum = $g['ID']-5;
                            echo $g['ELEM_NAME'].' ('.$sum.')'; ?></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div hidden="" class="form-group">
                            <input name="ID_UPD" value="<?php echo $g['ID']; ?>"/>
                        </div>
                        <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $id_user;?>"/>
                        <div class="form-group">
                            <label>Казахский</label>
                            <textarea type="text" class="form-control" id="TEXT_KAZ_UPD" name="TEXT_KAZ_UPD" required=""><?php echo $g['TEXT_KAZ']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Русский</label>
                            <textarea type="text" class="form-control" id="TEXT_RU_UPD" name="TEXT_RU_UPD" required=""><?php echo $g['TEXT_RU']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>English</label>
                            <textarea type="text" class="form-control" id="TEXT_ENG_UPD" name="TEXT_ENG_UPD" required=""><?php echo $g['TEXT_ENG']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Название элемента</label>
                            <textarea type="text" class="form-control" id="ELEM_NAME_UPD" name="ELEM_NAME_UPD" required=""><?php echo $g['ELEM_NAME']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
<?php
    }
?>
<button data-toggle="modal" data-target="#add_elem" type="button" class="btn btn-primary">Новый элемент</button>

<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="add_elem" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить элемент</h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
            <form method="POST">
                    <div class="panel-body form-horizontal payment-form">
                      <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $id_user;?>"/>
                        <div class="form-group">
                            <label for="description" class="col-sm-2" style="font-size: 12px;">Казахский</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="TEXT_KAZ" name="TEXT_KAZ" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2" style="font-size: 12px;">Русский</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="TEXT_RU" name="TEXT_RU" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2" style="font-size: 12px;">English</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="TEXT_ENG" name="TEXT_ENG" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2" style="font-size: 12px;">Название элемента</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="ELEM_NAME" name="ELEM_NAME" required=""></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="save_pos" type="submit" class="btn btn-primary">Сохранить</button>
                <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                  
            </div>
            </form>
        </div>
    </div>
</div>
        <div class="ibox-content">
        <h2>Просмотр изменений</h2>
        </div>
        <hr />
<?php
    foreach($list_words as $f => $g){
        $id = $g['EMP_UPD'];
        $list_upd = $db->select("select * from sup_person where id = $id");
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
                        <hr />
                        <div class="form-group">
                            <label>Дата и время изменения:</label>
                            <input disabled="" value="<?php echo $g['DATA_UPD'].' '.$g['TIME_UPD']; ?>" />
                            
                        </div>   
                        <hr />
                        <div class="form-group">
                            <label>Автор обновления:</label>
                            <input disabled="" value="<?php echo $list_upd[0]['LASTNAME'].' '. $list_upd[0]['FIRSTNAME']; ?>" />
                            
                        </div> 
                                           
                    </div>
                </div>
            </form>
        </div>
<?php
    }
?>

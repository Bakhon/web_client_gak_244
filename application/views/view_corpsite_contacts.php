<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                            <?php echo $list_prod[0]['PRODUCT_NAME']; ?>
                        </h2>
                        <select name="search_YEAR" class="form-control" onchange="javascript:handleSelect(this)">
                            <option></option>
                            <?php
                                foreach($list_contact as $w => $q){
                            ?>
                            <option value="<?php echo $q['RFBN_ID']?>" <?php if($product_id == $q['RFBN_ID']){echo 'selected';}?>><?php echo $q['NAME']; ?></option>
                            <?php
                                }
                            ?>
                        </select>                                           
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <form method="post">
                    <div class="project-list">
                        <h4>
                            Адрес Контактов
                        </h4>
                         <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $id_user;?>"/>
                <input type="hidden" id="id_upd" name="id_upd" value="<?php echo $list_prod[0]['RFBN_ID'];?>"/>
                        <h6>Название(рус)</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="NAME_RU" class="form-control" id="ABOUT_PROD_RU"><?php echo $list_prod[0]['NAME']; ?></textarea>
                        </div>
                        <h6>Название(Каз)</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="NAME_KZ" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['NAME_KZ']; ?></textarea>
                        </div>
                        
                        <h6>Адрес(рус)</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ADDRESS" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['ADDRESS']; ?></textarea>
                        </div>
                        
                        <h6>Адрес(каз)</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ADDRESS_KZ" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['ADDRESS_KZ']; ?></textarea>
                        </div>
                        
                        <h6>Контакты</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="PHONE" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['PHONE']; ?></textarea>
                        </div>
                        
                         <h6>График работы(рус)</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="GR_JOB" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['GR_JOB']; ?></textarea>
                        </div>
                        
                         <h6>График работы(каз)</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="GR_JOB_KZ" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['GR_JOB_KZ']; ?></textarea>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-md btn-primary"> Сохранить описание </button>
                    </div>                                                            
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
    

</div>

<div class="modal inmodal fade" id="add_condition" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="float: left; left: 18%;">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Форма добавления условия</h4></div>
                <small class="font-bold"></small>
            </div>
            <form method="post">
                <div class="modal-body">
                 <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $id_user;?>"/>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст условия:</label>
                        <textarea name="ITEM_TITLE_RU" class="form-control" id="ITEM_TITLE_RU"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия:</label>
                        <textarea name="ITEM_TEXT_RU" class="form-control" id="ITEM_TEXT_RU"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст условия:</label>
                        <textarea name="ITEM_TITLE_KAZ" class="form-control" id="ITEM_TITLE_KAZ"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия:</label>
                        <textarea name="ITEM_TEXT_KAZ" class="form-control" id="ITEM_TEXT_KAZ"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст условия:</label>
                        <textarea name="ITEM_TITLE_ENG" class="form-control" id="ITEM_TITLE_ENG"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия:</label>
                        <textarea name="ITEM_TEXT_ENG" class="form-control" id="ITEM_TEXT_ENG"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                </div>
            </form>                        
        </div>        
    </div>
</div>





<script>
    function handleSelect(elm)
    {
        window.location = '?contact_id='+elm.value;
    }
</script>
              





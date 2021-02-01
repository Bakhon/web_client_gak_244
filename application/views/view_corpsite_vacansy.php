    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>
                            <?php
                                foreach($list_accord as $n=>$b){
                            ?>
                            <tr>
                                <td class="project-title">
                                    <a><?php echo $b['ITEM_NAME_RU']; ?></a>
                                    <p><?php echo $b['CONTENT_RU']; ?></p>
                                    <br/>
                                    <a><?php echo $b['ITEM_NAME_KAZ']; ?></a>
                                    <p><?php echo $b['CONTENT_KAZ']; ?></p>
                                    <br/>                                   
                                    <small></small>
                                </td>
                                <td class="project-actions">
                                    <form method="post">
                                    <input id="edit_cond" hidden="" name="edit_cond" value="<?php echo $b['ID']; ?>"/>
                                    <input hidden="" name="delete_condition" value="<?php echo $b['ID']; ?>"/>
                                    <button type="submit" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Удалить </button>
                                    <a data-toggle="modal" data-target="#edit_condition<?php echo $b['ID']; ?>" href="#" class="btn btn-white btn-sm send_id"><i class="fa fa-pencil"></i> Редактировать </a>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                        <button data-toggle="modal" data-target="#add_condition" type="submit" class="btn btn-md btn-primary" ><i class="fa fa-plus-square"></i> Добавить условие страхования</button>
                        <span class="pull-right">
                            <a target="_blank" href="site_products_arc?product_id=1" class="btn btn-warning btn-xs"><i class="">История изменений</i></a>
                        </span>
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

<?php
    foreach($list_accord as $k => $v){
?>
<div class="modal inmodal fade" id="edit_condition<?php echo $v['ID']; ?>" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="float: left; left: 18%;">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Редактировать слайд</h4></div>
                <small class="font-bold"></small>
            </div>
            <form id="form" method="post">
                <div class="modal-body">
                <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" id="emp_upd" name="emp_upd" value="<?php echo $id_user;?>"/>
                    <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">ID</label>
                        <input name="ID_UPD" placeholder="" class="form-control" id="ID_UPD" value="<?php echo $v['ID']; ?>" type="text">
                    </div>               
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TITLE_UPD_RU" class="form-control" id="ITEM_TITLE_UPD_RU"><?php echo $v['ITEM_NAME_RU']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TEXT_UPD_RU" class="form-control" id="ITEM_TEXT_UPD_RU"><?php echo $v['CONTENT_RU']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TITLE_UPD_KAZ" class="form-control" id="ITEM_TITLE_UPD_KAZ"><?php echo $v['ITEM_NAME_KAZ']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TEXT_UPD_KAZ" class="form-control" id="ITEM_TEXT_UPD_KAZ"><?php echo $v['CONTENT_KAZ']; ?></textarea>
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
<?php
    }
?>


<script>

$('.send_id').click(function(){
    
   var edit_cond = $('#edit_cond').val();
   console.log(edit_cond);
   
   
         $.post
            ('corpsite_vacansy',
                {"edit_cond": edit_cond                                                 
                },
                function(d)
                {                           
                    $('#form').html(d);
                                     
                }
            )
   
    
})

</script>
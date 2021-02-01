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
                                foreach($list_all_prod as $w => $q){
                            ?>
                            <option value="<?php echo $q['ID']?>" <?php if($product_id == $q['ID']){echo 'selected';}?>><?php echo $q['PRODUCT_NAME_RU']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <table class="table table-hover">
                            <tbody>
                            <?php
                                //echo '<pre>';
                                //print_r($list_prod_slider );
                                //echo '<pre>';
                                foreach($list_prod_slider as $n=>$b){
                            ?>
                            <tr>
                                <td class="col-sm-4">
                                    <div class="text-center">
                                        <img alt="image" class="img-responsive" src="<?php echo $b['IMG_BASE64']; ?>">
                                        <div class="m-t-xs font-bold"></div>
                                    </div>
                                </td>
                                <td class="project-title">
                                    <a><?php echo $b['SLIDE_TEXT_RU']; ?></a>
                                    <p><?php echo $b['SLIDE_SMALL_TEXT_RU']; ?></p>
                                    <br/>
                                    <a><?php echo $b['SLIDE_TEXT_KAZ']; ?></a>
                                    <p><?php echo $b['SLIDE_SMALL_TEXT_KAZ']; ?></p>
                                    <br />
                                    <a><?php echo $b['SLIDE_TEXT_ENG']; ?></a>
                                    <p><?php echo $b['SLIDE_SMALL_TEXT_ENG']; ?></p>
                                </td>
                                <td class="project-actions">
                                    <form method="post">
                                    <input hidden="" name="delete_slide" value="<?php echo $b['ID']; ?>"/>
                                    <button type="submit" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Удалить </button>
                                    <a data-toggle="modal" data-target="#edit_slide<?php echo $b['ID']; ?>" href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Редактировать </a>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                        <button data-toggle="modal" data-target="#add_slide" type="submit" class="btn btn-md btn-primary" ><i class="fa fa-plus-square"></i> Добавить слайд </button>
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
                            Описание продукта
                        </h4>
                         <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $id_user;?>"/>
                        <h6>Рус</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ABOUT_PROD_RU" class="form-control" id="ABOUT_PROD_RU"><?php echo $list_prod[0]['ABOUT_PROD_RU']; ?></textarea>
                        </div>
                        <h6>Каз</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ABOUT_PROD_KAZ" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['ABOUT_PROD_KAZ']; ?></textarea>
                        </div>
                        <h6>Англ</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ABOUT_PROD_ENG" class="form-control" id="ABOUT_PROD_ENG"><?php echo $list_prod[0]['ABOUT_PROD_ENG']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary"> Сохранить описание </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
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
                                    <a><?php echo $b['ITEM_TITLE_RU']; ?></a>
                                    <p><?php echo $b['ITEM_TEXT_RU']; ?></p>
                                    <br/>
                                    <a><?php echo $b['ITEM_TITLE_KAZ']; ?></a>
                                    <p><?php echo $b['ITEM_TEXT_KAZ']; ?></p>
                                    <br/>
                                    <a><?php echo $b['ITEM_TITLE_ENG']; ?></a>
                                    <p><?php echo $b['ITEM_TEXT_ENG']; ?></p>
                                    <br/>
                                    <small></small>
                                </td>
                                <td class="project-actions">
                                    <form method="post">
                                    <input hidden="" name="delete_condition" value="<?php echo $b['ID']; ?>"/>
                                    <button type="submit" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Удалить </button>
                                    <a data-toggle="modal" data-target="#edit_condition<?php echo $b['ID']; ?>" href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Редактировать </a>
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

<div class="modal inmodal fade" id="add_slide" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="float: left; left: 18%;">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Форма добавления слайда</h4></div>
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
                        <label class="font-noraml">Текст слайда RU:</label>
                        <textarea name="SLIDE_TEXT" class="form-control" id="SLIDE_TEXT"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст слайда RU:</label>
                        <textarea name="SLIDE_SMALL_TEXT" class="form-control" id="SLIDE_SMALL_TEXT"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст слайда КАЗ:</label>
                        <textarea name="SLIDE_TEXT_KAZ" class="form-control" id="SLIDE_TEXT_KAZ"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст слайда КАЗ:</label>
                        <textarea name="SLIDE_SMALL_TEXT_KAZ" class="form-control" id="SLIDE_SMALL_TEXT_KAZ"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст слайда ENG:</label>
                        <textarea name="SLIDE_TEXT_ENG" class="form-control" id="SLIDE_TEXT_ENG"></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст слайда ENG:</label>
                        <textarea name="SLIDE_SMALL_TEXT_ENG" class="form-control" id="SLIDE_SMALL_TEXT_ENG"></textarea>
                    </div>
                    <input id="readimg" type="file" name="imagereader" accept=".jpg,.jpeg,.png"/>
                    <textarea id="getbase64" style="display: none;"></textarea>
                    <div class="mail-body">
                        <a id="openimage" class="btn btn-primary"><i class="fa fa-paperclip"></i> Прикрепить файл</a><br />
                        <label>Разрешенные форматы:</label> .jpg, .jpeg, .png (Размер 58 х 58 px)
                    </div>
                    <div id="getimage"></div>
                    <div id="zona-drop" style="cursor: pointer; display: none;">
                        <div class="dz-default dz-message">
                            <span>
                                <strong></strong><br/>
                            </span>
                        </div>
                    </div>
                    <div id="text_areas_in_base64">
                        
                    </div>
                    
                    <input name="CREATE_MAIL" value="test" style="display: none;"/>
                    
                    <div class="clearfix"></div>
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
    foreach($list_prod_slider as $k => $v){
?>
<div class="modal inmodal fade" id="edit_slide<?php echo $v['ID']; ?>" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="float: left; left: 18%;">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Редактировать слайд</h4></div>
                <small class="font-bold"></small>
            </div>
            <form method="post">
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
                        <label class="font-noraml">Текст слайда</label>
                        <textarea style="height: 150px;" name="SLIDE_TEXT_UPD_RU" class="form-control" id="SLIDE_TEXT_UPD_RU"><?php echo $v['SLIDE_TEXT_RU']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст слайда</label>
                        <textarea style="height: 150px;" name="SLIDE_SMALL_TEXT_UPD_RU" class="form-control" id="SLIDE_SMALL_TEXT_UPD_RU"><?php echo $v['SLIDE_SMALL_TEXT_RU']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст слайда</label>
                        <textarea style="height: 150px;" name="SLIDE_TEXT_UPD_KAZ" class="form-control" id="SLIDE_TEXT_UPD_KAZ"><?php echo $v['SLIDE_TEXT_KAZ']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст слайда</label>
                        <textarea style="height: 150px;" name="SLIDE_SMALL_TEXT_UPD_KAZ" class="form-control" id="SLIDE_SMALL_TEXT_UPD_KAZ"><?php echo $v['SLIDE_SMALL_TEXT_KAZ']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст слайда</label>
                        <textarea style="height: 150px;" name="SLIDE_TEXT_UPD_ENG" class="form-control" id="SLIDE_TEXT_UPD_ENG"><?php echo $v['SLIDE_TEXT_ENG']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст слайда</label>
                        <textarea style="height: 150px;" name="SLIDE_SMALL_TEXT_UPD_ENG" class="form-control" id="SLIDE_SMALL_TEXT_UPD_ENG"><?php echo $v['SLIDE_SMALL_TEXT_ENG']; ?></textarea>
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
            <form method="post">
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
                        <textarea style="height: 150px;" name="ITEM_TITLE_UPD_RU" class="form-control" id="ITEM_TITLE_UPD_RU"><?php echo $v['ITEM_TITLE_RU']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TEXT_UPD_RU" class="form-control" id="ITEM_TEXT_UPD_RU"><?php echo $v['ITEM_TEXT_RU']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TITLE_UPD_KAZ" class="form-control" id="ITEM_TITLE_UPD_KAZ"><?php echo $v['ITEM_TITLE_KAZ']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TEXT_UPD_KAZ" class="form-control" id="ITEM_TEXT_UPD_KAZ"><?php echo $v['ITEM_TEXT_KAZ']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TITLE_UPD_ENG" class="form-control" id="ITEM_TITLE_UPD_ENG"><?php echo $v['ITEM_TITLE_ENG']; ?></textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Тонкий текст условия</label>
                        <textarea style="height: 150px;" name="ITEM_TEXT_UPD_ENG" class="form-control" id="ITEM_TEXT_UPD_ENG"><?php echo $v['ITEM_TEXT_ENG']; ?></textarea>
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
    function handleSelect(elm)
    {
        window.location = '?product_id='+elm.value;
    }
</script>
              
<script>
    function text_transofm(){
        var text_area_mail = $('#text_area_mail').val();
        var type = $('#TYPE').val();
        var state = $('#STATE').val();
        var REG_NUM = $('#REG_NUM').val();
        var HEAD_TEXT = $('#HEAD_TEXT').val();
        var SENDER = $('#SENDER').val();
        var RECIPIENT = $('#RECIPIENT').val();
        var DATE_START = $('#DATE_START').val();
        var DATE_END = $('#DATE_END').val();
        var LINK_FROM = $('#LINK_FROM').val();
        var SHORT_TEXT = $('#SHORT_TEXT').val();
        var CONTENT = $('.content').html();
        console.log(CONTENT);
        
        $.post('create_mail',   {"CREATE_MAIL": "CREATE_MAIL",
                                 "type": type,
                                 "state": state,
                                 "REG_NUM": REG_NUM,
                                 "HEAD_TEXT": HEAD_TEXT,
                                 "SENDER": SENDER,
                                 "RECIPIENT": RECIPIENT,
                                 "DATE_START": DATE_START,
                                 "DATE_END": DATE_END,
                                 "LINK_FROM": LINK_FROM,
                                 "SHORT_TEXT": SHORT_TEXT,
                                 "CONTENT": CONTENT
                                }, function(d)
        )
    }
</script>

<script>
    function delete_doc(class_name)
    {
        //console.log('classname ');
        $(".altay4").remove();
    }

    function add_doc(name, type, format)
    {
        var img = $('#getbase64').val();
        console.log(name);
        $('#text_areas_in_base64').append('<textarea hidden="" name="doc_b64" class="altay4">'+img+'</textarea>');
        var format = '';
        alert('Загружено');
    }
    
    function check_file_size(size_int, size_form)
    {
        if(size_int > 10 && size_form == 'MB')
        {
            alert('Файл '+name+'слишком большой');
            return false;
        }
    }
    
    (function() {
  
          var zonaDrop = document.getElementById('zona-drop');
          zonaDrop.addEventListener("dragover", function(e){
          e.preventDefault();
            
            zonaDrop.setAttribute("class", "over");
            
          
          }, false);
        
          zonaDrop.addEventListener("drop", function(e){
              e.preventDefault();
            var files = e.dataTransfer.files;
            var fileCount = files.length;
            var i;
            
            if(fileCount > 0) {
              for (i = 0; i < fileCount; i = i + 1) {
                var file = files[i];
                var name = file.name;
                var class_name = name.slice(0, -4);
                
                var name_split = name.split('.');
                var format = name_split[name_split.length-1];
                
                var size = bytesToSize(file.size);
                var size_int_split = size.split(' ');
                console.log(size_int_split[0]);
                console.log(size_int_split[1]);
                var checker = check_file_size(size_int_split[0], size_int_split[1]);
                if(checker == false){
                    return false;
                }
                var type = file.type;
                var reader = new FileReader();
                
                zonaDrop.removeAttribute("class");
                
                reader.onload = function(e) {
                document.getElementById("getbase64").value = e.target.result;
                var img_source = e.target.result;
                if(format != 'jpg' && format != 'png'){
                    img_source = 'styles/img/1487344174_blank.png';
                }
                zonaDrop.innerHTML+= "<div class='altay4'><img src='" + img_source + "'/></br> Название " + name +", Тип: " + type +", Размер: " + size +" <a onclick='delete_doc(altay4);'>Delete</a></div>";
                add_doc(class_name, type, format);
                };        
                reader.readAsDataURL(file);
              }
             
            }
            
          }, false);
        
        })();
        
        function simulateclick(){
            document.getElementById("readimg").click();    
        }
        
        var zonaDrop = document.getElementById('zona-drop');
        document.getElementById("readimg").style.visibility = "collapse";
        document.getElementById("readimg").style.width = "0px";
        document.getElementById("openimage").addEventListener("click", simulateclick, false);
        
        function readImage() {
            var fileToLoad = document.getElementById("readimg").files[0];
            var name = fileToLoad.name;
            var class_name = name.slice(0, -4);
            
            var name_split = name.split('.');
            var format = name_split[name_split.length-1];
            
            var size = bytesToSize(fileToLoad.size);
            var size_int_split = size.split(' ');
            var checker = check_file_size(size_int_split[0], size_int_split[1]);
            if(checker == false){
                return false;
            }
            var type = fileToLoad.type;
                                        
        	var fileReader = new FileReader();
        	fileReader.onload = function(fileLoadedEvent) {
        		var textFromFileLoaded = fileLoadedEvent.target.result;
        		var previewimage = new Image();
                // previewimage.src = textFromFileLoaded;
                document.getElementById("getimage").appendChild(previewimage) ;   
                document.getElementById("getbase64").value = textFromFileLoaded;
                img_source = 'styles/img/1487344174_blank.png';
                zonaDrop.innerHTML+="<div class='altay4'><img src='" + img_source + "'/></br> Название "+ name +", Тип: " + type +", Размер: " + size +" <a onclick='delete_doc(altay4);'>Delete</a></div>";
                add_doc(class_name, type, format);
        	};
        	fileReader.readAsDataURL(fileToLoad);
        }
        function bytesToSize(bytes) {
           var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
           if (bytes == 0) return '0 Bytes';
           var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
           return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        };
        document.getElementById("readimg").addEventListener("change", readImage, false);
</script>

<style>
    textarea {width:320px; height:100px; border: 1px solid #000;}
    #zona-drop 
    {
      min-height: 300px;
      max-width: 100%;
      padding: 15px;
      border: 4px dashed #d3d3d3;
    }
    
    #zona-drop img 
    {
      max-width: 50px;
      display: block;
      
    }
    
    .over 
    {
      border-color:#333;
      background: #ddd;
    }
    
    p {font-family: calibri}
</style>

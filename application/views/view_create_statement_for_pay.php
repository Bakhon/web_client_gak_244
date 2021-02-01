<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <?php
                require_once MODELS.'mail_menu.php';
            ?>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                
                <h2>
                    Создать документ на выплату
                </h2>
            </div>
                <div class="mail-box">
                    <div class="mail-body">
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                        <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Вид:</label>

                            <div class="col-sm-10">
                            <select class="select2_demo_1 form-control" name="KIND" id="KIND" required=""/>
                                <option></option>
                                <?php 
                                    foreach($list_kind as $k => $v){
                                ?>
                                    <option value="<?php echo $v['ID']; ?>"><?php echo $v['NAME_KIND']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Тип:</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="0" id="TYPE" name="TYPE"/>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">статус:</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="1" id="STATE" name="STATE"/>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Получатель:</label>
                            <div class="col-sm-10">
                                <select name="RECIPIENT[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4"required="">
                                    <option value="v.kaliev@gak.kz">Калиев. В. М.</option>
                                    <option value="n.sagindykova@gak.kz">Сагиндыкова Н. Е.</option>
                                    <option value="d.nurkeibekova@gak.kz">Нуркейбекова. Д. О.</option> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="RECIPIENTS">
                            
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Дата написания:</label>
                            <div class="col-sm-10">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control dateOform" name="DATE_START" data-mask="99.99.9999" id="DATE_START" value="<?php echo $today_date; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">привязан к письму:</label>

                            <div class="col-sm-10"><input type="number" class="form-control" id="LINK_FROM" name="LINK_FROM" value="0" required=""/></div>
                        </div>
                        </div>
                        
                        <div class="form-group"><label class="col-sm-2 control-label">Заголовок:</label>

                            <div class="col-sm-10"><input type="text" class="form-control" id="HEAD_TEXT" name="HEAD_TEXT" value="" required=""/></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Регистрационный номер:</label>

                            <div class="col-sm-10"><input type="number" class="form-control" value="" id="REG_NUM" name="REG_NUM" required=""/></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Отправитель:</label>

                            <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_fio; ?>" id="SENDER" name="SENDER"  required="" readonly=""/></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Отправитель email:</label>

                            <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_mail; ?>" id="SENDER_MAIL" name="SENDER_MAIL" required=""/></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Краткое содержание:</label>
                            <div class="col-sm-10"><input type="text" class="form-control" value="" id="SHORT_TEXT" name="SHORT_TEXT" required=""/></div>
                        </div>
                        <div id="text_areas_in_base64">
                        
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Дата ответа:</label>
                            <div class="col-sm-10">
                                <div class="input-group date ">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control dateOform" name="DATE_END" data-mask="99.99.9999" id="DATE_END" value="<?php echo $today_date_plus_15; ?>" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <input id="readimg" type="file" name="imagereader"  />
                    <textarea id="getbase64" style="display: none;"></textarea>
                    <div class="mail-body">
                        <a id="openimage" class="btn btn-primary"><i class="fa fa-paperclip"></i> Прикрепить файл</a>
                    </div>
                    <hr/>
                    <div id="getimage"></div>
                    <div id="zona-drop" style="cursor: pointer;">
                        <div class="dz-default dz-message">
                            <span>
                                <strong><h2>Перетащите сюда файлы для прикрепления.</h2></strong><br/>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mail-body">
                        <button type="submit" onclick=""  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Отправить"><i class="fa fa-reply"></i> Отправить</button>
                        <a onclick="delete_doc('777');" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-times"></i> Удалить</a>
                        <a class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="В черновики"><i class="fa fa-pencil"></i> В черновики</a>
                    </div>
                    
                    <input name="CREATE_MAIL" value="test" style="display: none;"/>
                    
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

<script>
    $('#zona-drop').click(
        function(){
            $('#openimage').click();
        }
    )
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
        {
            //console.log(type+state+REG_NUM+HEAD_TEXT+SENDER+RECIPIENT+DATE_START+DATE_END+LINK_FROM+SHORT_TEXT+CONTENT);
            /*$('#text_area_mail').val('');
            $('#TYPE').val('');
            $('#STATE').val('');
            $('#REG_NUM').val('');
            $('#HEAD_TEXT').val('');
            $('#SENDER').val('');
            $('#RECIPIENT').val('');
            $('#DATE_START').val('');
            $('#DATE_END').val('');
            $('#LINK_FROM').val('');
            $('#SHORT_TEXT').val('');
            $('#mail_content').html('');*/
        })
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
        $('#text_areas_in_base64').append('<textarea hidden="" name="doc_b64[]" class="altay4">'+img+'.'+format+'</textarea>');
        var format = '';
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
                var format = name.substr(-3);
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
            var format = name.substr(-3);
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
    #zona-drop {
      min-height: 300px;
      max-width: 100%;
      padding: 15px;
      border: 4px dashed #d3d3d3;
      
    }
    
    #zona-drop img {
      max-width: 50px;
      display: block;
      
    }
    
    .over {
      border-color:#333;
      background: #ddd;
      
    }
    
    p {font-family: calibri}
</style>

<?php // $list_cause_num = $list_cause_num[0]['CAUSE_NUM'] + 1 ; ?>

<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="mail-box-header">
            <h2>
                Создать заявку
            </h2>
        </div>
    
            <div class="mail-box">
                <div class="mail-body" id="mail-body">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST" id="main_form">                    
                    
                    <?php $login = $_SESSION['insurance']['login']; $list = $db->Select("select * from sup_person where email = '$login@gak.kz'");  ?>
                    
                    
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">ID AUTHOR:</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $list[0]['ID']; ?>" id="author_id" name="author_id"  required="" readonly=""/></div>
                    </div>
                     
                     
                    <div class="form-group"><label class="col-sm-2 control-label">Автор</label>
                        <div class="col-sm-10"><input type="text" class="form-control" id="PERSON" name="PERSON" value="<?php  $login = $_SESSION['insurance']['login']; $list = $db->Select("select * from sup_person where email = '$login@gak.kz'"); echo $list[0]['LASTNAME'].' '.$list[0]['FIRSTNAME'];  ?>" readonly=""/></div>
                    </div>
                    
                     <div class="form-group"><label class="col-sm-2 control-label">Номер обращения</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $list_cause_num[0]['CAUSE_NUM']; ?>" id="SENDER_MAIL" name="SENDER_MAIL" required="" readonly=""/></div>
                    </div> 
                    
                    
                    <div hidden class="form-group"><label class="col-sm-2 control-label">Дата написания:</label>
                        <div class="col-sm-10"><input readonly="" type="text" class="form-control" value="<?php echo today_date; ?>" id="DATE_START" name="DATE_START" required=""/></div>
                    </div>
                    
                    <div class="form-group"><label class="col-sm-2 control-label">Причина обращения:</label>
                        <div class="col-sm-10">
                            <select name="cause" id="cause" class="select2_demo_1 form-control" required="">
                                <option></option>
                                <?php foreach($list_cause as $k=>$v) { ?>
                                <option value="<?php echo $v['ID']; ?>"><?php echo $v['TEXT']; ?></option>                                    
                                <?php } ?>                           
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-sm-2 control-label">Заголовок:</label>
                        <div class="col-sm-10"><input type="text" class="form-control" id="HEAD_TEXT" name="HEAD_TEXT" value="" required=""/></div>
                    </div>
                    
                    <div class="form-group"><label class="col-sm-2 control-label">Краткое содержание:</label>
                        <div class="col-sm-10"><input type="text" class="form-control" id="SHORT_TEXT" name="SHORT_TEXT" value="" required=""/></div>
                    </div>
                    
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель:</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_fio; ?>" id="SENDER" name="SENDER"  required="" readonly=""/></div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель email:</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_mail; ?>" id="SENDER_MAIL" name="SENDER_MAIL" required="" readonly=""/></div>
                    </div>   
                    
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Время:</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $time; ?>" id="SENDER" name="SENDER"  required="" readonly=""/></div>
                    </div>
                    
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Дата отправления</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $today_date; ?>" id="SENDER" name="SENDER"  required="" readonly=""/></div>
                    </div>
                    
                    
                                    
                    <div id="OTHER_DOC_LINKS">
                        
                    </div>
                    <div id="text_areas_in_base64">
                    </div>

                    <div id="place_for_drafts_file">
                    </div>
                </div>
                <input id="readimg" type="file" name="imagereader" accept=".jpg,.jpeg,.tiff,.tif,.png,.pdf,.xls,.xlsx,.doc,.docx,.ppt,.pptx,.bpm,.rtf"/>
                <textarea id="getbase64" style="display: none;"></textarea>
                <div class="mail-body">
                    <a id="openimage" class="btn btn-primary"><i class="fa fa-paperclip"></i> Прикрепить файл</a><br />
                    <label>Разрешенные форматы:</label> .jpg, .jpeg, .tiff, .tif, .png, .pdf, .xls, .xlsx, .doc, .docx, .ppt, .pptx, .bpm, .rtf
                </div>
                <hr/>
                <div id="getimage"></div>
                <div id="zona-drop">
                    <!--
                    <div class="dz-default dz-message">
                        <span>
                            <strong><h2>Перетащите сюда файлы для прикрепления.</h2></strong><br/>
                        </span>
                    </div>
                    -->
                </div>
                <div class="mail-body">
                    <button type="submit" onclick="" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Отправить"><i class="fa fa-send"></i> Отправить</button>                    
                </div>

                <input name="CREATE_MAIL" value="test" style="display: none;"/>

                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>

<script>

    function remove_doc(class_name)
    {
        $("."+class_name).remove();
    }

    function add_doc(name, type, format, size_int_split)
    {
        var file = $('#getbase64').val();
        var last_simb = format.substr(format.length - 1);
        if(last_simb == 'x')
        {
            var name = name.slice(0,-1);
        }
        $('#text_areas_in_base64').append('<textarea hidden="" name="doc_b64[]" class="'+size_int_split+'">'+file+'</textarea>');
        $('#text_areas_in_base64').append('<input hidden="" class="'+size_int_split+'" name="file_name_input[]" value="'+name+'.'+format+'" class="altay4"/>');
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

    (function() 
    {
          var zonaDrop = document.getElementById('zona-drop');
          zonaDrop.addEventListener("dragover", function(e)
          {
          e.preventDefault();
            zonaDrop.setAttribute("class", "over");
          }, false);

          zonaDrop.addEventListener("drop", function(e){
              e.preventDefault();
            var files = e.dataTransfer.files;
            var fileCount = files.length;
            var i;

            if(fileCount > 0)
            {
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

                reader.onload = function(e)
                {
                document.getElementById("getbase64").value = e.target.result;
                var img_source = e.target.result;
                if(format != 'jpg' && format != 'png')
                {
                    img_source = 'styles/img/1487344174_blank.png';
                }
                zonaDrop.innerHTML+= "<div class='"+size_int_split[0]+"'><img src='" + img_source + "'/></br> Название " + name +'//'+format+", Тип: " + type +", Размер: " + size +'<a onclick="remove_doc(\''+size_int_split[0]+'\');">Delete</a></div>';
                add_doc(class_name, type, format, size_int_split[0]);
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

        function readImage()
        {
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
                zonaDrop.innerHTML+="<div class='"+size_int_split[0]+"'><img src='" + img_source + "'/></br> Название "+ name +'/' + format +", Тип: " + type +", Размер: " + size +'<a onclick="remove_doc(\''+size_int_split[0]+'\');">Delete</a></div>';
                add_doc(class_name, type, format, size_int_split[0]);
        	};
        	fileReader.readAsDataURL(fileToLoad);
        }
        function bytesToSize(bytes)
        {
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
      max-width: 100%;
      padding: 15px;
      /*border: 4px dashed #d3d3d3;
      min-height: 300px;*/
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
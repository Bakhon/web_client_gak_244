<div class="row">
    <div class="col-lg-12" id="osn-panel">        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Списочная часть</h5>     
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_document" onclick=""><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Название документа</th>                                              
                        <th>Функции</th> 
                         
                        
                    </tr>
                <?php 
                  foreach($list as $k=>$v)
                  {
                ?>
                                        <tr>
                                            <td><?php echo $v['ID']; ?></td>
                                            <td><?php echo $v['NAME']; ?></td>                                                                                                                            
                                            <td>
                                            <a class="btn btn-sm btn-primary" href="doc_on_usage?doc_id=<?php echo $v['DOC_ID']; ?>"><i class="fa fa-arrow-right"></i> Отправить на ознакомление </a>                                          
                                            </a>                                                                                                               
                                            </td>
                                        </tr>
                <?php } ?>
                </table>
            </div>                                    
        </div>
    </div>
</div>


<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="add_document" role="dialog"  aria-hidden="true">
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
                <input type="hidden" name="emp_id" value="<?php echo $id_user;?>"/>
                    
                    
                    
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Название документа</label>
                        <textarea name="NAME_RUS" class="form-control" id="NAME_RUS"></textarea>
                    </div>
                    <hr />                                     
                
                
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



<script>

$('#zona-drop').click(
        function(){
            $('#openimage').click();
        }
    )


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







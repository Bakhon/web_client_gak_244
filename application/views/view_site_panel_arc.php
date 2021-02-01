<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                            Просмотр изменений
                        </h2>                        
                        <table class="table table-hover">
                            <tbody>
                            <?php
                                foreach($list_slider as $k => $v){
                                    $id = $v['UPDATE_EMP_ID'];
                                    $list_upd = $db->select("select * from sup_person where id = $id");
                            ?>
                            <tr>
                                <td class="col-sm-4">
                                    <div class="text-center">
                                        <img alt="image" class="img-responsive" src="<?php echo $v['IMG_BASE64']; ?>">
                                        <div class="m-t-xs font-bold"><?php echo $v['BTN_TEXT']; ?>(<?php echo $v['BTN_URL_RU']; ?>)</div>
                                    </div>
                                </td>
                                <td class="project-title">
                                    <a href="project_detail.html"><?php echo $v['SLIDE_HEAD_KAZ']; ?></a>
                                    <br>
                                    <small><?php echo $v['SLIDE_TEXT_KAZ']; ?></small><br /><br />
                                    <a href="project_detail.html"><?php echo $v['SLIDE_HEAD_RU']; ?></a>
                                    <br>
                                    <small><?php echo $v['SLIDE_TEXT_RU']; ?></small><br /><br />
                                    <a href="project_detail.html"><?php echo $v['SLIDE_HEAD_ENG']; ?></a>
                                    <br>
                                    <small><?php echo $v['SLIDE_TEXT_ENG']; ?></small><br />
                                    <br>
                                    <small><?php echo $v['SLIDE_TEXT_ENG']; ?></small><br />
                                    <br>
                                    <label>Автор обновления:</label>
                                    <small><?php echo $list_upd[0]['LASTNAME'].' '. $list_upd[0]['FIRSTNAME']; ?></small><br />
                                    
                                    <label>Дата изменения:</label>
                                    <small><?php echo $v['UPDATE_DATA']; ?></small><br />
                                    
                                    <label>Время изменения:</label>
                                    <small><?php echo $v['UPDATE_TIME']; ?></small><br />
                                </td>
                                <td class="project-actions">           
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>                     
                    </div>
                </div>
            </div>
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

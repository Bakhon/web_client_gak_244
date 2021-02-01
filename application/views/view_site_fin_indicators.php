<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                            Финансовые показатели
                        </h2>        
                        <hr />            
                        <button data-toggle="modal" data-target="#add_fin" type="submit" class="btn btn-md btn-primary" ><i class="fa fa-plus-square"></i> Добавить фин показатели </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="add_fin" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="float: left; left: 18%;">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Форма добавления </h4></div>
                <small class="font-bold"></small>
            </div>
            <form enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    
                    
                   <div class="form-group" id="data_1">
                        <label class="font-noraml">Наименование</label>
                        <textarea style="height: 100px;" name="TITLE" class="form-control" id="TITLE" placeholder="Введите наименование"></textarea>
                    </div> 
                   <hr/>
                   
                   <div class="form-group" id="data_1">
                        <label class="font-noraml">Наименование(каз)</label>
                        <textarea style="height: 100px;" name="TITLE_KAZ" class="form-control" id="TITLE_KAZ" placeholder="Введите наименование(каз)"></textarea>
                    </div> 
                    <hr />
                    
                     <div hidden="" class="form-group" id="data_1">
                        <label class="font-noraml">Дата</label>
                        <input name="TODAY_DATE" class="form-control pos_btn" id="TODAY_DATE" value="<?php echo $today_date; ?>" required=""/>
                    </div>
                    
                    <div id="text_areas_in_base64">
                    </div>
                                                                                                         
                 <div class="form-group">                    
                    <label class="font-noraml">Период квартала</label>
                    <div class="input-group date ">                    
                    <span class="input-group-addon">
                     <i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control dateOform" name="date_close" data-mask="99.99.9999" id="date_close" value="" required />
                    </div>
                    <small>Если хотите добавить 1 квартал введите дату между 01.01.2019 по 31.03.2019 </small> <br />
                    <small>Если хотите добавить 2 квартал введите дату между 01.04.2019 по 31.06.2019 </small> <br />
                    <small>Если хотите добавить 3 квартал введите дату между 01.07.2019 по 30.09.2019 </small> <br />
                    <small>Если хотите добавить 4 квартал введите дату между 01.10.2019 по 31.12.2019 </small>
                </div>
                    
                                    <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" name="emp_id" value="<?php echo $id_user;?>"/>
                    
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
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                </div>
            </form>                        
        </div>        
    </div>
</div>




<!--
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div id="jstree1">
                    <ul class="my-toggle">
                    <?php
                        foreach($year as $z => $y)
                        {
                    ?>  
                    <li class="report_li">
                        <a class="view_1">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="toggle-title"><?php echo $y; ?> <?php echo $list_elems[50]["TEXT_$lang"]; ?></h3>
                            </div>
                        </div>
                    </li>
                    <?php
                          foreach($quarter as $a => $b)
                          {
                            if($b == 1) {
                            $sql_report = "select * from INSURANCE2.SITE_REPORT_LINK where REP_DATE between '01.01.$y' and '31.03.$y' order by id";
                            $list_report = $db -> Select($sql_report); }
                            if($b == 2) {
                            $sql_report = "select * from INSURANCE2.SITE_REPORT_LINK where REP_DATE between '01.04.$y' and '30.06.$y' order by id";
                            $list_report = $db -> Select($sql_report);  }
                            if($b == 3) {
                            $sql_report = "select * from INSURANCE2.SITE_REPORT_LINK where REP_DATE between '01.07.$y' and '30.09.$y' order by id";
                            $list_report = $db -> Select($sql_report);
                            }
                            if($b == 4) {
                            $sql_report = "select * from INSURANCE2.SITE_REPORT_LINK where REP_DATE between '01.10.$y' and '29.12.$y' order by id";
                            $list_report = $db -> Select($sql_report);
                            }
                            if($b == "Годовой отчет"){
                            $sql_report = "select * from INSURANCE2.SITE_REPORT_LINK where REP_DATE between '30.12.$y' and '31.12.$y' order by id";
                            $list_report = $db -> Select($sql_report);
                            }
                           //  print_r($list_report);
                    ?>                                                                                          
                    <li class="report_li">
                        <a class="view">
                            <div class="row">
                                <div class="col-sm-12">
                                 <?php if($b == "Годовой отчет") { ?>
                                      <h3 class="toggle-title"><?php echo $b; ?></h3>
                                 <?php } else{ ?>
                                    <h3 class="toggle-title"><?php echo $b; ?> <?php echo $list_elems[67]["TEXT_$lang"]; ?></h3>
                                 <?php } ?>
                                </div>
                            </div>
                        </a>
                        <div class="detail">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="toggle-wrapper">
                                        <?php
                                            foreach($list_report as $k => $v)
                                            {
                                        ?>
                                        <a href="/upload/<?php echo $v['REP_LINK']; ?>" download>
                                        <div class="reports_elem"> 
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="carga-archivo-input-title"><?php echo $v['REP_NAME']; ?></span>
                                        </div>
                                        </a>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>

-->





<script>
    $(function()
    {
      $(".view").on( "click", function()
      {
        $(this).next().slideToggle(250);
        $fexpand = $(this).find(">:first-child");
        if ($(this).hasClass('opened'))
        {
            $(this).removeClass('opened');
        }
            else
        {
            $(this).addClass('opened');
        };
      });
    });

    $(function()
    {
      $(".view_1").on( "click", function()
      {
        $(this).next().slideToggle(250);
        $fexpand = $(this).find(">:first-child");
        if ($(this).hasClass('opened'))
        {
            $(this).removeClass('opened');
        }
            else
        {
            $(this).addClass('opened');
        };
      });
    });        
</script>




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
                                }, function(d) {}
        )
    }
</script>

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

        function simulateclick()
        {
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

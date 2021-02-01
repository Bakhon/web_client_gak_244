    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <?php
                    //require_once MODELS.'mail_menu.php';
                ?>
            </div>
            <div class="col-lg-12 animated fadeInRight">
                <div class="ibox-content">
                    <div id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
                    <div class="steps clearfix">
                        <ul>
                    
                    </ul>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="pull-right tooltip-demo">
                    </div>
                    <h2>
                        Просмотр документа
                    </h2>
                    <?php  foreach($list_mail as $k => $v)
        { ?>
                    <div class="mail-tools tooltip-demo m-t-md">
                        <h3>
                            <span class="font-noraml">Заголовок: </span><?php echo $v['HEAD_TEXT']; ?>
                        </h3>
                        <h5>
                            <span class="pull-right"><strong>Дата написание письма: </strong><?php echo $v['DATE_START']; ?></span><br />
                            <span class="pull-right"><strong>Дата исполнения: </strong><?php echo $v['DATE_END']; ?></span><br />
                            <span class="font-noraml">Отправитель: </span><?php echo $v['SENDER']; ?><br />
                            <span class="font-noraml">Регистрационный номер: </span><?php echo $v['REG_NUM']; ?><br />
                            <span class="font-noraml">Номер приказа: </span><?php echo $v['ORDER_NUM']; ?><br />
                            <span class="font-noraml">Основание: </span><?php echo $list_assign[0]['COMMENT_TO_ASSIGN']; ?>
                        </h5>
                    </div>
                    <?php } ?>
                </div>
                <div class="mail-box">
                    <div class="mail-attachment">
                        <h3>
                            <span class="font-noraml">Краткое описание: </span><?php echo $v['SHORT_TEXT']; ?>
                        </h3>
                        <div class="attachment">
                                <?php if($contents) {
                                foreach($contents as $k => $c)
                                {
                                ?>
                                <div class="file-box">
                                    <div class="file">
                                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>">
                                            <span class="corner"></span>
                                            <div class="icon">
                                                <i class="fa fa-file"></i>
                                            </div>
                                            <div class="file-name">
                                                <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>" target="_blank"><?php $exp_str = explode('/', $c); echo $name_of_file = end($exp_str); ?></a>
                                                <br/>
                                                <small>Added: Jan 11, 2014</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                } }

                                foreach($contents_added as $k => $c)
                                {
                                ?>
                                <div class="file-box">
                                    <div class="file">
                                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c['NAME']; ?>">
                                            <span class="corner"></span>
                                            <div class="icon">
                                                <i class="fa fa-file"></i>
                                            </div>
                                            <div class="file-name">
                                                <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c['NAME']; ?>" target="_blank"><?php $exp_str = explode('/', $c['NAME']); echo $name_of_file = end($exp_str); ?></a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                        <hr />
                        <div class="text-right">
                            <?php
                                if(isset($_GET['REVOKE']))
                                {
                                    echo '<a data-toggle="modal" data-target="#revoke" class="btn btn-sm btn-danger"><i class="fa fa-hand-paper-o"></i> Отозвать письмо</a>&nbsp;';
                                }
                            ?>
                        </div>
                        <hr />
                        <div class="clearfix"></div>
                        <div class="mail-tools tooltip-demo m-t-md">
                           <ul class="list-group">
                                <?php
                                    //print_r($list_mail_state);
                                    foreach($list_mail_state as $s => $q)
                                    {
                                            $rec_contents = ftp_nlist($conn_id, "doc_syst/answer_docs/".$q['ID']."/");
                                            $state = $q['STATE'];
                                            switch ($state)
                                            {
                                                     case 0:
                                                     $prop = 'badge-warning';
                                                     break;
                                                     case 1:
                                                     $prop = 'badge-success';
                                                     break;
                                                     case 2:
                                                     $prop = 'badge-success';
                                                     break;
                                                     case 3:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 4:
                                                     $prop = 'badge-danger';
                                                     break;
                                                     case 5:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 6:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 7:
                                                     $prop = 'badge-success';
                                                     break;
                                                     case 8:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 9:
                                                     $prop = 'badge-primary';
                                                     break;
                                                     case 9:
                                                     $prop = 'badge-primary';
                                                     break;
                                            };
                                ?>
                                    <li class="list-group-item">
                                        <?php
                                            echo '<br />';
                                            echo '<strong>Автор:</strong> '.$q['FIO'];echo '<br />';
                                            echo '<strong>Дата:</strong> '.$q['DATE_OF_COMMENT'];echo '<br />';
                                            echo '<strong>Время:</strong> '.$q['TIME_OF_COMMENT'];echo '<br />';
                                                ?>
                                                <h3>Комментарий: </h3>
                                                <div class="well">
                                                    <?php echo $q['TEXT']; ?>
                                                    
                                                    <hr />
                                                    <?php
                                                    if($rec_contents) {
                                                        foreach($rec_contents as $v => $b)
                                                        {
                                                    ?>
                                                    <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $b; ?>" target="_blank"><i class="fa fa-file"></i> <?php $exp_rec_file = explode('/', $b); echo end($exp_rec_file); ?> скачать</a><br />
                                                    <?php
                                                        } }
                                                    ?>
                                                </div>
                                                <hr />
                                                <?php
                                        ?>
                                    </li>
                                <?php
                                    }
                                    ftp_close($conn_id);
                                ?>
                                <li class="list-group-item">
                                    <form method="POST">
                                    <h3>Комментарий: </h3>
                                    <input style="display: none;" type="text" class="form-control" id="ASSIGN_MAIL" name="ASSIGN_MAIL" value="<?php echo $emp_mail; ?>" required=""/>
                                    <input readonly="" type="text" class="form-control" id="ASSIGN_SENDER" name="ASSIGN_SENDER" value="<?php echo $emp_fio; ?>" required=""/>
                                    <br />
                                    <textarea id="COMMENT_TO_ASSIGN" class="form-control" name="COMMENT_TO_ASSIGN" required=""></textarea>
                                    <br />
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-sm btn-primary"> Оставить комментарий </button>
                                    </div>
                                    <hr />
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <form method="post">
                            <input hidden="" name="DOC_ASSIGN_STATE" value="<?php echo $doc_id; ?>"/>
                            <div class="text-right">
                                <?php
                                    if($emp_mail == 'i.akhmetov@gak.kz')
                                    {
                                ?>
                                    <button type="submit" class="btn btn-sm btn-info"> Завершить поручение </button>
                                    <a data-toggle="modal" data-target="#edit" class="btn btn-sm btn-success"> Редактировать </a>
                                    
                                    <?php
                                    }
                                    if($emp_mail == 'a.auganbaeva@gak.kz' and $list_compliance_recomendation[0]['TYPE'] == '100')
                                    {
                                ?>
                                    <button type="submit" class="btn btn-sm btn-info"> Завершить рекомендацию </button>
                                    <a data-toggle="modal" data-target="#edit" class="btn btn-sm btn-success"> Редактировать </a>
                                    
                                    
                                     <?php
                                     }
                                    if($emp_mail == 'b.abdisamat@gak.kz')
                                    {
                                ?>
                                    <button type="submit" class="btn btn-sm btn-info"> Завершить рекомендацию </button>
                                    <a data-toggle="modal" data-target="#edit" class="btn btn-sm btn-success"> Редактировать </a>
                                    
                                <?php
                                    }
                                    if($emp_mail == 'z.ussembayev@gak.kz' and $list_compliance_recomendation[0]['TYPE'] == '')
                                    {
                                ?>
                                    <button type="submit" class="btn btn-sm btn-info"> Завершить поручение </button>
                                    <a data-toggle="modal" data-target="#edit" class="btn btn-sm btn-success"> Редактировать </a>
                                <?php
                                    }
                                    if($emp_mail == 'z.saganayeva@gak.kz' and $list_compliance_recomendation[0]['TYPE'] == '')
                                    {
                                ?>
                                    <button type="submit" class="btn btn-sm btn-info"> Завершить поручение </button>
                                    <a data-toggle="modal" data-target="#edit" class="btn btn-sm btn-primary"> Редактировать </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="edit" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактировать поручение</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div hidden="" class="form-group">
                        <label class="font-noraml"></label>
                        <input name="DOC_ID" class="form-control pos_btn" id="DOC_ID" value="<?php echo $doc_id; ?>"/>
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Заголовок</label>
                        <textarea class="form-control" id="HEAD_TEXT" name="HEAD_TEXT" maxlength="999"><?php echo $v['HEAD_TEXT']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Дата написания</label>
                        <div class="input-group date ">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control dateOform" name="DATE_START" data-mask="99.99.9999" id="DATE_START" value="<?php echo $v['DATE_START']; ?>" required=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Основание</label>
                        <textarea class="form-control" id="COMMENT_TO_ASSIGN_MOD" name="COMMENT_TO_ASSIGN_MOD" maxlength="999"><?php echo $list_assign[0]['COMMENT_TO_ASSIGN']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">Дата исполнения</label>
                        <div class="input-group date ">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control dateOform" name="DATE_END" data-mask="99.99.9999" id="DATE_END" value="<?php echo $v['DATE_END']; ?>" required=""/>
                        </div>
                    </div>
                    <?php if($list_compliance_recomendation[0]['TYPE'] == '') { ?>
        
                    <div class="form-group">
                        <label class="font-noraml">Продление срока</label>
                        <textarea class="form-control" id="DATE_PROD" name="DATE_PROD" maxlength="999"><?php echo $v['DATE_PROD']; ?></textarea>
                    </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function lets_work_rec()
    {
        $('#lets_work_resolution').show();
    }

    function add_doc(name, type, format)
    {
        var img = $('#getbase64').val();
        console.log(name);
        $('#text_areas_in_base64').append('<textarea name="doc_b64[]" class="altay4">'+img+'.'+format+'</textarea>');
        var format = '';
    }

    function download_file()
    {
        $.post
        ('download_ftp', 
        {"get_file" : 'get_file'}, 
        function(d){console.log(d);}
        )
    }
    
    function delete_doc(class_name)
    {
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










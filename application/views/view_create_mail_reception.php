<div class="row">
    <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    Создать входящий документ
                </h2>
            </div>
            <div class="col-lg-12 animated fadeInRight">
                <div class="ibox-content">
                    <div id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
                        <div class="steps clearfix">
                            <ul>
                                <?php
                                    $sql_steps = "select
                                                        step.*,
                                                        DEST.NAME,
                                                        nvl((select max(id) from DOC_TRIP_STEPS where TRIP_ID = '$trip_id' and id < step.id), 0) id_prev,
                                                        nvl((select min(id) from DOC_TRIP_STEPS where TRIP_ID = '$trip_id' and id > step.id), 0) id_next
                                                     from
                                                        DOC_TRIP_STEPS step,
                                                        DIC_DOC_DESTINATION dest
                                                    where
                                                        DEST.ID = STEP.STEP_ID and
                                                        STEP.TRIP_ID = '$trip_id'
                                                    order by step.ID";
                                    $list_steps = $db -> Select($sql_steps);
                                    $class = 'current';
                                    foreach($list_steps as $z => $x)
                                    {
                                ?>
                                    <li data-toggle="modal" data-target="#delete_step" id="1" class="<?php echo $class; ?>" onclick="$('#DELETE_STEP_NUM').val('<?php echo $x['ID']; ?>');"><a style="cursor: pointer !important;"> <?php echo $x['NAME']; //echo $x['NAME'].' '.$x['ID_PREV'].' '.$x['ID'].' '.$x['ID_NEXT']; ?></a></li>
                                <?php
                                    $class = 'disabled';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mail-box">
                <div class="mail-body" id="mail-body">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                    <!--
                   <div class="form-group"><label class="col-sm-2 control-label">Маршрут</label>
                        <div class="col-sm-10">
                            <select class="select2_demo_1 form-control" name="TRIP" id="TRIP">
                                <option></option>
                                <?php
                                    foreach($list_trip as $k => $v)
                                    {
                                ?>
                                    <option value="<?php echo $v['ID']; ?>" <?php if($v['ID'] == $trip_id) {echo 'selected=""';} ?> onclick="go_to_url(<?php echo $v['ID']; ?>)"><?php echo $v['TRIP_NAME']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    -->
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Current step</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="CURRENT_STEP" name="CURRENT_STEP" value="<?php echo $list_steps[0]['ID']; ?>"/>
                        </div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Next step</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="NEXT_STEP" name="NEXT_STEP" value="<?php echo $list_steps[0]['ID_NEXT']; ?>"/>
                        </div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Prev step</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="PREV_STEP" name="PREV_STEP" value="<?php echo $list_steps[0]['ID_PREV']; ?>"/>
                        </div>
                    </div>
                   <div class="form-group"><label class="col-sm-2 control-label">Вид:</label>
                        <div class="col-sm-10">
                        <select class="select2_demo_1 form-control" name="KIND" id="KIND" required=""/>
                            <option></option>
                            <?php 
                                foreach($list_kind as $k => $v)
                                {
                            ?>
                                <option id="<?php echo $v['DEST']; ?>" value="<?php echo $v['ID']; ?>"><?php echo $v['NAME_KIND']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">От кого поступил документ</label>
                        <div class="col-sm-10">
                            <input  class="form-control" id="ORG_SENDER" name="ORG_SENDER"/>
                        </div>
                    </div>
                    
                 <div id="content"></div>
                    
                    
                    <div class="form-group"><label class="col-sm-2 control-label">Номер исходящего документа отправителя</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="SENDER_REG_NUM" name="SENDER_REG_NUM"/>
                        </div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Destination</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="DESTINATION" name="DESTINATION" value="1" required=""/>
                        </div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Тип:</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="1" id="TYPE" name="TYPE"/>
                        </div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">статус:</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="2" id="STATE" name="STATE"/>
                        </div>
                    </div>
                    <!--                        
                    <div class="form-group"><label class="col-sm-2 control-label">Согласующие:</label>
                        <div class="col-sm-10">
                            <select name="RECIPIENT_AGREEMENT[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4" accesskey="">
                                <option></option>
                                <?php
                                    foreach($list_persons as $k => $v)
                                    {
                                ?>
                                    <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO'].' - ' .$v['D_NAME'].' ('.$v['DEP_NAME'].')'; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" <?php if($trip_id == '0'){$required_state = '';}else{$required_state = 'hidden="" style="display: none;"';} //echo $required_state; ?>><label class="col-sm-2 control-label">Канцелярия:</label>
                        <div class="col-sm-10">
                            <select name="RECIPIENT_REGISTRATION[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4" accesskey="" <?php if($trip_id == '3'){$required_state = 'required=""';}else{$required_state = 'hidden="" style="display: none;"';} echo $required_state; ?>>
                                <option></option>
                                <?php
                                    foreach($list_persons as $k => $v)
                                    {
                                ?>
                                    <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO'].' - ' .$v['D_NAME'].' ('.$v['DEP_NAME'].')'; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    -->
                    <div class="form-group"><label class="col-sm-2 control-label">Резолюция:</label>
                        <div class="col-sm-10">
                            <select name="RECIPIENT_RESOLUTION[]" id="RECIPIENT_RESOLUTION" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" tabindex="4" accesskey="" <?php if($trip_id == '3'){$required_state = 'required=""';}else{$required_state = 'hidden="" style="display: none;"';} echo $required_state; ?>>
                                <option></option>   
                                <?php foreach($list_resolution as $k=>$v) { ?>
                                <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['LASTNAME'].' '.$v['FIRST'].'. '.$v['MIDDLE']; ?></option>
                                <?php } ?>                                                        
                             <!--   <option value="g.amerkhojayev@gak.kz">Амерходжаев Галым Ташмуханбетович</option>
                                <option value="a.makanova@gak.kz">Маканова Асель Куандыковна</option>
                                <option value="zh.zhumakova@gak.kz">Жумакова Жанат Бейсенбековна</option>       
                                <option value="a.akazhanov@gak.kz">Акажанов Алемжан Алтынбекович</option>
                                <option value="a.bekseitova@gak.kz" disabled="">Бексеитова Аяжан Токтаровна</option> 
                                <option value="d.kassimova@gak.kz">Касимова Диляра Маратовна</option>
                               <option value="b.abdisamat@gak.kz">TEST</option> -->
                            </select>
                        </div>
                    </div>
                    <!--
                    <div class="form-group"><label class="col-sm-2 control-label">Получатель:</label>
                        <div class="col-sm-10">
                            <select name="RECIPIENT[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4"required="">
                                <option></option>
                                <option value="i.akhmetov@gak.kz">Ахметов</option>
                                <?php
                                    foreach($list_dep as $k => $v)
                                    {
                                ?>
                                    <option value="<?php echo $v['EMAIL']; ?>" <?php if($v['EMAIL'] == ''){echo 'disabled';} ?>><?php echo $v['NAME']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    -->
                    <div class="form-group"><label class="col-sm-2 control-label">привязан к письму:</label>

                        <div class="col-sm-10"><input class="form-control" id="LINK_FROM" name="LINK_FROM" value="0"/></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Заголовок:</label>

                        <div class="col-sm-10"><input type="text" class="form-control" id="HEAD_TEXT" name="HEAD_TEXT" value="" required=""/></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Тип отправителя:</label>
                        <div class="col-sm-10">
                        <select onchange="set_user_type();" class="select2_demo_1 form-control" name="SENDER_KIND" id="SENDER_KIND" required=""/>
                            <option></option>
                            <option value="1">Физическое лицо</option>
                            <option value="2">Юридическое лицо</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Регистрационный номер:</label>
                        <div class="col-sm-10"><input <?php //if($_SESSION['insurance']['other']['mail'][0] != 'd.nurkeibekova@gak.kz'){echo 'disabled=""';} ?> class="form-control" value="<?php echo '/'.$inbox_num; ?>" id="REG_NUM" name="REG_NUM" required=""/></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Дата регистрация:</label>
                        <div class="col-sm-10">
                            <div class="input-group date ">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control dateOform" data-mask="99.99.9999"  id="DATE_START" name="DATE_START" value="<?php echo $today_date; ?>" required=""/>
                            </div>
                        </div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель:</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_fio; ?>" id="SENDER" name="SENDER"  required="" readonly=""/></div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель email:</label>
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
                                <input type="text" class="form-control dateOform" name="DATE_END" data-mask="99.99.9999" id="DATE_END" value="<?php //echo $today_date_plus_15; ?>" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <input id="readimg" type="file" name="imagereader" accept=".jpg,.jpeg,.tiff,.tif,.png,.pdf,.xls,.xlsx,.doc,.docx, .ppt,.pptx,.bpm,.rtf,.zip"/>
                <textarea id="getbase64" style="display: none;"></textarea>
                <div class="mail-body">
                    <a id="openimage" class="btn btn-primary"><i class="fa fa-paperclip"></i> Прикрепить файл</a><br />
                    <label>Разрешенные форматы:</label> .jpg, .jpeg, .tiff, .tif, .png, .pdf, .xls, .xlsx, .doc, .docx, .ppt, .pptx, .bpm, .rtf, .zip, .7z
                </div>
                <hr/>
                <div id="getimage"></div>
                <div id="zona-drop" style="cursor: pointer;">
                    <div class="dz-default dz-message">
                        <span>
                            <strong><h2><!--Перетащите сюда файлы для прикрепления.--></h2></strong><br/>
                        </span>
                    </div>
                </div>
                <div class="mail-body">
                    <button type="submit" onclick=""   class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Отправить"><i class="fa fa-reply"></i> Отправить</button>
                    <button <?php if(isset($_GET['DRAFT_DOC_ID'])){echo "disabled=''";} ?> onclick="$('#STATE').val('0');" type="submit" class="btn btn-sm btn-success" title="Сохранить"><i class="fa fa-save"></i> Сохранить</button>
                </div>
                <input name="CREATE_MAIL" value="test" style="display: none;"/>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>



<script>
    
   

    $('#TRIP').change(function(){
        var id = $(this).val();
        go_to_url(id);
    })
    
    function go_to_url(id)
    {
        var sim_url = window.location.pathname;
        location.href = 'http://192.168.5.244'+sim_url+'?trip_id='+id;
    }
    
    $("#KIND").change(function() 
    {
      var id = $(this).children(":selected").attr("id");
      $('#DESTINATION').val(id);
    });
    
    $('#zona-drop').click(
        function(){
            $('#openimage').click();
        }
    )
    
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
        })
    }

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
        if(size_int > 20 && size_form == 'MB')
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

        function set_user_type()
        {
            var SENDER_KIND = $('#SENDER_KIND').val();
            var append_val = '/фл';
            if(SENDER_KIND == '2')
            {
                append_val = '/юл';
             //   $('#content').append('<div id="content" class="form-group"><label class="col-sm-2 control-label">ФИО подписанта</label><div class="col-sm-10"><input onclick="set_signer();" placeholder="поле в разработке, ничего не вводите" class="form-control disable" id="SURNAME_SIGNER" name="SURNAME_SIGNER"/></div></div>');
            }
            var current_val = $('#REG_NUM').val();
             console.log(current_val);
            var last_simb_3 = current_val.substr(-3);
            console.log(last_simb_3);
            if(last_simb_3 == '/юл' || last_simb_3 == '/фл')
            {
                current_val = current_val.slice(0, -3);   
                console.log(current_val);            
            }
            $('#REG_NUM').val(current_val+append_val);
        }
</script>

<style>
    textarea {width:320px; height:100px; border: 1px solid #000;}
    #zona-drop {
    /*
      min-height: 300px;
      max-width: 100%;
      padding: 15px;
      border: 4px dashed #d3d3d3;
    */
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

<script>
    function set_data()
    {
        $.post
        ('mail_detail_draft',
           {
               "GET_DOCUMENT_DATA": "<?php echo $_GET['DRAFT_DOC_ID']; ?>"
           },
               function(d)
           {
               var obj = jQuery.parseJSON(d);
               console.log(obj);
               
               for ( var i = 0, l = obj.length; i < l; i++ ) 
               {
                    console.log(obj[i].RECIEP_MAIL);
                    console.log(obj[i].TABLE_NAME);
                    $('#'+obj[i].TABLE_NAME+' option[value="'+obj[i].RECIEP_MAIL+'"]').attr('selected','selected');
                    $('#'+obj[i].TABLE_NAME).trigger("chosen:updated");
               }
               var ID = obj[0].ID;
               var TYPE = obj[0].TYPE;
               var STATE = obj[0].STATE;
               var REG_NUM = obj[0].REG_NUM;
               var HEAD_TEXT = obj[0].HEAD_TEXT;
               var SENDER = obj[0].SENDER;
               var DATE_START = obj[0].DATE_START;
               var DATE_END = obj[0].DATE_END;
               var LINK_FROM = obj[0].LINK_FROM;
               var SHORT_TEXT = obj[0].SHORT_TEXT;
               var KIND = obj[0].KIND;
               var SENDER_MAIL = obj[0].SENDER_MAIL;
               var DOC_LINK = obj[0].DOC_LINK;
               var CURRENT_STEP_ID = obj[0].CURRENT_STEP_ID;
               var NEXT_STEP_ID = obj[0].NEXT_STEP_ID;
               var PREV_STEP_ID = obj[0].PREV_STEP_ID;
               var ORDER_NUM = obj[0].ORDER_NUM;
               var ORG_SENDER = obj[0].ORG_SENDER;
               var SENDER_REG_NUM = obj[0].SENDER_REG_NUM;
               var SENDER_KIND = obj[0].SENDER_KIND;
               var ADDRESS = obj[0].ADDRESS;
               var TRIP = obj[0].TRIP;

               change_val('DATE_START', DATE_START);
               change_val('DATE_END', DATE_END);
               change_val('SENDER', SENDER);
               change_val('REG_NUM', REG_NUM);
               change_val('HEAD_TEXT', HEAD_TEXT);
               change_val('LINK_FROM', ID);
               change_val('SHORT_TEXT', SHORT_TEXT);
               change_val('KIND', KIND);
               change_val('SENDER_MAIL', SENDER_MAIL);
               change_val('CURRENT_STEP_ID', CURRENT_STEP_ID);
               change_val('NEXT_STEP_ID', NEXT_STEP_ID);
               change_val('PREV_STEP_ID', PREV_STEP_ID);
               change_val('ORDER_NUM', ORDER_NUM);
               change_val('ORG_SENDER', ORG_SENDER);
               change_val('SENDER_REG_NUM', SENDER_REG_NUM);
               change_val('SENDER_KIND', SENDER_KIND);
               change_val('ADDRESS', ADDRESS);
               $('#TRIP option[value="'+TRIP+'"]').attr('selected','selected');
               if(TRIP == '14')
               {
                    $('#RECIPIENT_AGREEMENT').prop('required',false);
                    $('#RECIPIENT_AGREEMENT').prop('disabled', true);
               }
           }
        )

        $.post
        ('mail_detail_draft',
           {
               "GET_DOCUMENT_FILE": "<?php echo $_GET['DRAFT_DOC_ID']; ?>"
           },
               function(d)
           {
               $('#mail-body').append(d);
           }
        )
    }

    function change_val(name, data)
    {
        $('#'+name).val(data);
    }
    
    
    
</script>


<script>

$(document).ready(function(){
        $('button[type=submit]').on("click", function(){
            setTimeout(function () {
                $('button[type=submit]').prop('disabled', true);
                }, 0);
            setTimeout(function () {
                $('button[type=submit]').prop('disabled', false);
                }, 5000);
        });
});

</script>


<?php
    if(isset($_GET['DRAFT_DOC_ID']))
    {
        $draft_doc_id = $_GET['DRAFT_DOC_ID'];
        echo "<script>set_data();</script>";
    }
?>
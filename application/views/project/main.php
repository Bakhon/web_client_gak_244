<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Список проектов</h5>
            <button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#modal_new_project" data="0" id="create_project"><i class="fa fa-plus"></i> Создать проект</button>
        </div>
        <div class="ibox-content inspinia-timeline">
            <?php 
                foreach($project->result['projects'] as $k=>$v){
            ?>
                
            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-3 date">
                        <?php 
                            if($v['ID_TYPE'] == '1') {
                                echo '<i class="fa fa-line-chart"></i><br /><small class="text-navy">Тестирование '.$v['TIME_RESULT'].' мин</small>';
                            }else{
                                echo '<i class="fa fa-question-circle"></i><br /><small class="text-navy">Опросник</small>';
                            }
                        ?>
                        <!--<br />
                        <a href="#" class="btn btn-info btn-xs edit_project" data="<?php echo $v['ID']; ?>"><i class="fa fa-pencil-square-o"></i></a>-->
                    </div>                    
                    <div class="col-lg-7 content no-top-border view_quest" data-type="<?php echo $v['ID_TYPE']; ?>" data="<?php echo $v['ID']; ?>" style="cursor: pointer;" id="list_projects">
                        <p class="m-b-xs">
                            <strong><?php echo $v['NAME']; ?></strong>
                        </p>
                        <p>Кол-во вопросов: <?php  echo count($v['list_quest']); ?></p>
                        <p class="m-b-xs"><strong><?php echo $v['DATE_CLOSE'];?></strong></p>                        
                    </div>
                    
                </div>
            </div>
            <?php } ?>
        </div>        
    </div>
</div>

<div class="col-lg-9">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Список вопросов</h5>
            <button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#modal_new_quest" id="add_quest"><i class="fa fa-plus"></i> Добавить вопрос</button>
        </div>
        
                 
            <div class="panel-group" >                              
                    <div class="ibox-title" id="list_quest">                     
                                                              
                    </div>                                                         
            </div>                           
    </div>
</div>

<div class="modal inmodal in" id="modal_new_project" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>                
                <h4 class="modal-title">Новый проект</h4>                
            </div>            
            
            <form method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-noraml">Название проекта</label>
                    <input name="name_project" type="text" placeholder="" class="form-control" id="test_name" required>
                </div>
                <div class="form-group">
                    <label class="font-noraml">Автор теста</label>
                    <input type="text" placeholder="" class="form-control" value="<?php echo $_SESSION[USER_SESSION]['fio']; ?>"  readonly/>
                </div>
                <?php            
                 $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
                 $q = $db->Select("select * from sup_person where email = '$em'");
                        
                  $id_user = $db->id_user = $q[0]['ID']; ?>
                <input type="hidden" name="emp_id" value="<?php echo $id_user;?>"/>
                                                                                    
                <div class="form-group">
                    <label class="font-noraml">Тип теста</label>
                                                                
                    <select name="id_type" class="select2_demo_1 form-control" id="id_type" required>
                        <option value=""></option>
                        <?php 
                            foreach($project->result['type_projects'] as $y => $u) {
                                echo '<option value="'.$u['ID'].'">'.$u['NAME'].'</option>';
                            } 
                        ?>                                    
                    </select>
                </div>
                            
                <div class="form-group" id="time_test" style="display: none;">
                    <label class="font-noraml">Время для выполнения теста (минут)</label>
                    <input name="time_result" type="number" placeholder="" value="0" class="form-control" id="time_result" required>
                </div>
                                                                        
                 <div class="form-group">
                    <label class="font-noraml">Статус теста</label>
                    <select name="state" class="select2_demo_1 form-control" id="state" required>
                        <option value=""></option>
                        <option value="2" selected >Активен</option>
                        <option value="1">Не активен</option>
                    </select>
                </div>
                                                                                                                                                                                 

                <div class="form-group">
                    
                    <label class="font-noraml">Дата закрытия теста</label>
                    <div class="input-group date ">                    
                    <span class="input-group-addon">
                     <i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control dateOform" name="date_close" data-mask="99.99.9999" id="date_close" value="" required />
                    </div>
                </div>
             
            </div>                                
            <div class="modal-footer">       
                <input type="hidden" name="id_project" value="0"/>         
                <button type="submit" class="btn btn-primary" name="save_project">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal in" id="modal_new_quest" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>                
                <h4 class="modal-title">Новый вопрос по проекту <span id="new_quest_title"></span> </h4>
            </div>            
            
            <form method="post">                
                <div class="modal-body" id="new_quest_lists">                    
                    <div class="form-group">
                        <label class="font-noraml">Введите свой вопрос</label>
                        <input name="quest_name" type="text" placeholder="" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-noraml">Тип вопроса</label>
                                                
                        <div class="input-group">                            
                            <select class="form-control" name="quest_rasp" id="quest_rasp">
                                <option value="0" selected>-- Не выбран</option>
                                <?php 
                                    foreach($project->result['rasp'] as $k=>$v){
                                        echo '<option value="'.$v['ID'].'">'.$v['NAME_RASP'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_type_quest" title="Создать тип вопроса"><i class="fa fa-plus"></i></button> 
                            </span>
                        </div>                        
                    </div>
                                                            
                    <div id="new_add_quest_div">
                    
                    </div>
                </div>                                
                <div class="modal-footer">       
                    <input type="hidden" name="id_quest" id="id_quest" value="0"/>
                    <input type="hidden" name="id_t" id="id_t" value="0"/>
                    <input type="hidden" name="correct_opt" id="correct_opt"/>
                    <span class="btn btn-info pull-left" id="add_new_quest_result">Добавить ответ</span>
                    <button type="submit" class="btn btn-primary" name="save_quest">Сохранить</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal in" id="modal_new_type_quest" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>                
                <h5 class="modal-title"> </h5>                
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-noraml">Наименование</label>
                    <input name="type_quest" id="type_quest_name" type="text" value="" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_type_quest">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal" id="close_modal_new_type_quest">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal in" id="edit_slide" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title">Редактирование вопроса</h5>
            </div>
            <form method="post" id="edit_div_quest" name="update_q_a">
                <div hidden="" class="form-group" id="data_1">
                    <label class="font-noraml">ID</label>
                    <input name="ID_UPD" placeholder="" class="form-control" id="ID_UPD" value="" type="text">
                </div>
                <div class="modal-body">
                   <div id="QUESTION_UPD">
                                                         
                   </div>  
                   
                   <div id="ANSWER_UPD">
                   
                   </div>                                    
                </div>
                <div class="modal-footer" id="submit_div">
                    <input type="hidden" name="id_proverka" id="id_proverka" value="0" />
                    <button type="submit" name="update" class="btn btn-primary">Сохранить</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal" id="close_modal_new_type_quest">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#list_projects').click(function() {        
    //    alert('Выбран проект');
    });
    //var all_dan = '<?php echo json_encode($project->result); ?>';
    var projects = <?php echo json_encode($project->result['projects']); ?>;
    var seq_qst = 0;
    
   // console.log(projects);
    
    $('#id_type').change(function(){
        var id = $(this).val();
        if(id == '1'){
            $('#time_test').css('display', 'block');            
        }else{
            $('#time_test').css('display', 'none');
        }
        $('#time_result').val('0');
    });
        
    $('.view_quest').click(function(){
        var id = $(this).attr('data'); 
        $('#add_quest').attr('data', '0');
        var j = projects;// JSON.parse(projects);        
        $('#list_quest').html('');
        $('#list_quest').attr('data', id);
        
        for(var i=0;i<j.length;i++){
            var d = j[i];  
            console.log(d.id);          
            if(d.ID == id){
                $('#add_quest').attr('data', id);
                $('#add_quest').attr('data-type', d.ID_TYPE);                
                $('#new_quest_title').html(d.NAME);
                
                $('#id_quest').val(id);                
                if(d.list_quest.length <= 0){
                    $('#list_quest').html("<center><h2>По проекту <b>&laquo;"+d.NAME+"&raquo;</b> нет ни одного вопроса</h2></center>");
                }else{
                    for(e=0;e<d.list_quest.length;e++){
                        var dan = d.list_quest[e];
                        console.log(dan);
                        $('#list_quest').append('<h3 class = "ibox-title">'+'<b>'+dan.QUESTION+'</b>'+'</h3>');
                        if(dan.RASP !== ''){   
                            $('#list_quest').append('');                        
                        }
                        $('#list_quest').append('<ul>');
                                                                      
                        for(v=0;v<dan.list_variants.length;v++){   
                      //      if(dan.list_variants[v].CORRECT_ANSWER == 1) {
                            $('#list_quest').append('<li>'+
                            '<input type="radio" id="'+dan.list_variants[v].ID+'" name="'+dan.list_variants[v].ID_QUESTION+'" value="'+dan.list_variants[v].ID+'">'+
                            '<label>'+'<i>'+dan.list_variants[v].ANSWER+'</i>'+'</label></li>');
                       //     }
                        }  
                        $('#list_quest').append('</ul>'); 
                        $('#list_quest').append('<a data-toggle="modal"   data-target=""  data-project="'+d.ID+'" data="'+dan.ID+'" href="#" class="btn btn-primary btn-xs edit_slide"><i class="fa fa-pencil"></i> Редактировать </a>'+'<form method="post" name="delete_question"><input type="hidden" name="ID_UPD_del" placeholder="" class="form-control" id="ID_UPD_del" value="'+dan.ID+'"/> <button type="submit" id="#delete_quest" name="delete_question" data-target="#delete_quest" class="btn btn-white btn-sm delete_slide"><i class="fa fa-pencil"></i> Удалить </button></form>');                                                
                        // #data-target="#edit_slide" 
                    //    console.log(d.list_quest[e]);                                                                      
                    }                                        
                }
            }                    
        }       
    }); 
                                  
    $('#add_quest').click(function(e){
        var id = $(this).attr('data');
        var id_type = $(this).attr('data-type');
        
        var b = true;
        if(id == undefined){b = false;}
        if(id == '0'){b = false;}
        if(b == false){
            e.preventDefault();
            alert('Вы не выбрали проект!');
            return false;            
        }
        $('#new_add_quest_div').html('');
        for(var i=0;i<2;i++){
            var text = setqst(i, id_type, false)                  
            $('#new_add_quest_div').append(text);
        }
        seq_qst = 1;
    });
        
    $('#save_type_quest').click(function(){
       var name = $('#type_quest_name').val();
       if(name.trim() == ''){
            alert('Наименование не может быть пустым!!!');
            return false;
       } 
       
       $.post(window.location.href, {"new_type_quest":name}, function(data){
          var j = JSON.parse(data);
          var s = j.rasp;          
          $('#quest_rasp').html('<option value="0" selected>-- Не выбран</option>');          
          for(var i=0;i<s.length;i++){
                $('#quest_rasp').append('<option value="'+s[i].ID+'" selected>'+s[i].NAME_RASP+'</option>');                
          }          
          $('#close_modal_new_type_quest').click();
       });
    });
    
    $('#add_new_quest_result').click(function(){
        var id_type = $('#add_quest').attr('data-type');
        seq_qst++;
        var text = setqst(seq_qst, id_type, true)
        $('#new_add_quest_div').append(text);
    });
    
    $('body').on('click', '.del_qst', function(){
       var id = $(this).attr('data');
       console.log(id); 
       $('#'+id).remove();
    });
    
    $('body').on('click', '.edit_slide', function(){         
        var id_project = $(this).attr('data-project');
        var id = $(this).attr('data');        
        console.log(id_project+' '+id); 
         $('#edit_div_quest').html('');
          var j = JSON.parse(projects);  
        for(var i=0;i<j.length;i++){         
            a = j[i];                   
            if(a.ID == id_project){                 
                $('#QUESTION_UPD').val(projects[i].NAME);                   
                  for(var k=0;k<a.list_quest.length;k++)
                  {      
                    
                     var lan = a.list_quest[k]; 
                       if(lan.ID == id) {                                
                            $('#edit_div_quest').append('<div class="modal-body"><div class="form-group"><label class="font-noraml">Изменить вопрос</label><p><input name="QUESTION_UPD" id="QUESTION_UPD" type="text" value="'+lan.QUESTION+'" class="form-control"  required></p></div></div>')
                            $('#edit_div_quest').append('<div class="modal-body"><div class="form-group"><label class="font-noraml">Изменить варианты ответов</label></div></div>');
                      for(var e=0; e<lan.list_variants.length;e++)
                      {                        
                        if(lan.list_variants[e].ID_QUESTION == id)
                        {                            
                            $('#edit_div_quest').append('<div class="modal-body"><div class="form-group"'+'<ul>'+'<li><input type="hidden" name="ID_UPD" placeholder="" class="form-control" id="ID_UPD" value="'+lan.ID+'"/><input name="OTV_ID[]" type="hidden" value="'+lan.list_variants[e].ID+'"/> <input name="ANSWER_UPD[]" class="form-control" value="'+lan.list_variants[e].ANSWER+'" type="text"></li></ul></div></div>');
                                                                              
                        }
                      }
                      $('#edit_div_quest').append('<div class="modal-footer" id="submit_div">'+'<input type="hidden" name="id_proverka" id="id_proverka" value="0" />'+'<button type="submit" name="update" class="btn btn-primary">Сохранить</button>'+'<button type="button" class="btn btn-white" data-dismiss="modal" id="close_modal_new_type_quest">Закрыть</button>'+'</div>');                                                            
                  }                                                                                                                                                                                                                                                                                                                                                                                    
            }        
        
        }       
    }      
   });
         
    function cha_q_text(q_id)
    {
        $.post
        ('',
            {
                "q_id": q_id
            },
                function(d)
            {
                $('#place_for_edit_ques').html(d);
            }
        )
    }
    
    var id = '1';
    function setqst(i, t, d)
    {
        var new_quest_t = '<div class="input-group">'+
                            '<span class="input-group-addon"><input required="" type="radio" name="q_pr[]" id="q_id'+id+'" value="%" onclick="set_correct_opt('+id+')"></span>'+
                            '<input name="res_quest[%]" id="q_id_txt'+id+'" type="text" value="" class="form-control" required></div>';
                                
        var new_quest_o = '<input name="res_quest[%]" type="text" value="" class="form-control" required>';
        
        var txt = new_quest_t;        
        if(t == 2){txt = new_quest_o;}        
                
        if(d == true){
            txt = '<div class="input-group">'+txt+'<span class="input-group-btn">'+
            '<a href="#" class="btn btn-danger del_qst" data="q%"><i class="fa fa-trash"></i></a>'+
            '</span></div>';
        }        
        var text = '<div class="form-group" id="q%"><label class="font-noraml">Введите ответ</label>'+txt+'</div>';
        text = text.replace(/%/gi, i);
        id++;
        return text;
    }

    function set_correct_opt(opt_id)
    {
        var correct_opt_text = $('#q_id_txt'+opt_id).val();
        $('#correct_opt').val(correct_opt_text);
        
    }

    function panels(title, qsts)
    {
        var txt = '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title">'+title+'</h4></div>'+
        '<div class="panel-body"><ul class="list-unstyled">';
        for(var i=0;i<qst.length;i++){
            txt += '<li>'+qst[i].ANSWER+'</li>';
        }
        
        txt += '</ul></div></div>';
     }     
</script>












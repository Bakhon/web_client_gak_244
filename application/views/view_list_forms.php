<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Формы</h5>     
                <div class="ibox-tools">
                    <a href="list_forms" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="list-group table-of-contents" style="max-height: 560px;overflow: auto;">
                <?php
                    $qs = $class->forms();
                    foreach($qs as $k=>$v){
                        $s = '';
                        if($dan['ID'] == $v['ID']){
                            $s = 'active';
                        }
                        echo '<a href="list_forms?form_id='.$v['ID'].'" class="list-group-item '.$s.'">'.$v['NAME_FORM'].' ('.$v['NAME_URL'].')</a>';   
                    }
                ?>                
                </div>                              
            </div>
        </div>                
    </div>
    
    
    <div class="col-lg-9" id="osn-panel">        
        <div class="ibox float-e-margins">            
            <div class="ibox-content">
                <div class="panel-body" id="view_option">
                    <?php echo $class->message; ?>
                    <!--------------------------------------------------->                    
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Форма</a></li>
                            <?php if($dan['ID'] !== 0){ ?>
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Меню</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">Действия</a></li>                            
                            <?php } ?>
                        </ul>
                    
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">    
                                    <form class="form-horizontal edit_naimen" method="post">
                                        <legend>Форма</legend>                    
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Наименование</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" name="name" value="<?php echo $dan['NAME_FORM']; ?>">
                                                <span class="help-block">Данный текст ни где не фигурирует</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Ссылка URL</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" name="url" value="<?php echo $dan['NAME_URL']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label"></label>
                                            <div class="col-lg-10">
                                                <input type="submit" class="btn btn-success btn-sm" value="Сохранить">
                                            </div>
                                        </div>
                                        <input type="hidden" name="save_form_naimen" value="<?php echo $dan['ID']; ?>"/>
                                    </form>
                                </div>
                                                                
                            </div>
<?php if($dan['ID'] !== 0){ ?>                            
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <form method="post" class="form-horizontal edit_menu">
                                        <legend>Меню</legend>
                                        <label>Главное дерево</label>
                                        <div class="input-group">
                                            <select class="form-control" name="list_main_menu">
                                                <option value="">-- Не выбрано</option>        
                                                <?php                                   
                                                    foreach($dan['main_menu_list'] as $k=>$v){
                                                        $s = '';                                    
                                                        if($dan['main_menu']['ID'] == $v['ID']){
                                                            $s = 'selected';                                        
                                                        }
                                                        echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <span class="input-group-addon btn btn-success add_menu_main" data-toggle="modal" data-target="#main_menu"><i class="fa fa-plus"></i> Создать</span>        
                                        </div>
                                        
                                        <label>Дочерное дерево</label>                                      
                                        <input type="hidden" name="id" value="<?php if(isset($dan['child_menu']['ID'])){ echo $dan['child_menu']['ID'];}else echo '0'; ?>"/>
                                        <input type="hidden" name="id_form" value="<?php echo $dan['ID']; ?>"/>         
                                        <input type="text" class="form-control" name="child_menu" value="<?php echo $dan['child_menu']['NAME']; ?>"/>
                                        <br />                                        
                                        <input type="submit" class="btn btn-info" value="Закрепить">
                                        <a class="btn btn-danger pull-right clear_menu" id="<?php echo $dan['ID']; ?>"><i class="fa fa-trash"></i> Убрать</a>
                                    </form>
                                </div>
                            </div>
                        
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <legend>
                                        <a class="btn btn-info btn-sm btn-circle" data-toggle="modal" data-target="#edit_method" style="margin-right: 15px;">
                                            <i class="fa fa-code"></i>
                                        </a>Действия
                                    </legend>
                                    <table class="table table-border">
                                    <?php 
                                    foreach($dan['methods'] as $k=>$v){
                                        $l = '';
                                        $b = '<button class="btn btn-danger pull-right btn-sm del_method" id="'.$v['ID'].'"><i class="fa fa-trash"></i></button>';
                                        if($v['STATE'] == '1'){
                                            $l = ' class="danger todo-completed"';
                                            $b = '';
                                        }
                                        echo '<tr '.$l.'>
                                            <td>'.$v['ID'].'</td>
                                            <td>'.$v['METHOD_NAME'].'</td>
                                            <td>'.$v['METHOD_ACTION'].'</td>
                                            <td>'.$b.'</td>
                                        </tr>';
                                    }
                                    ?>
                                    </table>
                                </div>
                            </div>
                            
                            
                            <div id="tab-4" class="tab-pane">
                                <div class="panel-body">  
                                                                      
                                    
                                        <form id="CodeForm" name="CodeForm" method="post" action="./index.php/main/CodeExecute">
<!--                                            <textarea autocomplete="off" wrap="logical" spellcheck="false" class="textarea-code" id="code" name="code">
<?php 
    /*
    $filename = 'application/views/view_'.$dan['NAME_URL'].'.php';    
    $r=fopen($filename,'r'); // 2
    $text=fread($r,filesize($filename)); // 3
    echo $text;
    fclose($r);
    */    
?>                                            
                                            </textarea>
-->                                            
                                        </form>
                                    
                                        
                                </div>
                            </div>
                            
<?php } ?>                            
                        </div>
                    </div>
                    
                    <!------------------------>
                    <div class="modal inmodal fade" id="main_menu" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="padding: 10px;">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title title_main_menu">Редактор меню</h4>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="0"/>
                                        <input type="hidden" name="id_num" value="0"/>
                                        <input type="hidden" name="id_form" value="<?php echo $dan['ID']; ?>"/>
                                        <input type="text" name="edit_main_menu" class="form-control" placeholder="Наименование" value=""/>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Сохранит"/>                                    
                                        <button class="btn btn-white closed" data-dismiss="modal">Закрыть</button>                
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="modal inmodal fade" id="edit_method" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Список методов</h4>
                                    <small class="font-bold">Выделите нужные методы для добавления в форму</small>
                                </div>
                                <form method="post">
                                <div class="modal-body">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label>Название действия</label>
                                            <input type="text" class="form-control" name="method_name" value=""/>
                                            <label>Вызываемый параметр</label>
                                            <input type="text" class="form-control" name="method_action" value=""/>
                                        </div>
                                    </div>                                              
                                </div>
                                <div class="modal-footer">                                    
                                    <input type="hidden" name="id_form" value="<?php echo $dan['ID']; ?>">                                 
                                    <input type="submit" name="save_method" class="btn btn-primary" value="Сохранить">                
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
                                </div>
                                </form>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                    <!----------------------------->
                    
                </div>    
            </div>
        </div>               
    </div>
</div>
<!--
<link href="styles/css/others/codemirror.css" rel="stylesheet">
<script src="styles/js/others/codemirror-compressed.js"></script>
-->

<script>    
    $('body').on('click', '.add_menu_main', function(){
        $('#id_menu').val('0');
        $('#id_num_menu').val('0'); 
        $('#name_menu').val('');
        $('.title_main_menu').html('Добавить главное меню')
    });
    
    $('.del_method').click(function(){
        var id = $(this).attr('id');
        $.post(window.location.href, {"close_method":id}, function(data){
            if(data.trim() == ''){
                location.reload();
            }else{
                $('#view_option').append(data);
            }
        });
    });
    
    $('.clear_menu').click(function(){
        var id = $(this).attr('id');
        $.post(window.location.href, {"clear_menu": id}, function(data){
            if(data.trim() == ''){
                location.reload();
            }else{
                $('#view_option').append(data);
            }
        });
    })        
 
    function FourPow(a)
        {
            var b = a, i = 1;
            while (i<4){ b *= a; i++; }
            return b;
        }
        
    function Summ()
        {
            var a=1.5, S=1.5, n=1;
            
            while (a > 0.001)
            { a = 3*n/(n*CubPow(n)-1*n*n)+2;
            S += a;
            }
            
            console.log("Sum = ",S);
        }

var s = 0;
$('.list-group-item').each(function(){    
	var scr = parseInt($(this).height());
    //scr = scr.replace('px', '');
	if($(this).attr('class') == 'list-group-item active'){
	   $('.table-of-contents').animate({
	       scrollTop: $(this).offset().top - 300
	   }, 'fast');
		scr = 0;		        		
    }	
	s += scr;            
});

//$('.table-of-contents').scrollTo('ul li .active');
</script>





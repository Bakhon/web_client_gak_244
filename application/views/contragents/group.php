<div class="ibox float-e-margins">
    <div class="ibox-title">        
        <span class="btn btn-sm btn-primary" id="add" data-toggle="modal" data-target="#edit_group"><i class="fa fa-plus"></i></span>        
        <span class="btn btn-sm btn-success disabled" id="edit" data-toggle="modal" data-target="#edit_group"><i class="fa fa-edit"></i></span>                                             
    </div>
    <div class="ibox-content">
        <table class="table table-bordered dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Имя группы</th>
                    <th>Наименование</th>                    
                </tr>
            </thead>
            <tbody>
            <?php
	           foreach($groups as $k=>$v){
	               echo '<tr class="gradeX" data="'.$v['ID_GROUP'].'">
                    <td>'.$v['ID_GROUP'].'</td>
                    <td class="group_name">'.$v['GROUP_NAME'].'</td>
                    <td class="name">'.$v['NAME'].'</td>
                   </tr>';
	           }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php

$HTML = <<<FORM
<form method="post" class="edit_group">
    <div class="form-group">
        <label class="font-noraml">Имя группы</label>
        <input type="text" name="contr_agent_group_name" placeholder="" class="form-control group_name">
    </div>     
    
    <div class="form-group">
        <label class="font-noraml">Наименование</label>
        <input type="text" name="contr_agent_naimen" placeholder="" class="form-control naimen">
    </div>
    
    <input type="hidden" name="contr_agent_id" value="0"/>
</form>    
FORM;
	
    echo FORMS::ModalContainer('edit_group', 'Редактор групп', 'Редактирование групп Справочника контрагентов', $HTML, 'SaveGroup();');
?>

<script>
function SaveGroup(){$('.edit_group').submit();}

$('.gradeX').click(function(){
    var tr = $(this);
    $('.gradeX').attr('class', 'gradeX');
    tr.attr('class', 'gradeX active');
    var s = tr.attr('data');
    $('#edit').removeClass('disabled');                    
});

$('#add').click(function(){
   $('input[name=contr_agent_id]').val('0');
   $('input[name=contr_agent_group_name]').val('');
   $('input[name=contr_agent_naimen]').val(''); 
});

$('#edit').click(function(){
   var id = $('.active').attr('data');
   var group_name = $('.active').children('.group_name').html();
   var name = $('.active').children('.name').html();
   
   $('input[name=contr_agent_id]').val(id);
   $('input[name=contr_agent_group_name]').val(group_name);
   $('input[name=contr_agent_naimen]').val(name);   
});
</script>


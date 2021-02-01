<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Список форм</h5>
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addForm" onclick="Edit(0, '', '');"><i class="fa fa-plus"></i></a>
                </div>     
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">  
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Наименование</th>
                        <th>URL (Ссылка)</th>
                        <th></th>
                    </tr>  
                    </thead>
                    <tbody>                
                    <?php 
                        foreach($dan as $k=>$v){
                            $s = "'".$v['ID']."', '".$v['NAME_FORM']."', '".$v['NAME_URL']."'";
                            echo '<tr>
                                <td>'.$v['ID'].'</td>
                                <td>'.$v['NAME_FORM'].'</td>
                                <td>'.$v['NAME_URL'].'</td>
                                <td>
                                    <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#addForm" onclick="Edit('.$s.');"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-xs btn-danger del" data="'.$v['ID'].'"><i class="fa fa-trash"></i></a>
                                    <a href="help?id_page='.$v['NAME_URL'].'" class="btn btn-xs btn-warning" title="Помощь для страницы (создать или редактировать)"><i class="fa fa-question"></i></a>
                                </td>
                            </tr>';
                        }
                    ?>
                    </tbody>
                </table>                                                
            </div>                                    
        </div>
    </div>
</div>

<?php 
    $form = '<form method="post" id="save" class="form-horizontal">
    <input type="hidden" name="id" value="0" class="id_method">'.             
             FORMS::FormHorizontalEdit(3, 9, 'Наименование', 'NAME', '').
             FORMS::FormHorizontalEdit(3, 9, 'URL Адресс', 'URL', '').'                    
             </form>';
    
    echo FORMS::ModalContainer("addForm", 'Редактирование форм', '', $form, 'Save();');
?>  

<script>
function Edit(id, name, url)
{
    $('input[name="id"]').val(id);
    $('input[name="NAME"]').val(name);
    $('input[name="URL"]').val(url);
}

function Save()
{
    $('#save').submit();
}

$('.del').click(function(){
        var id = $(this).attr('data');
        swal({
            title: "Подтверждение на удаление?",
            text: "Вы действительно хотите удалить запись?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Да подтверждаю",
            closeOnConfirm: false
        }, function () {
            $('body').append('<form method="post" id="deleted"><input type="hidden" value="'+id+'" name="deleted"></form>');
            $('#deleted').submit();
            //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });        
    });
</script>
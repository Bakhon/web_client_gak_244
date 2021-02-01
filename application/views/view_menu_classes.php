<div class="row">
    <div class="col-lg-12" id="osn-panel">        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Административная панель управления</h5>     
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_method" onclick="Edit('0', '', '');"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Наименование</th>
                        <th>Имя Функции</th>
                        <th></th>
                    </tr>
                    <?php 
                        if(count($dan) > 0){
                            foreach($dan as $k=>$v){
                                $s = "'".$v['ID']."', '".$v['NAME']."', '".$v['FUNCT']."'";
                                echo '<tr>
                                    <td>'.$v['ID'].'</td>
                                    <td>'.$v['NAME'].'</td>
                                    <td>'.$v['FUNCT'].'</td>
                                    <td>
                                    <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_method" onclick="Edit('.$s.');"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger del" data="'.$v['ID'].'"><i class="fa fa-trash"></i></a>                                    
                                    </td>
                                </tr>';
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
    $form = '<form method="post" id="save_method" class="form-horizontal">
    <input type="hidden" name="id" value="0" class="id_method">'.
             FORMS::FormHorizontalEdit(3, 9, 'Наименование', 'METHOD_NAME', '').
             FORMS::FormHorizontalEdit(3, 9, 'Имя Функции', 'METHOD_ACTION', '').'
             </form>';
    
    echo FORMS::ModalContainer("edit_method", 'Редактирвоание Главного меню', '', $form, 'save();');
?>

<script>
    function save(){
        $('#save_method').submit();
    }
    
    function Edit(id, name, method)
    {
        $('input[name="id"]').val(id);
        $('input[name="METHOD_NAME"]').val(name);
        $('input[name="METHOD_ACTION"]').val(method);
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
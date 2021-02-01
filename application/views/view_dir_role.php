<div class="row">
    <div class="col-lg-12" id="osn-panel">        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Справочник ролей</h5>     
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_role" onclick="Edit('');"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Роль</th>
                        <th>Компания</th>
                        <th></th>
                    </tr>
                    <?php 
                        if(count($dan) > 0){
                            foreach($dan as $k=>$v){                                
                                $id = $v['ID'];
                                $test = $v['NAME'];
                                echo '<tr>
                                        <td>'.$v['ID'].'</td>
                                        <td>'.$v['NAME'].'</td>
                                        <td>'.$v['TYPE_PROC'].'</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_role" onclick="Edit('."'".$id."'".','."'".$test."'".', '."'".$v['ID_TYPE']."'".');"><i class="fa fa-edit"></i></a>
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
    $form = '<form method="post" id="save_role" class="form-horizontal">
             <input type="hidden" name="id" value="0" class="id_method">'.             
             FORMS::FormHorizontalEdit(3, 9, 'Наименование', 'NAME', '').
             FORMS::FormHorizontalSelect(3, 9, 'Тип роли', 'type_proc', $ls).
             '                    
             </form>';
             echo FORMS::ModalContainer("edit_role", 'Редактирование ролей', '', $form, 'save();');
?>            

<script>
    function save(){
        $('#save_role').submit();
    }
    
    function Edit(id, name, id_proc = 0)
    {
        $('input[name="id"]').val(id);
        $('input[name="NAME"]').val(name);
        $('.chosen-select option[value='+id_proc+']').attr('selected','selected');        
    }
</script>
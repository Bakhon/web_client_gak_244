<div class="row">
    <div class="col-lg-10" id="osn-panel">        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Списочная часть</h5>     
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_method" onclick="edit('', '');"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="footable table table-stripped default footable-loaded" id="editable">
                    <thead>
                    <tr>
                        <th>Филиал</th> 
                        <th>Фамилия</th>
                        <th>Имя</th> 
                        <th>Отчество</th>
                        <th>Должность</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(count($dan) > 0){
                            foreach($dan as $k=>$v){
                                $active = 'активный';
                                if($v['DISABLED']==1) $active = 'Заблокирован';
                                echo '<tr class="gradeX">
                                        <td>'.$v['BR_NAME'].'</td>
                                        <td>'.$v['LASTNAME'].'</td>
                                        <td>'.$v['FIRSTNAME'].'</td>
                                        <td>'.$v['MIDDLENAME'].'</td>
                                        <td>'.$v['DOLZHNOST'].'</td>
                                        <td>'.$active.'</td>
                                        <td>
                                        <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_method" onclick="edit('.$v['ID'].', '."'".$v['BR_NAME']."'".', '."'".$v['DIS_STATE']."'".', '."'".$v['LASTNAME']."'".', '."'".$v['FIRSTNAME']."'".', '."'".$v['MIDDLENAME']."'".', '."'".$v['DOLZHNOST']."'".', '."'".$v['DISABLED']."'".', '."'".$v['BRANCH_ID']."'".', 1401);">
                                        <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger del" data="'.$v['ID'].'"><i class="fa fa-trash"></i></a>                                    
                                        </td>
                                    </tr>';
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>                                    
        </div>
    </div>
    <!--sidebar-->    
        <?php require_once MODELS."sidebar.php";?>
    <!--sidebar--> 
</div>
<!--
 -->

<div class="modal inmodal fade" id="edit_method" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Редактирование метода</h4>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body">
                            <?php
                                echo '<form method="post" id="save_method" class="form-horizontal">
                                        <input hidden="" name="id" value="0" class="id_method" placeholder="0">';
                                        echo '<div class="form-group">
                                               <label class="col-lg-3 control-label">Филиал</label>
                                               <div class="col-lg-9">
                                                        <select class="select2_demo_1 form-control" id="filial" name="cityName">';
                                                        foreach ($dicBranchDan as $k => $v){
                                                            echo '<option value="'.$v['RFBN_ID'].'">'.$v['SHORT_NAME'].'</option>';
                                                            }
                                                  echo '</select>
                                                  <span class="help-block m-b-none"></span>
                                                  </div>
                                                </div>';
                                         echo FORMS::FormHorizontalEdit(3, 9, 'Фамилия', 'LASTNAME', '');
                                         echo FORMS::FormHorizontalEdit(3, 9, 'Имя', 'FIRSTNAME', '');
                                         echo FORMS::FormHorizontalEdit(3, 9, 'Отчество', 'MIDDLENAME', '');
                                         echo FORMS::FormHorizontalEdit(3, 9, 'Должность', 'DOLZHNOST', '');
                                         echo '<input hidden="" id="branch_idInp" name="branch_idInp" class="id_method" placeholder="0000" value="0000">';
                                         echo '<div class="form-group">
                                               <label class="col-lg-3 control-label">Статус</label>
                                               <div class="col-lg-9">
                                                        <select class="select2_demo_1 form-control" id="statusSelect" name="statusSelect">
                                                            <option value="">Активен</option>
                                                            <option value="1">Заблокирован</option>
                                                        </select>
                                              <span class="help-block m-b-none"></span>
                                              </div>
                                            </div>';
                                         echo '</form>';
                            ?>
                            <script>
                                $('#filial').change(
                                    function(){
                                        var filialVal = $('#filial').val();
                                        $('#branch_idInp').val(filialVal);
                                    }
                                )
                            </script>
                            <script>
                                $('#reasonSelector').change(function(){
                                    searchReasonById();
                                })
                                
                                function searchReasonById(){
                                    var reasonId = $("#reasonSelector option:selected").val();
                                    console.log(reasonId);
                                    $.post('list_standart_contracts', {"reasonId" : reasonId}, function(d){
                                        $('#ID_DOP_NUM').html(d);
                                    })}
                            </script>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="save();">Сохранить</button>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
                        </div>
                    </div>
                </div>
            </div>
<script>
    function save(){
        $('#save_method').submit();
    }
    
    function edit(id, BR_NAME, DIS_STATE, LASTNAME, FIRSTNAME, MIDDLENAME, DOLZHNOST, DISABLED, BRANCH_ID)
    {   
        console.log(id);
        $("#filial [value="+BRANCH_ID+"]").attr("selected", "selected");
        $('input[name="id"]').val(id);
        $('input[name="BR_NAME"]').val(BR_NAME);
        $('input[name="LASTNAME"]').val(LASTNAME);
        $('input[name="FIRSTNAME"]').val(FIRSTNAME);
        $('input[name="MIDDLENAME"]').val(MIDDLENAME);
        $('input[name="DOLZHNOST"]').val(DOLZHNOST);
        $('input[name="branch_idInp"]').val(BRANCH_ID);
        $("#statusSelect [value='"+DISABLED+"']").attr("selected", "selected");
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
        }, function (){
            $('body').append('<form method="post" id="deleted"><input type="hidden" value="'+id+'" name="deleted"></form>');
            $('#deleted').submit();
            //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });        
    });
</script>
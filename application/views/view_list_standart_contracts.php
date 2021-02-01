<div class="row">
    <div class="col-lg-12" id="osn-panel">        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Списочная часть</h5>     
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_method" onclick="edit('', '');"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Текст заголовка</th> 
                        <th>Тип договора</th>
                        <th>Дата начала</th> 
                        <th>Дата окончания</th>
                        <th>Основной договор</th> 
                        <th>Причина доп.соглашения</th>
                        <th></th>
                    </tr>
                    <?php 
                        if(count($dan) > 0){
                            foreach($dan as $k=>$v){
                                echo '<tr>
                                        <td>'.$v['ID'].'</td>
                                        <td>'.$v['TITLE_TEXT'].'</td>
                                        <td>'.$v['PAYM_CODE'].'</td>
                                        <td>'.$v['DATE_ADD'].'</td>
                                        <td>'.$v['DATE_BEGIN'].'</td>
                                        <td>'.$v['DATE_END'].'</td>
                                        <td>'.$v['ID_DOP_NUM'].'</td>
                                        <td>
                                        <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_method" onclick="edit('.$v['ID'].', '."'".$v['TITLE_TEXT']."'".', '."'".$v['PAYM_CODE']."'".', '."'".$v['DATE_ADD']."'".', '."'".$v['DATE_BEGIN']."'".', '."'".$v['DATE_END']."'".', '."'".$v['ID_DOP_NUM']."'".');">
                                        <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger del" data="'.$v['ID'].'"><i class="fa fa-trash"></i></a>
                                        <a href="standart_contracts?sicid='.$v['ID'].'" class="btn btn-sm btn-danger" data="'.$v['ID'].'"><i class="fa fa-eye"></i></a>                                    
                                        </td>
                                    </tr>';
                            }
                        }
                    ?>
                </table>
            </div>                                    
        </div>
    </div>
    <!--sidebar-->    
        <?php require_once MODELS."sidebar.php";?>
    <!--sidebar--> 
</div>
<!--
<?php
    $form = '<form method="post" id="save_method" class="form-horizontal">
    <input type="hidden" name="id" value="0" class="id_method">'.
             FORMS::FormHorizontalEdit(3, 9, 'Текст заголовка', 'TITLE_TEXT', '').
             '<div class="form-group">
                    <label class="col-lg-3 control-label">Тип договора</label>
                    <div class="col-lg-9">
                            <select class="select2_demo_1 form-control" name="PAYM_CODE">
                                <option value="07">07 - ОСНС</option>
                                <option value="01">01 - ПА</option>
                                <option value="02">02 - ОСОР</option>
                                <option value="06">06 - Хранитель</option>
                            </select>
                 <span class="help-block m-b-none"></span>
                 </div>
             </div>'.
             FORMS::FormHorizontalEdit(3, 9, 'Дата добавления', 'DATE_ADD', '').
             FORMS::FormHorizontalEdit(3, 9, 'Дата начала', 'DATE_BEGIN', '').
             FORMS::FormHorizontalEdit(3, 9, 'Дата окончания', 'DATE_END', '').
             FORMS::FormHorizontalEdit(3, 9, 'Доп.нум', 'ID_DOP_NUM', '').
             '<div class="form-group">
                    <label class="col-lg-3 control-label">Причина доп. соглашения</label>
                    <div class="col-lg-9">
                            <select class="select2_demo_1 form-control" name="ID_DOP_NUM" id="ID_DOP_NUM">'.
                               //foreach($sqlDicReason as $k => $v){
                                //echo '<option value="07">'.$v['NAME'].'</option>'
                               //}
                            '</select>
                 <span class="help-block m-b-none"></span>
                 </div>
             </div>'.
             '</form>';
    
    //echo FORMS::ModalContainer("edit_method", 'Редактирование метода', '', $form, 'save();');
?> -->

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
                                        <input type="hidden" name="id" value="0" class="id_method">';
                                         echo FORMS::FormHorizontalEdit(3, 9, 'Текст заголовка', 'TITLE_TEXT', '');
                                         echo '<div class="form-group">
                                               <label class="col-lg-3 control-label">Тип договора</label>
                                               <div class="col-lg-9">
                                                        <select class="select2_demo_1 form-control" name="PAYM_CODE" id="reasonSelector">
                                                            <option value="0">0 - Причина не выбрана</option>
                                                            <option value="07">07 - ОСНС</option>
                                                            <option value="01">01 - ПА</option>
                                                            <option value="02">02 - ОСОР</option>
                                                            <option value="06">06 - Хранитель</option>
                                                        </select>
                                              <span class="help-block m-b-none"></span>
                                              </div>
                                            </div>';
                            ?>
                                            
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Дата добавления</label>
                                                <div class="col-lg-9">
                                                       <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" name="DATE_ADD" data-mask="99.99.9999" class="form-control DATE_ADD" value="" />
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Дата начала</label>
                                                <div class="col-lg-9">
                                                       <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" name="DATE_BEGIN" data-mask="99.99.9999" class="form-control DATE_BEGIN" value="" />
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Дата окончания</label>
                                                <div class="col-lg-9">
                                                       <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" name="DATE_END" data-mask="99.99.9999" class="form-control DATE_END" value="03:04:2014" />
                                                        </div>
                                                </div>
                                            </div>
                                            
                                         <?php
                                         echo
                                         //FORMS::FormHorizontalEdit(3, 9, 'Дата добавления', 'DATE_ADD', '').
                                         //FORMS::FormHorizontalEdit(3, 9, 'Дата начала', 'DATE_BEGIN', '').
                                         //FORMS::FormHorizontalEdit(3, 9, 'Дата окончания', 'DATE_END', '').
                                         '<div class="form-group">
                                                <label class="col-lg-3 control-label">Причина доп. соглашения</label>
                                                <div class="col-lg-9">
                                                        <select class="select2_demo_1 form-control" name="ID_DOP_NUM" id="ID_DOP_NUM">';
                                                            echo '<option value="0">Основной договор</option>';
                                                                    foreach($sqlDicReason as $k => $v){
                                                                        echo '<option value="'.$v['PAYM_CODE'].'">'.$v['NAME'].'</option>';
                                                                    }
                                                            echo '</select>
                                             <span class="help-block m-b-none"></span>
                                             </div>
                                         </div>'.
                                         '</form>';
                            ?>
                            <script>
                                $('#reasonSelector').change(function(){
                                    searchReasonById();
                                })
                                
                                function searchReasonById(){
                                    var reasonId = $("#reasonSelector option:selected").val();
                                    console.log(reasonId);
                                    $.post('list_standart_contracts', {"reasonId" : reasonId}, function(d){
                                        $('#ID_DOP_NUM').html(d);
                                    })
                                }
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
    
    function edit(id, TITLE_TEXT, PAYM_CODE, DATE_ADD, DATE_BEGIN, DATE_END, ID_DOP_NUM)
    {   
        console.log(PAYM_CODE);
        $('input[name="id"]').val(id);
        $('input[name="TITLE_TEXT"]').val(TITLE_TEXT);
        
        $("#reasonSelector [value='"+PAYM_CODE+"']").attr("selected", "selected");
        searchReasonById();
        
        $('input[name="DATE_ADD"]').val(DATE_ADD);
        $('input[name="DATE_BEGIN"]').val(DATE_BEGIN);
        $('input[name="DATE_END"]').val(DATE_END);
        
        $('input[name="ID_DOP_NUM"]').val(ID_DOP_NUM);
        
        $("#ID_DOP_NUM [value='"+ID_DOP_NUM+"']").attr("selected", "selected");
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

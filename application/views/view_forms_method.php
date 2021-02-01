<div class="row">
<div class="col-lg-12">
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Список форм распределения</h5>                
            </div>
            <div class="ibox-content">                
                <table class="table table-bordered roleTable">
                    <tr class="gradeX" title="0" data="Без распределителя">
                        <td>0</td>
                        <td>Без распределителя</td>
                    </tr>
                    
                    <?php 
                        foreach($dirFormsRasp as $t=>$y){
                        echo '<tr class="gradeX" title="'.$y['ID'].'" data="'.$y['NAME'].'">
                                    <td>'.$y['ID'].'</td>
                                    <td>'.$y['NAME'].'</td>
                              </tr>';
                        }
                    ?>
                </table>                                                
            </div>                                    
        </div>
    </div>
    <script>
        $('.roleTable tr').click(function(){
                var s = $(this);
                var tr = $(this);
                $('.gradeX').removeClass('active');
                $(this).addClass('active');
                window.roleId = tr.attr('title');
                var roleNameData = tr.attr('data');
                console.log(roleId);
                $('#roleNameTitle').text("Список форм "+"'"+roleNameData+"'");
                $.post('forms_method', {"roleId":roleId}, function(d){     
                    $('.dirFormsTable').html(d);
                });    
            }
        )
    </script>
     <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5 id="roleNameTitle">Список форм</h5>               
            </div>
            <div class="ibox-content">            
                <div class="panel-group dirFormsTable" id="accordion">
                    <!-- -->
                </div>                                                
            </div>                                    
        </div>
    </div>
    
</div>

<?php
    $html = '<div><form method="POST" class="form-horizontal" ID="save_addForm">
    <input type="hidden" name="id_form" value="">';     
    foreach($list_methods as $k=>$v)
    {
        $html .= '<label><input type="checkbox" name="method_names[]" value="'.$v['ID'].'"/>'.$v['METHOD_NAME'].'('.$v['METHOD_ACTION'].')</label><br />';        
    }
    $html .= '</form></div>';
        
    echo FORMS::ModalContainer("addMethod", 'Список методов', 'Добавление методов к форме', $html, 'saveForm();');
?>

<script>    
    function saveForm(){
        console.log('saveForm');
        $('#save_addForm').submit();
    }    
    
    function SetMethod(id_form)
    {
        $('input[name=id_form]').val(id_form);
    }
</script>
</div>
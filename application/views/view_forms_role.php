<div class="row">
<div class="col-lg-12">
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Список ролей</h5>     
            </div>
            <div class="ibox-content">
                <table class="table table-bordered roleTable">
                    <?php 
                        foreach($roles as $k=>$v){
                            $s = '';
                            if($v['ID'] == $id_role){
                                $s = 'active';
                                $role_name = $v['NAME'];
                            }
                            echo '<tr class="gradeX '.$s.'" title="'.$v['NAME'].'" data="'.$v['ID'].'">
                                    <td>'.$v['ID'].'</td>
                                    <td>'.$v['NAME'].'</td>
                            </tr>';
                        }
                    ?>
                </table>                                                
            </div>                                    
        </div>
    </div>
    
     <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5 id="roleNameTitle"><?php echo $role_name ?> (Список форм)</h5>     
            </div>
            <div class="ibox-content">
                <form method="POST">
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                                                
                        <?php 
                        foreach($dir_forms as $k=>$v)
                        {
                            $s = '';
                            $btn = '';
                            if($v['CH'] !== '0'){
                                $s = 'checked';
                                $btn = '<span class="pull-right">
                                    <a class="btn btn-success btn-xs addMethod" id="'.$v['ID'].'" data-toggle="modal" data-target="#edit_method"><i class="fa fa-code"></i></a>                                    
                                </span>';                                
                            }
                            echo '<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <input type="checkbox" name="id_form[]" value="'.$v['ID'].'" '.$s.'>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#form'.$k.'" aria-expanded="false" class="collapsed">
                                                    '.$v['NAME_FORM'].'
                                                </a>'.$btn.'
                                            </h5>
                                        </div>
                                        <div id="form'.$k.'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body"><ul>';
                                            
                            foreach($v['method'] as $i=>$p){                                
                                ECHO '<li>'.$p['METHOD_NAME'].'</li>';
                            }                                                                                           
                            echo '</ul></div></div></div>';                                                                
                        }                                                                                              
                    ?>    
                                         
                    </div>
                </div>
                <input type="hidden" name="id_role" value="<?php echo $id_role; ?>"/>   
                <input type="submit" class="btn btn-success" value="Сохранить"/>
                </form>                                                                        
            </div>                                    
        </div>
    </div>

</div>

</div>

<!-- modal -->
<div class="modal inmodal fade" id="edit_method" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Список методов</h4>
                <small class="font-bold">Выделите нужные методы для добавления в форму</small>
            </div>
            <div class="modal-body">
                <?php 
                    foreach($list_methods as $k=>$v){
                        echo '<label><input type="checkbox" name="id_method[]" value="'.$v['ID'].'"> '.$v['METHOD_NAME'].' ('.$v['METHOD_ACTION'].')</label><br />';
                    }
                ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_role" value="<?php echo $id_role; ?>"/>
                <input type="hidden" name="form_id" value="0"/>                                 
                <input type="submit" class="btn btn-primary" value="Сохранить"/>                
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
        </form>
    </div>
</div>
<!---------------->

<script>
    $('.addMethod').click(function(){
        var id = $(this).attr('id');
        $('input[name=form_id]').val(id);
    });
    
    $('.gradeX').click(function(){
       var id = $(this).attr('data');
       window.location.href = 'forms_role?id='+id 
    });
</script>

<style>
.gradeX{
    cursor: pointer;
}
.gradeX:hover{
    background: rgb(188, 225, 251);
}
</style>
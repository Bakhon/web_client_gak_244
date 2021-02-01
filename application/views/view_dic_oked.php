<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h3>Справочник видов деятельности
                <button class="btn btn-success btn-xs pull-right set_new" data="0" data-toggle="modal" data-target="#modal_options"><i class="fa fa-plus"></i></button>
                </h3>                
            </div>
            <div class="ibox-content">                
                <table class="table table-bordered table-hover" id="editable" width="100%">
                    <thead>
                    <tr>
                        <th>ОКЕД</th>
                        <th>Наименование</th>
                        <th>Наименование ОКЕД</th>
                        <th>Наименование АФН</th>
                        <th>Класс риска</th>
                        <th>Тариф</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dan as $k=>$v){ ?>
                        <tr class="gradeX" data="<?php echo $v['ID']; ?>" data-toggle="modal" data-target="#modal_options">
                            <td><?php echo $v['OKED']; ?></td>
                            <td><?php echo $v['NAME']; ?></td>
                            <td><?php echo $v['NAME_OKED']; ?></td>
                            <td><?php echo $v['NAME_AFN']; ?></td>
                            <td><?php echo $v['RISK_ID']; ?></td>
                            <td><?php echo $v['TARIF']; ?></td>
                        </tr>
                    <?php }?>
                    
                    </tbody>
                </table>                
            </div>
        </div>
    </div>             
</div>

<div class="modal inmodal fade" id="modal_options" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Редактор видов деятельности</h4>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="form_params">
                    <input type="hidden" name="ID" value="0">     
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">ОКЕД</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="OKED" value=""/>                            
                        </div>
                    </div> 
                                   
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Наименование</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="NAME" value=""/>                            
                        </div>
                    </div>
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Наименование ОКЕД</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="NAME_OKED" value=""/>                            
                        </div>
                    </div> 
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Наименование АФН</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="NAME_AFN" value=""/>                            
                        </div>
                    </div> 
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Класс проф. риска</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="RISK_ID" value=""/>                            
                        </div>
                    </div> 
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Тариф</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="TARIF" value=""/>                            
                        </div>
                    </div> 
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Номер ОКЕДА-а</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="ID_OKED" value=""/>                            
                        </div>
                    </div> 
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">Номер по порядку в НБ</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="NOM_PP" value=""/>                            
                        </div>
                    </div>        
                    
                    <div class="form-group">                        
                        <label class="control-label col-lg-3">№ в НБ РК</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="ID_NBRK" value=""/>                            
                        </div>
                    </div>                                  
                                                                                                               
                </form>
            </div>

            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" id="save_form_params">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<style>
    .gradeX{
        cursor: pointer;
    }
</style>
<script>
    $('.gradeX').click(function(){
       var id = $(this).attr('data');
       $.post(window.location.href, {"dan":id}, function(data){            
            var js = JSON.parse(data);
            $.each(js, function(key, value){
                $('input[name='+key+']').val(value);
            })
       }); 
    });
    
    $('.set_new').click(function(){
       var s = $('#form_params input.form-control');
       s.each(function(){
          $(this).val('');
       });
       $('input[name=ID]').val('0');       
    });
    
    $('#save_form_params').click(function(){
        $('#form_params').submit();
        $('.close').click();
    });
</script>
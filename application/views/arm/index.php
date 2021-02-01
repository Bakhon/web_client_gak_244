<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Список форм отчетности</h5>
        </div>
        <div class="ibox-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Наименование</th>
                        <th style="width: 150px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($dan as $k=>$v){
                    ?>
                    <tr>
                        <td><?php echo $v['ID']; ?></td>
                        <td><?php echo $v['NAME']; ?></td>
                        <td> 
                            <button class="btn btn-success set_params" id="<?php echo $v['ID']; ?>" data-toggle="modal" data-target="#send_params"><i class="fa fa-bug"></i></button>
                            <a href="arm?admin=<?php echo $v['ID']; ?>" class="btn btn-danger"><i class="fa fa-key"></i></a>
                        </td>
                    </tr>                                                        
                    <?php }?>                    
                </tbody>
            </table>            
        </div>            
    </div>        
</div>

<div class="modal inmodal fade" id="send_params" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Сформировать отчет</h4></div>
                <small class="font-bold"></small>
            </div>
            <form method="post" class="form_send_param" action="arm?edit">
                <div class="modal-body">                
                    <div class="row" id="create_param"> 
                                                                    
                    </div>                
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="edit" value="0"/>
                    <input type="submit" class="btn btn-success" value="Сформировать"/>                    
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
                </div>  
            </form>                      
        </div>        
    </div>
</div>

<script>
    $('.set_params').click(function(){
       var id = $(this).attr('id');
       $.post(window.location.href, {"form_params":id}, function(data){        
        var j = JSON.parse(data);
        $('.form_send_param').attr('action', 'arm?edit='+id);
        $('input[name=edit]').val(id);
        $('#create_param').html(j.HTML);        
       });
    });
</script>
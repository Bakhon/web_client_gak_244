<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <?php foreach($list_t_s as $k=>$v){ ?> 
        <h2>Список продуктов <?php echo $v['NAME_1']; ?> : </h2>
        <br />
        <?php break; } ?>
            <?php foreach($list_t_s as $k=>$v){ ?>             
            <div class="ibox float-e-margins border-bottom">
                <div class="ibox-title">               
              <!--     <a href="contract_editor?id=<?php echo $v['ID']; ?>"> -->
                       <h5 style="margin-top: 5px; color:black;">
                             <?php echo $v['NAME']; ?>
                       </h5>
                       <input type="hidden" name="" id="" value="<?php echo $v['ID']; ?>"/>

                <!--       <span class="label label-primary" style="margin-top: 5px;">ОСНС с траншами</span> -->                                                                                                      
                   </a> 
<div class="ibox-tools tooltip-demo">
                        <button class="btn btn-primary btn-outline setting"   name="subject" data="<?php echo $v['ID']; ?>" data-toggle="modal" data-target="#modal_options"><i class="fa fa-sign-in"></i> Параметры</button>
                        <a href="contract_editor?id=<?php echo $v['ID']; ?>" class="btn btn-primary"><i class="fa fa-code"></i> Форма</a>                                                                                                                    
                    </div> 
                   
                   
                </div>                          
            </div>
            <?php } ?>
        </div>                                
    </div>    
</div>


<div class="modal inmodal fade" id="modal_options" data="<?php echo $_GET['id']; ?>" role="dialog"  aria-hidden="true">  
<div class="modal-dialog modal-lg"  >
        <div class="modal-content  ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Выберите условия</h4>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="form"  >                                                                            
       
                <div class="form-group">
                        <label class="control-label col-lg-3">Вид договора</label>
                        <div class="col-lg-9" id="checkBoxGroup" >                        
                                                          
                       </div>
                  </div>                                         
              </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_other" id="id_block" value="0"/>                              
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_form_params">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
</div>
</div>  

<script>

$('.setting').click(function(){
   var id = $(this).attr('data');
   console.log(id);
   $.post(window.location.href, {"id_condition":id}, function(data){  
     var j = JSON.parse(data);
     console.log(j);
    console.log(data);
   })
            
})

</script>
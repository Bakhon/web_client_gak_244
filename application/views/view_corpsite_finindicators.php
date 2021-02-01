
<div class="row">

<div class="col-lg-12">
<?php foreach($list_f as $k=>$v) { ?>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5><?php echo $v['NAME_RU'].'/ '.$v['NAME_KAZ']; ?></h5>
                        <div class="ibox-tools">
                        
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a> 
                            <a id="ed" data-id="<?php echo $v['ID']; ?>"  data-toggle="modal" data-target="#edit_slide22" href="#" class="btn btn-white btn-sm btn1"><i class="fa fa-pencil"></i> Edit</a>                                              
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 50px;"><div class="scroll_content" style="overflow: hidden; width: auto; height: 200px;">
                            <p>
                              <?php echo $v['TEXT_RU']; ?> 
                            </p>
                            <?php if($v['ID'] == 21) { ?>
                           <p><?php echo $v['DATE_FIN']; ?></p>
                          <?php } ?>
                        </div><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 166.667px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    </div>
                </div>
                <?php } ?>
            </div>


</div>



<div class="modal inmodal fade in" id="edit_slide22" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="float: left; left: 18%;">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <div id="closeModal"><h4 class="modal-title">Редактировать</h4></div>
                <small class="font-bold"></small>
            </div>
            <form method="post" class="form">
            
            </form>                        
        </div>        
    </div>
</div>


<script>

$('.btn1').click(function(){   
    var id = $(this).attr('data-id');
    console.log(id);
    
       $.post
            ('corpsite_finindicators',
                {"id": id                                                 
                },
                function(d)
                {        
                        $('.form').html(d);             
                }
            )         
})


</script>
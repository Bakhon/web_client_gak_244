<?php    
    $btn1 = 'btn-success';
    $btn2 = 'btn-default';    
    $href = 'search';    
	if(isset($_GET['list_contracts'])){
	   $btn1 = 'btn-default';
	   $btn2 = 'btn-success';
       $href = 'list_contracts';
	}        
?>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="reins_bordero" class="btn <?php echo $btn1; ?>"><i class="fa fa-list-ul"></i> Не сформированные</a>
                    <a href="reins_bordero?list_contracts" class="btn <?php echo $btn2; ?>"><i class="fa fa-list-alt"></i> Список договоров</a>
                    <span data-toggle="modal" data-target="#filter"  class="btn btn-primary"><i class="fa fa-filter"></i></span>
                    
                </div>
                <div class="ibox-content">
                <?php 
                    echo $bordero->html;
                ?>
                </div>
            </div>
        </div>
                       
    </div>
</div>

<div class="modal inmodal fade" id="filter" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Поиск и фильтрация</h4>
            </div>
            <div class="modal-body">
                <form method="get" id="form_filter" class="form-horizontal">
                    <h3>Показать за период</h3>                    
                    <div class="form-group">
                        <label class="col-lg-2">C</label>
                        <div class="input-group date col-lg-10">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="date_begin" class="form-control input-sm" data-mask="99.99.9999" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2">По</label>
                        <div class="input-group date date col-lg-10"">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="date_end" class="form-control input-sm" data-mask="99.99.9999" value="">
                        </div>
                    </div>
                    <hr />
                    <h3>По статусу</h3>                    
                    <div class="form-group">  
                        <select class="form-control" name="state">
                            <option value="">Не выбран</option>
                            <?php 
                                foreach($bordero->dan_array['list_states'] as $k=>$v)
                                {
                                    echo '<option value="'.$v['ID'].'">'.$v['NAME'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <input type="hidden" name="list_contracts"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default set_filter">Применить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="set_note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Комментарий</h4>
            </div>
            <div class="modal-body">
                <p><textarea class="form-control note"></textarea></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default set_state" id="" data=""></button>
            </div>
        </div>
    </div>
</div>



<div class="modal inmodal fade" id="all_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="all_modal_title"></h4>
            </div>
            <div class="modal-body" id="all_modal_body">
                
            </div>
            <div class="modal-footer" id="all_modal_footer">
                <button type="button" class="btn btn-info" id="" data="">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<?php 
    require_once __DIR__.'/../reinsurance/modal_vozvrat.php';
    require_once __DIR__.'/../reinsurance/modal_kvit.php';
    require_once __DIR__.'/../reinsurance/modal_note_rasp.php';
    require_once __DIR__.'/../reinsurance/modal_files.php';
?>
<style>
#list_contracts{
    max-height: 300px;
    overflow: auto;
}
</style>

<script>    
    $('.set_state_rasp').click(function(){
        $('#gen_rasp').submit();
    });
    
    $('.set_filter').click(function(){
        $('#form_filter').submit();
    });
    
    $('.add_contracts').click(function(){
        var id = $(this).attr('id');
        $('#all_modal_title').html('Добавить договор страхования');
        $('#all_modal_footer').children('.btn').attr('id', 'save_add_contracts');
        $.post(window.location.href, {"get_add_contracts":id}, function(data){
            $('#all_modal_body').html(data);
            
        });
        console.log(id);
    });
    $('body').on('click', '#save_add_contracts', function(){
        $('#setaddcontracts').submit();
    });

</script>

<?php require_once 'application/blocks/footer.php'; ?>
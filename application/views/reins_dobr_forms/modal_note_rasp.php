<div class="modal inmodal fade" id="set_note_rasp" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Создание распоряжения</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="gen_rasp" method="post" enctype="multipart/form-data">                                      
                    <label>Дата распоряжения</label>
                    <div class="input-group date ">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="idate_rasp" class="form-control idate_rasp input-sm" data-mask="99.99.9999" value="">
                    </div>
                                                
                    
                    <label>№ счета</label>
                    <input type="text" class="form-control" name="inum_shet"/>
                    
                    <label>Дата счета</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="idate_schet" class="form-control idate_schet input-sm" data-mask="99.99.9999" value="">
                    </div>                    
                    
                    <label>Скан. копия счета на оплату</label>
                    <input type="file" class="form-control" name="ischet_fail"/>
                    
                    <label>Примечание</label>
                    <textarea name="note" class="form-control note"></textarea>
                    <input type="hidden" name="set_num_rasp" value="0"/>
                </form>                                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default set_state_rasp"></button>
            </div>
        </div>
    </div>
</div>
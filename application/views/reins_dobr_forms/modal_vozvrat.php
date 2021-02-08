<div class="modal inmodal fade" id="vozvrat_cnct" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Создание возврата</h4>
            </div>
            <div class="modal-body">    
                <form method="post" id="save_vozvrat">              
                <div class="form-horizontal">                  
                    <div class="form-group">
                        <label class="col-lg-4">Дата договора</label>
                        <div class="col-lg-8">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="vozvrat_date" class="form-control input-sm" data-mask="99.99.9999" value="<?php echo date("d.m.Y"); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">                    
                        <label class="col-lg-4">№ договора</label>
                        <div class="col-lg-8">                        
                            <input type="text" name="vozvrat_contract_num" class="form-control input-sm" value="">
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-4">Сумма к оплате</label>
                        <div class="col-lg-8">                        
                            <input type="text" name="vozvrat_pay_sum_opl" class="form-control input-sm" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4">Обязательства</label>
                        <div class="col-lg-8">                        
                            <input type="text" name="vozvrat_sum_s_strah" class="form-control input-sm" value="">
                        </div>
                    </div>                    
                </div>
                <hr />
                <div id="list_contracts">                    
                    
                </div>
                <input type="hidden" name="vozvrat" value=""/>
                <input type="hidden" name="id_contract_vozvrat" value=""/>  
                </form>              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info set_vozvrat">Сохранить</button>
            </div>
        </div>
    </div>
</div>
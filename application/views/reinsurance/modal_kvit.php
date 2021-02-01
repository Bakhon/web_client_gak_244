<div class="modal inmodal fade" id="kvitovanie" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Квитование платежей (Поиск)</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row">
                    <form class="col-lg-12" id="search_kvit_form">
                        <h3>Поиск</h3>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label>Дата платежа с</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_begin" class="form-control" value="" data-mask="99.99.9999" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>По</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_end" class="form-control" value="" data-mask="99.99.9999" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label>Сумма</label>
                                <input type="number" name="pay_sum" class="form-control"/>                            
                            </div>
                            <div class="col-lg-3">
                                <label>БИН</label>
                                <input type="text" name="bin" class="form-control"/>
                            </div>
                            <div class="col-lg-3"> 
                                <label>Сквитован Да/нет</label>                           
                                <select name="skvit" class="form-control">
                                    <option value=""></option>
                                    <option value="0">Сквитован</option>
                                    <option value="1">Не сквитован</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-3">
                                <label>&nbsp;</label>
                                <button class="btn btn-success btn-block" id="search_kvit"><i class="fa fa-search"></i> Найти</button>
                            </div>
                            
                            <input type="hidden" name="search_plat_kvit" value=""/>
                            <input type="hidden" name="mhmh_id_vozvr" id="mhmh_id_vozvr" value="0"/>
                            <input type="hidden" name="id_transh" id="id_transh" value="0"/>
                        </div>
                    </form>
                    <div class="col-lg-12">
                        <hr />                                                        
                        <h3 class="pull-left">Результат поиска</h3>
                        <div id="view_plat" data="0" style="max-height: 400px;overflow: auto; width:100%">
                                
                        </div>                        
                    </div>                    
                </div>                                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-white" id="close_btn_kvit" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script>
$('.btn_plat').click(function(){
    var id = $(this).attr('data');
    $('#view_plat').attr('data', id);
});

$('#search_kvit').click(function(e){
    e.preventDefault();        
    $.post(window.location.href, $('#search_kvit_form').serialize(), function(data){        
       $('#view_plat').html(data);            
    });        
});

$('body').on('click', '.btn_kvit', function(e){
    e.preventDefault();
    var id = $(this).attr('id');    
    var id_contract = $('#view_plat').attr('data');
    
    $.post(window.location.href, {"set_plat_vozvrat":id_contract, "mhmh":id}, function(data){
        if(data.trim() !== ''){
            alert(data);
        }else{
            window.location.reload();
        }
    });
      
});
</script>
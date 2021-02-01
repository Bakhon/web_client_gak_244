<form class="form-horizontal" method="post" id="raschet_vikup">
    <div class="form-group">
        <label class="col-lg-3">№ Заявления</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" name="vikup_num"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3">Дата заявления</label>
        <div class="col-lg-9">
            <input type="date" class="form-control" name="vikup_date"/>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-3">Размер выкупной суммы</label>
        <div class="col-lg-9">
            <input type="number" class="form-control" name="vikup_sum"/>
        </div>
    </div>
    <input type="hidden" name="raschet_vikup" value="<?php echo $cnct; ?>"/>
</form>
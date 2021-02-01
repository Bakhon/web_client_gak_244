<form class="form-horizontal" method="post" id="rastorg_dogovor">
    <div class="form-group">
        <label class="col-lg-3">№ Приказа</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" name="rastorg_num_prik"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3">Дата приказа</label>
        <div class="col-lg-9">
            <input type="date" class="form-control" name="rastorg_date_prik"/>
        </div>
    </div>    
    <input type="hidden" name="rastorg_dogovor" value="<?php echo $cnct; ?>"/>
</form>
<div class="col-lg-4">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Процедуры</h3>
            <span class="input-group-btn">
                <button data-toggle="modal" data-target="#add_new_proc" type="button" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Добавить процедуру</button>
            </span>
            <ul class="sortable-list connectList agile-list">
                <?php
                    foreach($list_proc as $k => $v){
                ?>
                    <li class="warning-element">
                        <?php echo $v['PROC_NAME'] ?>
                        <div class="agile-detail">
                            <i class="fa fa-clock-o"></i> 12.10.2015
                        </div>
                    </li>
                <?php      
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Документы процедуры</h3>
            <span class="input-group-btn">
                <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Добавить документ</button>
            </span>
            
            <ul class="sortable-list connectList agile-list">
                <?php
                    foreach($list_proc_doc as $k => $v){
                ?>
                    <li class="warning-element">
                        <?php echo $v['DOC_NAME'] ?>
                        <div class="agile-detail">
                            <i class="fa fa-clock-o"></i> 12.10.2015
                        </div>
                    </li>
                <?php      
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Резолюторы</h3>
            <span class="input-group-btn">
                <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Добавить резолютора</button>
            </span>
            
            <ul class="sortable-list connectList agile-list">
                <?php
                    foreach($list_respons as $k => $v){
                ?>
                    <li class="warning-element">
                        <?php echo $v['LASTNAME'].' '.$v['FIRSTNAME'].' '.$v['MIDDLENAME'];?>
                    </li>
                <?php      
                    }
                ?>
            </ul>
        </div>
    </div>
</div>



<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="add_new_proc" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить новую процедуру</h4>
                <small class="font-bold">Сменить филиал, подразделение, должность</small>
            </div>
            <div class="modal-body">
            <form method="post">
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Название процедуры</label>
                        <input name="" type="text" placeholder="" class="form-control pos_btn" id="" value="">
                    </div>
            </div>
            <div class="modal-footer">
                <a id="save_pos" type="submit" class="btn btn-primary">Сохранить</a>
                <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                  
            </div>
            </form>
        </div>
    </div>
</div>

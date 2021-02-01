<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><?php echo $dan['title']; ?></h5>        
    </div>                        
    <div class="ibox-content">
        <form class="form-horizontal" id="create_report" method="post">
            <div class="form-group">
                <label class="col-lg-2 control-label">Название отчета</label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" class="form-control" name="new_bi_reports" value="<?php echo $dan['text']; ?>" placeholder="Введите наименование отчета"/> 
                        <span class="input-group-btn"> 
                            <input type="submit" data="create_report" class="btn btn-primary" value="Создать" /> 
                        </span>
                    </div>                
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $dan['id']; ?>"/>                     
        </form>
    </div>
</div>
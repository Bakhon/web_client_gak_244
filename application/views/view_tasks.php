<div class="row">
    <div class="col-lg-12 wrapper border-bottom white-bg">
        <form method="post" action="tasks" class="form-horizontal">
            <legend>Новая задача</legend>
            <div class="form-group">
                <label class="col-lg-3 control-label">Заголовок</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="Заголовок задания">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Подразделение для исполнения</label>
                <div class="col-lg-9">
                    <select class="form-control">
                        <option value=""></option>
                    </select>     
                    <span class="help-block">Выберите подразделение кому будет назначено данное задание</span>               
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Описание задания</label>
                <div class="col-lg-9">
                    <textarea class="form-control" rows="3"></textarea>
                    <span class="help-block">Напишите подробное описание задания</span>
                </div>
            </div>
                        
        </form>
    </div>
</div>
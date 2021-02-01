<div class="form-group">
    <div class="col-lg-3">
        <label>Параметр</label>
        <input type="text" name="name[{%name%}]" class="form-control" readonly="" value="{%name%}">
    </div>
    <div class="col-lg-3">
        <label>Тип параметра</label>
        <select class="form-control set_params_sql_text" name="type[{%name%}]" data="{%name%}">
            <option value="T">Текст</option>
            <option value="D">Дата</option>
            <option value="S">Выбор</option>
        </select>
    </div>
            
    <div class="col-lg-3">
        <label>Название на русском</label>
        <input type="text" class="form-control" name="text[{%name%}]" placeholder="Наименование"/>        
    </div>            
    
    <div class="col-lg-3" id="set_value_div_{%name%}">
        <label>Значение</label>
        <input type="text" class="form-control" name="value[{%name%}]"/>               
    </div>
    <div class="col-lg-12">
        <label>SQL</label>
        <div class="input-group">
            <input type="text" class="form-control sqltext" id="{%name%}" name="sql_text[{%name%}]" readonly="true"/> 
            <span class="input-group-btn"> 
                <button type="button" class="btn btn-primary set_value_exes_sql" id="{%name%}"><i class="fa fa-exchange"></i></button> 
            </span>
        </div>                                                
    </div>    
</div>
<hr />
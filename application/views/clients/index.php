<div class="ibox float-e-margins">    
    <div class="ibox-title collapse-link">
        <h5>Поисковая панель</h5>                    
        <div class="ibox-tools">
            <i class="fa fa-chevron-up"></i>                                                        
        </div>
    </div>
    
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a href="clients?edit=0" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Создать</a>
                                   
                <form method="get">
                    <div class="col-lg-3">
                        <label>Фамилия</label>                                 
                        <input type="text" name="lastname" placeholder="Введите фамилию" value="<?php if(count($_GET) > 0)echo $_GET["lastname"]; ?>" class="form-control input-sm">                                
                    </div>
                        
                    <div class="col-lg-3">
                        <label>Имя</label>                                 
                        <input type="text" name="firstname" placeholder="Введите имя" value="<?php if(count($_GET) > 0)echo $_GET["firstname"]; ?>" class="form-control input-sm">                                
                    </div>
                        
                    <div class="col-lg-3">
                        <label>Отчество</label>                                 
                        <input type="text" name="middlename" placeholder="Введите отчество" value="<?php if(count($_GET) > 0)echo $_GET["middlename"]; ?>" class="form-control input-sm">                                
                    </div>
                                                
                    <div class="col-lg-2">
                        <label>ИИН</label>                                 
                        <input type="text" name="iin" placeholder="Введите ИИН клиента" class="form-control input-sm" value="<?php if(count($_GET) > 0)echo $_GET["iin"]; ?>">                                
                    </div>
                                                                                                           
                    <div class="col-lg-1">
                        <label>&nbsp;</label>
                        <button type="submit" name="search" class="btn btn-primary btn-sm btn-block"><i class="fa fa-search"></i> Найти</button>                                                
                    </div>
                    
                </form>
                    
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Дата рождения</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if(isset($dan['dan'])){
                    foreach($dan['dan'] as $k=>$v){
                        echo '<tr class="sicid" id="'.$v['SICID'].'">
                            <td>'.$v['LASTNAME'].'</td>
                            <td>'.$v['FIRSTNAME'].'</td>
                            <td>'.$v['MIDDLENAME'].'</td>
                            <td>'.$v['BIRTHDATE'].'</td>
                        </tr>';
                    }
                    }
                ?>                                
                </tbody>
                </table>                        
            </div>
        </div>
    </div>
</div>

<div id="bottom_panels"></div>
                
<style>
table tbody tr{
    cursor: pointer;
}
</style>                
<script>
$('.sicid').click(function(){
    $('.sicid').removeClass('active');
    var id = $(this).attr('id');
    window.location.href = 'clients?view='+id;
    /*
    $.post(window.location.href, {"sicid":id}, function(data){        
        $('#'+id).attr('class', 'active sicid');
        $('#bottom_panels').html(data);        
    })
    */
})
</script>
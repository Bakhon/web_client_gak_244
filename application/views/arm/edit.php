<script>
function asfloat(val)
{    
    console.log(val);
    if($.isNumeric(val)){
        return val;
    }else{
        return 0;
    }    
}
</script>

<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Редактирвание отчета № <?php echo $dan['head']; ?></h5>
        </div>
        <div class="ibox-content" style="overflow: auto;">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-3">Дата</label>
                        <div class="col-lg-9">
                            <div class="input-group date col-lg-10">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="date_begin" id="date_otchet" class="form-control input-sm" data-mask="99.99.9999" value="<?php echo date('d.m.Y'); ?>">
                            </div>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Первый руководитель</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="main_ruk" value="<?php echo $dan['main_ruk']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Главный бухгалтер</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="gl_buh" value="<?php echo $dan['gl_buh']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Исполнитель</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="ispol" value="<?php echo $dan['ispol']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3">Телефон</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="num_phone" value="<?php echo $dan['num_phone']; ?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <br />
        
        <?php 
            echo $dan['html'];
        ?>
        </div>
    </div>
</div>    

<?php 
    echo $dan['js'];    
?>

<script>
    var j = JSON.parse(list_array);
    console.log(j);    
    for(var i=0;i<j.length;i++){
        var id = j[i].ID;
        var dan = j[i].DAN;
        $('#'+id).val(dan);
    }
    
    $('input').change();
</script>

<style>
input{
    min-width: 150px;
}
</style>

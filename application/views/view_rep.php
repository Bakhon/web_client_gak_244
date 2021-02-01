<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="pull-right" >
                    <input type="text" class="form-control isearch" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Найти"/>
                </div>
                <?php 
                    if(count($_GET) > 0){
                ?>
                <div class="pull-right" >
                    <a href="rep" class="btn btn-info"><i class="fa fa-close"></i> </a>
                </div>
                <?php }?>
                <h3>Список отчетов</h3>  
            </div>
            
            <div class="ibox-content">                                  
                <div id="jstree1">
                    <ul>
                    <?php 
                        foreach($rep->list_reports['reps_group'] as $k=>$v){
                            //echo '<li class="jstree-open">'.$k.'('.count($v).')'.'<ul>';
                            echo '<li class="jstree-closed">'.$k.'('.count($v).')'.'<ul>';
                            foreach($v as $t=>$d){
                                $ids = $d['ID'];
                                $name = $d['NAME'];
                                echo "<li onclick='get_report(".$ids.")' data-jstree='{".'"type":"report"'."}'>$ids - $name</li>";
                            }
                            echo '</ul></li>';
                        }
                        foreach($rep->list_reports['reps'] as $k=>$v){
                            echo "<li onclick='get_report(".$v['ID'].")' data-jstree='{".'"type":"report"'."}'>".$v['ID']." - ".$v['NAME']."</li>"; 
                        }
                        
                    ?>                     
                    </ul>
                </div>                
            </div>
            
        </div>
    </div>        
</div>

<div class="modal inmodal fade" id="report_param" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Параметры</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row" target="_blank" id="gen_report" method="get" action="rep">                                      
                    
                </form>                                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="start_excel">Сформировать в Excel</button>
                <button type="button" class="btn btn-success" id="start_report">Сформировать</button>
            </div>
        </div>
    </div>
</div>

<button data-toggle="modal" data-target="#report_param" id="view_modal" style="display: none;"></button>
<script>
function get_report(id){
    $.post(window.location.href, {"otchet_params": id}, function(data){
      // console.log(data);
       
       var j = JSON.parse(data);
       console.log(j);
       $('.modal-title').html(j.title);
       $('#gen_report').html(j.html_form);
       dateset();
       $('#view_modal').click();       
    });         
};
function dateset(){
    $('.input-group.date').datepicker({
        todayBtn: 'linked',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    }); 
}

$('#start_report').click(function(){
    //$('#gen_report').append('<input type="hidden" name="format" value="html">');
    $('#gen_report').submit();
    //$('.close').click();
});

$('#start_excel').click(function(){
    $('#gen_report').append('<input type="hidden" name="format" value="xls">');
    $('#gen_report').submit();
    //$('.close').click();
});

$('.isearch').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    
    if(keycode == '13'){
        var s = $(this).val();
        if(s == ""){
            alert("Пустая строка поиска")
            return;
        }
        location.href = "rep?search="+s;
    }
});

</script>
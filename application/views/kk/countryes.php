<?php
	$year = date("Y");
    $Year_now = $year;
    if($_GET['countryes'] !== ''){
        $Year_now = $_GET['countryes'];
    }
    $d1 = date("d.m.Y", strtotime('31.12.'.$Year_now));
?>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins"> 
                <div class="ibox-title">
                    <div class="pull-right" style="margin-right: 30px;">                        
                        <span class="label">Выберите год</span>
                        <select id="get_year">
                            <?php
                                for($i=2010;$i<=$year;$i++){
                                    $s = '';
                                    if($i == $Year_now){
                                        $s = 'selected';
                                    }
                                    echo '<option '.$s.' value="'.$i.'">'.$i.'</option>';
                                }                                                                
                            ?>                            
                        </select>
                    </div>                    
                    <h3>Таблица № 2 (риск по странам клиентов)</h3>
                    
                </div>                   
                <div class="ibox-content">
                    
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Страна</th>
                            <th>Кол-во договоров</th>
                            <th>Объем обязательств</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($kk->result as $k=>$v){
                        ?>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="<?php echo $v['ID']; ?>"><?php echo $v['NAME']; ?></a>
                            </td>
                            <td>
                                <center><?php echo $v['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($v['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="lists" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: auto;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Списочная часть</h4>
                <small class="font-bold" id="modal_title_text"></small>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#get_year').change(function(){
    var year = $(this).val();
    window.location.href = 'kk?countryes='+year;
});

$('.lists').click(function(){
    var id = $(this).attr('data');
    var text = $(this).html();
    var year = $('#get_year').val();
    
    $('#modal_title_text').html(text);
    $.post(window.location.href, {"countryes":year, "lists": id}, function(data){
        $('.modal-body').html(data);
    });
});
</script>


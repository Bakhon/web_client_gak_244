

<form class="form-horizontal" method="post" id="set_viplat_ns_form" enctype="multipart/form-data">
    <h3>Установите процент выплат по НС</h3>
    <div class="well">
    ФИО: <strong><?php echo $dan['client']['FIO']; ?></strong><br />
    Страховая сумма: <strong><?php echo NumberRas($dan['client']['STR_SUM']); ?> тг.</strong>
    </div>
    <table class="table table-nobordered">
    <thead>
        <tr>
            <th>Наименование</th>
            <th>% ставка</th>
            <th>Сумма выплат</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $proc = 0;
        $sum = 0;
        foreach($dan['ns'] as $k=>$v){
    ?>
        <tr>
            <td><?php echo $v['POKR_NAME'] ?></td>
            <td><input class="form-control procns procns_<?php echo $v['ID']; ?>" id="<?php echo $v['ID']; ?>" type="number" data="<?php echo $v['STR_SUM']; ?>" name="proc_ns[<?php echo $v['ID']; ?>]" value="<?php echo $v['NS_PROC'] ?>" /></td>
            <td><input class="form-control sumns sumns_<?php echo $v['ID']; ?>" id="<?php echo $v['ID']; ?>" type="number" data="<?php echo $v['STR_SUM']; ?>" name="sum_ns[<?php echo $v['ID']; ?>]" value="<?php echo $v['SUM_NS_PROC'] ?>" /></td>
        </tr>  
    <?php
        $proc += $v['NS_PROC'];
        $sum += $v['SUM_NS_PROC'];
        }
    ?>    
    </tbody>
    <tfoot>
        <tr>
            <th style="text-align: left;">Итого</th>
            <th style="text-align: left;" id="all_proc"><?php echo $proc; ?></th>
            <th style="text-align: left;" id="all_sum"><?php echo $sum; ?></th>
        </tr>
    </tfoot>
    </table> 
    
    <input type="hidden" name="set_viplat_ns" value="<?php echo $cnct; ?>"/>
    <input type="hidden" name="sicid" value="<?php echo $sicid; ?>"/>
</form>    


<script>
    $('body').on('change', '.procns', function(){
       var id = $(this).attr('id');
       var s = parseFloat($(this).attr('data'));
       var p = parseFloat($(this).val());
       var sum = 0;
       var all_sum = 0;
       var all_proc = 0;
       
       sum = s * (p / 100);
       
       //$('input[name=proc_ns['+id+']]').val(p);
       $('.sumns_'+id).val(sum);
       
       $('.procns').each(function(i, e){
          console.log(i+' - '+e);
          all_proc+= parseFloat(e.value);
       }); 
       $('.sumns').each(function(i, e){
          console.log(i+' - '+e);
          all_sum+= parseFloat(e.value);
       });   
       
       $('#all_proc').html(all_proc);
       $('#all_sum').html(all_sum);    
    });        
</script>
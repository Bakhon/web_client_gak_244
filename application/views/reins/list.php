<div class="ibox-title">
    <a href="reins?id=0" class="btn btn-info btn-xs pull-left"><i class="fa fa-plus"></i> Создать</a>    
    <h5 style="width: 70%; text-align: center;">Список перестраховщиков</h5>
    
</div>
<div class="ibox-content">             
    <table class="table table-bordered table-hover dataTables-example">
        <thead>
            <tr>
                <th>№ п\п</th>
                <th>№ договора</th>
                <th>Дата договора</th>
                <th>Полное наименование</th>
                <th>Краткое наименование</th>
                <th>З\Д</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reins->dan as $k=>$v){ 
                $s = '';
                if($v['ACTUAL'] == 2){
                    $s = '<span class="label label-danger">Заблокирован</span>';
                }else{
                    $s = '<span class="label label-primary">Действующий</span>';
                }
                echo '<tr>
                <td>'.$v['ID'].'</td>
                <td>'.$v['CONTRACT_NUM'].'</td>
                <td>'.$v['CONTRACT_DATE'].'</td>
                <td><a href="reins?id='.$v['ID'].'">'.$v['R_NAME'].'</a></td>
                <td><a href="reins?id='.$v['ID'].'">'.$v['R_NAME_KRAT'].'</a></td>
                <td>'.$s.'</td>
            </tr>';
                
            } ?>
        </tbody>        
    </table>
    
 </div>  
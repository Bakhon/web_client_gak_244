<table class="table table-hover" >
<thead>
<tr>
    <th>ФРАЗА</th>
    <th>Значение</th>
    <th>META</th>
</tr>
</thead>
<tbody>
<?php
    //print_r($list_meta);
    foreach($list_meta as $k => $v){
        ?>
        <tr class="gradeX">
            <td><?php echo $v['META']; ?></td>
            <td><?php echo $v['NAME_RU']; ?></td>
            <td><?php echo $v['VARIABLE']; ?></td>
        </tr>
        <?php
    }
?>
</tbody>
</table>
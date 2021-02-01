<form method="POST" id="setaddcontracts">
<input type="hidden" name="set_contract" value="<?php echo $dan['ID']; ?>"/>
<table class="table table-bordered">
<thead>
    <tr>
        <th>#</th>
        <th>№ и дата договора</th>
        <th>Страхователь</th>
        <th>Брутто</th>
        <th>Нетто</th>        
    </tr>
</thead>
<tbody>
    <?php foreach($dan['list'] as $k=>$v){ ?>
    <tr>
        <td><input type="checkbox" name="set_add_contracts[]" value="<?php echo $v['CNCT_ID']; ?>"/></td>
        <td><a href="contracts?CNCT_ID=<?php echo $v['CNCT_ID'] ?>" target="_blank"><?php echo $v['CONTRACT_NUM'].' '.$v['CONTRACT_DATE']; ?> г.</a></td>
        <td><?php echo $v['STRAHOVATEL']; ?></td>
        <td><?php echo $v['BRUTTO']; ?></td>
        <td><?php echo $v['NETTO']; ?></td>        
    </tr>
    <?php } ?>
</tbody>
</table>
</form>
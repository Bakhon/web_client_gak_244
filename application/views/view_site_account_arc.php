<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover" id="editable" >
                <thead>
                    <tr>
                        <th>AUTH_CODE</th>
                        <th>PASSWORD</th>
                        <th>PASS_WITHOUT_HASH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($listEmployee as $k => $v){
                    ?>
                    <tr class="gradeX">
                        <td><?php echo $v['AUTH_CODE'];?></td>
                        <td><?php echo $v['PASSWORD'];?></td>
                        <td><?php echo $v['PASS_WITHOUT_HASH'];?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>            
        </div>
    </div>
</div>
















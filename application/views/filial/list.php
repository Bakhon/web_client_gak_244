<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a></li>
                        <li><a href="#">Config option 2</a></li>
                    </ul>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Код</th>
                        <th>Подразделение</th>
                        <th>Руководитель</th>
                        <th>Доверенность</th>
                        <th>Адрес</th>
                        <th>Подразделение</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($dbFilials as $k=>$v){
                        echo '<tr class="gradeX" onclick="window.location.href='."'filial?rfbn_id=".$v['RFBN_ID']."'".'">
                            <td>'.$v['RFBN_ID'].'</td>
                            <td>'.$v['ASKO_NAME'].'</td>
                            <td>'.$v['NAME'].'</td>
                            <td>'.$v['BOSSNAME'].'</td>
                            <td>'.$v['DOCUM_RUS'].'</td>
                            <td>'.$v['ADDRESS_KZ'].'</td>                            
                        </tr>';
                    }
                    ?>
                    </tbody>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>

<div class="row">
                <div class="col-lg-12" id="osn-panel">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>МРСУ 2014(50%)</th>
                        <th>МРСУ 2015(30%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dbRegoins as $k=>$v){
                           echo '
                        <tr class="gradeX">
                            <td>'.$v['ID'].'</td>
                            <td>'.$v['RU_NAME'].'</td>
                            <td>'.$v['VID'].'</td>
                        </tr>
                    ';}?>
                    </tbody>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>

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
                        <th>Вид договора</th>
                        <th>Алм. область</th>
                        <th>г.Астана</th>
                        <th>Караганда</th>
                        <th>ВКО</th>
                        <th>Костанай</th>
                        <th>Тараз</th>
                        <th>Шымкент</th>
                        <th>Павлодар</th>
                        <th>Кокшетау</th>
                        <th>Петропавловск</th>
                        <th>Мангистаауская обл.</th>
                        <th>Кызылорда</th>
                        <th>Атырауская обл.</th>
                        <th>ЗКО</th>
                        <th>Темиртау</th>
                        <th>Актюбинская обл.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dbContrPref as $k=>$v){
                    echo '<tr class="gradeX">
                        <td>'.$v['VID_CONTRACT'].'</td>
                        <td>'.$v['F0600'].'
                        </td>
                         <td>'.$v['F1601'].'</td>
                        <td>'.$v['F0801'].'
                        </td>
                        <td>'.$v['F0500'].'
                        </td>
                        <td>'.$v['F1001'].'
                        </td>
                        <td>'.$v['F0301'].'
                        </td>
                        <td>'.$v['F1401'].'
                        </td>
                        <td>'.$v['F1201'].'</td>
                        <td>'.$v['F0101'].'
                        </td>
                         <td>'.$v['F1301'].'</td>
                        <td>'.$v['F1100'].'
                        </td>
                        <td>'.$v['F0901'].'
                        </td>
                        <td>'.$v['F0400'].'
                        </td>
                        <td>'.$v['F0700'].'
                        </td>
                        <td>'.$v['F0802'].'
                        </td>
                        <td>'.$v['F0200'].'
                        </td>
                    </tr>';}?>
                    </tbody>
                    </table>
                        </div>

                    </div>
                </div>
            </div>            
        </div>

<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins"> 
                <div class="ibox-title">                                    
                    <h3>Резиденты США</h3>
                    
                </div>                   
                <div class="ibox-content">
                    
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>№ п\п</th>
                            <th>№ договора</th>
                            <th>Дата договора</th>
                            <th>Предприятие</th>
                            <th>БИН</th>
                            <th>Дата начала</th>
                            <th>Дата окончания</th>
                            <th>Регион</th>
                            <th>Страна</th>                                                                                    
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php 
                            foreach($kk->result as $k=>$v){
                                $i = $k+1;
                             echo '
                             <tr>
                                <td>'.$i.'</td>
                                <td><a href="contracts?CNCT_ID='.$v['CNCT_ID'].'" target="_blank">'.$v['CONTRACT_NUM'].'</a></td>
                                <td>'.$v['CONTRACT_DATE'].'</td>
                                <td><a href="contragents?view='.$v['ID'].'" target="_blank">'.$v['NAME'].'</a></td>
                                <td>'.$v['BIN'].'</td>
                                <td>'.$v['DATE_BEGIN'].'</td>
                                <td>'.$v['DATE_END'].'</td>
                                <td>'.$v['REGION'].'</td>
                                <td>'.$v['COUNTRY'].'</td>
                             </tr>
                             ';   
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins">                         
                <div class="ibox-content">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>Ответственное подразделение</th>
                            <th>Файл</th>
                            <th>Коментарии</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <?php 
                        foreach($files as $k=>$v){
                            echo '<tr>
                                <td>'.$v['NAIMEN'].'</td>
                                <td>'.$v['OTVETSTV'].'</td>
                                <td>'.$v['FILENAME'].'</td>
                                <td>'.$v['NOTE'].'</td>
                                <tr></tr>
                            </tr>';
                        }                      
                        ?>
                    </tbody>
                    </table>
                    <!--
                    <form method="post">
                        <input type="file" style="display: none;" name="load_file"/>
                        <input type="hidden" name="id_files" value=""/>
                        <input type="hidden" name="paym_code" value=""/>
                        <input type="hidden" name="cnct_id" value=""/>
                        <a class="btn btn-info btn-xs">Загрузить</a>
                    </form>
                                                            
                    <form method="post">
                    
                    <input type="text" name="path_name"/>
                    <input type="submit" value="Создать папку"/>
                    </form>     
                    -->     
                </div>
            </div>
        </div>
    </div>
</div>        
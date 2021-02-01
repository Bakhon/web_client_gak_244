<?php
    $page_title = 'Справочник';
    $panel_title = 'Справочник агентов страховой задачи';
    
    $breadwin[] = 'Справочник';
    $breadwin[] = 'Справочник агентов страховой задачи'; 
  
    //Задаем первоначальные параметры SQL тескта
    $sql = "
             SELECT Nvl(Decode(a.vid, 1, lastname
                                        || ' '
                                        || firstname
                                        || ' '
                                        || middlename,
                                     a.org_name), ( Decode(a.vid, 5, lastname
                                                                     || ' '
                                                                     || firstname
                                                                     || ' '
                                                                     || middlename,
                                                                  a.org_name) )) l_name,
                   Agent_dop_reas_name(id_reason)
                   dop_reas_name,
                   Agent_state_name(a.state)                                     state_name,
                   Kur_name(manager_id)                                          kur_name,
                   Emp_name(empid)                                               emp_name,
                   Bank_name(a.bank_id)                                          bank_name,
                   Branch_name(a.branchid)                                       BRANCH_name
                   ,
                   Decode(a.vid, 1, 'Физ. лицо',
                                 2, 'ИП',
                                 3, 'Юр. лицо',
                                 5, 'Сотрудник')                        vid_name,
                   a.*
            FROM   agents a
            ";
   if(count($GETS) > 0){
   if(isset($GETS['firstnameStrahAgent'])){
         echo $GETS['firstnameStrahAgent'];
         $agentFirstname = $GETS['firstnameStrahAgent'];
         $nameStrahAgent = $GETS['nameStrahAgent'];
         $middlenameStrahAgent = $GETS['middlenameStrahAgent'];
         $sq1 = "
            WHERE  firstname LIKE '%$nameStrahAgent%'
            AND   lastname  LIKE '%$agentFirstname%'
            AND    middlename LIKE '%$middlenameStrahAgent%' ";
        if(trim($GETS['firstnameStrahAgent']) == ''){    
            $msg = ALERTS::ErrorMin('Фамилия не может быть пустой');
            function showStragentTable(){
                echo '<div class="content clearfix">
                                            <div aria-hidden="false" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0" class="step-content body current">
                                             <div class="text-center m-t-md">
                                                    <h2>Такого значения нет в базе</h2>
                                                    <p>
                                                        Введите данные в поля поиска
                                                    </p>
                                                    </div>
                                            </div>
                                          </div>';
            }
        }
        else{$db = new DB();
            $dbAgents = $db->Select($sql.$sq1);
            if(empty($dbAgents)){
                        $msg = ALERTS::ErrorMin('Ничего не найдено');
                        function showStragentTable(){
                        }
            }else{
            function showStragentTable(){
                                    global $dbAgents;
                                    echo '<table class="table table-striped table-bordered table-hover dataTables-example">
                                            <thead>
                                            <tr>
                                                    <th>Вид агента</th>
                                                    <th>ФИО/Наименование</th>
                                                    <th>Регион</th>
                                                    <th>Статус</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    foreach($dbAgents as $k => $v){
                                        echo '
                                            <tr class="gradeX">
                                                    <td>'.$v['VID_NAME'].'</td>
                                                    <td>'.$v['L_NAME'].'</td>
                                                    <td>'.$v['BRANCHID'].'</td>
                                                    <td>'.$v['STATE_NAME'].'</td>
                                            </tr>'
                                    ;}
                                    echo '</tbody>
                                    </table>';
                                    }
                
            }}   
        }
   
   if(isset($GETS['naimenivanye'])){
         echo $GETS['naimenivanye'];
         $agentNaimenivanye = $GETS['naimenivanye'];
         $sq1 = "
            WHERE a.org_name LIKE '%$agentNaimenivanye%' ";
        
        
        if(trim($GETS['naimenivanye']) == ''){    
            $msg = ALERTS::ErrorMin('Поле "наименование" не может быть пустым');
            function showStragentTable(){
                echo '<div class="content clearfix">
                                            <div aria-hidden="false" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0" class="step-content body current">
                                             <div class="text-center m-t-md">
                                                    <h2>Такого значения нет в базе</h2>
                                                    <p>
                                                        Введите данные в поля поиска
                                                    </p>
                                                    </div>
                                            </div>
                                          </div>';
            }
        }else{
            $db = new DB();
            $dbAgents = $db->Select($sql.$sq1);
            if(empty($dbAgents)){
                        $msg = ALERTS::ErrorMin('Ничего не найдено');
                        function showStragentTable(){
                        }
            }else{
            function showStragentTable(){
                                    global $dbAgents;
                                    echo '<table class="table table-striped table-bordered table-hover dataTables-example">
                                            <thead>
                                            <tr>
                                                    <th>Вид агента</th>
                                                    <th>ФИО/Наименование</th>
                                                    <th>Регион</th>
                                                    <th>Статус</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    foreach($dbAgents as $k => $v){
                                        echo '
                                            <tr class="gradeX">
                                                    <td>'.$v['VID_NAME'].'</td>
                                                    <td>'.$v['L_NAME'].'</td>
                                                    <td>'.$v['BRANCHID'].'</td>
                                                    <td>'.$v['STATE_NAME'].'</td>
                                            </tr>'
                                    ;}
                                    echo '</tbody>
                                    </table>';
                                    }
                
            }}     
   }
   
   
   if(isset($GETS['status'])){
         echo $GETS['status'];
         $agentFirstname = $GETS['status'];
         $sq1 = "
            WHERE state_name LIKE '%2%' ";
            
        $db = new DB();
        $dbAgents = $db->Select($sql.$sq1);   
   }
   
   if(isset($GETS['allNeeds'])){
         echo $GETS['allNeeds'];
         $agentFirstname = $GETS['allNeeds'];
         $sq1 = "
            WHERE state_name LIKE '%1%' ";
            
        $db = new DB();
        $dbAgents = $db->Select($sql.$sq1);   
   }
   }
   else {
        $msg = ALERTS::ErrorMin('Поля не заполнены');
        function showStragentTable(){
             echo '<div class="content clearfix">
                        <div aria-hidden="false" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0" class="step-content body current">
                         <div class="text-center m-t-md">
                                <h2>Введите данные</h2>
                                <p>
                                    Введите данные в поля поиска
                                </p>
                                </div>
                        </div>
                      </div>';
        }
   }
?>

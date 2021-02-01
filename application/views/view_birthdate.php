<div class="ibox-content" >
    <div class="ibox-title">
        <div class="ibox-tools">
            <form method="POST">
                <div class="row m-b-sm m-t-sm">
                <div class="col-md-2">
                 <label class="font-noraml">Выберите месяц</label>
                </div>
                    <div class="col-md-8">
                   
                              <select id="Month" name="Month" class="select2_demo_1 form-control">
                                       <option></option>
                                       <option value="1">Январь</option>
                                       <option value="2">Февраль</option>
                                       <option value="3">Март</option>
                                       <option value="4">Апрель</option>
                                       <option value="5">Май</option>
                                       <option value="06">Июнь</option>
                                       <option value="7">Июль</option>
                                       <option value="8">Август</option>
                                       <option value="9">Сентябрь</option>
                                       <option value="10">Октябрь</option>
                                       <option value="11">Ноябрь</option>
                                       <option value="12">Декабрь</option>                                             
                              </select>
                    </div>
                  
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Показать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
 <div  id ="table_with_data">  
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Дата рождения</th>
            <th>Департамент</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($list_person as $k => $v)
                {
                    $job_sp = $v['JOB_SP'];
                    $id = $v['ID'];
                    $branch_id = $v['BRANCHID'];
                    if($job_sp == '0') {
                            $sql_branch_name = "select NAME from DIC_BRANCH where RFBN_ID = $branch_id ";
                            $list_dep = $db->Select($sql_branch_name);
                    }
                    else {
                    $list_dep = $db->select("select * from dic_department where id = $job_sp");
                    }
                    
            ?>
            <tr>
                <td><?php echo $v['LASTNAME']; ?></td>
                <td><?php echo $v['FIRSTNAME']; ?></td>
                <td><?php echo $v['MIDDLENAME']; ?></td>
                <td><?php echo $v['BIRTHDATE']; ?></td>
                <td><?php echo $list_dep[0]['NAME']; ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>    
</div>
</div> 
<div hidden="">
            <form target="_blank" id="table_form" method="post" action="print_test">                
                                    <div id="head_of_doc" hidden="">
                        <div style="text-align: right;">
                                <div style="text-align: center;">
                                    <strong>
                                        <h3 style="color: #676a6c;">Список день рождений</h3>
                                    </strong>
                                </div>                               
                                <hr/>
                        </div>
                    </div>
<table class="table table-striped table-bordered table-hover" >
        <thead>
        <tr style="border: 1px solid;">
            <th >Фамилия</th>
            <th>Имя</th>
            <th >Отчество</th>
            <th >Дата рождения</th>
            <th >Департамент</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($list_person as $k => $v)
                {
                    $job_sp = $v['JOB_SP'];
                    $list_dep = $db->select("select * from dic_department where id = $job_sp");
                    
            ?>
            <tr >
                <td align="center"><?php echo $v['LASTNAME']; ?></td>
                <td align="center"><?php echo $v['FIRSTNAME']; ?></td>
                <td align="center"><?php echo $v['MIDDLENAME']; ?></td>
                <td align="center"><?php echo $v['BIRTHDATE']; ?></td>
                <td align="center"><?php echo $list_dep[0]['NAME']; ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table> 
    </div>   
                
                                 
                <textarea hidden="" name="content" id="area_for_print">
                </textarea>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <a id="submit_and_print" class="btn btn-primary pull-right">
                            <i class="fa fa-check-square-o"></i> 
                                Отправить на печать
                        </a>
                    </div>
                </div>
            </form>
         
            
            <script>
            
      $('#submit_and_print').click
    (function() 
        {
            var head_of_doc = $('#head_of_doc').html();                        
            var table_with_data = $('#table_with_data').html();
            $('#area_for_print').html(head_of_doc+table_with_data);
            $('#table_form').submit();
        }
    )
            
            </script>

<style>






</style>

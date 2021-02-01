<div class="mail-box-header">
                <h2>
                    Мои заявки 
                </h2>
                <hr />
                <div class="btn-group">
                    <button onClick="history.go(0)" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Обновить"><i class="fa fa-refresh"></i> Обновить</button>
                </div>
                
            </div>
<div class="mail-box">
                <div class="row">
                    <div class="col-lg-12" id="osn-panel">
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover" id="editable">
                                <thead>
                                <tr>
                                        <th>#</th>
                                        <th>ФИО Отправителя</th>
                                        <th colspan="2">Дата и время заявки</th>
                                        <th>Тип заявки</th>                    
                                        <th>Заголовок</th>
                                        <th>Короткое содержание</th>
                                        <th>Тип выполнения</th>                                      
                                        <th>ФИО исполнителя</th>
                                        <th colspan="2">Дата и время принятие заявки</th>
                                        <th>Дата и время завершения</th>
                                        <th>Дата и время подтверждения отправителем</th>                                          
                                </tr>                              
                                </thead>
                                <tbody>
                              <?php foreach($list_clauses as $k=>$v) {
                                $id_z = $v['AUTHOR'];
                                $id = $v['ID'];
                                $list_name = $db->Select("select * from sup_person where id = $id_z");
                    $state = $v['STATE'];
                    $prichina_obr = $v['PRICHINA_OBR'];
                    $list_prichina = $db->Select("select * from DIC_CAUSE where id = $prichina_obr");
                    $list_state = $db->Select("select * from DIC_STATE_CLAUSE where id = $state");
                    $list_executor = $db->Select("select * from executor_clauses where id_zayavka = $id");
              /*      $id_list_ex = $list_executor[0]['EMP_ID']; 
                    $list_exc = $db->Select("select * from sup_person where id = $id_list_ex"); */
                    ?>
                                    <tr class="read">
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $v['ID']; ?></a></td>
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $list_name[0]['LASTNAME'].' '.$list_name[0]['FIRSTNAME']; ?></a></td>
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $v['DATE_SEND']; ?></a></td>
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $v['TIME_SEND']; ?></a></td> 
                                        <td class="mail-сontact"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $list_prichina[0]['TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $v['HEAD_TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $v['SHORT_TEXT']; ?></a></td>
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $list_state[0]['TEXT']; ?></a></td>                                          
                                        <td class="mail-subject"><a href="zayavka?get_file=<?php echo $v['ID']; ?>"><?php if($list_executor[0]['EMP_ID']) { $id_list_ex = $list_executor[0]['EMP_ID'];                     
                    $list_exc = $db->Select("select * from sup_person where id = $id_list_ex"); }  if($id_list_ex) { echo $list_exc[0]['LASTNAME'].' '.$list_exc[0]['FIRSTNAME']; }?></a></td>                                         
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $list_executor[0]['DATE_RECEIP'] ?></a></td>   
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"><?php echo $list_executor[0]['TIME_RECEIP'];  ?></a></td> 
                                        <td class="mail-subject"><?php echo $list_executor[0]['DATE_END'].' '.$list_executor[0]['TIME_END'];  ?></td>
                                        <td class="mail-subject"><a href="zayavka_about?get_file=<?php echo $v['ID']; ?>"></a><?php if(!$v['DATE_CONFIRM']) { echo 'Не подверждено';} else { echo $v['DATE_CONFIRM'].' '.$v['TIME_CONFIRM'];} ?></td>  
                                                   
                                    </tr>
                                  <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
         </div>
         
         
         
<script>
    $('.set_reciep').click(function(){
        var id = $(this).attr('data');
        console.log(id);
        $.post(window.location.href, {"set_reciep":id}, function(data){            
           window.location.reload();            
        });
    })
    
      function download_file()
    {
        $.post
        ('download_ftp', 
        {"get_file" : 'get_file'}, 
        function(d){console.log(d);}
        )
    }
    
    
    
    
</script>

         
   <!--      
         <div class="mail-box-header">
                <h2>
                    Список заявок 
                </h2>
                <div class="btn-group">
                    <button onClick="history.go(0)" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Обновить"><i class="fa fa-refresh"></i> Обновить</button>
                </div>
                
            </div>
      <div class="mail-box-header">
        <div class="row"> 
         <div class="col-lg-12">    
                <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>ФИО Отправителя</th>
                    <th>Дата и время заявки</th>
                    <th>Тип заявки</th>                    
                    <th>Заголовок</th>
                    <th>Короткое содержание</th>
                    <th>Тип выполнения</th>
                    <th>Дата и время выполнения</th>
                    <th>Дата и время подтверждения отправителем</th>                    
                  </tr>
                </thead>
                <tbody>
                <?php foreach($list_clauses as $k=>$v) {
                    $state = $v['STATE'];
                    $prichina_obr = $v['PRICHINA_OBR'];
                    $list_prichina = $db->Select("select * from DIC_CAUSE where id = $prichina_obr");
                    $list_state = $db->Select("select * from DIC_STATE_CLAUSE where id = $state");
                    ?>
                <tr class="active" style="cursor: pointer;" onclick="window.location.href='index.php?zayavka=38'; return false">
                    <td><?php echo $v['ID']; ?></td>
                    <td><?php echo $v['AUTHOR']; ?></td>
                    <td><?php echo $v['DATE_SEND']; ?></td>
                    <td><?php echo $list_prichina[0]['TEXT']; ?></td>                   
                    <td><?php echo $v['HEAD_TEXT']; ?></td>
                    <td><?php echo $v['SHORT_TEXT']; ?></td>
                     <td><?php echo $list_state[0]['TEXT']; ?></td>
                    <td></td>   
                    <td></td>                                         
                    </tr>
                 <?php } ?>   
                    
                    
                    
                    
                    
                    
                    </tbody></table>
         </div>
       </div>
       </div>
       
       -->
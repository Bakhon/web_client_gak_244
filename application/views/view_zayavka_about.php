<div class="row">        
    <div class="col-lg-8">
        <div class="panel panel-default">
        <?php foreach($list_clauses as $k=>$v) { ?>
                <div class="panel-heading"><h4>Заявка #<?php echo $v['ID']; ?></h4></div>
                <div class="panel-body">
                  <table border=0 width=100%>
                    <tr>
                        <td><b>ФИО Отправителя:</b>&nbsp;<?php  echo $list_person[0]['LASTNAME'].' '.$list_person[0]['FIRSTNAME']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Отдел:</strong>&nbsp;<?php  echo $list_dep[0]['NAME']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>E-Mail:</strong>&nbsp;<?php echo $list_person[0]['EMAIL']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Телефон:</strong>&nbsp;<?php echo $list_person[0]['MOB_PHONE']; ?></td>
                        <td>
                            Внутренний: <br />
                            Городской: <br />
                            Сотовый:                        
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Тип Заявки:</strong>&nbsp;<?php  echo $list_condt[0]['TEXT'];  ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Дата и время отправки:</strong>&nbsp;<?php echo $v['DATE_SEND'].' '.$v['TIME_SEND']; ?></td>
                        <td></td>
                    </tr>  
                    <tr>
                        <td><strong>Комментарий исполнителя:</strong>&nbsp;<?php echo $list_executor[0]['TEXT']; ?></td>
                        <td></td>
                    </tr>                
                  </table>                  
                  
                </div>
                <?php } ?>
              </div> 
              
                <?php if($contents) { ?>            
              <div class="mail-box">
             
                    <div class="mail-attachment">  
                    
                    <h3>
                            <span class="font-noraml">Краткое описание: </span><?php echo $v['SHORT_TEXT']; ?>
                        </h3>         
                        <?php  ?>             
                        <div class="attachment">
                            <?php 
                                foreach($contents as $k => $c)
                                {
                                ?>
                                <div class="file-box">
                                    <div class="file">
                                        <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>">
                                            <span class="corner"></span>
                                            <div class="icon">
                                                <i class="fa fa-file"></i>
                                            </div>
                                            <div class="file-name">
                                                <a download href="ftp://upload:Astana2014@192.168.5.2/<?php echo $c; ?>" target="_blank"><?php $exp_str = explode('/', $c); echo $name_of_file = end($exp_str); ?></a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                </div>
                                <?php } ?>
                                
        </div>
    
    
      <?php foreach($list_clauses as $k=>$v) { if($v['SUCCESS'] == '1') { ?>
    <div class="col-lg-4">
    <form action="zayavka_about?get_file=<?php echo $v['ID']; ?>" method="post">
    <div class="panel panel-default">
        <input type="hidden" name="except_user_email" value="" />
        <input type="hidden" name="except_id_zayavka" value="<?php echo $v['ID']; ?>" />  
        <div class="panel-heading">Комментарий к исполнителю</div>
            <div class="panel-body">
                <textarea name="text" rows="5" wrap="virtual" maxlength="100" class="form-control"></textarea>                                
            </div>          
        <center><input type="submit" value="Подтвердить заявку" class="btn btn-success btn-lg btn-block"/></center>  
    </div>      
        </form>
        <br />
        
        <form action="" method="post" class="form-horizontal">
        <input type="hidden" name="error_user_email" value="" />
        <input type="hidden" name="error_id_zayavka" value="<?php echo $v['ID']; ?>" />   
        <br />             
        
        <div class="panel panel-default">
            <div class="panel-heading">Указать причину отклонения</div>
            <div class="panel-body">
                <textarea name="error_text" rows="5" wrap="virtual" maxlength="100" class="form-control"></textarea>                                
            </div>
            <input type="submit" value="Отклонить" class="btn btn-danger btn-block"/>
        </div>                          
        </form>
    </div>
    <?php } if($v['SUCCESS'] == '3') { ?>
    
    <div class="col-lg-4">
    <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title">Завершено</h3>
                </div>
                <div class="panel-body">
                  Дата и время выполнения:  <br />
                  <strong><?php echo $list_executor[0]['DATE_END'].' '.$list_executor[0]['TIME_END']; ?></strong><br />
                  ФИО Исполнителя: <br />
                  <b><?php echo $list_sp[0]['LASTNAME'].' '.$list_sp[0]['FIRSTNAME']; ?></b><br />
                  Дата и время подтверждения пользователем:       <br/>           
                  <strong><?php if(!$v['DATE_CONFIRM']) { echo 'Не подтвержден отправителем'; } else { echo $v['DATE_CONFIRM'].' '.$v['TIME_CONFIRM'];} ?></strong>
                                   
                  <br />
                  <strong>Комментарий исполнителя:</strong> <br />
                  <?php echo $list_executor[0]['TEXT']; ?>
                 
                  
                </div>
    </div>
   </div> 
    
    
    
    
    
    
   <?php } if($v['SUCCESS'] == '2') { ?>
  <div class="col-lg-4"> 
   <div class="panel panel-danger">
                <div class="panel-heading">
                  <h3 class="panel-title">Отклонено специалистом</h3>
                </div>
                <div class="panel-body">
                  ФИО Исполнителя: <br />
                  <b><?php echo $list_sp[0]['LASTNAME'].' '.$list_sp[0]['FIRSTNAME']; ?></b><br />  
                  Дата и время отклонения: <br />
                  <strong><?php echo $list_executor[0]['DATE_END'].' '.$list_executor[0]['TIME_END']; ?></strong><br />
                  <h4>Причина:</h4>
                  <p><?php echo $list_executor[0]['TEXT']; ?></p>                                    
                </div>
              </div>
   </div>
   
   
  <?php } ?> 
  
  
     <?php  if($v['SUCCESS'] == '4') { ?>
  <div class="col-lg-4"> 
   <div class="panel panel-danger">
                <div class="panel-heading">
                  <h3 class="panel-title">Отклонено</h3>
                </div>
                <div class="panel-body">
                  ФИО Исполнителя: <br />
                  <b><?php echo $list_sp[0]['LASTNAME'].' '.$list_sp[0]['FIRSTNAME']; ?></b><br />  
                  Дата и время отклонения: <br />
                  <strong><?php echo $v['DATE_CONFIRM'].' '.$v['TIME_CONFIRM']; ?></strong><br />
                  <h4>Причина:</h4>
                  <p><?php echo $v['TEXT_COMMENT']; ?></p>                                    
                </div>
              </div>
   </div>
   
   
  <?php }
  
  
  
  } ?>
    </div>
    
    
                                
                                
                                <script>
                                
                                   function download_file()
    {
        $.post
        ('download_ftp', 
        {"get_file" : 'get_file'}, 
        function(d){console.log(d);}
        )
    }
                                
                                
                                </script>
                                
                                <style>
                                
                                .file-box{
                                    margin-top: 19px;
                                    margin-left: -21px;
                                    width: 106%;
                                }
                                
                                .file .file-name{
                                    text-align: center;
                                }
                                
                                </style>
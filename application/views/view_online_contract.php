<script>
/*
$('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
});
*/
</script>
<div class="row wrapper wrapper-content">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-content">
               <div class="row">
                  <div class="col-lg-6">
                     <h4>
                        <?php echo $shep_requests_list[0]['ORGFULLNAMERU'].' ('.$shep_requests_list[0]['SURNAME'].' '.$shep_requests_list[0]['NAME'].' '.$shep_requests_list[0]['PATRONYMIC'].')'; ?>
                        <hr />
                        <?php
                            echo $state_label; 
                        ?>
                        <a data-toggle="modal" data-target="#create_contract" class="btn btn-xs btn-primary" type="submit"><i class="fa fa-plus"></i> Создать договор</a>
                    </h4>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tabs-container">
                        <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#tab-1"> Данные по Юр.лицу </a></li>
                           <li><a data-toggle="tab" href="#tab-2"> Данные по Физ.лицу </a></li>
                        <?php
                            $i = 1;
                            $z = 3;
                            foreach($shep_requests_list as $k => $v)
                            {
                                if($v['MESSAGETYPE'] == 'RESPONSE')
                                {
                                    echo "<li class=''><a data-toggle='tab' href='#tab-$z'> Ответ $i</a></li>";
                                    $i++;
                                    $z++;
                                }
                            }
                        ?>
                        </ul>
                        <div class="tab-content">
                           <div id="tab-1" class="tab-pane active">
                              <div class="panel-body">
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <input name="empIdTrivial" type="text" placeholder="" class="form-control" id="empIdTrivial" value="<?php echo $empId;?>" style="display: none;"/>
                                          <label class="font-noraml">Название организации</label>
                                          <input disabled="" name="LASTNAME" id="LASTNAME" type="text" placeholder="" class="form-control" value='<?php echo $shep_requests_list[0]['ORGFULLNAMERU'];?>'/>
                                       </div>
                                       <div hidden="" class="col-lg-3">
                                          <label class="font-noraml">emp_author_id</label>
                                          <input disabled="" name="AUTHOR_ID" id="AUTHOR_ID" type="text" placeholder="" class="form-control" value="<?php echo $emp_author_id;?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">ИИН/БИН</label>
                                          <input disabled="" name="FIRSTNAME" id="FIRSTNAME" type="text" placeholder="" class="form-control" value="<?php echo $shep_requests_list[0]['BIN']; ?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">ORGFORM</label>
                                          <input disabled="" name="IIN" id="IIN" type="text" placeholder="" class="form-control" value="<?php echo $shep_requests_list[0]['ORGFORM'];?>"/>
                                       </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <label class="font-noraml">FORMOFLAW</label>
                                          <input disabled="" name="LASTNAME2" id="LASTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['FORMOFLAW']; ?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">COMMERCEORG</label>
                                          <input disabled="" name="LASTNAME2" id="LASTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['COMMERCEORG']; ?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">TYPICALCHARTER</label>
                                          <input disabled="" name="FIRSTNAME2" id="FIRSTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['TYPICALCHARTER']; ?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                         <label class="font-noraml">OWNERSHIP</label>
                                         <input disabled=""  placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['OWNERSHIP']; ?>"/>
                                      </div>
                                    </div>
                                    <br />
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">ENTERPRISESUBJ</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['ENTERPRISESUBJ']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">PRIVATEENTERPRISETYPE</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['PRIVATEENTERPRISETYPE']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                              <label class="font-noraml">FOREIGNINVEST</label>
                                              <input disabled="" name="FIRSTNAME2" id="FIRSTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['FOREIGNINVEST'];?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">FOUNDERS</label>
                                             <input disabled="" placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['FOUNDERS']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">REGISTERINGDEPARTMENT</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['REGISTERINGDEPARTMENT']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">OKED</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['OKED']; ?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <br />
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">LEADERPERSON</label>
                                             <input disabled="" placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['LEADERPERSON']; ?>"/>
                                          </div>
                                          <div class="col-lg-6">
                                             <label class="font-noraml">ORGFULLNAMERU</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value='<?php echo $shep_requests_list[0]['ORGFULLNAMERU']; ?>'/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">ORGFULLNAMEKZ</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['ORGFULLNAMEKZ']; ?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <br />
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">ORGFULLNAMEEN</label>
                                             <input disabled="" placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['ORGFULLNAMEEN']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">JURADDRESS</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['JURADDRESS']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">ISREZIDENT</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['ISREZIDENT']; ?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <br />
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">INCCOUNTRY</label>
                                             <input disabled="" placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['INCCOUNTRY']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">REGDATE</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['REGDATE']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">AGENCY</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['AGENCY']; ?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <br />
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">ORGSHORTNAMERU</label>
                                             <input disabled="" placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['ORGSHORTNAMERU']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">ORGSHORTNAMEKZ</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['ORGSHORTNAMEKZ']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">ORGSHORTNAMEEN</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['ORGSHORTNAMEEN']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">BENEFICIARY</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['BENEFICIARY']; ?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <br />
                              </div>
                              <div class="modal-footer">
                                 <a id="checkTrivial" class="btn btn-success btn-sm demo2">Сохранить</a>
                              </div>
                           </div>
                           <div id="tab-2" class="tab-pane">
                              <div class="panel-body">
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="font-noraml">ФИО</label>
                                          <input disabled="" name="middlename" id="middlename" type="text" placeholder="" class="form-control" value="<?php echo $shep_requests_list[0]['SURNAME'].' '.$shep_requests_list[0]['NAME'].' '.$shep_requests_list[0]['PATRONYMIC'];?>"/>
                                       </div>
                                       <div hidden="" class="col-lg-3">
                                          <label class="font-noraml">emp_author_id</label>
                                          <input disabled="" name="AUTHOR_ID" id="AUTHOR_ID" type="text" placeholder="" class="form-control" value="<?php echo $emp_author_id;?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">ИИН/БИН</label>
                                          <input disabled="" name="FIRSTNAME" id="FIRSTNAME" type="text" placeholder="" class="form-control" value="<?php echo $shep_requests_list[0]['IIN'];?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">Дата рождения</label>
                                          <input disabled="" name="IIN" id="IIN" type="text" placeholder="" class="form-control" value="<?php echo $shep_requests_list[0]['BIRTHDATE'];?>">
                                       </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <label class="font-noraml">DOCUMENTS</label>
                                          <input disabled="" name="LASTNAME2" id="LASTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['DOCUMENTS'];?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">REMOVED</label>
                                          <input disabled="" name="LASTNAME2" id="LASTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['REMOVED'];?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                          <label class="font-noraml">MISSINGSTATUS</label>
                                          <input disabled="" name="FIRSTNAME2" id="FIRSTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['MISSINGSTATUS'];?>"/>
                                       </div>
                                       <div class="col-lg-3">
                                         <label class="font-noraml">EXCLUDESTATUS</label>
                                         <input disabled=""  placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['EXCLUDESTATUS']; ?>"/>
                                      </div>
                                    </div>
                                    <br />
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">Страна</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['COUNTRY']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">Город</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['DISAPPEARSTATUS']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                              <label class="font-noraml">ADDRESSES</label>
                                              <input disabled="" name="FIRSTNAME2" id="FIRSTNAME2" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['ADDRESSES'];?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                              <label class="font-noraml">PHONENUMBER</label>
                                              <input disabled="" name="PHONENUMBER" id="PHONENUMBER" type="text" class="form-control" value="<?php echo $shep_requests_list[0]['PHONENUMBER'];?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <div id="place_for_state_table">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <label class="font-noraml">NAMERU</label>
                                             <input disabled=""  placeholder="" class="form-control" id="BRANCHID" value="<?php echo $shep_requests_list[0]['NAMERU']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">Место рождения</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['ORGFULLNAMERU']; ?>"/>
                                          </div>
                                          <div class="col-lg-3">
                                             <label class="font-noraml">DISAPPEARSTATUS</label>
                                             <input disabled="" name="OKLAD" placeholder="" class="form-control" id="OKLAD" value="<?php echo $shep_requests_list[0]['DISAPPEARSTATUS']; ?>"/>
                                          </div>
                                       </div>
                                       <br />
                                    </div>
                                    <br />
                              </div>
                              <div class="modal-footer">
                                 <a id="checkTrivial" class="btn btn-success btn-sm demo2">Сохранить</a>
                              </div>
                           </div>
                           <?php
                                $i = 1;
                                $z = 3;
                                foreach($shep_requests_list as $k => $v)
                                {
                                    if($v['MESSAGETYPE'] == 'RESPONSE')
                                    {
                            ?>
                                <div id="tab-<?php echo $z; ?>" class="tab-pane">
                                  <div class="panel-body">
                                        <div class="row">
                                           <div class="col-lg-6">
                                              <label class="font-noraml">Дата ответа</label>
                                              <input disabled="" class="form-control" value="<?php echo $v['MESSAGEDATE'];?>"/>
                                           </div>
                                           <div class="col-lg-3">
                                              <label class="font-noraml">Статус</label>
                                              <input disabled="" name="FIRSTNAME" id="FIRSTNAME" type="text" placeholder="" class="form-control" value="<?php echo $v['STATE'];?>"/>
                                           </div>
                                           <div class="col-lg-3">
                                              <label class="font-noraml">Дата рождения</label>
                                              <input disabled="" name="IIN" id="IIN" type="text" placeholder="" class="form-control" value="<?php echo $v['BIRTHDATE'];?>"/>
                                           </div>
                                        </div>
                                        <br />
                                  </div>
                                  <div class="modal-footer">
                                     <a id="checkTrivial" class="btn btn-success btn-sm demo2">Сохранить</a>
                                  </div>
                               </div>
                            <?php
                                    $i++;
                                    $z++;
                                    }
                                }
                            ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- MODAL WINDOWS -->            
<div class="modal inmodal fade" id="create_contract" tabindex="-1" role="dialog"  aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Новый договор</h4>
         </div>
         <div class="modal-body">
            <form method="post">
                <div class="form-group" id="data_1">
                  <label class="font-noraml">Регион</label>
                  <select id="REGION" name="REGION" class="select2_demo_1 form-control chosen-select">
                     <option></option>
                     <?php
                        foreach($shep_region_list as $b => $s)
                        {
                     ?>
                        <option value="<?php echo $s['RFBN_ID']; ?>"><?php echo $s['RFBN_ID'].' - '.$s['NAME']; ?></option>
                     <?php 
                        }
                     ?>
                  </select>
               </div>
               <div class="form-group" id="data_1">
                    <label class="font-noraml">Агент</label>
                    <select id="AGENTS" name="AGENTS" class="select2_demo_1 form-control chosen-select">
                        <option></option>
                        <?php
                        foreach($shep_agents_list as $b => $s)
                            {
                         ?>
                            <option value="<?php echo $s['KOD']; ?>"><?php echo $s['NAME']; ?></option>
                         <?php
                            }
                         ?>
                    </select>
               </div>
               <div class="form-group" id="data_1">
                  <label class="font-noraml">Дата договора</label>
                  <div class="input-group date"> 
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" id="CONTRACT_DATE" name="CONTRACT_DATE" value="" data-mask="99.99.9999">
                    </div>                                    
               </div>
               
               <div class="form-group" id="data_1">
                  <label class="font-noraml">Номер договора</label>
                  <input name="contract_num" type="text" class="form-control" id="contract_num" value="" required=""/>
               </div>
               
               <div class="form-group" id="data_1">
                  <label class="font-noraml">Номер заявления</label>
                  <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="ZV_DATE" value="" data-mask="99.99.9999">
                    </div>
               </div>
               
               <div class="form-group" id="data_1">
                  <label class="font-noraml">Дата заявления</label>
                  <input name="ZV_NUM" type="text" class="form-control" id="ZV_NUM" value="" required=""/>
               </div>
               
               
               
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Сохранить</button>
         <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>
         </div>
         </form>
      </div>
   </div>
</div>

<script>

$('#CONTRACT_DATE').change(function(){
    var date = $(this).val();
    var region = $('#REGION').val();
    var id_agent = $('#AGENTS').val();
    console.log(region);
    console.log(id_agent);    
    
    if(region == ''){
        alert("Регион не выбран");
        return false;
    }
    
    if(id_agent == ''){
        alert("Агент не выбран");
        return false;
    }
    
    if($('#contract_num').val() == ''){
        $.post(window.location.href, {"gen_contract_num":"", "date":date, "region":region, "id_agent":id_agent}, function(data){
            console.log(data);
            var j = JSON.parse(data);
            $('#contract_num').val(j.CONTRACT_NUM);            
        })
    }
})

</script>
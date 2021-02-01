<div class="ibox-content" >
                                       <div class="row">
                                          <table class="table table-hover margin bottom" id="editEduTable">
                                             <thead>
                                                <tr>
                                                   <th class="text-center">ФИО</th>
                                                   <th class="text-center">Департамент</th>
                                                   <th class="text-center">Должность</th>
                                                   <th class="text-center">Подписант</th>
                                                </tr>
                                             </thead>
                                             <tbody id="place_for_holi2">
                                             <?php foreach($list_person as $k=>$v) { ?>
                                             <form method="POST">
                                                   <tr>
                                                      <td hidden=""><input class="ui-pg-input" name="PAYING_FOR_HELTH_YEAR" value="2019"></td>
                                                      <td class="text-center">2019</td>
                                                      <td class="text-center"><select name="PAYING_FOR_HELTH_STATE" class="select2_demo_1 ui-pg-input">
                                                                           <option></option>
                                                                           <option selected="" value="1">Использовано</option>
                                                                           <option value="0">Не использовано</option>
                                                                       </select></td>
                                                                       <td></td>
                                                       <td class="text-center"><select name="PAYING_FOR_HELTH_STATE" class="select2_demo_1 ui-pg-input">
                                                                           <option></option>
                                                                           <option selected="" value="1">Касимова Д</option>
                                                                           <option value="0">Амерходжаева Г</option>
                                                                       </select></td>
                                                      <td class="text-center small">
                                                         <div class="btn-group">
                                                            <button class="btn btn-xs btn-primary">Сохранить</button>
                                                         </div>
                                                      </td>
                                                   </tr>
                                              </form>  
                                           <?php } ?>                                                  </tbody>
                                          </table>
                                       </div>
                                    </div>
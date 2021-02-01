<?php 


  array_push($js_loader,
        'styles/js/inspinia.js',  
        'styles/js/plugins/pace/pace.min.js', 
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',     
        'styles/js/plugins/chosen/chosen.jquery.js',
        'styles/js/plugins/jsKnob/jquery.knob.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js',
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js',
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/Ilyas/edit_employees_js.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/demo/contracts_osns.js',
        'styles/js/plugins/sweetalert/sweetalert.min.js'
    );

    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',
        'styles/css/plugins/colorpicker/bootstrap-colorpicker.min.css',
        'styles/css/plugins/cropper/cropper.min.css',
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/jasny/jasny-bootstrap.min.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'styles/css/plugins/clockpicker/clockpicker.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css',
        'styles/css/animate.css'
    );






$db = new DB();

$sql_f = "select * from INSURANCE2.CORP_SAIT_FININDICATORS order by id ASC";
$list_f = $db->select($sql_f);

if($_POST['id'])
{
    $id = $_POST['id'];
    $sql_f = "select * from INSURANCE2.CORP_SAIT_FININDICATORS where id = $id order by id ASC";
    $list_f2 = $db->select($sql_f);
    
    if($id == '21')
    {
        foreach($list_f2 as $kk=>$vv){ }
        $html = '
         <div class="modal-body">';   
         
         $html .= '<input type="hidden" id="fdate" name="fdate" value="'.$vv['ID'].'" />';
 
                  
        $html .=  '<div class="form-group" id="data_1">            
               <label class="font-noraml">Дата финансового показателя</label>
               <div class="input-group date">
                  <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                  </span>
                  <input type="text" class="form-control dateOform" name="DATE_FIN" data-mask="99.99.9999" id="DATE_FIN" required="" value="'.$vv['DATE_FIN'];
                  
         $html .= '" />
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button id="" type="submit" class="btn btn-primary">Сохранить</button>
            <a type="button" class="btn btn-white" data-dismiss="modal">Закрыть</a>                  
         </div>';
         
         echo $html;
      
        exit;
    }
  
  else{
    foreach($list_f2 as $k=>$v){        
    }
            
    $html =  '<div class="modal-body">';     
    $html .= '<input type="hidden" id="id_fin" name="id_fin" value="'.$v['ID'];
    $html .= '" />';                                                           
                  $html .=  '<div class="form-group" id="data_1">
                        <label class="font-noraml">Заголовок(рус)</label>
                        <textarea style="height: 150px;" name="NAME_RU" class="form-control" id="NAME_RU">'.$v['NAME_RU'];
     $html .= '</textarea></div>';
     
     $html .= '<div class="form-group" id="data_1">
                        <label class="font-noraml">Заголовок(каз)</label>
                        <textarea style="height: 150px;" name="NAME_KAZ" class="form-control" id="NAME_KAZ">'.$v['NAME_KAZ'];
    $html .= '</textarea>
                    </div>
                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Показатели</label>
                        <small>(Напишите только показатель без слова тг)</small>
                        <textarea style="height: 150px;" name="TEXT_RU" class="form-control" id="TEXT_RU">'.$v['TEXT_RU'];
                        
   $html .= '</textarea>
                    </div>                                      
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                </div>';                        
     echo $html;                   
                        
    exit;
    }
}


if(isset($_POST['NAME_RU']))
{
    $fid = $_POST['id_fin'];
    $name_ru = $_POST['NAME_RU'];
    $name_kaz = $_POST['NAME_KAZ'];
    $text_ru = $_POST['TEXT_RU'];
    
    $sql = "UPDATE INSURANCE2.CORP_SAIT_FININDICATORS SET NAME_RU = '$name_ru', NAME_KAZ = '$name_kaz', TEXT_RU = '$text_ru' where id = $fid";
    $list = $db->execute($sql);
    header('location: corpsite_finindicators');
    
}


if(isset($_POST['fdate']))
{
    $fid = $_POST['fdate'];
    $DATE_FIN = $_POST['DATE_FIN'];
     

    
    $sql = "UPDATE INSURANCE2.CORP_SAIT_FININDICATORS SET DATE_FIN = '$DATE_FIN' where id = $fid";
    echo $sql;
    $list = $db->execute($sql);
    header('location: corpsite_finindicators');
    
}

?>
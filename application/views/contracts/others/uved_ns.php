<form class="form-horizontal" method="post" id="set_ns" enctype="multipart/form-data">
    <h3>Выберите причину наступления НС</h3>
    <?php 
        foreach($dan['spr_pokr_for_dogovors'] as $k=>$v){
            $s = '';
            foreach($dan['check']['pokr_ns'] as $t=>$d){
                if($d['ID_NS'] == $v['ID']){
                    $s = 'checked';
                }
            }
            echo '<label>
                <input type="checkbox" class="form-check doc_type_ns" name="ns_reason[]" pmain="'.$v['PMAIN'].'" id_type="'.$v['TYPE_NS_DOCS'].'" value="'.$v['ID'].'" '.$s.'/>
                '.$v['NAME'].'
            </label><br />';
        }
    ?>    
    
    <h3>Перечень документов</h3>
    <?php 
        foreach($dan['list_documents'] as $k=>$v){
            if($v['ID_TYPE'] == 0){
                $s = '';
                foreach($dan['check']['docs_ns'] as $t=>$d){
                    if($d['ID_FILE'] == $v['ID']){
                        $s = 'checked';
                    }
                }
                
                echo '<label>
                    <input type="checkbox" class="form-check" name="ns_doc[]" value="'.$v['ID'].'" '.$s.'/>
                    '.$v['NAME'].'
                </label><br />';
            }
        }
    ?>
    <div style="display: none;" id="doc_type_ns1">
        <h3>Дополнительный пакет документов при наступлении "Смерти" в результате НС</h3>
        <?php 
            foreach($dan['list_documents'] as $k=>$v){
                if($v['ID_TYPE'] == 1){
                    $s = '';
                    foreach($dan['check']['docs_ns'] as $t=>$d){
                        if($d['ID_FILE'] == $v['ID']){
                            $s = 'checked';
                        }
                    }
                    echo '<label>
                        <input type="checkbox" class="form-check" name="ns_doc[]" value="'.$v['ID'].'" '.$s.'/>
                        '.$v['NAME'].'
                    </label><br />';
                }
            }
        ?>
    </div>
    <div style="display: none;" id="doc_type_ns2">
        <h3>Дополнительный пакет документов при наступлении "Инвалидности" в результате НС</h3>
        <?php 
            foreach($dan['list_documents'] as $k=>$v){
                if($v['ID_TYPE'] == 2){
                    $s = '';
                    foreach($dan['check']['docs_ns'] as $t=>$d){
                        if($d['ID_FILE'] == $v['ID']){
                            $s = 'checked';
                        }
                    }
                    echo '<label>
                        <input type="checkbox" class="form-check" name="ns_doc[]" value="'.$v['ID'].'" '.$s.'/>
                        '.$v['NAME'].'
                    </label><br />';
                }
            }
        ?>
    </div>
    <div style="display: none;" id="doc_type_ns3">
        <h3>Дополнительный пакет документов при "Получении травны" в результате НС</h3>
        <?php 
            foreach($dan['list_documents'] as $k=>$v){
                if($v['ID_TYPE'] == 3){
                    echo '<label>
                        <input type="checkbox" class="form-check" name="ns_doc[]" value="'.$v['ID'].'"/>
                        '.$v['NAME'].'
                    </label><br />';
                }
            }
        ?>
    </div>
    
    <input type="hidden" name="set_ns_cnct" value="<?php echo $cnct; ?>"/>
    <input type="hidden" name="set_ns_id_annuit" value="<?php echo $id_user; ?>"/>
        
    <input type="file" class="btn btn-default" name="files_ns"/>
    <span class="text-danger">
    Соберите все необходимые документы в архив формата zip, rar, 7z и загрузите данный файл нажав на кнопку<br />
    В случае если не все галочки отмечены и собран не полный пакет документов, вы можете выполнять данныую процедуру неоднакратно  
    </span>
</form>

<script>
$('.doc_type_ns').each(function(){
   var s = $(this).prop('checked');
   if(s){
    var id = $(this).attr('id_type');
    $('#doc_type_ns'+id).css('display', 'block');
   } 
});
</script>
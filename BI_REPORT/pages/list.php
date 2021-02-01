<?php 
    $dst = date("Y");
    $dsd = date("m");        
?>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4>Фильтрация</h4>
            </div>
            <div class="ibox-content">
                <center><label id="filter_text"><?php echo $bi->result['active_filter']; ?></label></center>
                <?php
                    foreach($bi->result['filter'] as $o=>$t){
                        echo '<div class="jstree1"><ul><li class="jstree-open">'.$t['title'];
                        foreach($t['dan'] as $k=>$v){
                            echo '<ul>';
                            if(isset($v['ID'])){
                                echo '<li class="set_filter" data-jstree='."'".'{"type":"fl"}'."'".' data-filter="'.$o.'" data="'.$v['ID'].'">'.$v['NAME'].'</li>';
                            }else{                                                                            
                                $w = 'jstree';
                                if(trim($k) == $dst){$w = 'jstree-open';}
                                
                                echo '<li class="'.$w.'">'.$k.'<ul>';
                                
                                foreach($v as $i=>$s){
                                    $u = '';
                                    if(trim($k) == $dst){
                                        if($s['month'] == $dsd){
                                            $u = 'aria-selected="true"';
                                        }
                                    }
                                    echo '<li class="set_filter" data-jstree='."'".'{"type":"fl"}'."'".' data-filter="'.$o.'" data="'.$s['date'].'" '.$u.'>'.$s['month_name'].' '.$s['year'].'</li>';
                                }
                                echo '</ul>';
                            }
                            
                            echo '</ul>';
                        }
                        echo '</li></ul></div>';
                    }
                ?>                    
            </div>
        </div>
    </div>
    
    <div class="col-lg-9">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4></h4>
            </div>
            <div class="ibox-content">
                <pre>
                <?php             
                    print_r($bi->result);
                ?>
                </pre>
            </div>
        </div>
    </div>
</div>
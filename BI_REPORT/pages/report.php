<?php 
    $dst = date("Y");
    $dsd = date("m"); 
    $scripts = '';
    $css_link = array();
    $js_link = array();
?>
<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4 class="pull-left">Фильтрация</h4>                
                <a href="bi?report=<?php echo $bi->result['id_report']; ?>" class="btn btn-danger btn-xs pull-right" style="margin-left: 15px;" id="unset_filter"><i class="fa fa-close"></i></a>
                <button class="btn btn-success btn-xs pull-right" id="set_filter"><i class="fa fa-filter"></i> Фильтр</button>
            </div>
            <div class="ibox-content">
                <center>
                    <label id="filter_text"><?php echo $bi->result['active_filter']; ?></label>                    
                </center>
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
        <div class="tabs-container">
            <ul class="nav nav-tabs">
            <?php 
                $i = 0;
                foreach($bi->result['blocks'] as $k=>$block){
                    $activ = '';
                    if($i == 0){
                        $activ = 'active';
                    }
                    echo '<li class="'.$activ.'"><a data-toggle="tab" href="#tab-'.$k.'"> '.$block['title'].'
                    <button class="btn btn-default btn-xs view_other" data="tbs_charts_'.$k.'" id="tbs_tables_'.$k.'"><i class="fa fa-table"></i> Таблица</button>
                    </a>                    
                    </li>';
                    $i++;
                    
                    foreach($block['block'] as $k=>$v){
                        $js_load = explode(",", $v['chart']['LOAD_JS']);                    
                        $css_load = explode(",", $v['chart']['LOAD_CSS']);
                        
                        if(count($js_load) > 0){
                            $b = true;                            
                            for($i=0;$i<count($js_load);$i++){
                                if(array_key_exists($js_load[$i], $js_link) == false){
                                    array_push($js_link, $js_load[$i]);                                    
                                }
                                //echo '<script src="'.$js_load[$i].'"></script>';
                            }
                        }
                        
                        if(count($css_load) > 0){
                            for($i=0;$i<count($css_load);$i++){
                                if(array_key_exists($css_load[$i], $css_link) == false){
                                    array_push($css_link, $css_load[$i]);                                    
                                }
                                //echo '<link href="'.$css_load[$i].'" rel="stylesheet">';                            
                            }
                        }
                    }
                }
            ?>
            </ul>
            <?php 
                foreach($css_link as $c){
                    echo '<link href="'.$c.'" rel="stylesheet">';
                }
                foreach($js_link as $c){
                    echo '<script src="'.$c.'"></script>';
                }
            ?>
            
            <div class="tab-content">            
            <?php
            $i = 0;             
            foreach($bi->result['blocks'] as $b=>$block){
                $activ = '';
                if($i == 0){$activ = 'active';}
                
                echo '<div id="tab-'.$b.'" class="tab-pane '.$activ.'"><div class="panel-body">';                
                //echo '<h2><center>'.$block['title'].'</center></h2>';
                echo '<div class="tbs_charts_'.$b.'">';                                
                foreach($block['block'] as $k=>$v){                    
                    if(trim($v['chart']['CODE_START']) !== ''){
                        echo '<script>'.$v['chart']['CODE_START'].'</script>';
                    }
                    
                    echo '
                    <div class="col-lg-'.$v['LG_WIDTH'].'">
                        <div class="ibox float-e-margins" style="border: solid 1px #e7eaec;">
                            <div class="ibox-title">
                                <h4>'.$v['TITLE'].'</h4>                                
                            </div>
                            <div class="ibox-content" style="overflow: auto;">'.$v['chart']['HTML_FORM'].'</div>';
                            
                            $rd = rand(0, 1000000).date("Ymd");
                            if(trim($v['chart']['table']) !== ''){
                                echo '<div class="ibox-footer">
                                    <span class="btn btn-info btn-xs view_table" data="'.$rd.'"><i class="fa fa-table"></i></span>
                                '.$v['DESCS'].'
                                <div class="view_table" style="display: none;" id="'.$rd.'">'.$v['chart']['table'].'</div></div>';
                            }                            
                    echo '</div></div>';
                    
                    if(trim($v['chart']['CODE_END']) !== ''){
                        $scripts .= $v['chart']['CODE_END']."\r\n\t";
                        //echo '<script>'.$v['chart']['CODE_END'].'</script>';
                    }
                }
                echo '</div><div class="tbs_tables_'.$b.'" style="display: none; max-height: 50em; overflow: auto;">';                
                echo $block['all_dan'];
                echo '</div></div></div>';
                $i++;
            } 
        ?>
        </div>
        
        
        </div>
        
        <div class="row">
        
        </div>
        <pre>
        <?php             
            //print_r($bi->result);
        ?>
        </pre>
        
        <button type="button" style="display: none;" class="btn btn-primary" id="mdl_btn" data-toggle="modal" data-target="#mdl"></button>
        
        <div class="modal inmodal fade" id="mdl" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" style="width: 80%;">
                <div class="modal-content">                    
                    <div class="modal-body" id="mdl_text">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                        
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>
<script>
<?php 
    echo $scripts;
?>
</script>

<?php    
    $db = new DB3();     
    function chartname($id)
    {
        $name = '';
        switch ($id){
            case 0: $name = '';
                    break;
            case 1: $name = 'data-graph-container-before="1" data-graph-type="column"';
                    break;
            case 2: $name = 'data-graph-container-before="1" data-graph-type="line" data-graph-point-callback="callbackForPoint"';
                    break;
            case 3: $name = 'data-graph-container-before="1" data-graph-type="column"';
                    break;
            case 4: $name = 'data-graph-container-before="1" data-graph-type="column" data-graph-yaxis-1-stacklabels-enabled="1"';
                    break;
            case 5: $name = 'data-graph-container-before="1" data-graph-type="pie" data-graph-datalabels-enabled="1" data-graph-color-1="#999"';
                    break;                
        }
        return $name;            
    }
        
    $scripts = '';
    if($dan->chart !== '0'){        
        $scripts .= "$('.highchart_$dan->id').highchartTable()";
    }
    
    $param = array();
    foreach($dan->params as $k=>$v){
        if(substr($v->name, 0, 4) == 'name'){
            $param[$v->value] = array();
        }
    }
    
    foreach($dan->params as $k=>$v){
        $s = explode('[', $v->name);
        $t = $s[0];
        foreach($param as $ts=>$tt){
            if($v->name == $t."[$ts]"){
                $param[$ts][$t]=$v->value;
            }
        }
    }
    
    $params = array();
    foreach($param as $k=>$v){
        $params[$k] = $v['value'];
    }
    
    $q = array();    
    if(isset($dan->sql)){
        if($dan->sql !== ''){
            $q = $db->Select($dan->sql, $params);
            if(count($q) <= 0){
                $sqlls = $dan->sql;
                foreach($params as $a=>$w){
                    $sqlls = str_replace(':'.$a, "'".$w."'", $sqlls);
                }
                $q = $db->Select($sqlls, $params);                
            }            
        }
    }    
    
    $chartname = chartname($dan->chart);
    $view = '';
    if($dan->dont_view_table == true){
        $view = 'style="display: none;"';
    }
    echo '<table class="table table-bordered highchart_'.$dan->id.'" '.$chartname.' '.$view.'><thead>';
    
    foreach($dan->table->thead as $k=>$tr){
        echo '<tr>';
        foreach($tr as $t=>$td){
            $style = '';
            if(isset($td->style)){
                $style = $td->style;
            }
            
            echo '<th class="cl '.$td->col.' '.$td->row.'" style="'.$style.'">'.$td->text.'</th>';
        }        
        echo '</tr>';
    }
    echo '</thead><tbody>';
    
    if(count($q) > 0){
        //Перебираем строки с SQL запроса        
        foreach($q as $k=>$v){
            //Добавляем строки определяя значения
            foreach($dan->table->tbody as $k=>$tr){
                echo '<tr>';
                foreach($tr as $t=>$td){
                    $style = '';
                    if(isset($td->style)){
                        $style = $td->style;
                    }
                    $text = str_replace('{{', '', trim($td->text));
                    $text = str_replace('}}', '', $text);                    
                    echo '<td class="cl '.$td->col.' '.$td->row.'" style="'.$style.'">'.$v[$text].'</td>';
                }
                echo '</tr>';
            }
        }
    }
    
    echo '</tbody></table>';        
    echo '<input type="hidden" name="save_result_chart_block" value="'.htmlspecialchars(json_encode($dan)).'"/>';        
    if($scripts !== ''){
        echo '<script>'.$scripts.'</script>';        
    }
    
/*
    $('table.highchart').bind('highchartTable.beforeRender', function(event, highChartConfig) {
        highChartConfig.colors = ['#104C4C', '#88CCCC', '#228E8E', '#CCFFFF', '#00CCCC', '#3399CC'];
  }).highchartTable();
  */
?>

<button class="btn btn-default btn-xs pull-right" id="view_table"><i class="fa fa-table"></i></button>
<script>

</script>
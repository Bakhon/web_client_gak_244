<div class="row">
    <div class="col-lg-12" id="osn-panel">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <form method="POST">
                    <textarea name="sqltext" class="form-control"><?php echo trim($sqltext);?></textarea>
                    <input type="submit" class="btn btn-success" value="Выполнить SQL"/>
                </form>
            </div>
            <div class="ibox-content">
                <?php if(count($row) > 0){ ?>
                <div style="overflow: scroll; height: 400px; background-color: white;">
                    <table class="table table-bordered">
                    <tr>
                    <?php         
                        foreach($row[0] as $k=>$v){
                            echo "<th>$k</th>";
                        }
                    ?>
                    </tr>
                    <?php 
                        foreach($row as $k=>$v){            
                            echo "<tr>";
                            foreach($v as $c=>$r){
                                echo "<td>$r</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                    </table>
                </div>
                <?php                
                    }
                ?>            
            </div>
        </div>
    </div>
</div>

<pre>
<?php 
    echo $count_cols;
    print_r($list_columns);
?>
</pre>
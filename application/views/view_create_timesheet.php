
<div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="ibox-tools">
                <div class="row m-b-sm m-t-sm">
                <form method="POST">
                    <div class="col-md-3">
                        <dl class="dl-horizontal">
                            <dt>Год:</dt> 
                        <dd>
                        <select name="search_YEAR" id="search_YEAR" class="select2_demo_1 form-control" required/>
                        <?php
                            $YEAR = date("Y"); 
                            if(isset($create_year)){
                                $YEAR = trim($create_year);
                            }
                        ?>
                            <option></option>
                            <option <?php if($YEAR == '2014'){echo 'selected';}?>>2014</option>
                            <option <?php if($YEAR == '2015'){echo 'selected';}?>>2015</option>
                            <option <?php if($YEAR == '2016'){echo 'selected';}?>>2016</option>
                            <option <?php if($YEAR == '2017'){echo 'selected';}?>>2017</option>
                            <option <?php if($YEAR == '2018'){echo 'selected';}?>>2018</option>
                            <option <?php if($YEAR == '2019'){echo 'selected';}?>>2019</option>
                            <option <?php if($YEAR == '2020'){echo 'selected';}?>>2020</option>
                            <option <?php if($YEAR == '2021'){echo 'selected';}?>>2021</option>
                        </select>
                        </dd>
                        </dl>
                    </div>
                    <div class="col-md-3"> 
                        <dl class="dl-horizontal">
                            <dt>Месяц:</dt> 
                        <dd>
                        <select name="search_month" id="search_month" class="select2_demo_1 form-control" required/>
                            <option></option>
                        <?php
                            $month = trim($_POST['search_month']);
                            foreach($listMonth as $k => $v)
                            {
                                $s = '';
                                if(trim($v['ID']) == $month) {
                                    $s = "selected";
                                }
                                echo '<option value="'.$v['ID'].'" '.$s.'>'.$v['NAME'].'</option>';                        
                            }
                        ?>
                        </select>
                        </dd>
                        </dl>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                    <?php
                        if(isset($_POST['search_YEAR'])){
                            if(isset($_POST['search_month'])){
                                $create_year = $_POST['search_YEAR'];
                                $create_month = $_POST['search_month'];
                                $create_date = '.'.$create_month.'.'.$create_year;
                                ?>
                                    <a onclick="" class="btn-white btn btn-xs" data-toggle="modal" data-target="#addEmp">Задать параметры за <?php echo $create_month.'.'.$create_year; ?> года</a>
                                <?php
                            }
                        }
                        
                        //print_r($list_pers);
                        $i = 0;
                        foreach($list_pers as $k => $v){
                            echo $v['ID'].'/'.$v['STATE'].'<br>';
                            echo $i.'<br>';
                            create_other_table($create_date, $v['ID']);
                            $i++;
                        }
                        weekend($create_date);
                    ?>
                </div>
                </form>
            </div>
        </div>             
</div>
<script>
    function calc_day(){
        var i = 0;
        var z = 0;
        $('.state_sel option:selected').each(
            function(){
                var state = $(this).val();
                if($.isNumeric(state)){
                    var state_num = parseInt(state);
                    i += state_num;
                    z++;
                }
            });
            $('#DAY_COUNT').val(z);
            $('#TIME_COUNT').val(i);
        }
    $(document).ready(
        function(){
            calc_day();
        }
    )
</script>















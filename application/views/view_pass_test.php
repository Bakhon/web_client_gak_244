
<div class="row">
<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Список проектов</h5>           
        </div>
       <div class="ibox-content ibox-heading"></div>                               
        <?php foreach($list_project as $y => $z) 
              {
        ?>
         <p><a href="?=<?php echo $z['ID']; ?>"><?php echo $z['NAME']; ?></a></p>
            
        <?php } ?>
        </div>
      </div>  


    <div class="col-lg-8" id="osn-panel">
        <div class="ibox-content">
            <div class="">
                <?php 
                //echo '<pre>';
                //print_r($l_que);
                //echo '<pre>';
                foreach($l_que as $k => $v) 
                {
                    $q_id = $v['ID'];
                ?>
                <p>
                    <?php echo $v['QUESTION']; ?>
                </p>
                <?php
                    $options = "select * From RESULT_P where ID_QUESTION = $q_id";
                    $l_options = $db -> select($options);
                    foreach($l_options as $q => $r)
                    {
                ?>
                    <p class="">
                        <input type="radio" id="" name="<?php echo $r['ID_QUESTION']; ?>" value="" >
                        <label><?php echo $r['ANSWER']; ?></label>
                    </p>
                <?php
                    }
                ?>
                <hr />
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
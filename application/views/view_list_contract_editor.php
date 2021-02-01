<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <h2>Список видов договоров/дополнительных соглашений</h2>
            <?php foreach($list_contracts as $k=>$v){ ?>
            <div class="ibox float-e-margins border-bottom">
                <div class="ibox-title">               
                   <a href="type_contract_editor?id=<?php echo $v['ID']; ?>"><h5 style="margin-top: 5px; color:black;">
                        <?php echo $v['NAME']; ?>
                    </h5>
                    </a> 
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>


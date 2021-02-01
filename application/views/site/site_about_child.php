<?php
	$dan = $q[0];
?>

<div class="cnt">
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#tab_child_ru">Данные на русском</a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#tab_child_kz">Данные на казахском</a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#tab_child_en">Данные на английском</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="tab_child_ru" style="margin: 15px;">
            <label>Наименование</label>
            <input type="text" class="form-control" name="ITEM_NAME_RU" value="<?php echo $dan['ITEM_NAME_RU']; ?>"/>
            <iframe src="site_about?content=<?php echo $dan['ID']; ?>&lang=CONTENT_RU"></iframe>                                   
        </div>
        <div class="tab-pane" id="tab_child_kz" style="margin: 15px;">
            <label>Наименование</label>
            <input type="text" class="form-control" name="ITEM_NAME_KAZ" value="<?php echo $dan['ITEM_NAME_KAZ']; ?>"/>
            <div id="CONTENT_KAZ" class="well-cn" contenteditable=""><?php echo $dan['CONTENT_KAZ'] ?></div>
        </div>
        <div class="tab-pane" id="tab_child_en" style="margin: 15px;">
            <label>Наименование</label>
            <input type="text" class="form-control" name="ITEM_NAME_ENG" value="<?php echo $dan['ITEM_NAME_ENG']; ?>"/>
            <div id="CONTENT_ENG" class="well-cn" contenteditable=""><?php echo $dan['CONTENT_ENG'] ?></div>
        </div>
    </div>
</div>

<style>
.cnt{
    border:  solid 1px;
    min-height: 400px;
    position: relative;
    padding: 5px;
}

iframe{
    width: 100%;
    height: 600px;
}
.well-cn{
    margin-top: 15px;
}
</style>
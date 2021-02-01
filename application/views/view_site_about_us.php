<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                            <?php echo $list_prod[0]['PRODUCT_NAME']; ?>
                        </h2>
                        <label class="font-noraml">Пункт</label>
                        <select name="search_YEAR" class="form-control" onchange="javascript:handleSelect(this)">
                            <option></option>
                            <?php
                                foreach($list_about_us as $w => $q){
                            ?>
                            <option value="<?php echo $q['ID']?>" <?php if($item_id == $q['ID']){echo 'selected';}?>><?php echo $q['ITEM_NAME_RU']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <label class="font-noraml">Язык</label>
                        <select class="form-control" onchange="javascript:langSelect(this)">
                            <option></option>
                            <option value="KAZ" <?php if($item_lang == 'KAZ'){echo 'selected';}?>>Каз</option>
                            <option value="RU" <?php if($item_lang == 'RU'){echo 'selected';}?>>Рус</option>
                            <option value="ENG" <?php if($item_lang == 'ENG'){echo 'selected';}?>>Eng</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox-content">
                <form method="POST" style="background-color: white;">
                    <div class="row">
                        <div class="col-lg-3">
                            <label class="font-noraml">Название (каз)</label>
                            <input name="ITEM_NAME" id="ITEM_NAME" class="form-control" value="<?php echo $list_item[0]["ITEM_NAME_$item_lang"]; ?>" type="text"/><br /><br />
                        </div>
                    </div>
                    <textarea name="content" style="width: 100%;">
                    	<?php
                            echo $list_item[0]["CONTENT_$item_lang"];
                        ?>
                    </textarea>
                    <div class="mail-body text-right tooltip-demo">
                        <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="styles/js/others/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<script>
    function handleSelect(elm)
    {
        window.location = '?item_id='+elm.value+'&lang=<?php echo $item_lang; ?>';
    }
    
    function langSelect(lang)
    {
        window.location = '?item_id=<?php echo $item_id; ?>&lang='+lang.value;
    }
</script>
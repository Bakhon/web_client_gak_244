<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                            <?php echo $list_prod[0]['PRODUCT_NAME']; ?>
                        </h2>
                        <label class="font-noraml">Номер вкладки</label>
                        <select name="search_YEAR" class="form-control" onchange="javascript:handleSelect(this)">
                            <option></option>
                            <option value="1" <?php if($item_id == 0){echo 'selected';}?>>1</option>
                            <option value="3" <?php if($item_id == 2){echo 'selected';}?>>3</option>
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
                    <textarea name="content" style="width: 100%;">
                    	<?php
                            echo $list_item[$item_id]["CONTENT_$item_lang"];
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
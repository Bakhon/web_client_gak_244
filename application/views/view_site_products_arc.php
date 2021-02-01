<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                            Просмотр изменений
                        </h2>
                        <hr />
                        <select name="search_YEAR" class="form-control" onchange="javascript:handleSelect(this)">
                            <option></option>
                            <?php
                                foreach($list_all_prod as $w => $q){
                            ?>
                            <option value="<?php echo $q['ID']?>" <?php if($product_id == $q['ID']){echo 'selected';}?>><?php echo $q['PRODUCT_NAME_RU']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <table class="table table-hover">
                            <tbody>
                            <?php                             
                                foreach($list_prod_slider as $n=>$b){
                                    $id = $b['EMP_UPD'];
                                    $list_upd = $db->select("select * from sup_person where id = $id");
                            ?>
                            <tr>
                                <td class="col-sm-4">
                                    <div class="text-center">
                                        <img alt="image" class="img-responsive" src="<?php echo $b['IMG_BASE64']; ?>">
                                        <div class="m-t-xs font-bold"></div>
                                    </div>
                                </td>
                                <td class="project-title">
                                    <a><?php echo $b['SLIDE_TEXT_RU']; ?></a>
                                    <p><?php echo $b['SLIDE_SMALL_TEXT_RU']; ?></p>
                                    <br/>
                                    <a><?php echo $b['SLIDE_TEXT_KAZ']; ?></a>
                                    <p><?php echo $b['SLIDE_SMALL_TEXT_KAZ']; ?></p>
                                    <br />
                                    <a><?php echo $b['SLIDE_TEXT_ENG']; ?></a>
                                    <p><?php echo $b['SLIDE_SMALL_TEXT_ENG']; ?></p>
                                     <br />
                                     <p><label>Автор обновления:</label>
                                     <?php echo $list_upd[0]['LASTNAME'].' '. $list_upd[0]['FIRSTNAME']; ?></p>
                                     
                                     <p><label>Дата изменения:</label>
                                     <?php echo $b['DATA_UPD']; ?></p>
                                    
                                     <p><label>Время изменения:</label>
                                     <?php echo $b['TIME_UPD']; ?></p>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <form method="post">
                    <div class="project-list">
                        <h4>
                            Описание продукта
                        </h4>
                         
                        <h6>Рус</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ABOUT_PROD_RU" class="form-control" id="ABOUT_PROD_RU"><?php echo $list_prod[0]['ABOUT_PROD_RU']; ?></textarea>
                        </div>
                        <h6>Каз</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ABOUT_PROD_KAZ" class="form-control" id="ABOUT_PROD_KAZ"><?php echo $list_prod[0]['ABOUT_PROD_KAZ']; ?></textarea>
                        </div>
                        <h6>Англ</h6>
                        <div class="form-group" id="data_1">
                            <textarea style="height: 150px;" name="ABOUT_PROD_ENG" class="form-control" id="ABOUT_PROD_ENG"><?php echo $list_prod[0]['ABOUT_PROD_ENG']; ?></textarea>
                        </div>
                        <p><label>Автор обновления:</label>
                                    <?php $id = $list_prod[0]['EMP_UPD']; $list = $db->select("select * from sup_person where id = $id"); echo $list[0]['LASTNAME'].' '.$list[0]['FIRSTNAME'];  ?>
                                    </p>
                                    <p><label>Дата обновления:</label>
                                    <?php echo $list_prod[0]['DATE_UPD']; ?>
                                    </p>
                                    <p><label>Время обновления:</label>
                                    <?php echo $list_prod[0]['TIME_UPD']; ?>
                                    </p>
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>
                            <?php
                                foreach($list_accord as $n=>$b){
                                    $id_upd = $b['EMP_UPD'];
                                    $list_upd = $db->select("select * from sup_person where id = $id_upd");
                            ?>
                            <tr>
                                <td class="project-title">
                                    <a><?php echo $b['ITEM_TITLE_RU']; ?></a>
                                    <p><?php echo $b['ITEM_TEXT_RU']; ?></p>
                                    <br/>
                                    <a><?php echo $b['ITEM_TITLE_KAZ']; ?></a>
                                    <p><?php echo $b['ITEM_TEXT_KAZ']; ?></p>
                                    <br/>
                                    <a><?php echo $b['ITEM_TITLE_ENG']; ?></a>
                                    <p><?php echo $b['ITEM_TEXT_ENG']; ?></p>
                                    <br/>
                                    <p><label>Автор обновления:</label>
                                    <?php echo $list_upd[0]['LASTNAME'].' '.$list_upd[0]['FIRSTNAME']; ?>
                                    </p>
                                    <p><label>Дата обновления:</label>
                                    <?php echo $b['DATA_UPD']; ?>
                                    </p>
                                    <p><label>Время обновления:</label>
                                    <?php echo $b['TIME_UPD']; ?>
                                    </p>
                                    <small></small>
                                </td>                              
                            </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function handleSelect(elm)
    {
        window.location = '?product_id='+elm.value;
    }
</script>




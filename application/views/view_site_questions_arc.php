<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                           Просмотр историй изменений
                        </h2>
                        <table class="table table-hover">
                            <tbody>
                            <?php
                                foreach($list_slider as $k => $v){
                                    $id = $v['EMP_UPD'];
                                    $list_upd = $db->select("select * from sup_person where id = $id");
                            ?>
                            <tr>
                                <td class="col-sm-4">
                                    <div class="text-center">
                                        <img alt="image" class="img-responsive" src="<?php echo $v['IMG_BASE64']; ?>" style="width: 100%; height: 100%; max-width: 300px;"/>
                                    </div>
                                </td>
                                <td class="project-title">
                                    <a href="project_detail.html"><?php echo $v['ITEM_NAME_KAZ']; ?></a>
                                    <br/>
                                    <small><?php echo $v['CONTENT_KAZ']; ?></small><br /><br />
                                    <a href="project_detail.html"><?php echo $v['ITEM_NAME_RU']; ?></a>
                                    <br/>
                                    <small><?php echo $v['CONTENT_RU']; ?></small><br /><br />
                                    <a href="project_detail.html"><?php echo $v['ITEM_NAME_ENG']; ?></a>
                                    <br/>
                                    <small><?php echo $v['CONTENT_ENG']; ?></small><br />
                                    <br />
                                    <label>Автор обновления:</label>
                                    <small><?php echo $list_upd[0]['LASTNAME'].' '.$list_upd[0]['FIRSTNAME']; ?></small><br />                                
                                    <label>Дата изменения:</label>
                                    <small><?php echo $v['DATE_UPD']; ?></small><br />
                                    <label>Время изменения:</label>
                                    <small><?php echo $v['TIME_UPD']; ?></small><br />
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


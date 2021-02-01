<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="project-list">
                        <h2>
                            Просмотр истории измений
                        </h2>                       
                        <table class="table table-hover">
                            <tbody>
                            <?php
                                foreach($list_slider as $k => $v){
                                    $id = $v['EMP_UPD'];
                                    $list_upd = $db->select("select * from sup_person where id=$id");
                            ?>
                            <tr>
                                <td class="col-sm-4">
                                    <div class="text-center">
                                        <img alt="image" class="img-responsive" src="<?php echo $v['IMG_BASE64']; ?>" style="width: 100%; height: 100%; max-width: 300px;"/>
                                    </div>
                                </td>
                                <td class="project-title">
                                    <a href="project_detail.html"><?php echo $v['NEWS_TITLE_KAZ']; ?></a>
                                    <br/>
                                    <small><?php echo $v['NEWS_TEXT_KAZ']; ?></small><br /><br />
                                    <a href="project_detail.html"><?php echo $v['NEWS_TITLE_RU']; ?></a>
                                    <br/>
                                    <small><?php echo $v['NEWS_TEXT_RU']; ?></small><br /><br />
                                    <a href="project_detail.html"><?php echo $v['NEWS_TITLE_ENG']; ?></a>
                                    <br/>
                                    <small><?php echo $v['NEWS_TEXT_ENG']; ?></small><br />
                                    <br/>
                                    <label>Опубликован на главной странице:</label>
                                    <b><?php if($v['IS_MAIN'] == 0) {echo 'нет';} else {echo 'да';} ?></b>
                                    <br />
                                    <label>Автор изменения:</label>                                    
                                    <b><?php echo $list_upd[0]['LASTNAME'].' '.$list_upd[0]['FIRSTNAME']; ?></b><br />
                                    <label>Дата изменения:</label>
                                    <?php echo $v['DATE_UPD'];?><br />
                                    <label>Время изменения:</label>
                                    <?php echo $v['TIME_UPD']; ?><br />
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








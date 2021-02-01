<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    Отправить на ознакомление
                </h2>
            </div>
                <div class="mail-box">
                    <div class="mail-body">
                    <form enctype="multipart/form-data" class="form-horizontal" method="POST">                                                
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">Destination</label>
                            <div class="col-sm-10">
                                <input value="1" class="form-control" id="DESTINATION" name="DESTINATION" required=""/>
                            </div>
                        </div>
                        <div hidden="" class="form-group"><label class="col-sm-2 control-label">статус:</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="0" id="STATE" name="STATE" value="1"/>
                            </div>
                        </div>
                       <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель email:</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_mail; ?>" id="SENDER_MAIL" name="SENDER_MAIL" required="" readonly=""/></div>
                    </div>
                    <div hidden="" class="form-group"><label class="col-sm-2 control-label">Отправитель email:</label>
                        <div class="col-sm-10"><input class="form-control" value="<?php echo $emp_fio; ?>" id="SENDER" name="SENDER" required="" readonly=""/></div>
                    </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Получатель:</label>
                            <div class="col-sm-10">
                                <select name="RECIPIENT[]" data-placeholder="Несколько получателей..." class="chosen-select col-lg-12" multiple tabindex="4" required="">
                                    <option></option>
                                    <?php
                                        foreach($list_persons as $k => $v)
                                        {
                                    ?>
                                        <option value="<?php echo $v['EMAIL']; ?>"><?php echo $v['FIO']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

           
                            
                    </div>
                    <div class="mail-attachment">
                        <div class="attachment">
                            <?php
                                
                                    foreach($contents as $k => $v)
                                    {
                                    ?>
                                    <div class="file-box">
                                        <div class="file">
                                            <a href="ftp://upload:Astana2014@192.168.5.2/<?php echo $v; ?>">
                                                <span class="corner">
                                                </span>
                                                <div class="icon">
                                                    <i class="fa fa-file">
                                                    </i>
                                                </div>
                                                <div class="file-name">
                                                    <a href="ftp://upload:Astana2014@192.168.5.2/<?php echo $v; ?>" target="_blank"><?php echo $v; ?>
                                                    </a>
                                                    <br/>
                                                    <small>Added: Jan 11, 2014</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                
                            ?>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                    <div class="mail-body">
                        <button type="submit" onclick=""  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Отправить"><i class="fa fa-reply"></i> Отправить</button>
                    </div>
                    <input name="CREATE_MAIL" value="test" style="display: none;"/>
                    
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

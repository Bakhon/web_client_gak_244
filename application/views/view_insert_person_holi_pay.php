<div class="row">
    <div class="col-lg-12 fadeInRight">
        <div class="mail-box-header">
            
            <h2>
                Добавить период лечебного пособия на определенного человека
            </h2>
        </div>
            <div class="mail-box">
                <div class="mail-body">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Сотрудник:</label>
                            <div class="col-sm-10">
                                <select name="CREATE_TABLE_FOR_ONE_PERS_ID" data-placeholder="" class="chosen-select col-lg-12" multiple tabindex="4" required="">
                                    <option></option>
                                    <?php
                                        foreach($list_persons as $k => $v){
                                    ?>
                                        <option value="<?php echo $v['ID']; ?>"><?php echo $v['FIO'].' - ' .$v['D_NAME'].' ('.$v['DEP_NAME'].')'; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Период</label>
                            <div class="col-sm-10">                               
                                    <select name="period" data-placeholder="" class="chosen-select col-lg-12" multiple tabindex="4" required="">
                                     <option value="2019">2019</option>
                                     <option value="2020">2020</option>
                                    </select>                                                                
                            </div>
                        </div>
                </div>
                <div class="mail-body">
                    <button type="submit" onclick=""  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Добавить"> Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

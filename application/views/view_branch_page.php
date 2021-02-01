<?php
    foreach($list_dep as $k => $v)
    {
?>
<div class="row wrapper wrapper-content">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                    <form method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <select id="dep_select" class="select2_demo_1 form-control chosen-select">
                                <?php
                                    foreach($list_branch_list as $x=>$q)
                                    {
                                ?>
                                    <option <?php if($branch_id == $q['RFBN_ID']){echo 'selected';}?> value="<?php echo $q['RFBN_ID']; ?>"><?php echo $q['NAME'].' ('.$q['RFBN_ID'].')'; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <script>
                                $('#dep_select').change
                                (
                                    function()
                                    {
                                        var branch_id = $('#dep_select').val();
                                        $(location).attr('href','branch_page?branch_id='+branch_id);
                                    }
                                )
                            </script>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12">
                                <input name="branch_id" type="text" placeholder="" class="form-control" id="branch_id" value="<?php echo $branch_id;?>" style="display: none;">
                                <label class="font-noraml">Название (каз)</label>
                                <input disabled="" name="NAME_KAZ" id="NAME_KAZ" type="text" placeholder="" class="form-control" value='<?php echo $v['NAME_KZ']; ?>'/>
                            </div>
                            <div class="col-lg-12">
                                <label class="font-noraml">Название</label>
                                <input disabled="" name="NAME" id="NAME" type="text" placeholder="" class="form-control" value='<?php echo $v['NAME'];?>'/>
                            </div>
                            <div hidden="" class="col-lg-12">
                                <input name="DIC_DEPARTMENT" id="DIC_DEPARTMENT" type="text" placeholder="" class="form-control" value="test"/>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary col-lg-12">Изменить название</button>
                            </div>
                        </div>
                    </form>
                    <hr />
                    <form method="POST">
                    <h4>Назначить директора</h4>
                    <div class="row">
                        <input name="branch_id" type="text" placeholder="" class="form-control" id="branch_id" value="<?php echo $branch_id; ?>" style="display: none;"/>
                        <div class="col-lg-12">
                            <select name="DIRECTOR_ID" id="DIRECTOR_ID" class="select2_demo_1 form-control chosen-select">
                                <option></option>
                            <?php
                                foreach($list_pers as $k=>$v)
                                {
                            ?>    
                                <option <?php if($list_dep[0]['CHIEF_ID'] == $v['ID']){echo 'selected';}?> value="<?php echo $v['ID']; ?>"><?php echo $v['FIO']; ?></option>
                            <?php
                                }
                            ?>
                            </select>                            
                        </div>
                        <div hidden="" class="col-lg-3">
                            <label class="font-noraml">ID</label>
                            <input name="ID" id="ID" type="text" placeholder="" class="form-control" value="<?php echo $list_dep[0]['ID_CHIEF_TABLE']; ?>"/>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary col-lg-12">Назначить</button>
                        </div>
                    </div>
                    <hr />
                    <h4>Назначить заместителя</h4>
                    <div class="row">
                        <input name="branch_id" type="text" placeholder="" class="form-control" id="branch_id" value="<?php echo $branch_id;?>" style="display: none;"/>
                        <div class="col-lg-12">
                            <select name="DEPUTY_ID" id="DEPUTY_ID" class="select2_demo_1 form-control chosen-select">
                                <option></option>
                            <?php
                                foreach($list_pers as $k=>$v)
                                {
                            ?>
                                <option <?php if($list_dep[0]['ID_DEPUTY'] == $v['ID']){echo 'selected';}?> value="<?php echo $v['ID']; ?>"><?php echo $v['FIO']; ?></option>
                            <?php
                                }
                            ?>
                            </select>                            
                        </div>
                        <div hidden="" class="col-lg-3">
                            <label class="font-noraml">ID</label>
                            <input name="ID" id="ID" type="text" placeholder="" class="form-control" value="<?php echo $list_dep[0]['ID_DEPUTY']; ?>"/>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary col-lg-12">Назначить</button>
                        </div>
                    </div>
                    </form>
                    <hr />
            </div>
        </div>
    </div>
</div>
<?php
    }
?>

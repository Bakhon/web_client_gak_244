<div class="row wrapper wrapper-content">
    <div class="row">
       <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins">    
                <div class="ibox-title collapse-link">
                    <h5>Поисковая панель</h5>
                    <div class="ibox-tools">
                        <i class="fa fa-chevron-up"></i></span>                                
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4">                                    
                                <div class="col-sm-12 b-r">
                                <div class="ibox-content">
                                    <h3 class="m-t-none m-b" id="contrTable">Поиск по ФИО</h3>
                                    <form role="form" method="get" class="form-horizontal" >
                                        <div class="form-group">
                                            <label class="col-lg-3">Фамилия</label>
                                            <div class="col-lg-9"> 
                                                <input type="text" name="clientLastname" placeholder="Введите фамилию" value="<?php echo SetTextGetArray("clientLastname"); ?>" class="form-control input-sm">
                                            </div>
                                        </div>
                                
                                        <div class="form-group">
                                            <label class="col-lg-3">Имя</label> 
                                            <div class="col-lg-9">
                                                <input type="text" name="clientFirstname" placeholder="Введите имя" value="<?php echo SetTextGetArray("clientFirstname"); ?>" class="form-control input-sm">
                                            </div>
                                        </div>
                                
                                        <div class="form-group">
                                            <label class="col-lg-3">Отчество</label> 
                                            <div class="col-lg-9">
                                                <input type="text" name="clientMiddlename" placeholder="Введите отчество" value="<?php echo SetTextGetArray("clientMiddlename"); ?>" class="form-control input-sm">
                                            </div>
                                        </div>
                                                                           
                                        <div class="form-group">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-9">
                                                <input type="submit" class="btn btn-primary btn-sm btn-block" value="Найти">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="m-t-none m-b">Поиск по ИИН</h3>
                                    <form role="form" action="" method="get">                                
                                        <div class="form-group">                                    
                                            <div class="input-group">
                                                <input type="text" name="iin" placeholder="Введите ИИН клиента" class="form-control input-sm">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                </span>    
                                            </div>                                    
                                        </div>                               
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            showTable();
                        ?>
                        </div>
                     </div>
                </div>
                <div id="bottom_panels">
                    <!-- here content -->    
                </div>
           </div>           
           </div>
        </div>
<script>
$('#client_dan tr').click(function(){
    var tr = $(this);
    $('.gradeX').attr('class', 'gradeX');
    tr.attr('class', 'gradeX active');
    var s = tr.attr('data');
    $.post('search_clients', {"sicid":s}, function(d){     
        $('#bottom_panels').html(d);
    });    
    console.log($(this).attr('data'));
    });
</script>
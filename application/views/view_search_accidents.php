<div class="row wrapper wrapper-content">
    <div class="row">
       <div class="col-lg-12" id="osn-panel">
            <div id="search_panel_bottom" class="ibox float-e-margins">
                <div class="ibox-title collapse-link">
                    <h5>Поисковая панель</h5>
                    <div class="ibox-tools">
                        <i class="fa fa-chevron-up"></i></span>                                
                    </div>
                </div>
                <div id="search_panel" class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">  

                            <div class="tabs-container">
                            <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1"> По ФИО</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2"> Поиск по наименованию страхователя</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3"> Поиск по статусу уведомления</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-4"> Поиск по номеру договора ОСНС</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-5"> Причина</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-6"> Дата регистрации уведомления</a></li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="col-sm-12 b-r">
                                        <h3 class="m-t-none m-b" id="contrTable">Поиск по ФИО</h3>
                                            <div class="form-group">
                                                <label class="col-lg-3">Фамилия</label>
                                                <div class="col-lg-9"> 
                                                    <input type="text" id="clientLastname" name="clientLastname" placeholder="Введите фамилию" value="<?php echo SetTextGetArray("clientLastname"); ?>" class="form-control input-sm">
                                                </div>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label class="col-lg-3">Имя</label> 
                                                <div class="col-lg-9">
                                                    <input type="text" id="clientFirstname" name="clientFirstname" placeholder="Введите имя" value="<?php echo SetTextGetArray("clientFirstname"); ?>" class="form-control input-sm">
                                                </div>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label class="col-lg-3">Отчество</label> 
                                                <div class="col-lg-9">
                                                    <input type="text" id="clientMiddlename" name="clientMiddlename" placeholder="Введите отчество" value="<?php echo SetTextGetArray("clientMiddlename"); ?>" class="form-control input-sm">
                                                </div>
                                            </div>
                                                            
                                            <div class="form-group">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-9">
                                                    <button type="button" id="searchBtn" class="btn btn-primary btn-sm btnForCollapse">Найти</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('.btnForCollapse').click(
                                        function(){
                                            $('#search_panel').css('display', 'none');
                                            $('#search_panel_bottom').addClass('border-bottom');
                                        }
                                    )
                                </script>
                                 <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="col-sm-12 b-r">
                                            <h3 class="m-t-none m-b">Поиск по наименованию страхователя</h3>
                                                <div class="form-group">                                    
                                                    <div class="input-group">
                                                        <input type="text" name="iin" placeholder="Введите наименование страхователя" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                        </span>    
                                                    </div>                                    
                                                </div>                               
                                            </div>
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="col-sm-12 b-r">
                                            <h3 class="m-t-none m-b">Поиск по статусу</h3>
                                                <div class="form-group">                                    
                                                    <div class="input-group">
                                                        <select id="docStatus" class="form-control input-sm" name="search_state">
                                                            <option value="0">Завленный, но неурегулированный убыток</option>
                                                            <option value="1">Пакет дкоументов собран частично</option> 
                                                            <option value="2">Собран полный пакет документов</option> 
                                                            <option value="3">Поставлен на выплату</option>
                                                            <option value="4">Отказ</option>
                                                            <option value="5">Оплачен</option> 
                                                            <option value="6">Восстановление трудоспособности</option> 
                                                        </select>                                         
                                                        <span class="input-group-btn">
                                                            <button id="docStateSubm" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                        </span>    
                                                    </div>                                                                
                                                </div>                                                                 
                                        </div>
                                    </div>
                                </div>
                                 <script>
                                    $('#docStateSubm').click(function(){
                                        event.preventDefault();
                                            var docStatus = $('#docStatus').val();
                                            $.post('search_accidents', {"docStatus":docStatus
                                                                    }, function(d){     
                                                $('#placeForTable').html(d);
                                            });
                                    });
                                </script>
                                <div id="tab-4" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="col-sm-12 b-r">
                                            <h3 class="m-t-none m-b">Поиск по номеру договора ОСНС</h3>
                                                <div class="form-group">                                    
                                                    <div class="input-group">
                                                        <input type="text" name="docNum" id="docNum" placeholder="Введите номер договора ОСНС" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button id="docNumSearch" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                        </span>    
                                                    </div>                                    
                                                </div>                               
                                            </div>
                                    </div>
                                </div>
                                <script>
                                    $('#docNumSearch').click(function(){
                                        event.preventDefault();
                                            var docSearchNum = $('#docNum').val();
                                            $.post('search_accidents', {"docSearchNum":docSearchNum
                                                                    }, function(d){     
                                                $('#placeForTable').html(d);
                                            });
                                    })
                                </script>
                                <div id="tab-5" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="col-sm-12 b-r">
                                            <h3 class="m-t-none m-b">Причина</h3>
                                                <div class="form-group">                                    
                                                    <div class="input-group">
                                                        <select id="docReason" class="form-control input-sm" name="search_state">
                                                        <option value="1">Профессиональное заболевание</option>
                                                        <option value="2">Смерть</option>
                                                        <option value="3">Трудовое увечье</option>                                       
                                                        </select>                                         
                                                        <span class="input-group-btn">
                                                            <button id="docReasonBtn" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                                                        </span>    
                                                    </div>                                                                
                                                </div>                                                                 
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('#docReasonBtn').click(function(){
                                        event.preventDefault();
                                            var docReason = $('#docReason').val();
                                            $.post('search_accidents', {"docReason":docReason
                                                                    }, function(d){     
                                                $('#placeForTable').html(d);
                                            });
                                    })
                                </script>
                                <div id="tab-6" class="tab-pane">
                                    <div class="panel-body">
                                                <div class="col-sm-12">                
                                                    <h3 class="m-t-none m-b">Поиск по дате регистрации договора</h3>                    
                                                    <!--<h4>Дата начала и конца договора</h4>-->     
                                                    <div class="input-group">                      
                                                        <div id="reportrange" class="form-control input-sm">
                                                            <i class="fa fa-calendar"></i>
                                                            <span></span> 
                                                            <b class="caret"></b>
                                                            <input id="date_begin_doc" type="hidden" name="date_begin" value=""/>
                                                            <input id="date_end_doc" type="hidden" name="date_end" value=""/>
                                                        </div>
                                                        <span class="input-group-btn">
                                                            <button id="search_with_date" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                        </span>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                                <script>
                                    $('#search_with_date').click(function(){
                                        event.preventDefault();
                                            var date_begin_doc = $('#date_begin_doc').val();
                                            var date_end_doc = $('#date_end_doc').val();
                                            $.post('search_accidents', {"date_begin_doc":date_begin_doc,
                                                                        "date_end_doc": date_end_doc
                                                                    }, function(d){
                                                $('#placeForTable').html(d);
                                            });
                                    })
                                </script>
                            </div>
                        </div>
                        </div>
                                
                        </div>
                        </div>
                     </div>
                </div>  
           </div>
        </div>
        
        <div class="row">
       <div class="col-lg-12" id="neosn-panel">
            <div id="search_panel_bottom" class="ibox float-e-margins">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="placeForTable">
                                
                            </div>
                        </div>

                        </div>
                </div>
                        <div class="ibox float-e-margins" id="bottom_panels">
                            
                        </div>  
           </div>
        </div>
<script>
    $('#searchBtn').click(
        function(){
            var secondName = $('#clientLastname').val();
            var firstName = $('#clientFirstname').val();
            var middleName = $('#clientMiddlename').val();
            $.post('search_accidents', {"secondName":secondName,
                                        "firstName":firstName,
                                        "middleName":middleName
                                        }, function(d){     
                    //var j = JSON.parse(d);
                    //console.log(d);
                    
                    $('#placeForTable').html(d);    
                });
        }
    )
</script>

                <div class="col-lg-6">
                    <div class="tabs-container">



                    </div>
                </div>
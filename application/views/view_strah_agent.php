<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
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
                                    <h3 class="m-t-none m-b">Поиск по ФИО</h3>
                                    <form role="form" method="get" class="form-horizontal" >
                                        <div class="form-group">
                                            <label class="col-lg-3">Фамилия</label>
                                            <div class="col-lg-9"> 
                                                <input type="text" name="firstnameStrahAgent" placeholder="Введите фамилию" value="<?php echo SetTextGetArray("firstnameStrahAgent"); ?>" class="form-control input-sm">
                                            </div>
                                        </div>
                                
                                        <div class="form-group">
                                            <label class="col-lg-3">Имя</label> 
                                            <div class="col-lg-9">
                                                <input type="text" name="nameStrahAgent" placeholder="Введите имя" value="<?php echo SetTextGetArray("nameStrahAgent"); ?>" class="form-control input-sm">
                                            </div>
                                        </div>
                                
                                        <div class="form-group">
                                            <label class="col-lg-3">Отчество</label> 
                                            <div class="col-lg-9">
                                                <input type="text" name="middlenameStrahAgent" placeholder="Введите отчество" value="<?php echo SetTextGetArray("middlenameStrahAgent"); ?>" class="form-control input-sm">
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
                                    <h3 class="m-t-none m-b">Поиск по наименованию</h3>
                                    <form role="form" action="" method="get">                                
                                        <div class="form-group">                                    
                                            <div class="input-group">
                                                <input type="text" name="naimenivanye" placeholder="Введите наименование" class="form-control input-sm">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                </span>    
                                            </div>                                    
                                        </div>                               
                                    </form>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="m-t-none m-b">По статусу</h3>
                                    <form class="m-t" role="form" method="get">
                                        <div class="form-group">      
                                            <div class="input-group">              
                                                <select class="form-control input-sm"  name="status">
                                                    <option value="-1">---  Пусто</option>
                                                    <option value="0">0 - На разработке</option>
                                                    <option value="1">1 - Отправлен в ДП</option>
                                                    <option value="2">2 - Возвращен на доработку</option>
                                                    <option value="3">3 - Соответсвует</option>
                                                    <option value="4">4 - Не соответствует</option>
                                                    <option value="5">5 - Отправить на обучение</option>
                                                    <option value="6">6 - Прошел обучение</option>
                                                    <option value="7">7 - Оформлен</option>
                                                    <option value="8">8 - На рассторжение</option>
                                                    <option value="9">9 - Расторжение оформлено ДП</option>
                                                    <option value="10">10 - Расторгнут</option>
                                                    <option value="11">11 - Закрыт</option>
                                                    <option value="12">12 - Отправлено лиректору ДП</option>                                                                      
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                </span>  
                                            </div>                                       
                                        </div>
                                            <div class="i-checks"><label> <input type="checkbox" name="allNeeds" value="01"> <i></i>Все требующие рассмотрения</label></div>                
                                    </form>                            
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8">
                            <div class="ibox-content">
                                <div class="form-horizontal">
                                        
                                        <?php 
                                        showStragentTable();
                                        
                                        ?>
                                        
                                </div>
                            </div>
                        </div>
                                        
                        </div>        
                </div>
                </div></div></div>
                <div class="row">
                    
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                
                                <div class="ibox-content">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Договор №</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Дата заключения</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Дата окончания</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Дата окончания</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-6" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Статус</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-6" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Отделение</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-6" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Куратор</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-6" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Территория</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>           
                                            </div>               
                                        </div>
                                    <div class="ibox-content">
                                    <div class="row">
                                                <div class="col-lg-6" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Адрес физ.</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">РНН</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Тел/факс</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                 <div class="col-lg-6" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Адрес юр.</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">БИН</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Email</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                 <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Руководитель</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title"></strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title"></strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title"></strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                    </div>
                                    </div>
                                    <div class="ibox-content">
                                    <div class="row">
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Пенсионный аннуитет</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">ОСОР</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">ОСНС</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                 <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">ИИК</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-6" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Банк</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Тип счета</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                 <div class="col-lg-3" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Счет</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                <div class="col-lg-4" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Дата закрытия договора</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                                 <div class="col-lg-8" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Причина</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                    </div>
                                    </div>
                                    <div class="ibox-content">
                                    <div class="row">
                                                <div class="col-lg-12" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Причина отклонения</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                    </div>
                                    </div>
                                    <div class="ibox-content">
                                    <div class="row">
                                                <div class="col-lg-12" title="text">
                                                     <strong data-toggle="tooltip" data-placement="buttom" title="title">Причина отклонения</strong><br>
                                                     <div class="formForData">Test</div>
                                                </div>
                                    </div>
                                    </div>
                                    <!-- -->
                                   <div class="tabs-container">
                                        
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#viewInOtherRegion">Видимость в другом регионе</a></li>
                                                <li class=""><a data-toggle="tab" href="#data">Данные</a></li>
                                            </ul>
                                            <div class="tab-content ">
                                                <div id="viewInOtherRegion" class="tab-pane active">
                                                    <div class="panel-body">
                                                        <!--nestable list-->
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="ibox ">
                                                                            <div class="ibox-title">
                                                                                <h5>Список филиалов</h5>
                                                                            </div>
                                                                            <div class="ibox-content">
                                                    
                                                                                <p  class="m-b-lg">
                                                                                    Выберите филиалы и перенесите в правую часть
                                                                                </p>
                                                    
                                                                                <div class="dd" id="nestable">
                                                                                    <ol class="dd-list">
                                                                                        <li class="dd-item" data-id="2">
                                                                                            <div class="dd-handle">г. Астана головной офис</div>
                                                                                        </li>
                                                                                        <div class="dd-handle">г. Астана департамент продаж</div>
                                                                                        <li class="dd-item" data-id="5">
                                                                                            <div class="dd-handle">г. Аксай региональное подразделение</div>
                                                                                        </li>
                                                                                        <li class="dd-item" data-id="5">
                                                                                            <div class="dd-handle">г. Алматы бывший головной офис</div>
                                                                                        </li>
                                                                                    </ol>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="ibox ">
                                                                            <div class="ibox-title">
                                                                                <h5>Видимость для других филиалов</h5>
                                                                            </div>
                                                                            <div class="ibox-content">
                                                                                <p class="m-b-lg">
                                                                                    Список филиалов в которых будет доступен этот документ
                                                                                </p>
                                                                                <div class="dd" id="nestable2">
                                                                                    <ol class="dd-list">
                                                                                       <li class="dd-item" data-id="5">
                                                                                            
                                                                                        </li>
                                                                                    </ol>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!--nestable list finish-->
                                                    </div>
                                                </div>
                                                <div id="data" class="tab-pane">
                                                    <div class="panel-body">
                                                            <div class="row">
                                                                    <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">ФИО</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title"></strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title"></strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                     <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Дата рождения</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-6" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Адрес физ.</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">ИИН</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                     <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">РНН</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-6" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Адрес юр.</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                     <div class="col-lg-6" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Email</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Телефон</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                     <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Документ об отсутствии судимости</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">от</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                     <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Свидетельство о прохождениии обучения №</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                    <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Дата начала действия</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                                     <div class="col-lg-3" title="text">
                                                                         <strong data-toggle="tooltip" data-placement="buttom" title="title">Дата окончания</strong><br>
                                                                         <div class="formForData">Test</div>
                                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                        
                                    </div>
                                    <!-- -->
                                </div>
                            </div>
                        </div>
                    </div>                    
                                </div>
        </div>
        

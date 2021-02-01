<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox <?php //echo $colaps; ?> float-e-margins">
                <div class="ibox-title collapse-link">
                    <h5>Поисковая панель</h5>
                    <div class="ibox-tools">
                        <span><i class="fa fa-chevron-up"></i></span>                                
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="col-sm-6 b-r">
                                <div class="ibox-content">
                                    <h3 class="m-t-none m-b">Поиск по ФИО</h3>
                                    <form method="get" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-3">Фамилия</label>
                                            <div class="col-lg-9"> 
                                                <input type="text" name="lastname" placeholder="Введите фамилию" class="form-control input-sm" value="<?php echo SetTextGetArray("lastname"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3">Имя</label> 
                                            <div class="col-lg-9">
                                                <input type="text" name="firstname" placeholder="Введите имя" class="form-control input-sm" value="<?php echo SetTextGetArray("firstname"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3">Отчество</label> 
                                            <div class="col-lg-9">
                                                <input type="text" name="middlename" placeholder="Введите отчество" class="form-control input-sm" value="<?php echo SetTextGetArray("middlename"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-3"></div>                                     
                                            <div class="col-lg-9 ">
                                                <label class="col-lg-12"><input type="radio" name="sicid" value="id_annuit" checked/> По аннуитету</label>                                        
                                                <label class="col-lg-12"><input type="radio" name="sicid" value="ID_paym" /> По получателю</label>
                                                <label class="col-lg-12"><input type="radio" name="sicid" value="ID_BREAD_WIN" /> По УК</label>
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
                            </div>
                            <div class="col-sm-6 b-r">  
                                <div class="ibox-content">
                                    <h3 class="m-t-none m-b">Поиск по договору</h3>
                                    <form role="form" action="" method="get">                                
                                        <div class="form-group">                                    
                                            <div class="input-group">
                                                <input type="text" name="contract_num" placeholder="Введите номер договора" class="form-control input-sm" value="<?php echo SetTextGetArray("contract_num"); ?>">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                </span>    
                                            </div>                                    
                                        </div>
                                    </form>
                                </div>
                        
                                <div class="ibox-content">
                                    <h3 class="m-t-none m-b">Поиск по страхователю договоров ОСНС</h3>
                                    <form role="form" action="" method="get">
                                        <div class="form-group">                                    
                                            <div class="input-group">
                                                <input type="text" name="search_insur" placeholder="'Название фирмы' (Пример)" class="form-control input-sm" value="<?php echo SetTextGetArray("search_insur"); ?>">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                                </span>    
                                            </div>                                    
                                        </div>                                                                 
                                    </form>
                                </div>
                                <div class="ibox-content">
                                        <h3 class="m-t-none m-b">Поиск по договорам участвующих в расчете</h3>
                                        <form class="m-t" role="form" method="get">
                                            <div class="form-group">      
                                                <div class="input-group">              
                                                    <select class="form-control input-sm"  name="raschet_state">
                                                        <option value="-1">---  Все</option>
                                                        <option value="0">0 - Расчет на подготовке</option>
                                                        <option value="1">1 - Расчет направлен в УА</option>
                                                        <option value="2">2 - Расчет отклонен  УА</option>
                                                        <option value="3">3 - Расчет утвержден УА</option>                                                                    
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary btn-sm" id="searchWithDateButton"><i class="fa fa-search"></i></button>                                            
                                                    </span>  
                                                </div>                                       
                                            </div>                
                                        </form>                            
                                    </div>
                            </div>            
                        </div> 
                
                        <div class="col-lg-5">        
                            <div class="ibox-content">
                                <form method="get">                        
                                    <div class="col-sm-7">                
                                        <h3 class="m-t-none m-b">Поиск по дате и виду договора</h3>                    
                                        <!--<h4>Дата начала и конца договора</h4>-->     
                                        <div class="input-group">
                                                                                                
                                            <div id="reportrange" class="form-control input-sm">
                                                <i class="fa fa-calendar"></i>                                    
                                                <span><?php echo SetTextGetArray("date_begin")." - ".SetTextGetArray("date_end"); ?></span> 
                                                <b class="caret"></b>
                                                <input type="hidden" name="date_begin" value="<?php echo SetTextGetArray("date_begin"); ?>"/>
                                                <input type="hidden" name="date_end" value="<?php echo SetTextGetArray("date_end"); ?>"/>
                                            </div>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                            </span>
                                        </div>
                                    </div>                                                    
                        
                                    <div class="col-sm-5" id="checkBoxGroup">                 
                                        <div class=""><label> <input type="checkbox" name="dog[]" value="01"/> <i></i> Пенсионный аннуитет </label></div>
                                        <div class=""><label> <input type="checkbox" name="dog[]" value="02"/> <i></i> ОСОР </label></div>
                                        <div class=""><label> <input type="checkbox" name="dog[]" value="07"/> <i></i> ОСНС </label></div>                                
                                        <div class=""><label> <input type="checkbox" name="dog[]" value="06"/> <i></i> Хранитель </label></div>
                                    </div>
                                </form>
                            </div> 
                            <!--'-->
                            <div class="ibox-content">
                                <h3 class="m-t-none m-b">Поиск по статусу</h3>
                                <form role="form" method="get">
                                    <div class="form-group">                                    
                                        <div class="input-group">
                                            <select class="form-control input-sm" name="search_state">
                                            <?php 
                                                foreach($states as $k=>$v){
                                                    echo '<option value="'.$v['STATE'].'">'.$v['STATES'].'</option>';
                                                }                                    
                                            ?>                                               
                                            </select>                                         
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>                                            
                                            </span>    
                                        </div>                                                                
                                    </div>                                                                 
                                </form>
                            </div>                          
                        </div>
                    </div>        
                </div>
            </div>
            <div class="ibox">                          
                <div class="ibox-content">        
                    <div class="row">                                                
                        <div class="col-lg-12">
                        <?php                         
                            //echo $table->html;
                            echo $s->html;
                        ?>
                        </div>
                    </div> 
                </div>
            </div>
        </div>        
    </div>
</div>


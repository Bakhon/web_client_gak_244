<div class="wrapper wrapper-content animated fadeInRight">


            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="<? echo HTTP_NO_IMAGE_USER; ?>" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php echo $Ldap_Users['fio'];?>
                                </h2>
                                <h4><?php echo $Ldap_Users['dolgnost'];?></h4>
                                <small>
                                    <?php echo $Ldap_Users['base']['SHORT_NAME'].'. '.$Ldap_Users['region'];?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                        <tr>
                            <td>
                                <strong>142</strong> Projects
                            </td>
                            <td>
                                <strong>22</strong> Followers
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>61</strong> Comments
                            </td>
                            <td>
                                <strong>54</strong> Articles
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>154</strong> Tags
                            </td>
                            <td>
                                <strong>32</strong> Friends
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <small>Телефон</small>
                    <h2 class="no-margins"><?php echo $Ldap_Users['mobile'];?></h2>
                    <div id="sparkline1"></div>
                </div>


            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Общие </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"> Образование </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3"> Стаж </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-4"> Воинский учет </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-5"> Семья </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-6"> Журнал документов </a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                        existence in this spot, which was created for the bliss of souls like mine.</p>

                                    <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                                        the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>

                                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>

                                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                </div>
                            </div>
                            <div id="tab-4" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>

                                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                </div>
                            </div>
                            <div id="tab-5" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>

                                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                </div>
                            </div>
                            <div id="tab-6" class="tab-pane">
                                <div class="panel-body">
                                        <div class="col-lg-6">
                                            <h3>Отпуск</h3>
                                                <a id="formAddHoliday"  onclick="fnClickAddRow();" class="btn btn-primary ">Добавить отпуск</a>
                                                <table class="table table-hover margin bottom">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 1%" class="text-center">#</th>
                                                        <th>Дата отпуска</th>
                                                        <th class="text-center">Количество дней</th>
                                                        <th class="text-center">Леч.пособие</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="placeAddHoliday">
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td >16 Июль 2014 - 16 Июль 2014</td>
                                                        <td class="text-center">15</td>
                                                        <td class="text-center small"><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="form-group">
                                                        <label class="col-lg-4 control-label">&nbsp;</label>
                                                        <div class="col-lg-8">
                                                            <div class="statistic-box">
                                                                <div class="row text-center">
                                                                    <div class="col-lg-6">
                                                                        <canvas id="doughnutChart" width="200" height="78"></canvas>
                                                                        <h5 >Количество отпускных дней</h5>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <canvas id="polarChart" width="200" height="80"></canvas>
                                                                        <h5 >Остатки отпускных дней</h5>
                                                                    </div>
                                                                </div>
                                                            </div>                      
                                                    </div>
                                                </div>
                                                <hr />
                                                <h3>Командировки</h3>
                                                    <a id="formAddTrip" class="btn btn-primary ">Добавить командировку</a>
                                                    <table class="table table-hover margin bottom">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 1%" class="text-center">#</th>
                                                                <th>Страна</th>
                                                                <th>Город</th>
                                                                <th class="text-center">Дата командировки</th>
                                                                <th class="text-center">Транспорт</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="placeAddTrip">
                                                            <tr>
                                                                <td class="text-center">1</td>
                                                                <td> Казахстан </td>
                                                                <td> Актау </td>
                                                                <td class="text-center small">16 Июль 2014</td>
                                                                <td class="text-center small">16 Июль 2014</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                <div class="form-group">
                                                        <label class="col-lg-4 control-label">Результаты аттестации за последние 6 лет</label>
                                                            <div class="col-lg-8">
                                                                <div id="place_for_chart_edu">
                                                                    
                                                                </div>                   
                                                            </div>
                                                </div>
                                                <hr />
                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label"></label>
                                                                    <div class="col-lg-8">        
                                                                        <div class="i-checks">
                                                                            <label> <input type="checkbox" id="resident" name="resident"/> <i></i>Рекомендован на новую должность</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                <hr />  
                                                <div class="col-lg-9"></div>
                                                <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Сохранить</button></div>
                                                    
                                        </div>
                                </div>
                            </div>
                            <div id="tab-7" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>

                                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
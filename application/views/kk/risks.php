<?php
	$year = date("Y");
    $Year_now = $year;
    if(isset($_GET['year'])){
        $Year_now = $_GET['year'];
    }
    $d1 = date("d.m.Y", strtotime('31.12.'.$Year_now));
    
    $ipdl = $kk->ipdl($d1);        
    $mo = $kk->mo($d1);
    $lombard = $kk->lombard($d1);
    $kazino = $kk->kazino($d1);
    $turisty = $kk->turisty($d1);
    $brokers = $kk->brokers($d1);
    $lizing = $kk->lizing($d1);
    $kredit = $kk->kredit($d1);
    $nedvigimost = $kk->nedvigimost($d1);
    $orugie = $kk->orugie($d1);
    $metal = $kk->metal($d1);
    $relig = $kk->relig($d1);
    
?>
<div class="row wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins"> 
                <div class="ibox-title">
                    <div class="pull-right" style="margin-right: 30px;">                        
                        <span class="label">Выберите год</span>
                        <select id="get_year">
                            <?php
                                for($i=2010;$i<=$year;$i++){
                                    $s = '';
                                    if($i == $Year_now){
                                        $s = 'selected';
                                    }
                                    echo '<option '.$s.' value="'.$i.'">'.$i.'</option>';
                                }                                                                
                            ?>                            
                        </select>
                    </div>                    
                    <h3>Таблица № 1 (риск по типу клиента)</h3>
                    
                </div>                   
                <div class="ibox-content">
                    
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Факторы, влияющие на оценку риска клиента (в случае, если договоры страхования заключены с данными клиентами)</th>
                            <th>Количество действующих договоров по состоянию на  01.01.2019 года с такими клиентами</th>
                            <th>Объем обязательств по действующим договорам страхования (перестрахования) по состоянию на 01.01.2019 года с такими клиентами, тыс.тенге</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="ipdl">иностранные публичные должностные лица (клиент сам в заявлении анкете будет отмечать подобную графу относится или нет)</a>
                            </td>
                            <td>
                                <center><?php echo $ipdl[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($ipdl[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                юридические лица, исключительным видом деятельности которых является организация <strong>обменных операций </strong>с наличной иностранной валютой
                            </td>
                            <td>
                                <center>0</center>
                            </td>
                            <td>
                                <center>0</center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                организации, исключительной деятельностью которых является <strong>инкассация банкнот, монет</strong> и ценностей (за исключением дочерних организаций банков второго уровня, которые соблюдают требования по ПОД/ФТ, установленные банками второго уровня)
                            </td>
                            <td>
                                <center>0</center>
                            </td>
                            <td>
                                <center>0</center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="mo">микрофинансовые организации</a>
                            </td>
                            <td>
                                <center><?php echo $mo[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($mo[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="lombard">юридические лица, зарегистрированные в качестве <strong>ломбардов</strong></a>
                            </td>
                            <td>
                                <center><?php echo $lombard[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($lombard[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                агенты (поверенные) поставщиков услуг (кроме финансовых), <strong>осуществляющие прием от потребителей наличных денег</strong>, в том числе через электронные терминалы
                            </td>
                            <td>
                                <center>0</center>
                            </td>
                            <td>
                                <center>0</center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="kazino">
                                <strong>организаторы игорного бизнеса</strong>, а также лица, предоставляющие услуги либо получающие доходы от деятельности онлайн-казино за пределами Республики Казахстан
                                </a>
                            </td>
                            <td>
                                <center><?php echo $kazino[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($kazino[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="turisty">
                                <strong>лица, предоставляющие туристские услуги</strong>, а также иные услуги, связанные с интенсивным оборотом наличных денег
                                </a>
                            </td>
                            <td>
                                <center><?php echo $turisty[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($turisty[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="brokers">
                                <strong>брокеры-дилеры, управляющие инвестиционным портфелем</strong> (за исключением дочерних организаций банков второго уровня, которые соблюдают требования по ПОД/ФТ, установленные банками второго уровня)
                                </a>
                            </td>
                            <td>
                                <center><?php echo $brokers[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($brokers[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="lizing">
                                <strong>лица, предоставляющие услуги по финансовому лизингу</strong> (за исключением дочерних организаций банков второго уровня, которые соблюдают требования по ПОД/ФТ, установленные банками второго уровня)
                                </a>
                            </td>
                            <td>
                                <center><?php echo $lizing[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($lizing[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="kredit">
                                кредитные товарищества
                                </a>
                            </td>
                            <td>
                                <center><?php echo $kredit[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($kredit[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="nedvigimost">
                                лица, осуществляющие <strong>посредническую деятельность по купле-продаже недвижимости</strong>
                                </a>
                            </td>
                            <td>
                                <center><?php echo $nedvigimost[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($nedvigimost[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="orugie">
                                лица, деятельность которых связана с <strong>производством и (или) торговлей оружием, взрывчатыми веществами</strong>
                                </a>
                            </td>
                            <td>
                                <center><?php echo $orugie[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($orugie[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="metal">
                                лица, деятельность которых связана с <strong>добычей и (или) обработкой, а также куплей-продажей драгоценных металлов</strong>, драгоценных камней либо изделий из них
                                </a>
                            </td>
                            <td>
                                <center><?php echo $metal[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($metal[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="lists" data-toggle="modal" data-target="#lists" data="relig">
                                <strong>некоммерческие организации, в организационно-правовой форме фондов, религиозных объединений</strong>
                                </a>
                            </td>
                            <td>
                                <center><?php echo $relig[0]['CNT']; ?></center>
                            </td>
                            <td>
                                <center><?php echo NumberRas($relig[0]['PAY_SUM_V']); ?></center>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="lists" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: auto;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Списочная часть</h4>
                <small class="font-bold" id="modal_title_text"></small>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#get_year').change(function(){
    var year = $(this).val();
    window.location.href = 'kk?risks&year='+year;
});

$('.lists').click(function(){
    var id = $(this).attr('data');    
    var text = $(this).html();   
    $('#modal_title_text').html(text);
    $.post(window.location.href, {"risk_lists":id}, function(data){
        $('.modal-body').html(data);
        console.log(data);
    });
});
</script>


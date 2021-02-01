<div class="row">
    <div class="col-lg-12">
        <!--
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>По возрасту</h5>
            </div>
            <?php
                foreach($year_array as $k => $v)
                {
                    //echo $v.'<br>';
                }
            ?>
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>ИИН</th>
                        <th>Дата рождения</th>
                        <th>Примечание</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($list_all_emp as $k => $v)
                        {
                    ?>
                    <tr>
                        <td><?php echo $v['LASTNAME']; ?></td>
                        <td><?php echo $v['FIRSTNAME']; ?></td>
                        <td><?php echo $v['MIDDLENAME']; ?></td>
                        <td><?php echo $v['IIN']; ?></td>
                        <td><?php echo $v['BIRTHDATE']; ?></td>
                        <td>Согласен на обработку данных</td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        -->
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>По возрасту</h5>
            </div>
            <?php
                foreach($year_array as $k => $v)
                {
                    //echo $v.'<br>';
                }
            ?>
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Возраст</th>
                        <th>Число сотрудников на 30.06.2020</th>
                        <th>Удельный вес</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>До 20 лет</td>
                        <td><?php echo $after_20_17; ?></td>
                        <td class="text-navy"> <?php echo $after_20_17_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 20 до 29 лет</td>
                        <td><?php echo $after_30_17; ?></td>
                        <td class="text-navy"> <?php echo $after_30_17_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 30 до 39 лет</td>
                        <td><?php echo $after_40_17; ?></td>
                        <td class="text-navy"> <?php echo $after_40_17_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 40 до 49 лет</td>
                        <td><?php echo $after_50_17; ?></td>
                        <td class="text-navy"> <?php echo $after_50_17_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 50 до 59 лет</td>
                        <td><?php echo $after_60_17; ?></td>
                        <td class="text-navy"> <?php echo $after_60_17_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 60 и старше</td>
                        <td><?php echo $after_70_17; ?></td>
                        <td class="text-navy"> <?php echo $after_70_17_perc; ?> %</td>
                    </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>По стажу</h5>
            </div>
            <?php
                foreach($year_array as $k => $v)
                {
                    //echo $v.'<br>';
                }
            ?>
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Стаж</th>
                        <th>Число сотрудников на 30.06.2020</th>
                        <th>Удельный вес</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>До 1 года</td>
                        <td><?php echo $under_1; ?></td>
                        <td class="text-navy"> <?php echo $under_1_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 1 до 5 лет</td>
                        <td><?php echo $under_5; ?></td>
                        <td class="text-navy"> <?php echo $under_5_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 5 до 10 лет</td>
                        <td><?php echo $under_10; ?></td>
                        <td class="text-navy"><?php echo $under_10_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>От 10 до 20 лет</td>
                        <td><?php echo $under_20; ?></td>
                        <td class="text-navy"> <?php echo $under_20_perc; ?> %</td>
                    </tr>
                    <tr>
                        <td>Свыше 20 лет</td>
                        <td><?php echo '-'; ?></td>
                        <td class="text-navy"> <?php echo '0'; ?> %</td>
                    </tr>                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right"></span>
                <h5>Гендер</h5>
            </div>
            <div class="ibox-content">
                <div class="row text-center">
                    <div class="col-lg-8">
                        <canvas id="doughnutChart" width="400" height="400"></canvas>
                        <h5>Гендерное деление на сегодня</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class=" m-l-md">
                            <span class="h4 font-bold m-t block"><?php echo $sex_perc_male; ?> %</span>
                            <small class="text-muted m-b block">Мужчин</small>
                        </div>
                        <div class=" m-l-md">
                            <span class="h4 font-bold m-t block"><?php echo $sex_perc_female; ?> %</span>
                            <small class="text-muted m-b block">Женщин</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right"></span>
                <h5>Средний возраст сотрудников</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $middle_age; ?></h1>
                <div class="stat-percent font-bold text-success"></div>
                <small>лет</small>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right"></span>
                <h5>Средний возраст руководителей</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $middle_chiefs_age; ?></h1>
                <div class="stat-percent font-bold text-success"></div>
                <small>лет</small>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right"></span>
                <h5>В среднем сотрудники в компании работают</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $middle_middle_work_month; ?></h1>
                <div class="stat-percent font-bold text-success"></div>
                <small>месяцев</small>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function()
    {
        var data1 = 
        [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = 
        [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $('#flot-dashboard-chart').length && $.plot($('#flot-dashboard-chart'), [
            data1, data2
        ],
                {
                    series: 
                    {
                        lines: 
                        {
                            show: false,
                            fill: true
                        },
                        splines: 
                        {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: 
                        {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: 
                    {
                        hoverable: true,
                        clickable: true,
                        tickColor: '#d5d5d5',
                        borderWidth: 1,
                        color: '#d5d5d5'
                    },
                    colors: ['#1ab394', '#1C84C6'],
                    xaxis:
                    {
                    },
                    yaxis: 
                    {
                        ticks: 4
                    },
                    tooltip: false
                }
        );

        var doughnutData = [
            {
                value: <?php echo $male_count; ?>,
                color: '#a3e1d4',
                highlight: '#1ab394',
                label: 'Мужчин'
            },
            {
                value: <?php echo $female_count; ?>,
                color: '#A4CEE8',
                highlight: '#1ab394',
                label: 'Женщин'
            }
        ];

        var doughnutOptions = 
        {
            segmentShowStroke: true,
            segmentStrokeColor: '#fff',
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: 'easeOutBounce',
            animateRotate: true,
            animateScale: false
        };

        var ctx = document.getElementById('doughnutChart').getContext('2d');
        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

        var polarData = 
        [
            {
                value: 300,
                color: '#a3e1d4',
                highlight: '#1ab394',
                label: 'App'
            },
            {
                value: 140,
                color: '#dedede',
                highlight: '#1ab394',
                label: 'Software'
            },
            {
                value: 200,
                color: '#A4CEE8',
                highlight: '#1ab394',
                label: 'Laptop'
            }
        ];

        var polarOptions = 
        {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: 'rgba(255,255,255,0.75)',
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: '#fff',
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: 'easeOutBounce',
            animateRotate: true,
            animateScale: false
        };
        var ctx = document.getElementById('polarChart').getContext('2d');
        var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

    });
</script>


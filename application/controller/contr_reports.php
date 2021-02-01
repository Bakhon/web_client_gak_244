<?php
    array_push
    ($js_loader,        
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'styles/js/plugins/flot/jquery.flot.js',
        'styles/js/plugins/flot/jquery.flot.tooltip.min.js',
        'styles/js/plugins/flot/jquery.flot.spline.js',
        'styles/js/plugins/flot/jquery.flot.resize.js',
        'styles/js/plugins/flot/jquery.flot.pie.js',
        'styles/js/plugins/peity/jquery.peity.min.js',
        'styles/js/inspinia.js',
        'styles/js/plugins/pace/pace.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/demo/peity-demo.js',        
        'styles/js/plugins/jquery-ui/jquery-ui.min.js',
        'styles/js/plugins/gritter/jquery.gritter.min.js',
        'styles/js/plugins/sparkline/jquery.sparkline.min.js',
        'styles/js/demo/sparkline-demo.js',
        'styles/js/plugins/chartJs/Chart.min.js',
        'styles/js/plugins/toastr/toastr.min.js'                                                                
    );

    array_push
    ($css_loader, 
        'styles/font-awesome/css/font-awesome.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/animate.css'
    );

    $othersJs .= "<script>
                    $(document).ready(function(){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    });
                </script>";

    $year_array = array('2014', '2015', '2016', '2016_2', '2017');

    $today_year = date('Y');

    $db = new DB();
    $sql_after_20_17 = "select * from sup_person where BIRTHDATE between '01.07.2000' and '30.06.2020' and DATE_POST <= '30.06.2020' and (DATE_LAYOFF >= '30.06.2020' OR DATE_LAYOFF IS NULL) and state in (2,3,5,6,4,9)";
    $list_after_20_17 = $db -> Select($sql_after_20_17);

    $sql_after_30_17 = "select * from sup_person where BIRTHDATE between '01.07.1990' and '30.06.2000' and DATE_POST <= '30.06.2020' and (DATE_LAYOFF >= '30.06.2020' OR DATE_LAYOFF IS NULL) and state in (2,3,5,6,4,9)";
    $list_after_30_17 = $db -> Select($sql_after_30_17);

    $sql_after_40_17 = "select * from sup_person where BIRTHDATE between '01.07.1980' and '30.06.1990' and DATE_POST <= '30.06.2020' and (DATE_LAYOFF >= '30.06.2020' OR DATE_LAYOFF IS NULL) and state in (2,3,5,6,4,9)";
    $list_after_40_17 = $db -> Select($sql_after_40_17);

    $sql_after_50_17 = "select * from sup_person where BIRTHDATE between '01.07.1970' and '30.06.1980' and DATE_POST <= '30.06.2020' and (DATE_LAYOFF >= '30.06.2020' OR DATE_LAYOFF IS NULL) and state in (2,3,5,6,4,9)";
    $list_after_50_17 = $db -> Select($sql_after_50_17);

    $sql_after_60_17 = "select * from sup_person where BIRTHDATE between '01.07.1960' and '30.06.1970' and DATE_POST <= '30.06.2020' and (DATE_LAYOFF >= '30.06.2020' OR DATE_LAYOFF IS NULL) and state in (2,3,5,6,4,9)";
    $list_after_60_17 = $db -> Select($sql_after_60_17);

    $sql_after_70_17 = "select * from sup_person where BIRTHDATE between '01.07.1900' and '30.06.1960' and DATE_POST <= '30.06.2020' and (DATE_LAYOFF >= '30.06.2020' OR DATE_LAYOFF IS NULL) and state in (2,3,5,6,4,9)";
    $list_after_70_17 = $db -> Select($sql_after_70_17);

    $sql_male = "select * from sup_person where state in (2,3,5,6,4,9) and SEX = 1";            
    $list_male = $db -> Select($sql_male);
    $male_count = count($list_male);

    $sql_female = "select * from sup_person where state in (2,3,5,6,4,9) and SEX = 2";
    $list_female = $db -> Select($sql_female);
    $female_count = count($list_female);

    $sum_male_female = $female_count + $male_count;

    $sex_perc_male = ($male_count/$sum_male_female)*100;
    $sex_perc_female = ($female_count/$sum_male_female)*100;

    ///////////////////////
    $after_20_17 = count($list_after_20_17);
    $after_30_17 = count($list_after_30_17);
    $after_40_17 = count($list_after_40_17);
    $after_50_17 = count($list_after_50_17);
    $after_60_17 = count($list_after_60_17);
    $after_70_17 = count($list_after_70_17);
    $sum_17 = $after_20_17 + $after_30_17 + $after_40_17 + $after_50_17 + $after_60_17 + $after_70_17;

    $after_20_17_perc = ($after_20_17/$sum_17)*100;
    $after_30_17_perc = ($after_30_17/$sum_17)*100;
    $after_40_17_perc = ($after_40_17/$sum_17)*100;
    $after_50_17_perc = ($after_50_17/$sum_17)*100;
    $after_60_17_perc = ($after_60_17/$sum_17)*100;
    $after_70_17_perc = ($after_70_17/$sum_17)*100;

    $sql_under_1 = "select * from sup_person where DATE_POST between '01.07.2019' and '30.06.2020' and state in (2,3,5,6,4,9)";
    $list_under_1 = $db -> Select($sql_under_1);
    $under_1 = count($list_under_1);

    $sql_under_5 = "select * from sup_person where DATE_POST between '01.07.2015' and '30.06.2019' and state in (2,3,5,6,4,9)";
    $list_under_5 = $db -> Select($sql_under_5);
    $under_5 = count($list_under_5);

    $sql_under_10 = "select * from sup_person where DATE_POST between '01.07.2010' and '30.06.2015' and state in (2,3,5,6,4,9)";
    $list_under_10 = $db -> Select($sql_under_10);
    $under_10 = count($list_under_10);

    $sql_under_20 = "select * from sup_person where DATE_POST between '01.07.2000' and '30.06.2010' and state in (2,3,5,6,4,9)";
    $list_under_20 = $db -> Select($sql_under_20);
    $under_20 = count($list_under_20);

    $sum_under = $under_1 + $under_5 + $under_10 + $under_20;

    $under_1_perc = ($under_1/$sum_under)*100;
    $under_5_perc = ($under_5/$sum_under)*100;
    $under_10_perc = ($under_10/$sum_under)*100;
    $under_20_perc = ($under_20/$sum_under)*100;

    $sql_middle_age = "select get_age(sysdate, BIRTHDATE) age from sup_person where state in (2,3,5,6,4,9)";
    $list_middle_age = $db -> Select($sql_middle_age);

    $sum_all_age = 0;
    foreach($list_middle_age as $k => $v)
    {
        $sum_all_age = $sum_all_age + $v['AGE'];
    }

    $middle_age = $sum_all_age/count($list_middle_age);

    $sql_chiefs_age = "select get_age(sysdate, triv.BIRTHDATE) age from sup_person triv, dic_dolzh dolzh where triv.state in (2,3,5,6,4,9) and dolzh.ID = triv.JOB_POSITION and dolzh.POS_LEVEL = 1";
    $list_middle_age = $db -> Select($sql_chiefs_age);
    $sum_chiefs_age = 0;

    foreach($list_middle_age as $k => $v)
    {
        $sum_chiefs_age = $sum_chiefs_age + $v['AGE'];
    }

    $middle_chiefs_age = $sum_chiefs_age/count($list_middle_age);

    function return_percent_of_summ($val_1, $val_2, $val_3, $val_4, $val_5)
    {
        $sum_of_all = $val_1 + $val_2 + $val_3 + $val_4 + $val_5;
        return $perc;
    }

    $sql_middle_work_month = "select MONTHS_BETWEEN(DATE_LAYOFF, DATE_POST) AGE from sup_person where DATE_LAYOFF is not null";
    $list_middle_work_month = $db -> Select($sql_middle_work_month);
    $sum_middle_work_month = 0;

    foreach($list_middle_work_month as $k => $v)
    {
        $sum_middle_work_month = $sum_middle_work_month + $v['AGE'];
    }
    $middle_middle_work_month = $sum_middle_work_month/count($list_middle_work_month);

    $sql_all_emp = "select * from sup_person where STATE in (2,3,5,6,4,9) OR STATE = 4 OR STATE = 9 order by LASTNAME";
    $list_all_emp = $db -> Select($sql_all_emp);
?>




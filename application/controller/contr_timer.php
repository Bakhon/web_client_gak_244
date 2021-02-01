<?php
    $db = new DB();

    check_all_holidays();
    check_all_trips();
    check_all_hosp();

    check_all_fired();
    set_congrats();
	exit;

    //проверяет отпуска и меняет статус сотрудникам
    function check_all_holidays()
    {
        $db = new DB();
        $today_date = date('d.m.Y');
        //все отпуска которые начинаются сегодняя
        $sql_guys_with_holi = "select holi.ID, holi.ID_PERSON, trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO from PERSON_HOLIDAYS holi, SUP_PERSON trivial where holi.DATE_BEGIN = '$today_date' and holi.ID_PERSON = trivial.ID";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['ID_PERSON'];
            $fio = $v['FIO'];
            $sql_guys_with_holi = "update SUP_PERSON set STATE = '3' where ID = '$emp_id'";
            $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
            mail("i.akhmetov@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio ушел в отпуск", "From: СУП");
            //mail("a.ibrayeva@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio ушел в отпуск", "From: СУП");
        }

        //все отпуска которые кончаются сегодня
        $sql_guys_with_holi = "select holi.ID, holi.ID_PERSON, trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO from PERSON_HOLIDAYS holi, SUP_PERSON trivial where holi.DATE_END = '$today_date' and holi.ID_PERSON = trivial.ID";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['ID_PERSON'];
            $fio = $v['FIO'];
            $sql_guys_with_holi = "update SUP_PERSON set STATE = '2' where ID = '$emp_id'";
            $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
            mail("i.akhmetov@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio вышел с отпуска", "From: СУП");
            //mail("a.ibrayeva@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio вышел с отпуска", "From: СУП");
        }
    }

    //проверяет командировки и меняет статус сотрудникам
    function check_all_trips()
    {
        $db = new DB();
        $today_date = date('d.m.Y');
        //все командировки которые начинаются сегодняя
        $sql_guys_with_holi = "select holi.ID, holi.PERSON_ID, trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO from PERSON_TRIP holi, SUP_PERSON trivial where holi.DATE_BEGIN = '$today_date' and holi.PERSON_ID = trivial.ID";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['PERSON_ID'];
            $fio = $v['FIO'];
            $sql_guys_with_holi = "update SUP_PERSON set STATE = '5' where ID = '$emp_id'";
            $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
            mail("i.akhmetov@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio уехал в командировку", "From: СУП");
            //mail("a.ibrayeva@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio уехал в командировку", "From: СУП");
        }

        //все командировки которые кончаются сегодня
        $sql_guys_with_holi = "select holi.ID, holi.PERSON_ID, trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO from PERSON_TRIP holi, SUP_PERSON trivial where holi.DATE_END = '$today_date' and holi.PERSON_ID = trivial.ID";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['PERSON_ID'];
            $fio = $v['FIO'];
            $sql_guys_with_holi = "update SUP_PERSON set STATE = '2' where ID = '$emp_id'";
            $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
            mail("i.akhmetov@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio приехал с командировки", "From: СУП");
            //mail("a.ibrayeva@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio приехал с командировки", "From: СУП");
        }
    }

    //проверяет больничные и меняет статус сотрудникам
    function check_all_hosp()
    {
        $db = new DB();
        $today_date = date('d.m.Y');
        //все больничные которые начинаются сегодняя
        $sql_guys_with_holi = "select holi.ID, holi.ID_PERSON, trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO from PERSON_HOSPITAL holi, SUP_PERSON trivial where DATE_BEGIN = '$today_date' and holi.ID_PERSON = trivial.ID";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['ID_PERSON'];
            $fio = $v['FIO'];
            $sql_guys_with_holi = "update SUP_PERSON set STATE = '6' where ID = '$emp_id'";
            $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
            mail("i.akhmetov@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio ушел на больничный", "From: СУП");
            //mail("a.ibrayeva@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio ушел на больничный", "From: СУП");
        }

        //все больничные которые кончаются сегодня
        $sql_guys_with_holi = "select holi.ID, holi.ID_PERSON, trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO from PERSON_HOSPITAL holi, SUP_PERSON trivial where DATE_END = '$today_date' and holi.ID_PERSON = trivial.ID";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['ID_PERSON'];
            $fio = $v['FIO'];
            $sql_guys_with_holi = "update SUP_PERSON set STATE = '2' where ID = '$emp_id'";
            $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
            mail("i.akhmetov@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio вышел с больничного", "From: СУП");
            //mail("a.ibrayeva@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio вышел с больничного", "From: СУП");
        }
    }

    //проверяет всех уволенных
    function check_all_fired()
    {
        $db = new DB();
        $today_date = date('d.m.Y');
        //все больничные которые начинаются сегодняя
        $sql_guys_with_holi = "select t2_card.ID, t2_card.ID_PERSON, t2_card.EVENT_DATE, t2_card.ACT_ID, trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO from T2_CARD t2_card, SUP_PERSON trivial where (ACT_ID = 3 OR ACT_ID = 5) and EVENT_DATE = '$today_date' and t2_card.ID_PERSON = trivial.ID";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['ID_PERSON'];
            $fio = $v['FIO'];
            $act_id = $v['ACT_ID'];
            $event_id = $v['EVENT_DATE'];
            $sql_guys_with_holi = "update SUP_PERSON set STATE = '6' where ID = '$emp_id'";
            echo $sql_guys_with_holi.'<br />';
            echo $act_id.' '.$event_id.'<br /><br />';
            //$list_guys_with_holi = $db -> Select($sql_guys_with_holi);
            //mail("i.akhmetov@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio ушел на больничный", "From: СУП");
            //mail("a.ibrayeva@gak.kz", 'Уведомление в СУП', "Сегодня, сотрудник $fio ушел на больничный", "From: СУП");
        }
    }

    //поздравляет с днем рождения
    function set_congrats()
    {
        $db = new DB();
        $today_date_day = date('d');
        $today_date_month = date('m');
        //все больничные которые начинаются сегодняя
        $sql_guys_with_holi = "select EMAIL, FIRSTNAME ||' '|| MIDDLENAME FIO from SUP_PERSON
                                where extract(day from birthdate) = '$today_date_day'
                                      and extract(month from birthdate) = '$today_date_month'
                                      and (STATE = 2 OR STATE = 3 OR STATE = 4 OR STATE = 5 OR STATE = 6 OR STATE = 9)";
        $list_guys_with_holi = $db -> Select($sql_guys_with_holi);
        $flowers = "


~~~~HAPPY BIRTHDAY~~ 
******************************* 
********/\****/\****/\********** 
********\/****\/****\/********** 
********||****||****||*********** 
********||****||****||*********** 
***(----------------------------)**** 
***(----------------------------)**** 
***(----------------------------)**** 
***(__________ГАК_____________)**** ";
        
        foreach($list_guys_with_holi as $k => $v)
        {
            $emp_id = $v['ID_PERSON'];
            $fio = $v['FIO'];
            $act_id = $v['ACT_ID'];
            $event_id = $v['EVENT_DATE'];
            $email = $v['EMAIL'];
            mail("$email", 'Со светлым и радостным праздником!', "Поздравляю Вас, $fio, с замечательным днём, светлым и радостным праздником — днём Вашего рождения! Пусть сегодня Вам улыбается удача, сбываются все загаданные желания, пусть своей теплотой и любовью Вас согревают родные и близкие люди. Желаю здоровья, везения, бодрости и много поводов для того, чтобы почувствовать себя счастливым человеком. С наилучшими пожеланиями, Робот Системы Электронного Документооборота и Робот Системы Управления Персоналом. $flowers", "From: Робот СЭД и Робот СУП");
            mail("i.akhmetov@gak.kz", 'Со светлым и радостным праздником!', "Поздравляю Вас, $fio, с замечательным днём, светлым и радостным праздником — днём Вашего рождения! Пусть сегодня Вам улыбается удача, сбываются все загаданные желания, пусть своей теплотой и любовью Вас согревают родные и близкие люди. Желаю здоровья, везения, бодрости и много поводов для того, чтобы почувствовать себя счастливым человеком. С наилучшими пожеланиями, Робот Системы Электронного Документооборота и Робот Системы Управления Персоналом. $flowers", "From: Робот СЭД и Робот СУП");
        }
    }
?>
<?php
    $db = new DB();

    //построение обьекта Employee
    $empId = $_GET['emp_id'];

    //создаем обьект Employee, в параметры передаем ID
    $employee = new Employee($empId);

    //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
    $empInfo = $employee -> get_emp_from_DB_trivial();

    if(isset($_GET['emp_id']))
    {
        $emp_id = $_GET['emp_id'];
        $sql_history = "select
                            action.NAME act_name,
                            card.ACT_ID,
                            CARD.BRANCH_ID,
                            CARD.DEPARTMENT,
                            CARD.ID_PERSON,
                            CARD.EVENT_DATE,
                            CARD.ID,
                            CARD.POSITION,
                            CARD.SALARY,
                            CARD.POSITION_FROM,
                            DOLZH.D_NAME dolzh,
                            BRANCH.NAME BRANCHNAME,
                            DEP.NAME DEP_NAME
                        from
                            T2_CARD card,
                            DIC_DOLZH dolzh,
                            DIC_BRANCH branch,
                            DIC_DEPARTMENT dep,
                            DIC_ACTION action
                        where
                            action.ACT_ID = card.ACT_ID and
                            CARD.BRANCH_ID = BRANCH.RFBN_ID and
                            CARD.DEPARTMENT = DEP.ID and
                            CARD.POSITION = DOLZH.ID and
                            ID_PERSON = $emp_id
                        order by card.id";
        $list_history = $db -> Select($sql_history);
        //echo $sql_history;
        //echo '<pre>';
        //print_r($list_history);
        //echo '<pre>';
    }
?>
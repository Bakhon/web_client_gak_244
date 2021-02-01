<?php
    $db = new DB();

    //построение обьекта Employee
    $empId = $_GET['employee_id'];
    
    //создаем обьект Employee, в параметры передаем ID
    $employee = new Employee($empId);
    
    //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
    $empInfo = $employee -> get_emp_from_DB_trivial();
    
    $sqlEmpInfo = "select FAMST.NAME fam_state, triv.WORK_PHONE, triv.HOME_PHONE, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.MOB_PHONE MOB_PHONE, NATION.RU_NAME national, triv.BIRTHDATE, st.NAME STATE, triv.DATE_POST, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.JOB_POSITION,  triv.JOB_SP,  triv.BRANCHID, triv.MOB_PHONE, dolzh.D_NAME, dep.NAME, branch.NAME filial from DIC_FAMILY famst, DIC_NATIONALITY nation, DIC_PERSON_STATE st, sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep, DIC_BRANCH branch where triv.id = $empId and DOLZH.ID = triv.JOB_POSITION and DEP.ID = triv.JOB_SP and branch.RFBN_ID = triv.BRANCHID and triv.STATE = st.id and nation.id = triv.NACIONAL and famst.id = triv.FAMILY";
    //$empInfo = $db -> Select($sqlEmpInfo);
    
    
    
    $listEdu = $employee -> get_inf_from_DB_edu();
    
    //функция get_inf_from_DB_experience() возвращает массив с данными о стаже из базы
    $listExp = $employee -> get_inf_from_DB_experience();
    
    //функция get_inf_from_DB_fam_memb() возвращает массив с данными о членах семьи из базы
    $listFam = $employee -> get_inf_from_DB_fam_memb();
    
    //функция get_inf_from_DB_HOSPITAL() возвращает массив с данными об больничными
    $listHOSPITAL = $employee -> get_inf_from_DB_HOSPITAL();
    
    //функция get_emp_from_DB() возвращает массив с данными о работнике из базы
    $empTrivialInfo = $employee -> get_emp_from_DB_trivial();
    
    $MILITARY_GROUP = $empTrivialInfo[0]['MILITARY_GROUP'];       
    $MILITARY_CATEG = $empTrivialInfo[0]['MILITARY_CATEG'];
    $MILITARY_SOST = $empTrivialInfo[0]['MILITARY_SOST'];
    $MILITARY_RANK = $empTrivialInfo[0]['MILITARY_RANK'];
    $MILITARY_SPECIALITY = $empTrivialInfo[0]['MILITARY_SPECIALITY'];
    $MILITARY_VOENKOM = $empTrivialInfo[0]['MILITARY_VOENKOM'];
    $MILITARY_SPEC_UCH = $empTrivialInfo[0]['MILITARY_SPEC_UCH'];
    $MILITARY_SPEC_UCH_NUM = $empTrivialInfo[0]['MILITARY_SPEC_UCH_NUM'];
    $MILITARY_FIT = $empTrivialInfo[0]['MILITARY_FIT'];
    
    $name = $empInfo[0]['LASTNAME'];
    $lastname = $empInfo[0]['FIRSTNAME'];
    $middlename = $empInfo[0]['MIDDLENAME'];
    $posName = $empInfo[0]['D_NAME'];
    $depName = $empInfo[0]['NAME'];
    $filialname = $empInfo[0]['FILIAL'];
    $telNum = $empInfo[0]['MOB_PHONE'];
    $state = $empInfo[0]['STATE'];
    $birth_date = $empInfo[0]['BIRTHDATE'];
    $national = $empInfo[0]['NATIONAL'];
    $familyStat = $empInfo[0]['NATIONAL'];
    $telNum = $empInfo[0]['MOB_PHONE'];
    $city = $empInfo[0]['FACT_ADDRESS_CITY'];
    $address = $empInfo[0]['FACT_ADDRESS_STREET'];
    $build = $empInfo[0]['FACT_ADDRESS_BUILDING'];
    $homePhone = $empInfo[0]['HOME_PHONE'];
    $workPhone = $empInfo[0]['WORK_PHONE'];
    $FAM_STATE = $empInfo[0]['FAM_STATE'];
    
    $DATE_POST = $empInfo[0]['DATE_POST'];
?>  
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="styles/img/no_avatar.png" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php echo $name.' '.$lastname; ?>
                                </h2>
                                <h4><?php echo $posName.' ('.$depName.')'; ?></h4>
                                <small>
                                    <?php echo $filialname; ?>
                                </small>
                                <div class="hr-line-dashed"></div>
                                <p class="small font-bold">
                                    <span><i class="fa fa-circle text-navy"></i> <?php echo $state; ?></span>
                                </p>
                            </div>
                            <div class="pull-right">
                                <a href="edit_employee?employee_id=<?php echo $empId; ?>" class="btn btn-primary btn-xs">Редактировать профиль</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                            <tr>
                                <td>
                                    Моб. телефон <strong><?php echo $telNum; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Дом. телефон <strong><?php echo $homePhone; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Раб. телефон <strong><?php echo $workPhone; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Город <strong><?php echo $city; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Адрес <strong><?php echo $address.' стр.'.$build; ?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <small>Эффективность</small>
                    <h2 class="no-margins">77%</h2>
                    <div id="sparkline1"></div>
                </div>


            </div>
            <div class="row">

                <div class="col-lg-3">

                    <div class="ibox">
                        <div class="ibox-content">
                                <h3>Общая информация</h3>
                                <table class="table small m-b-xs">
                                <tbody>
                                    <tr>
                                        <td>
                                            Дата рождения <strong><?php echo $birth_date; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Национальность <strong><?php echo $national; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Семейное положение <strong><?php echo $FAM_STATE; ?></strong>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>

                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Коллеги по департаменту</h3>
                            <p class="small">
                                Описание
                            </p>
                            <div class="user-friends">
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                                <a href="#"><img alt="image" class="img-circle" src="styles/img/no_avatar.png"></a>
                            </div>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Документы работника</h3>
                            <ul class="list-unstyled file-list">
                                <li><a href="#"><i class="fa fa-file"></i> Project_document.docx</a></li>
                                <li><a href="#"><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                                <li><a href="#"><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                                <li><a href="#"><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                                <li><a href="#"><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                                <li><a href="#"><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>Образование</h2>
                                <table class="table table-hover margin bottom">
                                    <thead>
                                    <tr>
                                        <th>Учебное заведение</th>
                                        <th>Специальность</th>
                                    </tr>
                                    </thead>
                                    <tbody id="place_for_edu">
                                    <?php
                                        foreach($listEdu as $x => $z){
                                    ?>
                                    <tr data="<?php echo $z['ID']; ?>">
                                        <td><?php echo $z['INSTITUTION']; ?></td>
                                        <td><?php echo $z['SPECIALITY']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon blue-bg">
                                <i class="fa fa-file-text"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>Стаж</h2>
                                <table class="table table-hover margin bottom">
                                    <thead>
                                    <tr>
                                        <th>Организация</th>
                                        <th>Должность</th>
                                        <th>Стаж</th>
                                    </tr>
                                    </thead>
                                    <tbody id="place_for_edu">
                                    <?php
                                        foreach($listExp as $a => $s){
                                    ?>
                                    <tr data="<?php echo $s['ID']; ?>">
                                        <td><?php echo $s['P_NAME']; ?></td>
                                        <td><?php echo $s['P_DOLZH']; ?></td>
                                        <td><?php echo $s['DATE_BEGIN'].'-'.$s['DATE_END']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon yellow-bg">
                                <i class="fa fa-phone"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>Состав семьи</h2>
                                <table class="table table-hover margin bottom">
                                    <thead>
                                    <tr>
                                        <th>Организация</th>
                                        <th>Должность</th>
                                        <th>Стаж</th>
                                    </tr>
                                    </thead>
                                    <tbody id="place_for_edu">
                                    <?php
                                        foreach($listFam as $a => $s){
                                    ?>
                                    <tr data="<?php echo $s['ID']; ?>">
                                        <td><?php echo $s['FIO']; ?></td>
                                        <td><?php echo $s['NAME']; ?></td>
                                        <td><?php echo $s['BIRTHDATE']; ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-comments"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>Лист нетрудоспособности</h2>
                                <table class="table table-hover margin bottom">
                                    <thead>
                                    <tr>
                                        <th>Даты</th>
                                        <th>Количество дней</th>
                                    </tr>
                                    </thead>
                                    <tbody id="place_for_edu">
                                    <?php
                                        foreach($listHOSPITAL as $a => $s){
                                    ?>
                                    <tr data="<?php echo $s['ID']; ?>">
                                        <td><?php echo $s['DATE_BEGIN'].'-'.$s['DATE_END']; ?></td>
                                        <td><?php echo $s['CNT_DAYS']; ?></td>
                                        
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5">
                    <div class="ibox">
                        <div class="ibox-content">
                                <h3>Воинский учет</h3>
                                <table class="table small m-b-xs">
                                <tbody>
                                    <tr>
                                        <td>
                                            Группа воинского учета <strong><?php echo $MILITARY_GROUP; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Категория <strong><?php echo $MILITARY_CATEG; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Состав <strong><?php echo $MILITARY_SOST; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Воинское звание <strong><?php echo $MILITARY_RANK; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Военно-учетная специальность <strong><?php echo $MILITARY_SPECIALITY; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Название районного военкомата <strong><?php echo $MILITARY_VOENKOM; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Состоит на спец. учете <strong><?php echo $MILITARY_SPEC_UCH; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Номер спец.учета <strong><?php echo $MILITARY_SPEC_UCH_NUM; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Годность к военной службе <strong><?php echo $MILITARY_FIT;?></strong>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>

                        </div>
                    </div>                  
                </div>
                

            </div>

        </div>
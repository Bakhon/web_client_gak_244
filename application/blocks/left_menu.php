<?php
    $db = new DB();

    $emp_mail = $_SESSION['insurance']['other']['mail'][0];    
    
   // echo $emp_mail;
        
    $sql_inbox_didnt_open = "select rec.DESTINATION, doc.DOC_LINK, rec.READ, DOC.DATE_START, KIND.NAME_KIND, STATE.STATE_NAME, DOC.SHORT_TEXT, rec.ID, doc.ID MAIL_ID, REC.COMMENT_TO_DOC, REC.SENDER_MAIL from DOC_RECIEPMENTS rec, DOCUMENTS doc, DIC_DOC_STATE state, DIC_DOC_KIND kind where rec.RECIEP_MAIL = '$emp_mail' and REC.STATE = STATE.ID and REC.MAIL_ID = DOC.ID and KIND.ID = DOC.KIND and rec.STATE = 0";
    $list_inbox_didnt_open = $db -> Select($sql_inbox_didnt_open);
    $didnt_open_count = count($list_inbox_didnt_open);
    
    $sql_trash_didnt_open = "select * from DOC_RECIEPMENTS rec, DOCUMENTS doc, DIC_DOC_STATE state, DIC_DOC_KIND kind where KIND.ID = DOC.KIND and REC.MAIL_ID = DOC.ID and REC.STATE = STATE.ID and rec.MAIL_ID IN ( select DISTINCT (MAIL_ID) from DOC_RECIEPMENTS where (SENDER_MAIL =  '$emp_mail' or RECIEP_MAIL =  '$emp_mail')) and rec.STATE = 4";
    $list_trash_didnt_open = $db -> Select($sql_trash_didnt_open);
    $didnt_open_count_trash = count($list_trash_didnt_open);
    
    $dps = $db->Select("
    select 
        s.id, 
        dd.d_name||' ('||dp.short_name||')' name 
    from 
        SUP_PERSON s, 
        DIC_DOLZH dd,
        DIC_DEPARTMENT dp
    where 
        S.JOB_POSITION = DD.ID
        and S.JOB_SP = DP.ID
        and S.EMAIL = '$emp_mail'");
    
    $dan_dolzh = $dps[0];
    
?>
<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <!-- Здесь надо поставить генерацию меню -->
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <a href="mypage">
                                <img alt="<?php echo $active_user_dan['emp_name']; ?>" class="img-circle" src="<?php echo HTTP_NO_IMAGE_USER; ?>" style="width: 60px;"/>
                            </a>
                             </span>
                        <span data-toggle="dropdown" class="dropdown-toggle">
                            <span class="clear"> 
                                <span class="block m-t-xs"> <strong class="font-bold"><?php echo $active_user_dan['emp_name']; ?></strong></span> 
                                <a class="text-muted text-xs block"><?php echo $dan_dolzh['NAME']; ?> <b class="caret"></b></a> 
                            </span> 
                        </span>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="edit_employee?employee_id=<?php echo $dan_dolzh['ID']; ?>">Личные данные</a></li>                                                   
                            <li class="divider"></li>
                            <li><a href="block">Установить блокировку</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <img class="img-circle" src="<?php echo HTTP_NO_IMAGE_USER; ?>" style="width: 50px;"/>
                    </div>
                </li>
                
                <?php 
                    $menu = new LEFT_MENU();
                    echo $menu->init();
                ?>                
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>                
                <ul class="nav navbar-top-links navbar-left">
                    <li>
                        <span class="m-r-sm text-muted welcome-message"><h4>Информационная система АО "КСЖ "ГАК"<?php if(DB_HOST == '192.168.5.171'){echo ' Тестовая база';} ?></h4></span>
                    </li>
                </ul>                                
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#list_users_conference" id="set_video" target="_blank"><i class="fa fa-video-camera"></i></a></li>                
                <li><a href="rep"><i class="fa fa-file-text-o"></i></a></li>                
                <li>
                    <a href="javascript:;" id="rec"><i class="fa fa-microphone"></i></a>
                </li>
                                                
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks"></i>  
                        <span class="label label-primary"><?php //if($didnt_open_count != 0){echo $didnt_open_count;} ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>Задачи <?php //echo $didnt_open_count; ?></li>
                        <li>
                            <a href="create_inner_doc">
                                <div>
                                    <i class="fa fa-plus fa-fw"></i> Создать
                                    <span href="" class="pull-right text-muted small">Создать новую задачу</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="inbox">
                                <div>
                                    <i class="fa fa-list-alt fa-fw"></i> Список
                                    <span class="pull-right text-muted small">Список задач</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="inbox">
                                <div>
                                    <i class="fa fa-inbox fa-fw"></i> Входящие
                                    <span class="pull-right text-muted small">Список входящих задач</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="outbox">
                                <div>
                                    <i class="fa fa-send fa-fw"></i> Исходящие
                                    <span class="pull-right text-muted small">Список исходящих задач</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>                
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-danger"><?php //if($didnt_open_count_trash != 0){echo $didnt_open_count_trash;} ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="trash">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> У Вас <?php //echo $didnt_open_count_trash; ?> отклоненных
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>                      
                    </ul>
                </li>
                <li>
                    <a href="exit">
                        <i class="fa fa-sign-out"></i> Выйти
                    </a>
                </li>
            </ul>

        </nav>
</div>
        
        
<!-- Modal -->
<div class="modal fade" id="list_users_conference" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Выбор сотрудников для конференции</h5>        
            </div>
            
            <div class="modal-body" style="max-height: 500px;overflow: auto;">
            <form id="send_conference_form" method="post">
            <?php 
                $db = new DB();
                $email = $_SESSION[USER_SESSION]['login']."@gak.kz";
                $q = $db->Select("select 
                    email, 
                    lastname||' '||firstname||' '||middlename fio, 
                    case 
                        when branchid = '0000' then 
                        department_name(job_sp) else
                        branch_name(branchid)
                    end region
                from 
                    sup_person where state = 2 and email is not null
                    and email <> '$email'
                order by 3");
                $reg = '';
                foreach($q as $k=>$v){
                    if($reg !== $v['REGION']){
                        echo '<h2>'.$v['REGION'].'</h2>';
                    }
                    
                    echo '<label><input type="checkbox" name="user_send_conference[]" value="'.$v['EMAIL'].'"> '.$v['FIO'].'</label><br />';
                    $reg = $v['REGION'];
                }                
            ?>
            <input type="hidden" name="url_conf" value="https://192.168.5.244:9001/demos/video-conferencing.html?roomid=<?php echo $_SESSION[USER_SESSION]['login']; ?>"/>
            </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_send_conf">Отправить приглашение</button>
                <button type="button" class="btn btn-secondary" id="btn_close_conf" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="articles">                
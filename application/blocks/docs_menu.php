<?php
        $db = new DB();
        $emp_mail = $_SESSION['insurance']['other']['mail'][0];
        

        $on_inbox_new = get_newinbox_mail_count($emp_mail);
        $on_assignment = get_on_assignment_mail_count($emp_mail);
        $on_my_control = get_my_control_mail_count($emp_mail);
        $on_my_execution = get_my_execution_mail_count($emp_mail);
        $on_my_archive = get_my_archive_mail_count($emp_mail);
        $on_my_rejection = get_my_rejection_mail_count($emp_mail);

        $on_my_project = get_on_my_project_mail_count($emp_mail);
        $on_agreement = get_on_agreement_mail_count($emp_mail);
        $on_rejection = get_on_rejection_mail_count($emp_mail);
        $on_execution = get_on_execution_mail_count($emp_mail);
        $on_resulution = get_on_resulution_mail_count($emp_mail);
        $on_archive = get_on_archive_mail_count($emp_mail);
        $on_archive_outter = get_on_archive_outter_mail_count($emp_mail);
        $on_new_notification = get_newinbox_notification_mail_count($emp_mail);
        $on_notification_execution = get_my_notification_execution_mail_count($emp_mail);
        $on_notification_fin = notification_fin($emp_mail);
        $on_payment_archive = get_payment_archive($emp_mail);
        $on_payment_execution = get_payment_execution($emp_mail);
                        
        $list_sp = $db->Select("select * from sup_person where EMAIL ='$emp_mail'");
        $ispolnitel = $list_sp[0]['ID'];        
        $on_zayavka = $db->Select("select  count(*) from list_causes where state = 1");  
        $on_zayavka_upd = $on_zayavka[0]['COUNT(*)'];
        if($on_zayavka[0]['COUNT(*)'] == '0') $on_zayavka_upd = '';
        $on_rasmotrenie_spes = $db->select("select count(*) from list_causes l, executor_clauses e where (l.state =  2 or l.state = 6) and E.ID_ZAYAVKA = l.id and E.EMP_ID = $ispolnitel");
        $on_rasmotrenie_zayavka = $on_rasmotrenie_spes[0]['COUNT(*)'];
        if($on_rasmotrenie_spes[0]['COUNT(*)'] == '0') $on_rasmotrenie_zayavka = '';
        
        $user_create = $db->select("select count(*) from list_causes l, executor_clauses e where l.state =  1 and E.ID_ZAYAVKA = l.id and L.AUTHOR = $ispolnitel");
        $user_create_zayavka = $user_create[0]['COUNT(*)'];
         if($user_create[0]['COUNT(*)'] == '0') $user_create_zayavka = '';
        $user_on_ispolnenie = $db->select("select count(*) from list_causes l, executor_clauses e where l.state in(2,3,6) and E.ID_ZAYAVKA = l.id and L.AUTHOR = $ispolnitel");
        $user_on_ispolnenie_zayaka = $user_on_ispolnenie[0]['COUNT(*)'];
         if($user_on_ispolnenie[0]['COUNT(*)'] == '0') $user_on_ispolnenie_zayaka = '';
        $user_on_otklonen = $db->select("select count(*) from list_causes l, executor_clauses e where l.state in(4) and E.ID_ZAYAVKA = l.id and L.AUTHOR = $ispolnitel and l.read = 0");
        $user_on_otklonen_zayavka = $user_on_otklonen[0]['COUNT(*)'];
         if($user_on_otklonen[0]['COUNT(*)'] == '0') $user_on_otklonen_zayavka = '';
         
         
         $admin_na_rasmotrenie = $db->select("select  count(*) from list_causes where state = 1");
         $admin_na_rasmotrenie_zayavka = $admin_na_rasmotrenie[0]['COUNT(*)'];
         if($admin_na_rasmotrenie[0]['COUNT(*)'] == '0') $admin_na_rasmotrenie_zayavka = '';
         $admin_na_ispolnenie = $db->select("select count(*) from list_causes l, executor_clauses e where l.state in(2,3,6) and E.ID_ZAYAVKA = l.id");
         $admin_na_ispolnenie_zayavka = $admin_na_ispolnenie[0]['COUNT(*)'];
         if($admin_na_ispolnenie[0]['COUNT(*)'] == '0') $admin_na_ispolnenie_zayavka = '';
         $admin_zavershen = $db->select("select count(*) from list_causes l, executor_clauses e where l.state in(5) and E.ID_ZAYAVKA = l.id");
         $admin_zavershen_zayavka = $admin_zavershen[0]['COUNT(*)'];
         if($admin_zavershen[0]['COUNT(*)'] == '0') $admin_zavershen_zayavka = '';
         $admin_otklonen = $db->select("select count(*) from list_causes l, executor_clauses e where l.state in(4) and E.ID_ZAYAVKA = l.id");
         $admin_otklonen_zayavka = $admin_otklonen[0]['COUNT(*)'];
         if($admin_otklonen[0]['COUNT(*)'] == '0') $admin_otklonen_zayavka = '';
         


        $on_project = get_on_project_mail_count($emp_mail);
        $on_agreement_out = get_on_agreement_out_mail_count($emp_mail);
        $on_registration = get_on_registration_mail_count($emp_mail);

        $contr_on_exec_from_reception = get_contr_on_exec_from_reception_count($emp_mail);
        $contr_on_reject_from_reception_count = get_contr_on_reject_from_reception_count($emp_mail);
        $contr_on_reject_from_reception_count = get_from_on_reception_archive_count($emp_mail);

        $menu_html = 
        '<li class="doc_inbox" id="doc_inbox">
        <a href="#">ВХОДЯЩИЕ<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level2">
                <li class="on_inbox_new" id="on_inbox_new">
                    <a href="on_inbox_new" data1="doc_inbox" data2="documentooborot">Новые <span class="label label-info pull-right">'.$on_inbox_new.'</span></a>
                </li>
                <li>
                    <a href="on_assignment" data1="doc_inbox" data2="documentooborot">Делегировано <span class="label label-info pull-right">'.$on_assignment.'</span></a>
                </li>
                <li>
                    <a href="on_my_control" data1="doc_inbox" data2="documentooborot">На контроле <span class="label label-info pull-right">'.$on_my_control.'</span></a>
                </li>                    
                <li>
                    <a href="on_my_execution" data1="doc_inbox" data2="documentooborot">На исполнении <span class="label label-info pull-right">'.$on_my_execution.'</span></a>
                </li>
                <li>
                    <a href="on_my_archive" data1="doc_inbox" data2="documentooborot">В архиве <span class="label label-info pull-right">'.$on_my_archive.'</span></a>
                </li>
                <li>
                    <a href="on_my_rejection" data1="doc_inbox" data2="documentooborot">Отклоненные <span class="label label-info pull-right">'.$on_my_rejection.'</span></a>
                </li>
            </ul>
        </li>
        <li class="doc_my_project" id="doc_my_project">
        <a href="#">МОИ ПРОЕКТЫ (ВНУТРЕННИЕ)<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
                <li>
                    <a href="on_my_project" data1="doc_my_project" data2="documentooborot">Проекты<span class="label label-info pull-right">'.$on_my_project.'</span></a>
                </li>
                <li>
                    <a href="on_agreement" data1="doc_my_project" data2="documentooborot">На согласовании <span class="label label-info pull-right">'.$on_agreement.'</span></a>
                </li>
                <li>
                    <a href="on_rejection" data1="doc_my_project" data2="documentooborot">Отклоненные <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                </li>
                <li>
                    <a href="on_execution" data1="doc_my_project" data2="documentooborot">В работе <span class="label label-info pull-right">'.$on_execution.'</span></a>
                </li>
                <li>
                    <a href="on_resulution" data1="doc_my_project" data2="documentooborot">Ожидает резолюции <span class="label label-info pull-right">'.$on_resulution.'</span></a>
                </li>
                <li>
                    <a href="on_archive" data1="doc_my_project" data2="documentooborot">Завершенные <span class="label label-info pull-right">'.$on_archive.'</span></a>
                </li>
            </ul>
        </li>
        <li class="doc_outbox" id="doc_outbox">
        <a href="#">МОИ ПРОЕКТЫ (ВНЕШНИЕ)<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
                <li>
                    <a href="on_project" data1="doc_outbox" data2="documentooborot">Проекты<span class="label label-info pull-right">'.$on_project.'</span></a>
                </li>
                <li>
                    <a href="on_agreement_out" data1="doc_outbox" data2="documentooborot">На согласовании/подписании<span class="label label-info pull-right">'.$on_agreement_out.'</span></a>
                </li>
                <li>
                    <a href="on_registration" data1="doc_outbox" data2="documentooborot">Подписанные <span class="label label-info pull-right">'.$on_registration.'</span></a>
                </li>
                <li>
                    <a href="on_archive_outter" data1="doc_outbox" data2="documentooborot">Отправленные <span class="label label-info pull-right">'.$on_archive_outter.'</span></a>
                </li>
                <li>
                    <a href="on_rejection" data1="doc_outbox" data2="documentooborot">Отклоненные <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                </li>
            </ul>
        </li>
        
        
        <li class="doc_notification" id="doc_notification">
        <a href="#">Уведомления<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">                
                <li>
                    <a href="on_my_notification_execution" data1="doc_notification" data2="documentooborot">На исполнении<span class="label label-info pull-right">'.$on_notification_execution.'</span></a>
                </li>
                <li>
                    <a href="end_notification" data1="doc_notification" data2="documentooborot">Завершенные<span class="label label-info pull-right">'.$on_notification_fin.'</span></a>
                </li>                                             
            </ul>
        </li>
        
        <li class="assign" id="assign">
        <a href="#">ПОРУЧЕНИЯ<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
                <li>
                    <a href="assign" data1="assign" data2="documentooborot">Действующие поручения<span class="label label-info pull-right">'.$on_project.'</span></a>
                </li>';

                if($emp_mail == 'i.akhmetov@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                if($emp_mail == 'b.abdisamat@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                if($emp_mail == 'z.saganayeva@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                if($emp_mail == 's.toktarova@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                 if($emp_mail == 'z.ussembayev@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                if($emp_mail == 'g.amerkhojayev@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                if($emp_mail == 'd.kassimova@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                if($emp_mail == 'a.makanova@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                if($emp_mail == 'zh.zhumakova@gak.kz')
                {
                    $menu_html .=  '<li><a href="assign_accept" data1="assign" data2="documentooborot">Завершенные поручения<span class="label label-info pull-right">'.$on_project.'</span></a></li>';
                }
                
                  if($emp_mail ==  'b.abdisamat@gak.kz' or $emp_mail == 'g.sabirova@gak.kz' or $emp_mail == 'l.portyankina@gak.kz' or $emp_mail == 'a.ildibayeva@gak.kz' or $emp_mail == 'g.nurtazhiyeva@gak.kz' or $emp_mail == 'a.sadykova@gak.kz' or $emp_mail == 'a.nurzhakhanova@gak.kz')
        {  
         $menu_html .= 
            '</ul>
        </li>
        
                <li class="payment_orders" id="payment_orders">
        <a href="#">Распоряжения на выплату<span class="fa arrow"></span></a> 
            <ul class="nav nav-third-level">
                <li>
                    <a href="payment_orders_execute" data1="payment_orders" data2="documentooborot">На исполнении<span class="label label-info pull-right">'.$on_payment_execution.'</span></a>                    
                </li>
                <li>
                        <a href="payment_orders_archive"  data1="payment_orders" data2="documentooborot">Завершенные<span class="label label-info pull-right">'.$on_payment_archive.'</span></a>
                </li>                                       
                ';                
        } 

        $menu_html .= 
            '</ul>
        </li>
        
                <li class="recomendation" id="recomendation">
        <a href="#">Рекомендации Комплаенс-контроллера<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
                <li>
                    <a href="compliance_recommendations" data1="recomendation" data2="documentooborot">Действующие рекомендации<span class="label label-info pull-right">'.$on_project.'</span></a>
                </li>';

                if($emp_mail == 'a.auganbaeva@gak.kz')
                {
                    $menu_html .=  '<li><a href="completed_recommendations" data1="recomendation" data2="documentooborot">Завершенные рекомендации<span class="label label-info pull-right"></span></a></li>';
                }
                
                if($emp_mail == 'b.abdisamat@gak.kz')
                {
                    $menu_html .=  '<li><a href="completed_recommendations" data1="recomendation" data2="documentooborot">Завершенные рекомендации<span class="label label-info pull-right"></span></a></li>';
                }
                
                
                      

                
                
                
                
       
                  if($emp_mail !=  'n.omirbekov@gak.kz' and $emp_mail != 'a.omarov@gak.kz' and $emp_mail != 'n.kulzhanov@gak.kz')
        {  
         $menu_html .= 
            '</ul>
        </li>
        
                <li class="cause" id="cause">
        <a href="#">Мои Заявки в ДИТ<span class="fa arrow"></span></a> 
            <ul class="nav nav-third-level">
                <li>
                    <a href="applications_dit" data1="cause" data2="documentooborot">Подать заявку<span class="label label-info pull-right"></span></a>                    
                </li>
                <li>
                        <a href="user_zayavka"  data1="cause" data2="documentooborot">Созданные<span class="label label-info pull-right">'.$user_create_zayavka.'</span></a>
                    </li>
                    <li>
                        <a href="user_zayavka_ispolnennie" data1="cause" data2="documentooborot" >На исполнении<span class="label label-info pull-right">'.$user_on_ispolnenie_zayaka.'</span></a>
                    </li>
                    <li>
                        <a href="user_otklonennie" data1="cause" data2="documentooborot" >Отклоненные<span class="label label-info pull-right">'.$user_on_otklonen_zayavka.'</span></a>
                    </li>                    
                    <li>
                        <a href="user_zayavka_zav" data1="cause" data2="documentooborot" >Завершенные<span class="label label-info pull-right"></span></a>
                    </li>                                             
                ';                
        }
                
                if($emp_mail == 'n.kulzhanov@gak.kz' or $emp_mail ==  'b.abdisamat@gak.kz') {
                    
                    
                       $menu_html .= 
            '</ul>
        </li>
        
                <li class="list_cause" id="list_cause">
        <a href="#">Список заявок<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">                                
                    <li>
                        <a href="zayavki_admin_na_rassmotrenii" data1="list_cause" data2="documentooborot" >На расмотрении<span class="label label-info pull-right">'.$admin_na_rasmotrenie_zayavka.'</span></a>
                    </li>
                    <li>
                        <a href="zayavki_admin_na_ispolnenii" data1="list_cause" data2="documentooborot" >На исполнении<span class="label label-info pull-right">'.$admin_na_ispolnenie_zayavka.'</span></a>
                    </li> 
                    <li>
                        <a href="zayavki_admin_otklonen" data1="list_cause" data2="documentooborot" >Отклоненные<span class="label label-info pull-right">'.$admin_otklonen_zayavka.'</span></a>
                    </li>                   
                    <li>
                        <a href="zayavki_admin_end" data1="list_cause" data2="documentooborot" >Завершенные<span class="label label-info pull-right">'.$admin_zavershen_zayavka.'</span></a>
                    </li>
                    <li>
                        <a href="my_clauses" data1="list_cause" data2="documentooborot" >Общий список<span class="label label-info pull-right"></span></a>
                    </li>
             
                
                ';                                                            
                }
         
     
  /*          $menu_html .= 
            '<li class="zayavka" id="zayavka">
                <a href="#">Мои заявки <span class="fa arrow"></span></a>
                    <ul class="nav nav-fourth-level">
                    <li>
                        <a href="user_zayavka"  data1="cause" data2="documentooborot">Созданные<span class="label label-info pull-right"></span></a>
                    </li>
                    <li>
                        <a href="user_zayavka_ispolnennie" data1="cause" data2="documentooborot" >На исполнении<span class="label label-info pull-right"></span></a>
                    </li>
                    <li>
                        <a href="user_zayavka_zav" data1="cause" data2="documentooborot" >Завершенные<span class="label label-info pull-right"></span></a>
                    </li>
                </ul>
            </li>
                    '; */
               
         
         
                

            
            
                   if($emp_mail ==  'n.omirbekov@gak.kz' or $emp_mail == 'a.omarov@gak.kz')
        {   
             $menu_html .= 
             '
             
             </ul>
        </li>
        
                <li class="zayavka" id="zayavka">
        <a href="#">Входящие заявки<span class="fa arrow"></span></a> 
            <ul class="nav nav-third-level">
             
             
                <li>
                <a href="na_rassmotrenii" data1="zayavka" data2="documentooborot">На рассмотрении<span class="label label-info pull-right">'.$on_zayavka_upd.'</span></a>
             </li>
             <li>
                <a href="na_ispolnenii" data1="zayavka" data2="documentooborot">На исполнении<span class="label label-info pull-right">'.$on_rasmotrenie_zayavka.'</span></a>
             </li>
             <li>
                <a href="ispolnennie" data1="zayavka" data2="documentooborot">Исполненные<span class="label label-info pull-right"></span></a>
             </li>             
                ';                                        
            }
       
                
               

        $menu_html .= 
            '</ul>
        </li>
                                                                
        <li class="doc_syst">
            <a href="docsyst_report"><i class=""></i>Отчет по СЭД</a>
        </li>
        <li class="doc_search" id="doc_search">
        <a href="#">ПОИСК <span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
                <li>
                    <a href="all_my_docs" data1="doc_search" data2="documentooborot">Все мои документы<span class="label label-info pull-right"></span></a>
                </li>
            </ul>
        </li>';

        if($emp_mail == 'i.akhmetov@gak.kz')
        {
            $menu_html .= 
            '<li>
                <a href="#">История всех писем <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <li>
                        <a href="mail_history_of_employees">Документы сотрудников<span class="label label-info pull-right"></span></a>
                    </li>
                    <li>
                        <a href="mail_history">Все письма<span class="label label-info pull-right"></span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Канцелярия (в разработке) <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <li>
                        <a href="on_exec_from_reception">В работе <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                    <li>
                        <a href="on_reception">Отклоненные <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                    <li>
                        <a href="on_reception_archive">Архив <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                </ul>
            </li>
            <li class="doc_syst">
                <a href="office_report"><i class=""></i>Отчет по СЭД (канцелярия)</a>
            </li>';
        }
        
                if($emp_mail == 'b.abdisamat@gak.kz')
        {
            $menu_html .= 
            '<li>
                <a href="#">История всех писем <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <li>
                        <a href="mail_history_of_employees">Документы сотрудников<span class="label label-info pull-right"></span></a>
                    </li>
                    <li>
                        <a href="mail_history">Все письма<span class="label label-info pull-right"></span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Канцелярия (в разработке) <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <li>
                        <a href="on_exec_from_reception">В работе <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                    <li>
                        <a href="on_reception">Отклоненные <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                    <li>
                        <a href="on_reception_archive">Архив <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                </ul>
            </li>
            <li class="doc_syst">
                <a href="office_report"><i class=""></i>Отчет по СЭД (канцелярия)</a>
            </li>
            <li class="doc_syst">
                <a href="outgoing_mail_journal"><i class=""></i>Журнал регистрации исходящей корреспонденции
</a>
            </li>
            <li class="doc_syst">
                <a href="inbox_mail_journal"><i class=""></i>Журнал регистрации входящей корреспонденции
</a>
            </li>
            ';
        }
        
        

        if($emp_mail == 'd.nurkeibekova@gak.kz')
        {
            $menu_html .= 
            '<li>
                <a href="#">Канцелярия (в разработке) <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <li>
                        <a href="on_exec_from_reception">В работе <span class="label label-info pull-right">'.$contr_on_exec_from_reception.'</span></a>
                    </li>
                    <li>
                        <a href="on_reject_from_reception">Отклоненные <span class="label label-info pull-right">'.$contr_on_reject_from_reception_count.'</span></a>
                    </li>
                    <li>
                        <a href="on_reception_archive">Архив <span class="label label-info pull-right">'.$contr_on_exec_from_reception.'</span></a>
                    </li>
                </ul>
            </li>
            <li class="doc_syst">
                <a href="office_report"><i class=""></i>Отчет по СЭД (канцелярия)</a>
            </li>
            <li class="doc_syst">
                <a href="outgoing_mail_journal"><i class=""></i>Журнал регистрации исходящей корреспонденции
</a>
            </li>
            ';
        }

        if($emp_mail == 'i.gabdusheva@gak.kz')
        {
            $menu_html .= 
            '<li>
                <a href="#">История всех писем <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <li>
                        <a href="mail_history_of_employees">Документы сотрудников<span class="label label-info pull-right"></span></a>
                    </li>
                    <li>
                        <a href="mail_history">Все письма<span class="label label-info pull-right"></span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Канцелярия (в разработке) <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <li>
                        <a href="on_exec_from_reception">В работе <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                    <li>
                        <a href="on_reception">Отклоненные <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                    <li>
                        <a href="on_reception_archive">Архив <span class="label label-info pull-right">'.$on_rejection.'</span></a>
                    </li>
                </ul>
            </li>
            <li class="doc_syst">
                <a href="office_report"><i class=""></i>Отчет по СЭД (канцелярия)</a>
            </li>
            <li class="doc_syst">
                <a href="outgoing_mail_journal"><i class=""></i>Журнал регистрации исходящей корреспонденции
</a>
            </li>
            ';
        }
        

        
        
        
        function notification_fin($emp_mail){
            
            $db = new DB();
            
             //адресаты
    $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 2
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = '';

    //согласования
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 2
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    //делегированные
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 2
                       and rec.DESTINATION = 5
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);
    
    
    
    
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_CONTROL rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 2
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);
    
    

    //канцелярия, исходящая
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);        

    //канцелярия, входящая
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_REGISTRATION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    //добавление согласующего
    $sql_inbox .= "select 
                          doc.CURRENT_STEP_ID, 
                          doc.NEXT_STEP_ID, 
                          doc.PREV_STEP_ID, 
                          doc.REG_NUM, 
                          doc.DATE_END, 
                          doc.SENDER, 
                          rec.DESTINATION, 
                          doc.DOC_LINK, 
                          rec.READ, 
                          DOC.DATE_START, 
                          KIND.NAME_KIND, 
                          STATE.STATE_NAME, 
                          DOC.SHORT_TEXT, 
                          rec.ID, 
                          doc.ID MAIL_ID, 
                          REC.COMMENT_TO_DOC, 
                          REC.RECIEP_MAIL 
                        from
                          DOC_RECIEPMENTS_ASSIGNMENT rec,
                          DOCUMENTS doc,
                          DIC_DOC_STATE state,
                          DIC_DOC_KIND kind
                        where
                          rec.RECIEP_MAIL = '$emp_mail'
                          and REC.STATE = STATE.ID
                          and REC.MAIL_ID = DOC.ID
                          and KIND.ID = DOC.KIND
                          and rec.STATE = 2
                          and doc.kind = 3
                          ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);
    

    //резолюция
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    //подписания
    $sql_inbox .= "select
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_SIGNATURE rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 3
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_inbox);
    
    //при отклонении
    
        
     $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 3 OR rec.STATE = 6)
                       and DOC.STATE = 6
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";    
    $list_reciep = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_reciep, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and  rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL 
                    from
                       DOC_RECIEPMENTS_SIGNATURE rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);
    
    
    
   
   
   
   
   
   
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 3
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_reciep = $db -> Select($sql_inbox);
    $sql_inbox = '';
     $list_all_inbox = array_merge($list_reciep, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 3
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_ASSIGNMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 3
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $list_all_inbox = array_merge($list_regist, $list_all_inbox); 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
                                                
            $on_fin_notification = count($list_all_inbox);
            if($on_fin_notification == '0') $on_fin_notification = '';
            return $on_fin_notification;
    
            
        }
        
        

        function get_newinbox_mail_count($emp_mail)
        {
            $db = new DB();            
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 0";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = $list_inbox;

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Делигировано' table_name,
                               '5' state_id,
                               'DOC_RECIEPMENTS_ASSIGNMENT' table_name_eng
                            from
                               DOC_RECIEPMENTS_ASSIGNMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На резолюции' table_name,
                               '1' state_id,
                               'DOC_RECIEPMENTS_RESOLUTION' table_name_eng
                            from
                               DOC_RECIEPMENTS_RESOLUTION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На исполнении' table_name,
                               '4' state_id,
                               'DOC_RECIEPMENTS' table_name_eng
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На подписании' table_name,
                               '3' state_id,
                               'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Исходящее (на регистрацию)' table_name,
                               '7' state_id,
                               'DOC_RECIEPMENTS_REGIST_OUT' table_name_eng
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            
            
            $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'на контроле' table_name,
                       '3' state_id,
                       'DOC_RECIEPMENTS_CONTROL' table_name_eng
                    from
                       DOC_RECIEPMENTS_CONTROL rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 0";
                       
          $sql_inbox .= "order by rec.ID";
          $list_inbox = $db->select($sql_inbox);
          $sql_inbox = "";
          $list_all_inbox = array_merge($list_inbox, $list_all_inbox);  
          
          
          
                  $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       rec.link_file,
                       'На ознакомлении' table_name,
                       '6' state_id,
                       'DOC_RECEIP_USAGE' table_name_eng
                    from
                       DOC_RECEIP_USAGE rec,
                       DOCUMENTS doc,                        
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and rec.mail_id = doc.id                       
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 0";
                       
          $sql_inbox .= "order by rec.ID";
          $list_inbox = $db->select($sql_inbox);
          $sql_inbox = "";
          $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
          
          
          
                                            
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }
        
        
        
        function get_newinbox_notification_mail_count($emp_mail)
        {
            $db = new DB();            
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 0
                       and doc.kind = 3
                       ";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = $list_inbox;

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Делигировано' table_name,
                               '5' state_id,
                               'DOC_RECIEPMENTS_ASSIGNMENT' table_name_eng
                            from
                               DOC_RECIEPMENTS_ASSIGNMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0
                               and doc.kind = 3
                               ";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На резолюции' table_name,
                               '1' state_id,
                               'DOC_RECIEPMENTS_RESOLUTION' table_name_eng
                            from
                               DOC_RECIEPMENTS_RESOLUTION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0
                               and doc.kind = 3
                               ";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На исполнении' table_name,
                               '4' state_id,
                               'DOC_RECIEPMENTS' table_name_eng
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0
                               and doc.kind = 3
                               ";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На подписании' table_name,
                               '3' state_id,
                               'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0
                               and doc.kind = 3
                               ";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Исходящее (на регистрацию)' table_name,
                               '7' state_id,
                               'DOC_RECIEPMENTS_REGIST_OUT' table_name_eng
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 0
                               and doc.kind = 3
                               ";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            
            
            $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'на контроле' table_name,
                       '3' state_id,
                       'DOC_RECIEPMENTS_CONTROL' table_name_eng
                    from
                       DOC_RECIEPMENTS_CONTROL rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 0
                       and doc.kind = 3
                       ";
                       
          $sql_inbox .= "order by rec.ID";
          $list_inbox = $db->select($sql_inbox);
          $sql_inbox = "";
          $list_all_inbox = array_merge($list_inbox, $list_all_inbox);                                    
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }
        

        function get_on_assignment_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               REC.RECIEP_MAIL
                            from
                               DOC_RECIEPMENTS_ASSIGNMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID
                               and (rec.STATE = 0 OR rec.STATE = 1)
                               and REC.DESTINATION = '5'
                               and KIND.ID = DOC.KIND";
            $list_inbox = $db -> Select($sql_inbox);
            $list_all_inbox = $list_inbox;
            $sql_inbox = "";

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               REC.RECIEP_MAIL
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID
                               and (rec.STATE = 0 OR rec.STATE = 1)
                               and REC.DESTINATION = '5'
                               and KIND.ID = DOC.KIND";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_my_control_mail_count($emp_mail)
        {
            $db = new DB();            
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       rec.state 
                    from
                       DOC_RECIEPMENTS_CONTROL rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID
                       and (doc.STATE != 7 and doc.STATE != 5 and doc.STATE != 6 and doc.state != 11)
                       and KIND.ID = DOC.KIND
                       and rec.state in (1,2)";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);                                                                        
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_my_execution_mail_count($emp_mail)
        {
            $db = new DB();            
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind != 3
                       ";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = $list_inbox;
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Делигировано' table_name,
                               '5' state_id,
                               'DOC_RECIEPMENTS_ASSIGNMENT' table_name_eng
                            from
                               DOC_RECIEPMENTS_ASSIGNMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1
                               and doc.kind != 3
                               ";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На резолюции' table_name,
                               '1' state_id,
                               'DOC_RECIEPMENTS_RESOLUTION' table_name_eng
                            from
                               DOC_RECIEPMENTS_RESOLUTION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1
                               and doc.kind != 3
                               ";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На исполнении' table_name,
                               '4' state_id,
                               'DOC_RECIEPMENTS' table_name_eng
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1
                               and doc.kind != 3
                               ";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На подписании' table_name,
                               '3' state_id,
                               'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1
                               and doc.kind != 3
                               ";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Исходящее (на регистрацию)' table_name,
                               '7' state_id,
                               'DOC_RECIEPMENTS_REGIST_OUT' table_name_eng
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1
                               and doc.kind != 3
                               ";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            
            
            
                $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На ознакомлении' table_name,
                       '6' state_id,
                       'DOC_RECIEPMENTS' table_name_eng
                    from
                       DOC_RECEIP_USAGE rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind != 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            
            
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }
        
        
        
        
        
        function get_my_notification_execution_mail_count($emp_mail)
        {
            $db = new DB();            
 
 
   $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                        and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = $list_inbox;

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'Делигировано' table_name,
                       '5' state_id,
                       'DOC_RECIEPMENTS_ASSIGNMENT' table_name_eng
                    from
                       DOC_RECIEPMENTS_ASSIGNMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                        and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На резолюции' table_name,
                       '1' state_id,
                       'DOC_RECIEPMENTS_RESOLUTION' table_name_eng
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                        and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На исполнении' table_name,
                       '4' state_id,
                       'DOC_RECIEPMENTS' table_name_eng
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На подписании' table_name,
                       '3' state_id,
                       'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                    from
                       DOC_RECIEPMENTS_SIGNATURE rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'Исходящее (на регистрацию)' table_name,
                       '7' state_id,
                       'DOC_RECIEPMENTS_REGIST_OUT' table_name_eng
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
    
    
    
        $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind,
                       SUP_PERSON trivial
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 2
                       and trivial.EMAIL = REC.RECIEP_MAIL
                       and doc.kind = 3
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
    
    
    
  
    
      
        
    
    $sql_inbox .= " select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind,
                       SUP_PERSON trivial
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 3
                       and trivial.EMAIL = REC.RECIEP_MAIL
                       and doc.kind = 3
                       ";
                       
                         if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }
    
                        $sql_inbox .= " order by rec.ID";
                       $list_inbox = $db->select($sql_inbox);
                       $sql_inbox = '';
                      $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
                      
                      
                      
                      
                       $sql_inbox .= " select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind,
                       SUP_PERSON trivial
                    where
                       doc.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 3
                       and trivial.EMAIL = REC.RECIEP_MAIL
                       and doc.kind = 3
                       ";
                       
                         if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }
    
                        $sql_inbox .= " order by rec.ID";
                       $list_inbox = $db->select($sql_inbox);
                       $sql_inbox = '';
                      $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
                      
                      
                                                                                                              
                      $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL ,
                       rec.state
                    from
                       DOC_RECIEPMENTS_CONTROL rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID
                       and (doc.STATE != 7 and doc.STATE != 5 and doc.STATE != 6 and doc.STATE != 11)
                       and KIND.ID = DOC.KIND
                       and rec.state in (1,2)
                       and doc.kind = 3 
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }
        
        
        
        
        

        function get_my_archive_mail_count($emp_mail)
        {
            $db = new DB();
            //адресаты
            $sql_inbox = "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 2";

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = '';

            //согласования
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL
                            from
                               DOC_RECIEPMENTS_AGREEMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and rec.STATE = 2";

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_inbox = array_merge($list_regist, $list_inbox);

            //делегированные
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and rec.STATE = 2
                               and rec.DESTINATION = 5";
            
            $sql_inbox .= " order by rec.ID";
            //echo $sql_inbox;
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_inbox = array_merge($list_regist, $list_inbox);
    
            //добавление согласующего
            $sql_inbox .= "select 
                                  doc.CURRENT_STEP_ID, 
                                  doc.NEXT_STEP_ID, 
                                  doc.PREV_STEP_ID, 
                                  doc.REG_NUM, 
                                  doc.DATE_END, 
                                  doc.SENDER, 
                                  rec.DESTINATION, 
                                  doc.DOC_LINK, 
                                  rec.READ, 
                                  DOC.DATE_START, 
                                  KIND.NAME_KIND, 
                                  STATE.STATE_NAME, 
                                  DOC.SHORT_TEXT, 
                                  rec.ID, 
                                  doc.ID MAIL_ID, 
                                  REC.COMMENT_TO_DOC, 
                                  REC.RECIEP_MAIL 
                                from
                                  DOC_RECIEPMENTS_ASSIGNMENT rec,
                                  DOCUMENTS doc,
                                  DIC_DOC_STATE state,
                                  DIC_DOC_KIND kind
                                where
                                  rec.RECIEP_MAIL = '$emp_mail'
                                  and REC.STATE = STATE.ID
                                  and REC.MAIL_ID = DOC.ID
                                  and KIND.ID = DOC.KIND
                                  and rec.STATE = 2";
            
            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_inbox = array_merge($list_regist, $list_inbox);                                    
                
            //Ознакомленные
            $sql_inbox .= "select 
                                  doc.CURRENT_STEP_ID, 
                                  doc.NEXT_STEP_ID, 
                                  doc.PREV_STEP_ID, 
                                  doc.REG_NUM, 
                                  doc.DATE_END, 
                                  doc.SENDER, 
                                  rec.DESTINATION, 
                                  doc.DOC_LINK, 
                                  rec.READ, 
                                  DOC.DATE_START, 
                                  KIND.NAME_KIND, 
                                  STATE.STATE_NAME, 
                                  DOC.SHORT_TEXT, 
                                  rec.ID, 
                                  doc.ID MAIL_ID, 
                                  REC.COMMENT_TO_DOC, 
                                  REC.RECIEP_MAIL 
                                from
                                  DOC_RECEIP_USAGE rec,
                                  DOCUMENTS doc,
                                  DIC_DOC_STATE state,
                                  DIC_DOC_KIND kind
                                where
                                  rec.RECIEP_MAIL = '$emp_mail'
                                  and REC.STATE = STATE.ID
                                  and REC.MAIL_ID = DOC.ID
                                  and KIND.ID = DOC.KIND
                                  and rec.STATE = 2";
            
            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_inbox = array_merge($list_regist, $list_inbox);

            //канцелярия, исходящая
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                               and DOC.STATE = 7";
            
            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_inbox = array_merge($list_regist, $list_inbox);

            //канцелярия, входящая
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL
                            from
                               DOC_RECIEPMENTS_REGISTRATION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                               and DOC.STATE = 7";
            
            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_inbox = array_merge($list_regist, $list_inbox);
        
            //резолюция
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL
                            from
                               DOC_RECIEPMENTS_RESOLUTION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                               and DOC.STATE = 7";
            
            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_inbox = array_merge($list_regist, $list_inbox);
        
            //подписания
            $sql_inbox .= "select
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                               and DOC.STATE = 7";
            
            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $list_all_inbox = array_merge($list_regist, $list_inbox);
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_my_rejection_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 3";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_reciep = $db -> Select($sql_inbox);
            $sql_inbox = '';

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS_AGREEMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and rec.STATE = 3";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = '';
            $list_inbox = array_merge($list_regist, $list_reciep);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS_ASSIGNMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and rec.STATE = 3";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $list_inbox = array_merge($list_regist, $list_inbox);
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_my_project_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "SELECT doc.CURRENT_STEP_ID,
                           doc.NEXT_STEP_ID,
                           doc.PREV_STEP_ID,
                           doc.REG_NUM,
                           doc.DATE_END,
                           doc.SENDER,
                           doc.DOC_LINK,
                           DOC.DATE_START,
                           DOC.SHORT_TEXT,
                           doc.ID MAIL_ID
                    FROM 
                        DOCUMENTS doc
                    WHERE
                      doc.SENDER_MAIL = '$emp_mail'
                      AND DOC.STATE = 0
                      AND doc.TYPE = '0'
                    ORDER BY doc.ID";
            $list_reciep = $db -> Select($sql_inbox);
            $on_inbox_new = count($list_reciep);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_agreement_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL,
                       trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind,
                       SUP_PERSON trivial
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and DOC.TYPE = 0
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and trivial.EMAIL = REC.RECIEP_MAIL";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_rejection_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and (rec.STATE = 3 OR rec.STATE = 6)
                               and DOC.STATE = 6";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";    
            $list_reciep = $db -> Select($sql_inbox);
            $sql_inbox = '';

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS_AGREEMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 3
                               and DOC.STATE = 6";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_reciep = array_merge($list_regist, $list_reciep);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS_RESOLUTION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 3
                               and DOC.STATE = 6";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_reciep = array_merge($list_regist, $list_reciep);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and  rec.STATE = 3
                               and DOC.STATE = 6";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_reciep = array_merge($list_regist, $list_reciep);

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL 
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 3
                               and DOC.STATE = 6";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_reciep = array_merge($list_regist, $list_reciep);
            $list_inbox = $list_reciep;
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_execution_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind,
                               SUP_PERSON trivial
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and (rec.STATE = 0 or rec.STATE = 1)
                               and DOC.STATE = 3
                               and trivial.EMAIL = REC.RECIEP_MAIL
                               and doc.kind != 3
                               ";                                                                                             

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            
            $sql_inbox = '';
            
            $sql_inbox .= " select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind,
                               SUP_PERSON trivial
                            where
                               doc.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and (rec.STATE = 0 or rec.STATE = 1)
                               and DOC.STATE = 3
                               and trivial.EMAIL = REC.RECIEP_MAIL";
                               
                               $list_rec = $db->select($sql_inbox);
                               
                               $list_inbox = array_merge($list_rec, $list_inbox); 
            
            
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_resulution_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 2";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_archive_outter_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                              doc.CURRENT_STEP_ID,
                              doc.NEXT_STEP_ID,
                              doc.PREV_STEP_ID,
                              doc.REG_NUM,
                              doc.DATE_END,
                              doc.SENDER,
                              rec.DESTINATION,
                              doc.DOC_LINK,
                              rec.READ,
                              DOC.DATE_START,
                              KIND.NAME_KIND,
                              STATE.STATE_NAME,
                              DOC.SHORT_TEXT,
                              rec.ID,
                              doc.ID MAIL_ID,
                              REC.COMMENT_TO_DOC,
                              REC.SENDER_MAIL
                            from
                              DOC_RECIEPMENTS_REGIST_OUT rec,
                              DOCUMENTS doc,
                              DIC_DOC_STATE state,
                              DIC_DOC_KIND kind
                            where
                              doc.SENDER_MAIL = '$emp_mail'
                              and REC.STATE = STATE.ID
                              and REC.MAIL_ID = DOC.ID
                              and KIND.ID = DOC.KIND
                              and DOC.TYPE = 1
                              and DOC.STATE = 7";
            
            $sql_inbox .= " order by rec.ID";
            $list_reciep = $db -> Select($sql_inbox);
            $on_inbox_new = count($list_reciep);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_archive_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               AND rec.STATE = 2
                               AND (DOC.STATE = 7
                               OR DOC.STATE = 3)";

            $sql_inbox .= " order by rec.ID";
            $list_reciep = $db -> Select($sql_inbox);
            $sql_inbox = '';

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID
                               and REC.MAIL_ID = DOC.ID
                               and KIND.ID = DOC.KIND
                               and rec.STATE = 2
                               and DOC.STATE = 7";

            $sql_inbox .= " order by rec.ID";
            $list_regist = $db -> Select($sql_inbox);
            $list_inbox = array_merge($list_regist, $list_reciep);
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_project_mail_count($emp_mail)
        {
            $db = new DB();
            global $othersJs;
            $othersJs .= "<script>
                    $(document).ready(function(){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    });
                  </script>";

            $sql_inbox = "SELECT doc.CURRENT_STEP_ID,
                                   doc.NEXT_STEP_ID,
                                   doc.PREV_STEP_ID,
                                   doc.REG_NUM,
                                   doc.DATE_END,
                                   doc.SENDER,
                                   doc.DOC_LINK,
                                   DOC.DATE_START,
                                   DOC.SHORT_TEXT,
                                   doc.ID MAIL_ID
                            FROM DOCUMENTS doc
                            WHERE doc.SENDER_MAIL = '$emp_mail'
                              AND DOC.STATE = 0
                              AND doc.TYPE = '1'
                            ORDER BY doc.ID";
            $list_reciep = $db -> Select($sql_inbox);
            $on_inbox_new = count($list_reciep);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_agreement_out_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and DOC.TYPE = 1
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 OR rec.STATE = 1)";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = $list_inbox;

            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На подписании' table_name,
                               '3' state_id,
                               'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.SENDER_MAIL = '$emp_mail'
                               and DOC.TYPE = 1
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND
                               and (rec.STATE = 0 OR rec.STATE = 1)";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_on_registration_mail_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 10";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_contr_on_exec_from_reception_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = $list_inbox;
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Делигировано' table_name,
                               '5' state_id,
                               'DOC_RECIEPMENTS_ASSIGNMENT' table_name_eng
                            from
                               DOC_RECIEPMENTS_ASSIGNMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На резолюции' table_name,
                               '1' state_id,
                               'DOC_RECIEPMENTS_RESOLUTION' table_name_eng
                            from
                               DOC_RECIEPMENTS_RESOLUTION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На исполнении' table_name,
                               '4' state_id,
                               'DOC_RECIEPMENTS' table_name_eng
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На подписании' table_name,
                               '3' state_id,
                               'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Исходящее (на регистрацию)' table_name,
                               '7' state_id,
                               'DOC_RECIEPMENTS_REGIST_OUT' table_name_eng
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }

        function get_contr_on_reject_from_reception_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = $list_inbox;
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Делигировано' table_name,
                               '5' state_id,
                               'DOC_RECIEPMENTS_ASSIGNMENT' table_name_eng
                            from
                               DOC_RECIEPMENTS_ASSIGNMENT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На резолюции' table_name,
                               '1' state_id,
                               'DOC_RECIEPMENTS_RESOLUTION' table_name_eng
                            from
                               DOC_RECIEPMENTS_RESOLUTION rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На исполнении' table_name,
                               '4' state_id,
                               'DOC_RECIEPMENTS' table_name_eng
                            from
                               DOC_RECIEPMENTS rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'На подписании' table_name,
                               '3' state_id,
                               'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                            from
                               DOC_RECIEPMENTS_SIGNATURE rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
        
            $sql_inbox .= "select
                               doc.CURRENT_STEP_ID,
                               doc.NEXT_STEP_ID,
                               doc.PREV_STEP_ID,
                               doc.REG_NUM,
                               doc.DATE_END,
                               doc.SENDER,
                               rec.DESTINATION,
                               doc.DOC_LINK,
                               rec.READ,
                               DOC.DATE_START,
                               KIND.NAME_KIND,
                               STATE.STATE_NAME,
                               DOC.SHORT_TEXT,
                               rec.ID,
                               doc.ID MAIL_ID,
                               REC.COMMENT_TO_DOC,
                               REC.SENDER_MAIL,
                               'Исходящее (на регистрацию)' table_name,
                               '7' state_id,
                               'DOC_RECIEPMENTS_REGIST_OUT' table_name_eng
                            from
                               DOC_RECIEPMENTS_REGIST_OUT rec,
                               DOCUMENTS doc,
                               DIC_DOC_STATE state,
                               DIC_DOC_KIND kind 
                            where
                               rec.RECIEP_MAIL = '$emp_mail'
                               and REC.STATE = STATE.ID 
                               and REC.MAIL_ID = DOC.ID 
                               and KIND.ID = DOC.KIND 
                               and rec.STATE = 1";
        
            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }
        
            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $sql_inbox = "";
            $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
            $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }
    
        function get_from_on_reception_archive_count($emp_mail)
        {
            $db = new DB();
            $sql_inbox = "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 10";

            if(isset($_POST['search_text']))
            {
                $search_text = $_POST['search_text'];
                $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
            }

            $sql_inbox .= " order by rec.ID";
            $list_inbox = $db -> Select($sql_inbox);
            $on_inbox_new = count($list_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;
        }
        
        
        
        function get_payment_archive($emp_mail)
        {
            $db = new DB();
             $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 2 or rec.state = 5)
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = '';

    //согласования
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 2
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);
    
    
    
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_CONTROL rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 2
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    
    
    
    

    //делегированные
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 2
                       and rec.DESTINATION = 5
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    //канцелярия, исходящая
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    //канцелярия, входящая
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_REGISTRATION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    //добавление согласующего
    $sql_inbox .= "select 
                          doc.CURRENT_STEP_ID, 
                          doc.NEXT_STEP_ID, 
                          doc.PREV_STEP_ID, 
                          doc.REG_NUM, 
                          doc.DATE_END, 
                          doc.SENDER, 
                          rec.DESTINATION, 
                          doc.DOC_LINK, 
                          rec.READ, 
                          DOC.DATE_START, 
                          KIND.NAME_KIND, 
                          STATE.STATE_NAME, 
                          DOC.SHORT_TEXT, 
                          rec.ID, 
                          doc.ID MAIL_ID, 
                          REC.COMMENT_TO_DOC, 
                          REC.RECIEP_MAIL 
                        from
                          DOC_RECIEPMENTS_ASSIGNMENT rec,
                          DOCUMENTS doc,
                          DIC_DOC_STATE state,
                          DIC_DOC_KIND kind
                        where
                          rec.RECIEP_MAIL = '$emp_mail'
                          and REC.STATE = STATE.ID
                          and REC.MAIL_ID = DOC.ID
                          and KIND.ID = DOC.KIND
                          and rec.STATE = 2
                          and doc.kind = 16
                          ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);
    

    //резолюция
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_inbox = array_merge($list_regist, $list_inbox);

    //подписания
    $sql_inbox .= "select
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_SIGNATURE rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 or rec.STATE = 1 or rec.STATE = 2)
                       and DOC.STATE = 7
                       and doc.kind = 16
                       ";

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_inbox);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 3 OR rec.STATE = 6)
                       and DOC.STATE = 6
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";    
    $list_reciep = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_reciep, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and  rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL 
                    from
                       DOC_RECIEPMENTS_SIGNATURE rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 3
                       and DOC.STATE = 6
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 3
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_reciep = $db -> Select($sql_inbox);
    $sql_inbox = '';
     $list_all_inbox = array_merge($list_reciep, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 3
                       and doc.kind = 16                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL 
                    from
                       DOC_RECIEPMENTS_ASSIGNMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 3
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_regist = $db -> Select($sql_inbox);
    $list_all_inbox = array_merge($list_regist, $list_all_inbox);
          
          $on_inbox_new = count($list_all_inbox);
            if($on_inbox_new == '0') $on_inbox_new = '';
            return $on_inbox_new;  
            
        }
        
        function get_payment_execution($emp_mail)
        {
            $db = new DB();
            
                $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На согласовании' table_name,
                       '2' state_id,
                       'DOC_RECIEPMENTS_AGREEMENT' table_name_eng                       
                    from
                       DOC_RECIEPMENTS_AGREEMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                        and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = $list_inbox;

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'Делигировано' table_name,
                       '5' state_id,
                       'DOC_RECIEPMENTS_ASSIGNMENT' table_name_eng
                    from
                       DOC_RECIEPMENTS_ASSIGNMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                        and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На резолюции' table_name,
                       '1' state_id,
                       'DOC_RECIEPMENTS_RESOLUTION' table_name_eng
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                        and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На исполнении' table_name,
                       '4' state_id,
                       'DOC_RECIEPMENTS' table_name_eng
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'На подписании' table_name,
                       '3' state_id,
                       'DOC_RECIEPMENTS_SIGNATURE' table_name_eng
                    from
                       DOC_RECIEPMENTS_SIGNATURE rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);

    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       'Исходящее (на регистрацию)' table_name,
                       '7' state_id,
                       'DOC_RECIEPMENTS_REGIST_OUT' table_name_eng
                    from
                       DOC_RECIEPMENTS_REGIST_OUT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind 
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID 
                       and KIND.ID = DOC.KIND 
                       and rec.STATE = 1
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
    
    
    
        $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                    from
                       DOC_RECIEPMENTS_RESOLUTION rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind,
                       SUP_PERSON trivial
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and KIND.ID = DOC.KIND 
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 2
                       and trivial.EMAIL = REC.RECIEP_MAIL
                       and doc.kind = 16
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
    
    
    
  
    
      
        
    
 /*   $sql_inbox .= " select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind,
                       SUP_PERSON trivial
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and rec.STATE = 1
                       and DOC.STATE = 3
                       and trivial.EMAIL = REC.RECIEP_MAIL
                       and doc.kind = 16
                       "; 
                       
                         if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }
    
                        $sql_inbox .= " order by rec.ID";
                       $list_inbox = $db->select($sql_inbox);
                       
                       */
                       $sql_inbox = '';
                      $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
                      
                      
                      
                      
                       $sql_inbox .= " select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       trivial.LASTNAME ||' '|| trivial.FIRSTNAME ||' '|| trivial.MIDDLENAME FIO
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind,
                       SUP_PERSON trivial
                    where
                       doc.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID
                       and REC.MAIL_ID = DOC.ID
                       and KIND.ID = DOC.KIND
                       and (rec.STATE = 0 or rec.STATE = 1)
                       and DOC.STATE = 3
                       and trivial.EMAIL = REC.RECIEP_MAIL
                       and doc.kind = 16
                       ";
                       
                         if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }
    
                        $sql_inbox .= " order by rec.ID";
                       $list_inbox = $db->select($sql_inbox);
                       $sql_inbox = '';
                      $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
                      
                      
                                                                                                              
                      $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL ,
                       rec.state
                    from
                       DOC_RECIEPMENTS_CONTROL rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.RECIEP_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID
                       and (doc.STATE != 7 and doc.STATE != 5 and doc.STATE != 6 and doc.STATE != 11)
                       and KIND.ID = DOC.KIND
                       and rec.state in (1,2)
                       and doc.kind = 16 
                       ";

    if(isset($_POST['search_text']))
    {
        $search_text = $_POST['search_text'];
        $sql_inbox .= " and UPPER(doc.SHORT_TEXT) like UPPER('%$search_text%')";
    }

    $sql_inbox .= " order by rec.ID";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = '';
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
    
    
     $sql_inbox  = '';
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS_ASSIGNMENT rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID
                       and (rec.STATE = 0 OR rec.STATE = 1)
                       and REC.DESTINATION = '5'
                       and KIND.ID = DOC.KIND
                       and DOC.KIND = 16
                       ";

    $sql_inbox .= " order by rec.ID DESC";
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);
    
    $sql_inbox .= "select
                       doc.CURRENT_STEP_ID,
                       doc.NEXT_STEP_ID,
                       doc.PREV_STEP_ID,
                       doc.REG_NUM,
                       doc.DATE_END,
                       doc.SENDER,
                       rec.DESTINATION,
                       doc.DOC_LINK,
                       rec.READ,
                       DOC.DATE_START,
                       KIND.NAME_KIND,
                       STATE.STATE_NAME,
                       DOC.SHORT_TEXT,
                       rec.ID,
                       doc.ID MAIL_ID,
                       REC.COMMENT_TO_DOC,
                       REC.SENDER_MAIL,
                       REC.RECIEP_MAIL
                    from
                       DOC_RECIEPMENTS rec,
                       DOCUMENTS doc,
                       DIC_DOC_STATE state,
                       DIC_DOC_KIND kind
                    where
                       rec.SENDER_MAIL = '$emp_mail'
                       and REC.STATE = STATE.ID 
                       and REC.MAIL_ID = DOC.ID
                       and (rec.STATE = 0 OR rec.STATE = 1)
                       and REC.DESTINATION = '5'
                       and KIND.ID = DOC.KIND
                       and DOC.KIND = 16
                       ";
    
    $sql_inbox .= " order by rec.ID DESC";                   
    $list_inbox = $db -> Select($sql_inbox);
    $sql_inbox = "";
    $list_all_inbox = array_merge($list_inbox, $list_all_inbox);        
                      
    
                      
                      
                      $on_inbox_new = count($list_all_inbox);
                      if($on_inbox_new == '0')
                      {
                        $on_inbox_new = '';
                      }
                      return $on_inbox_new;
        }
        
        
?>
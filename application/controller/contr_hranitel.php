<?php
    $page_title = 'Программа страхования';
    $panel_title = '"ОСОР"';
    
    $breadwin[] = 'Программа страхования';
    $breadwin[] = '"ОСОР"';
    
    $cnct_id = '63825';
   
    $sql = "select 
    d.cnct_id,
    d.osns_head,
    emp_name(d.emp_id) emp_name, 
    BRANCH_name(d.branch_id) BRANCH_name, 
    LGOT_name(d.lgot) LGOT_name, 
    birthdat_annuit(d.id_annuit) birthdate,  
    case 
        when substr(d.contract_num,length(d.contract_num)-2, 1) = 'Д'  then substr(d.contract_num,length(d.contract_num)-1, 2) 
        else substr(d.contract_num,length(d.contract_num), 1) 
   end dop_num,  
   nvl(to_char(d.date_begin,'dd.mm.yyyy'),'__.__.____ г.') date_begin_dogov, 
   state_name(d.state) state_name, 
   progr_name(d.paym_code) progr_name, 
   bank_name(d.BANK_ID) bank_name, 
   level_name(d.level_r) level_name, 
   progr_name(substr(d.paym_code,1,4)) strah_name, 
   client_name(d.id_paym) poluch_name, 
   reason_dops_name(d.reason_dops) reason_dops_name, 
   nvl(to_char(d.date_end,'dd.mm.yyyy'),'пожизненно') d_end, 
   d.pay_sum_p - nvl(d.FIRST_VIPL,0) sum_ost, 
   d.sum_ost sum_ost_evr, 
   client_name(d.id_annuit) annuit, 
   client_name(d.id_bread_win) uk,
   FOND_name(d.id_insur) contag_name,  
   FOND_name_2(d.id_insur) contag_sh_name, 
   FOND_name(d.ID_FIRST_INSUR) FIRST_INSUR, 
   'Макет договора' ISFile,  
   reason_name(d.id_reason) reason_name, 
   calcul_name(d.id_calcul) calc_name,  
   annuitt_state_name(IZHD_STATE) IZHD_STATE_nam, 
   d.SUM_P_KSZ, 
   d.SUM_P_F,   
   case 
    when d.account_type = 1 then 'Лицевой' 
    when d.account_type =2 then  'Карточный' 
    when d.account_type =3 then  'Транзитный'   
    when d.account_type =4 then 'Депозитный' 
   end  acc_type,
   (select group_id from contr_agents where id = d.id_insur) insur_group_id, 
   d.*, 
   cl.*  
from 
    contracts_maket d, 
    clients cl   
where 
    d.ID_ANNUIT = (select id_annuit from contracts d where d.cnct_id = $cnct_id union all select id_annuit from contracts_maket d where d.cnct_id = $cnct_id) 
    and d.ID_ANNUIT = cl.sicid  
union all  
select 
    d.cnct_id,
    d.osns_head,
    emp_name(d.emp_id) emp_name, 
    BRANCH_name(d.branch_id) BRANCH_name, 
    LGOT_name(d.lgot) LGOT_name, 
    birthdat_annuit(d.id_annuit) birthdate, 
    case 
        when substr(d.contract_num,length(d.contract_num)-2, 1) = 'Д'  then substr(d.contract_num,length(d.contract_num)-1, 2) 
        else  substr(d.contract_num,length(d.contract_num), 1) 
    end dop_num, 
    nvl(to_char(d.date_begin,'dd.mm.yyyy'),'__.__.____ г.') date_begin_dogov, 
    state_name(d.state) state_name,
    progr_name(d.paym_code) progr_name, 
    bank_name(d.BANK_ID) bank_name, 
    level_name(d.level_r) level_name,  
    progr_name(substr(d.paym_code,1,4)) strah_name,
    client_name(d.id_paym) poluch_name, 
    reason_dops_name(d.reason_dops) reason_dops_name, 
    nvl(to_char(d.date_end,'dd.mm.yyyy'),'пожизненно') d_end, 
    d.pay_sum_p - nvl(d.FIRST_VIPL,0) sum_ost, 
    d.sum_ost sum_ost_evr,   
    client_name(d.id_annuit) annuit, 
    client_name(d.id_bread_win) uk,
    FOND_name(d.id_insur) contag_name,  
    FOND_name_2(d.id_insur) contag_sh_name, 
    FOND_name(d.ID_FIRST_INSUR) FIRST_INSUR, 
    'Договор' ISFile, 
    reason_name(d.id_reason) reason_name, 
    calcul_name(d.id_calcul) calc_name,  
    annuitt_state_name(IZHD_STATE) IZHD_STATE_nam, 
    d.SUM_P_KSZ, 
    d.SUM_P_F,   
    case 
        when d.account_type = 1 then 'Лицевой' 
        when d.account_type =2 then  'Карточный' 
        when d.account_type =3 then  'Транзитный'   
        when d.account_type =4 then 'Депозитный' 
    end  acc_type, 
    (select group_id from contr_agents where id = d.id_insur) insur_group_id,  
    d.*, 
    cl.*  
from 
    contracts d, 
    clients cl  
where 
    d.ID_ANNUIT = (select id_annuit from contracts d where d.cnct_id = $cnct_id union all select id_annuit from contracts_maket d where d.cnct_id = $cnct_id) 
    and d.ID_ANNUIT = cl.sicid  
order by 1";
    $db = new DB();
    $dan = $db->Select($sql);    
    
    foreach($dan as $k=>$v){
        $db->ClearParams();
        $d = $db->Select('
        select  
            gbdfl.ADDRES_insur (cl.REG_ADDRESS_DISTRICTS_ID,cl.REG_ADDRESS_REGION_ID,cl.REG_ADDRESS_CITY) ADDR,
            docum(g.sicid) docum_rus, docum_kz(g.sicid) docum_kaz, 
            g.*, 
            cl.*
        from 
            get_obtain g, 
            clients cl
        where 
            g.cnct_id = '.$v['CNCT_ID'].'
            and g.sicid = cl.sicid
            order by g.cnt'); 
            
            
        
        $dan[$k]['vigodopreob'] = $d;                   
    }

        
?>

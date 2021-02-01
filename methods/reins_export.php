<?php
	class REINS_EXPORT
    {
	   private $db;
       private $dan = array();
       public $array;
       public $html;
       
       private $q_dan1 = array();
       private $q_dan2 = array();
       
       public function __construct()
       {
            $this->db = new DB3();
            $method = $_SERVER['REQUEST_METHOD'];                           
            $this->$method();                 
       }
       
       private function GET()
       {            
            if(count($_GET) <= 0){
                $this->lists();
            }else{            
                foreach($_GET as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }else{
                        $this->dan[$k] = $v;
                    }
                }
            }                        
        }
        
        private function POST()
        {
            if(count($_POST) <= 0){
                $this->dan = array();
            }else{
                foreach($_POST as $k=>$v);   
                if(method_exists($this, $k)){
                    $this->array = $_POST;
                    $this->$k($v); 
                }else{
                    $this->dan[$k] = $v;                    
                }
            }
        }
        
        /*--GET--*/
        private function contract_num($dan)
        {            
            $sql = "
            select rownum rs,
       d.contract_num,       
       case 
        when B.PAY_SUM_OPL < 0 and B.PAY_SUM < 0 and B.SUM_S_STRAH < 0 then 'Расторжение'
        when d.vid = 2 and BL.ID_TRANSH is null then 'Изменение' 
        else 'Новый' 
       end status_reins,
       C.NAME,
       C.BIN,
       branch_name(d.branch_id) region,
       case
         when d.vid = 1 then
          d.contract_date
         else
          (select contract_date from contracts where cnct_id = d.id_head)
       end contract_date,
       O.RISK_ID,
       d.date_begin date_begin_1,
       d.date_end date_end_1,
       nvl(R.DATE_BEGIN, d.date_begin) reins_DATE_BEGIN,
       nvl(R.DATE_end, d.date_end) reins_DATE_end,
       case
         when b.typ = 3 then
          0
         else
          case
            when d.vid = 1 then
             case
               when nvl((select sum(cnt)
                          from osns_calc_new
                         where cnct_id = d.cnct_id),
                        0) = 0 then
                O.CNT_AUP + O.CNT_PP + o.CNT_VP
               else
                (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id)
             end
            else
             (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id) -
             (select sum(cnt)
                from osns_calc_new
               where cnct_id = (case
                       when (select count(*)
                               from contracts
                              where id_head = d.id_head
                                and state <> 13) > 1 then
                        (select max(cnct_id)
                           from contracts
                          where id_head = d.id_head
                            and cnct_id < d.cnct_id
                            and state <> 13)
                       else
                        d.id_head
                     end))
          end
       end cnt,
       case
         when b.typ = 3 then
          0
         else
          d.pay_sum_v - case
            when d.vid = 2 then
             nvl((select pay_sum_v
                   from contracts
                  where cnct_id = (select max(cnct_id)
                                     from contracts
                                    where id_head = d.id_head
                                      and cnct_id < d.cnct_id)),
                 (select pay_sum_v from contracts where cnct_id = d.id_head))
            else
             0
          end
       end pay_sum_v,
       (select  max(tarif) from osns_calc_new where cnct_id = d.cnct_id and id_filial = 0) TARIF,
       R.PERC_S_GAK,
       case
         when b.typ = 3 then
          0
         else
          case
            when r.vid = 2 then
             R.SUM_S_GAK
            else
             round((d.pay_sum_v - case
                     when d.vid = 1 then
                      0
                     else
                      nvl((select pay_sum_v
                            from contracts
                           where cnct_id = (select max(cnct_id)
                                              from contracts
                                             where id_head = d.id_head
                                               and cnct_id < d.cnct_id)),
                          (select pay_sum_v from contracts where cnct_id = d.id_head))
                   end) * (R.PERC_S_GAK / 100),
                   2)
          end
       end SUM_S_GAK,
       R.PERC_S_STRAH,
       case
         when b.typ = 3 then
          0
         else
          case
            when r.vid = 2 then
             R.SUM_S_STRAH
            else
             round((d.pay_sum_v - case
                     when d.vid = 1 then
                      0
                     else
                      nvl((select pay_sum_v
                            from contracts
                           where cnct_id = (select max(cnct_id)
                                              from contracts
                                             where id_head = d.id_head
                                               and cnct_id < d.cnct_id)),
                          (select pay_sum_v from contracts where cnct_id = d.id_head))
                   end) * (R.PERC_S_STRAH / 100),
                   2)
          end
       end SUM_S_STRAH,
       case
         when b.typ = 3 then
          0
         else
          case
            when d.vid = 1 then
             D.PAY_SUM_P
            else
             d.sum_vozvr
          end
       end PAY_SUM_P,
       R.PERC_P_STRAH,
       case
         when b.typ = 3 then
          R.SUM_P_STRAH_ALL
         else
          bl.pay_sum
       end SUM_P_STRAH_all,
       case 
         when trim(substr(D.PERIODICH, 2)) = 'В рассрочку' then null
         else bl.pay_sum_opl 
       end SUM_P_STRAH,              
       trim(substr(D.PERIODICH, 2)) PERIODICH,
       --reins_transh_html(d.cnct_id, r.PERC_P_STRAH) primechanie,        
       null date_pl_transh,
       null pay_transh,
       case when C.RESIDENT = 1 then 'Резидент' else 'Не Резидент' end resident,
       country_name(C.COUNTRY_ID) countryname,
       (select code||' - '||name from DIC_ECONOMICS_SECTORS where code = C.SEC_ECONOM) sec_econom,
       a.oked,
       a.name oked_name,
       null nom,       
       d.cnct_id
  from REINSURANCE            r,
       contracts              d,
       contr_agents           c,
       osns_calc              o,
       DIC_OKED_AFN           a,
       bordero_contracts      b,
       bordero_contracts_list bl
 where d.cnct_id = r.cnct_id
   and A.ID = D.OKED_ID
   and o.cnct_id = d.cnct_id
   and C.ID = d.id_insur
   and B.ID = bl.id_contracts
   and bl.cnct_id = d.cnct_id
   --and d.cnct_id not in(select cnct_id from transh)
   and d.state <> 13
   and b.id = $dan   
            ";
                        
            $sql2 = "select rownum rs,
       d.contract_num,       
       'Изменение' status_reins,
       C.NAME,
       C.BIN,
       branch_name(d.branch_id) region,
       case
         when d.vid = 1 then
          d.contract_date
         else
          (select contract_date from contracts where cnct_id = d.id_head)
       end contract_date,
       O.RISK_ID,
       d.date_begin date_begin_1,
       d.date_end date_end_1,
       nvl(R.DATE_BEGIN, d.date_begin) reins_DATE_BEGIN,
       nvl(R.DATE_end, d.date_end) reins_DATE_end,
       case
         when b.typ = 3 then
          0
         else
          case
            when d.vid = 1 then
             case
               when nvl((select sum(cnt)
                          from osns_calc_new
                         where cnct_id = d.cnct_id),
                        0) = 0 then
                O.CNT_AUP + O.CNT_PP + o.CNT_VP
               else
                (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id)
             end
            else
             (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id) -
             (select sum(cnt)
                from osns_calc_new
               where cnct_id = (case
                       when (select count(*)
                               from contracts
                              where id_head = d.id_head
                                and state <> 13) > 1 then
                        (select max(cnct_id)
                           from contracts
                          where id_head = d.id_head
                            and cnct_id < d.cnct_id
                            and state <> 13)
                       else
                        d.id_head
                     end))
          end
       end cnt,
       case
         when b.typ = 3 then
          0
         else
          d.pay_sum_v - case
            when d.vid = 2 then
             nvl((select pay_sum_v
                   from contracts
                  where cnct_id = (select max(cnct_id)
                                     from contracts
                                    where id_head = d.id_head
                                      and cnct_id < d.cnct_id)),
                 (select pay_sum_v from contracts where cnct_id = d.id_head))
            else
             0
          end
       end pay_sum_v,
       A.TARIF,
       R.PERC_S_GAK,
       case
         when b.typ = 3 then
          0
         else
          case
            when r.vid = 2 then
             R.SUM_S_GAK
            else
             round((d.pay_sum_v - case
                     when d.vid = 1 then
                      0
                     else
                      nvl((select pay_sum_v
                            from contracts
                           where cnct_id = (select max(cnct_id)
                                              from contracts
                                             where id_head = d.id_head
                                               and cnct_id < d.cnct_id)),
                          (select pay_sum_v from contracts where cnct_id = d.id_head))
                   end) * (R.PERC_S_GAK / 100),
                   2)
          end
       end SUM_S_GAK,
       R.PERC_S_STRAH,
       case
         when b.typ = 3 then
          0
         else
          case
            when r.vid = 2 then
             R.SUM_S_STRAH
            else
             round((d.pay_sum_v - case
                     when d.vid = 1 then
                      0
                     else
                      nvl((select pay_sum_v
                            from contracts
                           where cnct_id = (select max(cnct_id)
                                              from contracts
                                             where id_head = d.id_head
                                               and cnct_id < d.cnct_id)),
                          (select pay_sum_v from contracts where cnct_id = d.id_head))
                   end) * (R.PERC_S_STRAH / 100),
                   2)
          end
       end SUM_S_STRAH,
       case
         when b.typ = 3 then
          0
         else
          case
            when d.vid = 1 then
             D.PAY_SUM_P
            else
             d.sum_vozvr
          end
       end PAY_SUM_P,
       R.PERC_P_STRAH,
       case
         when b.typ = 3 then
          R.SUM_P_STRAH_ALL
         else
          bl.pay_sum
       end SUM_P_STRAH_all,
       bl.pay_sum_opl SUM_P_STRAH,
       trim(substr(D.PERIODICH, 2)) PERIODICH,
       --reins_transh_html(d.cnct_id, r.PERC_P_STRAH) primechanie,        
       t.date_pl date_pl_transh,
       round(t.pay_sum * (r.PERC_P_STRAH / 100), 2) pay_transh,
       case when C.RESIDENT = 1 then 'Резидент' else 'Не Резидент' end resident,
       country_name(C.COUNTRY_ID) countryname,
       (select code||' - '||name from DIC_ECONOMICS_SECTORS where code = C.SEC_ECONOM) sec_econom,
       a.oked,
       a.name oked_name,       
       t.nom,
       d.cnct_id
  from REINSURANCE            r,
       contracts              d,
       contr_agents           c,
       osns_calc              o,
       DIC_OKED_AFN           a,
       bordero_contracts      b,
       bordero_contracts_list bl,
       transh                 t
 where d.cnct_id = r.cnct_id
   and A.ID = D.OKED_ID
   and o.cnct_id = d.cnct_id
   and C.ID = d.id_insur
   and B.ID = bl.id_contracts
   and bl.cnct_id = d.cnct_id
   and d.cnct_id = t.cnct_id      
   and t.cnct_id = bl.cnct_id
   and t.id = bl.id_transh   
   and d.state <> 13
   and b.id = $dan";               
                        
            $q = $this->db->Select("select * from bordero_contracts_list where id_contracts = $dan");                            
            $b = true;
            /*
            foreach($q as $k=>$v){
                if($v['ID_TRANSH'] !== ''){                    
                    $b = false;
                }                
            }
            */
            //$sql .= " union all ";
            //$sql .= $sql2;
                
                        
            if(isset($_GET['cnct_id'])){
                $sql .= " and d.cnct_id = ".$_GET['cnct_id'];
            }
            
            
            $q = $this->db->Select($sql);
            if(count($q) <= 0){
                $sql = str_replace(' and d.cnct_id not in(select cnct_id from transh)', ' ', $sql);
                $q = $this->db->Select($sql);
            }
            //echo '<pre>'.$sql."</pre>";
            //exit;
            
            $this->q_dan1 = $q;
            
            $html = '';
            $html .= '<style type="text/css">        
            table {
                width: 100%;
                border-collapse: collapse;                
            }
            table, td, th {
                border: 1px solid black;                
                font-size: 10px;
                font-family: "Times New Roman";                
            }
            
            td, th{
                padding-left: 5px;
                padding-right: 5px;
            }
            th{
                background-color: #F5F5F6;
            }            
            </style>';
            
            //$ds = $this->db->Select("select max(contract_date) contract_date from reinsurance where contract_num = '$dan'");
            $ds = $this->db->Select("select * from bordero_contracts where id = $dan");
            
            $doc = 'Договору'; 
            $doc2 = 'договора';           
            $pos = strripos($ds[0]['CONTRACT_NUM'], 'Д');            
            if($pos == true){
                $doc = 'Дополнительному соглашению';
                $doc2 = 'дополнительного соглашения';
            }
            
            
            if($b){
            $html .= '<div style="text-align: left; float: left; width: 45%; font-size: 8px;margin-bottom: 15px;">
            Қосымша №1<br />
            қызметкердің өзінің еңбек (қызмет) мiндеттерiн атқарумен<br />
            байланысты жазатайым оқиғалардан факультативтік<br /> 
            қайта сақтандыру Шартына<br />
            '.$ds[0]['CONTRACT_NUM'].'<br />
            '.$ds[0]['CONTRACT_DATE'].' ж.</div>
            <div style="text-align: right; float: right; width: 45%; font-size: 8px;margin-bottom: 15px;">
            Приложение № 1<br />
            к '.$doc.' факультативного перестрахования работника<br /> 
            от несчастных случаев при исполнении им<br />
            трудовых (служебных) обязанностей<br />
            '.$ds[0]['CONTRACT_NUM'].'<br />
            от '.$ds[0]['CONTRACT_DATE'].' г.<br />
            </div>';
            }
            $contr_num = $ds[0]['CONTRACT_NUM'];
            
            $pts = $ds[0];
            
            $html .= '<div style="float: left; width: 100%;"><table border="1"><thead>
                        <tr>
                            <th rowspan="2">№</th>
                            <th rowspan="2">№ договора страхования</th>                            
                            <th rowspan="2">Статус бизнеса</th>
                            <th rowspan="2">Страхователь</th>
                            <th rowspan="2">БИН</th>
                            <th rowspan="2">Регион Страхователя</th>
                            <th rowspan="2">Дата заключения основного договора</th>
                            <th rowspan="2">Класс профессионального риска</th>
                            <th rowspan="2">Начало действия договора страхования</th>
                            <th rowspan="2">Окончание действия договора страхования</th>
                            <th rowspan="2">Начало действия периода перестрахования</th>
                            <th rowspan="2">Окончание действия перестрахования</th>
                            <th rowspan="2">Количество работников</th>                            
                            <th rowspan="2">Страховая сумма</th>
                            <th rowspan="2">Оригинальный страховой тариф</th>                            
                            <th colspan="2">Собственное удержание </th>
                            <th colspan="2">Ответственность перестраховщика</th>
                            <th rowspan="2">Страховая премия по договору</th>
                            <th colspan="2">Перестраховочная премия</th>
                            <th rowspan="2">Перестраховочная премия к оплате</th>
                            <th rowspan="2">Условия оплаты страховой премии</th>
                            <th rowspan="2">Дата транша</th>
                            <th rowspan="2">Сумма транша</th>
                            <th rowspan="2">Признак резидентства</th>
                            <th rowspan="2">Страна</th>
                            <th rowspan="2">Код сектора экономики</th>
                            <th rowspan="2">ОКЭД</th>
                            <th rowspan="2">Вид деятельности</th>
                        </tr>
                        <tr>                            
                            <th>%</th>
                            <th>Сумма</th>
                            <th>%</th>
                            <th>Сумма</th>                            
                            <th>%</th>
                            <th>Сумма</th>                                                                                    
                        </tr>
                    </thead>
                    <tbody>';
            
            /*
            echo '<pre>';            
            print_r($sql);
            exit;
            */
            foreach($q as $k=>$v)
            {
                $html .= '<tr>';
                foreach($v as $i=>$d)
                {
                    if($i !== 'CNCT_ID') {
                        if ($i !== 'NOM'){
                            if(substr($d, 0, 1) == ','){
                                $html .= '<td><center>0'.$d.'</center></td>';
                            }elseif(substr($d, 0, 1) == '.'){
                                $html .= '<td><center>0'.$d.'</center></td>';
                            }else{
                                if($i == 'CNT'){
                                    if($dan == 2362){
                                        $html .= '<td><center>1</center></td>';
                                    }else{
                                        $html .= '<td><center>'.$d.'</center></td>';
                                    }                            
                                }else{
                                    $html .= '<td><center>'.$d.'</center></td>';    
                                }
                                    
                            }
                        }
                        
                    }                       
                }
                $html .= '</tr>';
                
                
                //if(isset($v['NOM'])){
                //    if($v['NOM'] == '1'){
                if($v['PERIODICH'] == 'В рассрочку'){
                        $num = 1;
                        $sqlst = "select 
                            DATE_PL,
                            PAY_SUM PAY_SUM_transh,
                            case 
                                when tr.nom = (select max(nom) from transh where cnct_id = tr.cnct_id) then 
                                '".$v['SUM_P_STRAH_ALL']."' - (
                                    select 
                                        sum(round(PAY_SUM * ((select rst.PERC_S_STRAH from reinsurance rst where rst.cnct_id = tr.cnct_id) / 100), 2)) 
                                    from transh where cnct_id = tr.cnct_id and nom < (select max(nom) from transh where cnct_id = tr.cnct_id)
                                )
                                else 
                                    round(PAY_SUM * ((select rst.PERC_S_STRAH from reinsurance rst where rst.cnct_id = tr.cnct_id) / 100), 2) 
                                end PAY_SUM  
                            from 
                                transh tr 
                            where 
                                cnct_id = ".$v['CNCT_ID'];
                                //." and nom > 1";
                                
                            //echo $sqlst;
                            
                            $tr = $this->db->Select($sqlst);
                            if(count($tr) > 0){
                                foreach($tr as $h=>$transh){
                                    $html .= '<tr>';
                                    for ($p=0;$p<19;$p++){
                                        $html .= '<td></td>';
                                    }
                                    $html .= '<td>'.$transh['PAY_SUM_TRANSH'].'</td>';
                                    for ($p=0;$p<4;$p++){
                                        $html .= '<td></td>';
                                    }
                                    $html .= '<td>'.$transh['DATE_PL'].'</td>';
                                    $html .= '<td>'.$transh['PAY_SUM'].'</td>';
                                    $html .= '<td></td>';
                                    $html .= '<td></td>';
                                    $html .= '<td></td>';
                                    $html .= '<td></td>';
                                    $html .= '<td></td>';
                                    $html .= '</tr>';                                                
                                }                            
                            }
                        }
                    //}
                
            }            
            
            $sql = "
            select
                sum(case 
                    when b.typ = 3 then 0 
                    else 
                    case 
                        when d.vid = 1 then 
                        case 
                            when nvl((select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id), 0) = 0 then O.CNT_AUP+O.CNT_PP+o.CNT_VP 
                            else (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id) 
                        end 
                    else 
                        (select sum(cnt) from osns_calc_new where cnct_id = d.cnct_id) - 
                        (select sum(cnt) from osns_calc_new where cnct_id = ( 
                            case 
                                when (select count(*) from contracts where id_head = d.id_head and state <> 13) > 1 then (select max(cnct_id) from contracts where id_head = d.id_head and cnct_id < d.cnct_id and state <> 13) 
                                else d.id_head 
                            end ) ) 
                    end 
                end) cnt,
                sum(case 
                    when b.typ = 3 then 0 
                    else d.pay_sum_v - case when d.vid = 2 then (select pay_sum_v from contracts where cnct_id = (select max(cnct_id) from contracts where id_head = d.id_head and cnct_id < d.cnct_id)) else 0 end 
                end) pay_sum_v,                
                null TARIF,
                null PERC_S_GAK,
                sum(case 
                    when b.typ = 3 then 0 
                    else 
                    case 
                        when r.vid = 2 then R.SUM_S_GAK            
                        else round( (d.pay_sum_v - case when d.vid = 1 then 0 else (select pay_sum_v from contracts where cnct_id = (select max(cnct_id) from contracts where id_head = d.id_head and cnct_id < d.cnct_id)) end) * (R.PERC_S_GAK / 100), 2)
                    end
                end) SUM_S_GAK,
                null PERC_S_STRAH,
                sum(case 
                    when b.typ = 3 then 0 
                    else
                    case 
                        when r.vid = 2 then R.SUM_S_STRAH            
                        else  round( (d.pay_sum_v - case when d.vid = 1 then 0 else (select pay_sum_v from contracts where cnct_id = (select max(cnct_id) from contracts where id_head = d.id_head and cnct_id < d.cnct_id)) end) * (R.PERC_S_STRAH / 100) , 2)
                    end     
                end) SUM_S_STRAH,
                sum(case 
                    when b.typ = 3 then 0 
                    else 
                    case 
                        when d.vid = 1 then D.PAY_SUM_P 
                        else d.sum_vozvr 
                    end 
                end) PAY_SUM_P,
                null PERC_P_STRAH,
                sum(case 
                    when b.typ = 3 then 0 
                    else bl.pay_sum 
                end) SUM_P_STRAH_all,
                sum(BL.PAY_SUM_OPL) SUM_P_STRAHs,
                null PERIODICH,
                null primechanie
            from 
                REINSURANCE r, 
                contracts d,
                contr_agents c,
                osns_calc o,
                DIC_OKED_AFN a,
                bordero_contracts b,
                bordero_contracts_list bl 
            where  
                 d.cnct_id = r.cnct_id 
                and A.ID = D.OKED_ID 
                and o.cnct_id = d.cnct_id                  
                and C.ID = d.id_insur 
                and B.ID = bl.id_contracts
                and bl.cnct_id = d.cnct_id
                and d.state <> 13
                and b.id = $dan
                group by b.typ";
            //echo $sql;
            $ds = $this->db->Select($sql);
                
            $this->q_dan2 = $ds;
            
            foreach($ds as $k=>$v){
                $html .= '<tr>
                    <td colspan="11"></td>
                    <td><center>Итого:</center></td>';
                foreach($v as $i=>$d){
                    if($i == 'CNT'){
                        if($dan == 2362){
                            $html .= '<td><center>1</center></td>';
                        }else{
                            $html .= '<td><center>'.$d.'</center></td>';
                        }                            
                    }else{
                        $html .= '<td><center>'.$d.'</center></td>';    
                    }                                                            
                }
                $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '</tr>';
            }

            $html .= '</tbody></table>';
            
            if($b){
            $ps = $this->db->Select("select * from dic_reinsurance where id = (select REINSUR_ID from reinsurance where CONTRACT_NUM = '$contr_num' group by REINSUR_ID)");            
            
            if($pts['DATE_RASP'] !== ''){
              $date = $pts['DATE_RASP'];  
            }else{
                $date = $pts['CONTRACT_DATE'];
            }
            
            
            $q_gak = $this->db->Select("select * from BORDERO_PODPIS where id_reins = 0 and date_begin <= '$date' and (date_end > '$date' or date_end is null) order by id desc");
            $q_reis = $this->db->Select("select * from BORDERO_PODPIS where id_reins = ".$pts['ID_REINS']." and date_begin <= '$date' and (date_end >= '$date' or date_end is null)");
            
            //$html .= $this->db->sql;
            
            $qst = array("DOLGNOST","FIO_RUK");
            if(count($q_reis) > 0){
                $qst['DOLGNOST'] = $q_reis[0]['DOLGNOST'];
                $qst['FIO_RUK'] = $q_reis[0]['FIO_RUK'];
            }else{
                $qst['DOLGNOST'] = $ps[0]['DIR_DOLGNOST'].' '.str_replace('(Облигатор)', '', $ps[0]['R_NAME']);
                $qst['FIO_RUK'] = $ps[0]['DIR_NAME'];
            }
            

            $html .= '<div style="float:left;width: 45%;">
                <h6>ПЕРЕСТРАХОВЩИК:</h6>
                <p style="font-size: 8px;">'.$qst['DOLGNOST'].'</p>
                <table border=0 width="100%" style="font-size: 8px;">
                <tr>
                    <td style="border-color: #fff;">_______________________________________</td>
                    <td style="border-color: #fff;">'.$qst['FIO_RUK'].'</td>
                </tr>
                
                <tr>
                    <td style="border-color: #fff;"><span style="font-size:6px;">М.П.</span></td>
                    <td style="border-color: #fff;"></td>
                </tr>
                </table>
                
            </div>';
            /*
            $html .= '<div style="float:right;width: 45%;">
            <h6>ПЕРЕСТРАХОВАТЕЛЬ:</h6>
                <p style="font-size: 8px;">И.о. Председателя Правления</p>
                
                <table border=0 width="100%" style="font-size: 8px;">
                <tr>
                    <td style="border-color: #fff;">_______________________________________</td>
                    <td style="border-color: #fff;">Маканова Асель Куандыковна</td>
                </tr>
                
                <tr>
                    <td style="border-color: #fff;"><span style="font-size:6px;">М.П.</span></td>
                    <td style="border-color: #fff;"></td>
                </tr>
                </table>                                
            </div></div>';
            */
            /*
            $html .= '<div style="float:right;width: 45%;">
            <h6>ПЕРЕСТРАХОВАТЕЛЬ:</h6>
                <p style="font-size: 8px;">Председатель Правления</p>
                
                <table border=0 width="100%" style="font-size: 8px;">
                <tr>
                    <td style="border-color: #fff;">_______________________________________</td>
                    <td style="border-color: #fff;">Амерходжаев Галым Ташмуханбетович</td>
                </tr>
                
                <tr>
                    <td style="border-color: #fff;"><span style="font-size:6px;">М.П.</span></td>
                    <td style="border-color: #fff;"></td>
                </tr>
                </table>                                
            </div></div>';
            */
            $html .= '<div style="float:right;width: 45%;">
            <h6>ПЕРЕСТРАХОВАТЕЛЬ:</h6>
                <p style="font-size: 8px;">'.$q_gak[0]['DOLGNOST'].'</p>
                
                <table border=0 width="100%" style="font-size: 8px;">
                <tr>
                    <td style="border-color: #fff;">_______________________________________</td>
                    <td style="border-color: #fff;">'.$q_gak[0]['FIO_RUK'].'</td>
                </tr>
                
                <tr>
                    <td style="border-color: #fff;"><span style="font-size:6px;">М.П.</span></td>
                    <td style="border-color: #fff;"></td>
                </tr>
                </table>                                
            </div></div>';
            }
            $this->html = $html;
        }
        
        
                private function dobr_contract_num($dan){ 
                    
           // $q = $this->db->Select("select * from BORDERO_DOBR_DOGOVORS_LIST where id_contracts = $dan");    
           
           $q = $this->db->select("select dr.r_name, '3039485' hr_num, 
                'Quota Share Life and PA' hr_title,
                (select (select EXTRACT(year from sysdate) year from dual) || 'Q' || '00' ||(case when (SELECT EXTRACT (MONTH FROM sysdate) FROM DUAL) in (1,2,3) then 1 
                when (SELECT EXTRACT (MONTH FROM sysdate) FROM DUAL) in(4,5,6) then 2 when (select extract (month from sysdate) from dual) in (7,8,9) then 3
                when (select extract (month from sysdate) from dual) in (10,11,12) then 4
                 end) from dual) account_period,
                '' num_group,
                '' title_group,
                C.LASTNAME,
                C.FIRSTNAME, 
                C.MIDDLENAME,
                C.LASTNAME LASTNAME_INS,
                C.FIRSTNAME FIRSTNAME_INS , 
                C.MIDDLENAME MIDDLENAME_INS,
                case 
                 when c.sex = 1 then 'Male' else 'Female'
                end sex,
                C.BIRTHDATE,
                get_age ( (SELECT VIPLAT_BEGIN
                                      FROM DOBR_DOGOVORS
                                     WHERE CNCT_ID = D.CNCT_ID),
                                  c.birthdate)
                age,
                case
                when c.resident = 1 then 'Kazakh' else 'Russian'
                end resident,
                'NewBiz' Status_business,
                '' type_change, 
                '' date_action,
                (select num_dog from dobr_dogovors where cnct_id = d.cnct_id) polis,   
                'Individual' type_of_business,
                case
                   when DD.PAYM_CODE like '%0601000001%' then 'Хранитель'
                   when DD.PAYM_CODE like '%0401000001%' then 'Королевский стандарт'
                end paym_name,
                case
                     when D.OSN_POKRITIE is not null and
                      D.DOP_POKRITIE is null then 'Base'
                       when D.OSN_POKRITIE is null and
                      D.DOP_POKRITIE is not null  then 'Rider'                 
                     else 'Base'
                end type_pokr,
                D.OSN_POKRITIE,
                'KZT' cash,
                D.STR_SUM strah_sum,
                '0' reserv,
               D.str_sum risk_sum,
               BL.SUM_S_STRAH reins_sum,
               '105431' num_hannover_re,
               DD.VIPLAT_BEGIN start_date,
               DD.VIPLAT_END  end_date,
               DD.VIPLAT_BEGIN reins_start_date,
               DD.VIPLAT_END  reins_end_date,
               '' date_change,
            --     case
             --     when dd.type_strahovatel = 0 or dd.type_strahovatel is null then 1
             --     else 2 
             --  end type_strahovatel,
               BL.PAY_SUM sum_p_strah,           
                case 
                    when (D.OSN_POKRITIE is not null or d.osn_pokritie is null) and c.sex = 1 and (dd.type_strahovatel = 0 or dd.type_strahovatel is null) then 
                    (select MALE from DOBR_DIC_TARIF_HANNOVER_OSN where AGE = get_age ( (SELECT VIPLAT_BEGIN
                          FROM DOBR_DOGOVORS
                         WHERE CNCT_ID = D.CNCT_ID),
                      c.birthdate) and type = (select case when TYPE_STRAHOVATEL = 0 or TYPE_STRAHOVATEL is null then 1 else 2 end type_strah from list_dobr_dogovors where cnct_id = d.cnct_id ))                  
                    when (D.OSN_POKRITIE is not null or d.osn_pokritie is null) and c.sex = 2 and (dd.type_strahovatel = 0 or dd.type_strahovatel is null) then
                      (select female from DOBR_DIC_TARIF_HANNOVER_OSN where AGE = get_age ( (SELECT VIPLAT_BEGIN
                          FROM DOBR_DOGOVORS
                         WHERE CNCT_ID = D.CNCT_ID),
                      c.birthdate) and type = (select case when TYPE_STRAHOVATEL = 0 or TYPE_STRAHOVATEL is null then 1 else 2 end type_strah from list_dobr_dogovors where cnct_id = d.cnct_id ))                                                 
               end tarif_osn,
              case
               when (D.OSN_POKRITIE is not null or d.DOP_POKRITIE is not null) and c.sex = 1 and (dd.type_strahovatel = 0 or dd.type_strahovatel is null) then 
                       (select TARIF from DOBR_DIC_TARIF_HANNOVER_DOPFIZ where AGE = get_age ( (SELECT VIPLAT_BEGIN
                          FROM DOBR_DOGOVORS
                         WHERE CNCT_ID = D.CNCT_ID),
                      c.birthdate) and TYPE_DOP_POKR = (select case when TYPE_STRAHOVATEL = 0 or TYPE_STRAHOVATEL is null then 1 else 2 end type_strah from list_dobr_dogovors where cnct_id = d.cnct_id ))      
               end tarif_dop,  
               (select NAGRUZ from DOBR_DOGOVORS_CLIENTS_CALC where sicid = d.id_annuit and rownum < 1) NAGRUZKA,
               case
                 when d.periodich = 'Ежегодно' then 1
                 when d.periodich = 'Раз в пол года' then 1.02
                 when d.periodich = 'Ежеквартально' then 1.03
                 when d.periodich = 'Ежемесячно' then 1.05                         
               end periodich_pay_premia,
                case
                 when d.periodich = 'Ежегодно' then 1
                 when d.periodich = 'Раз в пол года' then 1.02
                 when d.periodich = 'Ежеквартально' then 1.03
                 when d.periodich = 'Ежемесячно' then 1.05                         
               end nadbavka_za_rass,
               null type_of_claim,
               null cause_of_claim,
               null status,
               null app_date_claim,
               null settlement_date_claim,
               null amount_notified,
               null amount_reinsured,
               null amount_loss_reserved,
               b.id                           
                from dic_reinsurance dr, BORDERO_DOBR_DOGOVORS_LIST bl,  bordero_dobr_dogovors b, DOBR_DOGOVORS_CLIENTS d, clients c, dobr_dogovors dd
                where bl.id_contracts = b.id and bl.id_contracts = $dan and b.id_reins = dr.id and  d.id_annuit = c.sicid and d.CNCT_ID = bl.cnct_id and DD.CNCT_ID = d.cnct_id
                union all
                select 
                null r_name, 
                null hr_num, 
                null hr_title,
                null account_period,
                null num_group,
                null title_group,
                null LASTNAME,
                null FIRSTNAME, 
                null MIDDLENAME,
                null  LASTNAME_INS,
                null  FIRSTNAME_INS , 
                null  MIDDLENAME_INS,
                null sex,
                null BIRTHDATE,
                null age,
                null resident,
                null Status_business,
                null type_change, 
                null date_action,
                null polis,   
                null type_of_business,
                null paym_name,
                null type_pokr,
                null OSN_POKRITIE,
                null cash,
                null strah_sum,
                null reserv,
                null risk_sum,
                null reins_sum,
                null num_hannover_re,
                null start_date,
                null  end_date,
                null reins_start_date,
                null  reins_end_date,
                null date_change,
                sum(bl.pay_sum) sum_p_strah,           
                null tarif_osn,
                null tarif_dop,  
                null NAGRUZKA,
                null periodich_pay_premia,
                null nadbavka_za_rass,
                null type_of_claim,
                null cause_of_claim,
                null status,
                null app_date_claim,
                null settlement_date_claim,
                null amount_notified,
                null amount_reinsured,
                null amount_loss_reserved,
                null id                           
                from dic_reinsurance dr, BORDERO_DOBR_DOGOVORS_LIST bl,  bordero_dobr_dogovors b, DOBR_DOGOVORS_CLIENTS d, clients c, dobr_dogovors dd
                where bl.id_contracts = b.id and bl.id_contracts = $dan and b.id_reins = dr.id and  d.id_annuit = c.sicid and d.CNCT_ID = bl.cnct_id and DD.CNCT_ID = d.cnct_id");

           
            $html = '';
            $html .= '<style type="text/css">        
            table {
                width: 100%;
                border-collapse: collapse;                
            }
            table, td, th {
                border: 1px solid black;                
                font-size: 10px;
                font-family: "Times New Roman";                
            }
            
            td, th{
                padding-left: 5px;
                padding-right: 5px;
            }
            th{
                background-color: #F5F5F6;
            }            
            </style>';
                                                        
            $html .= '<br/><div style="float: left; width: 100%;"><table border="1"><thead>
                        <tr>
                            <th colspan="4"></th>
                            <th colspan="5">Групповое страхование</th>
                            <th colspan="7"> </th>                            
                            <th colspan="14"></th>
                            <th colspan="2"></th>
                            <th colspan="3"></th>
                            <th colspan="5"></th>
                            <th colspan="8"></th>                      
                        </tr>
                        <tr>                            
                            <th colspan="4">General Information / Общая информация </th>
                            <th colspan="5">Policy Owner / Держатель страхового полиса</th>
                            <th colspan="7">Insured Person / Застрахованный</th>
                            <th colspan="14">Additional Information / Дополнительная информация</th>                           
                            <th colspan="2">Original Policy / Страховой полис	</th>
                            <th colspan="3">Reinsurance Policy / Перестрахование </th> 
                            <th colspan="5">Premium calculation / Расчет премии	 </th>
                            <th colspan="8">Loss information / Информация по убыткам </th>                                                                                    
                        </tr>';
                        $html .= '<tr>';
                        for($j= 1;$j<=48;$j++){
                         $html .= '                           
                            <th>'.$j.'</th>';
                            }                                                                              
                       $html .= '</tr>                        
                        <tr>                            
                            <th>Insurance Company</th>
                            <th>Treaty No. HR</th>
                            <th>Treaty Name</th>
                            <th>Accounting Period</th>                            
                            <th>Group No.</th>
                            <th>Group Name</th> 
                            <th>Last Name</th>
                            <th>First Name</th>   
                            <th>Alias Last Name</th> 
                            <th>Last Name</th>                            
                            <th>First Name</th>
                            <th>Alias Last Name</th> 
                            <th>Gender</th>
                            <th>Date of Birth</th>   
                            <th>Age</th>
                            <th>Nationality</th>
                            <th>Event for Policy</th>                            
                            <th>Type of of Alteration</th>
                            <th>Date of Event for Policies</th> 
                            <th>Original Cedent Policy Number</th>
                            <th>Type of business</th>   
                            <th>Program</th>
                            <th>Benefit Nature</th>  
                            <th>Subproduct Risk</th>   
                            <th>Currency</th>
                            <th>Original Sum Assured</th> 
                            <th>Actuarial Reserve BoP</th>   
                            <th>Sum at Risk</th>
                            <th>Sum Reinsured</th>
                            <th>IWS No. for Facultative Acceptance</th>  
                            <th>Commencement Date</th>
                            <th>End Date</th>  
                            <th>Commencement Date HR</th>  
                            <th>End Date HR</th>
                            <th>Renewal Date</th>
                            <th>Premium for reinsurance period</th>
                            <th>Premium Rate</th>  
                            <th>Loading for Facultative Acceptance</th>  
                            <th>Payment Mode</th>
                            <th>Loading for payment</th>
                            <th>Type of Claim</th>
                            <th>Cause of Claim</th>
                            <th>Status</th>  
                            <th>Application date of claim</th>  
                            <th>Settlement date of claim</th>
                            <th>Amount Notified/Paid</th>
                            <th>Amount Reinsured</th>
                            <th>Amount Loss Reserve</th>                                                                              
                        </tr>
                        <tr>                            
                            <th>Название страховой компании</th>
                            <th>№ договора HR</th>
                            <th>Название договора</th>
                            <th>Отчетный период</th>                            
                            <th>№ группы </th>
                            <th>Название группы </th> 
                            <th>Фамилия </th>
                            <th>Имя </th>   
                            <th>Отчество</th> 
                            <th>Ф.застрахованного</th>                            
                            <th>И. застрахованного</th>
                            <th>О. застрахованного</th> 
                            <th>Пол</th>
                            <th>Дата рождения</th>   
                            <th>Возраст</th>
                            <th>Национальность </th>
                             <th>Статус бизнеса</th>                            
                            <th>Тип изменения</th>
                            <th>Дата события</th> 
                            <th>Полис №</th>
                            <th>Тип бизнеса</th>   
                            <th>Программа страхования</th>
                            <th>Тип покрытия </th>  
                            <th>Покрытие / Риск</th>   
                            <th>Валюта</th>
                            <th>Страховая сумма</th> 
                            <th>Актуарный резерв на начало периода </th>   
                            <th>Сумма под риском</th>
                            <th>Перестрахованная сумма под риском</th>
                            <th>№ Hannover Re</th>  
                            <th>Начало действия договора</th>
                            <th>Окончание действия договора</th>  
                            <th>Начало действия перестрахования</th>  
                            <th>Окончание действия перестрахования</th>
                            <th>Дата изменения/расторжения</th>
                            <th>Перестраховочная премия на действия перестрахования</th>
                            <th>Ставка перестраховочной премии</th>  
                            <th>Надбавка</th>  
                            <th>Периодичность уплаты премии</th>
                            <th>Надбавка за рассрочку</th>
                            <th>Тип страхового случая</th>
                            <th>Причина наступления страхового случая</th>
                            <th>Статус убытка (оплаченный / неоплаченный)</th>  
                            <th>Дата заявления о возмещении</th>  
                            <th>Дата урегулирования/оплаты убытка</th>
                            <th>Размер страхового возмещения</th>
                            <th>Размер перестрахованного возмещения</th>
                            <th>Размер резерва перестраховщика</th>  
                            <th>№ бордеро</th>                                                                              
                        </tr>
                    </thead>
                    <tbody>';
                                              
            foreach($q as $k=>$v)
            {
                $html .= '<tr>';              
                foreach($v as $i=>$d)
                {                            
                    if($i !== 'TARIF_DOP') {                        
                           if($i == 'NAGRUZKA'){
                            if(!$d){
                                $html .= '<td><center>'.$d.'</center></td>';   
                                }
                           }else{
                         $html .= '<td><center>'.$d.'</center></td>';
                         }                                                                                                                    
                    }                       
                }
                $html .= '</tr>';
            }
                                    
          $this->html = $html;
                                  
        }
        
        private function export($dan)
        {
            if(method_exists($this, $dan)){
                $this->$dan();
            }else{
                echo 'Ошибка запроса формата файла!';
            }                       
            exit; 
        }
        
        private function pdf()
        {
            //require_once("methods/mpdf/mpdf.php");
            //$mpdf = new mPDF();
            $mpdf = new \Mpdf\Mpdf();      
            $mpdf->showImageErrors = true;       
            $mpdf->SetTitle($_GET['contract_num']);  
            $mpdf->AddPage('L');  
            //$date = date('d.m.Y H:i:s');           
            //$mpdf->setFooter($date.' Страница - {PAGENO}');
            
                        
            $base64 = 'styles/img/logo_gak_min.jpg';
            //Водяной знак
            
            $mpdf->SetWatermarkImage($base64);
            $mpdf->showWatermarkImage = true;
            $mpdf->watermarkImageAlpha = 0.1;
            
            //Вставить footer с картинкой
            
            $mpdf->SetHTMLFooter('
            <div style="position: relative;float: left; width: 33%;font-size: 8px;opacity: 0.5;">АО "Компания по страхованию жизни "Государственная аннуитетная компания"<br />www.gak.kz</div> 
            <div style="position: relative;float: left; width: 33%;text-align: center;opacity: 0.5;"><img src="'.$base64.'" width="25" height="25" ></div> 
            <div style="position: relative;float: right; width: 33%;text-align: right;font-size: 8px;opacity: 0.5;">АО "Компания по страхованию жизни "Государственная аннуитетная компания"<br />www.gak.kz</div>');
            
             
            $mpdf->WriteHTML($this->html);                 
            $c = $_GET['contract_num'];                   
            $mpdf->Output();             
        }
        
        private function xls()
        {       
            if(isset($_GET['contract_num'])){
            $c = $_GET['contract_num'];
            }
            if(isset($_GET['dobr_contract_num'])){
                $c = $_GET['dobr_contract_num'];
            }

            error_reporting(E_ALL);
            ini_set('display_errors', TRUE); 
            ini_set('display_startup_errors', TRUE); 

            header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment;Filename=$c.xls");
            echo $this->html;
                        
        }
        
        private function html()
        {
            header('Content-Type: text/html; charset=UTF-8');
            echo $this->html;            
        }
        
                private function pdf2()
        {
            //require_once("methods/mpdf/mpdf.php");
            //$mpdf = new mPDF();
            
            $mpdf = new \Mpdf\Mpdf();      
            $mpdf->showImageErrors = true;       
            $mpdf->SetTitle($_GET['dobr_contract_num']);  
            $mpdf->AddPage('L');  
            //$date = date('d.m.Y H:i:s');           
            //$mpdf->setFooter($date.' Страница - {PAGENO}');
            
                        
            $base64 = 'styles/img/logo_gak_min.jpg';
            //Водяной знак
            
            $mpdf->SetWatermarkImage($base64);
            $mpdf->showWatermarkImage = true;
            $mpdf->watermarkImageAlpha = 0.1;
            
            //Вставить footer с картинкой
            
            $mpdf->SetHTMLFooter('
            <div style="position: relative;float: left; width: 33%;font-size: 8px;opacity: 0.5;">АО "Компания по страхованию жизни "Государственная аннуитетная компания"<br />www.gak.kz</div> 
            <div style="position: relative;float: left; width: 33%;text-align: center;opacity: 0.5;"><img src="'.$base64.'" width="25" height="25" ></div> 
            <div style="position: relative;float: right; width: 33%;text-align: right;font-size: 8px;opacity: 0.5;">АО "Компания по страхованию жизни "Государственная аннуитетная компания"<br />www.gak.kz</div>');
            
            echo $this->html;
            $mpdf->WriteHTML($this->html);                           
            $c = $_GET['dobr_contract_num'];                                         
            $mpdf->Output();             
        }
        

        
        /*--POST--*/
         
	}
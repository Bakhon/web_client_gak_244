<?php
	class REINSURANCE
    {
        private $db;
        public function __construct()
        {
            $this->db = new DB3();
        }
        
        /**
         *  Справочник (Список) файлов  
         */
        public function dic_files()
        {
            $q = $this->db->Select("select * from BORDERO_TYPE_FILES where id_type = 0");
            return $q;
        }
        
        /**
         * Список файлов прикрепленных к определенному договору
         * @id - № договора перестрахования          
         */        
        public function contract_files($id)
        {
            $q = $this->dic_files();
            foreach($q as $k=>$v){
                $q[$k]['list_files'] = $this->db->Select("select * from bordero_files where id_type = ".$v['ID']." and id_contracts = $id");                
            }
            $this->dan_array = $q;
            return $q;
        }
        /**
         * Загрузка файлов для договора перестрахования
         * @id_contract - № договора перестрахования 
         * @id_type - Тип файла
        */
        private function set_file($id_contract, $id_type)
        {            
            if(!isset($_FILES['upload'])){
                return false;
            }
                        
            $files = $_FILES['upload'];
            $path = 'reinsurance/reins_'.$id_contract;
            
            $uploaddir = 'upload/';
            $uploadfile = $uploaddir . basename($files['name']);
            
            if (move_uploaded_file($files['tmp_name'], $uploadfile)) {
                $localfile = $uploadfile;                                                
            } else {
                $msg = ALERTS::ErrorMin('Ошибка загрузки файла');
                return false;
            }
            
            $ftp = new FTP();
            $filename =$files['name'];
            
            if(!$ftp->check_path($path)){
                $ftp->create_path($path);
            }
            $fs = $ftp->uploadfile2($path.'/', $filename, $localfile);
            unlink($localfile);
            
            $sql = "INSERT INTO BORDERO_FILES (ID_CONTRACTS, FILENAME, DATE_SET, ID_TYPE) 
            VALUES ($id_contract, '$fs', sysdate, $id_type)";
            $this->db->Execute($sql);
        }
        
        /**
         * POST запрос внесения файла
        */
        public function set_new_contract_file($id)
        {
            error_reporting(E_ALL);
            $this->set_file($_POST['contract_file_id'], $id);            
            header("Location: ".$_SERVER['REQUEST_URI']);
        }
        
        /**
         * Удаление файла из договора перестрахования
        */
        public function delete_file($id)
        {
            $q = $this->db->Select("select * from bordero_files where id = $id");
            $filename = $q[0]['FILENAME'];
            $ftp = new FTP();
            $b = $ftp->deleteFile($filename);
            if($b){
                $this->db->Execute("delete from bordero_files where id = $id");
            }
            $this->contract_files($q[0]['ID_CONTRACTS']);
        }
        
        /**
         * Печать счета на оплату в случае возврата 
        */
        public function shet_opl($id)
        {
            if(!$this->db->Execute("begin bordero.SetNewShetOpl($id); end;")){
                echo $this->db->message;
                exit;
            }
            
            $q = $this->db->Select("
            select 
                r.bin,
                nvl(R.R_NAME_KRAT, R.R_NAME) name_reins,
                (select count(*) from bordero_contracts_list where id_contracts = b.id) cnt,
                B.NUM_SCHET_OPL,
                B.DATE_SHET_OPL,
                TLSC.DATE2STR(B.DATE_SHET_OPL) DATE_SHET_OPL_TEXT,
                B.CONTRACT_NUM,
                B.CONTRACT_DATE,
                to_char(replace(B.PAY_SUM_OPL, '-', ''),'999G999G999G999G999D00') PAY_SUM_OPL,
                TLSC.MONEY_WORD(replace(B.PAY_SUM_OPL, '-', '')) PAY_SUM_OPL_text
            from 
                bordero_contracts b, 
                dic_reinsurance r
            where 
                R.ID = B.ID_REINS
                and b.id = $id
            ");            
            $dan = $q[0];            
            require_once 'application/views/reinsurance/shet_opl.php';
            exit;
        }
        
        public function print_rasp($id)
        {
            $q = $this->db->Select("
            select 
                b.*, 
                B.PAY_SUM_OPL pay_sum_opl1, 
                tlsc.money_word(b.pay_sum_opl) pay_sum_opl_text,
                nvl(D.R_NAME_KRAT, D.R_NAME) name_reins 
            from 
                bordero_contracts b, dic_reinsurance d 
            where 
                d.id = B.ID_REINS
                and b.id = $id");            
            $dan = $q[0];
            require_once 'application/views/reinsurance/form_rasporyazh.php';
            exit;
        }
        
        /**
         * Данные текущего пользователя
         * @dan - массив данных
         * @DEPARTMENT - ID Департамента 
         * @DOLZHNOST - ID Должности
         * @EMP_ID - ID пользователя из таблицы ga_emp
        */        
        public function session_user_dan()
        {
            $email = trim($_SESSION[USER_SESSION]['login'])."@gak.kz"; //Эмаил текущего пользователя
            $login = trim($_SESSION[USER_SESSION]['login']);
            $sql = "select S.ID, S.JOB_SP, S.JOB_POSITION from SUP_PERSON s, DIC_DEPARTMENT d, DIC_DOLZH z
            where S.JOB_SP = D.ID and S.JOB_POSITION =  Z.ID and S.EMAIL = '$email' and s.date_layoff is null";  
            
            $dan = array();
            
            $db = new DB();
            $dsp = $db->Select($sql);
                        
            $dan['DEPARTMENT'] = $dsp[0]['JOB_SP']; //Департамент
            $dan['DOLZHNOST'] = $dsp[0]['JOB_POSITION']; //Должность 
            
            $qs = $this->db->Select("select * from gs_emp where bdisabled = 1 and upper(login) = upper('$login')");
            $dan['EMP_ID'] = $qs[0]['EMP_ID'];
            return $dan;
        }
        
        /**
         * Создание возврата на 1 договор страхования
         * Входящие параметры
         * @vozvrat - ID договора перестрахования
         * @vozvrat_cnct - ID договора страхования
         * @vozvrat_contract_num - № договора перестрахования
         * @vozvrat_date_contract - Дата возврата 
         * @vozvrat_pay_sum_opl - Сумма к оплате
         * @vozvrat_sum_s_strah - Обязательства перестраховщика
        */
        public function vozvrat($id)
        {
            if($id == ''){
                return false;
            }
            $q = $this->db->Select("select * from BORDERO_CONTRACTS where id = $id");
            
            $cnct = $this->array['vozvrat_cnct'];
            $contract_num = $this->array['vozvrat_contract_num'];
            $date_contract = $this->array['vozvrat_date_contract'];
            $pay_sum_opl = $this->array['vozvrat_pay_sum_opl'];
            $sum_s_strah = $this->array['vozvrat_sum_s_strah'];            
            $id_reins = $q[0]['ID_REINS'];
            
            $qs = $this->db->Select("select seq_bordero_contracts.nextval ids from dual");
            $id_contract = $qs[0]['IDS'];
            
            $sql_all = '';
            
            $sql = "INSERT INTO BORDERO_CONTRACTS(
              id, 
              contract_num, 
              contract_date, 
              emp_id, 
              date_create,
              pay_sum, 
              state, 
              id_reins, 
              otpr, 
              typ, 
              id_head, 
              pay_sum_opl, 
              sum_s_strah
            ) VALUES(
              '$id_contract', 
              '$contract_num', 
              '$date_contract', 
              '".$q[0]['EMP_ID']."', 
              sysdate,
              '$pay_sum_opl', 
              0,                
              '$id_reins',
              0, 
              1, 
              '$id', 
              '$pay_sum_opl', 
              '$sum_s_strah'
            )";
            $sql_all .= $sql."\r\t\n";
                             
            if(!$this->db->Execute($sql)){
                echo $this->db->message;   
                echo $sql_all;             
                exit;
            }
            
            
            $sql1 = "INSERT INTO BORDERO_CONTRACTS_LIST (ID, ID_CONTRACTS, CNCT_ID, PAY_SUM, PAY_SUM_OPL, SUM_S_STRAH) 
            VALUES (seq_BORDERO_CONTRACT_LIST.nextval, '$id_contract', '$cnct', '$pay_sum_opl', '$pay_sum_opl', '$sum_s_strah')";            
            
            $sql_all .= $sql1."\r\t\n";
            
            if(!$this->db->Execute($sql1)){
                $sql_all .= "delete from BORDERO_CONTRACTS where id = $id_contract"."\r\t\n";
                
                $this->db->Execute("delete from BORDERO_CONTRACTS where id = $id_contract");
                echo $this->db->message;   
                echo $sql_all;             
                exit;
            }
                        
            //echo $sql_all;
            echo 'Операция прошла успешно! Обновите страницу!';            
            exit;
        }
        
        /**
         * Создание возврата на 1 договор перестрахования
         * Входящие параметры
         * @dan_vozvrat - ID договора перестрахования
         * @cnct_vozvrat - Список ID договоров страхования         
        */
        public function dan_vozvrat($id)
        {            
            if(isset($this->array['cnct_vozvrat'])){
                $cnct = $this->array['cnct_vozvrat'];            
                $q = $this->db->Select("select b.id, b.contract_num, bl.pay_sum_opl, bl.sum_s_strah from BORDERO_CONTRACTS_LIST BL, BORDERO_CONTRACTS B where B.ID = BL.ID_CONTRACTS AND BL.ID_CONTRACTS = $id and BL.CNCT_ID = $cnct");                
                echo json_encode($q[0]);
            }else{
                $dan = array();
                $q = $this->db->Select("
                select 
                    b.id, 
                    b.contract_num c_num, 
                    bl.pay_sum_opl, 
                    bl.sum_s_strah,
                    d.contract_num,
                    fond_name(d.id_insur) strahovatel,
                    d.cnct_id
                from 
                    BORDERO_CONTRACTS_LIST BL, 
                    BORDERO_CONTRACTS B,
                    contracts d 
                where 
                    B.ID = BL.ID_CONTRACTS
                    and d.cnct_id = bl.cnct_id 
                    AND BL.ID_CONTRACTS = $id
                ");
                
                $dan['contract_num'] = $q[0]['C_NUM'].'/D1';
                $dan['list_contracts'] = $q;
                echo json_encode($dan);
            }
            exit;
        }
        
        /**
         * Расчет возврата
        */
        public function raschet_vozvr($dan)
        {            
            $id = $this->array['vozvrat_id_contract'];            
            $cnct = '';
            $i = 0;            
            foreach($dan as $d){
                if($i > 0){
                    $cnct .= ', ';
                }
                $cnct .= $d;
                $i++;
            }
            $q = $this->db->Select("
            select     
                -sum(bl.pay_sum_opl) pay_sum_opl, 
                -sum(bl.sum_s_strah) sum_s_strah
            from 
                BORDERO_CONTRACTS_LIST BL, 
                BORDERO_CONTRACTS B
            where 
                B.ID = BL.ID_CONTRACTS     
                AND BL.ID_CONTRACTS = $id
                and bl.cnct_id in(
                     $cnct
                )");
            echo json_encode($q[0]);
            exit;            
        }
        
        /**
         * Сохранение возврата договора перестрахования со списочной частью договоров страхования         
        */
        public function id_contract_vozvrat($id)
        {
            $q = $this->db->Select("select * from BORDERO_CONTRACTS where id = $id");
            $u = $this->session_user_dan();
            $emp_id = $u['EMP_ID'];
            
            $contract_num = $this->array['vozvrat_contract_num'];
            $date_contract = $this->array['vozvrat_date'];
            $pay_sum_opl = $this->array['vozvrat_pay_sum_opl'];
            $sum_s_strah = $this->array['vozvrat_sum_s_strah'];
            
            $qs = $this->db->Select("select seq_bordero_contracts.nextval ids from dual");
            $id_contract = $qs[0]['IDS'];
            
            $sql = "INSERT INTO BORDERO_CONTRACTS(
              id, 
              contract_num, 
              contract_date, 
              emp_id, 
              date_create,
              pay_sum, 
              state, 
              id_reins, 
              otpr, 
              typ, 
              id_head, 
              pay_sum_opl, 
              sum_s_strah
            ) VALUES(
              '$id_contract', 
              '$contract_num', 
              '$date_contract', 
              '$emp_id', 
              sysdate,
              '$pay_sum_opl', 
              0,                
              '$id_reins',
              0, 
              1, 
              '$id', 
              '$pay_sum_opl', 
              '$sum_s_strah'
            )";
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
                exit;
            }
            
            foreach($this->array['vozvr_cnct'] as $k=>$v){
                $cnct = $k;
                $opl_sum = '-'.$this->array['pso'][$cnct]; 
                $sum_strah = '-'.$this->array['sss'][$cnct];
                
                $sql1 = "INSERT INTO BORDERO_CONTRACTS_LIST 
                    (ID, ID_CONTRACTS, CNCT_ID, PAY_SUM, PAY_SUM_OPL, SUM_S_STRAH) 
                VALUES 
                    (seq_BORDERO_CONTRACT_LIST.nextval, '$id_contract', '$cnct', '$opl_sum', '$opl_sum', '$sum_strah')";
                
                if(!$this->db->Execute($sql1)){
                    echo $this->db->message;
                    $this->db->Execute("
                    begin
                      delete from BORDERO_CONTRACTS where id = $id_contract;
                      delete from BORDERO_CONTRACTS_LIST where ID_CONTRACTS = $id_contract;
                    end;
                    ");
                    exit;
                }                
            }
            
            header("Refresh:0");
        }
        
        /**
         * Удаление договора страхования из договора перестрахования
        */        
        public function delcnct($d)
        {           
            global $msg;            
            $sql = 'begin';
            foreach($d as $dan){
                $ds = explode('|', $dan);
                $cnct = $ds[0];
                $id = $ds[1];
                $tr = $ds[2];
                if($ds[2] == ''){
                    $tr = 'null';
                }
                $sql .= "
                bordero.DeleteCnctFromContract($id, $cnct, $tr); 
                ";                                
            }
            $sql .= " 
            end;";
            if(!$this->db->Execute($sql)){              
                $msg .= ALERTS::ErrorMin($this->db->message);
            }else{
                header("Refresh:0");
            }
        }
        
        public function search_plat_kvit()
        {
            $sql = "select  bank_name_plat(mfo_pbank) p_bank, bank_name_plat(mfo_rbank) r_bank, pd.*  
            from gak_pay_doc pd  where p_type = 3 ";
            $b = false;
            foreach($_POST as $k=>$v){
                if(trim($v) !== ''){
                    $b = true;
                }
            }
            
            if($b == false){
                echo '<center>
                <h3>Не найдено ни одной записи!</h3>
                <h5>Либо поисковые поля пустые!</h5>
                </center>';
                exit;
            }
            
            if($_POST['date_begin'] !== ''){
                if($_POST['date_end'] !== ''){
                    $sql .= " and pd.doc_DATE BETWEEN to_date('".$_POST['date_begin']."', 'dd.mm.yyyy') AND to_date('".$_POST['date_end']."', 'dd.mm.yyyy') ";
                }
            }
            
            if($_POST['pay_sum'] !== ''){                
                $sql .= " and pd.pay_sum = ".$_POST['pay_sum'];
            }
            
            if($_POST['bin'] !== ''){
                $sql .= " and pd.p_bin like '%".$_POST['bin']."%'";
            }
            
            if($_POST['skvit'] !== ''){
                if($_POST['skvit'] == '1'){
                    $sql .= " and SKVIT is null";
                }else{
                    $sql .= " and SKVIT is not null";
                }
            }
            
            //echo $sql;
            $q = $this->db->Select($sql);            
            if(count($q) <= 0){
                echo '<center>
                <h3>Не найдено ни одной записи!</h3>
                <h5>Либо поисковые поля пустые!</h5>
                </center>';
                exit;
            }
            
            echo '            
            <table class="table table-bordered" id="table_kvit">
            <thead>
                <tr>
                    <th>Выбор</th>
                    <th>№ плат. поруч.</th>
                    <th>Дата плат.</th>
                    <th>Сумма</th>                    
                    <th>Сумма взятия в доход</th>
                    <th>Отправитель</th>
                    <th>РНН отправителя</th>
                    <th>Банк</th>
                    <th>Назначение платежа</th>
                </tr>
            </thead>
            <tbody>';
            foreach($q as $k=>$v){
                echo '<tr>
                    <td>
                        <button type="button" class="btn btn-success btn-sm btn_kvit" id="'.$v['MHMH_ID'].'" data="'.$v['PAY_SUM'].'" data-text="№ '.$v['DOC_NMB'].' от '.$v['DOC_DATE'].' г. ('.$v['PAY_SUM'].' тг.)">Выбрать</button>                        
                    </td>
                    <td>'.$v['DOC_NMB'].'</td>
                    <td>'.$v['DOC_DATE'].'</td>
                    <td><b>'.$v['PAY_SUM'].'</b></td>
                    <td class="cn_'.$v['MHMH_ID'].'"><b>'.$v['PAY_SUM'].'</b></td>
                    <td>'.htmlspecialchars($v['P_NAME']).'</td>
                    <td>'.$v['R_IIK'].'</td>
                    <td>'.htmlspecialchars($v['P_BANK']).'</td>
                    <td>'.htmlspecialchars($v['DOC_ASSIGN']).'</td>
                </tr>';
            }
            echo '</tbody></table>
            <input type="hidden" name="kvitov_cnct" value="'.$cnct.'">
            <input type="hidden" name="id_transh" value="'.$_POST['id_transh'].'">
            ';            
            //echo $sql;            
            exit;
        }
        
        public function set_plat_vozvrat($id)
        {               
            $mh = $_POST['mhmh'];
            $sql = "begin bordero.SetVozvrPlat($id, $mh); end;";
            if(!$this->db->Execute($sql)){
                echo $this->db->message;                
            }else{
                echo '';
            }
            exit;
        }
        
        public function listNot_transh()
        {
            $sql = "select
              c.name,
              c.bin,
              d.contract_num,
              d.contract_date,  
              bc.contract_num cn_reins,
              bc.contract_date cd_reins,
              d.date_begin,
              d.date_end,
              t.nom,
              t.pay_sum,
              t.date_pl,
              d.cnct_id,
              d.id_insur,
              bc.id id_bordero
            from 
                contracts d,
                contr_agents c, 
                transh t, 
                bordero_contracts_list bl, 
                bordero_contracts bc 
            where 
              t.cnct_id = d.cnct_id    
              and d.date_close is null
              and c.id = d.id_insur
              and BL.ID_CONTRACTS = BC.ID
              and bc.id_head is null
              and bl.cnct_id = d.cnct_id
              and t.nom > 1
              and d.cnct_id in(select cnct_id from BORDERO_CONTRACTS_LIST)
              and t.id not in(
                select nvl(id_transh, 0) from BORDERO_CONTRACTS_LIST
              )
              and t.date_pl <=  sysdate + 10
              and t.date_f is null
            order by d.cnct_id";
            
            $q = $this->db->Select($sql);
            return $q;
        }
        
        public function pereraschet($id)
        {                     
            $sql = "begin bordero.PereraschetContract($id); end;";            
            if(!$this->db->Execute($sql)){
                echo $this->db->message;
            }else{
                echo '';
            }
            exit;
        }
        
    }
?>
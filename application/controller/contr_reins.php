<?php
    $title = 'Список перестраховщиков';
    
    require_once 'methods/reins.php';
    $reins = new REINSURANCE();       
    
    function ListEstimat($id_agenstv = 0)
    {
        $db = new DB3();
        $sql = "select * from REITING_ESTIMATION";
        if($id_agenstv !== 0){
            $sql .=" where id_ag = $id_agenstv";
        }
        $q = $db->Select($sql);
        return $q;
    }
    
    
    function ListReiting()
    {
        $db = new DB3();
        $q = $db->Select("select 0 id, null name from dual
        union all
        select * from REITING_AGENSTVO
        ");
        return $q;
    }
    
    function danreiting($id)
    {
        $db = new DB3();        
        $sql = "select r.*, e.id id_eg, e.ocenka from REITING_AGENSTVO r, REITING_ESTIMATION e where E.ID_AG = R.ID and E.ID = $id";
        $q = $db->Select($sql);
        return $q[0];
    }
    
    function ListCountry()
    {
        $db = new DB3();
        $q = $db->Select("select * from DIC_COUNTRIES_ESBD where blocked = 0");
        return $q;        
    }
    
    function listBanksReins($id_reins)
    {        
        $db = new DB3();
        $q = $db->Select("select b.name, d.*, b.bank_id, case when d.type = 1 then 'Основной' else 'Второстепенный' end type_text from DIC_REINSURANCE_BANKS d, dic_banks b where b.bank_id = d.id_bank and d.id_reins = $id_reins");                
        return $q;
    }
    
    function listBanks($id_reins)
    {
        $db = new DB3();
        $q = $db->Select("select * from dic_banks where status = 0 and bank_id not in(select id_bank from DIC_REINSURANCE_BANKS  where id_reins = $id_reins)");
        return $q;
    }
?>
<?php
	class BTN_HREF
    {
        private $rs;
        public function __construct($mt, $id)
        {
            if(method_exists($this, $mt)){                 
                $this->$mt($id);
            }else{
                $this->rs = '';
            }            
        }
        
        private function CNCT_ID($id)
        {            
            $this->rs = array(
            "href"=>'contracts?CNCT_ID='.$id,
            "title"=>"Открыть договор"
            );
        }
        
        private function ID_INSUR($id)
        {
            $this->rs = array(
            "href"=>'contragents?view='.$id,
            "title"=>"Данные контрагента"
            );            
        }
        
        public function rest()
        {
            return $this->rs;
        }
    }
?>
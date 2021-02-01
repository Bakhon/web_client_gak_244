<?php
	class friday
    {
        public function __construct()
        {
            $req = $_REQUEST;
            if($req > 0){
                foreach($req as $k=>$v){
                    if(method_exists($this, $k)){
                        $this->$k($v);
                    }
                }
            }
        }
        
        private function read_text($text)
        {
            //hello
        }
        
    }    
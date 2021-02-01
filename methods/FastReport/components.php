<?php
    require_once __DIR__.'/attributes.php';
    
	class components extends attributes
    {        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function TfrxReportPage($dan)
        {
            //echo '<pre>'; print_r($dan); exit;
            foreach($dan as $k=>$v){                            
                $d = $v['@attributes'];            
                $w = floatval($d['PaperWidth']) - floatval($d['LeftMargin']) - floatval($d['RightMargin']);
                $h = floatval($d['PaperHeight']) - floatval($d['TopMargin']) - floatval($d['BottomMargin']);
                $style = '#'.$d['Name'].'{
                    width:'.$w.'mm;
                    /*height: '.$h.'mm;*/
                    margin-left: '.floatval($d['LeftMargin']).'mm;
                    margin-right: '.floatval($d['RightMargin']).'mm;
                    margin-top: '.floatval($d['TopMargin']).'mm;                
                    margin-bottom: '.floatval($d['BottomMargin']).'mm;
                    }
                    
                    #ReportPage'.$k.'{
                        width:'.floatval($d['PaperWidth']).'mm;height: '.floatval($d['PaperHeight']).'mm;
                    }
                ';
                $this->addStyle($style); 
                $this->addHtml('<div class="page page-main" id="ReportPage'.$k.'">
                    <div id="'.$d['Name'].'">');
                                
                foreach($v as $t=>$c){
                    if(method_exists($this, $t)){
                        $this->ind = 1;
                        $this->$t($c);
                        $this->ind++;
                    }
                }
                
                $this->addHtml('</div></div>');
            }
        }
        
        public function TfrxRichView($d)
        {
            //echo '<pre>'; print_r($d); exit;
            foreach($d as $v){
                $attr = $v['@attributes'];
                $style = '#'.$attr['Name'].'{    
                    z-index: '.$this->ind.';                
                    width:'.floatval($attr['Width']).'px;
                    height: '.floatval($attr['Height']).'px;
                    left: '.floatval($attr['Left']).'px;                    
                    top: '.floatval($attr['Top']).'px;
                    position: absolute;
                    display: block;
                    overflow: hidden;                    
                ';
                
                if(isset($attr['Frame.Typ'])){
                    $ft = $this->FrameTyp($attr['Frame.Typ']);
                    if(is_array($ft)){
                        $bordertype = 'solid';
                        if(isset($attr['Frame.Style'])){
                            $bordertype = $this->FrameStyle($attr['Frame.Style']);
                        }
                        $color = 'black';
                        
                        if(isset($attr['Frame.Color'])){
                            $rgb = $this->getRGB(dechex($attr['Frame.Color']));
                            $color = 'rgba(';
                            foreach($rgb as $r){
                                $color .= $r.',';
                            }
                            $color .= '1)';                        
                        }
                        
                        foreach($ft as $fs){
                            $style .= "border-$fs: $bordertype 1px $color;
                            ";
                        }
                    }
                }
                
                $text = $this->PropData($attr['PropData']);
                $style .= '}';
                $this->addstyle($style);                
                $this->html .= '<div id="'.$attr['Name'].'">'.$text.'</div>';                
            }                        
        }
        
    }
?>
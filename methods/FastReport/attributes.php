<?php
    require_once __DIR__.'/rtf.php';
    
	class attributes
    {                 
        public function __construct()
        {
            
        }
        
        public function getRGB($psHexColorString) {
          $aColors = array();
          if ($psHexColorString{0} == '#') {
            $psHexColorString = substr($psHexColorString, 1);
          }
          $aColors['red'] = @hexdec($psHexColorString{0} . $psHexColorString{1});
          $aColors['green'] = @hexdec($psHexColorString{2} . $psHexColorString{3});
          $aColors['blue'] = @hexdec($psHexColorString{4} . $psHexColorString{5});
          return $aColors;
        }
        
        public function PropData($data)
        {
            $str = '';        
            for ($i=0; $i < strlen($data)-1; $i+=2){
                $d1 = substr($data, $i, 1);
                $d2 = substr($data, $i+1, 1);              
                $str .= chr(hexdec($d1.$d2));
            }

            $text = $str;

            $p = explode('{', $text);
            $text = str_replace($p[0], '', $text);
            
            $text  = str_replace('\cf1\highlight2', '', $text);
            $text  = str_replace('\cf0\highlight0', '', $text);
            //echo htmlspecialchars($text).'<br /><br />';

            
            $reader = new RtfReader(); 
            $result = $reader->Parse($text);
            $formatter = new RtfHtml();
            $text = $formatter->Format($reader->root);
            //echo $text.'<br /><br />--------------------------------------------------------------------<br />';            
            return $text;
        }
        
        //frame options FastReport
        public function FrameTyp($typ)
        {
            if(!$typ){
                return '';
            }
            if($typ == ''){
                return '';
            }
            $ds = array(
                "0"=>array(),
                "1"=>array('left'),
                "2"=>array('right'),
                "3"=>array('left', 'right'),
                "4"=>array('top'),
                "5"=>array('left', 'top'),
                "6"=>array('right', 'top'),
                "7"=>array('left', 'right', 'top'),
                "8"=>array('bottom'),
                "9"=>array('left', 'bottom'),
                "10"=>array('right', 'bottom'),
                "11"=>array('left', 'right', 'bottom'),
                "12"=>array('top', 'bottom'),
                "13"=>array('left', 'top', 'bottom'),
                "14"=>array('right', 'top', 'bottom'),
                "15"=>array('left', 'right', 'top', 'bottom')
            );
            return $ds[$typ];
        }
        
        public function FrameStyle($d)
        {
            if(!$d){return '';}
            if($d == ''){return '';}
            
            $ds = array(
                "fsSolid"       =>"solid",
                "fsDash"        =>"dashed",
                "fsDot"         =>"dotted",
                "fsDashDot"     =>"dashed",
                "fsDashDotDot"  =>"dotted",
                "fsDouble"      =>"double",
                "fsAltDot"      =>"dotted",
                "fsSquare"      =>"dotted"
            );
            return $ds[$d];
        }
    }
?>
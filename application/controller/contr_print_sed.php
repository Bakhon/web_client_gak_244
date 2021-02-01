<?php
    $db = new DB();
    if(isset($_GET['file_name']))
    { $file_name = $_GET['file_name'];}
    
    $today_date = date('d.m.Y');
    
    $sql_meta = "select * from DIC_META order by id";
    $list_meta = $db -> Select($sql_meta);
    

    if(isset($_POST['content']))
    {
        $html .= $_POST['content'];      
        if(isset($_POST['holi_id'])){
            $p['CONTENT'] = $_POST['content'];
            $holi_id = $_POST['holi_id'];
            
            $item_name = $_POST['ITEM_NAME'];
            $sqlHoli = "UPDATE PERSON_HOLIDAYS SET DOC_CONTENT = EMPTY_CLOB() WHERE ID = $holi_id
                            RETURNING DOC_CONTENT INTO :CONTENT";
            $t = $db->AddClob($sqlHoli, $p);
        }
    }

  if(isset($_POST['doc_list']))
    {
        $html = $_POST['doc_list'];
    }
   

  
      $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
// print_r($fontData);


$mpdf = new \Mpdf\Mpdf([
'default_font_size' => 9,
     'mode' => 'utf-8',
     'format' => 'A4-P',
     
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . 'styles/fonts/',
    ]),    
    'fontdata' => [
        'frutiger' => [
            'R' => 'times-new-roman.ttf',
            'I' => 'times-new-roman.ttf',
            'B' => "ofont.ru_Times New Roman.ttf",
        ]
    ],    
    'default_font' => 'frutiger'
]);
 
 //   $mpdf->AddPage('P');
 $mpdf->list_indent_first_level = 0; 
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
?>


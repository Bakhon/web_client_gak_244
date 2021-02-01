<?php
    if(isset($_POST['content'])){
        $html .= $_POST['content'];       
    }else{
        echo 'Не выбран проект!';
        exit;
    }

      $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
'default_font_size' => 9,
     'mode' => 'utf-8',
     'format' => 'A4-P',
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/custom/font/directory',
    ]),
    'fontdata' => $fontData + [
        'frutiger' => [
            'R' => 'times-new-roman.ttf'            
        ]
    ],
    'default_font' => 'frutiger'
]);
 
 //   $mpdf->AddPage('P');
 $mpdf->list_indent_first_level = 0; 
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output();
    exit;


?>
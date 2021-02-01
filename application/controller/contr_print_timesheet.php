<?php

    if(isset($_POST['content'])){
        $html .= $_POST['content'];
     
    }else{
        echo 'Не выбран табель!';
        exit;
    }
    if(isset($_GET['black'])){
        echo $_POST['content'];
        exit;
    }
    
    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
'default_font_size' => 9,
     'mode' => 'utf-8',
     'format' => 'A4-L',
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
 

    
//    include("methods/mpdf/mpdf.php");

//   $mpdf = new mPDF('UTF-8', 'A4', '9', 'Times New Roman');
 // $mpdf = new \Mpdf\Mpdf();//'UTF-8', 'A4', '9', 'Times New Roman');
 //  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']); 
// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    
    $mpdf->AddPage('L');
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output();
    exit;
    
            
?>
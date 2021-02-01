<?php

   if(isset($_POST['pdf'])){
    $html .= $_POST['pdf'];
   }
   else{
    echo 'Не найдено';
   }
    
    include("methods/mpdf/mpdf.php");

    $mpdf = new mPDF('UTF-8', 'A4', '9', 'Times New Roman');
    $mpdf->AddPage('L');
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
?>
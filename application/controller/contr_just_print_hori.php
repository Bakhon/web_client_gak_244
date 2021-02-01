<?php
    $db = new DB();
    
    if(isset($_POST['content'])){
        $html .= $_POST['content'];
    }
    //echo htmlspecialchars($html);
    include("methods/mpdf/mpdf.php");
    
    $mpdf = new mPDF('UTF-8', 'A4', '8', 'timesnewroman', 10, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/
    //              ('utf-8','A4','','timesnewroman',20,15,58,25,20,10);
    $mpdf->charset_in = 'UTF-8'; /*не забываем про русский*/
    $mpdf->WriteHTML($stylesheet, 1);
    
    $mpdf->list_indent_first_level = 0; 
    $mpdf->WriteHTML($html, 2); /*формируем pdf*/
    $mpdf->Output('mpdf.pdf', 'I');
    exit;
?>

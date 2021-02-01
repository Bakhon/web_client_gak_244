<?php
    $db = new DB();
    if(isset($_GET['file_name']))
    { $file_name = $_GET['file_name'];}
    
    $today_date = date('d.m.Y');
    
    $sql_meta = "select * from DIC_META order by id";
    $list_meta = $db -> Select($sql_meta);
    
    if(isset($_POST['doc_list']))
    {
        $html = $_POST['doc_list'];
    }

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

    if(isset($_POST['content_job_contract']))
    {
        $html .= $_POST['content_job_contract'];
        $empId = $_POST['empId'];

        $sql_person_docs = "SELECT * FROM PERSON_DOCS where TYPE = '1' and EMP_ID = '$empId'";
        $list_person_docs= $db -> Select($sql_person_docs);
        if(empty($list_person_docs))
        {
            $p['CONTENT'] = $_POST['content_job_contract'];
            $sequence_sql = "SELECT PERSON_DOCS_SEQ.nextval FROM DUAL";
            $sequence = $db -> Select($sequence_sql);
            $seq = $sequence[0]['NEXTVAL'];
            $sql = "insert into PERSON_DOCS (ID, NAME, CREATE_DATE, TYPE, EMP_ID) values ('$seq', 'Трудовой договор', '$today_date', '1', '$empId')";
            $listHoli = $db -> Execute($sql);

            $sqlHoli = "UPDATE PERSON_DOCS SET CONTENT = EMPTY_CLOB() WHERE ID = $seq
                            RETURNING CONTENT INTO :CONTENT";
            $t = $db->AddClob($sqlHoli, $p);
            echo '$list_person_docs is empty';
        }
            else
        {
            $id = $list_person_docs[0]['ID'];
            $p['CONTENT'] = $_POST['content_job_contract'];

            $sqlHoli = "UPDATE PERSON_DOCS SET CONTENT = EMPTY_CLOB() WHERE ID = $id
                            RETURNING CONTENT INTO :CONTENT";
            $t = $db->AddClob($sqlHoli, $p);
            echo $sqlHoli;
            echo '$list_person_docs is not empty';
        }
    }

    if(isset($_POST['content_append_contract']))
    {
        $html .= $_POST['content_append_contract'];
        $empId = $_POST['empId'];        

        $sql_person_docs = "SELECT * FROM PERSON_DOCS where TYPE = '2' and EMP_ID = '$empId'";
        $list_person_docs= $db -> Select($sql_person_docs);
        if(empty($list_person_docs))
        {
            $p['CONTENT'] = $_POST['content_append_contract'];
            $sequence_sql = "SELECT PERSON_DOCS_SEQ.nextval FROM DUAL";
            $sequence = $db -> Select($sequence_sql);
            $seq = $sequence[0]['NEXTVAL'];
            $sql = "insert into PERSON_DOCS (ID, NAME, CREATE_DATE, TYPE, EMP_ID) values ('$seq', 'Приложение к ТД', '$today_date', '2', '$empId')";
            $listHoli = $db -> Execute($sql);

            $sqlHoli = "UPDATE PERSON_DOCS SET CONTENT = EMPTY_CLOB() WHERE ID = $seq
                            RETURNING CONTENT INTO :CONTENT";
            $t = $db->AddClob($sqlHoli, $p);
            echo '$list_person_docs is empty';
        }
            else
        {
            $id = $list_person_docs[0]['ID'];
            $p['CONTENT'] = $_POST['content_append_contract'];

            $sqlHoli = "UPDATE PERSON_DOCS SET CONTENT = EMPTY_CLOB() WHERE ID = $id
                            RETURNING CONTENT INTO :CONTENT";
            $t = $db->AddClob($sqlHoli, $p);
            echo $sqlHoli;
            echo '$list_person_docs is not empty';
        }        
    }

    if(isset($_GET['job_contr_employee_id']))
    {
        $empId = $_GET['job_contr_employee_id'];
        $sequence_sql = "SELECT * FROM PERSON_DOCS where TYPE = '1' and EMP_ID = '$empId'";
        $sequence = $db -> Select($sequence_sql);
        $html = $sequence[0]['CONTENT'];
    }

    if(isset($_GET['append_contr_employee_id']))
    {
        $empId = $_GET['append_contr_employee_id'];
        $sequence_sql = "SELECT * FROM PERSON_DOCS where TYPE = '2' and EMP_ID = '$empId'";
        $sequence = $db -> Select($sequence_sql);
        $html = $sequence[0]['CONTENT'];
    }

 //   include("methods/mpdf/mpdf.php");

 //   $mpdf = new mPDF('UTF-8', 'A4', '8', 'timesnewroman', 20, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/
  
  
      $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
// print_r($fontData);


$mpdf = new \Mpdf\Mpdf([
'default_font_size' => 14,
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


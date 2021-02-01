<?php
$db = new DB();

//построение обьекта Employee
$empId = $_GET['employee_id'];

//создаем обьект Employee, в параметры передаем ID
$employee = new Employee($empId);

//функция get_emp_from_DB() возвращает массив с данными о работнике из базы
$empInfo = $employee -> get_emp_from_DB_trivial();

$sqlEmpInfo = "select triv.DATE_POST, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.JOB_POSITION,  triv.JOB_SP,  triv.BRANCHID, triv.MOB_PHONE, dolzh.D_NAME, dep.NAME, branch.NAME filial  from sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep, DIC_BRANCH branch where triv.id = $empId and DOLZH.ID = triv.JOB_POSITION and DEP.ID = triv.JOB_SP and branch.RFBN_ID = triv.BRANCHID";
$empInfo = $db -> Select($sqlEmpInfo);

$name = $empInfo[0]['LASTNAME'];
$lastname = $empInfo[0]['FIRSTNAME'];
$middlename = $empInfo[0]['MIDDLENAME'];
$cityname = 'г. Астана';
$address = 'Иманова, 11';
$chiefName = 'г-ну Г.Амерходжаев';
$posName = mb_strtolower($empInfo[0]['D_NAME'], 'UTF-8');
$depName = mb_strtolower($empInfo[0]['NAME'], 'UTF-8');
$filialname = mb_strtolower($empInfo[0]['FILIAL'], 'UTF-8');
$telNum = $empInfo[0]['MOB_PHONE'];

$DATE_POST = $empInfo[0]['DATE_POST'];

$d = getdate();
foreach ( $d as $key => $val )

$_monthsList = array(
"1"=>"Января","2"=>"Февраля","3"=>"Марта",
"4"=>"Апреля","5"=>"Мая", "6"=>"Июня",
"7"=>"Июля","8"=>"Августа","9"=>"Сентября",
"10"=>"Октября","11"=>"Ноября","12"=>"Декабря");
 
$month = $_monthsList[date("n")];


$html = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr width="40%">
                <th colspan=3>
                </th>
            </tr>
            <tr>
                <td width="50%">
                    <p style="text-align: justify; font-size: 14pt;">
                        «'.$d[mday].'»'.$month.' '.$d[year].' г.
                    </p>
                </d>
                <td width="50%" style="text-align: justify; font-size: 14pt; width: 100%" style="height: 100px;">
                </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 10px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%">СПРАВКА</th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <p style="text-align: justify; font-size: 14pt; padding: -10px ; text-indent: 20px;">
            
            Дана  '.$name.'у '.$lastname.'у '.$middlename.'у,  в том, что он(-а) действительно работает в АО «Компания по страхованию жизни «Государственная аннуитетная компания» в должности '.$posName.' в '.$depName.' с '.$DATE_POST.' г.
        </p>
        <p style="text-align: justify; font-size: 14pt; padding: -10px ; text-indent: 20px;">
            Справка дана для предъявления по месту требования.
        </p>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align: justify; font-size: 14pt; width: 100%; text-indent: 20px;">
            <tr>
            <td width="100%"></td>
            </td>
            </tr>
            <tr >
            <td colspan=3 style="height: 200px;"></td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <th width="30%" style="text-align: right; font-size: 14pt; width: 100%">
                Главный специалист 
                по управлению персоналом
            </th>
            <td width="30%">
            </td>
            <th width="40%" style="text-align: right; font-size: 14pt; width: 100%"><br>А. Ибраева<br><br>
            </th>
            </tr>
            <tr>
            </tr>
        </table>
        ';

//require_once("methods/mpdf/mpdf.php");
include("methods/mpdf/mpdf.php");

$mpdf = new mPDF('utf-8', 'A4', '8', '', 10, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/
$mpdf->charset_in = 'utf-8'; /*не забываем про русский*/

$stylesheet = file_get_contents('style.css'); /*подключаем css*/
$mpdf->WriteHTML($stylesheet, 1);

$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($html, 2); /*формируем pdf*/
$mpdf->Output('mpdf.pdf', 'I');
?>
<style>
    table {text-align: center;font-size: 20pt;width: 100%;}
</style>


<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <th width="50%"></th>
            <div style="
            left: 0; bottom: 0;
            padding: 10px;
            background: #39b54a;
            color: #fff;
            width: 100%;
            ">Переписать вручную</div>
            <th width="40%"></th>
            <th width="10%"></th>
            </tr>
            
            <tr>
            <th width="10%"></th>
            <th width="50%"></th>
            <th width="40%" style="text-align: center; font-size: 14pt; width: 100%">Председателю Правления
                АО «Компания по страхованию жизни «Государственная аннуитетная компания»
                '.$chiefName.' от '.$name.'а '.$lastname.'а '.$middlename.'а
            </th>
            </tr>
        </table>
        <div style="height: 20px;"></div>
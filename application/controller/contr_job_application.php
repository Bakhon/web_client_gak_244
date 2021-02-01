<?php
$db = new DB();

//построение обьекта Employee
$empId = $_GET['employee_id'];

//создаем обьект Employee, в параметры передаем ID
$employee = new Employee($empId);

//функция get_emp_from_DB() возвращает массив с данными о работнике из базы
$empInfo = $employee -> get_emp_from_DB_trivial();

$sqlEmpInfo = "select country.RU_NAME, triv.FACT_ADDRESS_BUILDING, triv.FACT_ADDRESS_STREET, triv.FACT_ADDRESS_CITY, triv.LASTNAME, triv.FIRSTNAME, triv.MIDDLENAME, triv.JOB_POSITION,  triv.JOB_SP,  triv.BRANCHID, triv.MOB_PHONE, dolzh.D_NAME, dep.NAME, branch.NAME filial from DIC_COUNTRY country, sup_person triv, DIC_DOLZH dolzh, DIC_DEPARTMENT dep, DIC_BRANCH branch where triv.id = $empId and DOLZH.ID = triv.JOB_POSITION and DEP.ID = triv.JOB_SP and branch.RFBN_ID = triv.BRANCHID and country.ID = triv.FACT_ADDRESS_COUNTRY_ID";
//$empInfo = $db -> Select($sqlEmpInfo);

$name = $empInfo[0]['LASTNAME'];
$lastname = $empInfo[0]['FIRSTNAME'];
$middlename = $empInfo[0]['MIDDLENAME'];
$country = $empInfo[0]['RU_NAME'];
$cityname = $empInfo[0]['FACT_ADDRESS_CITY'];
$factAddress = $empInfo[0]['FACT_ADDRESS_STREET'];
$FACT_ADDRESS_BUILDING = $empInfo[0]['FACT_ADDRESS_BUILDING'];
$chiefName = 'г-ну Г.Амерходжаев';
$posName = $empInfo[0]['D_NAME'];
$depName = $empInfo[0]['NAME'];
$filialname = $empInfo[0]['FILIAL'];
$telNum = $empInfo[0]['MOB_PHONE'];
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
            <h2 colspan=3 style="
            left: 0; bottom: 0;
            padding: 10px;
            background: #c91a1a;
            color: #fff;
            width: 100%;
            ">Переписать вручную</h2>
            </th>
            </tr>
            <tr>
            <th width="10%"></th>
            <th width="50%"></th>
            <td width="40%" style="text-align: justify; font-size: 14pt; width: 100%">Председателю Правления
                АО «Компания по страхованию жизни «Государственная аннуитетная компания»
                '.$chiefName.'у от '.$name.'а '.$lastname.'а '.$middlename.'а
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 14pt; width: 100%" style="height: 100px;"></th>
            <td width="10%">
            </td>
            </tr>
            <tr>
            <td width="10%"></td>
                <th style="text-align: center; font-size: 16pt; width: 100%">ЗАЯВЛЕНИЕ<br>
                о приеме на работу</th>
            <td width="10%">
            </td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align: justify; font-size: 14pt; width: 100%; text-indent: 20px;">
            <tr>
            <td width="100%"><p>Я, '.$name.' '.$lastname.' '.$middlename.', проживающий по адресу г. '.$cityname.' ('.$country.'), ул.'.$factAddress.' д.'.$FACT_ADDRESS_BUILDING.', ('.$telNum.'), прошу Вас принять меня на работу в АО «Компания по страхованию жизни «Государственная аннуитетная компания» (далее – АО «КСЖ «ГАК») на должность '.$posName.' в '.$depName.' ('.$filialname.'). 
            Настоящим даю свое согласие АО «КСЖ «ГАК» на предоставление, сбор, обработку, как с использованием средств автоматизации, так и без использования таких средств, своих персональных данных, а также предоставляю право на передачу указанной информации третьим лицам и получение своих персональных данных от третьих лиц, в целях обеспечения надлежащего исполнения обязательств по заключаемому трудовому договору, а также в случаях, предусмотренных законодательством Республики Казахстан.
            </p></td>
            </td>
            </tr>
            <tr >
            <td colspan=3 style="height: 200px;"></td>
            </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="50%">
            </td>
            <td width="10%">
            </td>
            <td width="40%" style="text-align: right; font-size: 14pt; width: 100%">(подпись)<br><br>'.$name.' '.$lastname.' '.$middlename.'<br><br>
            «'.$d[mday].'»'.$month.' '.$d[year].' г.

            </td>
            </tr>
            <tr>
            </tr>
        </table>
        <div colspan=3 style="
            position: fixed;
            left: 0; bottom: 0;
            padding: 10px;
            background: #39b54a;
            color: #fff;
            width: 100%;
            ">Ф ГАК 601-05. Заявление о приеме на работу. Издание восьмое (Образец)</div>
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



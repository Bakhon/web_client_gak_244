<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">	
	<title>Счет на оплату</title>
    <link href="styles/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="styles/css/style.css" rel="stylesheet"/>-->
</head>
<body>
<div style="size: a4;">
    <div style="text-align: center; width: 70%; margin-left: 30%; ">
         Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об 
         <br />оплате
         <br />обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по 
         <br />факту  прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и документов 
         <br />удостоверяющих личность.
    </div>

    <p>
        <b>Образец платежного поручения</b>
    </p>
    <p>
    <table class="table table-bordered">
    <tbody>
        <tr>
            <td style="width: 52%;"><strong>Бенефициар:</strong></td>
            <td style="text-align: center; width: 26.302%;"><strong>ИИК</strong></td>
            <td style="text-align: center; width: 17.698%;"><strong>Кбе</strong></td>
        </tr>
        <tr>
            <td style="width: 52%;"><strong>Акционерное общество "Компания по страхованию жизни"Государственная аннуитетная компания"</strong></td>
            <td style="text-align: center; width: 26.302%;" rowspan="2"><strong>KZ506010111000044734</strong></td>
            <td style="text-align: center; width: 17.698%;" rowspan="2"><strong>15</strong></td>
        </tr>
        <tr>
            <td style="width: 52%;">БИН: 050640002859</td>
        </tr>    
        <tr>
            <td style="width: 52%;"><b>Банк бенефициара:</b></td>
            <td style="text-align: center; width: 26.302%;"><strong>БИК</strong></td>
            <td style="text-align: center; width: 17.698%;"><strong>Код назначения платежа</strong></td>
        </tr>
        <tr>
            <td style="width: 52%;">АО НАРОДНЫЙ БАНК КАЗАХСТАНА</td>
            <td style="text-align: center; width: 26.302%;"><strong>HSBKKZKX</strong></td>
            <td style="text-align: center; width: 17.698%;"><strong>833</strong></td>
        </tr>    
    </tbody>
    </table>    
    </p>
    
    <h4><b>Счет на оплату № <?php echo $dan['NUM_SCHET_OPL']; ?> от <?php echo $dan['DATE_SHET_OPL_TEXT']; ?> г.</b><br /><hr /> </h4>
    
    
    <table class="table table-no-bordered">
    <tbody>
        <tr>
            <td>Поставщик:</td>
            <td>БИН / ИИН 050640002859,Акционерное общество "Компания по страхованию жизни"Государственная аннуитетная компания",г.Астана,ул.Иманова,11, тел.:  87172 916333</td>
        </tr>
        <tr>
            <td>Покупатель:</td>
            <td>БИН / ИИН <?php echo $dan['BIN'].', '.$dan['NAME_REINS']; ?></td>
        </tr>
        <tr>
            <td>Договор:</td>
            <td><?php echo $dan['CONTRACT_NUM']; ?> от <?php echo $dan['CONTRACT_DATE']; ?> г.</td>
        </tr>
    </tbody>
    </table>
    
    <table class="table table-bordered">
    <tbody>
        <tr>
            <td><center>№</center></td>
            <td>Код</td>
            <td>Наименование</td>
            <td><center>Кол-во</center></td>
            <td><center>Ед.</center></td>
            <td><center>Цена</center></td>
            <td><center>Сумма</center></td>
        </tr>
        
        <tr>
            <td><center>1</center></td>
            <td></td>
            <td>возврат перестраховочной премии</td>
            <td><center><?php echo $dan['CNT']; ?>,000</center></td>
            <td><center>дог</center></td>
            <td><center><?php echo $dan['PAY_SUM_OPL']; ?></center></td>
            <td><center><?php echo $dan['PAY_SUM_OPL']; ?></center></td>
        </tr>
    </tbody>
    </table>
    
    <table class="table table-no-bordered">
    <tbody>
        <tr>
            <td style="text-align: right;"><b>Итого:</b></td>
            <td style="width: 15%;"><b><?php echo $dan['PAY_SUM_OPL']; ?></b></td>        
        </tr>
        <tr>
            <td style="text-align: right;"><b>Без налога (НДС)</b></td>
            <td><b>-</b></td>        
        </tr>
    </tbody>
    </table>
    
    <p>Всего наименований <?php echo $dan['CNT']; ?>, на сумму <?php echo $dan['PAY_SUM_OPL']; ?> KZT</p>
    <p><b>Всего к оплате: <?php echo $dan['PAY_SUM_OPL']; ?> <?php echo $dan['PAY_SUM_OPL_TEXT']; ?></b></p>
    <p>
        <hr />
    </p>
    
    <p>
    <table class="table table-no-bordered">
    <tbody>
        <tr>
            <td style="width: 20%;"><b>Исполнитель: </b></td>
            <td style="border-bottom: solid 1px;"></td>        
            <!--<td style="width: 50%;">/Карлыгашева Д.Б./</td>-->
          <!--  <td style="width: 50%;">/Абдыгалиева Л.А./</td> -->
            <td style="width: 50%;">/Шамшуалеева А.Б./</td> 
        </tr> 
        <tr>
            <td style="width: 20%;"></td>
            <td></td>        
            <td style="width: 50%;"></td>
        </tr>
       <!-- 
        <tr>
            <td style="width: 20%;"><b>Согласовано: </b></td>
            <td style="border-bottom: solid 1px;"></td>        
            <td style="width: 50%;">/Акажанов А.А./</td>
        </tr>  
        -->  
        <tr>
            <td style="width: 20%;"><b>Согласовано: </b></td>
            <td style="border-bottom: solid 1px;"></td>        
            <td style="width: 50%;">/Амерходжаев Г.Т./</td>
        </tr>
              
    </tbody>
    </table>
    </p>
</div>



<style>
.table-no-bordered>tbody>tr>td,.table-no-bordered>tbody>tr>th,.table-no-bordered>tfoot>tr>td,.table-no-bordered>tfoot>tr>th,.table-no-bordered>thead>tr>td,.table-no-bordered>thead>tr>th {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 0px solid;
  font-size: 10px;
}

hr {
  margin-top: 20px;
  margin-bottom: 20px;
  border: 0;
  border-top: 1px solid;
}

.table-bordered {
  border: 1px solid #000;
}

.table-bordered>tbody>tr>td,.table-bordered>tbody>tr>th,.table-bordered>tfoot>tr>td,.table-bordered>tfoot>tr>th,.table-bordered>thead>tr>td,.table-bordered>thead>tr>th {
  border: 1px solid #000;
  font-size: 10px;
}

body{
    font-size: 10px;
}
</style>
</body>
</html>
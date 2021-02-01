<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">	
	<title>Счет на оплату</title>
    <link href="styles/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="styles/css/style.css" rel="stylesheet"/>-->
</head>
<body>
<?php
	$zastrah = 'застрахованной ';
    if($dan['client']['SEX'] == '1'){
        $zastrah = 'застрахованному ';
    }
    
    $vid_reins = 'факультативного';
    if($dan['main']['REINS_VID'] == '1'){
        $vid_reins = 'облигаторного';
    }
    if($dan['main']['REINS_VID'] == '2'){
        $vid_reins = 'облигаторного';
    }
?>
<div contenteditable="true">
<div style="margin-top: 5cm;">&nbsp;</div>
<div style="font-weight: bold;margin-left: 10cm;">
    <strong><span style="color:black;"><?php echo $dan['podpis']['FIO']; ?></span></strong><br />
    <strong><span style="color:black;"><?php echo $dan['main']['REINSNAME']; ?></span></strong><br />
    <strong><span style="color:black;"><?php echo $dan['podpis']['GOSPOD'].' '.$dan['podpis']['FIO_RUK']; ?></span></strong><br />    
    <br />
</div>
<p>
    <em>О страховой выплате, произведенной АО &laquo;Компания по страхованию жизни &laquo;Государственная аннуитетная компания&raquo; 
    в рамках Договора <?php echo $vid_reins; ?> перестрахования № <?php echo $dan['main']['CONTRACT_NUM_REINS']; ?> от <?php echo $dan['main']['CONTRACT_DATE_REINS']; ?> г.&nbsp;</em>
    <br /><br />
</p>
<p>
    Пользуясь случаем, позвольте выразить Вам свое почтение за сотрудничество с нашей Компанией.
</p>
<p>
    Настоящим АО &laquo;Компания по страхованию жизни &laquo;Государственная аннуитетная компания&raquo; (далее &ndash; Компания) направляет Вам пакет документов по произведенной 
    страховой выплате <?php echo $zastrah.$dan['main']['FIO']; ?> 
    сотруднику <?php echo $dan['main']['STRAHOVATEL']; ?>.
</p>
<p>
<?php 
  if($dan['main']['RFPM_ID'] == '0802'){
?>
    Страховая выплата в счет возмещения дополнительных расходов <?php echo $zastrah. $dan['main']['FIO']; ?> 
    составила <?php echo NumberRas($dan['contract']['PAY_SUM_V']).' '.$dan['contract']['PAY_SUM_V_RUS']; ?>.
<?php }else{ ?>
    Страховая премия по <?php echo $zastrah.$dan['main']['FIO']; ?> составила <?php echo NumberRas($dan['contract']['PAY_SUM_P']).' '.$dan['contract']['PAY_SUM_P_RUS']; ?>.
<?php } ?>
</p>

<p>
    Согласно условиям Договора <?php echo $vid_reins; ?> перестрахования работника от несчастных случаев 
    при исполнении им трудовых (служебных) обязанностей № <?php echo $dan['main']['CONTRACT_NUM_REINS']; ?> от <?php echo $dan['main']['CONTRACT_DATE_REINS'] ?> г. 
    (далее &ndash; Договор перестрахования), доля ответственности Перестраховщика 
    (<?php echo $dan['main']['REINSNAME']; ?>) 
    в выплате составляет <?php echo $dan['main']['PERC_S_STRAH']; ?> % или <?php echo NumberRas($dan['main']['SUM_DEB']).' '.$dan['main']['SUM_DEB_TEXT']; ?>.
</p>

<p>
    В связи с вышеизложенным, просим Вас рассмотреть пакет документов и произвести возврат доли страховой выплаты в сроки, предусмотренные договором перестрахования на следующие реквизиты:
</p>

<p>
    АО &laquo;Компания по страхованию жизни &laquo;Государственная аннуитетная компания&raquo;
</p>

<p>
    010000, Республика Казахстан,&nbsp;
</p>

<p>
    г. Нур-Cултан, пр. Мангилик Ел, 20&nbsp;
</p>

<p>
    тел. 8 (7172) &nbsp;916-333&nbsp;
</p>

<p>
    БИН 050640002859
</p>

<p>
    ИИК:&nbsp;KZ506010111000044734
</p>

<p>
    в АО &laquo;Народный Банк Казахстана&raquo;
</p>

<p>
    БИК:&nbsp;HSBKKZKX
</p>

<p>
    Признак резидентства-1
</p>

<p>
    Код сектора экономики-5
    <br />
    <br />
</p>

<strong>
<p>
            
        <span style="color:black;">С уважением, &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>
</p>
<p>
        <span style="float: right;"><?php echo $dan['podpis_gak']['FIO_RUK']; ?></span>
        <?php echo $dan['podpis_gak']['DOLGNOST']; ?>    
</p>
</strong>

<div style="position: fixed; bottom: 0px;">
<p><em><span style="font-size:12px;">Исп.: _______________</span></em></p>

<p><em><span style="font-size:12px;">8 (7172) 916-333</span></em></p>
</div>

</div>
<style>
body{
    font-family:"Times New Roman";
    font-size:16px;
}
p{
    text-indent:1.0cm;
    text-align:justify;
    margin:0cm;
    margin-bottom:.0001pt;
}
</style>


<?PHP 
    //echo '<pre>';
    //print_r($dan);
    //echo '</pre>';
?>
</body>
</html>
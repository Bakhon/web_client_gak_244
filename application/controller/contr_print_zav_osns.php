<?php

	if(!isset($_GET['cnct'])){
	   exit;
	}
    
    header('Content-Type: text/html; charset=utf-8');
    $cnct_id = $_GET['cnct'];
    
    $db = new DB3();
    
    $cn = $db->Select("select * from( 
      select * from contracts where cnct_id = $cnct_id
      union all
      select * from contracts_maket where cnct_id = $cnct_id
    )");
    
    //Данные страхователя
    $strah = $db->Select("select * from contr_agents c where c.id = ".$cn[0]['ID_INSUR']);
    
    //Банковские данные
    $bank = $db->Select("select * from dic_banks b where b.bank_id = ".$strah[0]['BANK_ID']); //cn.bank_id
    if(count($bank) <= 0){
        echo '<center><h1>У Данного предприятия не забиты "Банковские данные"</h1></center>';
    }
       
    //Данные по ОКЕД-у предприятия
    $oked = $db->Select("select * from dic_oked_afn d where d.id = ".$cn[0]['OKED_ID']);
    
    $oscalc = $db->Select("select * from osns_calc where cnct_id = $cnct_id");
    
    $si = $db->Select("select * from SEGMENT_INSUR where id_insur = ".$cn[0]['ID_INSUR']);
    
    $akt_count = $db->Select("select count(*) akt_count from OSNS_ACT_N1 where cnct_id = $cnct_id");
        
?>

<style>@media print { .rotator {filter:progid:DXImageTransform.Microsoft.BasicImage(Rotation=1)} } .pagebreak { page-break-before: always; }</style>

<div class="pagebreak">
<table style="font-size: 10px;border-collapse: collapse;" border="0" width="100%" cellspacing="0" cellpadding="0"><!--StartFragment--> <colgroup><col width="30" /> <col width="651" /> <col width="31" /> <col width="54" /> <col width="24" /> <col width="60" /> <col width="58" /> <col width="99" /> <col span="2" width="52" /> <col width="41" /> <col width="45" /> <col width="67" /> <col width="88" /> <col width="226" /> </colgroup>
<tbody>
<tr>
<td style="text-align: center;" colspan="15"><strong>ЗАЯВЛЕНИЕ - АНКЕТА</strong></td>
</tr>
<tr>
<td style="text-align: center;" colspan="15"><strong>на заключение договора&nbsp; обязательного страхования</strong></td>
</tr>
<tr>
<td style="text-align: center;" colspan="15"><strong>работника от несчастных случаев при исполнении им трудовых (служебных) обязанностей</strong></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2">
<p><strong>1. Заявитель</strong><br /><strong>ФИЗИЧЕСКОЕ ЛИЦО&nbsp; &nbsp;(ИП)/&nbsp;ЮРИДИЧЕСКОЕ ЛИЦО</strong></p>
</td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?php $f = $db->Select("select fond_name(".$cn[0]['ID_INSUR'].") f from dual"); echo $f[0]['F'];  ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Юридический адрес</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?php echo $strah[0]['ADDRESS']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Фактическое место нахождения/ место расположения</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?php echo $strah[0]['ADDRESS']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Вид документа, подтверждающего регистрацию&nbsp;</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>дата выдачи, номер (при наличии)</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><input type="text" style="border: 0px; font-size: 10px; width: 100%;"></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2">
<p><strong>Наименование регистрирующего органа</strong></p>
<p><strong>дата регистрации; место регистрации (перерегистрации)</strong></p>
</td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13">
<p><input type="text" style="border: 0px; font-size: 10px;width:100%;"></p>
<p><input type="text" style="border: 0px; font-size: 10px;width:100%;"></p>
</td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Телефон, факс, эл.адрес</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?php echo $strah[0]['PHONE']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Банковские реквизиты</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13">БИН\ИИН <?php echo $strah[0]['BIN'].' <br>'.$bank[0]['NAME'].' '.$strah[0]['P_ACCOUNT']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Признак резидентства</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13">
    <input type="checkbox" <?php if($strah[0]['RESIDENT'] == '1'){echo 'checked';} ?>>Резидент &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <input type="checkbox" <?php if($strah[0]['RESIDENT'] !== '1'){echo 'checked';} ?>>Нерезидент <?php if($strah[0]['resident'] == 1){$s = $db->Select("select country_name(".$strah[0]['COUNTRY_ID'].") c from dual"); echo $s[0]['C'];} ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Код сектора экономики</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?php echo $strah[0]['SEC_ECONOM']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>Организационно-правовая форма</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?php IF($strah[0]['NATURAL_PERSON_BOOL'] == 0){ ECHO 'Товарищество с ограниченной ответственностью';}else {ECHO 'Индивидуальный предприниматель';} ?></td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>2.&nbsp;&nbsp;Предоставьте, пожалуйста, сведения о производственной деятельности предприятия:</strong></td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>2.1. Сведения о лицензии на право осуществления деятельности подлежащей лицензированию</strong></td>
</tr>
<tr>
<td style="width: 1.606%; border: 1px solid;" rowspan="2">
<p style="text-align: center;">№</p>
<p style="text-align: center;">п/п</p>
</td>
<td style="width: 43.7901%; border: solid 1px;" colspan="5" rowspan="2">Вид лицензируемой деятельности</td>
<td style="width: 18.576%; border: 1px solid; text-align: center;" colspan="6">Срок действия</td>
<td style="width: 9.15418%; border: 1px solid; text-align: center;" colspan="2" rowspan="2">№ лицензии&nbsp;</td>
<td style="width: 12.0985%; border: 1px solid; text-align: center;" rowspan="2">Кем выдана&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 8.40471%; border: 1px solid; text-align: center;" colspan="2">Дата выдачи</td>
<td style="width: 10.1713%; border: 1px solid; text-align: center;" colspan="4">дата окончания</td>
</tr>
<tr>
<td style="width: 1.606%; border: 1px solid;"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 43.7901%; border: 1px solid;" colspan="5"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 8.40471%; border: solid 1px;" colspan="2"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 10.1713%; border: solid 1px;" colspan="4"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 9.15418%; border: solid 1px;" colspan="2"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 12.0985%; border: solid 1px;"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
</tr>
<tr>
<td style="width: 1.606%; border: 1px solid;"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 43.7901%; border: 1px solid;" colspan="5"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 8.40471%; border: solid 1px;" colspan="2"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 10.1713%; border: solid 1px;" colspan="4"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 9.15418%; border: solid 1px;" colspan="2"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
<td style="width: 12.0985%; border: solid 1px;"><input type="text" style="border: 0px; font-size: 10px;width:100%;"></td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15">Деятельность не подлежит лицензированию <input type="checkbox"></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>2.2. Виды экономической деятельности (перечислить все виды эк.деятельности, осуществляемые Заявителем )</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?PHP ECHO $oked[0]['NAME_OKED']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>2.3. Основной вид деятельности</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?PHP ECHO $oked[0]['NAME_OKED']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: solid 1px;" colspan="2"><strong>2.4. ОКЭД</strong></td>
<td style="width: 48.8758%; border: solid 1px;" colspan="13"><?PHP ECHO $oked[0]['OKED']; ?></td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>3. Были ли несчастные случаи на предприятии, за последние 5 лет&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
ДА <input type="checkbox" <?php if($akt_count[0]['AKT_COUNT'] > 0){ echo 'checked';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
НЕТ <input type="checkbox"  <?php if($akt_count[0]['AKT_COUNT'] <= 0){ echo 'checked';} ?>> <br /> </strong></td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>4. Информация о работниках Страхователя/филиала (-ов) Страхователя, которым была установлена от 5 по 29 процентов утраты профессиональной трудоспособности (далее - УПТ), включительно за последние 5 лет, предшествующие заключению настоящего договора</strong></td>
</tr>
<tr>
<td style="width: 1.606%; border: 1px solid;" rowspan="2">п/п</td>
<td style="width: 36.4026%; border: solid 1px;" colspan="2" rowspan="2">ФИО работника</td>
<td style="width: 2.89079%; border: 1px solid; text-align: center;" rowspan="2">Номер и дата Акта Н-1</td>
<td style="width: 7.60171%; border: 1px solid; text-align: center;" colspan="3" rowspan="2">Диагноз</td>
<td style="width: 5.29979%; border: solid 1px;" rowspan="2">Степень вины работо-дателя</td>
<td style="width: 2.78373%; border: 1px solid;" rowspan="2">Степень УПТ,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; в %</td>
<td style="width: 2.78373%; border: 1px solid;" rowspan="2">Дата установ-ления УПТ</td>
<td style="width: 2.19486%; border: solid 1px;" rowspan="2">Срок УПТ&nbsp;</td>
<td style="width: 5.99572%; border: solid 1px;" colspan="2">Период УПТ</td>
<td style="width: 5.56745%; border: solid 1px;" rowspan="2">Сумма осуществ-ленных выплат по возмеще-нию вреда здоровью,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; в тенге</td>
<td style="width: 12.0985%; border: solid 1px;" rowspan="2">Сумма осуществленных выплат по возмеще-нию расходов,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; в тенге</td>
</tr>
<tr>
<td style="width: 2.40899%; border: solid 1px;">Дата начала</td>
<td style="width: 3.58672%; border: solid 1px;">Дата окончания</td>
</tr>

<?php
	for($i=0; $i<3;$i++){
?>    
    <tr>
    <td style="width: 1.606%; border: 1px solid;">&nbsp;</td>
    <td style="width: 36.4026%; border: solid 1px;" colspan="2">&nbsp;</td>
    <td style="width: 2.89079%; border: solid 1px;">&nbsp;</td>
    <td style="width: 7.60171%; border: solid 1px;" colspan="3">&nbsp;</td>
    <td style="width: 5.29979%; border: solid 1px;">&nbsp;</td>
    <td style="width: 2.78373%; border: 1px solid;">&nbsp;</td>
    <td style="width: 2.78373%; border: 1px solid;">&nbsp;</td>
    <td style="width: 2.19486%; border: solid 1px;">&nbsp;</td>
    <td style="width: 2.40899%; border: solid 1px;">&nbsp;</td>
    <td style="width: 3.58672%; border: solid 1px;">&nbsp;</td>
    <td style="width: 5.56745%; border: solid 1px;">&nbsp;</td>
    <td style="width: 12.0985%; border: solid 1px;">&nbsp;</td>
    </tr>
<?php } ?>

<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>5. Период страхования&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; с <?php echo $cn[0]['DATE_BEGIN']; ?> года по <?php echo $cn[0]['DATE_END']; ?> года, включительно</td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>6.&nbsp;&nbsp;&nbsp;&nbsp;Численность работников на Вашем предприятии</strong></td>
</tr>
<tr>
<td style="width: 38.0086%; border: 1px solid; " colspan="3">Общая численность работников</td>
<td style="width: 4.17559%; border: 1px solid; text-align: center; " colspan="2">Класс профессио-нального риска</td>
<td style="width: 6.31692%; border: 1px solid; text-align: center; " colspan="2">Оклад, в тенге</td>
<td style="width: 10.8672%; border: 1px solid; text-align: center; " colspan="3">
<p>Среднемесячная заработная плата,</p>
<p>в тенге</p>
</td>
<td style="width: 25.8565%; border: 1px solid; text-align: center; " colspan="5">Годовой фонд оплаты труда, в тенге</td>
</tr>

<?php
	$s = $db->Select("select sum(cnt) cnt, sum(gfot) gfot from osns_calc_new where cnct_id = $cnct_id");
    foreach($s as $k=>$i){
        echo '
            <tr>
            <td style="width: 38.0086%; border: solid 1px;" colspan="3">'.$i['CNT'].'</td>
            <td style="width: 4.17559%; border: solid 1px;" colspan="2">'.$oscalc[0]['RISK_ID'].'</td>
            <td style="width: 6.31692%; border: solid 1px;" colspan="2"></td>
            <td style="width: 10.8672%; border: solid 1px;" colspan="3"></td>
            <td style="width: 25.8565%; border: solid 1px;" colspan="5">'.$i['GFOT'].'</td>
            </tr>';   
    }
?>



<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15">Настоящим подтверждаем, что данные, приведенные в этом Заявлении, являются полными и достоверными по мере нашей осведомленности, и служат основой для оформления страхового договора, являясь его неотъемлемой частью, а также любое возмещение будет рассчитано на основании вышеуказанной информации.</td>
</tr>
<tr>
<td style="width: 85.2248%; border: 1px solid;" colspan="15"><strong>7. Дополнительная информация</strong></td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.1. Существует ли у Вас на предприятии вредный и (или) опасный&nbsp; производственный фактор?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.2. Использует ли Ваша предприятие взрывчатые и опасные вещества на рабочей площадке?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.3. Существует ли на Вашем предприятии служба охраны труда?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.4. Проводится ли внутренний контроль по безопасности и охране труда?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.5. Соблюдаются ли требования по безопасности и охране труда, пожарной безопасности и производственной санитарии на рабочем месте?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.6. Проводятся ли на Вашем предприятии медицинский/профилактический осмотр работников?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.7. Проводится ли с каждым сотрудником на Вашем предприятии инструктаж по технике безопасности?&nbsp;</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.8. Обеспечиваются ли работники средствами индивиуальной защиты?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.9. Проводится ли атестация производственного объекта/рабочего места?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 53.8009%; border: solid 1px;" colspan="8">7.10. Оформлялись предприсания уполномоченными местными органами по причине несоблюдения техники безопасности труда, пожарной безопасности и др.?</td>
<td style="width: 31.424%; border: solid 1px;" colspan="7">ДА <input type="checkbox">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; НЕТ <input type="checkbox"> </td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>8. Дополнительные сведения об иностранном юридическом лице</strong></td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Регистрационный номер (код), присвоенный уполномоченным органом в государстве регистрации</td>
<td style="width: 48.8758%; border: 1px solid; " colspan="13">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Номер налогоплательщика в государстве регистрации</td>
<td style="width: 48.8758%; border: 1px solid; " colspan="13">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2" rowspan="2">Является ли первый руководитель или член(-ы) исполнительного органа иностранным публичным должностным лицом (политическим деятелем или государственным служащим иностранного государства)(далее &ndash; ИПДЛ)&nbsp;</td>
<td style="width: 48.8758%; border: 1px solid; " colspan="13">Является&nbsp;&nbsp; <input type="checkbox">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Не является&nbsp; <input type="checkbox">&nbsp; &nbsp;</td>
</tr>
<tr>
<td style="width: 48.8758%; border: 1px solid; " colspan="13">Примечание: данная графа заполняется только в случае, если первый руководитель или член(-ы) исполнительного органа является&nbsp; иностранным публичным должностным лицом (политическим деятелем или государственным служащим иностранного государства).</td>
</tr>
<tr>
<td style="width: 85.2248%; border: 1px solid; " colspan="15"><strong>9. Сведения о структуре собственности и управления</strong></td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Структура и наименование органов&nbsp; (высший орган, исполнительный орган, иные органы) в соответствии с учредительными документами</td>
<td style="width: 48.8758%; border: 1px solid; " colspan="13"><?php echo $strah[0]['CHIEF_DOLZH']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Дата последней редакции учредительных документов, на основании которых установлена структура органов юридического лица</td>
<td style="width: 48.8758%; border: 1px solid; " colspan="13">"___" __________ 20__г</td>
</tr>
<tr>
<td style="width: 85.2248%; border: solid 1px;" colspan="15"><strong>10. Сведения о персональном составе исполнительного органа</strong></td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">ФИО (при его наличии) лица, осуществляющего функции единоличного исполнительного органа, либо ФИО (при их наличии) руководителя и членов коллегиального исполнительного органа/ дата рождения/контактный телефон/е-mail&nbsp;</td>
<td style="width: 48.8758%; border: 1px solid; " colspan="13"><?php echo $strah[0]['CHIEF']; ?></td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2"><strong>11. Сведения о представителе юридического лица</strong></td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">Представитель юридического лица</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">руководителя филиала (представительства) юридического лица</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Ф.И.О. (при его наличии)</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Дата и место рождения</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Гражданство (при наличии)</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">ИИН (при наличии)</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Вид документа, удостоверяющего личность, номер, серия (при ее наличии)</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Наименование органа, выдавшего документ, удостоверяющий личность, дата его выдачи и срок действия</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Адрес места жительства (регистрации) или места пребывания (государство/юрисдикция, почтовый индекс, населенный пункт, улица/район, номер дома и при наличии номер квартиры)</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Номер контактного телефона</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Номер, дата и срок действия (при наличии) документа (приказа, доверенности), предоставляющего представителю право совершать юридически значимые действия от имени юридического лица (открытие счета, распоряжение счетом)&nbsp;&nbsp;</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Номер, дата выдачи, срок действия визы (в случае представления в качестве документа, удостоверяющего личность, заграничного паспорта) (за исключением граждан государств, въезжающих в Республику Казахстан в безвизовом порядке)</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Номер, дата выдачи, срок действия миграционной карточки (в случае представления в качестве документа, удостоверяющего личность, заграничного паспорта)</td>
<td style="width: 23.0193%; border: 1px solid; " colspan="8">&nbsp;</td>
<td style="width: 25.8565%; border: 1px solid; " colspan="5">&nbsp;</td>
</tr>
<tr>
<td style="width: 85.2248%; border: 1px solid; " colspan="15"><strong>12. Дополнительные сведения о филиале (представительстве) юридического лица</strong></td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Наименование филиала (представительства)</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">ИИН (при наличии)</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Вид документа, подтверждающего регистрацию, дата его выдачи, номер (при наличии)</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Наименование регистрирующего органа и дата регистрации (перерегистрации)</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Вид (виды) осуществляемой деятельности и код общего классификатора видов экономической деятельности (ОКЭД) (при наличии)</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Номер, дата выдачи, срок действия лицензии (если осуществляемый вид деятельности является лицензируемым)</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Адрес места нахождения филиала (представительства) в соответствии с документом, подтверждающим регистрацию (страна, почтовый индекс, населенный пункт, улица/район, номер здания)</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Номер контактного телефона</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Факс</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Адрес электронной почты</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Уровень риска&nbsp;</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13">&nbsp;</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid; " colspan="2">Дата обновления сведений</td>
<td style="width: 1.65953%; border: 1px solid; " colspan="13"><input type="text" style="border: 0px; font-size: 10px;width:100%;" value="<?php echo date("d.m.Y", strtotime($cn[0]['ZV_DATE'])); ?> г."></td>
</tr>
<tr>
<td style="width: 85.2248%;" colspan="15"><strong>Клиент (Страхователь/Заявитель) подтверждает достоверность указанной выше информации и обязуется незамедлительно предоставлять информацию об изменении данных, указанных в настоящей Заявлении - Анкете.&nbsp;&nbsp;</strong></td>
</tr>
<tr>
<td style="width: 85.2248%;" colspan="15"><strong>Своей подписью и печатью клиент подтверждает свое согласие и разрешает осуществление Компанией сбора, обработки своих предоставленных персональных данных в соответствии с требованиями действующего законодательства.&nbsp;</strong></td>
</tr>
<tr>
<td style="width: 85.2248%;" colspan="15"><strong>Клиент&nbsp; (Страхователь/Заявитель)принимает ответственность за предоставление недостоверных данных, отраженных в настоящей Анкете.&nbsp;</strong></td>
</tr>
<tr>
<td style="width: 85.2248%;" colspan="15"><strong>Клиент обязуется предоставить все необходимые документы, запрашиваемые Компанией в целях соблюдения требования законодательства РК по противодействию легализации (отмыванию) доходов, полученных преступным путем и финансированию терроризма.</strong></td>
</tr>
<tr>
<td style="width: 85.2248%;" colspan="15"><strong>Подписав данную Заявление - Анкету, клиент подтверждает, что осуществляемая им операция не связана с легализацией (отмыванием) доходов, полученных преступным путем и финансированием террористической деятельности.</strong></td>
</tr>
<tr>
<td style="width: 1.606%; border: 1px solid;" colspan="2"><strong>&nbsp;</strong><strong><strong>&nbsp;</strong></strong>
<p><strong>Подпись Страхователя/Заявителя (Ф.И.О.)</strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Мендежер/агент&nbsp; (Ответственный (работник) исполнитель Компании)</strong></p>
</td>
<td style="width: 48.8758%; border: 1px solid;" colspan="13">



<p><b>Страхователь: <?php echo $strah[0]['NAME']; ?></b></p>
<p><?php echo $strah[0]['CHIEF_DOLZH'].' '.$strah[0]['CHIEF']; ?></p>
<p>&nbsp;</p>
<p><strong>Исполнитель подтверждает, что в&nbsp; результате мониторинга&nbsp; на момент установления деловых отношений Страхователь/Заявитель:</strong></p>
<p>&nbsp;</p>
<p><strong>- не относится к перечню организаций/лиц, связанных с финансированием терроризма и экстремизма ?;</strong></p>
<p>&nbsp;</p>
<p><strong>- относится к перечню&nbsp; организаций/лиц, связанных с финансированием терроризма и экстремизма ?; &nbsp;&nbsp;</strong></p>
<p>&nbsp;</p>
<p><strong>Подпись /&nbsp; _____________/_______________________________________________________/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (ФИО/должность Исполнителя) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></p>
<p>&nbsp;</p>
<p><strong>Дата заполнения <input type="text" style="border: 0px; font-size: 10px;width:100%;" value="<?php echo date("d.m.Y", strtotime($cn[0]['ZV_DATE'])); ?> г."> года</strong></p>



</td>
</tr>
<tr>
<td style="width: 36.349%; border: 1px solid;" colspan="15">М.П. Страхователя (клиента)</td>
</tr>
<!--EndFragment--></tbody>
</table>
</div>


<div class="pagebreak">
<p style="text-align: right;">Приложение 2<br />к заявлению на заключение договора обязательного страхования<br />работника от несчастных случаев&nbsp;<br />при исполнении им трудовых (служебных) обязанностей</p>
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="text-align: center; border: solid 1px;">&nbsp;Должность</td>
<td style="text-align: center; border: solid 1px;">Численность<br />сотрудников</td>
<td style="text-align: center; border: solid 1px;">
<p>Оклад<br />в тенге</p>
</td>
<td style="text-align: center; border: solid 1px;">Средне-месячная заработная плата<br />в тенге</td>
<td style="text-align: center; border: solid 1px;">Годовой фонд оплаты труда<br />в тенге</td>
</tr>

<?php
	$s = $db->Select("select * from OSNS_PRIL2 where cnct_id = $cnct_id");
    foreach($s as $k=>$i){
        echo '<tr>
        <td style="text-align: center; border: solid 1px;">'.$i['D_NAME'].'</td>
        <td style="text-align: center; border: solid 1px;">'.$i['CNT'].'</td>
        <td style="text-align: center; border: solid 1px;">'.$i['OKLAD'].'</td>
        <td style="text-align: center; border: solid 1px;">'.$i['SMZP'].'</td>
        <td style="text-align: center; border: solid 1px;">'.$i['GFOT'].'</td>
        </tr>';
    }
    
    $s = $db->Select("select sum(o.cnt) cnt, sum(o.oklad) oklad, sum(o.smzp) smzp, sum(o.gfot) gfot from OSNS_PRIL2 o where o.cnct_id = $cnct_id");
    foreach($s as $k=>$i){
        echo '<tr>
        <td style="text-align: center; border: solid 1px;"><b>ИТОГО</b></td>
        <td style="text-align: center; border: solid 1px;">'.$i['CNT'].'</td>
        <td style="text-align: center; border: solid 1px;">'.$i['OKLAD'].'</td>
        <td style="text-align: center; border: solid 1px;">'.$i['SMZP'].'</td>
        <td style="text-align: center; border: solid 1px;">'.$i['GFOT'].'</td>
        </tr>';
    }
?>


</tbody>
</table>
<p><b>Страхователь: <?php echo $strah[0]['NAME']; ?></b></p>
<p><?php echo $strah[0]['CHIEF_DOLZH'].' '.$strah['0']['CHIEF']; ?>______________________</p>
<p>Менеджер/Агент:</p>
<p>Ф.И.О. ____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _____________<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;подпись &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;МП</p>
</div>

<div class="pagebreak">
<p style="text-align: right;">Приложение 3<br />к заявлению на заключение договора обязательного страхования<br />работника от несчастных случаев при исполнении им трудовых (служебных) обязанностей&nbsp;</p>
<p style="text-align: right;">&nbsp;</p>
<table border="0" width="100%" cellspacing="0" cellpadding="0"><!--StartFragment--> <colgroup><col span="10" width="64" /> <col width="78" /> </colgroup>
<tbody>
<tr>
<td style="text-align: center;" colspan="11" height="32"><strong>Клиенту необходимо предоставить следующие документы:</strong></td>
</tr>
<tr>
<td style="text-align: justify;" colspan="11"  height="45"><strong>1)для юридических лиц-резидентов и нерезидентов Республики Казахстан и их обособленных подразделений (филиалов и представительств):</strong></td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документ (-ы), удостоверяющий (-ие) личность должностного (-ых) лица (лиц), уполномоченного (-ых) подписывать документы юридического лица на совершение операций с деньгами и (или) иным имуществом;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документ, выданный уполномоченным органом, подтверждающим факт прохождения государственной регистрации (перерегистрации) юридического лица;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- учредительные документы и (или) выписка из реестра держателей ценных бумаг (устав, справка или свидетельство&nbsp; о государственной регистрации/перерегистрации юридического лица;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11"  height="97">- документы, удостоверяющие личность либо подтверждающие факт прохождения государственной регистрации (перерегистрации) учредителей (участников) юридического лица (за исключением документов учредителей (участников) акционерных обществ, а также хозяйственных товариществ, ведение реестра участников которых осуществляется единым регистратором), а также документы, удостоверяющие личность бенефициарных собственников юридического лица (за исключением случаев, когда бенефициарный собственник является учредителем (участником) юридического лица и выявлен на основании выписки из реестра акционеров (участников);</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">Примечание:&nbsp; бенефициарный собственник - физическое лицо, которому прямо или косвенно принадлежат более двадцати пяти процентов долей участия в уставном капитале либо размещенных (за вычетом привилегированных и выкупленных обществом) акций клиента - юридического лица, а равно физическое лицо, осуществляющее контроль над клиентом иным образом, либо в интересах которого клиентом совершаются операции с деньгами и (или) иным имуществом;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документы, подтверждающие полномочия должностного (-ых) лица (лиц) лиц, на совершение действий от имени клиента без доверенности, в том числе на подписание документов юридического лица на совершение операций с деньгами и (или) иным имуществом;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11"><strong>2)для филиалов и представительств общественных и религиозных объединений:</strong></td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документы, подтверждающие полномочия руководителя филиала или представительства общественного или религиозного объединения, избранного (назначенного) в порядке, предусмотренном уставом общественного или религиозного объединения и положением о его филиале или представительстве;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- для филиалов и представительств иных форм юридических лиц - доверенность, выданная юридическим лицом-резидентом Республики Казахстан руководителю филиала или представительства;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документ, удостоверяющий адрес места нахождения юридического лица;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- разрешение (в случае если деятельность клиента осуществляется посредством лицензирования или разрешительной процедуры в соответствии с Законом Республики Казахстан &laquo;О разрешениях и уведомлениях&raquo;);</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11"><strong>3) если от имени клиента действует его представитель (за исключением должностных лиц юридического лица):</strong></td>
</tr>
<tr style="text-align: justify;">
<td colspan="11"><strong>для представителей клиента - резидентов Республики Казахстан:</strong></td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">&nbsp;- документ, удостоверяющий личность;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документы, подтверждающие полномочия представителя клиента на совершение операций с деньгами и (или) иным имуществом от имени клиента, в том числе на подписание документов клиент</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">для представителей клиента - нерезидентов Республики Казахстан:</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11"">- документ, удостоверяющий личность;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документы, подтверждающие полномочия представителя клиента на совершение операций с деньгами и (или) иным имуществом от имени клиента, в том числе на подписание документов клиента;</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документ, удостоверяющий регистрацию в уполномоченных органах Республики Казахстан на право въезда, выезда и пребывания физического лица - нерезидента на территории Республики Казахстан, если иное не предусмотрено международными договорами, ратифицированными Республикой Казахстан.</td>
</tr>
<tr style="text-align: justify;">
<td colspan="11"><strong>4) для физических лиц-резидентов Республики Казахстан, осуществляющих индивидуальную предпринимательскую деятельность:</strong></td>
</tr>
<tr style="text-align: justify;">
<td colspan="11">- документ, удостоверяющий личность;</td>
</tr>
<tr>
<td style="text-align: justify;" colspan="11">- документ, выданный уполномоченным органом, подтверждающий факт прохождения государственной регистрации;</td>
</tr>
<!--EndFragment--></tbody>
</table>
</div>



<div class="pagebreak rotator"><p style="text-align: right;">Приложение 1<br />к заявлению на заключение договора обязательного страхования<br />работника от несчастных случаев<br />при исполнении им трудовых (служебных) обязанностей</p>
<table style="border: solid 1px; font-size: 10px; border-collapse: collapse;" border="0" width="100%" cellspacing="0" cellpadding="0"><!--StartFragment--> <colgroup><col width="21" /> <col width="27" /> <col span="2" width="21" /> <col width="50" /> <col width="27" /> <col width="21" /> <col width="47" /> <col width="30" /> <col width="21" /> <col width="25" /> <col width="30" /> <col width="27" /> <col width="30" /> <col width="45" /> <col span="2" width="29" /> <col width="47" /> <col width="27" /> <col width="25" /> <col width="30" /> <col width="29" /> <col width="27" /> <col width="28" /> <col width="43" /> <col span="2" width="31" /> <col width="48" /> <col width="33" /> <col width="30" /> <col width="26" /> <col width="34" /> <col width="30" /> <col width="22" /> <col width="42" /> <col width="30" /> <col width="37" /> <col width="50" /> <col width="27" /> <col width="33" /> <col width="31" /> <col width="24" /> <col width="29" /> <col width="30" /> <col width="45" /> <col width="34" /> <col width="29" /> <col width="48" /> <col width="28" /> <col width="32" /> </colgroup>
<tbody>
<tr>
<td style="text-align: center; border: solid 1px;" colspan="50" width="1591">Информация о произошедших несчастных случаях на производстве по причинам</td>
</tr>
<tr style="">
<td style="text-align: center; border: solid 1px;" colspan="10" width="286">в 20__ году</td>
<td style="text-align: center; border: solid 1px;" colspan="10" width="314">в 20__ году</td>
<td style="text-align: center; border: solid 1px;" colspan="10" width="330">в 20__ году</td>
<td style="text-align: center; border: solid 1px;" colspan="10" width="331">в 20__ году</td>
<td style="text-align: center; border: solid 1px;" colspan="10" width="330">в 20__ году</td>
</tr>
<tr>
<td style="text-align: center; border: solid 1px;" rowspan="3" width="21">О</td>
<td style="text-align: center; border: solid 1px;" colspan="3" width="69">из них</td>
<td style="text-align: center; border: solid 1px;" colspan="6" width="196">Из них установлена УПТ</td>
<td style="text-align: center; border: solid 1px;" rowspan="3" width="25">О</td>
<td style="text-align: center; border: solid 1px;" colspan="3" width="87">из них</td>
<td style="text-align: center; border: solid 1px;" colspan="6" width="202">Из них установлена УПТ</td>
<td style="text-align: center; border: solid 1px;" rowspan="3" width="30">О</td>
<td style="text-align: center; border: solid 1px;" colspan="3" width="84">из них</td>
<td style="text-align: center; border: solid 1px;" colspan="6" width="216">Из них установлена УПТ</td>
<td style="text-align: center; border: solid 1px;" rowspan="3" width="26">О</td>
<td style="text-align: center; border: solid 1px;" colspan="3" width="86">из них</td>
<td style="text-align: center; border: solid 1px;" colspan="6" width="219">Из них установлена УПТ</td>
<td style="text-align: center; border: solid 1px;" rowspan="3" width="31">О</td>
<td style="text-align: center; border: solid 1px;" colspan="3" width="83">из них</td>
<td style="text-align: center; border: solid 1px;" colspan="6" width="216">Из них установлена УПТ</td>
</tr>
<tr>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="27">ТУ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="21">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="21">См</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="50">Со сроком</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="48">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="47">До пенсион-ного возраста/бес-срочно</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="51">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="30">ТУ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="27">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="30">См</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="45">Со сроком</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="58">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="47">До пенсион-ного возраста/бес-срочно</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="52">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="29">ТУ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="27">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="28">См</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="43">Со сроком</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="62">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="48">До пенсион-ного возраста/бес-срочно</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="63">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="34">ТУ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="30">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="22">См</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="42">Со сроком</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="67">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="50">До пенсион-ного возраста/бес-срочно</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="60">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="24">ТУ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="29">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="30">См</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="45">Со сроком</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="63">из них</td>
<td style=" text-align: center; border: solid 1px;" rowspan="2" width="48">До пенсионного возраста/бес-срочно</td>
<td style=" text-align: center; border: solid 1px;" colspan="2" width="60">из них</td>
</tr>
<tr>
<td style=" text-align: center; border: solid 1px;" width="27">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="21">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="30">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="21">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="29">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="29">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="27">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="25">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="31">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="31">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="33">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="30">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="30">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="37">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="27">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="33">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="34">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="29">ПЗ</td>
<td style=" text-align: center; border: solid 1px;" width="28">ТУ</td>
<td style=" text-align: center; border: solid 1px;" width="32">ПЗ</td>
</tr>
<tr>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="43">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="26">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="22">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="42">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="37">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="24">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="32">&nbsp;</td>
</tr>
<tr>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="43">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="26">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="22">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="42">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="37">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="24">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="32">&nbsp;</td>
</tr>
<tr>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="43">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="26">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="22">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="42">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="37">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="24">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="32">&nbsp;</td>
</tr>
<tr>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="43">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="26">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="22">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="42">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="37">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="24">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="32">&nbsp;</td>
</tr>
<tr>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="21">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="47">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="25">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="43">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="26">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="22">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="42">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="37">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="50">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="27">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="33">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="31">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="24">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="30">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="45">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="34">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="29">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="48">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="28">&nbsp;</td>
<td style=" text-align: center; border: solid 1px;" width="32">&nbsp;</td>
</tr>
<!--EndFragment--></tbody>
</table>
<p>*где О &ndash; общая численность пострадавших работников, УПТ &ndash; утрата профессиональной трудоспособности (с 30 процентов и выше), См &ndash; смертность, ТУ - трудовое увечье, ПЗ - профессиональное заболевание</p>
<p>* необходимо указать информацию за последние 5 лет, предшествующие дате заключения настоящего договора</p>
<p>&nbsp;</p>
<p><b>Страхователь: <?PHP ECHO $strah['0']['NAME']; ?></b></p>
<p><?php echo $strah[0]['CHIEF_DOLZH'].' '.$strah['0']['CHIEF']; ?>______________________</p>
<p>Менеджер/Агент: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;М.П.</p>
<p>Ф.И.О. ____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ____________________________</p></div>
<?php 
exit;
?>
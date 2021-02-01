<?php 
header('Content-Type: text/html; charset=utf-8');
?>
<style>        
    @media print {
        .new_page { float: none !important; }
        .pagebreak { 
            display: block;
            break-before: always;
            page-break-before: always;
        }
    }
    body{
        font-size: 14px;
    }
</style>
      
      
      <div class="pagebreak"></div>
      <div>
         <div style="text-align: center; font-weight: bold;">
            ДОГОВОР ФАКУЛЬТАТИВНОГО ПЕРЕСТРАХОВАНИЯ РАБОТНИКА ОТ НЕСЧАСТНЫХ СЛУЧАЕВ<br>
            ПРИ ИСПОЛНЕНИИ ИМ ТРУДОВЫХ (СЛУЖЕБНЫХ) ОБЯЗАННОСТЕЙ<br>
            № <span class="meta" data-table="7" data-col="239" contenteditable="false"><?php echo $dan['B1']['CONTRACT_NUM']; ?></span>
            от <span class="meta" data-table="7" data-col="240" contenteditable="false"><?php ECHO $dan['B1']['CONTRACT_DATE']; ?></span> г.<br>
         </div>
         <p><b>г. Алматы&nbsp;&nbsp; <br></b></p>
      </div>
      <div style="width: 100%;"></div>
      <div>
         <p><b><span>АО «Страховая Компания «Евразия»</span></b><span> далее именуемое «Перестраховщик», в лице <?php echo $dan['podpis']['reins']['FIO']; ?>, действующего на основании <?php echo $dan['podpis']['reins']['OSNOV_TYPE'].' № '.$dan['podpis']['reins']['OSNOV_NUM'].' от '.$dan['podpis']['reins']['OSNOV_DATE']; ?> г., с одной стороны и</span></p>
         <span>
         </span>
         <p><b><span>АО «Компания по страхованию жизни «Государственная аннуитетная компания»</span></b>
         <span>, далее именуемое «Перестрахователь» или «Страховщик», в лице <?php echo $dan['podpis']['gak']['FIO']; ?>, 
         действующего на основании <?php echo $dan['podpis']['gak']['OSNOV_TYPE'].' № '.$dan['podpis']['gak']['OSNOV_NUM'].' от '.$dan['podpis']['gak']['OSNOV_DATE']; ?>  г., с другой стороны, заключили настоящий договор факультативного перестрахования (далее – Договор) о нижеследующем:</span></p>
      </div>
      <div style="width: 100%;"></div>
      <div >
         <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tbody>
               <tr>
                  <td style="width: 30%;">САҚТАНДЫРУ ТҮРІ / ВИД СТРАХОВАНИЯ:</td>
                  <td>Обязательное страхование работника от несчастных случаев при исполнении им трудовых (служебных) обязанностей</td>
               </tr>
               <tr>
                  <td>ҚАЙТА САҚТАНДЫРУ ҮЛГІСІ/ ТИП ПЕРЕСТРАХОВАНИЯ</td>
                  <td>Пропорциональный</td>
               </tr>
               <tr>
                  <td>САҚТАНУШЫ / СТРАХОВАТЕЛЬ:</td>
                  <td>
                     <p><span class="meta" data-table="4" data-col="192" contenteditable="false"><?php echo $dan['contracts']['NAME']; ?></span><br />
                     Адрес: <span class="meta active" data-table="4" data-col="195" contenteditable="false"><?php echo $dan['contracts']['ADDRESS']; ?></span><br />
                     Вид деятельности: <?php echo $dan['contracts']['OKEDNAME']; ?><br>
                     Класс риска: <span class="meta" data-table="9" data-col="262" contenteditable="false"><?php echo $dan['contracts']['RISK_ID']; ?></span><br />                     
                     БИН <span class="meta" data-table="4" data-col="204" contenteditable="false"><?php echo $dan['contracts']['BIN']; ?></span> &nbsp;<br>
                     Банковские реквизиты: <?php echo $dan['contracts']['BANKNAME']; ?><br />
                     ИИК: <?php echo $dan['contracts']['P_ACCOUNT']; ?>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>САҚТАНДЫРУ ОБЪЕКТІСІ</p>
                     <p>ОБЪЕКТ СТРАХОВАНИЯ :</p>
                  </td>
                  <td>
                     <p>Имущественный интерес работника, жизни и здоровью которого причинен вред в результате несчастного случая, приведшего к установлению ему степени утраты профессиональной трудоспособности либо его смерти.</p>
                     <p>Количество работников Страхователя – <?php echo $dan['contracts']['CNT_PEOPLE']; ?> человек (согласно приложению №1 к настоящему Договору).</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>ҚАЙТА САҚТАНУШЫ/</p>
                     <p>ПЕРЕСТРАХОВАТЕЛЬ:</p>
                  </td>
                  <td>
                     <p>АО «Компания по страхованию жизни «Государственная аннуитетная компания»</p>
                     <p>БИН 050640002859</p>
                  </td>
               </tr>
               <tr>
                  <td>ҚАЙТА САҚТАНДЫРУШЫ/ ПЕРЕСТРАХОВЩИК:</td>
                  <td>
                     <p>АО «Страховая компания «Евразия»</p>
                     <p>БИН: 950540000024</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>ҚАЙТА САҚТАНДЫРУ ШАРТЫНЫҢ ӘРЕКЕТ ЕТУІ/</p>
                     <p>ДЕЙСТВИЕ ДОГОВОРА ПЕРЕСТРАХОВАНИЯ</p>
                  </td>
                  <td>с <span class="meta" data-table="1" data-col="14" contenteditable="false"><?php echo $dan['contracts']['DATE_BEGIN']; ?></span> по <span class="meta" data-table="1" data-col="15" contenteditable="false"><?php echo $dan['contracts']['DATE_END']; ?></span> г.
                  </td>
               </tr>               
               <tr>
                  <td>
                     <p>САҚТАНДЫРУ ЖАҒДАЙЫ/</p>
                     <p>СТРАХОВОЙ СЛУЧАЙ:</p>
                  </td>
                  <td>Несчастный случай при исполнении трудовых (служебных) обязанностей (несчастный случай), произошедший с 
                  работником (работниками) при исполнении им (ими) трудовых (служебных) обязанностей в результате воздействия вредного и 
                  (или) опасного производственного фактора, вследствие которого произошли производственная травма, 
                  внезапное ухудшение здоровья или отравление работника, приведшие его к установлению ему степени 
                  утраты профессиональной трудоспособности, профессиональному заболеванию либо смерти, при обстоятельствах, 
                  предусмотренных пунктом 2 статьи 2&nbsp; оригинального Договора страхования.
                  <br />
                  <br />
                  <br />
                  </td>
               </tr>
               </table>
               <div class="pagebreak"></div>
               <table width="100%" border="1" cellspacing="0" cellpadding="0">
               <tr>
                  <td  style="width: 30%;">
                     <p>ҚАЙТА САҚТАНДЫРУ ШАРТЫ /</p>
                     <p>УСЛОВИЯ ПЕРЕСТРАХОВАНИЯ:</p>
                  </td>
                  <td>
                     Перестраховщик принимает в перестрахование на всех условиях Договора страхования работника от несчастных случаев при исполнении им трудовых (служебных) обязанностей № <span class="meta" data-table="1" data-col="2" contenteditable="false"><?php echo $dan['contracts']['CONTRACT_NUM']; ?></span> 
                     от <span class="meta" data-table="1" data-col="3" contenteditable="false"><?php echo $dan['contracts']['CONTRACT_DATE']; ?></span> г., заключенного между <span class="meta" data-table="4" data-col="192" contenteditable="false"><?php echo $dan['contracts']['NAME']; ?></span> и АО «Компания по страхованию жизни «Государственная аннуитетная компания»
                  </td>
               </tr>
               <tr>
                  <td>БІРЕГЕЙ САҚТАНДЫРУ ШАРТЫ / ОРИГИНАЛЬНЫЙ ДОГОВОР СТРАХОВАНИЯ</td>
                  <td>Договор страхования работника от несчастных случаев при исполнении им трудовых (служебных) обязанностей 
                  №<span class="meta" data-table="1" data-col="2" contenteditable="false"><?php echo $dan['contracts']['CONTRACT_NUM']; ?></span> 
                  от <span class="meta" data-table="1" data-col="3" contenteditable="false"><?php echo $dan['contracts']['CONTRACT_DATE']; ?></span> г., 
                  заключенного между <?php echo $dan['contracts']['NAME']; ?> и АО «Компания по страхованию жизни «Государственная аннуитетная компания»
                  </td>
               </tr>
               <tr>
                  <td>САҚТАНДЫРУ АУМАҒЫ / ТЕРРИТОРИЯ СТРАХОВАНИЯ:</td>
                  <td>Территория организации (работодателя) или иное место работы во время командировки либо  другое иное место, нахождение в котором было обусловлено выполнением трудовых или иных обязанностей, связанных с поручением работодателя или должностного лица организации, а также иная территория, указанная в пункте 2 статьи 186 Трудового кодекса Республики Казахстан.
                  </td>
               </tr>
               <tr>
                  <td>САҚТАНДЫРУ/ ҚАЙТА САҚТАНДЫРУ КЕЗЕҢІ /ПЕРИОД СТРАХОВАНИЯ/ ПЕРЕСТРАХОВАНИЯ:</td>
                  <td> с <span class="meta" data-table="1" data-col="14" contenteditable="false"><?php echo $dan['contracts']['DATE_BEGIN']; ?></span> г. 
                  по <span class="meta" data-table="1" data-col="15" contenteditable="false"><?php echo $dan['contracts']['DATE_END']; ?></span> г.
                  </td>
               </tr>
               <tr>
                  <td>САҚТАНДЫРУ СОМАСЫ / ОБЩАЯ СТРАХОВАЯ СУММА:</td>
                  <td><span class="meta" data-table="1" data-col="7" contenteditable="false"><?php echo $dan['contracts']['PAY_SUM_V_TEXT']; ?></span> 
                  </td>
               </tr>
               <tr>
                  <td>ҚАЙТА САҚТАНУШЫНЫҢ ӨЗІНДІК ҰСТАП ҚАЛУЫ/ СОБСТВЕННОЕ УДЕРЖАНИЕ:</td>
                  <td>
                     <span class="meta" data-table="12" data-col="304" contenteditable="false"><?php echo $dan['contracts']['PERC_S_GAK']; ?></span>&nbsp;% или
                     <span class="meta" data-table="12" data-col="308" contenteditable="false"><?php echo $dan['contracts']['SUM_S_GAK']; ?></span>
                  </td>
               </tr>
               <tr>
                  <td>ҚАЙТА САҚТАНДЫРУШЫНЫҢ ЖАУАПКЕРШІЛІК КӨЛЕМІ / ОБЪЕМ ОТВЕТСТВЕННОСТИ ПЕРЕСТРАХОВЩИКА:</td>
                  <td>
                     <span class="meta" data-table="12" data-col="302" contenteditable="false"><?php echo $dan['contracts']['PERC_S_STRAH']; ?></span> % 
                     или <span class="meta" data-table="12" data-col="306" contenteditable="false"><?php echo $dan['contracts']['SUM_S_STRAH']; ?></span>
                  </td>
               </tr>
               <tr>
                  <td>ҚАЙТА САҚТАНДЫРУШЫ ТӨЛЕМІ / ПРЕМИЯ ПЕРЕСТРАХОВЩИКА:</td>
                  <td><span class="meta" data-table="12" data-col="307" contenteditable="false"><?php echo $dan['contracts']['SUM_P_STRAH']; ?></span></td>
               </tr>
               <tr>
                  <td>ТӨЛЕМ ТӘРТІБІ / ПОРЯДОК ОПЛАТЫ ПЕРЕСТРАХОВОЧНОЙ ПРЕМИИ:</td>
                  <td>
                  <br />
                  <?php                     
                    if(count($dan['transh']) > 0){
                        $i = 1;
                        foreach($dan['transh'] as $k=>$v){
                            echo $i.' страховой взнос – '.$v['PAY_SUM'].' тенге до '.$v['OPL_DO'].' г.<br />';
                            $i++;
                        }
                    }else{                                            
                  ?>
                  Перестраховочная премия подлежит уплате единовременно до <span class="meta" data-table="7" data-col="316" contenteditable="false"><?php echo $dan['B1']['OPL_DO']; ?></span> г.
                  <?php } ?>
                  <br />
                  </td>
               </tr>
               <tr style="mso-yfti-irow:17;height:17.5pt">
                  <td>ҚОСЫМША  САҚТАНДЫРУҒА ҚАТЫСТЫ ШАРТТАР/ ҚАЙТА САҚТАНДЫРУ ТӨЛЕМІ/ ДОПОЛНИТЕЛЬНЫЕ УСЛОВИЯ ОТНОСИТЕЛЬНО СТРАХОВОЙ/ ПЕРЕСТРАХОВОЧНОЙ ВЫПЛАТЫ:</td>
                  <td>
                     <p>Перестрахователь самостоятельно рассматривает претензии по договору страхования и самостоятельно принимает решение об оплате убытка по наступившим страховым случаям, страховая выплата по которым не превышает 5 (пять) миллионов тенге, планируемого к выплате по данному страховому случаю. Каждое такое решение является обязательным для осуществления Перестраховщиком перестраховочной выплаты после получения соответствующего пакета документов, предусмотренных пунктом 19 ст. 4 оригинального Договора страхования и расчета размеров ущерба. Перестрахователь обязуется принимать решения об оплате или отклонении убытков со всей тщательностью и осторожностью так, как если бы он не имел перестраховочной защиты.</p>
                     <p>В случае, если размер страховой выплаты по одному страховому случаю превышает 5 (пять) миллионов тенге, Перестрахователь принимает решение о возмещении убытка по согласованию с Перестраховщиком. 
                    <br />
                  </td>
               </tr>
               </table>
               
               <div class="pagebreak"></div>
               
               <table  width="100%" border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width: 30%;"></td>
                    <td>
                     Перестраховщик обязан письменно сообщить посредством электронной почты о своем решении в течение 2 (двух) рабочих дней со дня получения полного пакета документов, предусмотренных пунктом 19 ст. 4 оригинального Договора страхования и расчета размеров ущерба. В случае отсутствия письменного сообщения Перестраховщика в указанный срок решение Перестрахователя является обязательным для Перестраховщика.</p>
                     <p>При осуществлении Перестрахователем страховых выплат по страховым случаям, предусматривающим осуществление страховой выплаты единовременного характера, Перестраховщиком подлежит возмещению фактически оплаченная Перестрахователем сумма страховой выплаты в размере, пропорциональном принятым обязательствам.</p>
                     <p>При осуществлении Перестрахователем выплат по договору аннуитета возмещению Перестраховщиком подлежит в размере, пропорциональном принятым обязательствам  текущая стоимость будущих аннуитетных выплат (размер страховой премии по договору аннуитета), рассчитанная Перестрахователем.</p>
                     <p>Кроме документов предусмотренных пунктом 19 ст. 4 оригинального Договора страхования и расчета размера ущерба, Перестрахователь обязан после осуществления страховой выплаты  предоставить Перестраховщику:</p>
                     <p>1)копии документов, подтверждающих предстоящие убытки Перестрахователя (Договор аннуитета, включая дополнительные соглашения к нему);</p>
                     <p>2) копию платежного документа, подтверждающего факт осуществления страховой выплаты Перестрахователем Выгодоприобретателю по оригинальному договору страхования, за исключением выплат по Договору аннуитета.</p>
                     <p>Размер расчета убытка в случае заключения Договора аннуитета осуществляется в соответствии с законодательством Республики Казахстан.</p>
                     <br />
                  </td>
               </tr>
               <tr>
                  <td>САКТАНДЫРУДЫН КОСЫМША ТАЛАПТАРЫ / ДОПОЛНИТЕЛЬНЫЕ УСЛОВИЯ ПЕРЕСТРАХОВАНИЯ:</td>
                  <td>
                     <p>1)    При наступлении страхового случая, по которому страховая выплата не превышает 5 (пять) миллионов тенге, Перестраховщик обязуется осуществить свою долю в страховой выплате Перестрахователю в течение 5 (пяти) рабочих дней после получения от Перестрахователя документов, подтверждающих перечисление страховой выплаты Страхователю, а также заключение договора аннуитета со Страхователем, с учетом пункта «Дополнительные условия относительно страховой/перестраховочной выплаты».</p>
                     <p>2)    При наступлении страхового случая, по которому размер страховой выплаты по одному страховому случаю превышает 5 (пять) миллионов тенге, Перестраховщик обязуется осуществить свою долю в страховой выплате Перестрахователю в течение 5 (пяти)  рабочих  дней после получения от Перестрахователя документов, подтверждающих перечисление страховой выплаты Страхователю, а также заключение договора аннуитета со Страхователем, с учетом пункта «Дополнительные условия относительно страховой/перестраховочной выплаты».</p>
                    <br />
                  </td>
               </tr>
            </table>
            <div class="pagebreak"></div>
            <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 30%;" ></td>
                <td>
                     <p>3) Перестраховщик пропорционально своей доле ответственности компенсирует Перестрахователю все расходы, понесенные Перестрахователем в результате расследования и определения размера убытка, включая расходы на судебные издержки, связанные с производством по делу, кроме расходов на заработную плату и командировочных расходов сотрудников Перестрахователя. Если отказ Перестрахователя в осуществлении страховой выплаты, согласованный надлежащим образом с Перестраховщиком в соответствии с требованиями настоящего Договора, будет признан в последующем неправомерным на основании вступившего в силу судебного решения, Перестраховщик обязуется возместить пропорционально его доли ответственности все судебные расходы и иные издержки Перестрахователя, связанные с соответствующей страховой выплатой (пени, штрафы, государственные пошлины, услуги представителей и т.п.)</p>
                     <p>4)  Перестраховщик в случаях непредставления Перестрахователем всех документов, необходимых для принятия решения об осуществлении страховой выплаты, обязан письменно уведомить их о недостающих документах в течение 3 (трех) рабочих дней.</p>
                     <p>5) Несвоевременное уведомление о наступлении страхового случая не освобождает Перестраховщика от обязанности в осуществлении перестраховочной выплаты пропорционально доле принятого риска по Договору.</p>
                     <p>6) Перестрахователь уведомляет Перестраховщика о наступлении события, которое носит признаки страхового  случая по Договору, в течение 5 (пяти) рабочих дней с момента получения информации о его наступлении.</p>
                     <p>7) Перестраховщик следует судьбе Перестрахователя по всем принятым Перестрахователем решениям,  также вступившим в законную силу решениям суда в осуществлении страховой выплаты либо в ее отказе по оригинальному договору страхования, а также в случае принятия законодательством РК  изменения размера периодических выплат или сроков их осуществления, либо по решению уполномоченного органа РК с учетом пункта «Дополнительные условия относительно страховой/перестраховочной выплаты».</p>
                     <p>8)Все изменения и дополнения к Договору вносятся по согласованию обеих Сторон, оформляются в письменном виде в двух экземплярах, имеющих равную юридическую силу, и рассматриваются в качестве неотъемлемых частей настоящего Договора.</p>
                     <p>9) При досрочном прекращении Договора по обстоятельствам, предусмотренным пунктом 1 статьи 841 Гражданского Кодекса Республики Казахстан, Перестраховщик имеет право на часть перестраховочной премии пропорционально времени, в течение которого действовало перестрахование.</p>
                     <p>10) Если отказ Страхователя от Договора не связан с обстоятельствами, указанными в пункте 1 статьи 841 Гражданского Кодекса Республики Казахстан, уплаченная Перестраховщику перестраховочная премия не подлежит возврату.</p>
                    <br /><br /><br />
                </td>
               </tr>
            </table>
            <div class="pagebreak"></div>
            <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 30%;" ></td>
                <td>
                     <p>11) В случае дальнейшего перестрахования (ретроцессии) Перестраховщиком части ответственности, Перестраховщик совместно с Перестрахователем участвуют в урегулировании убытков по принятой  доли ответственности ретроцессионерами.</p>                  
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div style="width: 100%;margin-top: 15px;">
          <div style="width: 49%; float: left;">
             <div style="font-weight: bold; text-align: center;">ҚАЙТА САҚТАНДЫРУШЫ / <br />ПЕРЕСТРАХОВЩИК:</div>
             <div style="text-align: center;">АО «Страховая компания «Евразия»</div>
             <br><br />
             Адрес: Республика Казахстан, 050004, г. Алматы,<br>
             ул. Желтоксан, 59.<br>
             РНН 600 900 079 784<br>
             БИН 950540000024<br>
             В валюте KZT: IBAN: KZ4094806KZT22030005<br>
             Филиал № 6 АО «Евразийский банк»<br>
             г. Алматы<br>
             BIC/SWIFT: EURIKZKA<br>
             КБЕ 15<br><br>
             <div style="font-weight: bold;"><?php echo $dan['podpis']['reins']['DOLGNOST']; ?><br><br>
                ________________ / <?php echo $dan['podpis']['reins']['FIO_RUK']; ?>/ 
             </div>
             <div style="font-weight: bold; margin-left: 30px;">м.п.</div>
          </div>
          <div style="width: 49%; float: right;">
             <div style="font-weight: bold; text-align: center;">ҚАЙТА САҚТАНУШЫ / <br />ПЕРЕСТРАХОВАТЕЛЬ:</div>
             <div style="text-align: center;">АО «Компания по страхованию жизни «Государственная аннуитетная компания»</div>
             <br>
             Адрес: г. Астана,ул. Иманова, 11<br>
             БИН 050640002859<br>
             ИИК: KZ506010111000044734<br>
             в АО «Народный Банк Казахстана»<br>
             БИК: HSBKKZKX<br>
             Признак резидентства-1<br>
             Код сектора экономики-5<br>
             Тел. 8 (7172) 916-333<br>
             КБЕ 15<br><br>
             <div style="font-weight: bold;"><?php echo $dan['podpis']['gak']['DOLGNOST']; ?><br><br>
                ________________ / <?php echo $dan['podpis']['gak']['FIO_RUK']; ?>/ 
             </div>
             <div style="font-weight: bold; margin-left: 30px;">м.п.</div>
          </div>
      </div>
      
      <div class="pagebreak"></div>
      <div class="new_page"></div>      
      <div >         
         <div style="text-align: right; font-weight: bold;">
            Приложение № 1<br>
            к Договору факультативного перестрахования работника<br>
            от несчастных случаев при исполнении им трудовых (служебных) обязанностей<br>
            № <span class="meta" contenteditable="false" data-table="7" data-col="239"><?php echo $dan['B1']['CONTRACT_NUM']; ?></span><br>
            от <span class="meta" contenteditable="false" data-table="7" data-col="240"><?php echo $dan['B1']['CONTRACT_DATE']; ?></span>
         </div>
      </div>
      <div style="width: 100%;"></div>
      <div >
         <div style="text-align: center; width: 100%;border-bottom: solid 1px;"><span class="meta" data-table="4" data-col="192" contenteditable="false"><?php echo $dan['contracts']['NAME']; ?></span></div>
         <div style="text-align: center; width: 100%;font-style: italic;font-size: 10px;">(наименование страхователя)</div>
         <br><br>
         <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tbody>
               <tr>
                  <td>№ п/п</td>
                  <td>Наименование</td>
                  <td>Количество работников, чел</td>
                  <td>Страховая сумма, тенге</td>
                  <td>Страховой тариф</td>
                  <td>Страховая премия, тенге</td>                  
               </tr>
               <tr>
                  <td>1</td>
                  <td><span class="meta" data-table="4" data-col="192" contenteditable="false"><?php echo $dan['contracts']['NAME']; ?></span></td>
                  <td><span class="meta" data-table="10" data-col="273" contenteditable="false"><?php echo $dan['contracts']['CNT_PEOPLE']; ?></span></td>
                  <td><span class="meta" data-table="1" data-col="7" contenteditable="false"><?php echo $dan['contracts']['PAY_SUM_V']; ?></span></td>
                  <td><span class="meta" data-table="10" data-col="276" contenteditable="false"><?php if($dan['contracts']['TARIF'] < 1){echo '0';} echo $dan['contracts']['TARIF']; ?> %</span><br></td>
                  <td><span class="meta" data-table="12" data-col="307" contenteditable="false"><?php echo $dan['contracts']['PAY_SUM_P']; ?></span> &nbsp; &nbsp;</td>                  
               </tr>
               <tr>
                  <td></td>
                  <td>ИТОГО:</td>
                  <td><br></td>
                  <td><br></td>
                  <td><br></td>
                  <td></td>
               </tr>
            </tbody>
         </table>
         <br><br>
         <div style="float: left; width: 45%;">
            Перестраховщик___________________________<br>
            <div style="text-aligh: right;">м.п.</div>
         </div>
         <div style="float: right; width: 45%;text-align: right;">Перестрахователь_________________________<br>
            <span style="margin-right: 30px;">м.п.</span>
         </div>
      </div>      
      

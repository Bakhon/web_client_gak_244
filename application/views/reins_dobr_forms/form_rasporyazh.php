<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">	
	<title>Печать распоряжения</title>
</head>

<body>

<link href="styles/css/bootstrap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12" style="text-align: right;" contenteditable>
        ДБУ и ФО к оплате<br />
        
         <!-- 
        и.о. Председателя Правления АО «КСЖ «ГАК»<br /><br />
        _________ Маканова А.К.<br /><br /> 
        --> 
     
        Председатель Правления АО «КСЖ «ГАК»<br /><br />
        _________ Амерходжаев Г.Т.<br /><br />
      
        
        <!--_________ Касимова Д.М.<br /><br />-->        
        «____» ___________20____г.<br />
    </div>
    
    <div class="col-lg-12">
        <hr />
    </div>
    
    <div class="col-lg-12">
        <center><h4><strong>РАСПОРЯЖЕНИЕ СП № <?php echo $dan['NUM_RASP']; ?> от <?php echo $dan['DATE_RASP']; ?> г.</strong></h4></center>
    </div>
    
    <div class="col-lg-12">
        <hr />
    </div>
    
    <div class="col-lg-12">
        <table class="table table-no-bordered">
            <tr>
                <td>КОМУ:</td>
                <td><strong>ДЕПАРТАМЕНТУ БУХГАЛТЕРСКОГО УЧЕТА И ФИНАНСОВОЙ ОТЧЕТНОСТИ</strong></td>
            </tr>
            <tr>
                <td>ОТ:</td>
                <td><strong>СЛУЖБЫ ПЕРЕСТРАХОВАНИЯ</strong></td>
            </tr>
            <tr>
                <td>ТЕМА:</td>
                <td><strong>ОПЛАТА ПЕРЕСТРАХОВОЧНОЙ ПРЕМИИ</strong></td>
            </tr>            
        </table>  
        <hr />  
        <div style="text-indent: 30px;">      
        Осуществить оплату перестраховочной 
        премии перестраховщику <strong><?php echo $dan['NAME_REINS']; ?></strong>  по договору <?php if($dan['TYP'] == 3){echo '(Уведомлению)';} ?>
        <strong>№ <?php echo $dan['CONTRACT_NUM']; ?> от <?php echo $dan['CONTRACT_DATE']; ?>г.</strong> в размере 
        <?php echo '<strong>'.NumberRas($dan['PAY_SUM_OPL1']).'</strong> '.$dan['PAY_SUM_OPL_TEXT']; ?><br /><br />
        </div>
        <!-- 
        Оплату осуществить на банковский счет __________в АО «____________банк» 
        согласно приложению № 1 к распоряжению.<br /><br />   
        -->
 
        <!-- Основание для осуществления оплаты перестраховочной премии: _______________________________________________________.<br /><br />--> 
        
        Приложение на____ листе(ах). <br /><br />
        <div contenteditable>
            
        <!--
            Председатель Правления:<br />
            Амерходжаев Г.Т. _____________________________<br /><br />
        -->    
            
          <!-- 
            Заместитель председателя Правления: <br /> 
            Акажанов А.А. _____________________________<br /><br />            
      --> 
            
            
            <!--
            Управляющий директор: <br /> 
            Акажанов А.А. _____________________________<br /><br />
            -->
            
         
            Руководитель Службы перестрахования:<br />
            Шамшуалеева А.Б. _____________________________<br /><br />
          
           
           <!--
            Исполнитель:<br />
            Шамшуалеева А.Б. _____________________________<br /><br />
           --> 
        
            Исполнитель:<br />
            Абдыгалиева Л.А. _____________________________<br /><br />
           
            
        </div>
        <br />        
    </div>
    
    <div style="position: fixed; bottom: 0px; width: 100%;left: 0px;">
        Передано в ДБУ и ФО: _____________________ «____» _____20_____ года в ____ ____ часов.<br /> 
        (Ф.И.О. сотрудника СП, передающего распоряжение)<br /><br />
        
        Принято от СП: _____________________ «____» _____20_____ года в ____ ____ часов.<br />
        (Ф.И.О. сотрудника ДБУ и ФО, принявшего распоряжение)<br /><br />
    </div>
      
</div>


<style>
.table-no-bordered>tbody>tr>td,.table-no-bordered>tbody>tr>th,.table-no-bordered>tfoot>tr>td,.table-no-bordered>tfoot>tr>th,.table-no-bordered>thead>tr>td,.table-no-bordered>thead>tr>th {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 0px solid;
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
}

body{
    font-size: 14px;
}
</style>
</body>
</html>
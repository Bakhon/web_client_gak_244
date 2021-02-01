<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">	
	<title>Печать акта выполненных работ</title>
</head>

<body>

<div contenteditable="true">
<p align="center"><b>АО &laquo;Компания по страхованию жизни </b></p>
<p align="center"><b>&laquo;Государственная аннуитетная компания&raquo;</b></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><b>АКТ</b></p>
<p align="center"><b>ввода в промышленную эксплуатацию реализованного функционала</b></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
	<tbody>
		<tr>
			<td style="width:319px;">
				<p align="left">г. Астана</p>
			</td>
			<td style="width:361px;">
				<p align="right"><?php echo $dan['plan']['DATE_TEXT']; ?> г.</p>
			</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
<p style="text-indent: 1cm; text-align: justify;">
<b>Департамент информационных технологий</b>, именуемый в дальнейшем &laquo;Разработчик&raquo;, в лице Утеповой А.Б., с одной стороны, и
<?php 
    if(count($dan['pd']) > 1){
?>
<b> ниже подписавшиеся, </b>именуемые в дальнейшем &laquo;Заказчики&raquo;
<?php        
    }else{
        echo '<b>'.$dan['pd'][0]['NAME'].'</b>, именуемый в дальнейшем &laquo;Заказчик&raquo; в лице '.$dan['pd'][0]['FIO_KOMY'].',';        
    }
?> 
с другой стороны, в дальнейшем по тексту совместно именуемые &laquo;Стороны&raquo;, а по отдельности &ndash; &laquo;Сторона&raquo;, 
заключили настоящий Акт ввода в промышленную эксплуатацию 
<b>реализованного функционала 
"<?php echo $dan['plan']['NAME']; ?>"
</b>
</p>
<p style="text-indent: 1cm; text-align: justify;">На основании проведенного тестирования реализованного функционала, Стороны подтверждают, что реализованный 
функционал соответствует предъявляемым требованиям.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td style="width: 49%;">
                <?php 
                    if(count($dan['pd']) > 1){
                        echo '<p><b>&laquo;Заказчики&raquo;</b></p>';
                    }else{
                        echo '<p><b>&laquo;Заказчик&raquo;</b></p>';
                    }
                ?>				
				<p>&nbsp;</p>
                <?php 
                    foreach($dan['pd'] as $k=>$v){
                        echo '<p><b>'.$v['NAME'].'</b></p>				
        				<p>'.$v['DOLZHNAME'].'________'.$v['FIO'].'</p>
        				<p>&nbsp;</p>';
                    }
                ?>
				
			</td>
			<td style="padding-left: 15px; vertical-align: top;" valign="top">
				<p><b>&laquo;Разработчик&raquo;</b></p>
				<p>&nbsp;</p>
				<p><b>Департамент информационных технологий</b></p>				
				<p>Директор ___________А. Утепова</p>
				<p>&nbsp;</p>
			</td>
		</tr>
	</tbody>
</table>
<div style="clear:both;">&nbsp;</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</body>
</html>
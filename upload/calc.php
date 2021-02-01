<?php
    $d1 = date("Y-m-d H:i:s");
    
    require_once __DIR__.'/PHPExcel/Classes/PHPExcel/IOFactory.php';    
    
    if(!file_exists(__DIR__."/dobr_v77.xlsx")){
        echo 'Файла нету';
        exit;
    }    
    $objPHPExcel = PHPExcel_IOFactory::load(__DIR__."/dobr_v77.xlsx");
    $objPHPExcel->setActiveSheetIndex(2);
    $aSheet = $objPHPExcel->getActiveSheet();
        
    $aSheet->setCellValue('C2', '21/03/2018');      //Дата расчета        
    $aSheet->setCellValue('Q2', '1');               //Тип страхования    
    $aSheet->setCellValue('T3', '2');               //0 - Основное покрытие; Далее из справочника доп покрытий DOBR_DOP_STRAH NUM_ID    
    $aSheet->setCellValue('C5', '05/01/1992');      //Дата рождения    
    $aSheet->setCellValue('Q6', '0');               //0 - Женский   1 - Мужской    
    $aSheet->setCellValue('C8', '1');               //Периодичность 1 - Ежегодно - 2 раз в пол года 4 - Квартал 12 - Ежемесячно    
    $aSheet->setCellValue('C9', '1');               //Срок защиты в годах    
    $aSheet->setCellValue('C10', '0.15');             //Агентские расходы    
    $aSheet->setCellValue('F4', '10000000');        //Страховая сумма    
    $aSheet->setCellValue('J9', '21/03/2018');      //Период защиты с    
    $aSheet->setCellValue('K9', '21/03/2019');      //Период защиты по    
    
    $tarif = $aSheet->getCell('R11')->getCalculatedValue();
    
    $pay_sum_p = $aSheet->getCell('R12')->getCalculatedValue();
    
    echo $tarif.' - '.$pay_sum_p.'<br />';

    $d2 = date("Y-m-d H:i:s");
    $diff = strtotime($d2) - strtotime($d1);
    echo abs($diff);
    /*
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('hello.xlsx');
    */
    exit;
        
    /*    
    $objPHPExcel->setActiveSheetIndex(2);
    $aSheet = $objPHPExcel->getActiveSheet();
    
    
    echo '<table border="1" cellpadding="0" cellspacing="0">';
 
    // получаем итератор строки и проходим по нему циклом
    foreach($aSheet->getRowIterator() as $row){
        echo "<tr>";
        foreach($row->getCellIterator() as $cell){        
            echo "<td>".$cell->getCalculatedValue()."</td>";
        } 
        echo "</tr>";
    }
    echo '</table>';
    */
    
    
    
    /*
    $q = $this->db->Select("select * from clients where sicid = $id");
            $client = $q[0];
            
            $export = array(
                "filename"=>"calculates/dobr_v77.xlsx",
                "sheet"=>array(
                    array(
                        "index"=>2,
                        "name"=>"",
                        "sets"=>array(
                            'C2'=>$date_calc,
                            'Q2'=>$type_str,
                            'T3'=>'0',
                            'C5'=>$client['BIRTHDATE'],
                            'Q6'=>$client['SEX'],
                            'C8'=>$periodich,
                            'C9'=>$srok,
                            'C10'=>$agent,
                            'F4'=>$str_sum
                        )
                    ),
                    "return"=>array(
                        'R11',
                        'R12'
                    )
                )
            );
            
            require_once 'methods/PHPExcel/Classes/PHPExcel/IOFactory.php';
            if(!file_exists("upload/dobr_v77.xlsx")){
                echo 'Файла нету';
                exit;
            }    
            $objPHPExcel = PHPExcel_IOFactory::load("upload/dobr_v77.xlsx");
            $objPHPExcel->setActiveSheetIndex(2);
            $aSheet = $objPHPExcel->getActiveSheet();
                
            $aSheet->setCellValue('C2', '21/03/2018');      //Дата расчета        
            $aSheet->setCellValue('Q2', '1');               //Тип страхования    
            $aSheet->setCellValue('T3', '2');               //0 - Основное покрытие; Далее из справочника доп покрытий DOBR_DOP_STRAH NUM_ID    
            $aSheet->setCellValue('C5', '05/01/1992');      //Дата рождения    
            $aSheet->setCellValue('Q6', '0');               //0 - Женский   1 - Мужской    
            $aSheet->setCellValue('C8', '1');               //Периодичность 1 - Ежегодно - 2 раз в пол года 4 - Квартал 12 - Ежемесячно    
            $aSheet->setCellValue('C9', '1');               //Срок защиты в годах    
            $aSheet->setCellValue('C10', '0.15');             //Агентские расходы    
            $aSheet->setCellValue('F4', '10000000');        //Страховая сумма    
            $aSheet->setCellValue('J9', '21/03/2018');      //Период защиты с    
            $aSheet->setCellValue('K9', '21/03/2019');      //Период защиты по    
            
            $tarif = $aSheet->getCell('R11')->getCalculatedValue();            
            $pay_sum_p = $aSheet->getCell('R12')->getCalculatedValue();
                        
            $result['error'] = $tarif.' - '.$pay_sum_p;
            echo json_encode($result);
            exit;            
            //------------------------------------------------------------------------------------------------
    */
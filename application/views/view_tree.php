    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Структурные подразделения </h5>
                </div>
                <div class="ibox-content">
                    <div id="jstree1">
                        <ul>
                            <li class="jstree-open"><?php echo $list_CEO[0]['D_NAME'].' '.$list_CEO[0]['LASTNAME'].' '.$list_CEO[0]['FIRSTNAME'].' статус: '.$list_CEO[0]['NAME']; ?>
                                <ul>
                                    <li><?php echo $list_COO[0]['D_NAME'].' '.$list_COO[0]['LASTNAME'].' '.$list_COO[0]['FIRSTNAME'].' статус: '.$list_COO[0]['NAME']; ?>
                                        <ul>
                                            <li>Департамент корпоративных продаж: <?php echo $list_mark_chief[0]['D_NAME'].' '.$list_mark_chief[0]['LASTNAME'].' '.$list_mark_chief[0]['FIRSTNAME'].' статус: '.$list_mark_chief[0]['NAME']; ?></li>
                                            <li>Служба регионального развития: <?php echo $list_region_dev[0]['D_NAME'].' '.$list_region_dev[0]['LASTNAME'].' '.$list_region_dev[0]['FIRSTNAME'].' статус: '.$list_region_dev[0]['NAME']; ?>
                                                <ul>
                                                    <li>Филиалы
                                                    <ul>
                                                        <?php foreach($listBranch as $k => $v){
                                                            echo '<li>'.$v['NAME'].'</li>';    
                                                        } ?>
                                                    </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>Служба маркетинга и связи с общественностью: <?php echo $list_public_rel[0]['D_NAME'].' '.$list_public_rel[0]['LASTNAME'].' '.$list_public_rel[0]['FIRSTNAME'].' статус: '.$list_public_rel[0]['NAME']; ?></li>
                                            <li>Служба перестрахования: <?php echo $list_reins[0]['D_NAME'].' '.$list_reins[0]['LASTNAME'].' '.$list_reins[0]['FIRSTNAME'].' статус: '.$list_reins[0]['NAME']; ?></li>
                                        </ul>
                                    </li>
                                    <li><?php echo $list_deputy_CEO[0]['D_NAME'].' '.$list_deputy_CEO[0]['LASTNAME'].' '.$list_deputy_CEO[0]['FIRSTNAME'].' статус: '.$list_deputy_CEO[0]['NAME']; ?>
                                        <ul>
                                            <li>Департамент стратегического планирования: <?php echo $list_strat[0]['D_NAME'].' '.$list_strat[0]['LASTNAME'].' '.$list_strat[0]['FIRSTNAME'].' статус: '.$list_strat[0]['NAME']; ?></li>
                                            <li>Административный департамент: <?php echo $list_adm[0]['D_NAME'].' '.$list_adm[0]['LASTNAME'].' '.$list_adm[0]['FIRSTNAME'].' статус: '.$list_adm[0]['NAME']; ?></li>
                                        </ul>
                                    </li>
                                    <li><?php echo $list_deputy_CEO[1]['D_NAME'].' '.$list_deputy_CEO[1]['LASTNAME'].' '.$list_deputy_CEO[1]['FIRSTNAME'].' статус: '.$list_deputy_CEO[1]['NAME']; ?>
                                        <ul>
                                            <li>Департамент Бухучуета и фин. отчетности: <?php echo $list_accountant[0]['D_NAME'].' '.$list_accountant[0]['LASTNAME'].' '.$list_accountant[0]['FIRSTNAME'].' статус: '.$list_accountant[0]['NAME']; ?></li>
                                            <li>Департамент урегулирования выплат</li>
                                            <li>Служба страхового учета</li>
                                        </ul>
                                    </li>
                                    <li><?php echo $list_СVO[0]['D_NAME'].' '.$list_СVO[0]['LASTNAME'].' '.$list_СVO[0]['FIRSTNAME'].' статус: '.$list_СVO[0]['NAME']; ?>
                                        <ul>
                                            <li>Департамент андеррайтинга</li>
                                            <li>Служба актуарных расчетов и анализа</li>
                                        </ul>
                                    </li>
                                    <li><?php echo $list_COO[1]['D_NAME'].' '.$list_COO[1]['LASTNAME'].' '.$list_COO[1]['FIRSTNAME'].' статус: '.$list_COO[1]['NAME']; ?>
                                        <ul>
                                            <li>Департамент информационных технологий, отдел оптимизации бизнес-процессов</li>
                                            <li>Департамент управления активами и пассивами</li>
                                            <li>Служба внутренней безопасности</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
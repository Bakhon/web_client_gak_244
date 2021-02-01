<?php
    $sqlSport = "SELECT num_id kod, naimen NAME FROM dobr_spr_sport";    
    $db->ClearParams();
    $dbSport = $db->Select($sqlSport);
    
    $x = 0;
    foreach($dbSport as $a => $b){
    echo '<div class="checkbox"><input id="checkbox'.$b['KOD'].'" title="'.$b['NAME'].'" type="checkbox" name="option[]" style="width: 30px;" value="'.$b['KOD'].'"/><label for="checkbox'.$b['KOD'].'">'.$b['NAME'].'</label></div>';
    $x++;
    }
?>
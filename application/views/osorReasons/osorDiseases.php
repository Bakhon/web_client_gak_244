<?php
    $sqlDisease = "SELECT num_id kod, naimen NAME FROM dobr_spr_zab";    
    $db->ClearParams();
    $dbDisease = $db->Select($sqlDisease);
    
    $q = 0;
    foreach($dbDisease as $c => $d){
    echo '<div class="checkbox"><input id="checkbox'.$d['KOD'].'" title="'.$d['NAME'].'" type="checkbox" name="option[]" style="width: 30px;" value="'.$d['KOD'].'"/><label for="checkbox'.$d['KOD'].'">'.$d['NAME'].'</label></div>';
    $q++;
    }
    
?>
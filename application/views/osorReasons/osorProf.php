<?php
    $sqlProfessional = "SELECT num_id kod, naimen NAME FROM dobr_spr_prof";    
    $db->ClearParams();
    $dbProfessional = $db->Select($sqlProfessional);
    
    $y = 0;
    foreach($dbProfessional as $k => $z){
    echo '<div class="checkbox"><input id="checkbox'.$z['KOD'].'" title="'.$z['NAME'].'" type="checkbox" name="option[]" style="width: 30px;" value="'.$z['KOD'].'"/><label for="checkbox'.$z['KOD'].'">'.$z['NAME'].'</label></div>';
    $y++;
    }
?>
<pre>
<?php
	require_once __DIR__.'/index.php';
    
    $soap = new E_CONTRACTS();
    
    if(isset($_GET['contract'])){
        $id = $_GET['contract'];
        if($id == ''){
            echo 'Fuck';
            exit;
        }
        
        if($id == '0'){
            echo 'Fuck';
            exit;
        }
        
        $soap->contract($id);
        echo '<textarea>';
        echo $soap->res_xml;
        echo '</textarea>';        
    }
?>
</pre>
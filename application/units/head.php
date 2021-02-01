<?php
class head{
    function json($data, $ajax = false)
    {
        header('Content-Type: application/json');
        if($ajax == false){
            return json_encode($data);
        }else{            
            echo json_encode($data);
            exit;        
        }
    }
}
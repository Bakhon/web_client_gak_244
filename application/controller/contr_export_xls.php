<?php

if(isset($_POST['content']))
{
            $html = '';
            $dan = date(d-m-y);
            
            header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment;Filename=$dan.xls");
            $html .= $_POST['content'];
            echo $html;
            exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>

        <link href="styles/css/bootstrap.min.css" rel="stylesheet">
        <link href="styles/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="styles/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

        <?php
        if(count($css_loader) > 0)
        {
            foreach($css_loader as $css)
            {
                echo "\n";
                echo '<link href="'.$css.'" rel="stylesheet">';
            }
        }
        ?>

        <link href="styles/css/animate.css" rel="stylesheet"/>        
        <link href="styles/css/style.css" rel="stylesheet"/>
        
        <link href="styles/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <script src="styles/js/jquery-2.1.1.js"></script>
        <script src="styles/js/bootstrap.min.js"></script>
        <script src="styles/js/others/jquery.cookie.js"></script>        

        <?php         
        if(count($js_loader_header) > 0)
        {
            foreach($js_loader_header as $vs)
            {
                echo "\n";
                echo '<script type="text/javascript" src="'.$vs.'"></script>';                
            }
        }
        ?>     
    </head>
    <body class="<?php
        if(isset($_COOKIE['navbar'])){ 
            echo $_COOKIE['navbar']; 
        }
    ?>">
        <div id="wrapper">
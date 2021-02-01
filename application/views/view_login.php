<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>АО "КСЖ "ГАК"</title>

    <link href="styles/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="styles/css/animate.css" rel="stylesheet">
    <link href="styles/css/style.css" rel="stylesheet">
    <link href="styles/css/plugins/select2/select2.min.css" rel="stylesheet">        
    
</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">ГАК</h1>

            </div>
            <h3>КСЖ ГАК</h3>
            <p>Для входа в информационную систему, необходимо ввести Логин и Пароль от Вашей учетной записи
               
            </p>            
            
            <?php 
                $s = 'readonly onfocus="$(this).removeAttr('."'readonly'".');"';
                if($_SERVER['REMOTE_ADDR'] == '192.168.5.24'){
                    $s = '';
                }                
            ?>
            <form class="m-t" role="form" method="post">
                <div class="form-group">      
                    <input type="text" <?php //echo $s; ?> class="form-control" placeholder="Ваш Логин" name="login"/>
                </div>                
                <div class="form-group">
                    <input type="password" style="background-color: #fff;" <?php echo $s; ?> class="form-control" name="password" placeholder="Пароль">
                </div>
                <input type="hidden" name="url_request" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
                <input type="submit" class="btn btn-primary block full-width m-b" value="Войти"/>
            </form>
            <p class="m-t" style="margin-bottom: 150px;"> <small>Разработано специально для АО КСЖ ГАК &copy; 2016</small> </p>
        </div>
    </div>
    
    <script src="styles/js/jquery-2.1.1.js"></script>
    <script src="styles/js/bootstrap.min.js"></script>
</body>
</html>
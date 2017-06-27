<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ToDo - Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="../plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../homepage.php"><b>To</b>Do</a>
            </div>
        
            <div class="login-box-body">
                <p class="login-box-msg">Entre com seu nome de usuário e senha:</p>
                <?php
                if(isset($_GET['erro'])){
                    if($_GET['erro'] == '2'){
                        echo '
                        <div class="login-box-body">
                            <div class="text-center">
                                <p class="login-box-msg">Usuário ou senha incorreto!</p>
                                <hr>
                            </div>
                        </div>';
                    }
                }
                ?>
                <form action="../scripts/login.php" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Nome de Usuário" name="user"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Senha" name="pwuser"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                    </div>
                </form>
                </div>
                <form action="../paginas/cadastrarUsuario.php">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                </form>
            </div>
    </body>
</html>
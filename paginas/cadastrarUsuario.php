<?php
    require '../scripts/config.php';
    require '../scripts/database.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ToDo - Cadastro</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="content bg-light-blue-active">
    <?php
    /* Pegar os valores do form, validar e enviar para a db*/
        if(isset($_POST['register'] )){
            $form["nome"] = DBEscape(strip_tags( trim( $_POST["nome"])));
            $form["userlogin"] = DBEscape(strip_tags( trim( $_POST["user"])));
            $senha = $_POST["pwuser"];
            $csenha = $_POST["conpwuser"];
            $form["senha"] = sha1($senha);
            $form["email"] = DBEscape(strip_tags( trim( $_POST["email"])));
            
            //Verificar se usuario ja existe

            if( empty($form["nome"]) or empty($form["userlogin"]) or empty($senha) or empty($csenha) or empty($form["email"])){
                echo '<p style="text-align: center; font-weight: bold;">Preencha todos os campos!</p>';
            }
            else{
                $validarUsuario = DBRead('usuario', "WHERE userlogin = '{$form["userlogin"]}' LIMIT 1");
                if($validarUsuario){
                    echo '<p style="text-align: center; font-weight: bold;">Usuário já existe!</p>';
                }
                else{
                    if (!preg_match("/^[a-zA-Z ]*$/", $form["nome"])) {
                        echo '<p style="text-align: center; font-weight: bold;">Nome invalído somente letras e espaços!</p>';
                    }   
                    else if (!preg_match("/^[a-zA-Z0-9]*$/", $form["userlogin"])) {
                        echo '<p style="text-align: center; font-weight: bold;">Usuário invalído somente letras e números!</p>';
                    }
                    else if (!filter_var($form["email"], FILTER_VALIDATE_EMAIL)) {
                        echo '<p style="text-align: center; font-weight: bold;">Email invalído!</p>'; 
                    }
                    else{
                        if( DBCreate('usuario', $form)){
                            echo '<p style="text-align: center; font-weight: bold;">Usuário cadastrado!</p>';
                        }
                        else{
                            echo '<p style="text-align: center; font-weight: bold;">Ocorreu um erro!</p>';
                        }
                    }
                }
            }
            echo "<hr>";
        }
    ?>
        <div>
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="col-xs-4 col-lg-offset-4 bg-gray">

                    <div class="text-center h2">
                        <a href="homepage.php" class="text-black"><b>To</b>Do</a>
                    </div>

                    <div class="form-group">
                        <label for="nome"> Nome Completo</label>
                        <input type="text" class="form-control" name="nome" id="nome" aria-describedby="helpId"
                               placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="user"> Nome de Usuário</label>
                        <input type="text" class="form-control" name="user" id="user" aria-describedby="helpId"
                               placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="email"> Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId"
                               placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="pwuser">Senha</label>
                        <input type="password" class="form-control" name="pwuser" id="pwuser" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="confirmapwuser">Confirmar Senha</label>
                        <input type="password" class="form-control" name="conpwuser" id="conpwuser" placeholder="">
                    </div>

                    <div class="text-center col-xs-6 col-lg-offset-3">
                        <button type="submit" class="btn-success" name="register" value="register"> Cadastrar</button>
                    </div>

                </div>
            </form>
        </div>
        <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
        <script src='../plugins/fastclick/fastclick.min.js'></script>
        <script src="../dist/js/app.min.js" type="text/javascript"></script>
    </body>
</html>
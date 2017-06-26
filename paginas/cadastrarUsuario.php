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

    <body class="skin-blue collapsed-box">
        <div class="wrapper">
            <header class="main-header">
                <a href="homepage.php" class="logo"><b>To</b>Do</a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $userImg ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $userNome ?></p>
                            <a><i class="fa fa-circle text-success"></i><?php echo $userMail ?></a>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="../paginas/novoprojeto.php">
                                <i class="fa fa-plus"></i>
                                <span>Novo Projeto</span>
                            </a>
                        </li>
                        <li>
                            <a href="../paginas/alterardados.php">
                                <i class="fa fa-edit"></i>
                                <span>Alterar dados</span>
                            </a>
                        </li>
                        <li>
                            <a href="../scripts/logoff.php">
                                <span>Sair</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>

            <div class="content-wrapper bg-light-blue-active">
                <div class="col-xs-4 col-lg-offset-5">
                    <h1> Registrar</h1>
                </div>

                <div class="col-xs-4 col-lg-offset-4">
                    <div class="form-group">
                        <label for="nome"> Nome Completo</label>
                        <input type="text" class="form-control" name="" id="nome" aria-describedby="helpId"
                               placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="user"> Nome de Usuário</label>
                        <input type="text" class="form-control" name="" id="user" aria-describedby="helpId"
                               placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="email"> Email</label>
                        <input type="email" class="form-control" name="" id="email" aria-describedby="emailHelpId"
                               placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="pwuser">Senha</label>
                        <input type="password" class="form-control" name="" id="pwuser" placeholder="">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-success "> Cadastrar</button>
                    </div>
                </div>
            
            </div>
        </div>

        <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
        <script src='../plugins/fastclick/fastclick.min.js'></script>
        <script src="../dist/js/app.min.js" type="text/javascript"></script>
    </body>
</html>
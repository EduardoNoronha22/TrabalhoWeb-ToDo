<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ToDo - Tarefa</title>
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
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
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
                <div class="content">
                    <div align="center">
                        <a href="projeto.php">
                            <h2 class="bg-light-blue-active"> Nome do Projeto </h2>
                        </a>
                        <a href="tarefa.php" class="h3">
                            <h3 class="bg-light-blue-active"> Nome da Tarefa</h3>
                        </a>

                        <!-- Aqui vai precisar ter um if para dependendo do status da tarefa, mudar a cor da caixa em volta dela -->
                        <!-- Quando for testar a descriçao, tente uma descriçao grande pra ver se tem quebra de linha-->
                        <div class="box-solid bg-red col-md-4 col-lg-offset-4">
                            <div class="box-header">
                                <h4 class="bg-red">DO</h4>
                            </div>
                            <div class="box-body">
                                <h5 class="text-center"> Descrição da Tarefa </h5>
                            </div>
                        </div>
                        <!--
                        <div class="box-solid bg-orange center-block col-md-4">
                            <div class="box-header">
                                <h4 class="bg-orange">DOING</h4>
                            </div>
                            <div class="box-body">
                                <h5 class="text-center"> Descrição da Tarefa </h5>
                            </div>
                        </div>

                        <div class="box-solid bg-green col-md-4">
                            <div class="box-header">
                                <h4 class="bg-green">DONE</h4>
                            </div>
                            <div class="box-body bg-green">
                                <h5 class="text-center"> Descrição da Tarefa </h5>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
                <div class="col-sm-4 col-sm-offset-4" align="center">
                    <h4> Mudar para: </h4>
                    <div class="text-center pull-left">
                        <button type="submit" class="btn bg-orange" name="" value=""> Doing</button>
                    </div>

                    <div class="text-center pull-right">
                        <button type="submit" class="btn bg-green" name="" value=""> Done</button>
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
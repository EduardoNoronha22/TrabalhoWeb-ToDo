<?php
    require '../scripts/config.php';
    require '../scripts/database.php';

    header('content-type: text/html; charset: utf-8');
    
    if (!isset($_SESSION)){
         session_start();
    }
    if (!isset($_SESSION['UsuarioID'])){
        session_destroy();
        header("Location: ../paginas/index.php");
    }

    $userId = $_SESSION['UsuarioID'];
    $userLogin = $_SESSION['UsuarioLogin'];

    $infos = DBRead('usuario', "WHERE id_user = '{$userId}'");
    foreach($infos as $dados);
        $userNome = $dados["nome"];
        $userMail= $dados["email"];
        $photo = $dados["linkimg"];

    if(empty($photo)){
        $urlphoto = '../img/default-icon.jpg';
    }
    else{
        $urlphoto = '../scripts/getImagem.php';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ToDo - Criar Projeto</title>
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
                    <img src="<?php echo $urlphoto ?>" class="img-circle" alt="User Image" />
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
    <?php

    if(isset($_POST['insereProj'] )){
        $form["nome"] = $_POST["pjnome"];
        $form["id_user"] = $userId;

        if(!empty($form["nome"]))
            if (DBCreate('projeto', $form)){
                header("Location: ../paginas/homepage.php");
            }
        else{
            echo '<script> alert("Escolha um nome!")</script>';
        }
    }
    ?>

    <div class="content-wrapper bg-light-blue-active">
        <div class="content">
            <!--<div class="col-md-9 col-md-offset-1">-->
            <h2 class="text-center">Novo Projeto</h2>
            <div class="form-group col-lg-offset-3">
                <div class="col-md-9 col-md-offset-0">
                    <label for="nome"> Nome do Projeto</label>
                </div>
                <div class="col-xs-7">
                <form action="" method="post">
                    <input type="text" class="form-control" name="pjnome" aria-describedby="helpId"
                           placeholder="">

                    <button type="submit" name="insereProj" class="btn btn-bitbucket bg-success pull-right" aria-label="Left Align">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Criar Projeto
                    </button>
                </form>
                </div>
            </div>

            <div class="center-block"></div>
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

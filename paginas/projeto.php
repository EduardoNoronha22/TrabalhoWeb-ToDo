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
    $userImg= $_SESSION['UsuarioImg'];
    $userLogin = $_SESSION['UsuarioLogin'];

    $infos = DBRead('usuario', "WHERE id_user = '{$userId}'");
    foreach($infos as $dados);
        $userNome = $dados["nome"];
        $userMail= $dados["email"];

    // Validando as actions se existem e se nao sao vazias
    if(isset( $_GET['verificador']))
        $verificador = $_GET['verificador']; //Debugando valor do id que ira pegar da url

    $owner = DBRead('projeto'," WHERE (`id_user` = '".$userId."') AND (`id_projeto` = '".$verificador."')");
    if(!$owner){
        $member = DBRead('membro'," WHERE (`id_membro` = '".$userId."') AND (`id_projeto` = '".$verificador."')");
        if(!$member){
            header("Location: ../paginas/homepage.php");
        }
        else{
            $permission = 0;
        }
    }
    else{
        $permission = 1;
    }

    foreach ($owner as $own) {
        $nproj = $own['nome'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ToDo - Projeto</title>
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
                    <a href="../paginas/criarprojeto.php">
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
            <div class="col-md-9 col-md-offset-1">
                <div class="text-center">
                    <h1 class="text-center">
                        <?php echo $nproj ?>
                    </h1>
                    <?php
                    if(isset($_POST['delep'])){
                        DBDelete('projeto', "WHERE `id_projeto` = $verificador ");
                        echo '<script> alert("Projeto Excluido"); location.href="../paginas/homepage.php"</script>';
                    }
                    if($permission == 1){
                        echo '
                        <form action="" method="post">
                        <button type="submit" name="delep" class="btn btn-bitbucket bg-red" aria-label="Left Align" name="deletarproj">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Deletar Projeto
                        </button>
                        </form>

                        <button type="button" class="btn btn-success bg-green" aria-label="Left Align">
                            <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Finalizar Projeto
                        </button>';
                    }
                    ?>

                    <div class="content">
                        <div class="box-solid bg-red col-md-4">
                            <div class="box-header">
                                <h4 class="bg-red">DO</h4>
                            </div>
                            <div class="box-body">
                            <?php
                                $tarefas = DBRead('tarefa'," WHERE (`id_projeto` = '".$verificador ."') AND (`estado` = 1)");
                                if(!$tarefas){
                                    echo '<h5 class="text-center"> ---- </h5>';
                                }
                                else
                                    foreach($tarefas as $tarefa){
                                        $urltarefa = "../paginas/tarefa.php?verificador=".$tarefa['id_tarefa'];
                                        echo '<a href="'.$urltarefa.'" class="bg-red">
                                                <h5 class="text-center">'.$tarefa['nome'].'</h5>
                                              </a>';
                                    }
                            ?>
                            </div>
                        </div>
                        <div class="box-solid bg-orange  col-md-4">
                            <div class="box-header">
                                <h4 class="bg-orange">DOING</h4>
                            </div>
                            <div class="box-body">
                                <?php
                                $tarefas = DBRead('tarefa'," WHERE (`id_projeto` = '".$verificador ."') AND (`estado` = 2)");
                                if(!$tarefas){
                                    echo '<h5 class="text-center"> ---- </h5>';
                                }
                                else
                                    foreach($tarefas as $tarefa){
                                        $urltarefa = "../paginas/tarefa.php?verificador=".$tarefa['id_tarefa'];
                                        echo '<a href="'.$urltarefa.'" class="bg-orange">
                                                <h5 class="text-center">'.$tarefa['nome'].'</h5>
                                              </a>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-solid bg-green col-md-4">
                            <div class="box-header">
                                <h4 class="bg-green">DONE</h4>
                            </div>
                            <div class="box-body bg-green">
                                <?php
                                $tarefas = DBRead('tarefa'," WHERE (`id_projeto` = '".$verificador ."') AND (`estado` = 3)");
                                if(!$tarefas){
                                    echo '<h5 class="text-center"> ---- </h5>';
                                }
                                else
                                    foreach($tarefas as $tarefa){
                                        $urltarefa = "../paginas/tarefa.php?verificador=".$tarefa['id_tarefa'];
                                        echo '<a href="'.$urltarefa.'" class="bg-green">
                                                <h5 class="text-center">'.$tarefa['nome'].'</h5>
                                              </a>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(isset($_POST['addMember'])){

                        $findMail = DBEscape(strip_tags( trim( $_POST["mailMember"])));

                        $form["id_projeto"] = $verificador;
                        $form["id_owner"] = $userId;

                        $membros = DBRead('usuario', "WHERE email = '{$findMail}'");
                        if (!$membros){
                            echo '<script> alert("Membro nao existe!")</script>';
                        }
                        else{
                            foreach ($membros as $membro) {
                                if($membro){
                                    $form["id_user"] = $membro['id_user'];
                                    $canadd = DBRead('membro', "WHERE (id_user = '{$form["id_user"]}') AND (id_owner = '{$userId}') AND (id_projeto = '{$verificador}') LIMIT 1");
                                    if(!$canadd){
                                        DBCreate('membro', $form);
                                        echo '<script> alert("Membro adicionado!")</script>';
                                    }
                                    else{
                                        echo '<script> alert("Membro ja faz parte!")</script>';
                                    }
                                }
                            }
                        }
                    }
                    if($permission == 1){
                        echo '
                        <form action="" method="post">
                        <input type="text" class="form-control" name="mailMember" aria-describedby="helpId" placeholder="">
                        <button type="submit" name="addMember" class="btn btn-success bg-yellow" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Membro
                        </button>
                        </form>';
                    }
                    ?>
                </div>
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
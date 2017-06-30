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

    if(isset( $_GET['pid']))
        $projetoid = $_GET['pid']; //Debugando valor do id que ira pegar da url

    if(isset( $_GET['tid']))
        $tarefaid = $_GET['tid'];

    $infostarefa = DBRead('tarefa', "WHERE id_tarefa = '{$tarefaid}'");
    foreach($infostarefa as $tinfo);
        $tarnome = $tinfo["nome"];
        $tardesc= $tinfo["descricao"];
        $tarest= $tinfo["estado"];

    $owner = DBRead('projeto'," WHERE (`id_user` = '".$userId."') AND (`id_projeto` = '".$projetoid."')");
    if(!$owner){
        $member = DBRead('membro'," WHERE (`id_membro` = '".$userId."') AND (`id_projeto` = '".$projetoid."')");
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
<?php
    if(isset($_POST['edittar'] )){
        $form["nome"] = DBEscape(strip_tags( trim( $_POST["nome"])));
        $form["descricao"] = DBEscape(strip_tags( trim( $_POST["desc"])));
        $form["estado"] = $_POST["est"];
        if( empty( $form["nome"]) or (empty( $form["descricao"]))){
            echo '<script> alert("Preencher os campos!")</script>';
        }
        else{
            if( DBUpDate('tarefa', $form, "id_tarefa = '{$tarefaid}'")){
                echo '<script> alert("Alterado com sucesso!"); location.href="projeto.php?pid='.$projetoid.'"</script>';
            }
        }
    }
?>
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
            <div align="center">
                <?php echo '<a href="projeto.php?pid='.$projetoid.'">'; ?>
                    <h2 class="bg-light-blue-active"> Projeto: <?php echo $nproj ?> </h2>
                </a>
                    <h3 class="bg-light-blue-active"> Tarefa: <?php echo $tarnome ?></h3>

                <!-- Aqui vai precisar ter um if para dependendo do status da tarefa, mudar a cor da caixa em volta dela -->
                <!-- Quando for testar a descriçao, tente uma descriçao grande pra ver se tem quebra de linha-->
                <div class="box-solid bg-light-blue-active col-md-4 col-lg-offset-4">
                    <form action="" method="post">
                        <div class="box-body">
                            <h5 class="text-center"> Nome: </h5>
                            <input type="text" class="form-control" name="nome" value="<?php echo $tarnome ?>">
                        </div>
                        <div class="box-body">
                            <h5 class="text-center"> Descrição: </h5>
                            <input type="text" class="form-control" name="desc" value="<?php echo $tardesc ?>">
                        </div>
                        <div class="box-body">
                            <h5 class="text-center"> Estado: </h5>
                            <select id="est" name="est" style="color: black;" > 
                              <option value="1" <?php if($tarest == '1'){ echo'selected="selected"';}?>>To Do</option>
                              <option value="2" <?php if($tarest == '2'){ echo'selected="selected"';}?>>Doing</option>
                              <option value="3" <?php if($tarest == '3'){ echo'selected="selected"';}?>>Done</option>
                            </select>
                        </div>
                        <div class="box-body">
                            <button type="submit" name="edittar" class="btn btn-bitbucket bg-gray col-lg-offset-0">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Atualizar
                            </button>
                        </div>
                    </form>
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
        <!--
        <div class="col-sm-4 col-sm-offset-4" align="center">
            <h4> Mudar para: </h4>
            <div class="text-center pull-left">
                <button type="submit" class="btn bg-orange" name="" value=""> Doing</button>
            </div>

            <div class="text-center pull-right">
                <button type="submit" class="btn bg-green" name="" value=""> Done</button>
            </div>
        </div>
        -->
    </div>
</div>
<script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
<script src='../plugins/fastclick/fastclick.min.js'></script>
<script src="../dist/js/app.min.js" type="text/javascript"></script>
</body>
</html>
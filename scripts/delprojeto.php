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

    // Validando as actions se existem e se nao sao vazias
    if(isset( $_GET['pid'])){
        $projetoid = $_GET['pid']; //Debugando valor do id que ira pegar da url
    }
    else{
    	header("Location: ../paginas/homepage.php");
    }


    $owner = DBRead('projeto'," WHERE (`id_user` = '".$userId."') AND (`id_projeto` = '".$projetoid."')");
    if(!$owner){
    	header("Location: ../paginas/homepage.php");
    }
    else{
    	DBDelete('projeto',"id_projeto = '{$projetoid}'");
    	header("Location: ../paginas/homepage.php");
    }
?>



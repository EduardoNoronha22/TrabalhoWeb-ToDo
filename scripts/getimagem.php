<?php
	require '../scripts/config.php';
    require '../scripts/database.php';

    if (!isset($_SESSION)){
         session_start();
    }
    if (!isset($_SESSION['UsuarioID'])){
        session_destroy();
        header("Location: ../paginas/index.php");
    }
    
    $userId = $_SESSION['UsuarioID'];

	$fotos = DBRead('usuario', "WHERE id_user = '{$userId}'");
	foreach($fotos as $foto);
        $f = $foto["linkimg"];

	Header( "Content-type: image/gif"); 
	echo $f; 
?>
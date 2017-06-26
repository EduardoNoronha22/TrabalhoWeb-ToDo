<?php
    require '../scripts/config.php';
	require '../scripts/database.php';
	 
	 
    // Verifica se houve POST e se o usuário ou a senha são vazio(s)
    if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pwuser']))) {
		$erro = 1;
        header("Location: ../paginas/index.php?erro=$erro");
    }

    $usuario = $_POST['user'];
    $senha = $_POST['pwuser'];  
	  
    // Validação do usuário/senha digitados
    $user = DBRead('usuario'," WHERE (`userlogin` = '".$usuario ."') AND (`senha` = '". sha1($senha) ."')");
	foreach($user as $users);
	if(!$users){
		$erro = 2;
		header("Location: ../paginas/index.php?erro=$erro");
	}
	else{
		 if (!isset($_SESSION)){
			session_start(); 
		 }
		$_SESSION['UsuarioID'] = $users['id_user'];
		$_SESSION['UsuarioLogin'] = $users['userlogin'];
        $_SESSION['UsuarioNome'] = $users['nome'];
        $_SESSION['UsuarioMail'] = $users['email'];
        $_SESSION['UsuarioImg'] = $users['linkimg'];
		
		header("Location: ../paginas/homepage.php");
	}

?>

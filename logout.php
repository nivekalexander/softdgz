<?php
    ob_start();
	session_start();
    require_once('./models/database.php');
    require_once('./models/usuario.php');
    $objUser= new Usuario();
    if(isset($_SESSION['usId'])){
        $respuesta=$objUser->Logout($_SESSION['usId']);
    }
    session_destroy();
   // header("Location: ../index.php");
    exit();
?>
<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("location: index.php");
        exit;
    }
?>

<a href="sair.php">Sair</a>
Seja bem vindo
<?php
session_start();
if (!isset($_SESSION['idUsuario'])) {
    $_SESSION['naoLogado'] = 'Login necessário';
    header('Location: ../php/login.php');
    exit;
}
?>
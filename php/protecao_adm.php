<?php
session_start();
if (!isset($_SESSION['idUsuario']) || !$_SESSION['adm']) {
    $_SESSION['naoADM'] = 'Apenas admins permitidos.';
    header('Location: ../php/login.php');
    exit;
}
?>
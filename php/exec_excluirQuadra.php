<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conecta.php";

$idQuadra = $_POST['idQuadra'];
$nomeQuadra = $_POST['nomeQuadra'];
$confirmar = $_POST['confirmar'];

if ($confirmar === 'sim' && $idQuadra) {
        $sqlExcluirQuadra = "DELETE FROM quadra WHERE idQuadra = $idQuadra";
        if (mysqli_query($conexao, $sqlExcluirQuadra)) {
            $_SESSION['quadraExcluida'] = '"' . $nomeQuadra . '" excluída com sucesso';
            header("Location: ../php/administrarQuadras.php");
            exit;
        } else {
            echo 'Erro ao excluir quadra';
        }
    } else {
    header("Location: ../php/administrarQuadras.php");
    exit;
}
?>

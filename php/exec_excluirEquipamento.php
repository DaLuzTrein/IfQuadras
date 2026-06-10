<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conecta.php";

$idEquipamento = $_POST['idEquipamento'];
$tipo = $_POST['tipo'];
$confirmar = $_POST['confirmar'];

if ($confirmar === 'sim' && $idEquipamento) {
        $sqlExcluirEquipamento = "DELETE FROM equipamento WHERE idEquipamento = $idEquipamento";
        if (mysqli_query($conexao, $sqlExcluirEquipamento)) {
            $_SESSION['equipamentoExcluido'] = '"' . $tipo . '" excluída com sucesso';
            header("Location: ../php/administrarEquipamentos.php");
            exit;
        } else {
            echo 'Erro ao excluir quadra';
        }
    } else {
    header("Location: ../php/administrarEquipamentos.php");
    exit;
}
?>

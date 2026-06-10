<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conecta.php";

$idCliente = $_POST['idCliente'];
$nomeCliente = $_POST['nomeCliente'];
$confirmar = $_POST['confirmar'];

if ($confirmar === 'sim' && $idCliente) {
    $sqlExcluirLogin = "DELETE FROM login WHERE idCliente = $idCliente";
    if (mysqli_query($conexao, $sqlExcluirLogin)) {
        $sqlExcluirCliente = "DELETE FROM cliente WHERE idCliente = $idCliente";
        if (mysqli_query($conexao, $sqlExcluirCliente)) {
            $_SESSION['clienteExcluido'] = 'Cliente "' . $nomeCliente . '" excluído com sucesso';
            header("Location: ../php/administrarClientes.php");
            exit;
        } else {
            echo 'erro ao excluir cliente';
        }
    } else {
        echo 'erro ao excluir login';
    }
} else {
    header("Location: ../php/administrarClientes.php");
    exit;
}
?>

<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conecta.php";

$idEquipamento = $_POST['idEquipamento'];
$quantidade = $_POST['quantidade'];

        $sqlModificarEquipamento = "UPDATE equipamento SET quantidade = $quantidade WHERE idEquipamento = $idEquipamento";
        if (mysqli_query($conexao, $sqlModificarEquipamento)) {
            header("Location: ../php/administrarEquipamentos.php");
            exit;
        } else {
            echo 'Erro';
        }
?>

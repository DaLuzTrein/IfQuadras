<?php
session_start();
// exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../php/conecta.php";

$idCliente = $_POST['idCliente'];
$idEquipamento = $_POST['idEquipamento'];
$tipo = $_POST['tipo'];
$quantidadeAlugada = $_POST['quantidadeAlugada'];
$idReservaQuadra = $_POST['idReservaQuadra'];
$quantidadeDisponivel = $_POST['quantidadeDisponivel'];

    //verifica se todos os campos foram preenchidos
    if(!$idCliente || !$idEquipamento || !$quantidadeAlugada || !$tipo || !$idReservaQuadra) {
    $_SESSION['erroFaltaCampos'] = 'Campos necessários não foram preenchidos.';
    header("Location: ../php/alugarEquipamento.php?idEquipamento=" . $idEquipamento . "&tipo=" . $tipo);
    exit;

    } else {

    //verifica se existe uma quadra linkada à reserva de equipamento
    if($idReservaQuadra == 'nenhuma') {
    $_SESSION['erroSemReservaQuadra'] = 'É necessário ter uma reserva de quadra para utilizar o serviço de reserva de equipamento.';
    header("Location: ../php/alugarEquipamento.php?idEquipamento=" . $idEquipamento . "&tipo=" . $tipo);
    exit;

    } else {

    //verifica se a quantidade solicitada está disponível
    if($quantidadeAlugada > $quantidadeDisponivel) {
    $_SESSION['erroQuantidadeIndisponivel'] = 'Quantidade solicitada indisponível.';
    header("Location: ../php/alugarEquipamento.php?idEquipamento=" . $idEquipamento . "&tipo=" . $tipo);
    exit;

    } else {

    //quantidade n pode ser 0 ou negativa
    if($quantidadeAlugada <= 0) {
    $_SESSION['erroQuantidadeMuitoBaixa'] = 'Quantidade não pode ser zero ou negativa.';
    header("Location: ../php/alugarEquipamento.php?idEquipamento=" . $idEquipamento . "&tipo=" . $tipo);
    exit;

    } else {

    //insere as informações no banco de dados salvando a reserva de equipamento
    $sql = "INSERT INTO reservaEquipamento (idCliente, idEquipamento, idReservaQuadra, quantidadeAlugada) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "iiii", $idCliente, $idEquipamento, $idReservaQuadra, $quantidadeAlugada);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['equipamentoAlugadoSucesso'] = 'Equipamento alugado com sucesso.';
            header("Location: ../php/equipamentos.php");
            exit;
        } else {
            $_SESSION['erroStatement'] = 'Erro mandando informações para o banco: ' . mysqli_error($conexao);
            header("Location: ../php/equipamentos.php");
            exit;
        }

        mysqli_stmt_close($stmt);
                }
            }
        }
    }
?>

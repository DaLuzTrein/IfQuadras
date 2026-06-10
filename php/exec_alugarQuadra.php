<?php
session_start();
// exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../php/conecta.php";

$idCliente = $_POST['idCliente'];
$idQuadra = $_POST['idQuadra'];
$dataReserva = $_POST['dataReserva'];
$horarioInicio = $_POST['horarioInicio'];
$horarioFim = $_POST['horarioFim'];
$nomeQuadra = $_POST['nomeQuadra'];

    //verifica se todos os campos foram preenchidos
    if(!$idCliente || !$idQuadra || !$dataReserva || !$horarioInicio || !$horarioFim) {
    $_SESSION['erroFaltaCampos'] = 'Campos necessários não foram preenchidos.';
    header("Location: ../php/alugarQuadra.php?idQuadra=" . $idQuadra . "&nomeQuadra=" . $nomeQuadra);
    exit;

    } else {

    //verifica se a data é depois do dia atual
    if($dataReserva < date('Y-m-d')) {
    $_SESSION['erroData'] = 'Data inválida.';
    header("Location: ../php/alugarQuadra.php?idQuadra=" . $idQuadra . "&nomeQuadra=" . $nomeQuadra);
    exit;

    } else {

    //verifica o horário está no horario de funcionamento (8h às 22h)
    if($horarioInicio < '08:00' || $horarioFim > '22:00' || $horarioInicio >= $horarioFim) {
    $_SESSION['erroHorario'] = 'Horário inválido. Funcionamento: 08:00 às 22:00.';
    header("Location: ../php/alugarQuadra.php?idQuadra=" . $idQuadra . "&nomeQuadra=" . $nomeQuadra);
    exit;

    } else {

    //verifica se a quadra já está reservada no dia e horário escolhidos
    $verificaDisponibilidade = "SELECT * FROM reservaQuadra WHERE idQuadra = ? AND dataReserva = ? AND ((horarioInicio < ? AND horarioFim > ?) OR (horarioInicio < ? AND horarioFim > ?) OR (horarioInicio >= ? AND horarioFim <= ?));";
    $stmt = mysqli_prepare($conexao, $verificaDisponibilidade);
    mysqli_stmt_bind_param($stmt, "isssssss", $idQuadra, $dataReserva, $horarioFim, $horarioFim, $horarioInicio, $horarioInicio, $horarioInicio, $horarioFim);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($resultado) > 0) {
    $_SESSION['erroHorario'] = 'Horário indisponível para a data escolhida.';
    header("Location: ../php/alugarQuadra.php?idQuadra=" . $idQuadra . "&nomeQuadra=" . $nomeQuadra);
    exit;

    } else {

    //insere as informações no banco de dados salvando a reserva
    $sql = "INSERT INTO reservaQuadra (idCliente, idQuadra, dataReserva, horarioInicio, horarioFim) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "iisss", $idCliente, $idQuadra, $dataReserva, $horarioInicio, $horarioFim);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['quadraAlugadaSucesso'] = 'Quadra alugada com sucesso.';
            header("Location: ../php/quadras.php");
            exit;
        } else {
            $_SESSION['erroStatement'] = 'Erro mandando informações para o banco: ' . mysqli_error($conexao);
            header("Location: ../php/quadras.php");
            exit;
        }

        mysqli_stmt_close($stmt);
                }
            }
        }
    }
?>

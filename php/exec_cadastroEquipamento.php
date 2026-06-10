<?php
session_start();
// exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../php/conecta.php";

$tipo = $_POST['tipo'];
$quantidade = $_POST['quantidade'];
$precoEquipamento = $_POST['precoEquipamento'];

    //ajeitar o preço para entrar no banco
    $precoEquipamento = trim($precoEquipamento);
    $precoEquipamento = str_replace(',', '.', $precoEquipamento);
    $precoCerto = preg_replace('/[^0-9.\-]/', '', $precoEquipamento);

    //verifica se todos os campos foram preenchidos
    if (!$tipo || !$quantidade || $precoCerto === '') {
    $_SESSION['erroFaltaCampos'] = 'Campos necessários não foram preenchidos.';
    header("Location: ../php/cadastroEquipamento.php");
    exit;
    } else {
        //verifica se um animal não botou um texto no lugar do preço
    if (!is_numeric($precoCerto)) {
        $_SESSION['erroTamanhoPreco'] = 'Preço inválido.';
        header("Location: ../php/cadastroEquipamento.php");
        exit;
    }
    $precoEquipamento = (float) $precoCerto;

    //insere as informações no banco salvando a quadra
    $sql = "INSERT INTO equipamento (tipo, quantidade, precoEquipamento) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sid", $tipo, $quantidade, $precoEquipamento);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['equipamentoCriado'] = 'Equipamento criado com sucesso.';
            header("Location: ../php/administrarEquipamentos.php");
            exit;
        } else {
            echo 'Erro mandando informações para o banco: ' . mysqli_error($conexao);
        }

        mysqli_stmt_close($stmt);
        }

?>

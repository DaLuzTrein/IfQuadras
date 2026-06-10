<?php
session_start();
// exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../php/conecta.php";

$nomeQuadra = $_POST['nomeQuadra'] ?? '';
$tipoMaterial = $_POST['tipoMaterial'] ?? '';
$esporte = $_POST['esporte'] ?? '';
$precoQuadra = $_POST['precoQuadra'] ?? '';

    //ajeitar o preço para entrar no banco
    $precoQuadra = trim($precoQuadra);
    $precoQuadra = str_replace(',', '.', $precoQuadra);
    $precoCerto = preg_replace('/[^0-9.\-]/', '', $precoQuadra);

    //verifica se todos os campos foram preenchidos
    if (!$nomeQuadra || !$tipoMaterial || !$esporte || $precoCerto === '') {
    $_SESSION['erroFaltaCampos'] = 'Campos necessários não foram preenchidos.';
    header("Location: ../php/cadastroQuadra.php");
    exit;
    } else {
        //verifica se um animal não botou um texto no lugar do preço
    if (!is_numeric($precoCerto)) {
        $_SESSION['erroTamanhoPreco'] = 'Preço inválido.';
        header("Location: ../php/cadastroQuadra.php");
        exit;
    }
    $precoQuadra = (float) $precoCerto;

    //insere as informações no banco salvando a quadra
    $sql = "INSERT INTO quadra (nomeQuadra, tipoMaterial, esporte, precoQuadra) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sssd", $nomeQuadra, $tipoMaterial, $esporte, $precoQuadra);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['quadraCriada'] = 'Quadra criada com sucesso.';
            header("Location: ../php/administrarQuadras.php");
            exit;
        } else {
            $_SESSION['erroStatement'] = 'Erro mandando informações para o banco: ' . mysqli_error($conexao);
            header("Location: ../php/cadastroQuadra.php");
            exit;
        }

        mysqli_stmt_close($stmt);
        }

?>

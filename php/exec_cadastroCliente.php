<?php
session_start();
// exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../php/conecta.php";

$nomeCliente = $_POST['nomeCliente'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
    //verifica se todos os campos foram preenchidos
    if(!$nomeCliente || !$cpf || !$telefone) {
    $_SESSION['erroFaltaCampos'] = 'Campos necessários não foram preenchidos.';
    header("Location: ../php/cadastroCliente.php");
    exit;

    } else {
    //verifica se o tamanho do cpf é valido
    if(strlen($cpf) != 11) {
    $_SESSION['erroTamanhoCpf'] = 'Tamanho de CPF inválido.';
    header("Location: ../php/cadastroCliente.php");
    exit;

    } else {
    //verifica se o tamanho do telefone é valido
    if(strlen($telefone) != 11) {
    $_SESSION['erroTamanhoTelefone'] = 'Tamanho de telefone inválido.';
    header("Location: ../php/cadastroCliente.php");
    exit;

    } else {
    //verifica se o tamanho do nome é valido
    if(strlen($nomeCliente) > 100 || strlen($nomeCliente) < 4) {
    $_SESSION['erroTamanhoNome'] = 'Tamanho de nome inválido.';
    header("Location: ../php/cadastroCliente.php");
    exit;

    } else {

    //insere as informações no banco de dados salvando o cliente
    $sql = "INSERT INTO cliente (nomeCliente, cpf, telefone) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $nomeCliente, $cpf, $telefone);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['cadastroFeito'] = 'Cliente criado com sucesso.';
            header("Location: ../php/administrarClientes.php");
            exit;
        } else {
            $_SESSION['erroStatement'] = 'Erro mandando informações para o banco: ' . mysqli_error($conexao);
            header("Location: ../php/cadastroCliente.php");
            exit;
        }

        mysqli_stmt_close($stmt);
                }
            }
        }
    }
?>

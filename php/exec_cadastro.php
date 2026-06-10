<?php
session_start();
// exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../php/conecta.php";

$nomeLogin = $_POST['nomeLogin'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];
    //verifica se todos os campos foram preenchidos
    if(!$nomeLogin || !$email || !$senha || !$cpf) {
    $_SESSION['erroFaltaCampos'] = 'Campos necessários não foram preenchidos.';
    header("Location: ../php/cadastro.php");
    exit;

    } else {
    //verifica se o tamanho da senha é valido
    if(strlen($senha) > 16 || strlen($senha) < 4) {
    $_SESSION['erroTamanhoSenha'] = 'Tamanho de senha inválido.';
    header("Location: ../php/cadastro.php");
    exit;

    } else {
    //verifica se o tamanho do email é valido
    if(strlen($email) > 100 || strlen($email) < 4) {
    $_SESSION['erroTamanhoEmail'] = 'Tamanho de email inválido.';
    header("Location: ../php/cadastro.php");
    exit;

    } else {
    //verifica se o tamanho do nome é valido
    if(strlen($nomeLogin) > 100 || strlen($nomeLogin) < 4) {
    $_SESSION['erroTamanhoNome'] = 'Tamanho de nome inválido.';
    header("Location: ../php/cadastro.php");
    exit;

    } else {
    //verifica se o tamanho do cpf é valido
    if(strlen($cpf) != 11) {
    $_SESSION['erroTamanhoCpf'] = 'Tamanho de CPF inválido.';
    header("Location: ../php/cadastro.php");
    exit;

    } else {

    //verifica se o email é valido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['erroEmailInvalido'] = 'Email inválido.';
    header("Location: ../php/cadastro.php");
    exit;
    }
    //verificar se o email ja existe
    $verificarEmail = "SELECT email FROM login WHERE email = ?";
    $stmtVerificarEmail = mysqli_prepare($conexao, $verificarEmail);
    mysqli_stmt_bind_param($stmtVerificarEmail, "s", $email);
    mysqli_stmt_execute($stmtVerificarEmail);
    mysqli_stmt_store_result($stmtVerificarEmail);

    // se ja existir manda a mensagem de email repetido
    if(mysqli_stmt_num_rows($stmtVerificarEmail) > 0){
        $_SESSION['erroEmailRepetido'] = 'Email já existe.';
            header("Location: ../php/cadastro.php");
            exit;
    } else {
    
    // verificar se o cpf está anexado com uma conta cliente
    $verificarCpfCliente = "SELECT cpf FROM cliente WHERE cpf = ?";
    $stmtVerificarCpfCliente = mysqli_prepare($conexao, $verificarCpfCliente);
    mysqli_stmt_bind_param($stmtVerificarCpfCliente, "s", $cpf);
    mysqli_stmt_execute($stmtVerificarCpfCliente);
    mysqli_stmt_store_result($stmtVerificarCpfCliente);

    // se ja existir anexa a conta de cliente a este login
    if(mysqli_stmt_num_rows($stmtVerificarCpfCliente) < 1){
        $_SESSION['erroClienteNaoCriado'] = 'Este CPF não está anexado a nenhum cliente, peça para um ADM criar sua conta de cliente.';
            header("Location: ../php/cadastro.php");
            exit;
    } else {
    $pegarIdCliente = "SELECT idCliente FROM cliente WHERE cpf = ?";
    $stmtPegarIdCliente = mysqli_prepare($conexao, $pegarIdCliente);
    mysqli_stmt_bind_param($stmtPegarIdCliente, "s", $cpf);
    mysqli_stmt_execute($stmtPegarIdCliente);
    mysqli_stmt_store_result($stmtPegarIdCliente);
        if (mysqli_stmt_num_rows($stmtPegarIdCliente) > 0) {
        mysqli_stmt_bind_result($stmtPegarIdCliente, $idCliente);
        mysqli_stmt_fetch($stmtPegarIdCliente);

    //verificar se o cpf do cliente ja está anexado a um login
    $verificarCpfLogin = "SELECT idCliente FROM login WHERE idCliente = ?";
    $stmtVerificarCpfLogin = mysqli_prepare($conexao, $verificarCpfLogin);
    mysqli_stmt_bind_param($stmtVerificarCpfLogin, "i", $idCliente);
    mysqli_stmt_execute($stmtVerificarCpfLogin);
    mysqli_stmt_store_result($stmtVerificarCpfLogin);

    // se ja existir manda a mensagem de cpf repetido
    if(mysqli_stmt_num_rows($stmtVerificarCpfLogin) > 0){
        $_SESSION['erroCpfJaAnexado'] = 'Este CPF já está anexado a outra conta.';
            header("Location: ../php/cadastro.php");
            exit;
    } else {

    //converter a senha para hash
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    //insere as informações no banco de dados salvando a conta
    $sql = "INSERT INTO login (nomeLogin, email, senha, idCliente) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $nomeLogin, $email, $hash, $idCliente);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['cadastroFeito'] = 'Conta criada com sucesso.';
            header("Location: ../php/homepagelogin.php");
            exit;
        } else {
            $_SESSION['erroStatement'] = 'Erro mandando informações para o banco: ' . mysqli_error($conexao);
            header("Location: ../php/cadastro.php");
            exit;
        }

        mysqli_stmt_close($stmt);
                }
            }
        }
    }
}
}
}
    }
    }
?>

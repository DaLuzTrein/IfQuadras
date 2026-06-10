<?php
session_start();
// exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../php/conecta.php";
$email = $_POST['email'];
$senha = $_POST['senha'];

    //verifica se todos os campos foram preenchidos
    if(!$email || !$senha) {
    $_SESSION['erroFaltaCampos'] = 'Campos necessários não foram preenchidos';
    header("Location: ../php/login.php");
    exit;

    } else {

$sql = "SELECT * FROM login WHERE email = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if(!$resultado){
    $erro = mysqli_errno($conexao) == 1045 ? 'nao encontrado' : 'outro';
    mysqli_close($conexao);
    header("Location: ../php/login.php?erro=$erro");
    exit;
}
if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    //verificar se a senha está correta
    if (password_verify($senha, $usuario['senha'])) {
        //sucesso

        //informações do usuario guardadas na sessão
        $_SESSION['idUsuario'] = $usuario['idLogin'];
        $_SESSION['nomeUsuario'] = $usuario['nomeLogin'];
        $_SESSION['adm'] = (bool)$usuario['adm'];
        $_SESSION['idCliente'] = $usuario['idCliente'];
        //diferencia se é um usuario ou um adm
        if ($usuario['adm']) {
            //se for admin
            header("Location: ../php/homepageAdmin.php");
        } else {
            //se for usuario
            header("Location: ../php/homepage.php");
        }
            exit;

    } else {
        //senha incorreta
        $_SESSION['loginErroSenha'] = 'Senha incorreta.';
        header("Location: ../php/login.php");
        exit;
    }
    } else {
    //email não encontrado
    $_SESSION['loginErroEmail'] = 'Email não encontrado.';
    header("Location: ../php/login.php");
    exit;
    }

mysqli_close($conexao);
    }
?>

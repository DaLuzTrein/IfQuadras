<?php
session_start();

require_once "../php/conecta.php";

$idLogin = $_SESSION['idUsuario'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar'];

    if(!$confirmar || $confirmar != "Confirmar") {
    $_SESSION['faltaConfirmar'] = 'Confirmação necessária para a exclusão da conta.';
    header("Location: ../php/configuracoesUsuario.php");
    exit;

    } else {

    if(!$senha) {
    $_SESSION['faltaSenha'] = 'Senha necessária para a exclusão da conta.';
    header("Location: ../php/configuracoesUsuario.php");
    exit;

    } else {

        $sqlVerificarSenha = "SELECT senha FROM login WHERE idLogin = $idLogin";
        $resultado = mysqli_query($conexao, $sqlVerificarSenha);

        if($resultado && mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $senhaAtual = $linha['senha'];

    if(password_verify($senha, $senhaAtual)) {
        $sql = "DELETE FROM login WHERE idLogin = $idLogin";

        if(mysqli_query($conexao, $sql)){
            $_SESSION['contaApagada'] = 'Conta excluída com sucesso.';
             header("Location: ../php/homepagelogin.php");
            exit;
        }
              }
            }
        }
    }
?>
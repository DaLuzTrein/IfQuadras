<?php
session_start();

require_once "../php/conecta.php";

$idLogin = $_SESSION['idUsuario'];
$senhaNova = $_POST['senhaNova'];
$senhaAntiga = $_POST['senhaAntiga'];

    if(!$senhaNova || !$senhaAntiga) {
    $_SESSION['erroFaltaCamposSenha'] = 'Campos necessários não foram preenchidos.';
    header("Location: ../php/configuracoesUsuario.php");
    exit;

    } else {

    if(strlen($senhaNova) < 4) {
    $_SESSION['senhaMuitoCurta'] = 'Senha muito curta.';
    header("Location: ../php/configuracoesUsuario.php");
    exit;

    } else {

$hashNovo = password_hash($senhaNova, PASSWORD_DEFAULT);

$sqlVerificarSenha = "SELECT senha FROM login WHERE idLogin = $idLogin";
$resultado = mysqli_query($conexao, $sqlVerificarSenha);

if($resultado && mysqli_num_rows($resultado) > 0){
    $linha = mysqli_fetch_assoc($resultado);
    $senhaAtual = $linha['senha'];

    if(password_verify($senhaAntiga, $senhaAtual)) {
        $sqlAtualizarSenha = "UPDATE login SET senha = ? WHERE idLogin = ?";

        $stmt = mysqli_prepare($conexao, $sqlAtualizarSenha);
        mysqli_stmt_bind_param($stmt, "si", $hashNovo, $idLogin);

    if(mysqli_stmt_execute($stmt)){
            $_SESSION['senhaAlteradaSucesso'] = 'Senha alterada com sucesso!';
            header("Location: ../php/configuracoesUsuario.php");
            exit;
    } else {
            $_SESSION['senhaAlteradaErro'] = 'Houve um erro ao alterar sua senha.';
            header("Location: ../php/configuracoesUsuario.php");
            exit;
    }
    mysqli_stmt_close($stmt);
    } else {
        $_SESSION['senhaAntigaErrada'] = 'Senha antiga incorreta.';
        header("Location: ../php/configuracoesUsuario.php");
        exit;
        }
        }
    }
}
?>
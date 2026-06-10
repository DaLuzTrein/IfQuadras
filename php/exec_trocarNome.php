<?php
session_start();

require_once "../php/conecta.php";

$idLogin = $_SESSION['idUsuario'];
$nomeNovo = $_POST['nomeNovo'];

    if(!$nomeNovo) {
    $_SESSION['erroFaltaCamposNome'] = 'Nome não pode ser vazio.';
    header("Location: ../php/configuracoesUsuario.php");
    exit;

    } else {

    if(strlen($nomeNovo) < 4) {
    $_SESSION['erroNomeCurto'] = 'Nome muito curto.';
    header("Location: ../php/configuracoesUsuario.php");
    exit;

    } else {

        $sqlMudarNome = "UPDATE login SET nomeLogin = ? WHERE idLogin = ?";

        $stmt = mysqli_prepare($conexao, $sqlMudarNome);
        mysqli_stmt_bind_param($stmt, "si", $nomeNovo, $idLogin);

    if(mysqli_stmt_execute($stmt)){
            $_SESSION['nomeAlteradoSucesso'] = 'Nome alterado com sucesso!';
            header("Location: ../php/configuracoesUsuario.php");
            exit;
    } else {
            $_SESSION['nomeAlteradoErro'] = 'Houve um erro ao alterar seu nome.';
            header("Location: ../php/configuracoesUsuario.php");
            exit;
    }
    mysqli_stmt_close($stmt);
            }
        }
?>
<?php
include '../php/deslogar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IfQuadras</title>
    <link rel="stylesheet" href="../css/style_login.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../imagens/if.png" type="image/x-icon">

</head>
<body>
        <header>
            <img src = "../imagens/ifquadras.png" class = "logo">
        </header>
        <div class="container1">
            <div class="container2">
                <div class="caixa" style="height:85%; padding-top: 0">
                <form action="../php/exec_cadastro.php" method="post" enctype="multipart/form-data">
                    <h2> Cadastro </h2>
                    <br>
                    <?php
                    if (isset($_SESSION['erroFaltaCampos'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroFaltaCampos'] . "</p>";
                    unset($_SESSION['erroFaltaCampos']);
                    }
                    if (isset($_SESSION['erroStatement'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroStatement'] . "</p>";
                    unset($_SESSION['erroStatement']);
                    }
                    ?>
                <label> Nome de usuario <label><br>
                <input type = "text" name="nomeLogin" id="nome" size="50"><br>
                <?php
                    if (isset($_SESSION['erroTamanhoNome'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoNome'] . "</p>";
                    unset($_SESSION['erroTamanhoNome']);
                    }
                ?>
                <label> Email de usuario <label><br>
                <input type = "text" name="email" id="email" size="50"><br>
                    <?php
                    if (isset($_SESSION['erroTamanhoEmail'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoEmail'] . "</p>";
                    unset($_SESSION['erroTamanhoEmail']);
                    }
                    if (isset($_SESSION['erroEmailRepetido'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroEmailRepetido'] . "</p>";
                    unset($_SESSION['erroEmailRepetido']);
                    }
                    if (isset($_SESSION['erroEmailInvalido'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroEmailInvalido'] . "</p>";
                    unset($_SESSION['erroEmailInvalido']);
                    }
                    ?>
                <label> Senha do usuario <label><br>
                <input type = "password" name="senha" id="senha" size="50"><br>
                <?php
                if (isset($_SESSION['erroTamanhoSenha'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoSenha'] . "</p>";
                    unset($_SESSION['erroTamanhoSenha']);
                    }
                ?> 
                <label> CPF <label><br>
                <?php
                if (isset($_SESSION['erroTamanhoCpf'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoCpf'] . "</p>";
                    unset($_SESSION['erroTamanhoCpf']);
                    }
                if (isset($_SESSION['erroClienteNaoCriado'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroClienteNaoCriado'] . "</p>";
                    unset($_SESSION['erroClienteNaoCriado']);
                    }
                if (isset($_SESSION['erroCpfJaAnexado'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroCpfJaAnexado'] . "</p>";
                    unset($_SESSION['erroCpfJaAnexado']);
                    }
                ?> 
                <input type = "text" name="cpf" id="cpf" size="50"><br> <br>
                <button class="gremio">Enviar</button> <br> <br>
                </form>
                     <button type="button" onclick="window.location.href='../php/homepagelogin.php'" class="inter"> Voltar </button> 
                </div>
            </div>
        </div>
</body>
</html>
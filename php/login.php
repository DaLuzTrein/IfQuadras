<?php
include '../php/deslogar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IfQuadras</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_login.css">
    <link rel="shortcut icon" href="../imagens/if.png" type="image/x-icon">

</head>
<body>
        <header>
            <img src = "../imagens/ifquadras.png" class = "logo">
        </header>
        <div class="container1">
            <div class="container2">
                <div class="caixa">
                <form action="../php/exec_login.php" method="post" enctype="multipart/form-data">
                <h2> Login </h2>
                <br>
                <?php
                    if (isset($_SESSION['erroFaltaCampos'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroFaltaCampos'] . "</p>";
                    unset($_SESSION['erroFaltaCampos']);
                    }
                    if (isset($_SESSION['naoLogado'])) {
                    echo "<p style='color: red;'>" . $_SESSION['naoLogado'] . "</p>";
                    unset($_SESSION['naoLogado']);
                    }
                    if (isset($_SESSION['naoADM'])) {
                    echo "<p style='color: red;'>" . $_SESSION['naoADM'] . "</p>";
                    unset($_SESSION['naoADM']);
                    }
                ?>
                <label> Email <label><br>
                <input type = "text" name="email" id="email" size="50"><br>
                <?php
                    if (isset($_SESSION['loginErroEmail'])) {
                        echo "<p style='color: red;'>" . $_SESSION['loginErroEmail'] . "</p>";
                        unset($_SESSION['loginErroEmail']);
                    }
                ?> <br>
                <label> Senha <label><br>
                <input type = "password" name="senha" id="senha" size="50"><br>
                <?php
                    if (isset($_SESSION['loginErroSenha'])) {
                        echo "<p style='color: red;'>" . $_SESSION['loginErroSenha'] . "</p>";
                        unset($_SESSION['loginErroSenha']);
                    }
                ?>
                <br>
                <button class="gremio">Enviar</button> <br> <br>
                </form>
                <a href="../php/homepagelogin.php">
                     <button class="inter" type="button"> Voltar </button> 
                </a>
                </div>
            </div>
        </div>
</body>
</html>
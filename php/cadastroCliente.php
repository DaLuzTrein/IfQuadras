<?php
require '../php/protecao_adm.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IfQuadras</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_admin.css">
    <link rel="shortcut icon" href="../imagens/if.png" type="image/x-icon">

</head>
<body>
        <header>
            <img src = "../imagens/ifquadras.png" class = "logo">
        </header>
        <div class="container1">
            <div class="container2">
                <div class="caixa" style="height:85%; padding-top: 2%; width: 700px;">
                <form action="../php/exec_cadastroCliente.php" method="post" enctype="multipart/form-data">
                    <h2> Cadastrar cliente </h2>
                    <br>
                    <?php
                    if (isset($_SESSION['erroFaltaCampos'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroFaltaCampos'] . "</p>";
                    unset($_SESSION['erroFaltaCampos']);
                    }
                    ?>
                <label> Nome de usuario <label><br>
                <input type = "text" name="nomeCliente" id="nome" size="50"><br>
                <?php
                    if (isset($_SESSION['erroTamanhoNome'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoNome'] . "</p>";
                    unset($_SESSION['erroTamanhoNome']);
                    }
                ?>
                <label> CPF <label><br>
                <input type = "text" name="cpf" id="cpf" size="50"><br>
                <?php
                    if (isset($_SESSION['erroTamanhoCpf'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoCpf'] . "</p>";
                    unset($_SESSION['erroTamanhoCpf']);
                    }
                ?>
                <label> Telefone <label><br>
                <input type = "text" name="telefone" id="telefone" size="50"><br> <br>
                <?php
                    if (isset($_SESSION['erroTamanhoTelefone'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoTelefone'] . "</p>";
                    unset($_SESSION['erroTamanhoTelefone']);
                    }
                ?>
                <button class="gremio">Enviar</button> <br> 
                </form>
                     <button type="button" onclick="window.location.href='../php/administrarClientes.php'" class="inter"> Voltar </button> 
                </div>
            </div>
        </div>
</body>
</html>
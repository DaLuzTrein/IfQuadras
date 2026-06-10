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
                <form action="../php/exec_cadastroEquipamento.php" method="post" enctype="multipart/form-data">
                    <h2> Cadastrar equipamento </h2>
                    <br>
                    <?php
                    if (isset($_SESSION['erroFaltaCampos'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroFaltaCampos'] . "</p>";
                    unset($_SESSION['erroFaltaCampos']);
                    }
                    ?>
                <label> Nome do equipamento <label><br>
                <input type = "text" name="tipo" id="tipo" size="50"><br>
                <label> Quantidade <label><br>
                <input type = "text" name="quantidade" id="quantidade" size="50"><br>
                <label> Preço <label><br>
                <input type="number" name="precoEquipamento" id="precoEquipamento" step="0.01" min="0" inputmode="decimal" placeholder="0.00"><br> <br>
                <?php
                    if (isset($_SESSION['erroTamanhoPreco'])) {
                    echo "<p style='color: red;'>" . $_SESSION['erroTamanhoPreco'] . "</p>";
                    unset($_SESSION['erroTamanhoPreco']);
                    }
                ?>
                <button class="gremio">Enviar</button> <br> 
                </form>
                     <button type="button" onclick="window.location.href='../php/administrarEquipamentos.php'" class="inter"> Voltar </button> 
                </div>
            </div>
        </div>
</body>
</html>
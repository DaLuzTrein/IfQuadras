<?php
require '../php/protecao_usuario.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IfQuadras</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_homepage.css">
    <link rel="shortcut icon" href="../imagens/if.png" type="image/x-icon">
</head>
<body>
        <header>
            <img src = "../imagens/ifquadras.png" class = "logo">
        </header>
        <div class="container1">
            <div class="container2">
                <div class="caixa" style="margin-top: 5%;">
                    <?php
                    echo "<h1>Seja bem vindo ao IfQuadras, " . $_SESSION['nomeUsuario'] . "</h1>";
                    ?>
                    <div class="botoes">
                    <button onclick="window.location.href='../php/quadras.php'" class="botaoSelecao esquerda">Quadras</button>
                    <button onclick="window.location.href='../php/reservas.php'" class="botaoSelecao meio">Reservas</button>
                    <button onclick="window.location.href='../php/equipamentos.php'" class="botaoSelecao direita">Equipamentos</button>
                    </div>
                </div>
            </div>
            <button  onclick="window.location.href='../php/configuracoesUsuario.php'" class="botaoConfig"> 
                <img src = "../imagens/configuracoesIcone.png">
            </button>
        </div>
</body>
</html>
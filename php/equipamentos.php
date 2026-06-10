<?php
require '../php/protecao_usuario.php';
require_once '../php/conecta.php';
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

<body class="tela">
    <header>
        <img src="../imagens/ifquadras.png" class="logo">
    </header>
    <div class="container1">
        <div class="estante equipamentos">
            <?php
                    if (isset($_SESSION['equipamentoAlugadoSucesso'])) {
                        echo "<p style='color: lightgreen; font-size:1.5rem'>" . $_SESSION['equipamentoAlugadoSucesso'] . "</p>";
                        unset($_SESSION['equipamentoAlugadoSucesso']);
                        }
                ?>
            <button type="button" onclick="window.location.href='../php/homepage.php'" class="inter"> Voltar </button>
            <h1>Alugar equipamentos</h1>
            <?php
            $pegarEquipamentos = "SELECT * FROM equipamento;";
            $resultado = mysqli_query($conexao, $pegarEquipamentos);

            if (mysqli_num_rows($resultado) < 1) {
                echo "Sem equipamentos encontrados";
            } else {
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo '
                    <div class="prateleira" onclick="window.location.href=\'../php/alugarEquipamento.php?idEquipamento=' . $linha['idEquipamento'] . '&tipo=' . $linha['tipo'] . '\'">
                        <p> Equipamento: ' . $linha['tipo'] . ' </p>
                        <p> Quantidade: ' . $linha['quantidade'] . ' </p>
                        <p> Preço: ' . $linha['precoEquipamento'] . ' </p>
                    </div> ';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
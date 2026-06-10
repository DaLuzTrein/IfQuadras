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
            <div class="estante">
                <?php
                    if (isset($_SESSION['quadraAlugadaSucesso'])) {
                        echo "<p style='color: lightgreen; font-size:1.5rem'>" . $_SESSION['quadraAlugadaSucesso'] . "</p>";
                        unset($_SESSION['quadraAlugadaSucesso']);
                        }
                ?>
                <button type="button" onclick="window.location.href='../php/homepage.php'" class="inter"> Voltar </button>
                <h1>Alugar quadras</h1>
                <?php
                $pegarQuadras = "SELECT * FROM quadra;";
                $resultado = mysqli_query($conexao, $pegarQuadras);

                if (mysqli_num_rows($resultado) < 1) {
                    echo "Sem quadras encontradas";
                } else {
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        echo '
                        <div class="prateleira" onclick="window.location.href=\'../php/alugarQuadra.php?idQuadra=' . $linha['idQuadra'] . '&nomeQuadra=' . $linha['nomeQuadra'] . '&precoQuadra=' . $linha['precoQuadra'] .'\'">
                            <p> ID: ' . $linha['idQuadra'] . ' </p>
                            <p> Nome: ' . $linha['nomeQuadra'] . ' </p>
                            <p> Material: ' . $linha['tipoMaterial'] . ' </p>
                            <p> Esporte: ' . $linha['esporte'] . ' </p> 
                            <p> Preço: ' . $linha['precoQuadra'] . ' </p> 
                        </div> ';
                    }
                }
                ?>
            </div>
    </div>
</body>

</html>
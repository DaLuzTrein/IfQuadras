<?php
require '../php/protecao_adm.php';
require_once '../php/conecta.php';
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
<body class="tela">
            <header>
            <img src = "../imagens/ifquadras.png" class = "logo">
        </header>
            <div class="container1">
                <div class="container2">
                    <div class="caixa">
                            <?php
                            if (isset($_SESSION['quadraExcluida'])) {
                                echo "<p class='sucessoAviso'>" . $_SESSION['quadraExcluida'] . "</p>";
                                unset($_SESSION['quadraExcluida']);
                                }
                            if (isset($_SESSION['quadraCriada'])) {
                                echo "<p class='sucessoAviso'>" . $_SESSION['quadraCriada'] . "</p>";
                                unset($_SESSION['quadraCriada']);
                                }
                            ?> 
                            <button class="botaoAdicionar" onclick="window.location.href='../php/cadastroQuadra.php'"> Adicionar nova quadra </button>
                            <button type="button" onclick="window.location.href='../php/homepageAdmin.php'" class="inter"> Voltar </button> 
                            <h1>Administrar quadras</h1>
                        <?php
                            $pegarQuadras = "SELECT * FROM quadra;";
                            $resultado = mysqli_query($conexao, $pegarQuadras);

                            if(mysqli_num_rows($resultado) < 1){
                               echo "Sem quadras encontradas";
                            } else {
                                while($linha = mysqli_fetch_assoc($resultado)){
                                    echo '
                                    <div class="cliente">
                                        <p> ID: ' . $linha['idQuadra'] . ' </p>
                                        <p> Nome: ' . $linha['nomeQuadra'] . ' </p>
                                        <p> Material: ' . $linha['tipoMaterial'] . ' </p>
                                        <p> Esporte: ' . $linha['esporte'] . ' </p> 
                                        <p> Preço: ' . $linha['precoQuadra'] . ' </p> 
                                        <form action="../php/exec_excluirQuadra.php" method="POST" onsubmit="return confirm(\'Excluir ' . $linha['nomeQuadra'] . '?\');">
                                        <input type="hidden" name="idQuadra" value="' . $linha['idQuadra'] . '">
                                        <input type="hidden" name="nomeQuadra" value="' . $linha['nomeQuadra'] . '">
                                        <input type="hidden" name="confirmar" value="sim">
                                        <button class="botaoExcluir"> Excluir </button></form>
                                    </div> ';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
</body>
</html>
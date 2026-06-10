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
                            if (isset($_SESSION['equipamentoExcluido'])) {
                                echo "<p class='sucessoAviso'>" . $_SESSION['equipamentoExcluido'] . "</p>";
                                unset($_SESSION['equipamentoExcluido']);
                                }
                            if (isset($_SESSION['equipamentoCriado'])) {
                                echo "<p class='sucessoAviso'>" . $_SESSION['equipamentoCriado'] . "</p>";
                                unset($_SESSION['equipamentoCriado']);
                                }
                            ?> 
                            <button class="botaoAdicionar" onclick="window.location.href='../php/cadastroEquipamento.php'"> Adicionar novo equipamento </button>
                            <button type="button" onclick="window.location.href='../php/homepageAdmin.php'" class="inter"> Voltar </button> 
                            <h1>Administrar equipamentos</h1>
                        <?php
                            $pegarEquipamentos = "SELECT * FROM equipamento;";
                            $resultado = mysqli_query($conexao, $pegarEquipamentos);

                            if(mysqli_num_rows($resultado) < 1){
                               echo "Sem equipamentos encontrados";
                            } else {
                                while($linha = mysqli_fetch_assoc($resultado)){
                                    echo '
                                    <div class="cliente">
                                        <p> ID: ' . $linha['idEquipamento'] . ' </p>
                                        <p> Equipamento: ' . $linha['tipo'] . ' </p>
                                        <p> Quantidade: ' . $linha['quantidade'] . ' </p>
                                        <div class="ajustarQuantidadeEquipamento">
                                        <form action="../php/exec_modificarEquipamento.php" method="POST">
                                        <input type="hidden" name="idEquipamento" value="' . $linha['idEquipamento'] . '">
                                        <input type="number" name="quantidade" placeholder="' . $linha['quantidade'] . '" min="0" class="medidorQuantidadeEquipamento" required>
                                        <button class="botaoAlterarQuantidadeEquipamento"> Alterar quantidade </button>
                                        </form>
                                        </div>
                                        <p> Preço: ' . $linha['precoEquipamento'] . ' </p>
                                        <form action="../php/exec_excluirEquipamento.php" method="POST" onsubmit="return confirm(\'Excluir ' . $linha['tipo'] . '?\');">
                                        <input type="hidden" name="idEquipamento" value="' . $linha['idEquipamento'] . '">
                                        <input type="hidden" name="tipo" value="' . $linha['tipo'] . '">
                                        <input type="hidden" name="confirmar" value="sim">
                                        <button class="botaoExcluir"> Excluir </button>
                                        </form>
                                        </div> ';
                                    
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
</body>
</html>
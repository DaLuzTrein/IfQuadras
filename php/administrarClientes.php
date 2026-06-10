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
                            if (isset($_SESSION['clienteExcluido'])) {
                                echo "<p class='sucessoAviso'>" . $_SESSION['clienteExcluido'] . "</p>";
                                unset($_SESSION['clienteExcluido']);
                                }
                            if (isset($_SESSION['cadastroFeito'])) {
                                echo "<p class='sucessoAviso'>" . $_SESSION['cadastroFeito'] . "</p>";
                                unset($_SESSION['cadastroFeito']);
                                }
                            ?> 
                            <?php
                            $sqlClienteBurgueses = "SELECT idCliente FROM clientesBurgueses;";
                            $resultadoBurgueses = mysqli_query($conexao, $sqlClienteBurgueses);
                            $clientesBurgueses = array();
                            while($linhaBurgueses = mysqli_fetch_assoc($resultadoBurgueses)){
                                $clientesBurgueses[] = $linhaBurgueses['idCliente'];
                            }
                            
                            $sqlTotalGastoPorCliente = "SELECT * FROM totalGastoPorCliente;";
                            $resultadoTotalGasto = mysqli_query($conexao, $sqlTotalGastoPorCliente);
                            $totalGastoPorCliente = array();
                            while($linhaGasto = mysqli_fetch_assoc($resultadoTotalGasto)){
                                $totalGastoPorCliente[$linhaGasto['idCliente']] = $linhaGasto['precoTotal'];
                            }
                            ?> 
                            <button class="botaoAdicionar" onclick="window.location.href='../php/cadastroCliente.php'"> Adicionar novo cliente </button>
                            <button type="button" onclick="window.location.href='../php/homepageAdmin.php'" class="inter"> Voltar </button> 
                            <h1>Administrar clientes</h1>
                        <?php
                            $pegarClientes = "SELECT * FROM cliente;";
                            $resultado = mysqli_query($conexao, $pegarClientes);

                            if(mysqli_num_rows($resultado) < 2){
                               echo "Sem cliente encontrados";
                            } else {
                                while($linha = mysqli_fetch_assoc($resultado)){
                                    if($linha['idCliente']!= 1){ 
                                        if(in_array($linha['idCliente'], $clientesBurgueses)){
                                        echo '
                                            <div class="clienteBurgues">
                                        <p> ID: ' . $linha['idCliente'] . ' </p>
                                        <p> Nome: ' . $linha['nomeCliente'] . ' </p>
                                        <p> CPF: ' . $linha['cpf'] . ' </p>
                                        <p> Telefone: ' . $linha['telefone'] . ' </p> 
                                        <p> Total gasto: R$ ' . number_format($totalGastoPorCliente[$linha['idCliente']], 2, ',', '.') . ' </p>
                                        ';
                                        
                                        echo '
                                        <form action="../php/exec_excluirCliente.php" method="POST" onsubmit="return confirm(\'Excluir ' . $linha['nomeCliente'] . '?\');">
                                        <input type="hidden" name="idCliente" value="' . $linha['idCliente'] . '">
                                        <input type="hidden" name="nomeCliente" value="' . $linha['nomeCliente'] . '">
                                        <input type="hidden" name="confirmar" value="sim">
                                        <button class="botaoExcluir"> Excluir </button></form>
                                        </div> ';
                                        } else {
                                    echo '
                                    <div class="cliente">
                                        <p> ID: ' . $linha['idCliente'] . ' </p>
                                        <p> Nome: ' . $linha['nomeCliente'] . ' </p>
                                        <p> CPF: ' . $linha['cpf'] . ' </p>
                                        <p> Telefone: ' . $linha['telefone'] . ' </p> 
                                        <p> Total gasto: R$ ' . number_format($totalGastoPorCliente[$linha['idCliente']], 2, ',', '.') . ' </p>
                                        ';
                                        
                                        echo '
                                        <form action="../php/exec_excluirCliente.php" method="POST" onsubmit="return confirm(\'Excluir ' . $linha['nomeCliente'] . '?\');">
                                        <input type="hidden" name="idCliente" value="' . $linha['idCliente'] . '">
                                        <input type="hidden" name="nomeCliente" value="' . $linha['nomeCliente'] . '">
                                        <input type="hidden" name="confirmar" value="sim">
                                        <button class="botaoExcluir"> Excluir </button></form>
                                        </div> ';
                                    }
                                }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
</body>
</html>
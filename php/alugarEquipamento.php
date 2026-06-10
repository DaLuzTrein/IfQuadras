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
<body>
        <header>
            <img src = "../imagens/ifquadras.png" class = "logo">
        </header>
        <div class="container1">
            <div class="container2">
                <div class="caixa" style="width:45%; margin: 5% auto 0; height: 80%;">
                <form action="../php/exec_alugarEquipamento.php" method="post" enctype="multipart/form-data">
                <h2>Alugando Equipamento:</h2>
                    <?php
                        $tipo = $_GET['tipo'];
                    ?>
                <h3><?php echo $tipo ?></h3>
                <br>
                <?php
                    if (isset($_SESSION['erroFaltaCampos'])) {
                        echo "<p style='color: red'>" . $_SESSION['erroFaltaCampos'] . "</p>";
                        unset($_SESSION['erroFaltaCampos']);
                        }
                ?>
                <?php
                $idCliente = $_SESSION['idCliente'];
                $pegarReservas = "SELECT idReservaQuadra, dataReserva, horarioInicio FROM reservaQuadra WHERE idCliente = $idCliente AND dataReserva > CURDATE() ORDER BY dataReserva;";
                $resultado = mysqli_query($conexao, $pegarReservas);
                $pegarInfoEquipamento = "SELECT quantidade, precoEquipamento FROM equipamento WHERE idEquipamento = " . $_GET['idEquipamento'] . ";";
                $resultadoInfoEquipamento = mysqli_query($conexao, $pegarInfoEquipamento);
                $infoEquipamento = mysqli_fetch_assoc($resultadoInfoEquipamento);
                $quantidadeDisponivel = $infoEquipamento['quantidade'];
                $preco = $infoEquipamento['precoEquipamento'];
                ?>
                <input type = "hidden" name="tipo" value="<?php echo $tipo ?>">
                <input type = "hidden" name="quantidadeDisponivel" value="<?php echo $quantidadeDisponivel ?>">
                <input type = "hidden" name="idCliente" id="idCliente" value="<?php echo $_SESSION['idCliente'] ?>" size="50">
                <input type = "hidden" name="idEquipamento" id="idEquipamento" value="<?php echo $_GET['idEquipamento'] ?>" size="50"> <br>
                <label> Quantidade a alugar:</label> <br>
                <input type = "number" name="quantidadeAlugada" id="quantidadeAlugada" step="1" value="0" size="5" min="0" max="<?php echo $quantidadeDisponivel ?>" required> <br> <br>
                <?php
                $precoTotal = 0.00;
                ?>
                <input type="hidden" id="precoUnitario" value="<?php echo $preco ?>">
                <label> Preço total (R$):</label> <br>
                <input type = "text" name="preco" id="preco" class= "naoInteragivel" value="<?php echo number_format($precoTotal,2,'.','') ?>" readonly> <br>
                <?php
                    if (isset($_SESSION['erroQuantidadeIndisponivel'])) {
                        echo "<p style='color: red'>" . $_SESSION['erroQuantidadeIndisponivel'] . "</p>";
                        unset($_SESSION['erroQuantidadeIndisponivel']);
                        }
                    if (isset($_SESSION['erroQuantidadeMuitoBaixa'])) {
                        echo "<p style='color: red'>" . $_SESSION['erroQuantidadeMuitoBaixa'] . "</p>";
                        unset($_SESSION['erroQuantidadeMuitoBaixa']);
                        }
                ?> <br>
                <label> Quadra alugada (obrigatório):</label> <br>
                <?php
                echo '<select name="idReservaQuadra" id="idReservaQuadra" required>
                <option value="nenhuma">Nenhuma</option>';
                while($r = $resultado->fetch_assoc()) echo '<option value="' . $r['idReservaQuadra'] . '">' . date('d/m/Y',strtotime($r['dataReserva'])) . ' ' . $r['horarioInicio'] . '</option>';
                echo '</select>';
                ?>
                <?php
                    if (isset($_SESSION['erroSemReservaQuadra'])) {
                        echo "<p style='color: red'>" . $_SESSION['erroSemReservaQuadra'] . "</p>";
                        unset($_SESSION['erroSemReservaQuadra']);
                        }
                ?> <br> <br>
                <button type= "submit" class="botaoVerde">Alugar</button> <br> 
                <button type="button" onclick="window.location.href='../php/equipamentos.php'" class="inter"> Voltar </button> 
                </form>
                </div>
            </div>
        </div>
        <script>
        (function(){
            var qty = document.getElementById('quantidadeAlugada');
            var precoUnitEl = document.getElementById('precoUnitario');
            var precoInput = document.getElementById('preco');
            var maxQty = qty.getAttribute('max') ? parseInt(qty.getAttribute('max'),10) : null;
            var precoUnit = precoUnitEl ? parseFloat(precoUnitEl.value.replace(',', '.')) || 0 : 0;
            function updatePreco(){
                var q = parseInt(qty.value,10);
                if (isNaN(q) || q < 0) q = 0;
                if (maxQty !== null && q > maxQty) q = maxQty;
                var total = (precoUnit * q).toFixed(2);
                precoInput.value = total;
            }
            qty.addEventListener('input', updatePreco);
            updatePreco();
        })();
        </script>
        </body>
        </html>
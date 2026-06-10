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
                <form action="../php/exec_alugarQuadra.php" method="post" enctype="multipart/form-data">
                <h2>Alugando quadra:</h2>
                    <?php
                        $nomeQuadra = $_GET['nomeQuadra'];
                        $precoQuadra = $_GET['precoQuadra'];
                    ?>
                <h3><?php echo $nomeQuadra .' R$:' . $precoQuadra?></h3>
                <br>
                <?php
                    if (isset($_SESSION['errofaltaCampos'])) {
                        echo "<p style='color: red'>" . $_SESSION['errofaltaCampos'] . "</p>";
                        unset($_SESSION['errofaltaCampos']);
                        }
                ?>
                <input type = "hidden" name="nomeQuadra" value="<?php echo $nomeQuadra ?>">
                <input type = "hidden" name="idCliente" id="idCliente" value="<?php echo $_SESSION['idCliente'] ?>'" size="50">
                <input type = "hidden" name="idQuadra" id="idQuadra" value="<?php echo $_GET['idQuadra'] ?>" size="50">
                <label> Data da reserva:</label> <br>
                <input type = "date" name="dataReserva" id="dataReserva" required> <br>
                <?php
                    if (isset($_SESSION['erroData'])) {
                        echo "<p style='color: red'>" . $_SESSION['erroData'] . "</p>";
                        unset($_SESSION['erroData']);
                        }
                ?> <br>
                <label> Horário de início:</label> <br>
                <input type = "time" name="horarioInicio" id="horarioInicio" required> <br> <br>
                <label> Horário de término:</label> <br>
                <input type = "time" name="horarioFim" id="horarioFim" required> <br>
                <?php
                    if (isset($_SESSION['erroHorario'])) {
                        echo "<p style='color: red'>" . $_SESSION['erroHorario'] . "</p>";
                        unset($_SESSION['erroHorario']);
                        }
                ?><br>
                <button class="botaoVerde">Alugar</button> <br> 
                <button type="button" onclick="window.location.href='../php/quadras.php'" class="inter"> Voltar </button> 
                </form>
                </div>
            </div>
        </div>
</body>
</html>
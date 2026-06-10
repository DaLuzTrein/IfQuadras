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
        <img src="../imagens/ifquadras.png" class="logo">
    </header>
    <div class="container1">
        <div class="containerReservas1">
                <div class="caixaReservas">
                    <h1>Gerenciar Reservas Equipamentos</h1>
                    <?php
                    $mostrarReservasEquipamentos = "SELECT * FROM mostrarReservasEquipamentos";
                    $resultadoReservasEquipamentos = mysqli_query($conexao, $mostrarReservasEquipamentos);

                    if (mysqli_num_rows($resultadoReservasEquipamentos) < 1) {
                        echo "<p>Nenhuma reserva encontrada.</p>";
                    } else {
                        while ($reservaEquipamento = mysqli_fetch_assoc($resultadoReservasEquipamentos)) {
                            echo '
                            <div class="cliente">
                                <p>Reserva ID: ' . $reservaEquipamento['idReservaEquipamento'] . '</p>
                                <p>Cliente: ' . $reservaEquipamento['nomeCliente'] . '</p>
                                <p>Equipamento: ' . $reservaEquipamento['tipo'] . '</p>
                            </div>';
                        }
                    }
                    ?>
                    </div>
            </div>
            <button onclick="window.location.href='../php/homepageAdmin.php'" class="botaoVoltarReservas"> Voltar </button> 
            <div class="containerReservas2">
                <div class="caixaReservas">
                    <h1>Gerenciar Reservas Quadras</h1>
                    <?php
                    $mostrarReservasQuadras = "SELECT * FROM mostrarReservasQuadras";
                    $resultadoReservasQuadras = mysqli_query($conexao, $mostrarReservasQuadras);

                    if (mysqli_num_rows($resultadoReservasQuadras) < 1) {
                        echo "<p>Nenhuma reserva encontrada.</p>";
                    } else {
                        while ($reservaQuadra = mysqli_fetch_assoc($resultadoReservasQuadras)) {
                            echo '
                            <div class="cliente">
                                <p>Reserva ID: ' . $reservaQuadra['idReservaQuadra'] . '</p>
                                <p>Cliente: ' . $reservaQuadra['nomeCliente'] . '</p>
                                <p>Quadra: ' . $reservaQuadra['nomeQuadra'] . '</p>
                                <p>Data: ' . $reservaQuadra['dataReserva'] . '</p>
                                <p>Horário Início: ' . $reservaQuadra['horarioInicio'] . '</p>
                                <p>Horário Fim: ' . $reservaQuadra['horarioFim'] . '</p>
                            </div>';
                        }
                    }
                    ?>
                    </div>
                </div>
        </div>
    </div>
</body>

</html>
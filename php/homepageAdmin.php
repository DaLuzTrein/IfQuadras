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
                    <div class="caixa" style="padding-top: 5vh;"> 
                        <h1>Página de administração</h1>
                        <?php
                            echo '<h1>Número total de reservas feitas: </h1>';
                            $contarReservasEquipamentos = "SELECT * FROM numeroDeReservasDeQuadras;";
                            $resultadoEquipamentos = mysqli_query($conexao, $contarReservasEquipamentos);
                            $numeroReservasEquipamentos = mysqli_fetch_assoc($resultadoEquipamentos);
                            echo "<h2>" . $numeroReservasEquipamentos['COUNT(*)'] . "</h2>";
                        ?>
                        <div class="botoes">
                        <button class="botaoSelecao" onclick="window.location.href='../php/administrarClientes.php'">Administrar clientes</button>
                        <button class="botaoSelecao" onclick="window.location.href='../php/administrarEquipamentos.php'">Administrar equipamentos</button>
                        <button class="botaoSelecao" onclick="window.location.href='../php/administrarQuadras.php'">Administrar quadras</button>
                        </div>
                    </div>
                </div>
            <button  onclick="window.location.href='../php/administrarReservas.php'" class="botaoReservasAdmin"> 
                <img src = "../imagens/reservas.png">
            </button>
            <button  onclick="window.location.href='../php/homepagelogin.php'" class="botaoDeslogarAdmin"> 
                <img src = "../imagens/sair.png">
            </button>
            </div>
</body>
</html>
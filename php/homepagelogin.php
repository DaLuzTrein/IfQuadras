<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/style_login.css">
  <link rel="shortcut icon" href="../imagens/if.png" type="image/x-icon">
  <title>IfQuadras</title>
</head>
<body>

  <header>
      <img src="../imagens/ifquadras.png" class="logo">
  </header>

  <div class = "container1">
        <div class = "container2">
            <div class="caixa">
              <h1> Entrar no IfQuadras</h1>
                <?php
                if (isset($_SESSION['cadastroFeito'])) {
                    echo "<p style='color: lightgreen; font-size: 150%; margin:-5%;'>" . $_SESSION['cadastroFeito'] . "</p>";
                    unset($_SESSION['cadastroFeito']);
                    }
                if (isset($_SESSION['contaApagada'])) {
                    echo "<p style='color: lightgreen; font-size: 150%; margin:-5%;'>" . $_SESSION['contaApagada'] . "</p>";
                    unset($_SESSION['contaApagada']);
                    }
                ?>
                <button class = "gremio" onclick="window.location.href='../php/login.php'">Login</button>
                <button class = "inter" onclick="window.location.href='../php/cadastro.php'">Cadastro</button>

            </div>
        </div>
  </div>
</body>
</html>
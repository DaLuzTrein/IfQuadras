<?php
require '../php/protecao_usuario.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IfQuadras</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_config.css">
    <link rel="shortcut icon" href="../imagens/if.png" type="image/x-icon">
</head>
<body>
  <header>
      <img src = "../imagens/ifquadras.png" class = "logo">
  </header>
  <div class="container1">
      <div class="container2">
          <div class="caixa">
              
                  <form action="../php/exec_trocarSenha.php" method="post" enctype="multipart/form-data">
                      <h1>Configurações de Usuário</h1> <br>
                      <h2> Trocar senha </h2>
                      <?php
                        if (isset($_SESSION['erroFaltaCamposSenha'])) {
                          echo "<p style='color: red;'>" . $_SESSION['erroFaltaCamposSenha'] . "</p>";
                          unset($_SESSION['erroFaltaCamposSenha']);
                        }
                      ?>
                      <label> Senha antiga <label><br>
                      <input type = "password" name="senhaAntiga" size="50"><br>
                      <?php
                        if (isset($_SESSION['senhaAntigaErrada'])) {
                          echo "<p style='color: red;'>" . $_SESSION['senhaAntigaErrada'] . "</p>";
                          unset($_SESSION['senhaAntigaErrada']);
                        }
                      ?>
                      <label> Nova senha <label><br>
                      <input type = "password" name="senhaNova" size="50"><br> 
                      <?php
                        if (isset($_SESSION['senhaAlteradaSucesso'])) {
                          echo "<p style='color: lightgreen;'>" . $_SESSION['senhaAlteradaSucesso'] . "</p>";
                          unset($_SESSION['senhaAlteradaSucesso']);
                        }
                        if (isset($_SESSION['senhaAlteradaErro'])) {
                          echo "<p style='color: red;'>" . $_SESSION['senhaAlteradaErro'] . "</p>";
                          unset($_SESSION['senhaAlteradaErro']);
                        }
                        if (isset($_SESSION['senhaMuitoCurta'])) {
                          echo "<p style='color: red;'>" . $_SESSION['senhaMuitoCurta'] . "</p>";
                          unset($_SESSION['senhaMuitoCurta']);
                        }
                      ?> <br>
                      <button class="inter">Trocar senha</button> <br> <br>





                  </form>
                  <form action="../php/exec_trocarNome.php" method="post" enctype="multipart/form-data">
                      <h2> Trocar nome </h2>
                      <label> Novo nome: <label><br>
                      <input type = "text" name="nomeNovo" size="50"><br> 
                      <?php
                        if (isset($_SESSION['erroFaltaCamposNome'])) {
                          echo "<p style='color: red;'>" . $_SESSION['erroFaltaCamposNome'] . "</p>";
                          unset($_SESSION['erroFaltaCamposNome']);
                        }
                        if (isset($_SESSION['erroNomeCurto'])) {
                          echo "<p style='color: red;'>" . $_SESSION['erroNomeCurto'] . "</p>";
                          unset($_SESSION['erroNomeCurto']);
                        }
                        if (isset($_SESSION['nomeAlteradoSucesso'])) {
                          echo "<p style='color: lightgreen;'>" . $_SESSION['nomeAlteradoSucesso'] . "</p>";
                          unset($_SESSION['nomeAlteradoSucesso']);
                        }
                        if (isset($_SESSION['nomeAlteradoErro'])) {
                          echo "<p style='color: red;'>" . $_SESSION['nomeAlteradoErro'] . "</p>";
                          unset($_SESSION['nomeAlteradoErro']);
                        }
                      ?> <br>
                      <button class="gremio">Trocar nome</button> <br> <br>
                  </form>





                  <form action="../php/exec_apagarConta.php" method="post" enctype="multipart/form-data">
                      <h2> Apagar conta </h2>
                      <label> Digite sua senha: <label><br>
                      <input type = "password" name="senha" size="50"><br>
                      <?php
                        if (isset($_SESSION['faltaSenha'])) {
                          echo "<p style='color: red;'>" . $_SESSION['faltaSenha'] . "</p>";
                          unset($_SESSION['faltaSenha']);
                        }
                      ?> <br>
                      <label> Confirmação de exclusão: <label><br>
                      <input type = "text" name="confirmar" placeholder="Digite 'Confirmar'"size="50"><br> 
                      <?php
                        if (isset($_SESSION['faltaConfirmar'])) {
                          echo "<p style='color: red;'>" . $_SESSION['faltaConfirmar'] . "</p>";
                          unset($_SESSION['faltaConfirmar']);
                        }
                      ?> <br>
                      <button class="botaoVermelho">APAGAR CONTA</button> <br> <br>
                  </form>
                  <button type="button" class="botaoVermelho" onclick="window.location.href='../php/homepagelogin.php'"> Deslogar </button> <br> <br>
                  <button type="button" class="inter" onclick="window.location.href='../php/homepage.php'"> Voltar </button>
          </div>
      </div>
  </div>
</body>
</html>
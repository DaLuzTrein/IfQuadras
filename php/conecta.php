<?php
$servidor = "localhost";
$usuario = "root";
$senha = "root";
$banco = "IfQuadras";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// if (!$conexao) 
//    {
//    die("Erro na conexão: " . mysqli_connect_error());
//    }
// else { 
//    echo ("Conectado com sucesso ao BD");
//     }
<?php

// Inicia a sessão
session_start();

// Inclui a conexão com o banco de dados
include "conexao.php";

// cria as variaveis
$ID_PROD = isset($_POST['ID_PROD']) ? floatval($_POST['ID_PROD']) : 0;

if ($ID_PROD == 1)
$arrNoticias = 
[
    "Detergente",
];

// Definir a notícia e o caminho da imagem
$noticia = $arrNoticias[$n];
$imagemUrl = "img/deter gente.png" . $n . "img/kitty cats.jpg";

// Exibir a notícia e a imagem
echo "<p>$noticia</p>";
echo "<img src='$imagemUrl' alt='Produto'>";
?>


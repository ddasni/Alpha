<?php

// Inicia a sessão
session_start();

// Inclui a conexão com o banco de dados
include "../conexao.php";

// cria as variaveis
$ID_PROD = isset($_POST['ID_PROD']) ? floatval($_POST['ID_PROD']) : 0;

if ($ID_PROD == 1)
$arrNoticias = 
[
    "Detergente",
];

// Definir a notícia e o caminho da imagem
$noticia = $arrNoticias[$n];
$imagemUrl = "../1Vitrine_Produto/img/deter gente.png" . $n . "../1Vitrine_Produtoimg/img/kitty cats.jpg";
// tem que ver o caminho da imagem



// Exibir a notícia e a imagem
echo "<p>$noticia</p>";
echo "<img src='$imagemUrl' alt='Produto'>";
?>


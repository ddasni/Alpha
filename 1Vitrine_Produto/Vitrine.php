<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecione um Produto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Selecione um Produto</h1><br><br>
    
    <div class="Produtos">

    <h3>Camiseta Polo 59,90</h3>
    <a id="01" href="../1Vitrine_Produto/CamisetaPolo.php"><img src="../1Vitrine_Produto/img/Camisetapolo.png" id="01" width="300px"></a>
    
    <h3>Tênis Esportivo 199,99</h3>
    <a id="02" href="../1Vitrine_Produto/TênisEsportivo.php"><img src="../1Vitrine_Produto/img/TenisEsportivo.png" id="02" width="300px"></a>

    <h3>Relógio de Pulso 299,90</h3>
    <a id="03" href="../1Vitrine_Produto/RelogiodePulso.php"><img src="../1Vitrine_Produto/img/Relogio.png" id="03" width="300px"></a>

    </div>

</body>
</html>

<?php

// Inicia a sessão
session_start();

if (isset($_GET['id == 01'])) 
{
    // Salva o ID selecionado na sessão
    $_SESSION['59,90'] = $_GET['id'];

}
elseif(isset($_GET['id == 02'])) 
{
    // Salva o ID selecionado na sessão
    $_SESSION['199,99'] = $_GET['id'];

}
elseif(isset($_GET['id == 03'])) 
{
    // Salva o ID selecionado na sessão
    $_SESSION['299,90'] = $_GET['id'];

}
?>
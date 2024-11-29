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

    <form action="Vitrine.php?valor = enviado" method="post">
        
        <h3>Camiseta Polo 59,90</h3>
        <img src="../1Vitrine_Produto/img/Camisetapolo.png" id="01" width="300px">
        <input type="submit" name="ID01" value="ESCOLHER CAMISETA"><br><p>

        <h3>Tênis Esportivo 199,99</h3>
        <img src="../1Vitrine_Produto/img/TenisEsportivo.png" id="02" width="300px">
        <input type="submit" name="ID02" value="ESCOLHER TÊNIS"><br><p>

        <h3>Relógio de Pulso 299,90</h3>
        <img src="../1Vitrine_Produto/img/Relogio.png" id="03" width="300px">
        <input type="submit" name="ID03" value="ESCOLHER RELÓGIO">
    </form>
</body>
</html>

<?php
    // Inicia a sessão
    session_start();

    if (isset($_POST['ID01'])) 
    {
        // Salva o ID e o Valor na sessão
        $_SESSION['valor_total'] = '59.90';
        $_SESSION['ID_Prod'] = '1';
        header('location:../1Vitrine_Produto/Camisetapolo.php');
    }
    elseif(isset($_POST['ID02'])) 
    {
        // Salva o ID e o Valor na sessão
        $_SESSION['valor_total'] = '199.99';
        $_SESSION['ID_Prod'] = '2';
        header('location:../1Vitrine_Produto/TênisEsportivo.php');
    }
    elseif(isset($_POST['ID03'])) 
    {
        // Salva o ID e o Valor na sessão
        $_SESSION['valor_total'] = '299.90';
        $_SESSION['ID_Prod'] = '3';
        header('location:../1Vitrine_Produto/RelogiodePulso.php');
    }
?>
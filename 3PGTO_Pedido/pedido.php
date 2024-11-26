<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
session_start();

// Verificando se as variáveis de sessão existem antes de usá-las
if (isset($_SESSION['nome_user'])) {
    echo "Nome: " . $_SESSION['nome_user'] . "<br><br>";
}
if (isset($_SESSION['endereco_user'])) {
    echo "Endereço: " . $_SESSION['endereco_user'] . "<br><br>";
}
if (isset($_SESSION['forma_pgto'])) {
    echo "Forma de pagamento: " . $_SESSION['forma_pgto'] . "<br><br>";
}
if (isset($_SESSION['cond_pgto'])) {
    echo "Condição de pagamento: " . $_SESSION['cond_pgto'] . "<br><br>";
}
if (isset($_SESSION['valor_parce'])) {
    echo "Valor da parcela: " . $_SESSION['valor_parce'] . "<br><br>";
}
if (isset($_SESSION['valor_total'])) {
    echo "Valor total: " . $_SESSION['valor_total'] . "<br><br>";
}

// Definindo as variáveis com as sessões
$NomeUser = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : null;
$Endereco = isset($_SESSION['endereco_user']) ? $_SESSION['endereco_user'] : null;
$FormaPagto = isset($_SESSION['forma_pgto']) ? $_SESSION['forma_pgto'] : null;
$CondPagto = isset($_SESSION['cond_pgto']) ? $_SESSION['cond_pgto'] : null;
$ValorParce = isset($_SESSION['valor_parce']) ? $_SESSION['valor_parce'] : null;
$ValorTotal = isset($_SESSION['valor_total']) ? $_SESSION['valor_total'] : null;

if (isset($_POST['Gerenciar'])) {
    // Incluindo a classe Usuario
    include '../Classes/Usuario.php';  // Incluindo o arquivo onde a classe está definida
    $user = new Usuario;

    $user->pedido($NomeUser, $Endereco, $FormaPagto, $CondPagto, $ValorParce, $ValorTotal);
}
?>

<form method="post">
    <input type="submit" name="Gerenciar" value="Gerenciar">
</form>

</body>
</html>
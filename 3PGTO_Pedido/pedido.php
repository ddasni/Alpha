<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
</head>
<body>
    
<?php
// Incluindo a classe Usuario
include '../Classes/Usuario.php';  // Incluindo o arquivo onde a classe está definida
$user = new Usuario;

session_start();

$ValorTotal = $_SESSION['valor_total'];

echo "Nome: " . $_SESSION['nome_user'] . "<br>" . "<br>" ;
echo "Endereço: " . $_SESSION['endereco_user'] . "<br>" . "<br>"  ;
echo "Forma de pagamento: " . $_SESSION['forma_pgto'] . "<br>" . "<br>"  ;
echo "Condição de pagamento: " . $_SESSION['cond_pgto'] . "<br>" . "<br>"  ;
echo "Valor da parcela: " . $_SESSION['valor_parce']  . "<br>" . "<br>"  ;
echo "Valor total: " . $ValorTotal . "<br>" . "<br>"  ;


if (isset($_POST['Gerenciar'])) {
    $user->pedido($ValorTotal);
}
?>

<form method="POST" action="pedido.php">
    <input type="submit" name="Gerenciar" value="Gerenciar">
</form>

</body>
</html>
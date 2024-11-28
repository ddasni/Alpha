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

$NomeUser = $_SESSION['nome_user'];
$Endereco = $_SESSION['endereco_user'];
$FormaPagto = $_SESSION['forma_pgto'];
$CondPagto = $_SESSION['cond_pgto'];
$ValorParce = $_SESSION['valor_parce'];
$ValorTotal = $_SESSION['valor_total'];

echo "Nome: " . $NomeUser . "<br>" . "<br>" ;
echo "Endereço: " . $Endereco . "<br>" . "<br>"  ;
echo "Forma de pagamento: " . $FormaPagto . "<br>" . "<br>"  ;
echo "Condição de pagamento: " . $_SESSION['cond_pgto'] . "<br>" . "<br>"  ;
echo "Valor da parcela: " . $_SESSION['valor_parce']  . "<br>" . "<br>"  ;
echo "Valor total: " . $_SESSION['valor_total'] . "<br>" . "<br>"  ;


if (isset($_POST['Gerenciar'])) {
    $user->pedido($Endereco, $FormaPagto, $CondPagto, $ValorParce, $ValorTotal);
}
?>

<input type="submit" name="Gerenciar" value="Gerenciar">

</body>
</html>
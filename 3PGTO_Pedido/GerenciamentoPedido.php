<?php
include "../conexao.php";
include_once '../Classes/Usuario.php'; 
$user = new Usuario;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $novoNome = $_POST['novo_nome'];
    $novoEndereco = $_POST['novo_endereco'];
    
    // Verifica se senha e confirmar senha são identicos
    if (!empty($novoNome) && !empty($novoEndereco)) { 

        $user->alterar($novoNome, $novoEndereco);
    } 
    else { 
        $novoNome = null;
        $novoEndereco = null;
        echo "<script> alert('Senhas não conferem!') </script>";
        echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Cadastro.html"; }, 1000);</script>';
    }

    //Carrega a tabela
    $Matriz=$conexao->prepare("SELECT * FROM TB_PEDIDO");
    
    $Matriz->execute();

    echo "<table border=1>";

    echo "<tr>";
    echo "<td> Número do Pedido </td>";
    echo "<td> Nome </td>";
    echo "<td> Data do Pedido </td>";
    echo "<td> Status do pedido </td>";
    echo "<td> Condição do Pagamento </td>";
    echo "<td> Forma de Pagamento </td>";
    echo "<td> Valor Parcelado </td>";
    echo "</tr>";

    while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
    {

        $idPedido = $Linha->ID_PEDIDO;
        $Nome = $Linha->NOME_CONTATO;
        $DTAPedido = $Linha->DTA_PEDIDO;
        $StatusPedido = $Linha->STATUS_PEDIDO;
        $CondPagto = $Linha->COND_PAGTO;
        $FormaPagto = $Linha->FORM_PAGTO;
        $ValorParce = $Linha->VALOR_PARCE;
        
        echo "<tr>";
        echo "<td>".$idPedido ." </td>";
        echo "<td>".$Nome ." </td>";
        echo "<td>".$DTAPedido ."</td>";
        echo "<td>".$StatusPedido ." </td>";
        echo "<td>".$CondPagto ." </td>";
        echo "<td>".$FormaPagto ."</td>";
        echo "<td>".$ValorParce ." </td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento do Pedido</title>
</head>
<body>
    <h1>Gerenciamento do Pedido</h1>

    <?php if (isset($_SESSION['mensagem'])): ?>
        <p><?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="novo_nome">Novo Nome:</label><br>
        <input type="text" name="novo_nome" id="novo_nome" required><br><br>

        <label for="novo_endereco">Novo Endereço:</label><br>
        <input type="text" name="novo_endereco" id="novo_endereco" required><br><br>

        <button type="submit">Alterar</button>
    </form>
</body>
</html>
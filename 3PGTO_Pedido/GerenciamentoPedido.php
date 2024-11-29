<?php
// incluindo o arquivo Tabela.php
include "../Classes/Tabela.php";
$tabela = new Tabela;

// incluindo apenas uma vez o arquivo Usuario.php, caso já tenha sido adicionado anteriormente na execução.
include_once '../Classes/Usuario.php'; 

// cria um novo "usuário" (nome da classe) e guarda ele em uma variavel
$user = new Usuario;

// se o botão alterar for precionado
if (isset($_POST['Alterar'])) {

    // pega o que foi digitado nos input via post e guarda em uma variavel 
    $novoNome = $_POST['novo_nome'];
    $novoEndereco = $_POST['novo_endereco'];
    
    // Verifica se o campo nome e endereço foram preenchidos
    if (!empty($novoNome) && !empty($novoEndereco)) { 

        // chama a função alterar na classe Usuario e envia os dados para lá
        $user->alterar($novoNome, $novoEndereco);
    } 
    else { 
        // "null" limpa os campos novoNome e novoEndereco
        $novoNome = null;
        $novoEndereco = null;

        // Envianda um alerta para preencher os campos, caso não estiverem preenchidos
        echo "<script> alert('Preencha os campos!') </script>";

        // Após 1seg será redirecionado para a pagina Gerenciamento
        echo '<script> setTimeout(function() { window.location.href = "../3PGTO_Pedido/GerenciamentoPedido.php"; }, 1000);</script>';
    }
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

        <input type="submit" name="Alterar" value="Alterar dados">
    </form>
</body>
</html>
<?php
// se sessão for igual a 'alterado'
if ($_SESSION['tebela'] = 'alterado') {
    $tabela->ChamarTabela();
}// se não
else {
    $tabela->ChamarTabela();
}
?>
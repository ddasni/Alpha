<?php
// Incluindo a classe Usuario
include_once '../Classes/Usuario.php';  // Incluindo o arquivo onde a classe está definida
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

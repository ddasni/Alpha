<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar senha</title>
</head>
<body>
<?php
session_start(); // Inicia a sessão para verificar o controle de resposta

if ($_SESSION['controleResp'] != "enviado") {
    echo "<script> alert('ERRO!') </script>";
    echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 1000);</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $SenhaNova = trim($_POST['senha_nova']);
    $senhaConfirma = trim($_POST['Conf_Senha_nova']);

    // Verificando se todos os campos foram preenchidos
    if (!empty($SenhaNova) && !empty($senhaConfirma)) {
        // Verifica se senha e confirmar senha são idênticos
        if ($SenhaNova == $senhaConfirma) {
            // Aqui você deve tratar o cadastro ou atualização de senha no banco de dados
            // Exemplo:
            // $user->atualizarSenha($Email_User, $SenhaNova);
            echo "<script> alert('Senha alterada com sucesso!') </script>";
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 1000);</script>';
        } else {
            // Senhas não coincidem
            echo "<script> alert('Senhas não conferem!') </script>";
        }
    } else {
        // Campos vazios
        echo "<script> alert('Preencha todos os campos!') </script>";
    }
}
?>
    <form action="TrocarSenha.php?valor = enviado" method="post">
        Senha: <br>
        <input type="password" name="senha_nova" maxlength="8"><br><p>

        Digite a sua Senha novamente: <br>
        <input type="password" name="Conf_Senha_nova" maxlength="8"><br><p>

        <input type="submit" name="Recadastrar" value="Enviar">
    </form>
</body>
</html>

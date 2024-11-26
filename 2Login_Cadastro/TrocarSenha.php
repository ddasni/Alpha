<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar senha</title>
</head>
<body>
<?php
    include_once '../Classes/Usuario.php';

    $user = new Usuario;

    session_start(); 

    

    if (isset($_POST['Recadastrar'])) {
    
        $SenhaNova = trim($_POST['senha_nova']);
        $senhaConfirma = trim($_POST['Conf_Senha_nova']);

        if (!empty($SenhaNova) && !empty($senhaConfirma)) {
        
            if ($SenhaNova == $senhaConfirma) {
            
                $Email_User = $_SESSION['email_user'];
            
                if($user->atualizarSenha($Email_User, $SenhaNova)){

                    $PHPMailer->enviarEmail($Email_User);
                    echo "<script> alert('Senha nova ') </script>";
                    echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 1000);</script>';
                }
            } 
            else {
            echo "<script> alert('Senhas não conferem!') </script>";
            }
        }
        else {
        echo "<script> alert('Preencha todos os campos!') </script>";
        }
    }
    else {
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
<?php
}
?>

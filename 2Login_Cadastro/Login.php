<?php
// Incluindo a classe Usuario
include '../Classes/Usuario.php';
$user = new Usuario;

$emailLogin = $_POST['log_email_usuario'];
$senhaLogin = $_POST['log_senha_usuario'];

// Verifica se o formulario foi enviado
if (isset($_POST['Login'])) {
    
    //verificar se esta preenchido (Validação form)
    if(!empty($emailLogin) && !empty($senhaLogin)) {

        if ($user->logar($emailLogin, $senhaLogin))
        {
            $Email_User = $emailLogin;
            $user->sessao($Email_User);
            header("location: ../3PGTO_Pedido/pagamento.html");
        }
        else { 
            echo "<script> alert('Usuario inexistente. Cadastre-se ou tente novamente!') </script>";
            $emailLogin = null;
            $senhaLogin = null;
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 2000);</script>';
        }
    }
    else {
        echo "<script> alert('Preencha todos os campos!') </script>";
        echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 1000);</script>';
    }
}
else {
    header('location:../2Login_Cadastro/Login.html');
}
?>
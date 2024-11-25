<?php
// Incluindo a classe Usuario
include_once '../Classes/Usuario.php';  // Incluindo o arquivo onde a classe está definida
$user = new Usuario;


// Verifica se o formulario foi enviado
if (isset($_POST['incluir'])) {

            $NomeCadastro = $_POST['nome_usuario'];
            $EnderecoCadastro = $_POST['endereco_usuario'];
            $EmailCadastro = $_POST['email_usuario'];
            $SenhaCadastro = trim($_POST['senha_usuario']);
            $senhaConfirma = trim($_POST['confi_senha']);
            
    // Verifica se todos os dados foram preenchidos
    if (!empty($NomeCadastro) && !empty($EnderecoCadastro) && !empty($EmailCadastro)
        && !empty($SenhaCadastro) && !empty($senhaConfirma))  {

        include "../conexao.php";
        
        // Verifica se senha e confirmar senha são identicos
        if ($SenhaCadastro == $senhaConfirma) {
            
            $Email_User = $EmailCadastro; 

            // Executa a função que vai permitir o cadastro
            $user->cadastrar($NomeCadastro, $EnderecoCadastro, $EmailCadastro, $SenhaCadastro);
            $user->sessao($Email_User);

        } 
        else {
            echo "<script> alert('Senhas não conferem!') </script>";
            $SenhaCadastro = null;
            $senhaConfirma = null;
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Cadastro.html"; }, 1000);</script>';
        }
    }
    else { // se todos os campos não forem preenchidos
        echo "<script> alert('Preencha todos os campos!') </script>";
        echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 1000);</script>';
    }
}
else{ // se o formulario não for enviado
    header('location:../2Login_Cadastro/Cadastro.html');
}
?>
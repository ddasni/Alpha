<?php
// Incluindo a classe Usuario
include 'Usuario.php';  // Incluindo o arquivo onde a classe está definida
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

        include "conexao.php";
            // Verifica se senha e confirmar senha são identicos
            if ($SenhaCadastro == $senhaConfirma) {
                if ($user->cadastrar($NomeCadastro, $EnderecoCadastro, $EmailCadastro, $SenhaCadastro)) {
                    ?>
                    <script>
                        alert("<?php echo $user->msgSucesso; ?>");
                        // Aguardar o alerta ser fechado e depois redirecionar
                        setTimeout(function() {
                        window.location.href = "Login.html"; // Altere para a URL desejada
                        }, 1000); // Aguarda 1 segundo antes de redirecionar
                    </script>
                    <?php
                } 
                else {
                    echo "email já exisente - Erro: " . $user->msgErro;
                }
            } 
            else {
                echo "Senha e confirmar senha não conferen - Erro: " . $user->msgErro;
            }
    }
    else { // se todos os campos não forem preenchidos
        echo "Preencha todos os campos - Erro: " . $user->msgErro;
    }
}
else{ // se o formulario não for enviado
    header('location:Cadastro.html');
}
?>
<?php
class Usuario 
{
    public function cadastrar($NomeCadastro, $EnderecoCadastro, $EmailCadastro, $SenhaCadastro)
    {
        try {
            include "conexao.php";
            //caso não, cadastrar   
            $Comando=$conexao->prepare("INSERT INTO TB_CLIENTE (NOME_CLIENTE,
            END_CLIENTE, EMAIL_CLIENTE, SENHA_CLIENTE) VALUES (?, ?, ?, ?)");

            $Comando->bindParam(1, $NomeCadastro);
            $Comando->bindParam(2, $EnderecoCadastro);
            $Comando->bindParam(3, $EmailCadastro);
            $Comando->bindParam(4, $SenhaCadastro);
            
            if ($Comando->execute()){

                if ($Comando->rowCount() > 0) {

                    // quero iniciar o session aqui
                    // ele só será iniciado quando o cadastro for executado com sucesso

                echo "<script> alert('Cadastrado com sucesso!') </script>";
                echo '<script> setTimeout(function() { window.location.href = "Login.html"; }, 1000);</script>';
                // nesse codigo ele vai inicar um timer (1000 = 1seg) para abrir uma pagina, no caso é a de login
                }
            }
        }
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            echo '<script> setTimeout(function() { window.location.href = "Cadastro.html"; }, 6000);</script>';
        }
    }

    public function logar($emailLogin, $senhaLogin)
    {
        try {
            include "conexao.php";
            //verificar se o email e senha estão cadastrados, se sim
            $Comando=$conexao->prepare("SELECT ID_CLIENTE FROM TB_CLIENTE 
                                        WHERE EMAIL_CLIENTE=? AND SENHA_CLIENTE=?");
            $Comando->bindParam(1, $emailLogin);
            $Comando->bindParam(2, $senhaLogin);
            
            if ($Comando->execute()) {
                if($Comando->rowCount() > 0)
                {
                    //Entrar no sistema (Sessão)
                    $dado = $Comando->fetch(); //fetch pega o que vem do bd e transforma em vetor
                    session_start();
                    $_SESSION['user_id'] = $dado['ID_CLIENTE'];
                    $_SESSION['user_email'] = $emailLogin;

                    return true; 
                }
            }
        }
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    public function alterar () {

        try {
            session_start();
            $ID = $_SESSION['user_id'];
            $NomeAlterar = $_SESSION[''];
            $EnderecoAlterar = $_SESSION[''];

            include "conexao.php";
            //caso não, cadastrar   
            $Comando=$conexao->prepare("UPDATE TB_CLIENTE SET NOME_CLIENTE = ?, END_CLIENTE = ? 
                                        WHERE ID_CLIENTE = ?");

            $Comando->bindParam(1, $NomeAlterar);
            $Comando->bindParam(2, $EnderecoAlterar);
            $Comando->bindParam(3, $ID);

            
            if ($Comando->execute()){

                if ($Comando->rowCount() > 0) {

                    // quero iniciar o session aqui
                    // ele só será iniciado quando o cadastro for executado com sucesso

                echo "<script> alert('Alteração feita com sucesso!') </script>";
                echo '<script> setTimeout(function() { window.location.href = "NomeDaPagina.html"; }, 1000);</script>';
                // nesse codigo ele vai inicar um timer (1000 = 1seg) para abrir uma pagina, no caso é a de login
                // altere "NomeDaPagina.html" para a pagina que ele vai abrir
                }
            }
        }
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage(); // altere "NomeDaPagina.html" para a pagina que ele vai voltar após o erro
            echo '<script> setTimeout(function() { window.location.href = "NomeDaPagina.html"; }, 6000);</script>';
        }
    }
}
?>
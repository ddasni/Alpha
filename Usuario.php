<?php
class Usuario 
{
    public $msgErro = "";

    public function cadastrar($NomeCadastro, $EnderecoCadastro, $EmailCadastro, $SenhaCadastro)
    {
        try {
            include "conexao.php";
            //caso não, cadastrar   
            $Comando=$conexao->prepare("INSERT INTO TB_CLIENTE (NOME_CLIENTE,
            END_CLIENTE, EMAIL_CLIENTE, SENHA_CLIENTE) VALUES (?, ?, ?, ?)");

            $Comando->bindParam("1", $NomeCadastro);
            $Comando->bindParam("2", $EnderecoCadastro);
            $Comando->bindParam("3", $EmailCadastro);
            $Comando->bindParam("4", $SenhaCadastro);
            
            if ($Comando->execute()){

                if ($Comando->rowCount() > 0) {
                echo "<script> alert('Cadastrado com sucesso!') </script>";
                echo '<script> setTimeout(function() { window.location.href = "Login.html"; }, 1000);</script>';
                }
            }
        }
        catch (PDOException $erro) {
            $this->$msgErro = $erro->getMessage();
        }
    }

    public function logar($emailLogin, $senhaLogin)
    {
        try {
            include "conexao.php";
            //verificar se o email e senha estão cadastrados, se sim
            $Comando=$conexao->prepare("SELECT ID_CLIENTE FROM TB_CLIENTE 
                                        WHERE EMAIL_CLIENTE=? AND SENHA_CLIENTE=?");
            $Comando->bindParam("1", $emailLogin);
            $Comando->bindParam("2", $senhaLogin);
            $Comando->execute();
            

            if($Comando->rowCount() > 0)
            {
                //Entrar no sistema (Sessão)
                $dado = $Comando->fetch(); //fetch pega o que vem do bd e transforma em vetor
                session_start();
                $_SESSION['user_id'] = $dado['ID_CLIENTE'];
                $_SESSION['user_email'] = $emailLogin;

                return true; 
            }
            else
            {
                return false; //não conseguiu logar
            }
        }
        catch (Exception $erro) {
            $this->$msgErro = $erro->getMessage();
        }
    }

    public function alterar () {

        // aqui vc segue o que tem anteriormente, porém modificado para aletar os dados
    }
}
?>
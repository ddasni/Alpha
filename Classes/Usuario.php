<?php
class Usuario 
{
    public function cadastrar($NomeCadastro, $EnderecoCadastro, $EmailCadastro, $SenhaCadastro)
    {
        try {
            include "../conexao.php";
            //caso não, cadastrar   
            $Comando=$conexao->prepare("INSERT INTO TB_CLIENTE (NOME_CLIENTE,
            END_CLIENTE, EMAIL_CLIENTE, SENHA_CLIENTE) VALUES (?, ?, ?, ?)");

            $Comando->bindParam(1, $NomeCadastro);
            $Comando->bindParam(2, $EnderecoCadastro);
            $Comando->bindParam(3, $EmailCadastro);
            $Comando->bindParam(4, $SenhaCadastro);
            
            if ($Comando->execute()){

                if ($Comando->rowCount() > 0) {

                echo "<script> alert('Cadastrado com sucesso!') </script>";
                echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 1000);</script>';
                // nesse codigo ele vai inicar um timer (1000 = 1seg) para abrir uma pagina, no caso é a de login
                }
            }
        }
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Cadastro.html"; }, 6000);</script>';
        }
    }

    public function logar($emailLogin, $senhaLogin)
    {
        try {
            include "../conexao.php";
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
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 6000);</script>';
        }
    }

    public function alterar ($novoNome, $novoEndereco) {

        try {
            session_start();
            $EMAIL_CLIENTE = $_SESSION['email_user'];

            include "../conexao.php";
            //caso não, cadastrar   
            $Comando=$conexao->prepare("UPDATE TB_CLIENTE SET NOME_CLIENTE = ?, END_CLIENTE = ? 
                                        WHERE EMAIL_CLIENTE = ?");

            $Comando->bindParam(1, $novoNome);
            $Comando->bindParam(2, $novoEndereco);
            $Comando->bindParam(3, $EMAIL_CLIENTE);

            
            if ($Comando->execute()){

                if ($Comando->rowCount() > 0) {

                echo "<script> alert('Alteração feita com sucesso!') </script>";
                echo '<script> setTimeout(function() { window.location.href = ../3PGTO_PedidoGerenciamentoPedido/GerenciamentoPedido.php"; }, 1000);</script>';
                }
            }
        }
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage(); 
            echo '<script> setTimeout(function() { window.location.href = "../3PGTO_PedidoGerenciamentoPedido/GerenciamentoPedido.php"; }, 6000);</script>';
        }
    }

    public function atualizarSenha($Email_User, $SenhaNova) {
        try {
            include "../conexao.php";

            $Comando=$conexao->prepare("UPDATE TB_CLIENTE set SENHA_CLIENTE = ? where EMAIL_CLIENTE = ?");

            $Comando->bindParam(1, $SenhaNova);
            $Comando->bindParam(2, $Email_User);

            if ($Comando->execute()){

                if ($Comando->rowCount() > 0){
                        
                    echo "<script> alert('Senha alterada com sucesso!') </script>";
                    echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/Login.html"; }, 1000);</script>';

                    session_start();
                    $_SESSION['controleResp'] = "alterado";
                }
            }
        }
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    public function pedido($Endereco, $FormaPagto, $CondPagto, $ValorParce, $ValorTotal){
        try {
            include "../conexao.php";
              
            $Comando=$conexao->prepare("INSERT INTO TB_PEDIDO (NOME_CLIENTE,
            END_CLIENTE, FORM_PAGTO, COND_PAGTO, VALOR_PARCE, VALOR_PEDIDO) VALUES (?, ?, ?, ?, ?, ?)");

            $Comando->bindParam(1, $NomeUser);
            $Comando->bindParam(2, $Endereco);
            $Comando->bindParam(3, $FormaPagto);
            $Comando->bindParam(4, $CondPagto);
            $Comando->bindParam(5, $ValorParce);
            $Comando->bindParam(6, $ValorTotal);
            
            if ($Comando->execute()){

                if ($Comando->rowCount() > 0){

                    header('location:../3PGTO_Pedido/GerenciamentoPedido.php');
                }
            }
        }  
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    public function sessao($Email_User) {
        try {
            include "../conexao.php";

            $Comando=$conexao->prepare("SELECT NOME_CLIENTE, END_CLIENTE FROM TB_CLIENTE 
                                        WHERE EMAIL_CLIENTE = ?");

            $Comando->bindParam(1, $Email_User);

            if ($Comando->execute()){

                if ($Comando->rowCount() > 0) {

                $dado = $Comando->fetch(PDO::FETCH_ASSOC);
                $NomeUser = $dado['NOME_CLIENTE'];
                $EnderecoUser = $dado['END_CLIENTE'];

                session_start();

                $_SESSION['nome_user'] = $NomeUser;
                $_SESSION['endereco_user'] = $EnderecoUser;
                }
            }

        }
        catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
}
?>
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
                    $_SESSION['email_user'] = $emailLogin;

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

    public function pedido($FormaPagto, $CondPagto, $ValorParce, $ValorTotal){
        try {
            include "../conexao.php";

            session_start();

            $emailCliente = $_SESSION['email_user'];
    
            // Buscar o cliente no banco de dados com o email
            $Comando = $conexao->prepare("SELECT ID_CLIENTE, NOME_CLIENTE, END_CLIENTE FROM TB_CLIENTE WHERE EMAIL_CLIENTE = ?");
            $Comando->bindParam(1, $emailCliente);
            $Comando->execute();
    
            if ($Comando->rowCount() > 0) {
                // Obter o ID_CLIENTE do cliente
                $cliente = $Comando->fetch(PDO::FETCH_ASSOC);
                $IDCliente = $cliente['ID_CLIENTE'];

                $dataPedido = date('d/m/y H:i');
                $statusPedido = "Finalizado"; 
                $idProduto = $_SESSION['ID_Prod'];

                // 2. Inserir o pedido na tabela TB_PEDIDO
                $Comando = $conexao->prepare("INSERT INTO TB_PEDIDO 
                (DTA_PEDIDO, VALOR_PEDIDO, STATUS_PEDIDO, ID_CLIENTE, ID_PROD, COND_PAGTO, FORM_PAGTO, VALOR_PARCE)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                //Outra opção para colocar data e hora atual é usar NOW() diretamente no banco de dados
    
                $Comando->bindParam(1, $dataPedido);
                $Comando->bindParam(2, $ValorTotal);
                $Comando->bindParam(3, $statusPedido);
                $Comando->bindParam(4, $IDCliente); // Agora usa o ID_CLIENTE encontrado
                $Comando->bindParam(5, $idProduto); 
                $Comando->bindParam(6, $CondPagto);
                $Comando->bindParam(7, $FormaPagto);
                $Comando->bindParam(8, $ValorParce);
    
                // Executar o comando
                if ($Comando->execute()) {
                    if ($Comando->rowCount() > 0) {
                        header('location:../3PGTO_Pedido/GerenciamentoPedido.php');
                    }
                }
            } else {
                echo "Cliente não encontrado!";
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
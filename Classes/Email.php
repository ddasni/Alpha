class Email {
    public function Enviar() {
        session_start();   

        $nome = $_SESSION['nome_user'];
        $email = $_SESSION['user_email'];
        $mensagem = 'estou enviando um email para testar o site';
        $corpo = 'sei la'; 

        echo ($nome); 

        $data_envio = date('d/m/Y');
        $hora_envio = date('H:i:s'); 

        include "SenhaEmail.php";  
        $para = $email; 
        $de = 'danielsousa1melo@gmail.com';
        $de_nome = 'Daniel Sousa';
        $assunto = 'teste de email'; 

        require_once("phpmailer/class.phpmailer.php");

        function smtpmailer($para, $de, $de_nome, $assunto, $corpo) 
        { 
        global $error;
        $mail = new PHPMailer();
        $mail->IsSMTP();    // Ativar SMTP
        $mail->SMTPDebug = 0;   // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;   // Autenticação ativada
        $mail->SMTPSecure = 'tls';  // Padrão de segurança
        $mail->Host = 'smtp.gmail.com'; // SMTP utilizado
        $mail->Port = 587;      // A porta 587 deverá estar aberta em seu servidor
        $mail->Username = USER;
        $mail->Password = PWD;
        $mail->SetFrom($de, $de_nome);
        $mail->Subject = $assunto;
        $mail->Body = $corpo;
        $mail->AddAddress($para);
        
        if(!$mail->Send()) 
        {
            $error = 'Mail error: '.$mail->ErrorInfo; 
            return false;
        } 
        else 
        {
            $error = 'Mensagem enviada!';
            return true;
        }
        }

        $Vai = "Nome: $nome\n\nE-mail: $email\n\nTelefone: $telefone\n\nMensagem: $mensagem\n\nResposta: $corpo";

        if (smtpmailer($email, 'danielsousa1melo@gmail.com', 'Daniel Sousa', 'Resposta do Contato', $Vai)) 
        {
        echo ('Sucesso enviado, '); // Redireciona para uma página de obrigado.
        $_SESSION['controleResp'] = "enviado";
        header('location:../2Login_Cadastro/Login.html');
        }
        if (!empty($error)) echo $error; 
    }
}
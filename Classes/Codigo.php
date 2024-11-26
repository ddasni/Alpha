<?php
class Codigo {

    public function GerarCodigo() {
        session_start();

        // Gerar o código de 4 dígitos aleatorio
        $codigo = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $_SESSION['codigo'] = $codigo; 
    }

    public function VerificarCodigo() 
    {
        session_start();

        $codigo_informado = $_SESSION['CodigoDigitado'];

        // Verificando se o código informado é igual ao código armazenado na sessão
        if ($codigo_informado === $_SESSION['codigo']) {

            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/TrocarSenha.php"; }, 1000);</script>';

        } 
        else {
            echo "<script> alert('Codigo incorreto. tente novamente!') </script>";
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/DigitarCodigo.php"; }, 1000);</script>';
        }

    }

}
?>
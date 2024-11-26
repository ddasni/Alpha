<?php
class Codigo {

    public function GerarCodigo() {

        // verificação do status do session, se ela já foi chamada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $codigo = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $_SESSION['codigo'] = $codigo; 
    }

    public function VerificarCodigo() {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $codigo_informado = $_SESSION['CodigoDigitado'];

        if ($codigo_informado === $_SESSION['codigo']) {
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/TrocarSenha.php"; }, 1000);</script>';
        } else {
            echo "<script> alert('Codigo incorreto. tente novamente!') </script>";
            echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/DigitarCodigo.php"; }, 1000);</script>';
        }
    }
}

?>
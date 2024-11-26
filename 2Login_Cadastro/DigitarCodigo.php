<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
</head>
<body>
<?php
include_once '../Classes/Codigo.php';
$codigo = new Codigo;

if(isset($_POST['enviar'])){

    $CodigoDigitado = $_POST['codigo'];

    if (!empty($CodigoDigitado)){

        session_start();
        $_SESSION['CodigoDigitado'] = $CodigoDigitado;

       $codigo->VerificarCodigo();
    }
    else{
        echo "<script> alert('Preencha o campo do codigo!') </script>";
        echo '<script> setTimeout(function() { window.location.href = "../2Login_Cadastro/DigitarCodigo.php"; }, 1000);</script>';
    }
}
else {
?>
    <h2>Digite o código enviado por e-mail</h2>
    <form action="DigitarCodigo.php?valor = enviado" method="POST">
        <label for="codigo">Digite o seu Código:</label>
        <input type="text" name="codigo" maxlength="4" required>
        <input type="submit" name="enviar" value="enviar">
    </form>
</body>
</html>
<?php
}
?>
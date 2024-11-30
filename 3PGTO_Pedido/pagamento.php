<?php
// Inicia a sessão
session_start();

// Inicializa as variáveis
$formaPgto = $_POST['forma_pgto'];

// Verifica se o formulário foi enviado via POST
if (isset($_POST['Pagamento'])) {

    // Define a condição de pagamento de acordo com a forma escolhida
    if ($formaPgto === "Boleto") 
    {
        $_SESSION['cond_pgto'] = "À Vista";
        $valorParcela = $_SESSION['valor_total'] ;  // Para pagamento à vista, o valor total é o mesmo da parcela
    } 

    elseif ($formaPgto === "Cartão de Crédito") 
    {
        $_SESSION['cond_pgto'] = "Até 12x Sem Juros";
        $parcelas = 12;  // Número de parcelas
        $Resultado = $_SESSION['valor_total'] / $parcelas;  // Calcula o valor de cada parcela
        $valorParcela = round($Resultado, 2);
    }

    // Armazena os dados na sessão
    $_SESSION['forma_pgto'] = $formaPgto ;
    $_SESSION['valor_parce'] = $valorParcela;
    

    header('location:../3PGTO_Pedido/pedido.php');
} 
else 
{
    echo "Sessão não iniciada ou ID do administrador não encontrado.";
}
?>
<?php

// Inicia a sessão
session_start();

// Inclui a conexão com o banco de dados
include "conexao.php";

// Inicializa as variáveis
$formaPgto = isset($_POST['forma_pgto']) ? $_POST['forma_pgto'] : "";
$condicaoPgto = "";
$valorParcela = "";
$valorTotal = isset($_POST['valor_total']) ? floatval($_POST['valor_total']) : 0;

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

        try {
            // Define a condição de pagamento de acordo com a forma escolhida
            if ($formaPgto === "Boleto") 
            {
                $condicaoPgto = "À Vista";
                $valorParcela = $valorTotal;  // Para pagamento à vista, o valor total é o mesmo da parcela
            } 

            elseif ($formaPgto === "Cartão de Crédito") 
            {
                $condicaoPgto = "Até 12x Sem Juros";
                $parcelas = 12;  // Número de parcelas
                $valorParcela = $valorTotal / $parcelas;  // Calcula o valor de cada parcela
            }

            // Armazena os dados na sessão
            $_SESSION['forma_pgto'] = $formaPgto;
            $_SESSION['cond_pgto'] = $condicaoPgto;
            $_SESSION['valor_parce'] = $valorParcela;
            $_SESSION['valor_total'] = $valorTotal;

        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    } 
    else 
    {
        echo "Sessão não iniciada ou ID do administrador não encontrado.";
    }
?>

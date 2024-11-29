<?php
class Tabela {
    public function ChamarTabela(){
        include "../conexao.php";

        session_start();
        $FormPGTO = $_SESSION['forma_pgto']; 
        $CondPGTO = $_SESSION['cond_pgto'];
        $ValorParcela = $_SESSION['valor_parce'];
        $emailCliente = $_SESSION['email_user'];

        //Carrega a tabela
        $Matriz=$conexao->prepare("SELECT TB_CLIENTE.NOME_CLIENTE, TB_CLIENTE.END_CLIENTE, TB_PEDIDO.ID_PEDIDO, 
                                          DATE_FORMAT(TB_PEDIDO.DTA_PEDIDO, '%d/%m/%Y') AS DTA_PEDIDO_FORMATADA, 
                                          TB_PEDIDO.VALOR_PEDIDO, TB_PEDIDO.STATUS_PEDIDO, TB_PROD.NOME_PROD
                                    FROM TB_CLIENTE
                                    INNER JOIN TB_PEDIDO ON TB_CLIENTE.ID_CLIENTE = TB_PEDIDO.ID_CLIENTE
                                    INNER JOIN TB_PROD ON TB_PEDIDO.ID_PROD = TB_PROD.ID_PROD
                                    WHERE TB_CLIENTE.EMAIL_CLIENTE = ?");
        
        $Matriz->execute([$emailCliente]);

        echo "<br>";
        echo "<br>";

        echo "<table border=1>";

        echo "<tr>";
        echo "<td> Nome </td>";
        echo "<td> Endereço </td>";
        echo "<td> Número do Pedido </td>";
        echo "<td> Nome do produto </td>";
        echo "<td> Data do Pedido </td>";
        echo "<td> Status do pedido </td>";
        echo "<td> Valor do Pedido </td>";
        echo "<td> Forma de Pagamento </td>";
        echo "<td> Condição de Pagamento </td>";
        echo "<td> Valor da Parcela </td>";
        echo "</tr>";

        while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
        {
            $NomeCliente = $Linha->NOME_CLIENTE;
            $EndCliente = $Linha->END_CLIENTE;
            $idPedido = $Linha->ID_PEDIDO;
            $NomeProd = $Linha->NOME_PROD;
            $DTAPedido = $Linha->DTA_PEDIDO_FORMATADA;
            $StatusPedido = $Linha->STATUS_PEDIDO;
            $ValorPedido = $Linha->VALOR_PEDIDO;
            
            echo "<tr>";
            echo "<td>".$NomeCliente ." </td>";
            echo "<td>".$EndCliente ."</td>";
            echo "<td>".$idPedido ." </td>";
            echo "<td>".$NomeProd." </td>";
            echo "<td>".$DTAPedido ."</td>";
            echo "<td>".$StatusPedido ." </td>";
            echo "<td>".$ValorPedido ." </td>";
            echo "<td>".$FormPGTO ." </td>";
            echo "<td>".$ValorPedido ." </td>";
            echo "<td>".$CondPGTO ." </td>";
            echo "<td>".$ValorParcela ." </td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>
<?php
class Tabela {
    public function ChamarTabela(){
        include "../conexao.php";

        //Carrega a tabela
        $Matriz=$conexao->prepare("SELECT TB_CLIENTE.NOME_CLIENTE, TB_CLIENTE.END_CLIENTE, TB_PEDIDO.ID_PEDIDO, TB_PEDIDO.DTA_PEDIDO, 
                                          TB_PEDIDO.VALOR_PEDIDO, TB_PEDIDO.STATUS_PEDIDO, TB_PROD.NOME_PROD
                                    FROM TB_CLIENTE
                                    INNER JOIN TB_PEDIDO ON TB_CLIENTE.ID_CLIENTE = TB_PEDIDO.ID_CLIENTE
                                    INNER JOIN TB_PROD ON TB_PEDIDO.ID_PROD = TB_PROD.ID_PROD");
        
        $Matriz->execute();

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
        echo "</tr>";

        while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
        {
            $NomeCliente = $Linha->NOME_CLIENTE;
            $EndCliente = $Linha->END_CLIENTE;
            $idPedido = $Linha->ID_PEDIDO;
            $NomeProd = $Linha->NOME_PROD;
            $DTAPedido = $Linha->DTA_PEDIDO;
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
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>
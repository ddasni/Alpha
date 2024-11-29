<?php
class Tabela {
    public function ChamarTabela(){
        include_once "../Classes/Usuario.php";
        $user = new Usuario;

        include "conexao.php";

        session_start();
        $Email_User = $_SESSION['email_user'];

        $user->sessao($Email_User);

        //Carrega a tabela
        $Matriz=$conexao->prepare("SELECT TB_CLIENTE.NOME_CLIENTE, TB_CLIENTE.END_CLIENTE, 
                                          TB_PEDIDO.DTA_PEDIDO, TB_PEDIDO.valor_total,
                                   FROM clientes
                                   INNER JOIN pedidos ON clientes.id_cliente = pedidos.id_cliente");
        
        $Matriz->execute();

        echo "<table border=1>";

        echo "<tr>";
        echo "<td> Número do Pedido </td>";
        echo "<td> Nome </td>";
        echo "<td> Data do Pedido </td>";
        echo "<td> Status do pedido </td>";
        echo "<td> Condição do Pagamento </td>";
        echo "<td> Forma de Pagamento </td>";
        echo "<td> Valor Parcelado </td>";
        echo "</tr>";

        while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
        {

            $idPedido = $Linha->ID_PEDIDO;
            $Nome = $Linha->NOME_CONTATO;
            $DTAPedido = $Linha->DTA_PEDIDO;
            $StatusPedido = $Linha->STATUS_PEDIDO;
            $CondPagto = $Linha->COND_PAGTO;
            $FormaPagto = $Linha->FORM_PAGTO;
            $ValorParce = $Linha->VALOR_PARCE;
            
            echo "<tr>";
            echo "<td>".$idPedido ." </td>";
            echo "<td>".$Nome ." </td>";
            echo "<td>".$DTAPedido ."</td>";
            echo "<td>".$StatusPedido ." </td>";
            echo "<td>".$CondPagto ." </td>";
            echo "<td>".$FormaPagto ."</td>";
            echo "<td>".$ValorParce ." </td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>
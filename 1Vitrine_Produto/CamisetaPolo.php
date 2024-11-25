<?php
session_start(); // Inicia a sessão

// Verifica se um ID de produto está definido na sessão
if (!isset($_SESSION['id_produto'])) {
    // Define um ID de produto padrão, caso não esteja definido
    $_SESSION['id_produto'] = 01; // Exemplo: ID do produto padrão
}

// Configurações do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "Loja";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém o ID do produto da sessão
$product_id = $_SESSION['id_produto'];

// Consulta para obter os dados do produto
$sql = "SELECT NOME_PROD, VALOR_PROD, DESC_PROD, IMAGEM_PROD FROM TB_PROD WHERE ID_PROD = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->bind_result($nome_prod, $valor_prod, $desc_prod, $imagem_prod);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nome_prod); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($nome_prod); ?></h1>

    <div>  
    <a href="">
        <img src="img/Camisetapolo.png" alt="Camiseta Polo" width="300px">
    </a> 
    </div>


    <h3>Valor: R$ <?php echo number_format($valor_prod, 2, ',', '.'); ?></h3>

    <a href="../2Login_Cadastro/Login.html"><button>Comprar</button></a>

    <h1>Descrição</h1>

    <form action="">
        <label for="descricao">
            <textarea id="descricao" name="descricao" rows="4" cols="50" readonly>
<?php echo htmlspecialchars($desc_prod); ?>
            </textarea>
        </label>
    </form>
</body>
</html>

<?php
session_start();
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit;
}

// Se o carrinho estiver vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Seu carrinho está vazio.";
    exit;
}

// Pegar os IDs dos produtos no carrinho
$ids = array_keys($_SESSION['carrinho']);
$sql = "SELECT * FROM tblproduto WHERE id_produto IN (" . implode(',', array_map('intval', $ids)) . ")";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho</title>
</head>
<body>
    <h2>Seu Carrinho</h2>
    <ul>
        <?php foreach ($produtos as $produto): ?>
            <li>
                <?= htmlspecialchars($produto['descricao_resumida']); ?> - 
                <?= $_SESSION['carrinho'][$produto['id_produto']]; ?> unidades - 
                R$ <?= number_format($produto['preco'], 2, ',', '.'); ?>
                <a href="remover_carrinho.php?id=<?= $produto['id_produto']; ?>">Remover</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="checkout.php">Finalizar Compra</a>
</body>
</html>
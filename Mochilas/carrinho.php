<?php
session_start();
include "conexao.php";


if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "mensagem" => "Você precisa estar logado para adicionar itens ao carrinho."]);
    exit;
}


if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'], $_POST['quantidade'])) {
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];


    $sql = "SELECT quantidade_estoque FROM tblproduto WHERE id_produto = :id_produto";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo json_encode(["success" => false, "mensagem" => "Produto não encontrado."]);
        exit;
    }


    $quantidade_estoque = $produto['quantidade_estoque'];

    // Se o produto já está no carrinho, soma a quantidade existente com a nova
    $quantidade_no_carrinho = isset($_SESSION['carrinho'][$id_produto]) ? $_SESSION['carrinho'][$id_produto] : 0;
    $quantidade_total = $quantidade_no_carrinho + $quantidade;

    // Verifica se a quantidade total no carrinho não ultrapassa o estoque (importante)
    if ($quantidade_total > $quantidade_estoque) {
        echo json_encode(["success" => false, "mensagem" => "Quantidade excede o estoque disponível. Estoque atual: $quantidade_estoque"]);
        exit;
    }

    // Se tudo estiver certo, adiciona o produto ao carrinho
    $_SESSION['carrinho'][$id_produto] = $quantidade_total;

    echo json_encode(["success" => true, "mensagem" => "Produto adicionado ao carrinho!"]);
    exit;
}

// Se chegou até aqui sem um POST válido, retorna erro
echo json_encode(["success" => false, "mensagem" => "Erro ao adicionar ao carrinho."]);
?>
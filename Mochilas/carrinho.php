<?php
session_start();
include "conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "mensagem" => "Você precisa estar logado para adicionar itens ao carrinho."]);
    exit;
}

// Inicializa o carrinho na sessão, se ainda não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'], $_POST['quantidade'])) {
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];

    // Adiciona ao carrinho ou incrementa a quantidade
    if (isset($_SESSION['carrinho'][$id_produto])) {
        $_SESSION['carrinho'][$id_produto] += $quantidade;
    } else {
        $_SESSION['carrinho'][$id_produto] = $quantidade;
    }

    echo json_encode(["success" => true, "mensagem" => "Produto adicionado ao carrinho!"]);
    exit;
}

// Se chegou até aqui sem um POST válido, retorna erro
echo json_encode(["success" => false, "mensagem" => "Erro ao adicionar ao carrinho."]);
?>
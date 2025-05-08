<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit;
}

$id_produto = $_POST['id_produto'] ?? $_GET['id'] ?? null;
$quantidade_remover = $_POST['quantidade_remover'] ?? null;
$remover_tudo = $_POST['remover_tudo'] ?? $_GET['tipo'] ?? null;

if (!$id_produto) {
    echo "ID do produto não especificado.";
    exit;
}

// Se for para remover tudo (via POST ou GET)
if ($remover_tudo === 'tudo') {
    if (isset($_SESSION['carrinho'][$id_produto])) {
        unset($_SESSION['carrinho'][$id_produto]);
    }
} elseif ($quantidade_remover !== null) {
    $quantidade_remover = (int)$quantidade_remover;

    if (isset($_SESSION['carrinho'][$id_produto])) {
        $_SESSION['carrinho'][$id_produto] -= $quantidade_remover;

        if ($_SESSION['carrinho'][$id_produto] <= 0) {
            unset($_SESSION['carrinho'][$id_produto]);
        }
    } else {
        echo "Produto não encontrado no carrinho.";
        exit;
    }
} else {
    echo "Ação inválida.";
    exit;
}

// Limpar carrinho se estiver vazio
if (empty($_SESSION['carrinho'])) {
    unset($_SESSION['carrinho']);
}

header("Location: ver_carrinho.php");
exit;
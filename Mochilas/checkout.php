<?php
session_start();
require_once 'dompdf/autoload.inc.php';
include 'conexao.php';

date_default_timezone_set('America/Sao_Paulo');

use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_SESSION['user_id']) || empty($_SESSION['carrinho'])) {
    exit('Usuário não logado ou carrinho vazio.');
}

$ids = array_keys($_SESSION['carrinho']);
$sql = "SELECT * FROM tblproduto WHERE id_produto IN (" . implode(',', array_map('intval', $ids)) . ")";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Início do HTML com estilo
$html = "
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
    }
    h1, h2 {
        text-align: center;
        color: #2c3e50;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }
    td {
        padding: 8px;
        border: 1px solid #ddd;
    }
    .total {
        background-color: #f9f9f9;
        font-weight: bold;
    }
    .footer {
        margin-top: 40px;
        text-align: right;
        font-style: italic;
    }
</style>

<h1>Orçamento de Compra</h1>
<h2>Empresa: " . htmlspecialchars($_SESSION['name_user']) . "</h2>
<hr />

<h2>Produtos</h2>
<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>";
    
$totalGeral = 0;
foreach ($produtos as $produto) {
    $qtd = $_SESSION['carrinho'][$produto['id_produto']];
    $total = $qtd * $produto['preco'];
    $totalGeral += $total;

    $html .= "
        <tr>
            <td>" . htmlspecialchars($produto['descricao_resumida']) . "</td>
            <td>$qtd</td>
            <td>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>
            <td>R$ " . number_format($total, 2, ',', '.') . "</td>
        </tr>";
}

$html .= "
        <tr class='total'>
            <td colspan='3'>Total Geral</td>
            <td>R$ " . number_format($totalGeral, 2, ',', '.') . "</td>
        </tr>
    </tbody>
</table>

<div class='footer'>Data de emissão: " . date('d/m/Y H:i:s') . "</div>";

// Configuração do Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream("orcamento.pdf", ["Attachment" => false]);
exit;
?>
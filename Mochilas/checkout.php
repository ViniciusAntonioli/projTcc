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
        font-size: 16px;
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
        padding: 16px;
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


<table>
    <tr>
        <td colspan='5' style='text-align: center;'><h1>Orçamento</h1></td>
    </tr>
    <tr>
        <td>ID:" .htmlspecialchars($_SESSION['user_id']). "</td>
        <td>Nome empresa: " . htmlspecialchars($_SESSION['name_user']) . "</td>
        <td>Telefone: " . htmlspecialchars($_SESSION['telefone']) . "</td>
        <td>Data de emissão: " . date('d/m/Y H:i:s') . "</td>
        <td>Validade: " . date('d/m/Y H:i:s', strtotime('+60 days')) . "</td>
    </tr>
    <tr>
        <td colspan='4'>CNPJ: " . htmlspecialchars($_SESSION['cnpj']) . "</td>
        <td>Transportadora: </td>
    </tr>

    
</table>

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
            <td colspan='3'>Total: </td>
            <td>R$ " . number_format($totalGeral, 2, ',', '.') . "</td>
        </tr>
    </tbody>
</table> <p style='margin-top: 20px; text-align: center;'>* Este orçamento é válido por 60 dias a partir da data de emissão.</p>
<p style='margin-top: 20px; text-align: center;'>* O pagamento deve ser realizado antes da entrega.</p>"
;

$html .= "<div style='text-align: center; margin-top: 70px;'>
    <span style='text-decoration: overline; margin-left: 40px;'>Data de saída</span> 
    <span style='text-decoration: overline; margin-left: 40px;'>Depósito</span>
    <span style='text-decoration: overline; margin-left: 40px;'>Data de entrega</span>
    <div style=' margin-left: 180px; border-top: 2px solid black; width: 200px; margin-top: 80px;''>
    <span style='margin-left: 12px;'>Assinatura do cliente</span>
</div>
</div>";



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
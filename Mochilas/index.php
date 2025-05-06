<?php
if (!defined('MY_APP')) {
   header('Location: mochilas.php');
    die();
}


include 'conexao.php'; 

// Esse arquivo exibe os produtos, e o incluí na página mochilas.php 

$sql = "SELECT p.* FROM tblproduto p WHERE p.ativo = 1";
$condicoes = [];
$params = [];


// Categoria
if (!empty($_GET['categoria']) && is_array($_GET['categoria'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['categoria']), '?'));
    $condicoes[] = "p.id_categoria IN ($placeholders)";
    $params = array_merge($params, $_GET['categoria']);
}

// Cor
if (!empty($_GET['cor']) && is_array($_GET['cor'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['cor']), '?'));
    $condicoes[] = "p.cor IN ($placeholders)";
    $params = array_merge($params, $_GET['cor']);
}

// Material
if (!empty($_GET['material']) && is_array($_GET['material'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['material']), '?'));
    $condicoes[] = "p.id_tipo_material IN ($placeholders)";
    $params = array_merge($params, $_GET['material']);
}

if (!empty($_GET['search'])) {
    $condicoes[] = "p.descricao_resumida LIKE ?";
    $params[] = "%" . $_GET['search'] . "%";
}


// Debug (pode remover depois)


// Concatena condições na SQL
if ($condicoes) {
    $sql .= " AND " . implode(" AND ", $condicoes);
}




$stmt = $conn->prepare($sql);

// Força os parâmetros como string para evitar erro com ODBC Driver
$params = array_map('strval', $params);

// Debug (pode remover depois)

// Executa com parâmetros
$stmt->execute($params);

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_produtos = $stmt->rowCount();

?>


<p>Total de produtos encontrados: <?= $total_produtos; ?></p>

<div class="products">
    
    <?php foreach ($produtos as $produto): ?>
        <a href="detalhes_produto.php?id=<?= $produto['id_produto']; ?>">
        <div class="product">
            <!-- A imagem inicial é a imagem 1 -->
            <img 
                class="hover-img" 
                src="listar_img.php?id=<?= $produto['id_produto']; ?>&img=1" 
                alt="<?= htmlspecialchars($produto['descricao_resumida']); ?>" 
                data-hover="listar_img.php?id=<?= $produto['id_produto']; ?>&img=2" 
                data-original="listar_img.php?id=<?= $produto['id_produto']; ?>&img=1" 
                id="img-<?= $produto['id_produto']; ?>" 
            >

            <div class="details">
                <h1><strong></strong> <?= $produto['descricao']; ?> </h1>
                <p>R$<?= number_format($produto['preco'], 2, ',', '.'); ?></p>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imagens = document.querySelectorAll('.hover-img');

        imagens.forEach(img => {
            const originalSrc = img.getAttribute('data-original'); // Caminho original
            const hoverSrc = img.getAttribute('data-hover'); // Caminho para imagem ao passar o mouse

            // Evento para quando o mouse entra na imagem
            img.addEventListener("mouseenter", () => {
                img.src = hoverSrc; // Troca para a imagem 2
            });

            // Evento para quando o mouse sai da imagem
            img.addEventListener("mouseleave", () => {
                img.src = originalSrc; // Volta para a imagem original
            });
        });
    });
</script>

</body>
</html>
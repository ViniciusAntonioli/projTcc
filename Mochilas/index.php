<?php
include 'conexao.php'; 

$sql = "SELECT id_produto, descricao_resumida, descricao, preco FROM tblproduto WHERE ativo = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_produtos = $stmt->rowCount();
?>

<p>Total de produtos encontrados: <?= $total_produtos; ?></p>

<div class="products">
    <?php foreach ($produtos as $produto): ?>
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
                <p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></p>
            </div>
        </div>
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
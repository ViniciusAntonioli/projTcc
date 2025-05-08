  <?php
session_start();

include 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Produto não encontrado.");
}

$id_produto = $_GET['id'];

$sql = "SELECT p.*, c.nome_categoria, m.nome_material FROM tblproduto p
        JOIN tblcategoria c ON p.id_categoria = c.id_categoria
        JOIN tbltipo_material m ON p.id_tipo_material = m.id_tipo_material
        WHERE p.id_produto = :id_produto AND p.ativo = 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}


if (isset($_SESSION['user_id'])) {
  $exibe = $_SESSION['name_user'] . ", SAIR!";
} else {
  $exibe = "Entrar";
}



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detalhes/styles.css">
    <script src="detalhes/script.js"></script>
    <script src="detalhes/script2.js"></script>
    <title>Detalhes do Produto</title>
</head>
<body>
    
<header>
    <nav>

      <!--Menu Hamburguer-->

      
      <div class="menu-container-hamburguer">
        <div class="hamburguer">
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
        </div>
        <span class="menu-text">MENU</span>
      </div>
      <!-------------------->
      <!---Logo-->

      <div class="logo">
      <img src="../imgs/brindou.com logo1.png" alt="Brindou.com"/>

      </div>
      <div class="rightside">

      <div style="display: flex; gap: 2em;">
      <a style="text-decoration: none; color: white;"href="ver_carrinho.php"><img src="../imgs/carrinho.png" alt="login" style="width: 40px; height: 40px;"></a>
        <div class="login" style="text-align: center;">
            <a href="login/login.php"><img src="../imgs/login.ico" alt="login" style="width: 40px; height: 40px;"></a>
            <div style="font-weight: bold; font-size: 0.8em; color: rgb(255, 104, 17); margin-top: 5px;"><?= $exibe ?></div>
        </div> 
      </div>

       
      </div>
      </nav>
      <div class="secondbar">
        <div class="searchbar">
          <input type="text" placeholder="Buscar por produtos" name="searchb" id="searchb">
          <button class="btnpesquisa" type="submit" id="searchButton">
            <img src="imgs/searchico.webp" alt="Icone de pesquisa" id="iconepesquisa">
          </button>
        </div>
      </div>
      <!-- Menu ao clicar -->
   <div class="leftmenu">
      <div class="titleleftmenu" style="padding-bottom: 1em;">Categorias</div>
	  <a href="../index.html"><div>Início</div></a>
      <a href="mochilas.php"><div class="mochilas">Mochilas</div></a>
      <a href=""><div class="garrafas">Garrafas</div></a>
      <a href=""> <div class="canetas">Canetas</div></a>
      <a href=""><div class="sacolas">Sacolas</div></a>
      <a href=""><div class="bolsas">Bolsas</div></a>
      <a href=""><div class="cadernos">Cadernos</div></a>
      <a href=""><div class="chaveiros">Chaveiros</div></a>
      <a href=""><div class="copos">Copos</div></a>
      <a href=""><div class="Canecas">Canecas</div></a>
      <a href=""><div class="Carregadores">Carregadores</div></a>
      <a href=""><div class="Carteiras">Carteiras</div></a>
      <a href=""><div class="Cozinha">Cozinha</div></a>
      <a href=""> <div class="Estojos">Estojos</div></a>
      <a href=""><div class="Ferramentas">Ferramentas</div></a>
      <a href=""><div class="Fone de ouvido">Fone de ouvido</div></a>
      <a href=""> <div class="Guarda-chiva">Guarda-chuva</div></a>
   </div>

  </header>

  <script>
        var menu = document.querySelector(".hamburguer");
        var leftmenu = document.querySelector(".leftmenu");

        menu.addEventListener("click", function () {
          leftmenu.classList.toggle("active");
          menu.toggle("active")
        });

        leftmenu.addEventListener("mouseleave", function() {
          leftmenu.classList.toggle("active");
          menu.toggle("active")
        });
  </script>


    <div class="container_prod_detalhado">
        <main class="produto_detalhado">
            <div class="galeria_fotos">
                <div class="zoom-container">
                
                    <img id="mainImage" class="main-image" src="listar_img.php?id=<?= $produto['id_produto']; ?>&img=2" alt="<?= htmlspecialchars($produto['descricao_resumida']); ?>">
                
                

                </div>
            </div>

            <div class="informacao_produto">
                <h1><?= htmlspecialchars($produto['descricao_resumida']); ?></h1>
                <p><strong>Descrição:</strong> <?= htmlspecialchars($produto['descricao']); ?></p>
                <p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></p>
                <p><strong>Categoria:</strong> <?= htmlspecialchars($produto['nome_categoria']); ?></p>
                <p><strong>Material:</strong> <?= htmlspecialchars($produto['nome_material']); ?></p>
                <p><strong>Peso:</strong> <?= htmlspecialchars($produto['peso']); ?></p>
                <p><strong>Dimensões:</strong> <?= htmlspecialchars($produto['medida']); ?></p>
                <p>Quantidade em estoque: <?= htmlspecialchars($produto['quantidade_estoque']); ?></p>


                <form id="addCarrinho">
    <input type="hidden" name="id_produto" id="id_produto" value="<?= $produto['id_produto']; ?>">
    Qtde: <input type="number" name="quantidade" id="quantidade" min="1" max="<?= htmlspecialchars($produto['quantidade_estoque']); ?>" value="1">
    <br /><br />
    <button type="button" id="btnAdicionar" style="
        background-color: rgb(85, 85, 212);
        color: white;
        font-weight: bold;
        border-radius: 2px;
        padding: 1em 2em;
        border: none;
    ">Adicionar</button>
</form>

<div id="mensagem"></div>

<script>
  document.getElementById('btnAdicionar').addEventListener('click', function() {
    let id_produto = document.getElementById('id_produto').value;
    let quantidade = parseInt(document.getElementById('quantidade').value);  // Convertendo para inteiro

    // Verificando se a quantidade é válida
    if (quantidade < 20 || quantidade > <?= htmlspecialchars($produto['quantidade_estoque']); ?>) {
        alert("Quantidade inválida. A quantidade deve ser entre 20 e " + <?= htmlspecialchars($produto['quantidade_estoque']); ?>);
        return;
    } else {
        let formData = new FormData();
        formData.append("id_produto", id_produto);
        formData.append("quantidade", quantidade);

        fetch('carrinho.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('mensagem').innerText = data.mensagem;

            if (data.success) {
                window.location.href = "ver_carrinho.php";
            }
        });
    }
});
</script>


            </div>
        </main>
    </div>
</body>
</html>
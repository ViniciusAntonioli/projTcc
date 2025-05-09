<?php
  session_start();

  define('MY_APP', true);

  if (isset($_SESSION['user_id'])) {
    $exibe = $_SESSION['name_user'] . ", SAIR!";
  } else {
    $exibe = "Entrar";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="../footer.css">
  <link rel="stylesheet" href="categorystyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="scriptm.js"></script>
  <title>Categorias</title>
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

      <div class="logo"><img src="../imgs/brindou.com logo1.png" alt="Brindou.com"/></div>



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
        <form class="searchbar" method="GET" action="mochilas.php">
          <input type="text" placeholder="Buscar por produtos" name="search" id="searchb">
          <button type="submit" class="btnpesquisa" id="searchButton">
            <img src="imgs/searchico.webp" alt="Icone de pesquisa" id="iconepesquisa">
          </button>
          </form>
      </div> 
        
      <!-- Menu ao clicar -->
   <div class="leftmenu">
      <div class="titleleftmenu" style="padding-bottom: 1em;">Categorias</div>
	  <a href="../index.html"><div>Início</div></a>
      <a href="#"><div class="mochilas">Mochilas</div></a>
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

  <!--Menu esquerdo -->
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
  <main>
    <div class="filter-container">
      <h2 id="filter-title">Filtrar produtos</h2>

      <details>
        <summary>
          <input type="checkbox" onclick="catmochila()" id="categoriasmochila" name="categoriasmochila" value="catmochila">
          <label for="categoriasmochila">Categorias</label>
            <script>
              function catmochila () {
              let checkboxm = document.querySelector("#categoriasmochila");
              if (checkboxm.checked) {
                document.querySelector("#escolar").checked = true;
                document.querySelector("#academica").checked = true;
                document.querySelector("#viagem").checked = true;
                document.querySelector("#esportiva").checked = true;
                document.querySelector("#executiva").checked = true;
              } else {
                document.querySelector("#escolar").checked = false;
                document.querySelector("#academica").checked = false;
                document.querySelector("#viagem").checked = false;
                document.querySelector("#esportiva").checked = false;
                document.querySelector("#executiva").checked = false;
              }
              
              }

            </script>

        </summary>
      
      <form class="filter-form">
          <div class="filter-option">
              <input type="checkbox" id="escolar" name="mochila" value="1">
              <label for="escolar">Escritório</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="academica" name="mochila" value="2">
              <label for="academica">Ecológico</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="viagem" name="mochila" value="3">
              <label for="viagem">Moda</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="esportiva" name="mochila" value="4">
              <label for="esportiva">Utilidades Domésticas</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="executiva" name="mochila" value="2">
              <label for="executiva">Sacolas</label>
          </div>

      </form>
    </details>
    <hr />
    <details>
      <summary>
        <input type="checkbox" onclick="cor()" id="cor" name="cor" value="cor">
        <label for="cor">Cores</label>
          <script>
            function cor () {
            let checkboxm = document.querySelector("#cor");
            if (checkboxm.checked) {
              document.querySelector("#preto").checked = true;
              document.querySelector("#azul").checked = true;
              document.querySelector("#amarelo").checked = true;
              document.querySelector("#branco").checked = true;
              document.querySelector("#roxo").checked = true;
              document.querySelector("#marrom").checked = true;
              document.querySelector("#verde").checked = true;
              document.querySelector("#cinza").checked = true;
              document.querySelector("#laranja").checked = true;
              document.querySelector("#vermelho").checked = true;
            } else {
              document.querySelector("#preto").checked = false;
              document.querySelector("#azul").checked = false;
              document.querySelector("#amarelo").checked = false;
              document.querySelector("#branco").checked = false;
              document.querySelector("#roxo").checked = false;
              document.querySelector("#marrom").checked = false;
              document.querySelector("#verde").checked = false;
              document.querySelector("#cinza").checked = false;
              document.querySelector("#laranja").checked = false;
              document.querySelector("#vermelho").checked = false;
            }
            
            }

          </script>

      </summary>
    
    <form class="filter-form">
        <div class="filter-option">
            <input type="checkbox" id="preto" name="preto" value="preto">
            <label for="preto">Preto</label>
        </div>
        <div class="filter-option">
          <input type="checkbox" id="laranja" name="laranja" value="laranja">
          <label for="laranja">Laranja</label>
      </div>
        <div class="filter-option">
            <input type="checkbox" id="branco" name="branco" value="branco">
            <label for="branco">Branco</label>
        </div>
        <div class="filter-option">
            <input type="checkbox" id="azul" name="azul" value="azul">
            <label for="azul">Azul</label>
        </div>
        <div class="filter-option">
            <input type="checkbox" id="roxo" name="roxo" value="roxo">
            <label for="roxo">Roxo</label>
        </div>
        <div class="filter-option">
            <input type="checkbox" id="marrom" name="marrom" value="marrom">
            <label for="marrom">Marrom</label>
        </div>
        <div class="filter-option">
          <input type="checkbox" id="verde" name="verde" value="verde">
          <label for="verde">Verde</label>
        </div>
        <div class="filter-option">
          <input type="checkbox" id="vermelho" name="vermelho" value="vermelho">
          <label for="verde">Vermelho</label>
        </div>
        <div class="filter-option">
          <input type="checkbox" id="cinza" name="cinza" value="cinza">
          <label for="cinza">Cinza</label>
        </div>
        <div class="filter-option">
          <input type="checkbox" id="amarelo" name="amarelo" value="amarelo">
          <label for="amarelo">Amarelo</label>
        </div>

    </form>
  </details>
  <hr />
  <details>
    <summary>
      <input type="checkbox" onclick="material()" id="material" name="categoriasmochila" value="material">
      <label for="Material">Material</label>
        <script>
          function material () {
          let checkboxm = document.querySelector("#material");
          if (checkboxm.checked) {
            document.querySelector("#la").checked = true;
            document.querySelector("#nylon").checked = true;
            document.querySelector("#couro").checked = true;
            document.querySelector("#algodao").checked = true;
            document.querySelector("#poliester").checked = true;
          } else {
            document.querySelector("#la").checked = false;
            document.querySelector("#nylon").checked = false;
            document.querySelector("#couro").checked = false;
            document.querySelector("#algodao").checked = false;
            document.querySelector("#poliester").checked = false;
            
          }
          
          }





        </script>

    </summary>
  
  <form class="filter-form">
      <div class="filter-option">
          <input type="checkbox" id="couro" name="couro" value="10">
          <label for="couro">Couro</label>
      </div>
      <div class="filter-option">
          <input type="checkbox" id="algodao" name="algodao" value="40">
          <label for="algodao">Algodão</label>
      </div>
      <div class="filter-option">
          <input type="checkbox" id="la" name="la" value="38">
          <label for="la">Lã</label>
      </div>
      <div class="filter-option">
          <input type="checkbox" id="poliester" name="poliester" value="37">
          <label for="esportiva">Poliester</label>
      </div>
      <div class="filter-option">
        <input type="checkbox" id="nylon" name="nylon" value="36">
        <label for="esportiva">Nylon</label>
    </div>

  </form>
</details>
    <button onclick="showResults();" type="submit">Aplicar Filtro</button>
    <script>
      function showResults() {
        const params = new URLSearchParams();

        document.querySelectorAll("input[type='checkbox']:checked").forEach(cb => {
          // Agrupa os filtros por tipo
          if (cb.name === "mochila") {
            params.append("categoria[]", cb.value);
          }
          if (["preto","azul","amarelo","branco","roxo","marrom","verde","cinza","laranja","vermelho"].includes(cb.name)) {
            params.append("cor[]", cb.value);
          }
          if (["couro", "algodao", "la", "poliester", "nylon"].includes(cb.name)) {
            params.append("material[]", cb.value);
          }
        });

        // Redireciona para mochilas.php com os filtros na URL
        window.location.href = "mochilas.php?" + params.toString();
      }
</script>



  </div>
  <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
  <div class="top">Mochilas e bolsas</div> <br />
  <div style="display: flex; justify-content: start; width: 100%; gap: 50px; ">
    <button id="btnpair" onclick="pair()">Mudar visualização</button>
    <h3 onclick="limpa()" id="limpa">Limpar filtros</h3>
  </div>
  <hr />
  
<?php

include 'index.php';

?>


<script>

    const images = document.querySelectorAll(".hover-img");

    images.forEach((img) => {
        const originalSrc = img.src;               
        const hoverSrc = "imgs/mochilas/" + img.getAttribute("data-hover"); 

        img.addEventListener("mouseenter", () => {
            img.src = hoverSrc;
        });

        img.addEventListener("mouseleave", () => {
            img.src = originalSrc;
        });
    });

</script>





</div>

  </main>
  <footer>
    <div class="footer-container">
      <div class="footer-section">
        <h3>GMA Gifts</h3>
        <p>Soluções criativas para empresas de brindes.</p>
      </div>
      <div class="footer-section">
        <h3>Links Rápidos</h3>
        <ul>
          <li><a href="#">Sobre Nós</a></li>
          <li><a href="#">Produtos</a></li>
          <li><a href="#">Contato</a></li>
          <li><a href="#">Política de Privacidade</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Contato</h3>
        <p><i class="fas fa-phone"></i> (11) 1111-2222</p>
        <p><i class="fas fa-envelope"></i> contato@gmagifts.com</p>
        <p><i class="fas fa-map-marker-alt"></i> Rua dos Brindes, 123, São Paulo, SP</p>
      </div>
      <div class="footer-section">
        <h3>Siga-nos</h3>
        <div class="social-icons">
          <a href="" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a href="" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="" target="_blank"><i class="fab fa-twitter"></i></a>
          <a href="" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 GMA Gifts. Todos os direitos reservados.</p>
    </div>
  </footer>







</body>
</html>
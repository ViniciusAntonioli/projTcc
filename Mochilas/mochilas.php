<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylesm.css">
  <link rel="stylesheet" href="../footer.css">
  <link rel="stylesheet" href="categorystyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
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

      <div class="logo">GMA Gifts</div>
      <div class="rightside">

       <div class="login" style="text-align: center;">
        <img src="imgs/login.ico" alt="login" style="width: 40px; height: 40px;">
        <div style="font-weight: bold; font-size: 0.8em; color: rgb(255, 104, 17); margin-top: 5px;">Entrar</div> 
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
              <input type="checkbox" id="escolar" name="mochila" value="escolar">
              <label for="escolar">Mochila Escolar</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="academica" name="mochila" value="academica">
              <label for="academica">Mochila Acadêmica</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="viagem" name="mochila" value="viagem">
              <label for="viagem">Mochila de Viagem</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="esportiva" name="mochila" value="esportiva">
              <label for="esportiva">Mochila Esportiva</label>
          </div>
          <div class="filter-option">
              <input type="checkbox" id="executiva" name="mochila" value="executiva">
              <label for="executiva">Mochila Executiva</label>
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
          <input type="checkbox" id="couro" name="couro" value="couro">
          <label for="couro">Couro</label>
      </div>
      <div class="filter-option">
          <input type="checkbox" id="algodao" name="algodao" value="algodao">
          <label for="algodao">Algodão</label>
      </div>
      <div class="filter-option">
          <input type="checkbox" id="la" name="la" value="la">
          <label for="la">Lã</label>
      </div>
      <div class="filter-option">
          <input type="checkbox" id="poliester" name="poliester" value="poliester">
          <label for="esportiva">Poliester</label>
      </div>
      <div class="filter-option">
        <input type="checkbox" id="nylon" name="nylon" value="nylon">
        <label for="esportiva">Nylon</label>
    </div>

  </form>
</details>
    <button onclick="showResults();" type="submit">Aplicar Filtro</button>
  </div>
  <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
  <div class="top">Mochilas e bolsas</div> <br />
  <div style="display: flex; justify-content: start; width: 100%; gap: 50px; ">
    <button id="btnpair" onclick="pair()">Mudar visualização</button>
    <h3 onclick="limpa()" id="limpa">Limpar filtros</h3>
  </div>
  <hr />
  <!--<div class="products">
    <div class="product product-1">
        <a href="detalhes/detalhes.html">
            <img class="hover-img" id="m1" src="imgs/mochilas/1.webp" data-hover="1t.webp" alt="mochila 1">
            <div class="details"><h2>01229</h2><p>Mochila para Notebook Polo King 20 litros</p></div>
        </a>
    </div>
    <div class="product product-2">
        <img class="hover-img" id="m2" src="imgs/mochilas/img2.jfif" data-hover="img2tras.jfif" alt="mochila 2">
        <div class="details"><h2>01902</h2><p>Mochila couro sintético USB 23 litros</p></div>
    </div>
    <div class="product product-3">
        <img class="hover-img" id="m3" src="imgs/mochilas/img3.jfif" data-hover="img3tras.jpg" alt="mochila 3">
        <div class="details"><h2>06032</h2><p>Sacola de poliester</p></div>
    </div>
    <div class="product product-4">
        <img class="hover-img" id="m4" src="imgs/mochilas/img4.jfif" data-hover="img4tras.jpg" alt="mochila 4">
        <div class="details"><h2>01232</h2><p>Mochila Funcional Oxford 19 litros</p></div>
    </div>
    <div class="product product-5">
        <img class="hover-img" id="m5" src="imgs/mochilas/img5.jfif" data-hover="img5tras.jpg" alt="mochila 5">
        <div class="details"><h2>02414</h2><p>Mochila de Nylon 21 litros</p></div>
    </div>
    <div class="product product-6">
        <img class="hover-img" id="m6" src="imgs/mochilas/img6.jpg" data-hover="img6tras.jpg" alt="mochila 6">
        <div class="details"><h2>03782</h2><p>Mochila Nylon 23 litros</p></div>
    </div>
	    <div class="product product-7">
        <img class="hover-img" id="m7" src="imgs/mochilas/img7.jfif" data-hover="img7tras.jpg" alt="mochila 7">
        <div class="details"><h2>09238</h2><p>Mochila de Nylon 29 Litros</p></div>
    </div>
	    <div class="product product-8">
        <img class="hover-img" id="m8" src="imgs/mochilas/img8.jfif" data-hover="img8tras.jpg" alt="mochila 8">
        <div class="details"><h2>09283</h2><p>Mochila Nylon 43 litros</div>
    </div>
	    <div class="product product-9">
        <img class="hover-img" id="m9" src="imgs/mochilas/img9.jfif" data-hover="img9tras.jpg" alt="mochila 9">
        <div class="details"><h2>02903</h2><p>Bolsa Esportiva 46 litros</p></div>
    </div>
	    <div class="product product-10">
        <img class="hover-img" id="m10" src="imgs/mochilas/img10.jfif" data-hover="img10tras.jpg" alt="mochila 10">
        <div class="details"><h2>02888</h2><p>Sacola TNT</p></div>
    </div>
	    <div class="product product-11">
        <img class="hover-img" id="m11" src="imgs/mochilas/img11.jfif" data-hover="img11tras.jpg" alt="mochila 11">
        <div class="details"><h2>04521</h2><p>Sacola TNT</p></div>
    </div>
	    <div class="product product-12">
        <img class="hover-img" id="m12" src="imgs/mochilas/img12.jfif" data-hover="img12tras.jpg" alt="mochila 12">
        <div class="details"><h2>01222</h2><p>Mochila de Poliester USB 25 litros</p></div>
    </div>
</div> -->
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
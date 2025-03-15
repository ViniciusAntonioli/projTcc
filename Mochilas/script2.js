let images = [];
let currentImageIndex = 0;

document.addEventListener("DOMContentLoaded", function() {
    const idProduto = new URLSearchParams(window.location.search).get("id");

    if (!idProduto) {
        console.error("ID do produto não encontrado na URL.");
        return;
    }

    fetch(`listar_img.php?id=${idProduto}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                images = data;
                document.getElementById("mainImage").src = images[0]; // Define a imagem principal
                updateThumbnails();
            } else {
                console.error("Nenhuma imagem encontrada.");
            }
        })
        .catch(error => console.error("Erro ao carregar imagens:", error));
});

// Função para avançar a imagem
function nextImage() {
    if (images.length === 0) return;
    currentImageIndex = (currentImageIndex + 1) % images.length;
    document.getElementById("mainImage").src = images[currentImageIndex];
}

// Função para voltar à imagem anterior
function prevImage() {
    if (images.length === 0) return;
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    document.getElementById("mainImage").src = images[currentImageIndex];
}

// Função para atualizar as miniaturas
function updateThumbnails() {
    let thumbnailsContainer = document.querySelector(".thumbnail-container");
    thumbnailsContainer.innerHTML = ""; // Limpa as miniaturas

    images.forEach((imgSrc, index) => {
        let imgElement = document.createElement("img");
        imgElement.src = imgSrc;
        imgElement.classList.add("thumbnail");
        imgElement.onclick = function() {
            currentImageIndex = index;
            document.getElementById("mainImage").src = images[currentImageIndex];
        };
        thumbnailsContainer.appendChild(imgElement);
    });
}
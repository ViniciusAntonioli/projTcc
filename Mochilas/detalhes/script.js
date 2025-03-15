let currentSlide = 0;

function changeSlide(direction) {
    const slides = document.querySelectorAll('.slide');
    currentSlide += direction;

    if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    } else if (currentSlide >= slides.length) {
        currentSlide = 0;
    }

    const offset = -currentSlide * 100;
    document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
}

// Auto slide every 3 seconds
setInterval(() => changeSlide(1), 3000);

let currentIndex = 0;

function moveCarousel(direction) {
    const items = document.querySelectorAll('.banner-boletim-item');
    const totalItems = items.length;
    
    currentIndex += direction;

    // Restringe o índice para que não saia do intervalo
    if (currentIndex < 0) {
        currentIndex = totalItems - 6; // Volta para o final
    } else if (currentIndex > totalItems - 6) {
        currentIndex = 0; // Retorna ao início
    }

    // Mover o carrossel
    const itemWidth = items[0].offsetWidth + 10; // 10 é a margem entre os itens
    const offset = -currentIndex * itemWidth; 
    document.querySelector('.banner-boletim-items').style.transform = `translateX(${offset}px)`;
}

/*JAVASCRIPT DA PÁGINA DE PRODUTO DETALHADO*/
/*JULIO*/

// Array de imagens
const images = [
    "imgs/produtos_detalhados/mochila_notebook_preta.webp",
    "imgs/produtos_detalhados/mochila_notebook_preta1.webp",
    "imgs/produtos_detalhados/mochila_notebook_preta2.webp",
    "imgs/produtos_detalhados/mochila_notebook_preta3.webp",
    "imgs/produtos_detalhados/icone_video.png"
];

// Índice da imagem atual
let currentImageIndex = 0;

// Função para trocar a imagem principal ao clicar em uma miniatura
function changeImage(imageSrc) {
    document.getElementById("mainImage").src = imageSrc;
    currentImageIndex = images.indexOf(imageSrc); // Atualiza o índice da imagem atual
    updateThumbnails();
}

// Nova função



// Função para destacar a miniatura ativa
function updateThumbnails() {
    document.querySelectorAll(".thumbnail").forEach((thumbnail, index) => {
        thumbnail.classList.toggle("active", index === currentImageIndex);
    });
}

// Zoom na imagem principal
document.addEventListener("DOMContentLoaded", () => {
    const mainImage = document.getElementById("mainImage");

    mainImage.addEventListener("mouseenter", () => {
        mainImage.classList.add("zoomed");
    });

    mainImage.addEventListener("mouseleave", () => {
        mainImage.classList.remove("zoomed");
        mainImage.style.transformOrigin = "center";
    });

    mainImage.addEventListener("mousemove", (event) => {
        if (mainImage.classList.contains("zoomed")) {
            const rect = mainImage.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;

            mainImage.style.transformOrigin = `${x}% ${y}%`;
        }
    });
});

// Carrossel do bloco "você vai se interessar"
let deslocamentoScroll = 0;

function slideProximo() {
    const itens = document.querySelector('.itens-carrossel');
    deslocamentoScroll += itens.clientWidth / 6;

    if (deslocamentoScroll >= itens.scrollWidth - itens.clientWidth) {
        deslocamentoScroll = 0;
    }

    itens.scrollTo({
        left: deslocamentoScroll,
        behavior: "smooth"
    });
}

function slideAnterior() {
    const itens = document.querySelector('.itens-carrossel');
    deslocamentoScroll -= itens.clientWidth / 6;

    if (deslocamentoScroll < 0) {
        deslocamentoScroll = itens.scrollWidth - itens.clientWidth;
    }

    itens.scrollTo({
        left: deslocamentoScroll,
        behavior: "smooth"
    });
}

// Chama updateThumbnails ao carregar a página
window.onload = updateThumbnails;

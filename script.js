/*

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

let currentIndex1 = 0;

function moveCarousel1(direction) {
    const items = document.querySelectorAll('.banner-boletim-item2');
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
    document.querySelector('.banner-boletim-items2').style.transform = `translateX(${offset}px)`;
}

*/

/*carrossel home*/
let count = 1;

document.getElementById("radio1").checked = true;

setInterval( function(){
    nextImage();
}, 7000)

function nextImage(){
    count++;
    if(count>4){
        count = 1;
    }

    document.getElementById("radio"+count).checked = true;


}

/*Fim carrossel home*/


function abrirPopup() {
    document.getElementById("popup").style.display = "block";
    document.getElementById("fundo-escuro").style.display = "block";
}

function fecharPopup() {
    document.getElementById("popup").style.display = "none";
    document.getElementById("fundo-escuro").style.display = "none";
}

function fecharPopupSucesso(event) {
    // Verifica se o clique foi fora do conteúdo do popup de sucesso
    if (event.target === document.getElementById("popup-sucesso") || event.target === document.getElementById("close-sucesso-btn")) {
        document.getElementById("popup-sucesso").style.display = "none"; // Oculta o popup de sucesso
        document.getElementById("fundo-escuro").style.display = "none"; // Oculta o fundo escuro
    }
}

function assinarNewsletter() {
    const email = document.getElementById("email").value;

    if (email) {
        $.ajax({
            url: 'processar_newsletter.php', // URL do arquivo PHP que processa o e-mail
            type: 'POST',
            data: { email: email },
            dataType: 'json', // Espera uma resposta em JSON
            success: function(response) {
                const messageElement = document.getElementById("message");
                messageElement.textContent = response.message;

                // Adiciona a classe correspondente à resposta
                if (response.status === "success") {
                    messageElement.classList.add("success");
                    messageElement.classList.remove("error");
                    document.getElementById("sucesso-message").textContent = response.message; // Atualiza a mensagem de sucesso
                    document.getElementById("popup-sucesso").style.display = "block"; // Mostra o popup de sucesso
                    fecharPopup(); // Fecha o popup de inscrição
                } else {
                    messageElement.classList.add("error");
                    messageElement.classList.remove("success");
                }

                // Exibe a mensagem
                messageElement.style.display = "block"; // Mostra a mensagem
            },
            error: function() {
                const messageElement = document.getElementById("message");
                messageElement.textContent = 'Ocorreu um erro. Tente novamente.';
                messageElement.classList.add("error");
                messageElement.classList.remove("success");
                messageElement.style.display = "block"; // Mostra a mensagem
            }
        });
        return false; // Impede o envio do formulário
    }
    return true; // Se não houver e-mail, o formulário não deve ser enviado
}

// Abrir o popup automaticamente ao carregar a página
window.onload = function() {
    abrirPopup();
};









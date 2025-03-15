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

function limpa() {
    document.querySelector("#escolar").checked = false;
                document.querySelector("#academica").checked = false;
                document.querySelector("#viagem").checked = false;
                document.querySelector("#esportiva").checked = false;
                document.querySelector("#executiva").checked = false;
                document.querySelector("#preto").checked = false;
                document.querySelector("#azul").checked = false;
                document.querySelector("#amarelo").checked = false;
                document.querySelector("#branco").checked = false;
                document.querySelector("#roxo").checked = false;
                document.querySelector("#marrom").checked = false;
                document.querySelector("#verde").checked = false;
                document.querySelector("#cinza").checked = false;
                document.querySelector("#cor").checked = false;
                document.querySelector("#categoriasmochila").checked = false;
                document.querySelector("#la").checked = false;
                document.querySelector("#nylon").checked = false;
                document.querySelector("#couro").checked = false;
                document.querySelector("#algodao").checked = false;
                document.querySelector("#poliester").checked = false;    
                document.querySelector("#material").checked = false;   
                document.querySelector("#vermelho").checked = false;   
                
            }

function pair() {
    let pair = document.querySelector(".products");
    pair.classList.toggle("active");
}


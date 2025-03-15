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
                document.querySelector("#laranja").checked = false;  
            }

function pair() {
    let pair = document.querySelector(".products");
    pair.classList.toggle("active");
}

function showResults() {
    let imgstart = [];
    let qtresultados = 0;

    for(var i = 1; i<13;i++) {
        imgstart.unshift('.product-'+i);
    }

    imgstart.forEach((img) => {
        document.querySelector(img).style.display = "none";
    });

    let images = [];
    if(document.querySelector("#cinza").checked == true) {
        images.unshift(".product-2", ".product-7");
        qtresultados+=2;

    } 
    if(document.querySelector("#preto").checked == true) {
        images.unshift(".product-1", ".product-3",".product-5",".product-6",".product-8",".product-12");
        qtresultados+=6;
    }
    if(document.querySelector("#azul").checked == true) {
        images.unshift(".product-9")
        qtresultados+=1;
    }if(document.querySelector("#laranja").checked == true) {
        images.unshift(".product-10")
        qtresultados+=1;
    }if(document.querySelector("#vermelho").checked == true) {
        images.unshift(".product-4",".product-11")
        qtresultados+=2;
    }         

        

       
        images.forEach((img) => {
            document.querySelector(img).style.display = "grid";
        });


        document.getElementById("resultsp").innerHTML = qtresultados + " Resultados encontrados";
   

	
	
	
}
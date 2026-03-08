//Zmena pozadia strán
const container = document.getElementsByClassName("carousel-container")[0];
const pozadia = [
    'assets/images/carousel_background1.jpg',
    'assets/images/carousel_background2.png',
    'assets/images/carousel_background3.jpg',
    'assets/images/carousel_background4.jpg',
    'assets/images/carousel_background5.jpg'
]

const farba_pozadia = [
    "0 0 20px rgba(255, 5, 5, 0.5)",
    "0 0 20px rgba(5, 9, 255, 0.5)",
    "0 0 20px rgba(100, 100, 100, 0.85)",
    "0 0 20px rgba(115, 22, 128, 0.65)",
    "0 0 20px rgba(0, 133, 185, 0.75)"
]

//Swapovanie strán
let cislo_strany = 1;
zobrazitStranu(cislo_strany);

function dalsiaStrana(n) {
    zobrazitStranu(cislo_strany += n);
}

function nastavitStranu(n) {
    zobrazitStranu(cislo_strany = n);
}

function zobrazitStranu(n) {
    let strany = document.getElementsByClassName("strana");
    let body = document.getElementsByClassName("bod");
    if (n > strany.length)
    {
        cislo_strany = 1
    }

    if (n < 1) 
    { 
        cislo_strany = strany.length
    }

    for (let i = 0; i < strany.length; i++) 
    {
        strany[i].style.display = "none";
    }

    for (let i = 0; i < body.length; i++) {
        body[i].className = body[i].className.replace(" active", "");
    }

    strany[cislo_strany-1].style.display = "block";
    body[cislo_strany-1].className += " active";

    container.style.backgroundImage = `url("${pozadia[cislo_strany-1]}")`
    container.style.boxShadow = farba_pozadia[cislo_strany-1];
    console.log(container.style.boxShadow = farba_pozadia[cislo_strany-1])
}
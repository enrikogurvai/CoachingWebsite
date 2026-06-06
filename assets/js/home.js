class Carousel {
    constructor() {
        this.container = document.querySelector(".carousel-container");
        this.strany = document.querySelectorAll(".strana");
        this.body = document.querySelectorAll(".bod");
        this.tlacidloPredchadzajuce = document.querySelector(".predchadzajuce");
        this.tlacidloDalsie = document.querySelector(".dalsie");

        this.pozadia = [
            'assets/images/carousel_background1.jpg',
            'assets/images/carousel_background2.png',
            'assets/images/carousel_background3.jpg',
            'assets/images/carousel_background4.jpg',
            'assets/images/carousel_background5.jpg'
        ];

        this.farbyPozadia = [
            "0 0 20px rgba(255, 5, 5, 0.5)",
            "0 0 20px rgba(5, 9, 255, 0.5)",
            "0 0 20px rgba(100, 100, 100, 0.85)",
            "0 0 20px rgba(115, 22, 128, 0.65)",
            "0 0 20px rgba(0, 133, 185, 0.75)"
        ];

        this.aktualnyIndex = 0;
        this.autoplayInterval = null;

        this.inicializujUdalosti();
        this.zobrazStranu(this.aktualnyIndex);
        this.spustiAutoplay();
    }

    zobrazStranu(novyIndex) {
        if (novyIndex >= this.strany.length) {
            this.aktualnyIndex = 0;
        } else if (novyIndex < 0) {
            this.aktualnyIndex = this.strany.length - 1;
        } else {
            this.aktualnyIndex = novyIndex;
        }

        // UPRAVENÉ: Odoberáme triedu .active (už žiadny style.display)
        this.strany.forEach(strana => strana.classList.remove("active"));
        this.body.forEach(bod => bod.classList.remove("active"));

        // Pridávame triedu .active pre aktuálnu stranu a bodku
        this.strany[this.aktualnyIndex].classList.add("active");
        this.body[this.aktualnyIndex].classList.add("active");

        // Zmena pozadia a tieňa na kontajneri
        this.container.style.backgroundImage = `url("${this.pozadia[this.aktualnyIndex]}")`;
        this.container.style.boxShadow = this.farbyPozadia[this.aktualnyIndex];
    }

    dalsiaStrana(smer) {
        this.zobrazStranu(this.aktualnyIndex + smer);
    }

    nastavStranu(index) {
        this.zobrazStranu(index);
    }

    spustiAutoplay() {
        this.autoplayInterval = setInterval(() => {
            this.dalsiaStrana(1);
        }, 2500);
    }

    zastavAutoplay() {
        clearInterval(this.autoplayInterval);
    }

    inicializujUdalosti() {
        this.tlacidloPredchadzajuce.addEventListener("click", () => this.dalsiaStrana(-1));
        this.tlacidloDalsie.addEventListener("click", () => this.dalsiaStrana(1));

        this.body.forEach((bod, i) => {
            bod.addEventListener("click", () => this.nastavStranu(i));
        });

        this.container.addEventListener("mouseenter", () => this.zastavAutoplay());
        this.container.addEventListener("mouseleave", () => this.spustiAutoplay());
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new Carousel();
});
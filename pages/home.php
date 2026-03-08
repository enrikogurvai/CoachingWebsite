<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
<div class="uvod">
    <h1>Vitaj na stránke GOAT coachingu!</h1>
</div>

<div class="carousel-container";>
    <div class="strana active">
        <h2>Staň sa GOAT v LoL a TFT!</h2>
        <p>Profesionálny coaching pre hráčov všetkých úrovní. Zlepši svoje zručnosti, rank a herné rozhodovanie s našimi skúsenými coachmi.</p>
    </div>
    <div class="strana">
        <h2>Prečo GOAT Coaching?</h2>
        <p>- Osobný prístup podľa tvojej úrovne a štýlu hry.<br>
           - Naši coachovia sú high-elo hráči (Challenger / Grandmaster).<br>
           - Naučíš sa makro rozhodovanie, ekonomiku, positioning a itemizáciu.<br>
           - Analýza tvojich hier a konkrétne rady.</p>
    </div>
    <div class="strana">
        <h2>Ako prebieha coaching?</h2>
        <p>1. Vyber si hru: League of Legends alebo TFT.<br>
           2. Dohodni si termín s coachom.<br>
           3. Hraj hru, coach ťa opravuje a dáva tipy.<br>
           4. Po session dostaneš odporúčania, čo trénovať.</p>
    </div>
    <div class="strana">
        <h2>Čo hovoria naši hráči</h2>
        <p>“Vďaka GOAT Coaching som sa posunul z Gold 3 na Platinum 1 len za 2 mesiace! Ich tipy na positioning a itemizáciu úplne zmenili moju hru.”</p>
    </div>
    <div class="strana">
        <h2>Staň sa GOAT už dnes!</h2>
        <p>Rezervuj si session a začni svoju cestu k tomu, aby si sa stal top hráčom v LoL a TFT.</p>
    </div>

        <span class="predchadzajuce" onclick="dalsiaStrana(-1)"><</span>
        <span class="dalsie" onclick="dalsiaStrana(1)">></span>

    <div class="body">
        <span class="bod active" onclick="nastavitStranu(1)"></span>
        <span class="bod" onclick="nastavitStranu(2)"></span>
        <span class="bod" onclick="nastavitStranu(3)"></span>
        <span class="bod" onclick="nastavitStranu(4)"></span>
        <span class="bod" onclick="nastavitStranu(5)"></span>
    </div>
</div>
<script src="assets/js/home.js"></script>
</body>
</html>
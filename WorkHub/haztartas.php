<?php
    include("adatbazis.php");
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./profil.css">
    <link rel="stylesheet" href="./bejelentkezes.css">
    <script src="https://kit.fontawesome.com/88f05daeb4.js" crossorigin="anonymous"></script>
    <title>Haztartas</title>
</head>
<body>
<header>
    <h1>Workhub</h1>
</header>

<nav class="navbar">
    <ul> 
        <li><a href="fooldal.html">Főoldal <i class="fa-solid fa-house"></i></a></li>
        <li><a href="rolunk.html">Rólunk <i class="fa-solid fa-info"></i></a></li>
        <li><a href="szolgaltatasok.html">Szolgáltatások <i class="fa-regular fa-clipboard"></i></a></li>
    </ul>
</nav>
<br>

<div class='haztartasok'>
    <form action='./profil.php' method='POST'>
        <h1 class='felirat'>Háztartások! </h1>
            <div class="haztartasok-doboz">
                <div id="centeralis">
                    <h2 class="doboz-nev">Háztartás - $haztartasneve</h2>
                    <br>
                    <div class="adat-doboz">
                        <h2 class="doboz-nev">Családtagok</h2>
                    </div>
                    <div class="adat-doboz">
                        <label>$tag leirassal / reszletesbben: $tagnev, $rating/5, $keszfeladatok [profil] [uzenet(???)]</label>
                    </div>
                    <div class="adat-doboz">
                        <label>$tag leirassal / reszletesbben: $tagnev, $rating/5, $keszfeladatok [profil] [uzenet(???)]</label>
                    </div>
                    <div class="adat-doboz">
                        <label>$tag leirassal / reszletesbben: $tagnev, $rating/5, $keszfeladatok [profil] [uzenet(???)]</label>
                    </div>
                    <div class="adat-doboz">
                        <label>$tag leirassal / reszletesbben: $tagnev, $rating/5, $keszfeladatok [profil] [uzenet(???)]</label>
                    </div>
                </div>
            </div>
            <div class="chat-doboz">
                <div id="centeralis">
                    <h2 class="doboz-nev">Háztartás chat</h2>
                    <div class="adat-doboz">
                        <label> üzenet az egész családnak</label>  
                    </div>
                </div>
            </div>
    </form>
</div>

    
</body>
</html>

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
    <title>Feladatok</title>
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

<div class='udvozlolap'>
    <form action='./profil.php' method='POST'>
        <h1 class='felirat'>Feladatok</h1>
            <div class="user-doboz">
                <div id="centeralis">
                    <h2 class="doboz-nev">Új feladat hozzáadása [+]</h2>
                    <br>
                    <h2 class="doboz-nev">Keresés [               ]</h2>
                    <br>
                    <h2 class="doboz-nev">Szűrő: Összes</h2>
                    <div class="adat-doboz">
                        <h3 class="doboz-nev">Összes [$db] Nyitott [$db] Elfogadott [$db] Kész [$db]</h3>
                    </div>
                </div>
            </div>

            <div class="user-doboz">
                <div id="centeralis">
                    <h2 class="doboz-nev">Nyitott feladatok</h2>
                    <br>
                    
                </div>
            </div>

            <div class="user-doboz">
                <div id="centeralis">
                    <h2 class="doboz-nev">Elfogadott feladatok (általam)</h2>
                    <br>
                    
                </div>
            </div>

            <div class="user-doboz">
                <div id="centeralis">
                    <h2 class="doboz-nev">Kész feladatokk</h2>
                    <br>
                    
                </div>
            </div>
    </form>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<p>p</p>


<?php


$felhasznalok = [
    ["fNev" => "admin", "jelszo" => "admin"],
    ["fNev" => "pista", "jelszo" => "pista"],
];

$urlap = "";
    echo $urlap;

 echo "<h1 class='felirat'>Üdvözlünk " .$_SESSION['felhasznalonev'] ."!</h1>";

?>
    
    
</body>
</html>


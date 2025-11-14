<?php
    include("adatbazis.php");
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./profiladat.css">
    <script src="https://kit.fontawesome.com/88f05daeb4.js" crossorigin="anonymous"></script>
    <title>Profil - Személyes</title>
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
        <div class="user-doboz">
            <div id="centeralis">
                <h2 class="doboz-nev">Profilom</h2>
                    <div class="pfp-doboz">
                        <img src="pfp.jpg" alt="Avatar" class="avatar">
                        <div class="user-adat-doboz">    
                            <label>$username</label><i class="fa-solid fa-user"></i>
                        </div>
                    </div>

                    <label>$created_at</label>

                    <div class="user-adat-doboz">
                        <label>$email</label>
                    </div>
                    
                    <div class="user-adat-ertekeles-doboz">
                        <label>értékelés: 9.8/10 elvégzett feladatok: ⭐⭐⭐⭐⭐ </label>
                    </div>
            </div>
        </div>
        <div class="user-doboz">
            <div id="centeralis">
                <h2 class="doboz-nev">Leírás</h2>
                    <div class="adat-doboz">
                        <ul class="leiras"> 
                            <li>1. I enjoy reading books in my free time and learning new things.</li>
                            <li>2. My favorite hobby is painting, which helps me express my creativity and emotions easily. </li>
                            <li>3. I have a cat named Whiskers who loves to play every day. </li>
                            <li>4. My family enjoys hiking together on weekends, exploring nature and spending quality time. </li>
                            <li>5. Cooking is one of my passions, and I often try new recipes at home.</li>
                        </ul>
                    </div>
            </div>
        </div>
    </form>
</div>


<?php

// az adatbazis.php-rol keri el az adatot mert ossze van kotve
//$felhasznalok = [
//    ["fNev" => "admin", "jelszo" => "admin"],
//    ["fNev" => "pista", "jelszo" => "pista"],
//];

$urlap = "";
    echo $urlap;

 $sql = "INSERT INTO `felhasznalok` (`id`, `username`, `email`, `jelszo_hash`, `vezetek_nev`, `kereszt_nev`, `profil_kep`, `letrejott`, `is_active`) VALUES (\'1\', \'adminisztrator\', \'admin@gmail.com\', \'megaadmin\', \'Admin\', \'Mega\', NULL, current_timestamp(), \'1\');";
?>
    
    
</body>
</html>

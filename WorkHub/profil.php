<?php
require_once 'adatbazis.php';

// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION["felhasznalo_id"])) {
    header("Location: teszt_bejelentkezes.php");
    exit();
}

// Felhasználó adatainak lekérése
try {
    $stmt = $pdo->prepare("SELECT username, email, vezetek_nev, kereszt_nev, profil_kep, letrejott FROM felhasznalok WHERE id = ?");
    $stmt->execute([$_SESSION["felhasznalo_id"]]);
    $felhasznalo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$felhasznalo) {
        header("Location: teszt_bejelentkezes.php");
        exit();
    }
} catch(PDOException $e) {
    die("Hiba az adatok lekérése során: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./profil.css">
    <script src="https://kit.fontawesome.com/88f05daeb4.js" crossorigin="anonymous"></script>
    <title>Profil</title>
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
        <li><a href="bejelentkezes.php">Kijelentkezés <i class="fa-solid fa-right-from-bracket"></i></a></li>
    </ul>
</nav>
<br>

<div class='udvozlolap'>
    <h1 class='felirat'>Üdvözlünk <?php echo htmlspecialchars($felhasznalo['username']); ?>!</h1>
    
    <div class="user-doboz">
        <h2 class="doboz-nev"><a href="profiladatok.php" id="feher-a">Profilom</a></h2>
        <div id="centeralis-user">
            <div class="adat-doboz-user">
                <i class="fa-solid fa-user"></i>
                <label><?php echo htmlspecialchars($felhasznalo['vezetek_nev'] . ' ' . $felhasznalo['kereszt_nev']); ?></label>  
            </div>
            <div class="user-adat-ertekeles-doboz">
                <label>Email: <?php echo htmlspecialchars($felhasznalo['email']); ?></label>
            </div>
            <div class="user-adat-ertekeles-doboz">
                <label>Regisztráció: <?php echo $felhasznalo['letrejott']; ?></label>
            </div>
        </div>
    </div>
    
    <div class="teljesitmenyek-doboz">
        <h2 class="doboz-nev">Teljesítmények</h2>
        <div id="centeralis-masik">
            <div class="adat-doboz">
                <label>Heti teljesítmények: 0/0</label>  
            </div>
            <div class="adat-doboz">
                <label>Legaktívabb nap: Még nincs adat</label>
            </div>
            <div class="adat-doboz">
                <label>Kedvenc feladattípus: Még nincs adat</label>
            </div>
        </div>
    </div>
    
    <div class="feladatok-doboz">
        <h2 class="doboz-nev">Legutóbb befejezett feladataim</h2>
        <div id="centeralis-masik">
            <div class="adat-doboz">
                <label>Még nincsenek feladataid</label>
            </div>
        </div>
    </div>
    
    <div class="haztartasok-doboz">
        <h2 class="doboz-nev">Háztartások</h2>
        <div id="centeralis-masik">
            <div class="adat-doboz">
                <label>Még nincs háztartásod</label>  
            </div>
            <div class="adat-doboz">
                <label><a href="./haztartas.php" id="feher-a">Új háztartás létrehozása</a></label>
            </div>
            <div class="adat-doboz">
                <label><a href="./haztartas.php" id="feher-a">Csatlakozás meglévő háztartáshoz</a></label>
            </div>
        </div>
    </div> 
</div>
</body>
</html>

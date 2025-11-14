<?php
require_once 'adatbazis.php';

// A felhasználó csak bejelentkezés után tekintheti meg az adatait
if (!isset($_SESSION['felhasznalo_id'])) {
    header('Location: bejelentkezes.php');
    exit();
}

try {
    $stmt = $pdo->prepare('SELECT username, email, vezetek_nev, kereszt_nev, profil_kep, letrejott FROM felhasznalok WHERE id = ?');
    $stmt->execute([$_SESSION['felhasznalo_id']]);
    $felhasznalo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$felhasznalo) {
        header('Location: bejelentkezes.php');
        exit();
    }
} catch (PDOException $e) {
    die('Hiba az adatok lekérése során: ' . $e->getMessage());
}

$profilKep = !empty($felhasznalo['profil_kep']) ? $felhasznalo['profil_kep'] : 'pfp.jpg';
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
        <li><a href="profil.php">Vissza a profilhoz <i class="fa-solid fa-arrow-left"></i></a></li>
    </ul>
</nav>
<br>

<div class='udvozlolap'>
    <div class="user-doboz">
        <div id="centeralis">
            <h2 class="doboz-nev">Profilom</h2>
            <div class="pfp-doboz">
                <img src="<?php echo htmlspecialchars($profilKep); ?>" alt="Avatar" class="avatar">
                <div class="user-adat-doboz">
                    <label><?php echo htmlspecialchars($felhasznalo['username']); ?></label>
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <div class="user-adat-doboz">
                <label>Regisztráció: <?php echo htmlspecialchars($felhasznalo['letrejott']); ?></label>
            </div>

            <div class="user-adat-doboz">
                <label><?php echo htmlspecialchars($felhasznalo['email']); ?></label>
            </div>

            <div class="user-adat-doboz">
                <label><?php echo htmlspecialchars($felhasznalo['vezetek_nev'] . ' ' . $felhasznalo['kereszt_nev']); ?></label>
            </div>

            <div class="user-adat-ertekeles-doboz">
                <label>Értékelés: 9.8/10 &bull; Elvégzett feladatok: ⭐⭐⭐⭐⭐</label>
            </div>
        </div>
    </div>
    <div class="user-doboz">
        <div id="centeralis">
            <h2 class="doboz-nev">Leírás</h2>
            <div class="adat-doboz">
                <ul class="leiras">
                    <li>Felhasználónév: <?php echo htmlspecialchars($felhasznalo['username']); ?></li>
                    <li>Teljes név: <?php echo htmlspecialchars($felhasznalo['vezetek_nev'] . ' ' . $felhasznalo['kereszt_nev']); ?></li>
                    <li>E-mail: <?php echo htmlspecialchars($felhasznalo['email']); ?></li>
                    <li>Csatlakozás dátuma: <?php echo htmlspecialchars($felhasznalo['letrejott']); ?></li>
                    <li>Adataid frissítéséhez keresd fel a profil szerkesztése menüpontot.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>

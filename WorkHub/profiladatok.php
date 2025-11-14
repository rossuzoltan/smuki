<?php
require_once 'adatbazis.php';

if (!isset($_SESSION["felhasznalo_id"])) {
    header("Location: bejelentkezes.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT username, email, vezetek_nev, kereszt_nev, profil_kep, letrejott FROM felhasznalok WHERE id = ?");
    $stmt->execute([$_SESSION["felhasznalo_id"]]);
    $felhasznalo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$felhasznalo) {
        header("Location: bejelentkezes.php");
        exit();
    }
} catch (PDOException $e) {
    die("Hiba az adatok lekérése során: " . htmlspecialchars($e->getMessage()));
}

$teljesNev = trim($felhasznalo['vezetek_nev'] . ' ' . $felhasznalo['kereszt_nev']);
$profilkep = !empty($felhasznalo['profil_kep']) ? $felhasznalo['profil_kep'] : 'pfp.jpg';
$letrejott = date('Y.m.d. H:i', strtotime($felhasznalo['letrejott']));
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
                        <img src="<?php echo htmlspecialchars($profilkep); ?>" alt="Avatar" class="avatar">
                        <div class="user-adat-doboz">
                            <label><?php echo htmlspecialchars($teljesNev); ?></label><i class="fa-solid fa-user"></i>
                        </div>
                    </div>

                    <label><?php echo htmlspecialchars($letrejott); ?></label>

                    <div class="user-adat-doboz">
                        <label><?php echo htmlspecialchars($felhasznalo['email']); ?></label>
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

</body>
</html>

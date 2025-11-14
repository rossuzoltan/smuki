<?php
require_once 'adatbazis.php';

$sikeres = false;
$hibaUzenet = "";
$sikerUzenet = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["regisztral"])) {
    $vezeteknev = trim($_POST["vezNevID"]);
    $keresztnev = trim($_POST["kerNevID"]);
    $email = trim($_POST["emailID"]);
    $username = trim($_POST["fNevID"]);
    $jelszo = $_POST["jelszo"];
    
    try {
        // Ellenőrizzük, hogy létezik-e már a felhasználónév
        $stmt = $pdo->prepare("SELECT id FROM felhasznalok WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $letezoFelhasznalo = $stmt->fetch();
        
        if ($letezoFelhasznalo) {
            $hibaUzenet = "<div class='hibas_bejelentkezes'><h2 class='sikertelen'>A felhasználónév vagy email már foglalt!</h2></div>";
        } else {
            // Jelszó hash-elése (MINDIG)
            $jelszo_hash = password_hash($jelszo, PASSWORD_DEFAULT);
            
            // Új felhasználó beszúrása
            $stmt = $pdo->prepare("INSERT INTO felhasznalok (username, email, jelszo_hash, vezetek_nev, kereszt_nev, is_active) VALUES (?, ?, ?, ?, ?, 1)");
            $stmt->execute([$username, $email, $jelszo_hash, $vezeteknev, $keresztnev]);
            
            $sikerUzenet = "<div class='sikeres_bejelentkezes'><h2 class='siker'>Sikeres regisztráció! Most már bejelentkezhetsz.</h2></div>";
            $sikeres = true;
        }
    } catch(PDOException $e) {
        $hibaUzenet = "<div class='hibas_bejelentkezes'><h2 class='sikertelen'>Adatbázis hiba: " . $e->getMessage() . "</h2></div>";
    }
}
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./bejelentkezes.css">
    <script src="https://kit.fontawesome.com/88f05daeb4.js" crossorigin="anonymous"></script>
    <title>Regisztrálás</title>
</head>
<body>
<header>
    <h1>Workhub</h1>
</header>

<nav class="navbar">
    <ul> 
        <li><a href="fooldal.html">Főoldal <i class="fa-solid fa-house"></i></a></li>
        <li><a href="bejelentkezes.php">Bejelentkezés <i class="fa-solid fa-user"></i></a></li>
        <li><a href="rolunk.html">Rólunk <i class="fa-solid fa-info"></i></a></li>
        <li><a href="szolgaltatasok.html">Szolgáltatások <i class="fa-regular fa-clipboard"></i></a></li>
    </ul>
</nav>

<div class="doboz">
    <form action="" method="POST">
        <h1 class="felirat">Regisztrálás</h1>

        <div id="centeralis">
            <div class="adat-doboz">
                <label>Vezetéknév: </label>
                <input type="text" class="adat-mezo" placeholder="Példa" name="vezNevID" value="<?php echo isset($_POST['vezNevID']) ? htmlspecialchars($_POST['vezNevID']) : ''; ?>" required/>
                <i class="fa-solid fa-pen"></i>
            </div>

            <div class="adat-doboz">
                <label>Keresztnév: </label>
                <input type="text" class="adat-mezo" placeholder="Péter" name="kerNevID" value="<?php echo isset($_POST['kerNevID']) ? htmlspecialchars($_POST['kerNevID']) : ''; ?>" required/>
                <i class="fa-solid fa-pen"></i>
            </div>

            <div class="adat-doboz">
                <label>Email cím: </label>
                <input type="email" class="adat-mezo" placeholder="Példa@példa.hu" name="emailID" value="<?php echo isset($_POST['emailID']) ? htmlspecialchars($_POST['emailID']) : ''; ?>" required/>
                <i class="fa-solid fa-at"></i>
            </div>

            <div class="adat-doboz">
                <label>Felhasználónév: </label>
                <input type="text" class="adat-mezo" placeholder="Felhasználónév.." name="fNevID" value="<?php echo isset($_POST['fNevID']) ? htmlspecialchars($_POST['fNevID']) : ''; ?>" required/>
                <i class="fa-solid fa-user"></i>
            </div>
        
            <div class="adat-doboz">
                <label>Jelszó: </label>
                <input type="password" class="adat-mezo" placeholder="Jelszó.." name="jelszo" required/>
                <i class="fa-solid fa-key"></i>
            </div>
        </div>

        <div class="gomb-doboz">
            <input type="submit" class="gombok" id="submit" name="regisztral" value="Regisztrálás"/>
            <input type='reset' class="gombok" id="torol" value='Törlés'/>
        </div>
    </form>
</div>

<?php
if ($hibaUzenet) {
    echo $hibaUzenet;
}
if ($sikerUzenet) {
    echo $sikerUzenet;
}
?>
</body>
</html>

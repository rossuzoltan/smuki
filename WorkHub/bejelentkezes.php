<?php
require_once 'adatbazis.php';

$sikeres = false;
$hibaUzenet = "";

// Bejelentkezés ellenőrzése
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    if (isset($_POST["fNevID"], $_POST["jelszoID"])) {
        $beirtFelhasznalo = trim($_POST["fNevID"]);
        $beirtJelszo = $_POST["jelszoID"];

        try {
            // Felhasználó keresése az adatbázisban
            $stmt = $pdo->prepare("SELECT id, username, jelszo_hash, email, vezetek_nev, kereszt_nev, is_active FROM felhasznalok WHERE username = ?");
            $stmt->execute([$beirtFelhasznalo]);
            $felhasznalo = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($felhasznalo) {
                $jelszoEgyezik = false;
                $hash = $felhasznalo['jelszo_hash'];
                $hashTipus = null;

                // Támogatjuk a plain text és hash-elt jelszavakat is
                if (password_verify($beirtJelszo, $hash)) {
                    $jelszoEgyezik = true;
                    $hashTipus = "password_hash";
                } elseif ($beirtJelszo === $hash) {
                    $jelszoEgyezik = true;
                    $hashTipus = "plain_text";
                } elseif (md5($beirtJelszo) === $hash) {
                    $jelszoEgyezik = true;
                    $hashTipus = "md5";
                }

                if ($jelszoEgyezik) {
                    if ($hashTipus !== "password_hash") {
                        try {
                            $ujHash = password_hash($beirtJelszo, PASSWORD_DEFAULT);
                            $update = $pdo->prepare("UPDATE felhasznalok SET jelszo_hash = ? WHERE id = ?");
                            $update->execute([$ujHash, $felhasznalo['id']]);
                        } catch(PDOException $e) {
                            // Ha a jelszó frissítése sikertelen, ne akadályozza a bejelentkezést, de logolhatnánk.
                        }
                    }
                    if ($felhasznalo['is_active'] == 1) {
                        // Sikeres bejelentkezés
                        $_SESSION["felhasznalo_id"] = $felhasznalo['id'];
                        $_SESSION["username"] = $felhasznalo['username'];
                        $_SESSION["email"] = $felhasznalo['email'];
                        $_SESSION["vezetek_nev"] = $felhasznalo['vezetek_nev'];
                        $_SESSION["kereszt_nev"] = $felhasznalo['kereszt_nev'];
                        $sikeres = true;
                        
                        header("Location: profil.php");
                        exit();
                    } else { // egyenlore useless
                        $hibaUzenet = "<div class='hibas_bejelentkezes'><h2 class='sikertelen'>A fiók inaktív!</h2></div>";
                    }
                } else {
                    $hibaUzenet = "<div class='hibas_bejelentkezes'><h2 class='sikertelen'>Hibás jelszó!</h2></div>";
                }
            } else {
                $hibaUzenet = "<div class='hibas_bejelentkezes'><h2 class='sikertelen'>Nincs ilyen felhasználó!</h2></div>";
            }
        } catch(PDOException $e) { //?
            $hibaUzenet = "<div class='hibas_bejelentkezes'><h2 class='sikertelen'>Adatbázis hiba!</h2></div>";
        }
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
    <title>Bejelentkezés</title>
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

<?php if (!$sikeres): ?>
<div class='doboz'>
    <form id='bejelentkezesForm' action='' method='POST'>
        <h1 class='felirat'>Bejelentkezés</h1>
        <div id='centeralis'>
            <div class='adat-doboz'>
                <label>Felhasználónév: </label>
                <input type='text' class='adat-mezo' placeholder='Felhasználónév...' name='fNevID' value='<?php echo isset($_POST['fNevID']) ? htmlspecialchars($_POST['fNevID']) : ''; ?>' required/>
                <i class='fa-solid fa-user'></i>
            </div>
            <div class='adat-doboz'>
                <label>Jelszó: </label>
                <input type='password' class='adat-mezo' placeholder='Jelszó...' name='jelszoID' required/>
                <i class='fa-solid fa-lock'></i>
            </div>
        </div>
        <div class='regisztralas-szoveg'>
            <h4>Nincs fiókod? <a href='regisztralas.php' class="szineslink">Regisztrálj!</a></h4>
        </div>
        <div class='gomb-doboz'>
            <input type='submit' class='gombok' id='submit' name='submit' value='Bejelentkezés'/>
            <input type='reset' class='gombok' id='torol' value='Törlés'/>
        </div>
    </form>
</div>

<?php 
if ($hibaUzenet) {
    echo $hibaUzenet;
}
endif; 
?>
</body>
</html>

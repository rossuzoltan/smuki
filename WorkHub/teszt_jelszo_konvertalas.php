<?php
require_once 'adatbazis.php'; // fontossag: idk

echo "<h2>Jelszavak konvertálása plain text-ről hash-re</h2>";

try {
    $stmt = $pdo->query("SELECT id, username, jelszo_hash FROM felhasznalok");
    $felhasznalok = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($felhasznalok as $felhasznalo) {
        $regiJelszo = $felhasznalo['jelszo_hash'];
        
        // Ha a jelszó rövid (valószínűleg plain text), hash-eljük
        if (strlen($regiJelszo) < 50 && !password_verify('123456', $regiJelszo)) {
            // Hash-eljük a plain text jelszót
            $ujHash = password_hash($regiJelszo, PASSWORD_DEFAULT);
            
            $updateStmt = $pdo->prepare("UPDATE felhasznalok SET jelszo_hash = ? WHERE id = ?");
            $updateStmt->execute([$ujHash, $felhasznalo['id']]);
            
            echo "<p style='color: green;'>✓ " . $felhasznalo['username'] . " - konvertálva: '" . $regiJelszo . "' → [hash]</p>";
        } else {
            echo "<p style='color: blue;'>→ " . $felhasznalo['username'] . " - már hash-elt</p>";
        }
    }
    
    echo "<p style='color: green; font-weight: bold;'>✅ Minden jelszó biztonságosan hash-elve!</p>";
    
} catch(PDOException $e) {
    echo "Hiba: " . $e->getMessage();
}
?>

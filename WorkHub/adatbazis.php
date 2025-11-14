<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "workhub";

try {
    $pdo = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<p>Sikertelen csatlakozás az adatbázishoz!</p>";
}

session_start();
?>


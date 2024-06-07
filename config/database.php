<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'donorcheck';
$username = 'root';
$password = '';

// Création de la connexion
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
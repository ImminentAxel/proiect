<?php
/**
 * Configurare conexiune MySQL
 * Asigură-te că ai creat baza de date 'tokyo_db' în phpMyAdmin
 */

$host = 'localhost';
$dbname = 'tokyo_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Eroare conexiune: " . $e->getMessage());
}
?>

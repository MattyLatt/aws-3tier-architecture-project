<?php

$host = "progetto1-database.cp2qq2k6oq1f.eu-north-1.rds.amazonaws.com";
$user = "admin";
$pass = "Torino2019-20"; 
$dbname = "decorazioni_db";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Errore di connessione al database: " . $e->getMessage());
}
?>
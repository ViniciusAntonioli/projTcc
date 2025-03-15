<?php

$serverName = "DESKTOP-L6F3F9R\SQLEXPRESS"; // Exemplo: "localhost" ou "192.168.1.100"
$database = "CatalogoDeBrindes";
$username = "sa"; // Exemplo: "sa"
$password = "1.Aa1234567";

try {
    // Adicionando TrustServerCertificate para ignorar a verificação SSL
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database;TrustServerCertificate=true", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
<?php
$host = 'localhost';
$db_name = 'projeto';
$username = 'root';
$password = '';

// Conexão e verificação com o banco de dados
try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>

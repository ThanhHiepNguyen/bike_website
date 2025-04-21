<?php
session_start();

$host = "localhost";
$db_user = "root"; // Thay bằng user MySQL
$db_pass = ""; // Thay bằng password MySQL
$db_name = "bike_sharing";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET CHARACTER SET utf8mb4");
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
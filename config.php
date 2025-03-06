<?php

//user account details on phpMyAdmin
$host = "localhost"
$db = "app-db";
$user = "root";
$pass ="";

try {
    //using PDO
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn,$user,$pass);
    //Error Handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "DB Connection Failed" .$e->getMessage();
    exit;
}
?>
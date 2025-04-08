<?php

//user account details on phpMyAdmin
$host = 'sqlXXX.infinityfree.com';
$db = "if0_38470935_app_db";
$user = "if0_38470935";
$pass ="qVWW0dMIywM";

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

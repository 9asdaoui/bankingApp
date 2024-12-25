<?php
$host = 'localhost'; 
$db = 'customerdb';
$user = 'root';
$pass = 'redaader@2000';  

$dsn = "mysql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);

    echo "Connection successful!";

    session_start();
    define('pdo',$pdo);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
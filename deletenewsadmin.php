<?php
session_start();


$host = 'localhost';
$db   = 'news_system';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("خطا در اتصال به دیتابیس: " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $stmt = $pdo->prepare("UPDATE news SET confirm = 0 WHERE id = :id");
    $stmt->execute(['id' => $id]);

  
    header("Location: admin.php");
    exit();
} else {
    die("شناسه خبر نامعتبر است.");
}
?>
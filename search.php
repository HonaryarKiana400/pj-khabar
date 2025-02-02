<?php
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

$query = isset($_GET['query']) ? $_GET['query'] : '';

if (!empty($query)) {
    $stmt = $pdo->prepare("SELECT id, title FROM news WHERE confirm = 1 AND title LIKE :query");
    $stmt->execute(['query' => '%' . $query . '%']);
    $results = $stmt->fetchAll();
    echo json_encode($results);
}
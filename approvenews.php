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


    $stmt = $pdo->prepare("UPDATE news SET confirm = 1, تایم = NOW() WHERE id = ?");
    $stmt->execute([$id]);


    if ($stmt->rowCount() > 0) {
        echo "خبر با موفقیت تایید شد.";
    } else {
        echo "خطا در تایید خبر.";
    }
} else {
    echo "ID خبر نامعتبر است.";
}


header("Refresh: 2; URL=admin.php");
?>
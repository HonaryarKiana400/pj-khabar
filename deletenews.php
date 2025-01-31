<?php
session_start();

// بررسی آیا کاربر وارد سیستم شده است
if (!isset($_SESSION['user_id'])) {
    header("Location: login1.php");
    exit;
}

// اتصال به دیتابیس
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

// حذف خبر
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM news WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

echo "<script>alert('خبر با موفقیت حذف شد.'); window.location.href='viewnews.php';</script>";
exit;
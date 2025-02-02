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


    $stmt = $pdo->prepare("DELETE FROM news WHERE id = :id");
    $stmt->execute(['id' => $id]);

    if ($stmt->rowCount() > 0) {
        echo "خبر با موفقیت حذف شد.";
    } else {
        echo "خطا در حذف خبر یا خبری با این ID وجود ندارد.";
    }


    header("Refresh: 2; URL=admin.php");
    exit();
} else {
    die("شناسه خبر نامعتبر است.");
}
?>
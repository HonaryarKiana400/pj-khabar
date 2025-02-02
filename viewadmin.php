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


$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();


if (!$news) {
    echo "<script>alert('خبر مورد نظر یافت نشد.'); window.location.href='admin.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>مشاهده خبر</title>
    <link rel="stylesheet" href="stylee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/newsss.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body style="background-color: #435165;">
    <div class="card text-center mb-3 mx-auto" style="width: 29rem; margin-top:100px;padding-top: 35px;padding-bottom: 19px;">
        <div class="card-body bg-glass">
            <h5 class="card-title"><?php echo $news['title']; ?></h5>
            <hr>
            <p><strong>دسته‌بندی:</strong> <?php echo $news['category']; ?></p>
            <p>
                <strong>نویسنده:</strong> <?php echo $news['author']; ?>

            <img src="<?php echo $news['image']; ?>" alt="عکس خبر" style="max-width: 100%; height: auto;">
            <p style="text-align: right;"><?php echo $news['content']; ?></p>
            <?php if (!empty($news['تایم'])): ?>
                    <br><strong>تاریخ انتشار:</strong> <?php echo $news['تایم']; ?>
                <?php endif; ?>
            </p>
            <a href="admin.php" class="btn btn-primary">بازگشت به پنل ادمین</a>
        </div>
    </div>
</body>
</html>
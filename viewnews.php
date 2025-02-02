<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login1.php");
    exit;
}


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


$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM news WHERE user_id = ?");
$stmt->execute([$user_id]);
$news = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>مشاهده خبرها</title>
    <link rel="stylesheet" href="stylee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/newsss.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .news-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: rgba(246, 250, 255, 0.8);
        }

        .news-item img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
        }

        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        h1 {
            color: rgb(127, 128, 130);
        }
        .link-containe {
            bottom: 0;
            left: 0;
            position: fixed;
            margin-bottom: 25px;
            margin-left: 10px;
            background-color: #007bff; 
            text-decoration: none;
            border-radius: 10px;
            padding: 10px; 
            color: white; 
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">خبرهای شما</h1>
        <?php foreach ($news as $item): ?>
            <div class="news-item">
                <h2 style="text-align: right;"><?php echo $item['title']; ?></h2>
                <p style="text-align: right;"><strong>دسته‌بندی:</strong> <?php echo $item['category']; ?></p>
                <img src="<?php echo $item['image']; ?>" alt="عکس خبر">
                <p style="text-align: right;"><?php echo $item['content']; ?></p>
                
                <p style="text-align: right;"><strong>نویسنده:</strong> <?php echo $item['author']; ?></p>
                <a href="editnews.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">ویرایش</a>
                <a href="deletenews.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
            </div>
        <?php endforeach; ?>
    </div>
    <a class="link-containe" href="index.php">بازگشت به صفحه اصلی</a>
</body>
</html>
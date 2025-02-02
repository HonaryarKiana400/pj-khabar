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


if (!isset($_GET['id'])) {
    die("خطا: شناسه خبر مشخص نشده است.");
}
$news_id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM news WHERE id = :id");
$stmt->execute(['id' => $news_id]);
$news = $stmt->fetch();

if (!$news) {
    die("خطا: خبر مورد نظر یافت نشد.");
}
?>

<!DOCTYPE html>
<html lang="fa" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($news['title']); ?></title>

    <!-------css link---->
    <link rel="stylesheet" href="style.css">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vazir-font@2.1.0/dist/font-face.css">

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

        .container{
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-top: 126px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
    <div class="all">
        <!------ start navbar------------->
        <nav class="navbar navbar-dark fixed-top" style=" background-color: #f0f0f0; padding-top: 32px; padding-bottom: 18px;" >
            <div class="container-fluid">
                <a class="navbar-brand" style="color: rgb(143, 140, 140); margin-left: 20px;  font-weight: bold; font-size: 26px;" href="login1.php">
                    <i class="bi bi-person"></i>
                    login  
                </a>

                <div class="search">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle bttn-all" style="margin-left:20px" data-bs-toggle="dropdown">
                        اخبار
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="text-align: end;">
                        <li><a class="dropdown-item text-secondary" href="category_news.php?category=سیاسی">سیاسی</a></li>
                        <li><a class="dropdown-item text-secondary" href="category_news.php?category=اقتصادی">اقتصادی</a></li>
                        <li><a class="dropdown-item text-secondary" href="category_news.php?category=فرهنگی">فرهنگی</a></li>
                        <li><a class="dropdown-item text-secondary" href="category_news.php?category=علمی">علمی</a></li>
                        <li><a class="dropdown-item text-secondary" href="category_news.php?category=هنری">هنری</a></li>
                        <li><a class="dropdown-item text-secondary" href="category_news.php?category=ورزشی">ورزشی</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="category_news.php?category=همه">اخبار مهم</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!------ end navbar------------->

        <!----------start news detail----------------------------->
        <div class="container ">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-right" dir="rtl"><?php echo htmlspecialchars($news['title']); ?></h1>
                    <img src="<?php echo htmlspecialchars($news['image']); ?>" class="img-fluid my-4" alt="<?php echo htmlspecialchars($news['title']); ?>">
                    <p class="text-right"dir="rtl"><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
                    <p class="text-right text-muted" dir="rtl">نویسنده: <?php echo htmlspecialchars($news['author']); ?></p>
                    <?php if (!empty($news['تایم'])): ?>
                    <strong dir="rlt">تاریخ انتشار:</strong> <?php echo $news['تایم']; ?>
                    <?php endif; ?>
                    <br>
                    <br>
                    <a href="index.php" class="btn btn-primary">بازگشت به صفحه اصلی</a>
                   

                    
                </div>
            </div>
        </div>
        <!----------end news detail----------------------------->

        <!--------------footer------------------------>
        <div class="d-flex flex-column ">

            </div>
            <footer class="mt-auto">
        
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <p>سایت خبری</p>
                            <div class="d-flex justify-content-center">
                                <a href="#" target="_blank" class="me-3">
                                    <i class="bi bi-instagram fs-4"></i>
                                </a>
                                <a href="#" target="_blank" class="me-3">
                                    <i class="bi bi-telegram fs-4"></i>
                                </a>
                                <a href="#" target="_blank">
                                    <i class="bi bi-whatsapp fs-4"></i>
                                </a>
                            </div>
                            <p>تمام حقوق مادی و معنوی به این سایت متعلق می‌باشد و استفاده از مطالب با ذکر منبع بلامانع است</p>
                        </div>
                
                </div>
            </footer>
        
    </div>
</body>
</html>
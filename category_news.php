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


$category = isset($_GET['category']) ? $_GET['category'] : 'همه';


if ($category == 'همه') {

    $stmt = $pdo->query("SELECT * FROM news WHERE confirm = 1");
} else {

    $stmt = $pdo->prepare("SELECT * FROM news WHERE category = :category AND confirm = 1");
    $stmt->execute(['category' => $category]);
}

$confirmed_news = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اخبار <?php echo $category; ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        
    </style>
</head>
<body>
    <div class="all">
        <nav class="navbar navbar-dark fixed-top" style="background-color: #f0f0f0; padding-top: 32px; padding-bottom: 18px;">
            <div class="container-fluid">
                <a class="navbar-brand" style="color: rgb(143, 140, 140); margin-left: 20px; font-weight: bold; font-size: 26px;" href="login1.php">
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

        <div class="title" style="margin-top: 110px; margin-right: 35px; text-align: right; font-weight: bold; font-size: 26px;    color: white;">
            <?php echo ($category == 'همه') ? 'همه خبرها' : "خبرهای دسته‌بندی: $category"; ?>
        </div>
        <div class="container" style="margin-top: 25px;">
            <div class="row">
                <?php foreach ($confirmed_news as $news): ?>
                    <div class="col-md-4">
                        <div class="card" style="position: relative; margin-bottom: 20px;">
                      
                            <a href="news_detail.php?id=<?php echo $news['id']; ?>">
                                <img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>" style="height: 200px; width: 100%; object-fit: cover;">
                                <div class="card-category" style="position: absolute; top: 10px; left: 10px; background-color: rgba(0, 0, 0, 0.7); color: white; padding: 5px 10px; border-radius: 5px;">
                                    <?php echo $news['category']; ?>
                                </div>
                                <div dir="rtl" class="card-title" style="position: absolute; bottom: 10px; right: 10px; background-color: rgba(0, 0, 0, 0.7); color: white; padding: 5px 10px; border-radius: 5px;">
                                    <?php echo $news['title']; ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
     

          </div>
          <footer class="mt-auto">
              <div class="container">
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
              </div>
          </footer>

</body>
</html>
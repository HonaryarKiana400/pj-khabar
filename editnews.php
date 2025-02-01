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

// دریافت اطلاعات خبر
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$news = $stmt->fetch();

// اگر خبر وجود نداشت
if (!$news) {
    echo "<script>alert('شما اجازه ویرایش این خبر را ندارید.'); window.location.href='viewnews.php';</script>";
    exit;
}

// اگر فرم ارسال شده باشد
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? $news['title']; // اگر خالی بود، مقدار قبلی استفاده شود
    $category = $_POST['category'] ?? $news['category']; // اگر خالی بود، مقدار قبلی استفاده شود
    $content = $_POST['content'] ?? $news['content']; // اگر خالی بود، مقدار قبلی استفاده شود
    $author = $_POST['author'] ?? $news['author']; // اگر خالی بود، مقدار قبلی استفاده شود

    // آپلود عکس جدید (اگر وجود دارد)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // بررسی فرمت عکس
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('فقط فایل‌های JPG, JPEG, PNG مجاز هستند.');</script>";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // بروزرسانی خبر در دیتابیس
                $stmt = $pdo->prepare("UPDATE news SET title = ?, category = ?, content = ?, image = ?, author = ? WHERE id = ?");
                $stmt->execute([$title, $category, $content, $target_file, $author, $id]);
                echo "<script>alert('خبر با موفقیت ویرایش شد.'); window.location.href='viewnews.php';</script>";
            } else {
                echo "<script>alert('خطا در آپلود عکس.');</script>";
            }
        }
    } else {
        // بروزرسانی خبر بدون تغییر عکس
        $stmt = $pdo->prepare("UPDATE news SET title = ?, category = ?, content = ?, author = ? WHERE id = ?");
        $stmt->execute([$title, $category, $content, $author, $id]);
        echo "<script>alert('خبر با موفقیت ویرایش شد.'); window.location.href='viewnews.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>ویرایش خبر</title>
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

        .card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
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
    <div class="card text-center mb-3 mx-auto" style="width: 29rem; margin-top:100px;padding-top: 35px;padding-bottom: 19px;">
        <div class="card-body bg-glass">
            <h5 class="card-title">ویرایش خبر</h5>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان خبر:</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $news['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="category">دسته‌بندی:</label>
                    <input type="text" name="category" id="category" class="form-control" value="<?php echo $news['category']; ?>">
                </div>
                <div class="form-group">
                    <label for="content">متن خبر:</label>
                    <textarea name="content" id="content" class="form-control" rows="5"><?php echo $news['content']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">عکس جدید (اختیاری):</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom:15px">
                    <label for="author">نویسنده:</label>
                    <input type="text" name="author" id="author" class="form-control" value="<?php echo $news['author']; ?>">
                </div>
                <br>
                <button type="submit" class="btn text-white" style="background-color: #3274d6;">ذخیره تغییرات</button>
            </form>
        </div>
        <a class="link-containe" href="index.php">بازگشت به صفحه اصلی</a>
    </div>
</body>
</html>
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

// اگر فرم ارسال شده باشد
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // بررسی خالی بودن فیلدها
    if (empty($title) || empty($content) || empty($_FILES['image']['name'])) {
        echo "<script>alert('لطفاً همه فیلدها را پر کنید.');</script>";
    } else {
        // آپلود عکس
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // ایجاد پوشه uploads اگر وجود نداشته باشد
            }
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // بررسی فرمت عکس
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "<script>alert('فقط فایل‌های JPG, JPEG, PNG مجاز هستند.');</script>";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // درج خبر در دیتابیس
                    $stmt = $pdo->prepare("INSERT INTO news (title, content, image, user_id) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$title, $content, $target_file, $user_id]);
                    echo "<script>alert('خبر با موفقیت ثبت شد.'); window.location.href='viewnews.php';</script>";
                } else {
                    echo "<script>alert('خطا در آپلود عکس.');</script>";
                }
            }
        } else {
            echo "<script>alert('لطفاً یک عکس انتخاب کنید.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>درج خبر</title>
    <link rel="stylesheet" href="stylee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #435165;">
    <div class="card text-center mb-3 mx-auto" style="width: 29rem; margin-top:100px;padding-top: 35px;padding-bottom: 19px;">
        <div class="card-body bg-glass">
            <h5 class="card-title">درج خبر</h5>
            <hr>
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="title">عنوان خبر</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">متن خبر</label>
                    <textarea name="content" id="content" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">عکس</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <br>
                <button type="submit" class="btn text-white" style="background-color: #3274d6;">ثبت خبر</button>
                <a href="viewnews.php" class="btn text-white" style="background-color: #3274d6;">مشاهده خبرها</a>
            </form>
        </div>
    </div>

    <script>
    
        function validateForm() {
            var title = document.getElementById('title').value;
            var content = document.getElementById('content').value;
            var image = document.getElementById('image').value;

            if (title.trim() === '' || content.trim() === '' || image.trim() === '') {
                alert('لطفاً همه فیلدها را پر کنید.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
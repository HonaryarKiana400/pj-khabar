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
    $title = $_POST['title'];
    $content = $_POST['content'];

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
                $stmt = $pdo->prepare("UPDATE news SET title = ?, content = ?, image = ? WHERE id = ?");
                $stmt->execute([$title, $content, $target_file, $id]);
                echo "<script>alert('خبر با موفقیت ویرایش شد.'); window.location.href='viewnews.php';</script>";
            } else {
                echo "<script>alert('خطا در آپلود عکس.');</script>";
            }
        }
    } else {
        // بروزرسانی خبر بدون تغییر عکس
        $stmt = $pdo->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
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
</head>
<body style="background-color: #435165;">
    <div class="card text-center mb-3 mx-auto" style="width: 29rem; margin-top:100px;padding-top: 35px;padding-bottom: 19px;">
        <div class="card-body bg-glass">
            <h5 class="card-title">ویرایش خبر</h5>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان خبر:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $news['title']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="content">متن خبر:</label>
                    <textarea name="content" class="form-control" rows="5" required><?php echo $news['content']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">عکس جدید (اختیاری):</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <br>
                <button type="submit" class="btn text-white" style="background-color: #3274d6;">ذخیره تغییرات</button>
            </form>
        </div>
    </div>
</body>
</html>
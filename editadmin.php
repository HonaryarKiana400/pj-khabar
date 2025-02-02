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


if (!isset($_GET['id'])) {
    echo "<script>alert('شناسه خبر نامعتبر است.'); window.location.href='admin.php';</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();


if (!$news) {
    echo "<script>alert('خبر مورد نظر یافت نشد.'); window.location.href='admin.php';</script>";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];


    if (empty($title) || empty($category) || empty($content)) {
        echo "<script>alert('لطفاً همه فیلدها را پر کنید.');</script>";
    } else {

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); 
            }
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // بررسی فرمت عکس
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "<script>alert('فقط فایل‌های JPG, JPEG, PNG مجاز هستند.');</script>";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // بروزرسانی خبر در دیتابیس با عکس جدید
                    $stmt = $pdo->prepare("UPDATE news SET title = ?, category = ?, content = ?, image = ? WHERE id = ?");
                    $stmt->execute([$title, $category, $content, $target_file, $id]);
                    echo "<script>alert('خبر با موفقیت ویرایش شد.'); window.location.href='admin.php';</script>";
                } else {
                    echo "<script>alert('خطا در آپلود عکس.');</script>";
                }
            }
        } else {
            // بروزرسانی خبر بدون تغییر عکس
            $stmt = $pdo->prepare("UPDATE news SET title = ?, category = ?, content = ? WHERE id = ?");
            $stmt->execute([$title, $category, $content, $id]);
            echo "<script>alert('خبر با موفقیت ویرایش شد.'); window.location.href='admin.php';</script>";
        }
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
            <h5 class="card-title">ویرایش خبر</h5>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان خبر:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $news['title']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">دسته‌بندی:</label>
                    <input type="text" name="category" class="form-control" value="<?php echo $news['category']; ?>" required>
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
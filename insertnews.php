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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category']; 
    $content = $_POST['content'];
    $author = $_POST['author'];
    $user_id = $_SESSION['user_id'];
    

    if (empty($title) || empty($category) || empty($content) || empty($_FILES['image']['name'])) {
        echo "<script>alert('لطفاً همه فیلدها را پر کنید.');</script>";
    } else {
      
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); 
            }
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

           
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "<script>alert('فقط فایل‌های JPG, JPEG, PNG مجاز هستند.');</script>";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                    $stmt = $pdo->prepare("INSERT INTO news (title, category, content, image, user_id,author) VALUES (?, ?, ?, ?, ?,?)");
                    $stmt->execute([$title, $category, $content, $target_file, $user_id,$author]);
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
            <h5 class="card-title">درج خبر</h5>
            <hr>
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="title" style="margin-bottom:7px">عنوان خبر:</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom:7px">
                    <label for="category">دسته‌بندی:</label>
                    <input type="text" name="category" id="category" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom:7px">
                    <label for="content">متن خبر:</label>
                    <textarea name="content" id="content" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group" style="margin-bottom:7px">
                    <label for="image">عکس:</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <br>
                <div class="form-group" style="margin-bottom:15px">
                    <label for="author">نویسنده:</label>
                    <input type="text" name="author" id="author" class="form-control">
                </div>
                <button type="submit" class="btn text-white" style="background-color: #3274d6;">ثبت خبر</button>
                <a href="viewnews.php" class="btn btn-success">مشاهده خبرها</a>
            </form>
        </div>
        <a class="link-containe" href="index.php">بازگشت به صفحه اصلی</a>
    </div>

    <script>
      
        function validateForm() {
            var title = document.getElementById('title').value;
            var category = document.getElementById('category').value;
            var content = document.getElementById('content').value;
            var image = document.getElementById('image').value;
            var  author= document.getElementById('author').value;

            if (title.trim() === '' || category.trim() === '' || content.trim() === '' || image.trim() === ''|| author.trim() === '') {
                alert('لطفاً همه فیلدها را پر کنید.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
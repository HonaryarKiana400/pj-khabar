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


$stmt = $pdo->query("SELECT * FROM news");
$news = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>پنل ادمین</title>
    
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .main-content {
            padding: 20px;
            margin-right: 300px; 
        }

        .sidebar {
            padding: 20px;
            background-color: rgba(240, 240, 240, 0.9); 
            height: 100vh;
            position: fixed;
            right: 0;
            top: 0;
            width: 300px; 
        }

        .sidebar .navbar {
            padding: 0;
        }

        .sidebar .nav-link {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .sidebar .nav-link:hover {
            background-color: #ddd;
        }

        .scrollable-field {
            height: 80vh;
            overflow-y: auto;
            padding: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9); 
        }

        .link-container {
            bottom: 0;
            left: 0;
            position: fixed;
            margin-bottom: 25px;
            margin-left: 10px;
            background-color: #ccc;
            text-decoration: none;
            border-radius: 10px;
            padding: 5px;
            color: black;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff; 
            color: white; 
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
            margin: 2px;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 main-content">
                <h2 style="text-align: center; padding: 15px; color: white;">اطلاعات همه خبرها</h2>

                <div class="scrollable-field">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>عنوان خبر</th>
                                <th>دسته‌بندی</th>
                                <th>نویسنده</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($news as $item): ?>
                                <tr>
                                    <td><?php echo $item['title']; ?></td>
                                    <td><?php echo $item['category']; ?></td>
                                    <td><?php echo $item['author']; ?></td>
                                    <td>
                                        <a href="viewadmin.php?id=<?php echo $item['id']; ?>" class="btn btn-info btn-sm">مشاهده</a>
                                        <a href="editadmin.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">ویرایش</a>
                                        <a href="deletenewsadmin.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
                                        <a href="approvenews.php?id=<?php echo $item['id']; ?>" class="btn btn-success btn-sm">تایید</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <a class="link-containe" href="index.php">بازگشت به صفحه اصلی</a>
            </div>
            <div class="col-md-3 sidebar">
                <h1 style="text-align: start">
                    <i class="bi bi-person"></i>
                    پنل مدیریت
                </h1>
                <p style="text-align: start; font-size: 22px;">به پنل مدیریت خوش آمدید</p>
                <nav class="navbar navbar-expand-lg navbar-light" style="margin-right: 55px; height: 651px; text-align: center; margin-left: 95px;">
                    <ul class="navbar-nav flex-column" style="gap: 181px; font-weight: bold; font-size: 20px">
                        <li class="nav-item">
                            <a class="nav-link" href="#">همه اخبار</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listusers.php">لیست کاربران</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>
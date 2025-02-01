<?php

$link = mysqli_connect('localhost:3306', 'root', '', 'roocket');

if (!$link) {
    echo 'could not connect : ' . mysqli_connect_error();
    exit;
}

$query = "SELECT * FROM users";
$result = mysqli_query($link, $query);

if (!$result) {
    echo 'error : ' . mysqli_error($link);
    exit;
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>پنل مدیریت</title>
    
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('img/newsss.jpg'); /* اضافه کردن عکس پس‌زمینه */
            background-size: cover; /* تنظیم اندازه عکس برای پوشش کامل صفحه */
            background-position: center; /* تنظیم موقعیت عکس در مرکز */
            background-repeat: no-repeat; /* جلوگیری از تکرار عکس */
            background-attachment: fixed; /* ثابت نگه داشتن عکس هنگام اسکرول */
        }



        .sidebar {
            padding: 20px;
            background-color: rgba(67, 78, 89, 0.9); /* پس‌زمینه با شفافیت */
            height: 100vh;
            position: fixed;
            right: 0;
            top: 0;
            color: white; 
        }

        .sidebar .nav-link {
            color: white; 
            padding: 10px;
            text-decoration: none; 
        }

        .sidebar .nav-link:hover {
            background-color: rgba(166, 175, 184, 0.8); /* تغییر رنگ با شفافیت */
        }

        .scrollable-field {
            margin-right: 431px;
            margin-left: -352px;
            height: auto; 
            overflow-y: auto;
            border-radius: 5px;
            border: 1px solid #ddd; 
            background-color: rgba(255, 255, 255, 0.9); /* پس‌زمینه سفید با شفافیت */
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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #007bff; 
            color: white; 
            padding: 15px;
        }

        a {
            color: #007bff; 
            text-decoration: none; 
        }

        a:hover {
            color: #0056b3; 
        }
    </style>
</head>
<body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9 main-content">
          <h2 style="text-align:center;color:white;">لیست کاربران</h2>

          <form action="adduser.php" method="post" style="margin-right: 431px;margin-left: -352px;">
              <div class="input-group mb-3">
                  <input type="text" class="form-control" name="namekarbar" placeholder="نام کاربری" required>
                  <input type="text" class="form-control" name="password" placeholder="پسورد" required>
                  <input type="text" class="form-control" name="esm" placeholder="اسم" required>
                  <input type="text" class="form-control" name="famil" placeholder="فامیل" required>
                  <button class="btn btn-success" type="submit">اضافه کردن</button>
              </div>
          </form>

          <div class="scrollable-field">
              <table>
                  <tr>
                      <th>حذف</th>
                      <th>ویرایش</th>
                      <th>ادمین</th>
                      <th>پسورد</th>
                      <th>فامیل</th>
                      <th>اسم</th>
                      <th>نام کاربری</th>
                  </tr>
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                      <td>
                          <a href="deleteuser.php?id=<?= $row['id'] ?>" onclick="return confirm('آیا می‌خواهید این کاربر را حذف کنید؟')">حذف</a>
                      </td>
                      <td>
                          <a href="/edituser.php?id=<?= $row['id'] ?>">ویرایش</a>
                      </td>
                      <td>
                          <?php if (isset($row['admin'])) { ?>
                              <?php if ($row['admin'] == 1) { ?>
                                  <span style="color: green;">ادمین</span>
                                  <a href="removeadmin.php?id=<?= $row['id'] ?>">حذف ادمین</a>
                              <?php } else { ?>
                                  <a href="makeadmin.php?id=<?= $row['id'] ?>">تبدیل به ادمین</a>
                              <?php } ?>
                          <?php } else { ?>
                              <a href="makeadmin.php?id=<?= $row['id'] ?>">تبدیل به ادمین</a>
                          <?php } ?>
                      </td>                
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['famil']; ?></td>
                      <td><?php echo $row['esm']; ?></td>
                      <td><?php echo $row['namekarbar']; ?></td>
                  </tr>
                  <?php } ?>
              </table>

              <a class="link-containe" href="index.php">بازگشت به صفحه اصلی</a>
          </div>
        </div>

        <div class="col-md-3 sidebar">
            <h1 style="text-align:start;">
                <i class="bi bi-person"></i> پنل مدیریت
            </h1>
            <p style="text-align:start; font-size:22px;">به پنل مدیریت خوش آمدید</p>
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav flex-column" style="gap:181px; font-weight:bold; font-size:20px; margin-right: 76px;">
                    <li class="nav-ite text-centerm">
                        <a class="nav-link" href="admin.php">همه اخبار</a>
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
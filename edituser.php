<?php


if(! isset($_GET['id'])) {
    header("Location: /");
    return;
}

$link = mysqli_connect('localhost:3306' , 'root' , '', 'roocket');
if(! $link) {
    echo 'could not connect : ' . mysqli_connect_error();
    exit;
}

$stmt = mysqli_prepare($link , "select * from users where id = ?");
$id = (int) $_GET['id'];
mysqli_stmt_bind_param($stmt , 'i' , $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if($result->num_rows == 0) {
    header("Location: /");
    return;
}

$user = mysqli_fetch_assoc($result);


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namekarbar = $_POST['namekarbar'];
    $password = $_POST['password'];
    $esm = $_POST['esm'];
    $famil = $_POST['famil'];
    $id = $_POST['id'];

    $stmt = mysqli_prepare($link, "UPDATE users SET namekarbar = ?, password = ?, esm = ?, famil = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ssssi', $namekarbar, $password, $esm, $famil, $id);
    mysqli_stmt_execute($stmt);

    header("Location: listusers.php");
    exit; 
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ویرایش کاربر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);

            height: 629px;
            margin-top: 75px;
            padding-top: 99px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center">ویرایش کاربر</h3>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <div class="mb-3">
                    <label for="namekarbar" class="form-label">نام کاربری:</label>
                    <input type="text" class="form-control" id="namekarbar" name="namekarbar" value="<?= $user['namekarbar'] ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">پسورد:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $user['password'] ?>">
                </div>
                <div class="mb-3">
                    <label for="esm" class="form-label">اسم:</label>
                    <input type="text" class="form-control" id="esm" name="esm" value="<?= $user['esm'] ?>">
                </div>
                <div class="mb-3">
                    <label for="famil" class="form-label">فامیل:</label>
                    <input type="text" class="form-control" id="famil" name="famil" value="<?= $user['famil'] ?>">
                </div>
                <button type="submit" class="btn w-100">ثبت ویرایش</button>
            </form>
        </div>
    </div>
</body>
</html>


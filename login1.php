<?php
session_start();

function request($field) {
    return isset($_REQUEST[$field]) && $_REQUEST[$field] != "" ? trim($_REQUEST[$field]) : null;
}

function has_error($field) {
    global $errors;
    return isset($errors[$field]);
}

function get_error($field) {
    global $errors;
    return has_error($field) ? $errors[$field] : null;
}

function is_valid_name($name) {
    return preg_match("/^[a-zA-Zآ-ی\s]+$/", $name);
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namekarbar = request('namekarbar');
    $password = request('password');

    if (is_null($namekarbar)) {
        $errors['namekarbar'] = 'فیلد نام کاربری نمی‌تواند خالی بماند';
    } elseif (!is_valid_name($namekarbar)) {
        $errors['namekarbar'] = "نام کاربری باید شامل حروف باشد";
    }

    if (is_null($password)) {
        $errors['password'] = 'فیلد پسورد نمی‌تواند خالی بماند';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'فیلد پسورد نمی‌تواند کمتر از 6 کاراکتر باشد';
    }


    if (empty($errors)) {
 
        $link = mysqli_connect('localhost:3306', 'root', '', 'roocket');
        if (!$link) {
            echo 'could not connect : ' . mysqli_connect_error();
            exit;
        }

        
        $stmt = mysqli_prepare($link, "SELECT * FROM users WHERE namekarbar = ? AND password = ?");
        mysqli_stmt_bind_param($stmt, "ss", $namekarbar, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['admin'] = $user['admin']; 

            if ($user['admin'] == 1) {
                header("Location: admin.php");
                exit;
            } else {
                header("Location: insertnews.php");
                exit;
            }
        } else {
            echo "<script>alert('نام کاربری یا پسورد اشتباه است.');</script>";
        }
        
        mysqli_close($link); 
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>ورود/ثبت نام</title>
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
            <h5 class="card-title" style="">ورود/ثبت نام</h5>
            <hr>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">نام کاربری : </label>
                    <input type="text" name="namekarbar" placeholder="نام کاربری" style="margin:10px 2px"><br>
                    <?php if (has_error('namekarbar')) { ?>
                        <span class="text-danger"><?php echo get_error('namekarbar'); ?></span><br>
                    <?php } ?>
                </div>
                <div class="form-group" style="margin-right: 27px;">    
                    <label for="">پسورد: </label>
                    <input type="password" name="password" placeholder="پسورد" style="margin:10px 2px"><br>
                    <?php if (has_error('password')) { ?>
                        <span class="text-danger"><?php echo get_error('password'); ?></span><br>
                    <?php } ?>
                </div>

                <br>
                <button type="submit" class="btn text-white" style="background-color: #3274d6;">ورود</button>
                <a href="login2.php" class='btn text-white' style="background-color: #3274d6; margin-left: 10px;">ثبت نام</a> 
                <a href="#" onclick="window.location.href='index.php'; return false;" class='btn btn-secondary' style="background-color: #3274d6">بازگشت به صفحه اصلی</a> 
            </form>   
        </div>
    </div>
</body>
</html>


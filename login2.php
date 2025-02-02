<?php

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
    $esm = request('esm');
    $famil = request('famil');


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

    if (is_null($esm)) {
        $errors['esm'] = 'فیلد اسم نمی‌تواند خالی بماند';
    } elseif (!is_valid_name($esm)) {
        $errors['esm'] = "اسم باید شامل حروف باشد";
    }

    if (is_null($famil)) {
        $errors['famil'] = 'فیلد فامیل نمی‌تواند خالی بماند';
    } elseif (!is_valid_name($famil)) {
        $errors['famil'] = "فامیل باید شامل حروف باشد";
    }


    if (empty($errors)) {
      
        $link = mysqli_connect('localhost:3306', 'root', '', 'roocket');
        if (!$link) {
            echo 'could not connect : ' . mysqli_connect_error();
            exit;
        }

       
        $stmt = mysqli_prepare($link, "INSERT INTO users (namekarbar, password, esm, famil) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $namekarbar, $password, $esm, $famil);
        
        if (mysqli_stmt_execute($stmt)) {
          
            $success = true;
        } else {
            echo 'error : ' . mysqli_error($link);
            exit;
        }
        
        mysqli_close($link); 
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>ثبت نام</title>
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
    <div class="card text-center mb-3 mx-auto" style="width: 29rem; margin-top:100px;">
        <div class="card-body bg-glass">
            <h5 class="card-title">ثبت نام</h5>

           <hr>
            <?php if ($success) { ?>
                <div class="alert alert-success" role="alert">
                    اطلاعات شما با موفقیت ثبت شد.
                </div>
            <?php } ?>

           
            <?php if (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($errors as $error) { echo $error . "<br>"; } ?>
                </div>
            <?php } ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="">نام کاربری : </label>
                    <input type="text" name="namekarbar" placeholder="نام کاربری" style="margin:10px 2px"><br>
                </div>
                <div class="form-group" style="margin-right: 27px;">    
                    <label for="">پسورد: </label>
                    <input type="password" name="password" placeholder="پسورد" style="margin:10px 2px"><br>
                </div>
                <div class="form-group" style="margin-right: 43px;">    
                    <label for="">اسم: </label>
                    <input type="text" name="esm" placeholder="اسم" style="margin:10px 2px"><br>
                </div>
                <div class="form-group" style="margin-right: 43px;>    
                    <label for="">فامیل: </label>
                    <input type="text" name="famil" placeholder="فامیل" style="margin:10px 2px"><br>
                </div>

                <br>
                <button type="submit" class="btn text-white" style="background-color: #3274d6;">ثبت نام</button> 
                
                <a href="#" onclick="window.location.href='index.php'; return false;" class='btn btn-secondary' style='background-color: #3274d6;'>بازگشت به صفحه اصلی</a> 
            </form>   
        </div>
    </div>

</body>
</html>
